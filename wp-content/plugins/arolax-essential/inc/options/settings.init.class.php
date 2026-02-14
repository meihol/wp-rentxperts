<?php
/*
 Include all options file here
*/

	

/* Theme menu page */
require_once AROLAX_ESSENTIAL_DIR_PATH . '/inc/options/parent-page.php';

if( class_exists( 'CSF' ) && arolax_theme_service_pass()) {
/* Theme options  settings*/
require_once AROLAX_ESSENTIAL_DIR_PATH . '/inc/options/settings/general.php';
require_once AROLAX_ESSENTIAL_DIR_PATH . '/inc/options/settings/header.php';
include_once( AROLAX_ESSENTIAL_DIR_PATH . '/inc/options/settings/rtl.php' );
require_once AROLAX_ESSENTIAL_DIR_PATH . '/inc/options/settings/footer.php';

if ( class_exists( 'WooCommerce' ) ) {
	require_once AROLAX_ESSENTIAL_DIR_PATH . '/inc/options/settings/woo.php';
}

/* Post Meta */
require_once AROLAX_ESSENTIAL_DIR_PATH . '/inc/options/posts/custom-fonts.php';
include_once( AROLAX_ESSENTIAL_DIR_PATH . '/inc/options/settings/custom-code.php' );
include_once( AROLAX_ESSENTIAL_DIR_PATH . '/inc/options/settings/custom-post-type.php' );
include_once( AROLAX_ESSENTIAL_DIR_PATH . '/inc/options/settings/backup.php' );
include_once( AROLAX_ESSENTIAL_DIR_PATH . '/inc/options/settings/theme-optimize.php' );
include_once( AROLAX_ESSENTIAL_DIR_PATH . '/inc/options/settings/theme-update.php' );

//Category
require_once AROLAX_ESSENTIAL_DIR_PATH . '/inc/options/taxonomy/category.php';
// Nav
require_once AROLAX_ESSENTIAL_DIR_PATH . '/inc/options/nav.php';

}