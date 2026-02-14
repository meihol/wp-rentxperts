<?php

namespace WCFAddonsPro\Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
class Animation_Builder {

    private static $instance = null;
	public $page_type = null;
	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @return Plugin An instance of the class.
	 * @since 1.2.0
	 * @access public
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	} 
	
	/**
	 *  Plugin class constructor
	 *
	 * Register plugin action hooks and filters
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function __construct() {
	
		add_filter('show_admin_bar', [$this,'hide_admin_bar_for_iframe']);
		add_action('wp', [$this,'init']);
		add_action('animation/builder/before_enqueue_scripts', [$this,'editor_script']);
		add_action('animation/builder/before_enqueue_styles', [$this,'editor_style']);
		add_action('animation/builder/editor/footer', [$this,'loader_footer_style']);
		add_filter( 'wcf_animation_builder_body_class', [$this,'editor_classes'] );
	    
	}
	public function setPageType($obj){
		$this->page_type = $obj;
	}
	public function init(){
	
		$animation_builder = get_query_var('aae_builder');
		if ( $animation_builder == '' ) {
			return;
		}
		
		add_filter( 'show_admin_bar', '__return_false' );

		// Remove all WordPress actions
		remove_all_actions( 'wp_head' );
		remove_all_actions( 'wp_print_styles' );
		remove_all_actions( 'wp_print_head_scripts' );
		remove_all_actions( 'wp_footer' );

		// Handle `wp_head`
		add_action( 'wp_head', 'wp_enqueue_scripts', 1 );
		add_action( 'wp_head', 'wp_print_styles', 8 );
		add_action( 'wp_head', 'wp_print_head_scripts', 9 );
		add_action( 'wp_head', 'wp_site_icon' );
		add_action( 'wp_head', [ $this, 'editor_head_trigger' ], 30 );

		// Handle `wp_footer`
		add_action( 'wp_footer', 'wp_print_footer_scripts', 20 );
		add_action( 'wp_footer', 'wp_auth_check_html', 30 );
		add_action( 'wp_footer', [ $this, 'wp_footer' ] );

		// Handle `wp_enqueue_scripts`
		remove_all_actions( 'wp_enqueue_scripts' );
		
		// Also remove all scripts hooked into after_wp_tiny_mce.
		remove_all_actions( 'after_wp_tiny_mce' );
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ], 999999 );
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_styles' ], 999999 );
	}
	
	function editor_classes( $classes ) {
		$class = array_merge($classes,['wcfab2025', 'wcf-animation-builder-editor']);
		return $class;
	}

	public function loader_footer_style(){
		echo "<style>#wp-auth-check-wrap{display:none;}</style>";
	}
	
		/**
	 * Enqueue styles.
	 *
	 * Registers all the editor styles and enqueues them.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function enqueue_styles() {
		/**
		 * Before editor enqueue styles.
		 *
		 * Fires before Animation editor styles are enqueued.
		 *
		 * @since 1.0.0
		 */
		do_action( 'animation/builder/before_enqueue_styles' );		
	}
	
	public function enqueue_scripts() {
		remove_action( 'wp_enqueue_scripts', [ $this, __FUNCTION__ ], 999999 );

		global $wp_styles, $wp_scripts;

		// Reset global variable
		$wp_styles = new \WP_Styles(); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
		$wp_scripts = new \WP_Scripts(); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited

		/**
		 * Before editor enqueue scripts.
		 *
		 * Fires before Animation Builder editor scripts are enqueued.
		 *
		 * @since 1.0.0
		 */
		do_action( 'animation/builder/before_enqueue_scripts' );

	}
	
	/**
	 * WP footer.
	 *
	 * Prints Elementor editor with all the editor templates, and render controls,
	 * widgets and content elements.
	 *
	 * Fired by `wp_footer` action.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function wp_footer() {
	
		/**
		 * Elementor editor footer.
		 *
		 * Fires on Elementor editor before closing the body tag.
		 *
		 * Used to prints scripts or any other HTML before closing the body tag.
		 *
		 * @since 1.0.0
		 */
		do_action( 'animation/builder/editor/footer' );
	}
	
	public function editor_head_trigger() {
		/**
		 * Animation Builder editor head.
		 *
		 * Fires on Animation Builder editor head tag.
		 *
		 * Used to prints scripts or any other data in the head tag.
		 *
		 * @since 1.0.0
		 */
		do_action( 'animation/builder/editor/wp_head' );
	}
	function hide_admin_bar_for_iframe($show_admin_bar) {
		// Check if the 'iframe' query parameter is set
		if ($this->is_edit_mode()) {
			return false; // Disable admin bar
		}
		return $show_admin_bar;
	}
	
	
    public function is_edit_mode(  ) {
    
		if (isset($_GET['action']) && $_GET['action'] == 'animation-builder') {			
		    return true;
		}

		return false;
	}
	
	public function editor_style() {
		wp_enqueue_style( 'wcf-pro-animation-builder', WCF_ADDONS_PRO_URL . 'assets/build/modules/animation-builder/main.css' );
	}
	public function editor_script() {
		
		wp_enqueue_script( 'wcf-pro-animation-builder', WCF_ADDONS_PRO_URL . 'assets/build/modules/animation-builder/main.js', array(
			'react', 'react-dom', 'wp-dom-ready', 'wp-element'
		), WCF_ADDONS_PRO_VERSION, true );
		
		$url = isset($_GET['builder_url']) ? $_GET['builder_url'] : home_url('/');
		
		$final_url = add_query_arg( array(
			'action' => 'animation-builder',            
		), $url );
		
		
		$localize_data = apply_filters('wcf/animation/builder/editor/data' ,[
			'ajaxurl'    => admin_url( 'admin-ajax.php' ),
			'nonce'      => wp_create_nonce( 'wcf_admin_nonce' ),
			'id'         => get_the_id(),
			'iframe_url' => esc_url( $final_url )
		]);
		
		wp_localize_script( 'wcf-pro-animation-builder', 'WCF_ADDONS_ANIMATION_BUILDER', $localize_data );	

	}	

	
}  