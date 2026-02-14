<?php 

namespace Wcf\Mega_Menu;

Class Wcf_Mega_Menu_Settings{

    public function __construct(){
        add_action( 'admin_enqueue_scripts',  array( $this, 'admin_enqueue_scripts' )  );	 
        add_action( 'wp_enqueue_scripts',  array( $this, '_enqueue_scripts' )  );	 
        add_action( 'current_screen',  array( $this, 'load_assets' )  ); 
        
        // Settings        
        add_action( 'wp_nav_menu_item_custom_fields', [$this,'menu_item_settings'], 10, 3 );
        add_action( 'wp_update_nav_menu_item', [$this,'save_menu_item_settings'], 10, 2 );       
       
        add_action( 'admin_footer', [$this,'_admin_footer']);
    }
    
    public function get_latest_tpl_html(){
        $html = '';
        $args = array(
            'numberposts'   => 7,
            'post_type'     => ['elementor_library','wcf-mega-menu-tpl'],
            'orderby'       => 'date',           
          );
          
        $mega_menus = get_posts( $args );
        
        foreach($mega_menus as $item){
            $elementor_link = add_query_arg( [ 'action' => 'elementor' , 'wcf-edit' => 1 ], get_edit_post_link( $item->ID ) );
            $html .= sprintf( "<li class='wcf--search-list-single-item'><span class='title'>%s</span> <div><a target='_blank' class='button button-secondary' href='%s'>Edit With Elementor</a> <button class='wcf--add-to--megamenu button button-secondary' data-id='%s'>%s</button></div></li>", $item->post_title,  $elementor_link, $item->ID ,esc_html__('Add To Menu','arolax-essential'));    
        }
        
        return $html;
    }
    
    function _admin_footer() {
        add_thickbox();
        $current_screen = get_current_screen();
        if(isset($current_screen->base) && $current_screen->base == 'nav-menus'){         
        
            echo sprintf('<div id="wcf--mega-menu--content-js" style="display:none;">
                <h2 class="wcf--mega-menu-tpl-header">%s</h2>
                <div class="wcf--mega-menu--tpl-container">
                    <div class="wcf--mega-menu-tabs wcf--mega-menu">
                        <div class="wcf--mega-menu-tab">
                            <input type="radio" id="wcf--search--tpl-tab" name="tab-group" checked>
                            <label for="wcf--search--tpl-tab">Search</label>
                            <div class="wcf--mega-menu-tab-content">
                              <input type="text" class="wcf--elementor-tpl-search-suggest" placeholder="Type here"/>
                              <ul class="wcf--mega-menu--tpl-suggest-list">
                                 %s
                              </ul>
                            </div>
                        </div>
                        <div class="wcf--mega-menu-tab">
                            <input type="radio" id="wcf--new--tpl-tab" name="tab-group">
                            <label for="wcf--new--tpl-tab">Add New</label>
                            <div class="wcf--mega-menu-tab-content">
                              <div class="wcf--new-meg-fld"> 
                                <h3>%s</h3>
                                <input type="text" class="wcf--new-mega-menu" placeholder="%s"/>
                              </div>
                              <div class="wcf--submit-new-megamenu-post"> 
                                <button id="wcf--submit-new-megamenu-post" class="button button-primary disabled">%s</button>
                              </div>
                              <div id="wcf--mega-menu-item-response-container"></div>
                            </div>
                        </div>                       
                    </div>
                </div>
            </div> 
            <a hidden href="#TB_inline?&width=600&height=550&inlineId=wcf--mega-menu--content-js" class="thickbox" id="wcf---hidden-megamenu-trigger"></a>',
            esc_html__('Mega Menu Templates', 'arolax-essential'),
            $this->get_latest_tpl_html(),
            esc_html__('Post Title','arolax-essential'),
            esc_html__('Type mega menu section','arolax-essential'),
            esc_html__('Submit','arolax-essential')
            );        
        }
    }
   
   
    public function _enqueue_scripts(){  
        wp_register_style( 'wcf-mega-menu', plugin_dir_url( __FILE__ ).'assets/widget.css' );	
    }
    
       
    public function admin_enqueue_scripts(){    
    
        wp_register_style( 'wcf-mega-menu-admin', plugin_dir_url( __FILE__ ).'assets/admin.css' );
        wp_register_script(
			'wcf-mega-menu-admin',
			plugin_dir_url( __FILE__ ).'assets/admin.js',			
			['jquery'],			
			false,
			true
		);
        $arolax_data =[
            'ajax_url' => admin_url( 'admin-ajax.php' ),
            'ajax_nonce' => wp_create_nonce('wcf_mega_menu_secure'),
        ];
       
       wp_localize_script( 'wcf-mega-menu-admin', 'arolax_obj', $arolax_data);
    }
    
    public function load_assets(){
        $currentScreen = get_current_screen();
        
        if( !is_null( $currentScreen ) && $currentScreen->id === 'nav-menus' ){
            wp_enqueue_style( 'wcf-mega-menu-admin' );
            wp_enqueue_script( 'wcf-mega-menu-admin' );
        }
    }
    
    public function menu_item_settings( $item_id, $item , $depth ){
    
        $menu_item_enable = get_post_meta( $item_id, '_menu_item_wcf_mega_menu_enable', true );
        $menu_item_ele_id = get_post_meta( $item_id, '_menu_item_wcf_mega_menu_tpl_id', true );
        $fullwidth        = get_post_meta( $item_id, '_menu_item_wcf_mega_menu_fullwidth', true );
        
        $text_popup = is_numeric( $menu_item_ele_id ) ? esc_html__(' - Settings', 'arolax-essential') : esc_html__('Add New', 'arolax-essential');
        if($depth === 0){
        ?>
        <div class="wcf--mega-menu-switcher">
            <div class="wcf--menu-flex-container wcf--menu-setting-header-js">
                <h4><?php echo esc_html__('Mega Menu' , 'arolax-essential'); ?></h4>
                <div class="wcf--mega-menu-additional-option" style="<?php echo esc_attr($menu_item_enable == 'on' ? '' : 'display:none;'); ?>">
                    <?php if(is_numeric($menu_item_ele_id)){ ?>
                        <div class="wcf--mega-menu--fullwidth">
                            <input class="wcf--mega-menu--fullwidth-js" <?php echo $fullwidth =='on' ? 'checked' : ''; ?> type="checkbox" name="_menu_item_wcf_mega_menu_fullwidth[<?php echo $item_id ;?>]">
                            <label><?php echo esc_html__('Fullwidth','arolax-essential'); ?></label>
                        </div>
                        <a target="_blank" href="<?php echo esc_url(get_edit_post_link($menu_item_ele_id)); ?>" class="button-secondary"><?php echo esc_html__('Edit', 'arolax-essential') ?></a>
                    <?php } ?>
                </div>
            </div>
            <div class="wcf--menu-flex-container">
                <div class="item">
                    <div class="toggle-button-cover">
                        <div class="button r button-3">
                          <input class="checkbox wcf--mega-menu--enabler-js" <?php echo $menu_item_enable =='on' ? 'checked' : ''; ?> type="checkbox" name="_menu_item_wcf_mega_menu_enable[<?php echo $item_id ;?>]">
                          <div class="knobs"></div>
                          <div class="layer"></div>
                        </div>
                    </div>
                </div>
                <div class="item wcf-width--100 _menu_item_wcf_mega_menu_tpl_id" <?php echo $menu_item_enable =='on' ? '' : 'hidden'; ?>> 
                    <div class="wcf--mega-menu-title"><?php echo esc_html(ucfirst( get_the_title($menu_item_ele_id) )) . $text_popup; ?> </div>      
                    <input type="hidden" value="<?php echo $menu_item_ele_id; ?>"  name="_menu_item_wcf_mega_menu_tpl_id[<?php echo $item_id ;?>]" placeholder="<?php echo esc_html__('Select template from here','arolax-essential'); ?>" class="wcf--mega-menu-search-fld wcf-width--100"  />
                </div>
            </div>
        </div>
        <?php
        }
    }
    
    public function save_menu_item_settings( $menu_id, $menu_item_db_id ){
    
        if ( isset( $_POST['_menu_item_wcf_mega_menu_enable'][$menu_item_db_id]  ) ) {
            $sanitized_data = sanitize_text_field( $_POST['_menu_item_wcf_mega_menu_enable'][$menu_item_db_id] );
            update_post_meta( $menu_item_db_id, '_menu_item_wcf_mega_menu_enable', $sanitized_data );
        } else {
            delete_post_meta( $menu_item_db_id, '_menu_item_wcf_mega_menu_enable' );
        }
        
        if ( isset( $_POST['_menu_item_wcf_mega_menu_fullwidth'][$menu_item_db_id]  ) ) {
            $sanitized_data = sanitize_text_field( $_POST['_menu_item_wcf_mega_menu_fullwidth'][$menu_item_db_id] );
            update_post_meta( $menu_item_db_id, '_menu_item_wcf_mega_menu_fullwidth', $sanitized_data );
        } else {
            delete_post_meta( $menu_item_db_id, '_menu_item_wcf_mega_menu_fullwidth' );
        }
        
        // elementor id
        
        if ( isset( $_POST['_menu_item_wcf_mega_menu_tpl_id'][$menu_item_db_id]  ) ) {
            $sanitized_data = sanitize_text_field( $_POST['_menu_item_wcf_mega_menu_tpl_id'][$menu_item_db_id] );
            update_post_meta( $menu_item_db_id, '_menu_item_wcf_mega_menu_tpl_id', $sanitized_data );
        } else {
            delete_post_meta( $menu_item_db_id, '_menu_item_wcf_mega_menu_tpl_id' );
        }
    }
}

new Wcf_Mega_Menu_Settings();