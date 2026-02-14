<?php


// Block direct access to the main plugin file.
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

/**
 * Main plugin class with initialization tasks.
 */
class WCFOI_Plugin {
	/**
	 * Constructor for this class.
	 */
	public function __construct() {
		/**
		 * Display admin error message if PHP version is older than 5.6.
		 * Otherwise execute the main plugin class.
		 */
		if ( version_compare( phpversion(), '5.6', '<' ) ) {
			add_action( 'admin_notices', array( $this, 'old_php_admin_error_notice' ) );
		}
		else {
			// Set plugin constants.
			$this->set_plugin_constants();

			// Composer autoloader.
			require_once WCFIO_PATH . 'vendor/autoload.php';

			// Instantiate the main plugin class *Singleton*.
			$one_click_demo_import = WCFOI\OneClickDemoImport::get_instance();

			// Register WP CLI commands
			if ( defined( 'WP_CLI' ) && WP_CLI ) {
				WP_CLI::add_command( 'ocdi list', array( 'WCFOI\WPCLICommands', 'list_predefined' ) );
				WP_CLI::add_command( 'ocdi import', array( 'WCFOI\WPCLICommands', 'import' ) );
			}
		}
	}


	/**
	 * Display an admin error notice when PHP is older the version 5.6.
	 * Hook it to the 'admin_notices' action.
	 */
	public function old_php_admin_error_notice() { /* translators: %1$s - the PHP version, %2$s and %3$s - strong HTML tags, %4$s - br HTMl tag. */
		$message = sprintf( esc_html__( 'The %2$sOne Click Demo Import%3$s plugin requires %2$sPHP 5.6+%3$s to run properly. Please contact your hosting company and ask them to update the PHP version of your site to at least PHP 7.4%4$s Your current version of PHP: %2$s%1$s%3$s', 'wcf-theme-demo-import' ), phpversion(), '<strong>', '</strong>', '<br>' );

		printf( '<div class="notice notice-error"><p>%1$s</p></div>', wp_kses_post( $message ) );
	}


	/**
	 * Set plugin constants.
	 *
	 * Path/URL to root of this plugin, with trailing slash and plugin version.
	 */
	private function set_plugin_constants() {
		// Path/URL to root of this plugin, with trailing slash.
		if ( ! defined( 'WCFIO_PATH' ) ) {
			define( 'WCFIO_PATH', plugin_dir_path( __FILE__ ) );
		}
		if ( ! defined( 'WCFIO_URL' ) ) {
			define( 'WCFIO_URL', plugin_dir_url( __FILE__ ) );
		}

		// Used for backward compatibility.
		if ( ! defined( 'PT_WCFIO_PATH' ) ) {
			define( 'PT_WCFIO_PATH', plugin_dir_path( __FILE__ ) );
		}
		if ( ! defined( 'PT_WCFIO_URL' ) ) {
			define( 'PT_WCFIO_URL', plugin_dir_url( __FILE__ ) );
		}

		// Action hook to set the plugin version constant.
		add_action( 'admin_init', array( $this, 'set_plugin_version_constant' ) );
	}


	/**
	 * Set plugin version constant -> WCFIO_VERSION.
	 */
	public function set_plugin_version_constant() {
		$plugin_data = get_plugin_data( __FILE__ );

		if ( ! defined( 'WCFIO_VERSION' ) ) {
			define( 'WCFIO_VERSION', $plugin_data['Version'] );
		}

		// Used for backward compatibility.
		if ( ! defined( 'PT_WCFIO_VERSION' ) ) {
			define( 'PT_WCFIO_VERSION', $plugin_data['Version'] );
		}
	}
}

// Instantiate the plugin class.
$wcfio_plugin = new WCFOI_Plugin();


