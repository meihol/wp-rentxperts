<?php

namespace WCFAddonsPro;

use Elementor\Plugin as ElementorPlugin;
use WCF_ADDONS\Plugin as WCFAddonsPlugin;

/**
 * Class Plugin
 *
 * Main Plugin class
 *
 * @since 1.2.0
 */
class Plugin {

	/**
	 * Instance
	 *
	 * @since 1.0.0
	 * @access private
	 * @static
	 *
	 * @var Plugin The single instance of the class.
	 */
	private static $instance = null;

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
	 * Widget_scripts
	 *
	 * Load required plugin core files.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function widget_scripts() {

		$dashb2 = get_option( 'wcf_extension_dashboardv2' );
		foreach ( self::get_library_scripts() as $key => $script ) {
			wp_register_script( $script['handler'], plugins_url( '/assets/lib/' . $script['src'], __FILE__ ), $script['dep'], $script['version'], $script['arg'] );

			if ( ! $dashb2 ) {
				wp_enqueue_script( $script['handler'] );
			}
		}

		if ( $dashb2 ) {

			if ( wcf_addons_get_settings( 'wcf_save_extensions', 'gsap-extensions' ) ) {
				wp_enqueue_script( 'gsap' );
			}

			if ( wcf_addons_get_settings( 'wcf_save_extensions', 'wcf-smooth-scroller' ) ) {
				wp_enqueue_script( 'scrollSmoother' );
				wp_enqueue_script( 'split-text' );
				wp_enqueue_script( 'scrollTrigger' );
				wp_enqueue_script( 'scrollTo' );
			}

			if ( wcf_addons_get_settings( 'wcf_save_extensions', 'scroll-trigger' ) ) {
				wp_enqueue_script( 'scrollTrigger' );
				wp_enqueue_script( 'scrollTo' );
			}
			if ( wcf_addons_get_settings( 'wcf_save_extensions', 'flip-extension' ) ) {
				wp_enqueue_script( 'flip' );
			}
		}


		//widget scripts
		foreach ( self::get_widget_scripts() as $key => $script ) {
			wp_register_script( $script['handler'], plugins_url( '/assets/js/' . $script['src'], __FILE__ ), $script['dep'], $script['version'], $script['arg'] );
		}

		wp_enqueue_script( 'wcf--addons-pro' );
		wp_enqueue_script( 'wcf--addons-ex' );
	}

	/**
	 * Function widget_styles
	 *
	 * Load required plugin core files.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public static function widget_styles() {
		//widget style
		wp_register_style( 'wcf-animbuilder-class-selector', plugins_url( '/assets/css/animbuilder-copy.css', __FILE__ ), [], time() );
		foreach ( self::get_widget_style() as $key => $style ) {
			wp_register_style( $style['handler'], plugins_url( '/assets/css/' . $style['src'], __FILE__ ), $style['dep'], $style['version'], $style['media'] );

		}

		wp_enqueue_style( 'wcf--addons-pro' );
		wp_enqueue_style( 'wcf--addons-ex' );
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
		wp_enqueue_script( 'wcf-addon-pro-editor', plugins_url( '/assets/js/editor.js', __FILE__ ), [
			'elementor-editor',
		], WCF_ADDONS_VERSION, true );

		$data = apply_filters( 'wcf-addons-pro-editor/js/data', [

		] );

		wp_localize_script( 'wcf-addon-pro-editor', 'WCF_Addons_Pro_Editor', $data );
	}

	/**
	 * Function widget_scripts
	 *
	 * Load required plugin core files.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public static function get_widget_scripts() {
		return [
			'wcf-addons-core'    => [
				'handler' => 'wcf--addons-pro',
				'src'     => 'wcf-addons-pro.js',
				'dep'     => [ 'wcf--addons' ],
				'version' => false,
				'arg'     => true,
			],
			'filterable-slider'  => [
				'handler' => 'wcf--filterable-slider',
				'src'     => 'filterable-slider.js',
				'dep'     => [],
				'version' => false,
				'arg'     => true,
			],
			'filterable-posts'   => [
				'handler' => 'wcf--filterable-posts',
				'src'     => 'filterable-posts.js',
				'dep'     => [],
				'version' => false,
				'arg'     => true,
			],
			'advance-accordion'  => [
				'handler' => 'wcf--a-accordion',
				'src'     => 'advance-accordion.js',
				'dep'     => [],
				'version' => false,
				'arg'     => true,
			],
			'animated-offcanvas' => [
				'handler' => 'wcf--animated-offcanvas',
				'src'     => 'animated-offcanvas.js',
				'dep'     => [],
				'version' => false,
				'arg'     => true,
			],
			'wcf-lottie'         => [
				'handler' => 'wcf-lottie',
				'src'     => 'lottie.js',
				'dep'     => [ 'lottie', 'lottie-interactivity' ],
				'version' => false,
				'arg'     => true,
			],

			'wcf--post-reactions' => [
				'handler' => 'wcf--post-reactions',
				'src'     => 'post-reactions.js',
				'dep'     => [],
				'version' => false,
				'arg'     => true,
			],
			'wcf-posts'           => [
				'handler' => 'wcf--posts',
				'src'     => 'post.js',
				'dep'     => [],
				'version' => false,
				'arg'     => true,
			],
			'wcf-addons-ex'       => [
				'handler' => 'wcf--addons-ex',
				'src'     => 'wcf-addons-ex.js',
				'dep'     => [],
				'version' => false,
				'arg'     => true,
			],
			'portfolio'           => [
				'handler' => 'wcf--portfolio',
				'src'     => 'portfolio.js',
				'dep'     => [],
				'version' => false,
				'arg'     => true,
			],
			'mailchimp'           => [
				'handler' => 'wcf--mailchimp',
				'src'     => 'mailchimp.js',
				'dep'     => [],
				'version' => false,
				'arg'     => true,
			],
			'posts-slider'        => [
				'handler' => 'wcf--posts-slider',
				'src'     => 'posts-slider.js',
				'dep'     => [],
				'version' => false,
				'arg'     => true,
			],
			'category-slider'        => [
				'handler' => 'wcf--category-slider',
				'src'     => 'category-slider.js',
				'dep'     => [],
				'version' => false,
				'arg'     => true,
			],
			'video-story'         => [
				'handler' => 'aae-video-story',
				'src'     => 'video-story.js',
				'dep'     => [],
				'version' => false,
				'arg'     => true,
			],

			'breaking-news-slider' => [
				'handler' => 'wcf--breaking-news-slider',
				'src'     => 'breaking-news-slider.js',
				'dep'     => [],
				'version' => false,
				'arg'     => true,
			],
			'aae-filtering'        => [
				'handler' => 'aae--filtering',
				'src'     => 'filtering.js',
				'dep'     => [],
				'version' => false,
				'arg'     => true,
			],

			'post-rating' => [
				'handler' => 'aae-post-rating',
				'src'     => 'post-rating.js',
				'dep'     => [],
				'version' => false,
				'arg'     => true,
			],
		];
	}

	/**
	 * Function lib_scripts
	 *
	 * Load required plugin core files.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public static function get_library_scripts() {

		if ( ! get_option( 'wcf_save_extensions' ) ) {
			return [];
		}

		$scripts = [
			'gsap'                 => [
				'handler' => 'gsap',
				'src'     => 'gsap.min.js',
				'dep'     => [ 'wp-mediaelement' ],
				'version' => false,
				'arg'     => true,
			],
			'scroll-smoother'      => [
				'handler' => 'scrollSmoother',
				'src'     => 'ScrollSmoother.min.js',
				'dep'     => [ 'gsap' ],
				'version' => false,
				'arg'     => true,
			],
			'scroll-to'            => [
				'handler' => 'scrollTo',
				'src'     => 'ScrollToPlugin.min.js',
				'dep'     => [ 'gsap' ],
				'version' => false,
				'arg'     => true,
			],
			'flip'                 => [
				'handler' => 'flip',
				'src'     => 'Flip.min.js',
				'dep'     => [ 'gsap' ],
				'version' => false,
				'arg'     => true,
			],
			'scroll-trigger'       => [
				'handler' => 'scrollTrigger',
				'src'     => 'ScrollTrigger.min.js',
				'dep'     => [ 'gsap' ],
				'version' => false,
				'arg'     => true,
			],
			'split-text'           => [
				'handler' => 'split-text',
				'src'     => 'SplitText.min.js',
				'dep'     => [ 'gsap' ],
				'version' => false,
				'arg'     => true,
			],
			'lottie'               => [
				'handler' => 'lottie',
				'src'     => 'lottie-player.js',
				'dep'     => [],
				'version' => false,
				'arg'     => true,
			],
			'lottie-interactivity' => [
				'handler' => 'lottie-interactivity',
				'src'     => 'lottie-interactivity.min.js',
				'dep'     => [],
				'version' => false,
				'arg'     => true,
			],
			'effect-panorama'      => [
				'handler' => 'effect--panorama',
				'src'     => 'effect-panorama.min.js',
				'dep'     => [],
				'version' => false,
				'arg'     => true,
			],
		];


		if ( ! defined( 'WCF_ADDONS_DASHBOARD_V2' ) ) {

			if ( ! wcf_addons_get_settings( 'wcf_save_extensions', 'wcf-gsap' ) ) {
				unset( $scripts['gsap'] );
			}

			if ( ! wcf_addons_get_settings( 'wcf_save_extensions', 'wcf-smooth-scroller' ) ) {
				unset( $scripts['scroll-smoother'] );
			}
		}

		return $scripts;
	}

	/**
	 * Function widget_style
	 *
	 * Load required plugin core files.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public static function get_widget_style() {
		return [
			'wcf-addons-pro'        => [
				'handler' => 'wcf--addons-pro',
				'src'     => 'wcf-addons-pro.css',
				'dep'     => [],
				'version' => false,
				'media'   => 'all',
			],
			'advance-pricing-table' => [
				'handler' => 'wcf--advance-pricing-table',
				'src'     => 'widgets/advance-pricing-table.css',
				'dep'     => [],
				'version' => false,
				'media'   => 'all',
			],
			'advance-portfolio'     => [
				'handler' => 'wcf--advance-portfolio',
				'src'     => 'widgets/advance-portfolio.css',
				'dep'     => [],
				'version' => false,
				'media'   => 'all',
			],
			'scroll-elements'       => [
				'handler' => 'wcf--scroll-elements',
				'src'     => 'widgets/scroll-elements.css',
				'dep'     => [],
				'version' => false,
				'media'   => 'all',
			],
			'toggle-switcher'       => [
				'handler' => 'wcf--toggle-switch',
				'src'     => 'widgets/toggle-switch.css',
				'dep'     => [],
				'version' => false,
				'media'   => 'all',
			],
			'filterable-gallery'    => [
				'handler' => 'wcf--filterable-gallery',
				'src'     => 'widgets/filterable-gallery.css',
				'dep'     => [],
				'version' => false,
				'media'   => 'all',
			],
			'table-of-content'      => [
				'handler' => 'wcf--table-of-content',
				'src'     => 'widgets/table-of-content.css',
				'dep'     => [],
				'version' => false,
				'media'   => 'all',
			],
			'image-accordion'       => [
				'handler' => 'wcf--image-accordion',
				'src'     => 'widgets/image-accordion.css',
				'dep'     => [],
				'version' => false,
				'media'   => 'all',
			],
			'author-box'            => [
				'handler' => 'wcf--author-box',
				'src'     => 'widgets/author-box.css',
				'dep'     => [],
				'version' => false,
				'media'   => 'all',
			],
			'flip-box'              => [
				'handler' => 'wcf--flip-box',
				'src'     => 'widgets/flip-box.css',
				'dep'     => [],
				'version' => false,
				'media'   => 'all',
			],

			'filterable-slider'  => [
				'handler' => 'wcf--filterable-slider',
				'src'     => 'widgets/filterable-slider.css',
				'dep'     => [],
				'version' => false,
				'media'   => 'all',
			],
			'advance-accordion'  => [
				'handler' => 'wcf--a-accordion',
				'src'     => 'widgets/advance-accordion.css',
				'dep'     => [],
				'version' => false,
				'media'   => 'all',
			],
			'animated-offcanvas' => [
				'handler' => 'wcf--animated-offcanvas',
				'src'     => 'widgets/animated-offcanvas.css',
				'dep'     => [],
				'version' => false,
				'media'   => 'all',
			],
			'posts-reaction'     => [
				'handler' => 'wcf--post-reactions',
				'src'     => 'widgets/post-reaction.css',
				'dep'     => [],
				'version' => false,
				'media'   => 'all',
			],
			'posts-pro'          => [
				'handler' => 'wcf--post-pro',
				'src'     => 'widgets/posts.css',
				'dep'     => [],
				'version' => false,
				'media'   => 'all',
			],
			'posts-filterable'   => [
				'handler' => 'wcf--filterable-posts',
				'src'     => 'widgets/filterable-posts.css',
				'dep'     => [],
				'version' => false,
				'media'   => 'all',
			],
			'grid-hover-posts'   => [
				'handler' => 'wcf--grid-hover-posts',
				'src'     => 'widgets/grid-hover-posts.css',
				'dep'     => [],
				'version' => false,
				'media'   => 'all',
			],
			'wcf-addons-ex'      => [
				'handler' => 'wcf--addons-ex',
				'src'     => 'wcf-addons-ex.css',
				'dep'     => [],
				'version' => false,
				'media'   => 'all',
			],
			'category-showcase'  => [
				'handler' => 'wcf--category-showcase',
				'src'     => 'widgets/category-showcase.css',
				'dep'     => [],
				'version' => false,
				'media'   => 'all',
			],
			'video-box'          => [
				'handler' => 'wcf--video-box',
				'src'     => 'widgets/video-box.css',
				'dep'     => [],
				'version' => false,
				'media'   => 'all',
			],
			'video-box-slider'   => [
				'handler' => 'wcf--video-box-slider',
				'src'     => 'widgets/video-box-slider.css',
				'dep'     => [],
				'version' => false,
				'media'   => 'all',
			],
			'mailchimp'          => [
				'handler' => 'wcf--mailchimp',
				'src'     => 'widgets/mailchimp.css',
				'dep'     => [],
				'version' => false,
				'media'   => 'all',
			],
			'portfolio'          => [
				'handler' => 'wcf--portfolio',
				'src'     => 'widgets/portfolio.css',
				'dep'     => [],
				'version' => false,
				'media'   => 'all',
			],
			'video-mask'         => [
				'handler' => 'wcf--video-mask',
				'src'     => 'widgets/video-mask.css',
				'dep'     => [],
				'version' => false,
				'media'   => 'all',
			],

			'posts-slider' => [
				'handler' => 'wcf--posts-slider',
				'src'     => 'widgets/posts-slider.css',
				'dep'     => [],
				'version' => false,
				'media'   => 'all',
			],

			'video-story' => [
				'handler' => 'aae-video-story',
				'src'     => 'widgets/video-story.css',
				'dep'     => [],
				'version' => false,
				'media'   => 'all',
			],

			'breaking-news-slider' => [
				'handler' => 'wcf--breaking-news-slider',
				'src'     => 'widgets/breaking-news-slider.css',
				'dep'     => [],
				'version' => false,
				'media'   => 'all',
			],

			'post-rating' => [
				'handler' => 'aae-post-rating',
				'src'     => 'widgets/post-rating.css',
				'dep'     => [],
				'version' => false,
				'media'   => 'all',
			]

		];
	}

	/**
	 * Register Widgets
	 *
	 * Register new Elementor widgets.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function register_widgets() {

		if ( defined( 'WCF_ADDONS_DASHBOARD_V2' ) ) {
			$widgets_keys = array_keys( self::get_widgets() );

			foreach ( WCFAddonsPlugin::get_widgets() as $slug => $data ) {

				$index = array_search( $slug, $widgets_keys ); // Find the index of the element

				if ( $index !== false ) {


					// If upcoming don't register.
					if ( $data['is_upcoming'] ) {
						continue;
					}

					if ( $data['is_active'] ) {

						if ( file_exists( __DIR__ . '/widgets/' . $slug . '.php' ) || file_exists( __DIR__ . '/widgets/' . $slug . '/' . $slug . '.php' ) ) {

							if ( is_dir( __DIR__ . '/widgets/' . $slug ) ) {
								require_once( __DIR__ . '/widgets/' . $slug . '/' . $slug . '.php' );
							} else {
								require_once( __DIR__ . '/widgets/' . $slug . '.php' );
							}

							$class = explode( '-', $slug );
							$class = array_map( 'ucfirst', $class );
							$class = implode( '_', $class );

							$class = 'WCFAddonsPro\\Widgets\\' . $class;
							ElementorPlugin::instance()->widgets_manager->register( new $class() );
						}

					}
				}

			}
		} else {

			foreach ( self::get_widgets() as $slug => $data ) {

				// If upcoming don't register.
				if ( $data['is_upcoming'] ) {
					continue;
				}

				if ( $data['is_active'] ) {

					if ( file_exists( __DIR__ . '/widgets/' . $slug . '.php' ) || file_exists( __DIR__ . '/widgets/' . $slug . '/' . $slug . '.php' ) ) {

						if ( is_dir( __DIR__ . '/widgets/' . $slug ) ) {
							require_once( __DIR__ . '/widgets/' . $slug . '/' . $slug . '.php' );
						} else {
							require_once( __DIR__ . '/widgets/' . $slug . '.php' );
						}

						$class = explode( '-', $slug );
						$class = array_map( 'ucfirst', $class );
						$class = implode( '_', $class );
						$class = 'WCFAddonsPro\\Widgets\\' . $class;
						ElementorPlugin::instance()->widgets_manager->register( new $class() );
					}

				}
			}
		}

	}

	/**
	 * Register Widgets
	 *
	 * Register new Elementor Extensions.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function register_extensions() {

		$extensions = $this->get_extensions();

		if ( defined( 'WCF_ADDONS_DASHBOARD_V2' ) ) {

			$widgets = get_option( 'wcf_save_extensions' );

			$saved_widgets = is_array( $widgets ) ? array_keys( $widgets ) : [];
			$ext_keys      = self::get_extensions();
			self::get_search_active_keys( $ext_keys, $saved_widgets, $acwidgets );

			foreach ( WCFAddonsPlugin::get_extensions() as $slug => $data ) {

				if ( is_array( $acwidgets ) && in_array( $slug, $acwidgets ) ) {

					if ( $data['is_upcoming'] ) {
						continue;
					}

					if ( file_exists( WCF_ADDONS_PRO_PATH . 'inc/extensions/wcf-' . $slug . '.php' ) ) {

						include_once WCF_ADDONS_PRO_PATH . 'inc/extensions/wcf-' . $slug . '.php';
					}

				}

			}


		} else {

			$allextensions = [];
			foreach ( $extensions as $index => $extension ) {
				//if gsap not enbale
				if ( 'gsap-extensions' === $index && ! wcf_addons_get_settings( 'wcf_save_extensions', 'wcf-gsap' ) ) {
					continue;
				}

				$allextensions = array_merge( $allextensions, $extension['elements'] );
			}

			foreach ( $allextensions as $slug => $data ) {

				// If upcoming don't register.
				if ( $data['is_upcoming'] ) {
					continue;
				}

				if ( $data['is_pro'] ) {
					include_once WCF_ADDONS_PRO_PATH . 'inc/extensions/wcf-' . $slug . '.php';
				}
			}
		}
	}

	function get_search_active_keys( $array, $saved_widgets, &$active ) {
		foreach ( $array as $key => $value ) {
			// Check if the current key is one we're looking for
			if ( is_array( $value ) && array_key_exists( 'is_extension', $value ) ) {

				if ( is_array( $saved_widgets ) && in_array( $key, $saved_widgets ) ) {
					$active[] = $key;
				}

			}

			// If value is an array, recurse into it
			if ( is_array( $value ) ) {
				self::get_search_active_keys( $value, $saved_widgets, $active );
			}
		}
	}

	public function get_extensions() {
		$extensions = [
			'general-extensions' => [
				'title'    => __( 'General Extension', 'wcf-addons-pro' ),
				'elements' => [
					'wrapper-link'     => [
						'label'        => esc_html__( 'Wrapper Link', 'wcf-addons-pro' ),
						'is_pro'       => true,
						'is_extension' => false,
						'is_upcoming'  => false,
						'demo_url'     => '',
						'doc_url'      => '',
						'youtube_url'  => '',
					],
					'tilt-effect'      => [
						'label'        => esc_html__( 'Tilt Effect', 'wcf-addons-pro' ),
						'is_pro'       => true,
						'is_extension' => false,
						'is_upcoming'  => false,
						'demo_url'     => '',
						'doc_url'      => '',
						'youtube_url'  => '',
					],
					'advanced-tooltip' => [
						'label'        => esc_html__( 'Advanced Tooltip', 'wcf-addons-pro' ),
						'is_pro'       => true,
						'is_extension' => false,
						'is_upcoming'  => false,
						'demo_url'     => '',
						'doc_url'      => '',
						'youtube_url'  => '',
					],
					'custom-fonts'     => [
						'label'        => esc_html__( 'Custom Fonts', 'wcf-addons-pro' ),
						'is_pro'       => true,
						'is_extension' => false,
						'is_upcoming'  => false,
						'demo_url'     => '',
						'doc_url'      => '',
						'youtube_url'  => '',
					],
				]
			],
			'gsap-extensions'    => [
				'title'    => __( 'Gsap Extension', 'wcf-addons-pro' ),
				'elements' => [
					'cursor-hover-effect'     => [
						'label'        => esc_html__( 'Cursor Hover Effect', 'wcf-addons-pro' ),
						'is_pro'       => true,
						'is_extension' => false,
						'is_upcoming'  => false,
						'demo_url'     => '',
						'doc_url'      => '',
						'youtube_url'  => '',
					],
					'horizontal-scroll'       => [
						'label'        => esc_html__( 'Horizontal', 'wcf-addons-pro' ),
						'is_pro'       => true,
						'is_extension' => false,
						'is_upcoming'  => false,
						'demo_url'     => '',
						'doc_url'      => '',
						'youtube_url'  => '',
					],
					'hover-effect-image'      => [
						'label'        => esc_html__( 'Hover Effect Image', 'wcf-addons-pro' ),
						'is_pro'       => true,
						'is_extension' => false,
						'is_upcoming'  => false,
						'demo_url'     => '',
						'doc_url'      => '',
						'youtube_url'  => '',
					],
					'cursor-move-effect'      => [
						'label'        => esc_html__( 'Cursor Move Effect', 'wcf-addons-pro' ),
						'is_pro'       => true,
						'is_extension' => false,
						'is_upcoming'  => false,
						'demo_url'     => '',
						'doc_url'      => '',
						'youtube_url'  => '',
					],
					'animation-builder'       => [
						'label'        => esc_html__( 'Animation Builder', 'wcf-addons-pro' ),
						'is_pro'       => true,
						'is_extension' => false,
						'is_upcoming'  => true,
						'demo_url'     => '',
						'doc_url'      => '',
						'youtube_url'  => '',
					],
					'custom-cpt'              => [
						'label'        => esc_html__( 'Custom Post Type', 'wcf-addons-pro' ),
						'is_pro'       => true,
						'is_extension' => false,
						'is_upcoming'  => true,
						'demo_url'     => '',
						'doc_url'      => '',
						'youtube_url'  => '',
					],
					'custom-icon'             => [
						'label'        => esc_html__( 'Custom Icon', 'wcf-addons-pro' ),
						'is_pro'       => true,
						'is_extension' => false,
						'is_upcoming'  => true,
						'demo_url'     => '',
						'doc_url'      => '',
						'youtube_url'  => '',
					],
					'dynamic-tags'            => [
						'label'        => esc_html__( 'Dynamic Tags', 'wcf-addons-pro' ),
						'is_pro'       => true,
						'is_extension' => false,
						'is_upcoming'  => true,
						'demo_url'     => '',
						'doc_url'      => '',
						'youtube_url'  => '',
					],
					'restrict-content'        => [
						'label'        => esc_html__( 'Content Restriction', 'wcf-addons-pro' ),
						'is_pro'       => true,
						'is_extension' => false,
						'is_upcoming'  => true,
						'demo_url'     => '',
						'doc_url'      => '',
						'youtube_url'  => '',
					],
					'animation-effects'       => [
						'label'        => esc_html__( 'Animation Effects', 'wcf-addons-pro' ),
						'is_pro'       => true,
						'is_extension' => false,
						'is_upcoming'  => true,
						'demo_url'     => '',
						'doc_url'      => '',
						'youtube_url'  => '',
					],
					'image-animation-effects' => [
						'label'        => esc_html__( 'Image Animation Effects', 'wcf-addons-pro' ),
						'is_pro'       => true,
						'is_extension' => false,
						'is_upcoming'  => true,
						'demo_url'     => '',
						'doc_url'      => '',
						'youtube_url'  => '',
					],
					'pin-element'             => [
						'label'        => esc_html__( 'pin-element', 'wcf-addons-pro' ),
						'is_pro'       => true,
						'is_extension' => false,
						'is_upcoming'  => true,
						'demo_url'     => '',
						'doc_url'      => '',
						'youtube_url'  => '',
					],
					'popup'                   => [
						'label'        => esc_html__( 'Popup', 'wcf-addons-pro' ),
						'is_pro'       => true,
						'is_extension' => false,
						'is_upcoming'  => true,
						'demo_url'     => '',
						'doc_url'      => '',
						'youtube_url'  => '',
					],

					'portfolio-filter' => [
						'label'        => esc_html__( 'Portfolio Filter', 'wcf-addons-pro' ),
						'is_pro'       => true,
						'is_extension' => false,
						'is_upcoming'  => true,
						'demo_url'     => '',
						'doc_url'      => '',
						'youtube_url'  => '',
					],

					'text-animation-effects' => [
						'label'        => esc_html__( 'Text Animation Effects', 'wcf-addons-pro' ),
						'is_pro'       => true,
						'is_extension' => false,
						'is_upcoming'  => true,
						'demo_url'     => '',
						'doc_url'      => '',
						'youtube_url'  => '',
					],
				]
			],
		];

		return $extensions;
	}

	/**
	 * Include Widgets skins
	 *
	 * Load widgets skins
	 *
	 * @since 0.0.1
	 * @access private
	 */
	private function include_skins_files() {
		foreach ( self::get_widget_Skins() as $slug => $data ) {

			//is widget all skins are not active
			if ( ! $data['is_active'] ) {
				continue;
			}

			foreach ( $data['skins'] as $skin_slug => $skin ) {
				if ( ! $skin['is_active'] ) {
					continue;
				}

				require_once( WCF_ADDONS_PRO_WIDGETS_PATH . $slug . '/skins/' . $skin_slug . '.php' );

				$class = explode( '-', $skin_slug );
				$class = array_map( 'ucfirst', $class );
				$class = implode( '_', $class );
				$class = 'WCFAddonsPro\\Widgets\\Skin\\' . $class;

				//has base base skin dont need register
				if ( isset( $skin['is_base_skin'] ) ) {
					continue;
				}

				add_action( 'elementor/widget/' . $data['widget_name'] . '/skins_init', function ( $widget ) use ( $class ) {
					$widget->add_skin( new $class( $widget ) );
				} );
			}
		}

	}

	/**
	 * Get Widgets List.
	 *
	 * @return array
	 */
	public static function get_widgets() {

		return [
			'toggle-switcher'       => [
				'label'       => __( 'Toggle Switcher', 'wcf-addons-pro' ),
				'is_active'   => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],
			'advance-pricing-table' => [
				'label'       => __( 'Advanced Pricing Table', 'wcf-addons-pro' ),
				'is_active'   => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],
			'scroll-elements'       => [
				'label'       => __( 'Scroll Elements', 'wcf-addons-pro' ),
				'is_active'   => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],
			'advance-portfolio'     => [
				'label'       => __( 'Advanced Portfolio', 'wcf-addons-pro' ),
				'is_active'   => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],
			'filterable-gallery'    => [
				'label'       => __( 'Filterable Gallery', 'wcf-addons-pro' ),
				'is_active'   => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],
			'breadcrumbs'           => [
				'label'       => __( 'Breadcrumbs', 'wcf-addons-pro' ),
				'is_active'   => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],
			'table-of-contents'     => [
				'label'       => __( 'Table Of Content', 'wcf-addons-pro' ),
				'is_active'   => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],
			'image-accordion'       => [
				'label'       => __( 'Image Accordion', 'wcf-addons-pro' ),
				'is_active'   => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],
			'author-box'            => [
				'label'       => __( 'Author Box', 'wcf-addons-pro' ),
				'is_active'   => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],
			'flip-box'              => [
				'label'       => __( 'Flip Box', 'wcf-addons-pro' ),
				'is_active'   => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],
			'filterable-slider'     => [
				'label'       => __( 'Filterable Slider', 'wcf-addons-pro' ),
				'is_active'   => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],
			'advance-accordion'     => [
				'label'       => __( 'Advanced Accordion', 'wcf-addons-pro' ),
				'is_active'   => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],
			'animated-offcanvas'    => [
				'label'       => __( 'Animated Offcanvas', 'wcf-addons-pro' ),
				'is_active'   => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],
			'lottie'                => [
				'label'       => __( 'WCF Lottie', 'helo-essential' ),
				'is_active'   => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],
			'draw-svg'              => [
				'label'       => __( 'DrawSvg', 'helo-essential' ),
				'is_active'   => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],
			'posts-pro'             => [
				'label'       => __( 'Advanced Posts', 'helo-essential' ),
				'is_active'   => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],
			'posts-filter'          => [
				'label'       => __( 'Filterable Posts', 'helo-essential' ),
				'is_active'   => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],
			'post-rating-form'      => [
				'label'       => __( 'Post Rating Form', 'helo-essential' ),
				'is_active'   => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],
			'post-rating'           => [
				'label'       => __( 'Post Rating', 'helo-essential' ),
				'is_active'   => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],
			'feature-posts'         => [
				'label'       => __( 'Post Featured Image', 'wcf-addons-pro' ),
				'is_active'   => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],
			'current-date'          => [
				'label'       => __( 'Current Date', 'wcf-addons-pro' ),
				'is_active'   => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],
			'banner-posts'          => [
				'label'       => __( 'Banner Posts', 'wcf-addons-pro' ),
				'is_active'   => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],
			'grid-hover-posts'      => [
				'label'       => __( 'Grid Hover Posts', 'wcf-addons-pro' ),
				'is_active'   => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],
			'video-box'             => [
				'label'       => __( 'Video box', 'wcf-addons-pro' ),
				'is_active'   => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],
			'video-box-slider'      => [
				'label'       => __( 'Video box Slider', 'wcf-addons-pro' ),
				'is_active'   => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],
			'mailchimp'             => [
				'label'       => __( 'Mailchimp', 'wcf-addons-pro' ),
				'is_active'   => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],
			'advanced-mailchimp'    => [
				'label'       => __( 'Advanced Mailchimp', 'wcf-addons-pro' ),
				'is_active'   => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],
			'portfolio'             => [
				'label'       => __( 'Portfolio box', 'wcf-addons-pro' ),
				'is_active'   => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],
			'video-mask'            => [
				'label'       => __( 'Video mask', 'wcf-addons-pro' ),
				'is_active'   => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],
			'posts-slider'          => [
				'label'       => __( 'Posts Slider', 'wcf-addons-pro' ),
				'is_active'   => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],
			'video-popup'           => [
				'label'       => __( 'Video Popup', 'wcf-addons-pro' ),
				'is_active'   => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],
			'category-showcase'     => [
				'label'       => __( 'Category Showcase', 'wcf-addons-pro' ),
				'is_active'   => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],
			'category-slider'     => [
				'label'       => __( 'Category Slider', 'wcf-addons-pro' ),
				'is_active'   => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],
			'video-story'           => [
				'label'       => __( 'Video Story', 'wcf-addons-pro' ),
				'is_active'   => false,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],

			'breaking-news-slider' => [
				'label'       => __( 'Breaking News Slider', 'wcf-addons-pro' ),
				'is_active'   => false,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],

			'post-reactions' => [
				'label'       => __( 'Post reactions', 'wcf-addons-pro' ),
				'is_active'   => false,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],
		];
	}

	/**
	 * Get Widget Skins List.
	 *
	 * @return array
	 */
	public static function get_widget_Skins() {

		return apply_filters( 'wcf_widget_skins', [
			'advance-pricing-table' => [ //widget file/dir name
				'label'       => __( 'Advanced Pricing Table', 'wcf-addons-pro' ),
				'widget_name' => 'wcf--a-pricing-table',
				'is_active'   => true,
				'skins'       => [//skin file names
					'skin-pricing-table-base' => [ 'is_active' => true, 'is_base_skin' => true ],
					'skin-pricing-table-1'    => [ 'is_active' => true ],
					'skin-pricing-table-2'    => [ 'is_active' => true ],
				]
			],
			'advance-portfolio'     => [ //widget file/dir name
				'label'       => __( 'Advanced Portfolio', 'wcf-addons-pro' ),
				'widget_name' => 'wcf--a-portfolio',
				'is_active'   => true,
				'skins'       => [
					'skin-portfolio-base'  => [ 'is_active' => true, 'is_base_skin' => true ],
					'skin-portfolio-one'   => [ 'is_active' => true ],
					'skin-portfolio-two'   => [ 'is_active' => true ],
					'skin-portfolio-three' => [ 'is_active' => true ],
					'skin-portfolio-four'  => [ 'is_active' => true ],
					'skin-portfolio-five'  => [ 'is_active' => true ],
					'skin-portfolio-six'   => [ 'is_active' => true ],
					'skin-portfolio-seven' => [ 'is_active' => true ],
					'skin-portfolio-eight' => [ 'is_active' => true ],
					'skin-portfolio-nine'  => [ 'is_active' => true ],
				]
			],
		] );
	}

	public function widget_categories( $elements_manager ) {
		$categories = [];

		$categories['wcf-addons-pro'] = [
			'title' => esc_html__( 'AAE Pro', 'wcf-addons-pro' ),
			'icon'  => 'fa fa-plug',
		];

		$old_categories = $elements_manager->get_categories();
		$categories     = array_merge( $categories, $old_categories );

		$set_categories = function ( $categories ) {
			$this->categories = $categories;
		};

		$set_categories->call( $elements_manager, $categories );
	}

	/**
	 * Include Plugin files
	 *
	 * @access private
	 */
	private function include_files() {

		require_once WCF_ADDONS_PRO_PATH . 'inc/hook.php';
		require_once WCF_ADDONS_PRO_PATH . 'inc/global-elements.php';
		require_once WCF_ADDONS_PRO_PATH . 'inc/mega-menu/init.php';
		require_once WCF_ADDONS_PRO_PATH . 'inc/image-selector-control.php';
		require_once WCF_ADDONS_PRO_PATH . 'inc/posts/init.php';
		include_once WCF_ADDONS_PRO_PATH . 'widgets/mailchimp/mailchimp-api.php';
		require_once WCF_ADDONS_PRO_PATH . 'inc/ajax-handler.php';
		require_once WCF_ADDONS_PRO_PATH . 'inc/post-rating-handler.php';

		//extensions
		$this->register_extensions();
	}

	/**
	 * Initialize the elementor plugin
	 *
	 * Validates that Elementor is already loaded.
	 * Checks for basic plugin requirements, if one check fail don't continue,
	 *
	 * Fired by `plugins_loaded` action hook.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function elementor_init() {
		add_action( 'elementor/kit/register_tabs', [ $this, 'register_setting_tabs' ] );

		$this->include_skins_files();
	}

	public function register_setting_tabs( $base ) {
		$them_settings = [
			'preloader'        => [
				'label'       => __( 'Preloader', 'wcf-addons-pro' ),
				'is_active'   => true,
				'is_pro'      => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],
			'cursor'           => [
				'label'       => __( 'Cursor', 'wcf-addons-pro' ),
				'is_active'   => true,
				'is_pro'      => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],
			'scroll-to-top'    => [
				'label'       => __( 'Scroll to Top', 'wcf-addons-pro' ),
				'is_active'   => true,
				'is_pro'      => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],
			'scroll-indicator' => [
				'label'       => __( 'Scroll Indicator', 'wcf-addons-pro' ),
				'is_active'   => true,
				'is_pro'      => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],
			'popup'            => [
				'label'       => __( 'AAE Popup', 'wcf-addons-pro' ),
				'is_active'   => true,
				'is_pro'      => true,
				'is_upcoming' => false,
				'demo_url'    => '',
				'doc_url'     => '',
				'youtube_url' => '',
			],
		];

		foreach ( $them_settings as $slug => $data ) {

			// If upcoming don't register.
			if ( $data['is_upcoming'] ) {
				continue;
			}

			// If not pro don't register.
			if ( ! $data['is_pro'] ) {
				continue;
			}

			if ( $data['is_active'] ) {
				if ( is_dir( WCF_ADDONS_PRO_PATH . 'inc/settings/wcf-' . $slug ) ) {
					require_once( WCF_ADDONS_PRO_PATH . 'inc/settings/wcf-' . $slug . '/wcf-' . $slug . '.php' );
				} else {
					require_once( WCF_ADDONS_PRO_PATH . 'inc/settings/wcf-' . $slug . '.php' );
				}

				$key = 'settings-wcf-' . $slug;

				$class = explode( '-', $slug );
				$class = array_map( 'ucfirst', $class );
				$class = implode( '_', $class );
				$class = 'WCFAddonsPro\\Settings\\Tabs\\' . $class;
				$base->register_tab( $key, $class );
			}
		}
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

		if ( function_exists( 'wcf__addons__pro__status' ) && wcf__addons__pro__status() ) {

			add_action( 'elementor/elements/categories_registered', [ $this, 'widget_categories' ] );

			// Register widget scripts
			add_action( 'wp_enqueue_scripts', [ $this, 'widget_scripts' ], 30 );

			// Register widget style
			add_action( 'wp_enqueue_scripts', [ $this, 'widget_styles' ] );

			// Register widgets
			add_action( 'elementor/widgets/register', [ $this, 'register_widgets' ], 18 );

			// Register editor scripts
			add_action( 'elementor/editor/after_enqueue_scripts', [ $this, 'editor_scripts' ] );

			// elementor loaded
			add_action( 'elementor/init', [ $this, 'elementor_init' ], 0 );
			$this->include_files();
		}
	}


}

require_once WCF_ADDONS_PRO_PATH . 'inc/helper.php';
require_once WCF_ADDONS_PRO_PATH . 'inc/core/update.php';
// Instantiate Plugin Class
Plugin::instance();