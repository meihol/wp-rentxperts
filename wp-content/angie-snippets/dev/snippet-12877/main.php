<?php
/**
 * RentXperts Inquiry Button Widget Loader
 * Suffix: 5f258409
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

const RENTXPERTS_INQUIRY_BUTTON_ASSETS_VERSION_5f258409 = '1.0.2';

/**
 * Register Widget
 */
function register_rentxperts_inquiry_button_widget_5f258409( $widgets_manager ) {
	require_once __DIR__ . '/widget-rentxperts-inquiry-button.php';
	$widgets_manager->register( new \AngieSnippets\RentXperts_Inquiry_Button_5f258409() );
}
add_action( 'elementor/widgets/register', 'register_rentxperts_inquiry_button_widget_5f258409' );

/**
 * Register Assets
 */
function register_rentxperts_inquiry_button_assets_5f258409() {
	wp_register_style(
		'rentxperts-inquiry-button-style-5f258409',
		angie_cs_get_snippet_asset_url( __FILE__, 'style.css' ),
		[],
		RENTXPERTS_INQUIRY_BUTTON_ASSETS_VERSION_5f258409
	);

	wp_register_script(
		'rentxperts-inquiry-button-script-5f258409',
		angie_cs_get_snippet_asset_url( __FILE__, 'script.js' ),
		[ 'jquery', 'elementor-frontend' ],
		RENTXPERTS_INQUIRY_BUTTON_ASSETS_VERSION_5f258409,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'register_rentxperts_inquiry_button_assets_5f258409' );
