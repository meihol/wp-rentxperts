<?php 

namespace Wcf\Mega_Menu;

Class Wcf_Mega_Menu_Cpt{

    public $type = 'wcf-mega-menu-tpl';
    
    public function __construct(){
       
        add_action( 'init', [$this,'custom_post_type']);
        add_action( 'admin_menu', array(&$this, 'register_sub_menu_post') );
        add_filter( 'save_post_'.$this->type, array( $this, 'update_template' ), 10,3 );
        add_action( 'wp_ajax_wcf_get_mega_menu_templates' , [$this,'get_mega_menu_tpl'] );
        add_action( 'wp_ajax_wcf_get_mega_menu_new_template' , [$this,'mega_menu_new_template'] );
    }
 
    function custom_post_type(){
        
        register_post_type('wcf-mega-menu-tpl',
            array(
                'labels'      => array(
                    'name'          => __('Mega Menu', 'AROLAX_ESSENTIAL'),
                    'singular_name' => __('Mega Menu', 'AROLAX_ESSENTIAL'),
                ),
                'public'              => true,
                'menu_icon'           => 'dashicons-text-page',
                'supports'            => [ 'title' , 'editor' ],            
                'exclude_from_search' => false,
                'has_archive'         => false,  
                'show_in_nav_menus'   => false,
                'publicly_queryable'  => true,     
                'hierarchical'        => false,
                'show_in_menu'        => false,
            )
      );
      
      $this->add_elementor_editor_support();
      
    }
    
    public function add_elementor_editor_support() {
    	add_post_type_support($this->type, 'elementor' );
    }
    public function update_template( $post_id,$post ,$update ){
      
        if($update){          
              if(isset($_POST['page_template'])):
                  $template = sanitize_text_field( $_POST[ 'page_template' ] );
                  if( get_post_type($post_id) == $this->type ):
                      update_post_meta( $post_id, '_wp_page_template', $template );
                  endif;
              endif;                      
        }else{
            update_post_meta( $post_id, '_wp_page_template', 'elementor_canvas' );
        }      
  
    }
    public function register_sub_menu_post() {       
        add_submenu_page( 'wcf-arolax-theme-parent' , esc_html__( 'Mega Menu','arolax-essential' ) , esc_html__( 'Mega Menu','arolax-essential' ) , 'manage_options' , 'edit.php?post_type='.$this->type);      
    }
    
    public function get_mega_menu_tpl(){   
    
        if ( !wp_verify_nonce( $_REQUEST['nonce'], "wcf_mega_menu_secure")) {
            exit("No naughty business please");
        }  
        $search_q = sanitize_text_field( isset($_POST['s']) ? $_POST['s'] : '');       
        $return['html'] = '';    
        $args = array(
            'numberposts'   => 10,
            'post_type'     => ['elementor_library',$this->type],
            'orderby'       => 'date',    
            's'             => $search_q
          );
          
        $mega_menus = get_posts( $args );
      
        foreach($mega_menus as $item){
        
            $elementor_link = add_query_arg( [ 'action' => 'elementor' , 'wcf-edit' => 1 ], get_edit_post_link( $item->ID ) );
            $return['html'] .= sprintf( "<li class='wcf--search-list-single-item'><span class='title'>%s</span> <div><a target='_blank' class='button button-secondary' href='%s'>Edit With Elementor</a> <button class='wcf--add-to--megamenu button button-secondary' data-id='%s'>%s</button></div></li>", $item->post_title,  $elementor_link, $item->ID ,esc_html__('Add To Menu','arolax-essential'));    
           
        }
     
        wp_send_json($return);
        wp_die();
    }
    public function add_buttons_html($post_id){
        $elementor_link = add_query_arg( [ 'action' => 'elementor' , 'wcf-edit' => 1 ], get_edit_post_link( $post_id ) );
        $html = sprintf('<div class="wcf-mega-menu-js-reponse">
            <a href="%s" class="button button-secondary" target="_blank">%s</a>         
            <button class="wcf--add-to--megamenu button button-secondary" data-id="%s">%s</button>   
        </div', 
        $elementor_link,
        esc_html__('Edit With Elementor','arolax-essential'),
        $post_id,
        esc_html__('Add To Menu','arolax-essential'),
        // $post_id,
        // esc_html__('Edit Here','arolax-essential')
        );       
        
        return $html;
    }
    public function mega_menu_new_template(){
        if ( !wp_verify_nonce( $_REQUEST['nonce'], "wcf_mega_menu_secure")) {
            exit("No naughty business please");
        }  
        $title = sanitize_text_field( isset($_POST['title']) ? $_POST['title'] : '');
          // Create post object
        $return['msg'] = '';
        try {
            $args = array(        
                'post_title'    => wp_strip_all_tags( $title ),
                'post_content'  => '',
                'post_status'   => 'publish',
                'post_type'     => $this->type          
            );    
      
            $post_id = wp_insert_post($args);
            if(!is_wp_error($post_id)){
               
                //$return['msg'] = $this->add_buttons_html($post_id);
                $return['msg'] = '';
                wp_send_json_success($return);
            }else{
              $return['msg'] = $post_id->get_error_message();
              wp_send_json_error($return);
            }
            
        } catch (\Exception $e) {
            $return['msg'] = $e->getMessage();
            wp_send_json_error($return);
        }
        
        wp_send_json($return);
        wp_die();
    }
}

new Wcf_Mega_Menu_Cpt();