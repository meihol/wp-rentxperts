<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }

const BRAND_LOGO_TABS_ASSETS_VERSION_8ac671e4 = '1.0.2';

function register_brand_logo_tabs_widget_8ac671e4( $widgets_manager ) {
    require_once __DIR__ . '/widget-brand-logo-tabs.php';
    $widgets_manager->register( new \AngieSnippets\Brand_Logo_Tabs_8ac671e4() );
}
add_action( 'elementor/widgets/register', 'register_brand_logo_tabs_widget_8ac671e4' );

function register_brand_logo_tabs_assets_8ac671e4() {
	wp_register_script( 'brand-logo-tabs-script-8ac671e4', angie_cs_get_snippet_asset_url( __FILE__, 'script.js' ), [ 'elementor-frontend' ], BRAND_LOGO_TABS_ASSETS_VERSION_8ac671e4, true );
	wp_register_style( 'brand-logo-tabs-style-8ac671e4', angie_cs_get_snippet_asset_url( __FILE__, 'style.css' ), [], BRAND_LOGO_TABS_ASSETS_VERSION_8ac671e4 );
}
add_action( 'wp_enqueue_scripts', 'register_brand_logo_tabs_assets_8ac671e4' );
