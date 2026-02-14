<?php 

function wcf_megamenu_registered_widget( $widgets_manager ) {

	require_once( __DIR__ . '/mega-menu.php' );
	$widgets_manager->register( new \WCF\Megamenu\Widgets\WCf_Header_Mega_Menu() );

}
add_action( 'elementor/widgets/register', 'wcf_megamenu_registered_widget' );