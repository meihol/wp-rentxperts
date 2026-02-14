<?php

namespace arolax\Core;

class Theme_Setup
{
    public $theme_data_key = 'arolax_theme_data';
    /**
     * register default hooks and actions for WordPress
     * @return
     */
    public function register()
    {
        add_action( 'admin_menu', [ $this,'register_theme_admin_menu' ] );
        add_action( 'after_setup_theme' , array( $this, 'setup' ) );
        add_action( 'admin_init' , [ $this , 'theme_activated_options' ]);       
        add_action( 'after_switch_theme' , [ $this , 'theme_activated' ]);       
        // add extra html tags for smooth
        add_action( 'wp_ajax_wcf_user_guide_ls_checker' , [ $this,'wcf_user_guide'] );
        add_action( 'wp_ajax_wcf_user_guide_ls_remove' , [ $this,'license_deactivate'] );
    }
    
    function register_theme_admin_menu() {		
		
		if(!defined('AROLAX_ESSENTIAL')) {
            add_menu_page(
                esc_html__( 'Arolax Theme', 'arolax' ),
                esc_html__( 'Arolax Theme','arolax'),
                'manage_options',
                'wcf-arolax-theme-parent',
                [$this,'_render_dashboard'],
                null,
                6
            );	
        }
		
	}
    
    public function theme_activated(){
       
        if( isset( $_GET['activated'] ) ) {
            wp_safe_redirect( admin_url('admin.php?page=wcf-arolax-theme-parent') );
            exit;
        }
	}
	
	public function _render_dashboard(){
		echo '<div id="wcf-user-guider-dashboard" class="wcf-user-guider-dashboard"></div>';
	}
    
    public function wcf_user_guide() {
        // Security: verify nonce
        if ( !wp_verify_nonce( $_REQUEST['nonce'], 'wcf_user_guider_arolax_secure' ) ) {
            exit( 'No naughty business please' );
        }
    
        // Defaults
        $licenseCode  = get_option( 'arolax_lic_Key', '' );
        $licenseEmail = get_option( 'arolax_lic_email', get_bloginfo( 'admin_email' ) );
    
        // Prepare return response
        $return = array(
            'code'  => 0,
            'email' => $licenseEmail,
            'msg'   => '',
        );
    
        // Static license key (change this to your preferred value)
        $static_license_key = 'MY-THEME-STATIC-KEY-1234';
    
        // If submitted via form
        if (
            isset( $_POST['user_submitted'] ) &&
            $_POST['user_submitted'] === 'yes' &&
            isset( $_POST['ls_code'] ) && !empty( $_POST['ls_code'] ) &&
            isset( $_POST['ls_email'] )
        ) {
            $licenseCode  = sanitize_text_field( wp_unslash( $_POST['ls_code'] ) );
            $licenseEmail = sanitize_text_field( wp_unslash( $_POST['ls_email'] ) );
        }
    
        // Add cleanup hook
        \Arolax_Base::add_on_delete( function () {
            delete_option( 'arolax_lic_Key' );
            delete_option( 'arolax_lic_email' );
        });
    
        // Static license key validation
        if ( $licenseCode === $static_license_key ) {
            $return['code'] = 1;
            $return['msg']  = 'License activated successfully.';
    
            update_option( 'arolax_lic_Key', $licenseCode ) || add_option( 'arolax_lic_Key', $licenseCode );
            update_option( 'arolax_lic_email', $licenseEmail ) || add_option( 'arolax_lic_email', $licenseEmail );
    
            $this->update_readme( $licenseCode, $licenseEmail, $return );
        } else {
            $return['code'] = 0;
            $return['msg']  = 'Invalid license key.';
        }
    
        wp_send_json( $return );
        wp_die();
    }
    
    public function update_readme($licenseCode, $licenseEmail, $return){
        try{
            $return['lic'] = $licenseCode;
            delete_user_meta( 1 , $this->theme_data_key );
            update_user_meta( 1 , $this->theme_data_key , $return );
        }catch(\Exception $e){            
        }
       
    }
    
    public function license_deactivate(){
        $message='';
		if(\Arolax_Base::remove_license_key(__FILE__,$message)){
			$main_lic_key = "arolax_lic_Key";
			$lic_key_name = \Arolax_Base::get_lic_key_param($main_lic_key);
			update_option($lic_key_name,'') || add_option($lic_key_name,'');
			update_option('_site_transient_update_themes','');
		}
		$return['path'] = admin_url( 'admin.php?page=wcf-arolax-theme-parent');
		update_option('arolax_lic_Key','');
        wp_send_json($return);
        wp_die();
    }
    
    function theme_activated_options() {
        $is_admin      = current_user_can( 'manage_options' );
        $currentScreen = get_current_screen();
       
        if ( (current_user_can( 'administrator' ) || $is_admin) && isset($_GET['page']) && $_GET['page'] === 'wcf-arolax-theme-parent') {        
            wp_register_script( 'arolax-configure', AROLAX_JS . '/user-configure.js', array( 'jquery' ), time(), true );  
            $params = array(
                'ajaxurl'     => admin_url('admin-ajax.php'),
                'ajax_nonce'  => wp_create_nonce('wcf_user_guider_arolax_secure'),
                'update_path' => admin_url('admin.php?page=arolax-theme#tab=theme-update'),
                'demo_active' => function_exists('arolax_option') ? arolax_option('theme_demo_activate', true) : true
            );
            wp_localize_script( 'arolax-configure', 'ajax_object', $params );
            wp_enqueue_script( 'arolax-configure' );    
        }
    }    

    public function setup(){
        /*
        * You can activate this if you're planning to build a multilingual theme
        */        
        load_theme_textdomain( 'arolax', get_template_directory() . '/languages' );
        add_theme_support( 'automatic-feed-links' );
        add_theme_support( 'title-tag' );
        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'post-formats' , [
           'standard', 'image', 'video', 'audio'
        ]);
        
        //Thumbnail size 1200 x 780
        set_post_thumbnail_size(1200, 780, ['center', 'center']);

  
        add_theme_support( 'html5', array(
              'search-form',
              'comment-form',
              'comment-list',
              'gallery',
              'caption',
        ) );
        
        remove_theme_support( 'widgets-block-editor' );
        /*
        Register all your menus here
        */
        register_nav_menus( array(        
            'primary'     => esc_html__( 'Primary', 'arolax' )    
        ) );
        
    }

    public function is_elementor_builder(){

	    if ( isset( $_GET['preview'] ) && $_GET['preview'] == true ) {
		    return false;
	    }

        if( ( isset($_GET['wcf-edit']) && $_GET['wcf-edit'] == '1' )) {
            return true;
        }
    
        return false;
    }
     
    
}
