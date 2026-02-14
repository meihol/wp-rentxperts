<?php

namespace ArolaxEssentialApp;

use Elementor\Plugin as ElementorPlugin;
use ArolaxEssentialApp\PageSettings\Page_Settings;


/**
 * Class Plugin
 *
 * Main Plugin class
 * @since 1.2.0
 */
class Plugin {

	/**
	 * Instance
	 *
	 * @since 1.2.0
	 * @access private
	 * @static
	 *
	 * @var Plugin The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @return Plugin An instance of the class.
	 * @since 1.2.0
	 * @access public
	 *
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	/**
	 * widget_scripts
	 *
	 * Load required plugin core files.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function after_register_styles() {
		wp_register_style( 'arolax-header-preset', AROLAX_ESSENTIAL_ASSETS_URL . 'css/header-preset.css' );
		wp_register_style( 'arolax-landing-page', AROLAX_ESSENTIAL_ASSETS_URL . 'css/landing-page.css', array(), '0.1.0', 'all' );
		wp_register_style( 'arolax-header-offcanvas', AROLAX_ESSENTIAL_ASSETS_URL . 'css/offcanvas.css' );

	}

	public function widget_scripts() {

		wp_register_script(
			'wcf-lottie-player',
			AROLAX_ESSENTIAL_ASSETS_URL . 'js/lottie-player.js',
			//'https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js',
			[],
			false,
			true
		);
		wp_register_script(
			'wcf-lottie-interactivity',
			AROLAX_ESSENTIAL_ASSETS_URL . 'js/lottie-interactivity.min.js',
			//'https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js',
			[],
			false,
			true
		);
		wp_register_script( 'wcf-lottie', AROLAX_ESSENTIAL_ASSETS_URL . 'js/widgets/lottie.js', [
			'wcf-lottie-player',
			'wcf-lottie-interactivity'
		], false, true );
		wp_register_script( 'wcf-offcanvas-menu', AROLAX_ESSENTIAL_ASSETS_URL . '/js/widgets/offcanvas-menu.js', [ 'jquery' ], false, true );
		wp_register_script( 'wcf-sticky-container', AROLAX_ESSENTIAL_ASSETS_URL . 'js/elementor.sticky-section.js', [ 'jquery' ], false, true );
		wp_register_script( 'meanmenu', plugins_url( '/assets/js/jquery.meanmenu.min.js', __FILE__ ), array( 'jquery' ), false, true );
		wp_register_script( 'arolax-essential--global-core', plugins_url( '/assets/js/wcf--global-core.min.js', __FILE__ ), [ 'jquery' ], false, true );
		wp_register_script( 'wcf-landing-page', AROLAX_ESSENTIAL_ASSETS_URL . '/js/widgets/landing-page.js', [ 'jquery' ], false, true );

		$data = [
			'ajaxUrl'  => admin_url( 'admin-ajax.php' ),
			'_wpnonce' => wp_create_nonce( 'arolax--addons-frontend' )
		];
		wp_localize_script( 'arolax-essential--global-core', 'AROLAX_ADDONS_JS', $data );
		wp_enqueue_script( 'arolax-essential--global-core' );

	}

	/**
	 * Editor scripts
	 *
	 * Enqueue plugin javascripts integrations for Elementor editor.
	 *
	 * @since 1.2.1
	 * @access public
	 */
	public function editor_scripts() {
		add_filter( 'script_loader_tag', [ $this, 'editor_scripts_as_a_module' ], 10, 2 );

		wp_enqueue_script(
			'wcf--elementor--editor',
			plugins_url( '/assets/js/editor/editor.js', __FILE__ ),
			[
				'elementor-editor',
			],
			time(),
			true
		);
	}

	/**
	 * Force load editor script as a module
	 *
	 * @param string $tag
	 * @param string $handle
	 *
	 * @return string
	 * @since 1.2.1
	 *
	 */
	public function editor_scripts_as_a_module( $tag, $handle ) {
		if ( 'wcf--elementor--editor' === $handle ) {
			$tag = str_replace( '<script', '<script type="module"', $tag );
		}

		return $tag;
	}

	/**
	 * Register Widgets
	 *
	 * Register new Elementor widgets.
	 *
	 * @param Widgets_Manager $widgets_manager Elementor widgets manager.
	 *
	 * @since 1.2.0
	 * @access public
	 *
	 */
	public function register_widgets( $widgets_manager ) {

		//@todo need follow the convention to create widget file
		foreach ( self::get_widgets() as $slug => $data ) {

			// If upcoming don't register.
			if ( $data['is_upcoming'] ) {
				continue;
			}

			if ( $data['is_active'] ) {
				if ( is_dir( __DIR__ . '/widgets/' . $slug ) ) {
					require_once( __DIR__ . '/widgets/' . $slug . '/' . $slug . '.php' );
				} else {
					require_once( __DIR__ . '/widgets/' . $slug . '.php' );
				}


				$class = explode( '-', $slug );
				$class = array_map( 'ucfirst', $class );
				$class = implode( '_', $class );
				$class = 'ArolaxEssentialApp\\Widgets\\' . $class;
				ElementorPlugin::instance()->widgets_manager->register( new $class() );
			}
		}

	}

	/**
	 * Get Widgets List.
	 *
	 * @return array
	 */
	public static function get_widgets() {

		return apply_filters( 'arolax-essential/widgets', [
			'header-menu'              => [
				'label'       => __( 'WCF Navigation', 'arolax-essential' ),
				'is_active'   => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],
			'header-preset'            => [
				'label'       => __( 'WCF Header', 'arolax-essential' ),
				'is_active'   => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],
			'footer-menu'              => [
				'label'       => __( 'WCF Footer Navigation', 'arolax-essential' ),
				'is_active'   => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],
			'banner-breadcrumb'        => [
				'label'       => __( 'WCF Banner Breadcrumb', 'arolax-essential' ),
				'is_active'   => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],
			'blog-post-tags'           => [
				'label'       => __( 'WCF Post Tags', 'arolax-essential' ),
				'is_active'   => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],
			'dropdown'                 => [
				'label'       => __( 'WCF Dropdown', 'arolax-essential' ),
				'is_active'   => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],
			'wc-cart-count'            => [
				'label'       => __( 'WCF Cart Count', 'arolax-essential' ),
				'is_active'   => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],
			'offcanvas-menu'           => [
				'label'       => __( 'WCF Offcanvas Menu', 'arolax-essential' ),
				'is_active'   => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],
			'landing-page'             => [
				'label'       => __( 'WCF Landing', 'arolax-essential' ),
				'is_active'   => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],
			'lottie'                   => [
				'label'       => __( 'WCF Lottie', 'arolax-essential' ),
				'is_active'   => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],
			'arolax-button'            => [
				'label'       => __( 'Arolax Button', 'arolax-essential' ),
				'is_active'   => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],
			'arolax-testimonial'       => [
				'label'       => __( 'Arolax Testimonial', 'arolax-essential' ),
				'is_active'   => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],
			'arolax-testimonial-2'     => [
				'label'       => __( 'Arolax Testimonial 2', 'arolax-essential' ),
				'is_active'   => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],
			'arolax-video-testimonial' => [
				'label'       => __( 'Arolax Video Testimonial', 'arolax-essential' ),
				'is_active'   => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],
			'arolax-posts'             => [
				'label'       => __( 'Arolax Posts', 'arolax-essential' ),
				'is_active'   => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],
			'arolax-video-slider'      => [
				'label'       => __( 'Arolax Video Slider', 'arolax-essential' ),
				'is_active'   => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],
			'arolax-service'           => [
				'label'       => __( 'Arolax Service', 'arolax-essential' ),
				'is_active'   => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],
			'arolax-service-slider'    => [
				'label'       => __( 'Arolax Service Slider', 'arolax-essential' ),
				'is_active'   => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],
			'arolax-case-study-slider' => [
				'label'       => __( 'Arolax Case Study Slider', 'arolax-essential' ),
				'is_active'   => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],
			'arolax-tabs'              => [
				'label'       => __( 'Arolax Tabs', 'arolax-essential' ),
				'is_active'   => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],
			'arolax-gallery'           => [
				'label'       => __( 'Arolax Gallery', 'arolax-essential' ),
				'is_active'   => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],
			'arolax-video'             => [
				'label'       => __( 'Arolax Video', 'arolax-essential' ),
				'is_active'   => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],
			'wcf-line'                 => [
				'label'       => __( 'WCF Line', 'arolax-essential' ),
				'is_active'   => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],
			'arolax-progressbar'       => [
				'label'       => __( 'Arolax Progressbar', 'arolax-essential' ),
				'is_active'   => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],
			'arolax-side-header'       => [
				'label'       => __( 'Arolax Side Header', 'arolax-essential' ),
				'is_active'   => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],
			'arolax-toggle-select'     => [
				'label'       => __( 'Arolax Toggle Select', 'arolax-essential' ),
				'is_active'   => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],
			'image-generator'          => [
				'label'       => __( 'Image Generator', 'arolax-essential' ),
				'is_active'   => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],

			'arolax-draggable-item' => [
				'label'       => __( 'Arolax Draggable Item', 'arolax-essential' ),
				'is_active'   => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],
			'arolax-brand-slider'   => [
				'label'       => __( 'Arolax Brand Slider', 'arolax-essential' ),
				'is_active'   => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],
			'advance-slider'        => [
				'label'       => __( 'Advance Slider', 'arolax-essential' ),
				'is_active'   => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],

			'arolax-project-slider'    => [
				'label'       => __( 'Arolax Project Slider', 'helo-essential' ),
				'is_active'   => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],

		] );
	}

	/**
	 * Add page settings controls
	 *
	 * Register new settings for a document page settings.
	 *
	 * @since 1.2.1
	 * @access private
	 */
	private function add_page_settings_controls() {
		require_once( __DIR__ . '/page-settings/manager.php' );
		new Page_Settings();
	}

	function add_elementor_widget_categories( $elements_manager ) {

		$elements_manager->add_category(
			'weal-coder-addon',
			[
				'title' => esc_html__( 'WCF', 'arolax-essential' ),
				'icon'  => 'fa fa-plug',
			]
		);

		$elements_manager->add_category(
			'wcf-blog-single',
			[
				'title' => esc_html__( 'WCF Single', 'arolax-essential' ),
				'icon'  => 'fa fa-plug',
			]
		);

		$elements_manager->add_category(
			'wcf-blog-search',
			[
				'title' => esc_html__( 'WCF Blog Search', 'arolax-essential' ),
				'icon'  => 'fa fa-plug',
			]
		);

	}

	public function elementor_init() {
		// Its is now safe to include Widgets skins
		require_once( __DIR__ . '/skin//accordion.php' );
		require_once( __DIR__ . '/skin//accordion-two.php' );
		require_once( __DIR__ . '/widgets/image-generator/image-generator-handler.php' );
		// Register skin
		add_action( 'elementor/widget/accordion/skins_init', function ( $widget ) {
			$widget->add_skin( new Skin\Accordion\Skin_Accordion( $widget ) );
			$widget->add_skin( new Skin\Accordion\Skin_Accordion_Two( $widget ) );
		} );
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
		add_action( 'elementor/elements/categories_registered', [ $this, 'add_elementor_widget_categories' ], 12 );
		// Register widget scripts
		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'widget_scripts' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'after_register_styles' ], 12 );


		// Register widgets
		add_action( 'elementor/widgets/register', [ $this, 'register_widgets' ] );

		// Register editor scripts
		add_action( 'elementor/editor/after_enqueue_scripts', [ $this, 'editor_scripts' ] );

		$this->add_page_settings_controls();
		add_action( 'elementor/init', [ $this, 'elementor_init' ], 0 );
	}

}

// Instantiate Plugin Class
Plugin::instance();
