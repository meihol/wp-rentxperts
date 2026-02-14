<?php

namespace Wcf\Mega_Menu;
use Walker_Nav_Menu;

class Mega_Menu_Nav_Walker extends Walker_Nav_Menu
{
/**
     * Starts the list before the elements are added.
     *
     * @see Walker::start_lvl()
     *
     * @since 3.0.0
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param int    $depth  Depth of menu item. Used for padding.
     * @param array  $args   An array of arguments. @see wp_nav_menu()
     */
    public $elementor_settings = [
        'custom_icon' => '',
        'entrance_animation' => '',
        'menu_list_item_cls'    => '',
        'before_menu_drop_icon' => '',
        'menu_drop_icon'        => '',
        'has_dropdown_arrow_icon'  => false,
        'has_right_arrow_icon'        => false
    ]; 

    function __construct($settings = []) {

        if( is_array($settings) ) {
           $this->elementor_settings = wp_parse_args( $settings , $this->elementor_settings );
        }
      
    }
    
     /** 
    * get menu settings
    * @since 2024/01/17 
    **/
    public function get_item_meta($item_id)
    {

        $is_mega_menu   = get_post_meta( $item_id, '_menu_item_wcf_mega_menu_enable', true );           
        $full_width     = get_post_meta( $item_id, '_menu_item_wcf_mega_menu_fullwidth', true );           
        $content_id     = get_post_meta( $item_id, '_menu_item_wcf_mega_menu_tpl_id', true );    
   
        $default = [
            "menu_id"       => null,       
            "is_mega_menu"  => $is_mega_menu,          
            "content_id"    => $content_id,
            'fullwidth'     => $full_width
        ];

        return $default;
    }
    
    public function is_megamenu_item( $item_meta, $menu )
    {
        //wcf_mega_menu_post_item_mega_menu_enable
        if ($item_meta['is_mega_menu'] == 'on' && class_exists('Elementor\Plugin')) {
            return true;
        }

        return false;
    }
    /**
     * Starts the list before the elements are added.
     *
     * @see Walker::start_lvl()
     *
     * @since 3.0.0
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param int    $depth  Depth of menu item. Used for padding.
     * @param array  $args   An array of arguments. @see wp_nav_menu()
     */
    public function start_lvl( &$output, $depth = 0, $args = array() ) {
       
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\" dp-menu\">\n";
    }
    /**
     * Ends the list of after the elements are added.
     *
     * @see Walker::end_lvl()
     *
     * @since 3.0.0
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param int    $depth  Depth of menu item. Used for padding.
     * @param array  $args   An array of arguments. @see wp_nav_menu()
     */
    public function end_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";
    }
    /**
     * Start the element output.
     *
     * @see Walker::start_el()
     *
     * @since 3.0.0
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param object $item   Menu item data object.
     * @param int    $depth  Depth of menu item. Used for padding.
     * @param array  $args   An array of arguments. @see wp_nav_menu()
     * @param int    $id     Current item ID.
     */
    public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;
        
        $item_cls = get_post_meta( $item->ID, '_crowdyflow_theme_menu_item_cls', true );
        
        if($item_cls !=''){
            $classes[] = $item_cls; 
        }
        /**
         * Filter the CSS class(es) applied to a menu item's list item element.
         *
         * @since 3.0.0
         * @since 4.1.0 The `$depth` parameter was added.
         *
         * @param array  $classes The CSS classes that are applied to the menu item's `<li>` element.
         * @param object $item    The current menu item.
         * @param array  $args    An array of {@see wp_nav_menu()} arguments.
         * @param int    $depth   Depth of menu item. Used for padding.
         */
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
        // New
        $class_names .= ' nav-item';
        $item_meta = $this->get_item_meta($item->ID);
        $is_megamenu_item = $this->is_megamenu_item( $item_meta, $args->menu );
        
        if ($is_megamenu_item) {
            $class_names .= ' wcf-mg-has-megamenu';
        }
        
        if (in_array('menu-item-has-children', $classes)) {
            if($depth == 0){
                $class_names .= " dropdown";
            }else{
                $class_names .= " dropdown-submenu ";
            }
           
        }
        $submenu_indicator = '';
                
        if (in_array('current-menu-item', $classes)) {
            $class_names .= ' active';
        }
        //
        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
        
        /**
         * Filter the ID applied to a menu item's list item element.
         *
         * @since 3.0.1
         * @since 4.1.0 The `$depth` parameter was added.
         *
         * @param string $menu_id The ID that is applied to the menu item's `<li>` element.
         * @param object $item    The current menu item.
         * @param array  $args    An array of {@see wp_nav_menu()} arguments.
         * @param int    $depth   Depth of menu item. Used for padding.
         */
        $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth );
        $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
       
        $output .= $indent . '<li' . $id . $class_names .'>';
        $atts = array();
        $atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
        $atts['target'] = ! empty( $item->target )     ? $item->target     : '';
        $atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
        $atts['href']   = ! empty( $item->url )        ? $item->url        : '';
        // New
        if ($depth === 0) {
            $atts['class'] = 'nav-link';
        }
        if ($depth === 0 && in_array('menu-item-has-children', $classes)) {
            if($this->elementor_settings[ 'has_dropdown_arrow_icon' ] && $this->elementor_settings['custom_icon'] == '' ){
                $atts['class']       .= ' has-child dropdown__toggle'; 
            }else{
                $atts['class']       .= ' has-child dropdown__toggle remove-default-icon';
            }
            
            $atts['data-toggle']  = 'dropdown';
        }
        if($is_megamenu_item && $depth === 0){
            $atts['class']       .= ' remove-default-icon';
        }
        if ($depth > 0) {
            if( $this->elementor_settings[ 'has_right_arrow_icon' ] && $this->elementor_settings[ 'custom_icon' ] == ''){
                $manual_class = array_values($classes)[0] .' '. 'dropdown_items';
            }else{
                $manual_class = array_values($classes)[0] .' '. 'dropdown_items remove-default-icon';
            }
            
            $atts ['class']= $manual_class;
        }
        if (is_array($item->classes) && in_array('current-menu-item', $item->classes)) {
            $atts['class'] .= ' active';
        }
        // print_r($item);
        //
        /**
         * Filter the HTML attributes applied to a menu item's anchor element.
         *
         * @since 3.6.0
         * @since 4.1.0 The `$depth` parameter was added.
         *
         * @param array $atts {
         *     The HTML attributes applied to the menu item's `<a>` element, empty strings are ignored.
         *
         *     @type string $title  Title attribute.
         *     @type string $target Target attribute.
         *     @type string $rel    The rel attribute.
         *     @type string $href   The href attribute.
         * }
         * @param object $item  The current menu item.
         * @param array  $args  An array of {@see wp_nav_menu()} arguments.
         * @param int    $depth Depth of menu item. Used for padding.
         */
        $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );
        $attributes = '';
        foreach ( $atts as $attr => $value ) {
            if ( ! empty( $value ) ) {
                $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }
        
        $item_output = isset($args->before) ? $args->before : '';
        // New
        /*
        if ($depth === 0 && in_array('menu-item-has-children', $classes)) {
            $item_output .= '<a class="nav-link dropdown-toggle"' . $attributes .'data-toggle="dropdown">';
        } elseif ($depth === 0) {
            $item_output .= '<a class="nav-link"' . $attributes .'>';
        } else {
            $item_output .= '<a class="dropdown-item"' . $attributes .'>';
        }
        */
        //
        $item_output .= '<a'. $attributes .'>';
        /** This filter is documented in wp-includes/post-template.php */
        $link_before = isset($args->link_before) ? $args->link_before : '' ;
        $link_after = isset($args->link_after) ? $args->link_after : '' ;
        $item_output .= $link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $link_after;
        if ( $this->elementor_settings['has_dropdown_arrow_icon'] && $depth === 0 && in_array('menu-item-has-children', $classes) || ($depth === 0 && $is_megamenu_item)) {
            $item_output .= arolax_render_elementor_icons( $this->elementor_settings['menu_down_icon'] );
        }
        
        if ( $this->elementor_settings['has_right_arrow_icon'] && $depth > 0 && in_array('menu-item-has-children', $classes)) {
            $item_output .= arolax_render_elementor_icons( $this->elementor_settings['menu_right_icon'] );
        }
        $item_output .= $submenu_indicator . '</a>';
        $item_output .= '</a>';
        $item_output .= isset($args->after) ? $args->after : '';
        /**
         * Filter a menu item's starting output.
         *
         * The menu item's starting output only includes `$args->before`, the opening `<a>`,
         * the menu item's title, the closing `</a>`, and `$args->after`. Currently, there is
         * no filter for modifying the opening and closing `<li>` for a menu item.
         *
         * @since 3.0.0
         *
         * @param string $item_output The menu item's starting HTML output.
         * @param object $item        Menu item data object.
         * @param int    $depth       Depth of menu item. Used for padding.
         * @param array  $args        An array of {@see wp_nav_menu()} arguments.
         */
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
    /**
     * Ends the element output, if needed.
     *
     * @see Walker::end_el()
     *
     * @since 3.0.0
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param object $item   Page data object. Not used.
     * @param int    $depth  Depth of page. Not Used.
     * @param array  $args   An array of arguments. @see wp_nav_menu()
     */
    public function end_el(&$output, $item, $depth = 0, $args = array())
    {
       if ($depth === 0) {
                $item_meta = $this->get_item_meta($item->ID);
                if ($item_meta['is_mega_menu'] == 'on' && class_exists('Elementor\Plugin')) {   
                    $elementClass = 'mega_menu wcf-mg-megamenu-section ';
                  
                    if($item_meta['fullwidth'] == 'on'){
                        $elementClass .= 'fullwidth ';
                    }
                    $elementClass .= $this->elementor_settings['entrance_animation'];                    
                    $output .= sprintf('<div class="%s">', $elementClass);
                    
                    $elementor_page = get_post_meta( $item_meta['content_id'] , '_elementor_edit_mode', true );
                    if ($item_meta['content_id'] != '' && $elementor_page) {
                        $elementor = \Elementor\Plugin::instance();
                        $output .= $elementor->frontend->get_builder_content_for_display($item_meta['content_id']);                       
                    } else {
                        if( current_user_can('editor') || current_user_can('administrator') ) {    
                            $elementor_link = add_query_arg( [ 'action' => 'elementor' , 'wcf-edit' => 1 ], get_edit_post_link( $item_meta['content_id'] ) );
                            $no_content = sprintf('<div class="wcf--mega-menu-empty-content">
                                <h2>%s</h2>                           
                                <a target="_blank" href="%s" class="wcf--editemptybutton">
                                  <svg class="svg-icon" fill="none" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><g stroke="#a649da" stroke-linecap="round" stroke-width="2"><path d="m20 20h-16"></path><path clip-rule="evenodd" d="m14.5858 4.41422c.781-.78105 2.0474-.78105 2.8284 0 .7811.78105.7811 2.04738 0 2.82843l-8.28322 8.28325-3.03046.202.20203-3.0304z" fill-rule="evenodd"></path></g></svg>
                                  <span class="editemptylable">%s</span>
                                </a>
                            </div>',
                            esc_html__('No content found', 'arolax-essential'),
                            $elementor_link,
                            esc_html__('Edit Content', 'arolax-essential'),
                            );
                            $output .= $no_content;
                        }
                    }
                    $output .= '</div>';
                } // end if          
            $output .= "</li>\n";
        }
    }

    	/**
	 * Menu Fallback
	 * =============
	 * If this function is assigned to the wp_nav_menu's fallback_cb variable
	 * and a manu has not been assigned to the theme location in the WordPress
	 * menu manager the function with display nothing to a non-logged in user,
	 * and will add a link to the WordPress menu manager if logged in as an admin.
	 *
	 * @param array $args passed from the wp_nav_menu function.
	 *
	 */
	public static function fallback( $args ) {
        
		if ( current_user_can( 'manage_options' ) ) {
			extract( $args );
			$fb_output = null;
			if ( $container ) {
				$fb_output = '<' . $container;
				if ( $container_id ) {
					$fb_output .= ' id="' . $container_id . '"';
				}
				if ( $container_class ) {
					$fb_output .= ' class="menu-fallback ' . $container_class . '"';
				}
				$fb_output .= '>';
			}
			$fb_output .= '<ul';
			if ( $menu_id ) {
				$fb_output .= ' id="' . $menu_id . '"';
			}
			if ( $menu_class ) {
				$fb_output .= ' class="' . $menu_class . '"';
			}
			$fb_output .= '>';
			$fb_output .= '<li><a href="' . admin_url( 'nav-menus.php' ) . '">Add a menu</a></li>';
			$fb_output .= '</ul>';
			if ( $container ) {
				$fb_output .= '</' . $container . '>';
			}
			echo arolax_return( $fb_output );
		}
	}

}