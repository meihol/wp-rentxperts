<?php if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' );

if (defined('FW')) {
	/**
	 * The plugin was already loaded (maybe as another plugin with different directory name)
	 */
} else {
	require dirname( __FILE__ ) . '/framework/bootstrap.php';

	/**
	 * Plugin related functionality
	 *
	 * Note:
	 * The framework doesn't know that it's used as a plugin.
	 * It can be localed in the theme directory or any other directory.
	 * Only its path and uri is known
	 */
	{
		
		/** @internal */
		function _filter_fw_tmp_dir( $dir ) {			
			return dirname( __FILE__ ) . '/tmp';
		}
		add_filter( 'fw_tmp_dir', '_filter_fw_tmp_dir' );
		
	}
	require dirname( __FILE__ ) . '/wcf-one-click-importer/run.php';	
	require dirname( __FILE__ ) . '/demo.class.php';	
	require dirname( __FILE__ ) . '/wordpress-importer/wordpress-importer.php';	
	require dirname( __FILE__ ) . '/wcf-importer.php';
}


