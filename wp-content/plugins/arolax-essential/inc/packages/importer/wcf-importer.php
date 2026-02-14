<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Forbidden' );
}


// OneClick Demo Importer

add_filter( 'wcfio/import_files', 'arolax_import_files' );
function arolax_import_files() {
	return array(

		array(
			'import_file_name'         => esc_html__( 'Branding Agency', 'arolax-essential' ),
			'import_file_url'          => 'https://themecrowdy.com/demo-content/arolax/branding-agency/contents.xml',
			'import_widget_file_url'   => 'https://themecrowdy.com/demo-content/arolax/branding-agency/widgets.wie',
			'import_preview_image_url' => 'https://themecrowdy.com/demo-content/arolax/branding-agency/sc.png',
			'import_notice'            => 'Branding Agency',
			'preview_url'              => 'https://crowdytheme.com/wp/arolax/branding-agency/',
			'import_theme_settings'    => [
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/branding-agency/arolax_settings.xml',
					'option_name'    => 'arolax_settings',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_widgets.xml',
					'option_name'    => 'wcf_save_widgets',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_extensions.xml',
					'option_name'    => 'wcf_save_extensions',
				],
				[
					'option_content'  => '',
					'option_kit_name' => 'elementor_active_kit',
					'file_url'        => 'https://themecrowdy.com/demo-content/arolax/web-agency/site-settings.json',
					'option_name'     => '_elementor_page_settings',
				],
			],
		),

		array(
			'import_file_name'         => esc_html__( 'Web Design & Development Agency', 'arolax-essential' ),
			'import_file_url'          => 'https://themecrowdy.com/demo-content/arolax/web-agency/contents.xml',
			'import_widget_file_url'   => 'https://themecrowdy.com/demo-content/arolax/web-agency/widgets.wie',
			'import_preview_image_url' => 'https://themecrowdy.com/demo-content/arolax/web-agency/sc.png',
			'import_notice'            => 'Web Design & Development Agency',
			'preview_url'              => 'https://crowdytheme.com/wp/arolax/web-design-agencey/',
			'import_theme_settings'    => [
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/arolax_settings.xml',
					'option_name'    => 'arolax_settings',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_widgets.xml',
					'option_name'    => 'wcf_save_widgets',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_extensions.xml',
					'option_name'    => 'wcf_save_extensions',
				],
				[
					'option_content'  => '',
					'option_kit_name' => 'elementor_active_kit',
					'file_url'        => 'https://themecrowdy.com/demo-content/arolax/web-agency/site-settings.json',
					'option_name'     => '_elementor_page_settings',
				],
			],
		),

		array(
			'import_file_name'         => esc_html__( 'SEO Agency', 'arolax-essential' ),
			'import_file_url'          => 'https://themecrowdy.com/demo-content/arolax/seo-agency/contents.xml',
			'import_widget_file_url'   => 'https://themecrowdy.com/demo-content/arolax/seo-agency/widgets.wie',
			'import_preview_image_url' => 'https://themecrowdy.com/demo-content/arolax/seo-agency/sc.png',
			'import_notice'            => 'SEO Agency',
			'preview_url'              => 'https://crowdytheme.com/wp/arolax/seo-agencey/',
			'import_theme_settings'    => [
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/seo-agency/arolax_settings.xml',
					'option_name'    => 'arolax_settings',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_widgets.xml',
					'option_name'    => 'wcf_save_widgets',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_extensions.xml',
					'option_name'    => 'wcf_save_extensions',
				],
				[
					'option_content'  => '',
					'option_kit_name' => 'elementor_active_kit',
					'file_url'        => 'https://themecrowdy.com/demo-content/arolax/seo-agency/site-settings.json',
					'option_name'     => '_elementor_page_settings',
				],
			],
		),

		array(
			'import_file_name'         => esc_html__( 'Design Studio', 'arolax-essential' ),
			'import_file_url'          => 'https://themecrowdy.com/demo-content/arolax/design-studio/contents.xml',
			'import_widget_file_url'   => 'https://themecrowdy.com/demo-content/arolax/design-studio/widgets.wie',
			'import_preview_image_url' => 'https://themecrowdy.com/demo-content/arolax/design-studio/sc.png',
			'import_notice'            => 'Design Studio',
			'preview_url'              => 'https://crowdytheme.com/wp/arolax/design-studio/',
			'import_theme_settings'    => [
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/design-studio/arolax_settings.xml',
					'option_name'    => 'arolax_settings',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_widgets.xml',
					'option_name'    => 'wcf_save_widgets',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_extensions.xml',
					'option_name'    => 'wcf_save_extensions',
				],
				[
					'option_content'  => '',
					'option_kit_name' => 'elementor_active_kit',
					'file_url'        => 'https://themecrowdy.com/demo-content/arolax/design-studio/site-settings.json',
					'option_name'     => '_elementor_page_settings',
				],
			],
		),

		array(
			'import_file_name'         => esc_html__( 'Video Production', 'arolax-essential' ),
			'import_file_url'          => 'https://themecrowdy.com/demo-content/arolax/video-production/contents.xml',
			'import_widget_file_url'   => 'https://themecrowdy.com/demo-content/arolax/video-production/widgets.wie',
			'import_preview_image_url' => 'https://themecrowdy.com/demo-content/arolax/video-production/sc.png',
			'import_notice'            => 'Video Production',
			'preview_url'              => 'https://crowdytheme.com/wp/arolax/video-production/',
			'import_theme_settings'    => [
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/video-production/arolax_settings.xml',
					'option_name'    => 'arolax_settings',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_widgets.xml',
					'option_name'    => 'wcf_save_widgets',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_extensions.xml',
					'option_name'    => 'wcf_save_extensions',
				],
				[
					'option_content'  => '',
					'option_kit_name' => 'elementor_active_kit',
					'file_url'        => 'https://themecrowdy.com/demo-content/arolax/video-production/site-settings.json',
					'option_name'     => '_elementor_page_settings',
				],
			],
		),

		array(
			'import_file_name'         => esc_html__( 'AI Agency', 'arolax-essential' ),
			'import_file_url'          => 'https://themecrowdy.com/demo-content/arolax/ai-agency/contents.xml',
			'import_widget_file_url'   => 'https://themecrowdy.com/demo-content/arolax/ai-agency/widgets.wie',
			'import_preview_image_url' => 'https://themecrowdy.com/demo-content/arolax/ai-agency/sc.png',
			'import_notice'            => 'AI Agency',
			'preview_url'              => 'https://crowdytheme.com/wp/arolax/ai-agencey/',
			'import_theme_settings'    => [
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/ai-agency/arolax_settings.xml',
					'option_name'    => 'arolax_settings',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_widgets.xml',
					'option_name'    => 'wcf_save_widgets',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_extensions.xml',
					'option_name'    => 'wcf_save_extensions',
				],
				[
					'option_content'  => '',
					'option_kit_name' => 'elementor_active_kit',
					'file_url'        => 'https://themecrowdy.com/demo-content/arolax/ai-agency/site-settings.json',
					'option_name'     => '_elementor_page_settings',
				],
			],
		),

		array(
			'import_file_name'         => esc_html__( 'Creative Agency Classic', 'arolax-essential' ),
			'import_file_url'          => 'https://themecrowdy.com/demo-content/arolax/creative-agency-classic/contents.xml',
			'import_widget_file_url'   => 'https://themecrowdy.com/demo-content/arolax/creative-agency-classic/widgets.wie',
			'import_preview_image_url' => 'https://themecrowdy.com/demo-content/arolax/creative-agency-classic/sc.png',
			'import_notice'            => 'Creative Agency Classic',
			'preview_url'              => 'https://crowdytheme.com/wp/arolax/creative-agency-classic/',
			'import_theme_settings'    => [
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/creative-agency-classic/arolax_settings.xml',
					'option_name'    => 'arolax_settings',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_widgets.xml',
					'option_name'    => 'wcf_save_widgets',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_extensions.xml',
					'option_name'    => 'wcf_save_extensions',
				],
				[
					'option_content'  => '',
					'option_kit_name' => 'elementor_active_kit',
					'file_url'        => 'https://themecrowdy.com/demo-content/arolax/creative-agency-classic/site-settings.json',
					'option_name'     => '_elementor_page_settings',
				],
			],
		),

		array(
			'import_file_name'         => esc_html__( 'Marketing Agency', 'arolax-essential' ),
			'import_file_url'          => 'https://themecrowdy.com/demo-content/arolax/marketing-agency/contents.xml',
			'import_widget_file_url'   => 'https://themecrowdy.com/demo-content/arolax/marketing-agency/widgets.wie',
			'import_preview_image_url' => 'https://themecrowdy.com/demo-content/arolax/marketing-agency/sc.png',
			'import_notice'            => 'Marketing Agency',
			'preview_url'              => 'https://crowdytheme.com/wp/arolax/marketing-agency/',
			'import_theme_settings'    => [
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/marketing-agency/arolax_settings.xml',
					'option_name'    => 'arolax_settings',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_widgets.xml',
					'option_name'    => 'wcf_save_widgets',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_extensions.xml',
					'option_name'    => 'wcf_save_extensions',
				],
				[
					'option_content'  => '',
					'option_kit_name' => 'elementor_active_kit',
					'file_url'        => 'https://themecrowdy.com/demo-content/arolax/marketing-agency/site-settings.json',
					'option_name'     => '_elementor_page_settings',
				],
			],
		),

		array(
			'import_file_name'         => esc_html__( 'Corporate Agency', 'arolax-essential' ),
			'import_file_url'          => 'https://themecrowdy.com/demo-content/arolax/corporate-agency/contents.xml',
			'import_widget_file_url'   => 'https://themecrowdy.com/demo-content/arolax/corporate-agency/widgets.wie',
			'import_preview_image_url' => 'https://themecrowdy.com/demo-content/arolax/corporate-agency/sc.png',
			'import_notice'            => 'Corporate Agency',
			'preview_url'              => 'https://crowdytheme.com/wp/arolax/corporateagency/',
			'import_theme_settings'    => [
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/corporate-agency/arolax_settings.xml',
					'option_name'    => 'arolax_settings',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_widgets.xml',
					'option_name'    => 'wcf_save_widgets',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_extensions.xml',
					'option_name'    => 'wcf_save_extensions',
				],
				[
					'option_content'  => '',
					'option_kit_name' => 'elementor_active_kit',
					'file_url'        => 'https://themecrowdy.com/demo-content/arolax/corporate-agency/site-settings.json',
					'option_name'     => '_elementor_page_settings',
				],
			],
		),

		array(
			'import_file_name'         => esc_html__( 'Startup Agency', 'arolax-essential' ),
			'import_file_url'          => 'https://themecrowdy.com/demo-content/arolax/startup-agency/contents.xml',
			'import_widget_file_url'   => 'https://themecrowdy.com/demo-content/arolax/startup-agency/widgets.wie',
			'import_preview_image_url' => 'https://themecrowdy.com/demo-content/arolax/startup-agency/sc.png',
			'import_notice'            => 'Startup Agency',
			'preview_url'              => 'https://crowdytheme.com/wp/arolax/startup-agency/',
			'import_theme_settings'    => [
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/startup-agency/arolax_settings.xml',
					'option_name'    => 'arolax_settings',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_widgets.xml',
					'option_name'    => 'wcf_save_widgets',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_extensions.xml',
					'option_name'    => 'wcf_save_extensions',
				],
				[
					'option_content'  => '',
					'option_kit_name' => 'elementor_active_kit',
					'file_url'        => 'https://themecrowdy.com/demo-content/arolax/startup-agency/site-settings.json',
					'option_name'     => '_elementor_page_settings',
				],
			],
		),

		array(
			'import_file_name'         => esc_html__( 'Modern Agency', 'arolax-essential' ),
			'import_file_url'          => 'https://themecrowdy.com/demo-content/arolax/modern-agency/contents.xml',
			'import_widget_file_url'   => 'https://themecrowdy.com/demo-content/arolax/modern-agency/widgets.wie',
			'import_preview_image_url' => 'https://themecrowdy.com/demo-content/arolax/modern-agency/sc.png',
			'import_notice'            => 'Modern Agency',
			'preview_url'              => 'https://crowdytheme.com/wp/arolax/modern-agency/',
			'import_theme_settings'    => [
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/modern-agency/arolax_settings.xml',
					'option_name'    => 'arolax_settings',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_widgets.xml',
					'option_name'    => 'wcf_save_widgets',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_extensions.xml',
					'option_name'    => 'wcf_save_extensions',
				],
				[
					'option_content'  => '',
					'option_kit_name' => 'elementor_active_kit',
					'file_url'        => 'https://themecrowdy.com/demo-content/arolax/modern-agency/site-settings.json',
					'option_name'     => '_elementor_page_settings',
				],
			],
		),

		array(
			'import_file_name'         => esc_html__( 'Photography Studio', 'arolax-essential' ),
			'import_file_url'          => 'https://themecrowdy.com/demo-content/arolax/photography-studio/contents.xml',
			'import_widget_file_url'   => 'https://themecrowdy.com/demo-content/arolax/photography-studio/widgets.wie',
			'import_preview_image_url' => 'https://themecrowdy.com/demo-content/arolax/photography-studio/sc.png',
			'import_notice'            => 'Photography Studio',
			'preview_url'              => 'https://crowdytheme.com/wp/arolax/photography-studio/',
			'import_theme_settings'    => [
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/photography-studio/arolax_settings.xml',
					'option_name'    => 'arolax_settings',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_widgets.xml',
					'option_name'    => 'wcf_save_widgets',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_extensions.xml',
					'option_name'    => 'wcf_save_extensions',
				],
				[
					'option_content'  => '',
					'option_kit_name' => 'elementor_active_kit',
					'file_url'        => 'https://themecrowdy.com/demo-content/arolax/photography-studio/site-settings.json',
					'option_name'     => '_elementor_page_settings',
				],
			],
		),

		array(
			'import_file_name'         => esc_html__( 'Creative Agency', 'arolax-essential' ),
			'import_file_url'          => 'https://themecrowdy.com/demo-content/arolax/creative-agency/contents.xml',
			'import_widget_file_url'   => 'https://themecrowdy.com/demo-content/arolax/creative-agency/widgets.wie',
			'import_preview_image_url' => 'https://themecrowdy.com/demo-content/arolax/creative-agency/sc.png',
			'import_notice'            => 'Creative Agency',
			'preview_url'              => 'https://crowdytheme.com/wp/arolax/creative-agency/',
			'import_theme_settings'    => [
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/creative-agency/arolax_settings.xml',
					'option_name'    => 'arolax_settings',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_widgets.xml',
					'option_name'    => 'wcf_save_widgets',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_extensions.xml',
					'option_name'    => 'wcf_save_extensions',
				],
				[
					'option_content'  => '',
					'option_kit_name' => 'elementor_active_kit',
					'file_url'        => 'https://themecrowdy.com/demo-content/arolax/creative-agency/site-settings.json',
					'option_name'     => '_elementor_page_settings',
				],
			],
		),

		array(
			'import_file_name'         => esc_html__( 'Creative Agency Two', 'arolax-essential' ),
			'import_file_url'          => 'https://themecrowdy.com/demo-content/arolax/creative-agency-two/contents.xml',
			'import_widget_file_url'   => 'https://themecrowdy.com/demo-content/arolax/creative-agency-two/widgets.wie',
			'import_preview_image_url' => 'https://themecrowdy.com/demo-content/arolax/creative-agency-two/sc.png',
			'import_notice'            => 'Creative Agency Two',
			'preview_url'              => 'https://crowdytheme.com/wp/arolax/creative-agency-two/',
			'import_theme_settings'    => [
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/creative-agency-two/arolax_settings.xml',
					'option_name'    => 'arolax_settings',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_widgets.xml',
					'option_name'    => 'wcf_save_widgets',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_extensions.xml',
					'option_name'    => 'wcf_save_extensions',
				],
				[
					'option_content'  => '',
					'option_kit_name' => 'elementor_active_kit',
					'file_url'        => 'https://themecrowdy.com/demo-content/arolax/creative-agency-two/site-settings.json',
					'option_name'     => '_elementor_page_settings',
				],
			],
		),

		array(
			'import_file_name'         => esc_html__( 'Digital Agency', 'arolax-essential' ),
			'import_file_url'          => 'https://themecrowdy.com/demo-content/arolax/digital-agency/contents.xml',
			'import_widget_file_url'   => 'https://themecrowdy.com/demo-content/arolax/digital-agency/widgets.wie',
			'import_preview_image_url' => 'https://themecrowdy.com/demo-content/arolax/digital-agency/sc.png',
			'import_notice'            => 'Digital Agency',
			'preview_url'              => 'https://crowdytheme.com/wp/arolax/digital-agency/',
			'import_theme_settings'    => [
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/digital-agency/arolax_settings.xml',
					'option_name'    => 'arolax_settings',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_widgets.xml',
					'option_name'    => 'wcf_save_widgets',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_extensions.xml',
					'option_name'    => 'wcf_save_extensions',
				],
				[
					'option_content'  => '',
					'option_kit_name' => 'elementor_active_kit',
					'file_url'        => 'https://themecrowdy.com/demo-content/arolax/digital-agency/site-settings.json',
					'option_name'     => '_elementor_page_settings',
				],
			],
		),

		array(
			'import_file_name'         => esc_html__( 'Law Firm Agency', 'arolax-essential' ),
			'import_file_url'          => 'https://themecrowdy.com/demo-content/arolax/law-firm-agency/contents.xml',
			'import_widget_file_url'   => 'https://themecrowdy.com/demo-content/arolax/law-firm-agency/widgets.wie',
			'import_preview_image_url' => 'https://themecrowdy.com/demo-content/arolax/law-firm-agency/sc.png',
			'import_notice'            => 'Law Firm Agency',
			'preview_url'              => 'https://crowdytheme.com/wp/arolax/law-firm-agency/',
			'import_theme_settings'    => [
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/law-firm-agency/arolax_settings.xml',
					'option_name'    => 'arolax_settings',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_widgets.xml',
					'option_name'    => 'wcf_save_widgets',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_extensions.xml',
					'option_name'    => 'wcf_save_extensions',
				],
				[
					'option_content'  => '',
					'option_kit_name' => 'elementor_active_kit',
					'file_url'        => 'https://themecrowdy.com/demo-content/arolax/law-firm-agency/site-settings.json',
					'option_name'     => '_elementor_page_settings',
				],
			],
		),

		array(
			'import_file_name'         => esc_html__( 'Web Developer', 'arolax-essential' ),
			'import_file_url'          => 'https://themecrowdy.com/demo-content/arolax/web-developer/contents.xml',
			'import_widget_file_url'   => 'https://themecrowdy.com/demo-content/arolax/web-developer/widgets.wie',
			'import_preview_image_url' => 'https://themecrowdy.com/demo-content/arolax/web-developer/sc.png',
			'import_notice'            => 'Web Developer',
			'preview_url'              => 'https://crowdytheme.com/wp/arolax/arolax-developer/',
			'import_theme_settings'    => [
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-developer/arolax_settings.xml',
					'option_name'    => 'arolax_settings',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_widgets.xml',
					'option_name'    => 'wcf_save_widgets',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_extensions.xml',
					'option_name'    => 'wcf_save_extensions',
				],
				[
					'option_content'  => '',
					'option_kit_name' => 'elementor_active_kit',
					'file_url'        => 'https://themecrowdy.com/demo-content/arolax/web-developer/site-settings.json',
					'option_name'     => '_elementor_page_settings',
				],
			],
		),

		array(
			'import_file_name'         => esc_html__( 'Photographer', 'arolax-essential' ),
			'import_file_url'          => 'https://themecrowdy.com/demo-content/arolax/photographer/contents.xml',
			'import_widget_file_url'   => 'https://themecrowdy.com/demo-content/arolax/photographer/widgets.wie',
			'import_preview_image_url' => 'https://themecrowdy.com/demo-content/arolax/photographer/sc.png',
			'import_notice'            => 'Photographer',
			'preview_url'              => 'https://crowdytheme.com/wp/arolax/photographer/',
			'import_theme_settings'    => [
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/photographer/arolax_settings.xml',
					'option_name'    => 'arolax_settings',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_widgets.xml',
					'option_name'    => 'wcf_save_widgets',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_extensions.xml',
					'option_name'    => 'wcf_save_extensions',
				],
				[
					'option_content'  => '',
					'option_kit_name' => 'elementor_active_kit',
					'file_url'        => 'https://themecrowdy.com/demo-content/arolax/photographer/site-settings.json',
					'option_name'     => '_elementor_page_settings',
				],
			],
		),

		array(
			'import_file_name'         => esc_html__( 'Film Production Agency', 'arolax-essential' ),
			'import_file_url'          => 'https://themecrowdy.com/demo-content/arolax/film-production-agency/contents.xml',
			'import_widget_file_url'   => 'https://themecrowdy.com/demo-content/arolax/film-production-agency/widgets.wie',
			'import_preview_image_url' => 'https://themecrowdy.com/demo-content/arolax/film-production-agency/sc.png',
			'import_notice'            => 'Film Production Agency',
			'preview_url'              => 'https://crowdytheme.com/wp/arolax/film-production-agency/',
			'import_theme_settings'    => [
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/film-production-agency/arolax_settings.xml',
					'option_name'    => 'arolax_settings',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/arolax/web-agency/wcf_save_widgets.xml',
					'option_name'    => 'wcf_save_widgets',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/arolax/web-agency/wcf_save_extensions.xml',
					'option_name'    => 'wcf_save_extensions',
				],
				[
					'option_content'  => '',
					'option_kit_name' => 'elementor_active_kit',
					'file_url'        => 'https://themecrowdy.com/demo-content/arolax/film-production-agency/site-settings.json',
					'option_name'     => '_elementor_page_settings',
				],
			],
		),

		array(
			'import_file_name'         => esc_html__( 'Health Coach', 'arolax-essential' ),
			'import_file_url'          => 'https://themecrowdy.com/demo-content/arolax/health-coach/contents.xml',
			'import_widget_file_url'   => 'https://themecrowdy.com/demo-content/arolax/health-coach/widgets.wie',
			'import_preview_image_url' => 'https://themecrowdy.com/demo-content/arolax/health-coach/sc.png',
			'import_notice'            => 'Health Coach',
			'preview_url'              => 'https://crowdytheme.com/wp/arolax/health-coach/',
			'import_theme_settings'    => [
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/health-coach/arolax_settings.xml',
					'option_name'    => 'arolax_settings',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_widgets.xml',
					'option_name'    => 'wcf_save_widgets',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_extensions.xml',
					'option_name'    => 'wcf_save_extensions',
				],
				[
					'option_content'  => '',
					'option_kit_name' => 'elementor_active_kit',
					'file_url'        => 'https://themecrowdy.com/demo-content/arolax/health-coach/site-settings.json',
					'option_name'     => '_elementor_page_settings',
				],
			],
		),

		array(
			'import_file_name'         => esc_html__( 'Freelancer', 'arolax-essential' ),
			'import_file_url'          => 'https://themecrowdy.com/demo-content/arolax/freelancer/contents.xml',
			'import_widget_file_url'   => 'https://themecrowdy.com/demo-content/arolax/freelancer/widgets.wie',
			'import_preview_image_url' => 'https://themecrowdy.com/demo-content/arolax/freelancer/sc.png',
			'import_notice'            => 'Freelancer',
			'preview_url'              => 'https://crowdytheme.com/wp/arolax/freelancer/',
			'import_theme_settings'    => [
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/freelancer/arolax_settings.xml',
					'option_name'    => 'arolax_settings',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_widgets.xml',
					'option_name'    => 'wcf_save_widgets',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_extensions.xml',
					'option_name'    => 'wcf_save_extensions',
				],
				[
					'option_content'  => '',
					'option_kit_name' => 'elementor_active_kit',
					'file_url'        => 'https://themecrowdy.com/demo-content/arolax/freelancer/site-settings.json',
					'option_name'     => '_elementor_page_settings',
				],
			],
		),

		array(
			'import_file_name'         => esc_html__( 'Content Writer', 'arolax-essential' ),
			'import_file_url'          => 'https://themecrowdy.com/demo-content/arolax/content-writer/contents.xml',
			'import_widget_file_url'   => 'https://themecrowdy.com/demo-content/arolax/content-writer/widgets.wie',
			'import_preview_image_url' => 'https://themecrowdy.com/demo-content/arolax/content-writer/sc.png',
			'import_notice'            => 'Content Writer',
			'preview_url'              => 'https://crowdytheme.com/wp/arolax/content-writer/',
			'import_theme_settings'    => [
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/content-writer/arolax_settings.xml',
					'option_name'    => 'arolax_settings',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_widgets.xml',
					'option_name'    => 'wcf_save_widgets',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_extensions.xml',
					'option_name'    => 'wcf_save_extensions',
				],
				[
					'option_content'  => '',
					'option_kit_name' => 'elementor_active_kit',
					'file_url'        => 'https://themecrowdy.com/demo-content/arolax/content-writer/site-settings.json',
					'option_name'     => '_elementor_page_settings',
				],
			],
		),

		array(
			'import_file_name'         => esc_html__( 'Event Planner', 'arolax-essential' ),
			'import_file_url'          => 'https://themecrowdy.com/demo-content/arolax/event-planner/contents.xml',
			'import_widget_file_url'   => 'https://themecrowdy.com/demo-content/arolax/event-planner/widgets.wie',
			'import_preview_image_url' => 'https://themecrowdy.com/demo-content/arolax/event-planner/sc.png',
			'import_notice'            => 'Event Planner',
			'preview_url'              => 'https://crowdytheme.com/wp/arolax/event-planner/',
			'import_theme_settings'    => [
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/event-planner/arolax_settings.xml',
					'option_name'    => 'arolax_settings',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_widgets.xml',
					'option_name'    => 'wcf_save_widgets',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_extensions.xml',
					'option_name'    => 'wcf_save_extensions',
				],
				[
					'option_content'  => '',
					'option_kit_name' => 'elementor_active_kit',
					'file_url'        => 'https://themecrowdy.com/demo-content/arolax/event-planner/site-settings.json',
					'option_name'     => '_elementor_page_settings',
				],
			],
		),

		array(
			'import_file_name'         => esc_html__( 'Digital Marketer', 'arolax-essential' ),
			'import_file_url'          => 'https://themecrowdy.com/demo-content/arolax/digital-marketer/contents.xml',
			'import_widget_file_url'   => 'https://themecrowdy.com/demo-content/arolax/digital-marketer/widgets.wie',
			'import_preview_image_url' => 'https://themecrowdy.com/demo-content/arolax/digital-marketer/sc.png',
			'import_notice'            => 'Digital Marketer',
			'preview_url'              => 'https://crowdytheme.com/wp/arolax/digital-marketer/',
			'import_theme_settings'    => [
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/digital-marketer/arolax_settings.xml',
					'option_name'    => 'arolax_settings',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_widgets.xml',
					'option_name'    => 'wcf_save_widgets',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_extensions.xml',
					'option_name'    => 'wcf_save_extensions',
				],
				[
					'option_content'  => '',
					'option_kit_name' => 'elementor_active_kit',
					'file_url'        => 'https://themecrowdy.com/demo-content/arolax/digital-marketer/site-settings.json',
					'option_name'     => '_elementor_page_settings',
				],
			],
		),

		array(
			'import_file_name'         => esc_html__( 'Travel Agency', 'arolax-essential' ),
			'import_file_url'          => 'https://themecrowdy.com/demo-content/arolax/travel-agency/contents.xml',
			'import_widget_file_url'   => 'https://themecrowdy.com/demo-content/arolax/travel-agency/widgets.wie',
			'import_preview_image_url' => 'https://themecrowdy.com/demo-content/arolax/travel-agency/sc.png',
			'import_notice'            => 'Travel Agency',
			'preview_url'              => 'https://crowdytheme.com/wp/arolax/travel-agency/',
			'import_theme_settings'    => [
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/travel-agency/arolax_settings.xml',
					'option_name'    => 'arolax_settings',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_widgets.xml',
					'option_name'    => 'wcf_save_widgets',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_extensions.xml',
					'option_name'    => 'wcf_save_extensions',
				],
				[
					'option_content'  => '',
					'option_kit_name' => 'elementor_active_kit',
					'file_url'        => 'https://themecrowdy.com/demo-content/arolax/travel-agency/site-settings.json',
					'option_name'     => '_elementor_page_settings',
				],
			],
		),

		array(
			'import_file_name'         => esc_html__( 'Personal Portfolio', 'arolax-essential' ),
			'import_file_url'          => 'https://themecrowdy.com/demo-content/arolax/personal-portfolio/contents.xml',
			'import_widget_file_url'   => 'https://themecrowdy.com/demo-content/arolax/personal-portfolio/widgets.wie',
			'import_preview_image_url' => 'https://themecrowdy.com/demo-content/arolax/personal-portfolio/sc.png',
			'import_notice'            => 'Personal Portfolio',
			'preview_url'              => 'https://crowdytheme.com/wp/arolax/personal-portfolio/',
			'import_theme_settings'    => [
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/personal-portfolio/arolax_settings.xml',
					'option_name'    => 'arolax_settings',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_widgets.xml',
					'option_name'    => 'wcf_save_widgets',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_extensions.xml',
					'option_name'    => 'wcf_save_extensions',
				],
				[
					'option_content'  => '',
					'option_kit_name' => 'elementor_active_kit',
					'file_url'        => 'https://themecrowdy.com/demo-content/arolax/personal-portfolio/site-settings.json',
					'option_name'     => '_elementor_page_settings',
				],
			],
		),

		array(
			'import_file_name'         => esc_html__( 'Marketing Consultancy Agency', 'arolax-essential' ),
			'import_file_url'          => 'https://themecrowdy.com/demo-content/arolax/marketing-consultancy-agency/contents.xml',
			'import_widget_file_url'   => 'https://themecrowdy.com/demo-content/arolax/marketing-consultancy-agency/widgets.wie',
			'import_preview_image_url' => 'https://themecrowdy.com/demo-content/arolax/marketing-consultancy-agency/sc.png',
			'import_notice'            => 'Marketing Consultancy Agency',
			'preview_url'              => 'https://crowdytheme.com/wp/arolax/marketing-consultancy-agency/',
			'import_theme_settings'    => [
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/marketing-consultancy-agency/arolax_settings.xml',
					'option_name'    => 'arolax_settings',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_widgets.xml',
					'option_name'    => 'wcf_save_widgets',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_extensions.xml',
					'option_name'    => 'wcf_save_extensions',
				],
				[
					'option_content'  => '',
					'option_kit_name' => 'elementor_active_kit',
					'file_url'        => 'https://themecrowdy.com/demo-content/arolax/marketing-consultancy-agency/site-settings.json',
					'option_name'     => '_elementor_page_settings',
				],
			],
		),

		array(
			'import_file_name'         => esc_html__( 'Business Consultancy Agency', 'arolax-essential' ),
			'import_file_url'          => 'https://themecrowdy.com/demo-content/arolax/busienss-consultant-agency/contents.xml',
			'import_widget_file_url'   => 'https://themecrowdy.com/demo-content/arolax/busienss-consultant-agency/widgets.wie',
			'import_preview_image_url' => 'https://themecrowdy.com/demo-content/arolax/busienss-consultant-agency/sc.png',
			'import_notice'            => 'Business Consultancy Agency',
			'preview_url'              => 'https://crowdytheme.com/wp/arolax/busienss-consultant-agency/',
			'import_theme_settings'    => [
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/busienss-consultant-agency/arolax_settings.xml',
					'option_name'    => 'arolax_settings',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_widgets.xml',
					'option_name'    => 'wcf_save_widgets',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_extensions.xml',
					'option_name'    => 'wcf_save_extensions',
				],
				[
					'option_content'  => '',
					'option_kit_name' => 'elementor_active_kit',
					'file_url'        => 'https://themecrowdy.com/demo-content/arolax/busienss-consultant-agency/site-settings.json',
					'option_name'     => '_elementor_page_settings',
				],
			],
		),

		array(
			'import_file_name'         => esc_html__( 'IT Consultancy Agency', 'arolax-essential' ),
			'import_file_url'          => 'https://themecrowdy.com/demo-content/arolax/it-consultancy-agency/contents.xml',
			'import_widget_file_url'   => 'https://themecrowdy.com/demo-content/arolax/it-consultancy-agency/widgets.wie',
			'import_preview_image_url' => 'https://themecrowdy.com/demo-content/arolax/it-consultancy-agency/sc.png',
			'import_notice'            => 'IT Consultancy Agency',
			'preview_url'              => 'https://crowdytheme.com/wp/arolax/it-consultancy-agency/',
			'import_theme_settings'    => [
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/it-consultancy-agency/arolax_settings.xml',
					'option_name'    => 'arolax_settings',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_widgets.xml',
					'option_name'    => 'wcf_save_widgets',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_extensions.xml',
					'option_name'    => 'wcf_save_extensions',
				],
				[
					'option_content'  => '',
					'option_kit_name' => 'elementor_active_kit',
					'file_url'        => 'https://themecrowdy.com/demo-content/arolax/it-consultancy-agency/site-settings.json',
					'option_name'     => '_elementor_page_settings',
				],
			],
		),

		array(
			'import_file_name'         => esc_html__( 'Insurance Consultancy Agency', 'arolax-essential' ),
			'import_file_url'          => 'https://themecrowdy.com/demo-content/arolax/insurance-consultancy-agency/contents.xml',
			'import_widget_file_url'   => 'https://themecrowdy.com/demo-content/arolax/insurance-consultancy-agency/widgets.wie',
			'import_preview_image_url' => 'https://themecrowdy.com/demo-content/arolax/insurance-consultancy-agency/sc.png',
			'import_notice'            => 'Insurance Consultancy Agency',
			'preview_url'              => 'https://crowdytheme.com/wp/arolax/insurance-consultancy-agency/',
			'import_theme_settings'    => [
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/insurance-consultancy-agency/arolax_settings.xml',
					'option_name'    => 'arolax_settings',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_widgets.xml',
					'option_name'    => 'wcf_save_widgets',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_extensions.xml',
					'option_name'    => 'wcf_save_extensions',
				],
				[
					'option_content'  => '',
					'option_kit_name' => 'elementor_active_kit',
					'file_url'        => 'https://themecrowdy.com/demo-content/arolax/insurance-consultancy-agency/site-settings.json',
					'option_name'     => '_elementor_page_settings',
				],
			],
		),

		array(
			'import_file_name'         => esc_html__( 'Consultant Management Agency', 'arolax-essential' ),
			'import_file_url'          => 'https://themecrowdy.com/demo-content/arolax/consultant-management-agency/contents.xml',
			'import_widget_file_url'   => 'https://themecrowdy.com/demo-content/arolax/consultant-management-agency/widgets.wie',
			'import_preview_image_url' => 'https://themecrowdy.com/demo-content/arolax/consultant-management-agency/sc.png',
			'import_notice'            => 'Consultant Management Agency',
			'preview_url'              => 'https://crowdytheme.com/wp/arolax/consultant-management-agency/',
			'import_theme_settings'    => [
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/consultant-management-agency/arolax_settings.xml',
					'option_name'    => 'arolax_settings',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_widgets.xml',
					'option_name'    => 'wcf_save_widgets',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_extensions.xml',
					'option_name'    => 'wcf_save_extensions',
				],
				[
					'option_content'  => '',
					'option_kit_name' => 'elementor_active_kit',
					'file_url'        => 'https://themecrowdy.com/demo-content/arolax/consultant-management-agency/site-settings.json',
					'option_name'     => '_elementor_page_settings',
				],
			],
		),

		array(
			'import_file_name'         => esc_html__( 'Digital Product Agency', 'arolax-essential' ),
			'import_file_url'          => 'https://themecrowdy.com/demo-content/arolax/digital-product-agency/contents.xml',
			'import_widget_file_url'   => 'https://themecrowdy.com/demo-content/arolax/digital-product-agency/widgets.wie',
			'import_preview_image_url' => 'https://themecrowdy.com/demo-content/arolax/digital-product-agency/sc.png',
			'import_notice'            => 'Digital Product Agency',
			'preview_url'              => 'https://crowdytheme.com/wp/arolax/digital-product-agency/',
			'import_theme_settings'    => [
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/digital-product-agency/arolax_settings.xml',
					'option_name'    => 'arolax_settings',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_widgets.xml',
					'option_name'    => 'wcf_save_widgets',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_extensions.xml',
					'option_name'    => 'wcf_save_extensions',
				],
				[
					'option_content'  => '',
					'option_kit_name' => 'elementor_active_kit',
					'file_url'        => 'https://themecrowdy.com/demo-content/arolax/digital-product-agency/site-settings.json',
					'option_name'     => '_elementor_page_settings',
				],
			],
		),

		array(
			'import_file_name'         => esc_html__( 'Resume', 'arolax-essential' ),
			'import_file_url'          => 'https://themecrowdy.com/demo-content/arolax/resume/contents.xml',
			'import_widget_file_url'   => 'https://themecrowdy.com/demo-content/arolax/resume/widgets.wie',
			'import_preview_image_url' => 'https://themecrowdy.com/demo-content/arolax/resume/sc.png',
			'import_notice'            => 'Resume',
			'preview_url'              => 'https://crowdytheme.com/wp/arolax/resume/',
			'import_theme_settings'    => [
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/resume/arolax_settings.xml',
					'option_name'    => 'arolax_settings',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_widgets.xml',
					'option_name'    => 'wcf_save_widgets',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_extensions.xml',
					'option_name'    => 'wcf_save_extensions',
				],
				[
					'option_content'  => '',
					'option_kit_name' => 'elementor_active_kit',
					'file_url'        => 'https://themecrowdy.com/demo-content/arolax/resume/site-settings.json',
					'option_name'     => '_elementor_page_settings',
				],
			],
		),

		array(
			'import_file_name'         => esc_html__( 'AI Image Generator', 'arolax-essential' ),
			'import_file_url'          => 'https://themecrowdy.com/demo-content/arolax/image-generator-agency/contents.xml',
			'import_widget_file_url'   => 'https://themecrowdy.com/demo-content/arolax/image-generator-agency/widgets.wie',
			'import_preview_image_url' => 'https://themecrowdy.com/demo-content/arolax/image-generator-agency/sc.png',
			'import_notice'            => 'AI Image Generator',
			'preview_url'              => 'https://crowdytheme.com/wp/arolax/image-generator-agency/',
			'import_theme_settings'    => [
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/image-generator-agency/arolax_settings.xml',
					'option_name'    => 'arolax_settings',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_widgets.xml',
					'option_name'    => 'wcf_save_widgets',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_extensions.xml',
					'option_name'    => 'wcf_save_extensions',
				],
				[
					'option_content'  => '',
					'option_kit_name' => 'elementor_active_kit',
					'file_url'        => 'https://themecrowdy.com/demo-content/arolax/image-generator-agency/site-settings.json',
					'option_name'     => '_elementor_page_settings',
				],
			],
		),

		array(
			'import_file_name'         => esc_html__( 'AI  Content Writer', 'arolax-essential' ),
			'import_file_url'          => 'https://themecrowdy.com/demo-content/arolax/ai-conetnt-writer/contents.xml',
			'import_widget_file_url'   => 'https://themecrowdy.com/demo-content/arolax/ai-conetnt-writer/widgets.wie',
			'import_preview_image_url' => 'https://themecrowdy.com/demo-content/arolax/ai-conetnt-writer/sc.png',
			'import_notice'            => 'AI  Content Writer',
			'preview_url'              => 'https://crowdytheme.com/wp/arolax/ai-conetnt-writer/',
			'import_theme_settings'    => [
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/ai-conetnt-writer/arolax_settings.xml',
					'option_name'    => 'arolax_settings',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_widgets.xml',
					'option_name'    => 'wcf_save_widgets',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_extensions.xml',
					'option_name'    => 'wcf_save_extensions',
				],
				[
					'option_content'  => '',
					'option_kit_name' => 'elementor_active_kit',
					'file_url'        => 'https://themecrowdy.com/demo-content/arolax/ai-conetnt-writer/site-settings.json',
					'option_name'     => '_elementor_page_settings',
				],
			],
		),

		array(
			'import_file_name'         => esc_html__( 'Mobile Apps', 'arolax-essential' ),
			'import_file_url'          => 'https://themecrowdy.com/demo-content/arolax/mobileapps/contents.xml',
			'import_widget_file_url'   => 'https://themecrowdy.com/demo-content/arolax/mobileapps/widgets.wie',
			'import_preview_image_url' => 'https://themecrowdy.com/demo-content/arolax/mobileapps/sc.png',
			'import_notice'            => 'Mobile Apps',
			'preview_url'              => 'https://crowdytheme.com/wp/arolax/mobileapps/',
			'import_theme_settings'    => [
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/mobileapps/arolax_settings.xml',
					'option_name'    => 'arolax_settings',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_widgets.xml',
					'option_name'    => 'wcf_save_widgets',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_extensions.xml',
					'option_name'    => 'wcf_save_extensions',
				],
				[
					'option_content'  => '',
					'option_kit_name' => 'elementor_active_kit',
					'file_url'        => 'https://themecrowdy.com/demo-content/arolax/mobileapps/site-settings.json',
					'option_name'     => '_elementor_page_settings',
				],
			],
		),

		array(
			'import_file_name'         => esc_html__( 'AI Software Agency', 'arolax-essential' ),
			'import_file_url'          => 'https://themecrowdy.com/demo-content/arolax/ai-software/contents.xml',
			'import_widget_file_url'   => 'https://themecrowdy.com/demo-content/arolax/ai-software/widgets.wie',
			'import_preview_image_url' => 'https://themecrowdy.com/demo-content/arolax/ai-software/sc.png',
			'import_notice'            => 'AI Software Agency',
			'preview_url'              => 'https://crowdytheme.com/wp/arolax/ai-software/',
			'import_theme_settings'    => [
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/ai-software/arolax_settings.xml',
					'option_name'    => 'arolax_settings',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_widgets.xml',
					'option_name'    => 'wcf_save_widgets',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_extensions.xml',
					'option_name'    => 'wcf_save_extensions',
				],
				[
					'option_content'  => '',
					'option_kit_name' => 'elementor_active_kit',
					'file_url'        => 'https://themecrowdy.com/demo-content/arolax/ai-software/site-settings.json',
					'option_name'     => '_elementor_page_settings',
				],
			],
		),

		array(
			'import_file_name'         => esc_html__( 'AI Chatbot', 'arolax-essential' ),
			'import_file_url'          => 'https://themecrowdy.com/demo-content/arolax/ai-chatbot/contents.xml',
			'import_widget_file_url'   => 'https://themecrowdy.com/demo-content/arolax/ai-chatbot/widgets.wie',
			'import_preview_image_url' => 'https://themecrowdy.com/demo-content/arolax/ai-chatbot/sc.png',
			'import_notice'            => 'Content Writer',
			'preview_url'              => 'https://crowdytheme.com/wp/arolax/ai-chatbot/',
			'import_theme_settings'    => [
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/ai-chatbot/arolax_settings.xml',
					'option_name'    => 'arolax_settings',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_widgets.xml',
					'option_name'    => 'wcf_save_widgets',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_extensions.xml',
					'option_name'    => 'wcf_save_extensions',
				],
				[
					'option_content'  => '',
					'option_kit_name' => 'elementor_active_kit',
					'file_url'        => 'https://themecrowdy.com/demo-content/arolax/ai-chatbot/site-settings.json',
					'option_name'     => '_elementor_page_settings',
				],
			],
		),

		array(
			'import_file_name'         => esc_html__( 'Full Width Spring Slider', 'arolax-essential' ),
			'import_file_url'          => 'https://themecrowdy.com/demo-content/arolax/full-width-spring-slider/contents.xml',
			'import_widget_file_url'   => 'https://themecrowdy.com/demo-content/arolax/full-width-spring-slider/widgets.wie',
			'import_preview_image_url' => 'https://themecrowdy.com/demo-content/arolax/full-width-spring-slider/sc.png',
			'import_notice'            => 'Full Width Spring Slider',
			'preview_url'              => 'https://crowdytheme.com/wp/arolax/full-width-spring-slider/',
			'import_theme_settings'    => [
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/full-width-spring-slider/arolax_settings.xml',
					'option_name'    => 'arolax_settings',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_widgets.xml',
					'option_name'    => 'wcf_save_widgets',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_extensions.xml',
					'option_name'    => 'wcf_save_extensions',
				],
				[
					'option_content'  => '',
					'option_kit_name' => 'elementor_active_kit',
					'file_url'        => 'https://themecrowdy.com/demo-content/arolax/full-width-spring-slider/site-settings.json',
					'option_name'     => '_elementor_page_settings',
				],
			],
		),

		array(
			'import_file_name'         => esc_html__( 'Full Width Slicer Slider', 'arolax-essential' ),
			'import_file_url'          => 'https://themecrowdy.com/demo-content/arolax/full-width-slicer-slider/contents.xml',
			'import_widget_file_url'   => 'https://themecrowdy.com/demo-content/arolax/full-width-slicer-slider/widgets.wie',
			'import_preview_image_url' => 'https://themecrowdy.com/demo-content/arolax/full-width-slicer-slider/sc.png',
			'import_notice'            => 'Full Width Slicer Slider',
			'preview_url'              => 'https://crowdytheme.com/wp/arolax/full-width-slicer-slider/',
			'import_theme_settings'    => [
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/full-width-slicer-slider/arolax_settings.xml',
					'option_name'    => 'arolax_settings',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_widgets.xml',
					'option_name'    => 'wcf_save_widgets',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_extensions.xml',
					'option_name'    => 'wcf_save_extensions',
				],
				[
					'option_content'  => '',
					'option_kit_name' => 'elementor_active_kit',
					'file_url'        => 'https://themecrowdy.com/demo-content/arolax/full-width-slicer-slider/site-settings.json',
					'option_name'     => '_elementor_page_settings',
				],
			],
		),

		array(
			'import_file_name'         => esc_html__( 'Full Width Shutters Slider', 'arolax-essential' ),
			'import_file_url'          => 'https://themecrowdy.com/demo-content/arolax/full-width-shutters-slider/contents.xml',
			'import_widget_file_url'   => 'https://themecrowdy.com/demo-content/arolax/full-width-shutters-slider/widgets.wie',
			'import_preview_image_url' => 'https://themecrowdy.com/demo-content/arolax/full-width-shutters-slider/sc.png',
			'import_notice'            => 'Full Width Shutters Slider',
			'preview_url'              => 'https://crowdytheme.com/wp/arolax/full-width-shutters-slider/',
			'import_theme_settings'    => [
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/full-width-shutters-slider/arolax_settings.xml',
					'option_name'    => 'arolax_settings',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_widgets.xml',
					'option_name'    => 'wcf_save_widgets',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_extensions.xml',
					'option_name'    => 'wcf_save_extensions',
				],
				[
					'option_content'  => '',
					'option_kit_name' => 'elementor_active_kit',
					'file_url'        => 'https://themecrowdy.com/demo-content/arolax/full-width-shutters-slider/site-settings.json',
					'option_name'     => '_elementor_page_settings',
				],
			],
		),

		array(
			'import_file_name'         => esc_html__( 'Full Width Fashion Slider', 'arolax-essential' ),
			'import_file_url'          => 'https://themecrowdy.com/demo-content/arolax/full-width-fashion-slider/contents.xml',
			'import_widget_file_url'   => 'https://themecrowdy.com/demo-content/arolax/full-width-fashion-slider/widgets.wie',
			'import_preview_image_url' => 'https://themecrowdy.com/demo-content/arolax/full-width-fashion-slider/sc.png',
			'import_notice'            => 'Full Width Fashion Slider',
			'preview_url'              => 'https://crowdytheme.com/wp/arolax/full-width-fashion-slider/',
			'import_theme_settings'    => [
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/full-width-fashion-slider/arolax_settings.xml',
					'option_name'    => 'arolax_settings',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_widgets.xml',
					'option_name'    => 'wcf_save_widgets',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_extensions.xml',
					'option_name'    => 'wcf_save_extensions',
				],
				[
					'option_content'  => '',
					'option_kit_name' => 'elementor_active_kit',
					'file_url'        => 'https://themecrowdy.com/demo-content/arolax/full-width-fashion-slider/site-settings.json',
					'option_name'     => '_elementor_page_settings',
				],
			],
		),

		array(
			'import_file_name'         => esc_html__( 'Full Width Carousel Slider', 'arolax-essential' ),
			'import_file_url'          => 'https://themecrowdy.com/demo-content/arolax/full-width-carousel-slider/contents.xml',
			'import_widget_file_url'   => 'https://themecrowdy.com/demo-content/arolax/full-width-carousel-slider/widgets.wie',
			'import_preview_image_url' => 'https://themecrowdy.com/demo-content/arolax/full-width-carousel-slider/sc.png',
			'import_notice'            => 'Full Width Carousel Slider',
			'preview_url'              => 'https://crowdytheme.com/wp/arolax/full-width-carousel-slider/',
			'import_theme_settings'    => [
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/full-width-carousel-slider/arolax_settings.xml',
					'option_name'    => 'arolax_settings',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_widgets.xml',
					'option_name'    => 'wcf_save_widgets',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_extensions.xml',
					'option_name'    => 'wcf_save_extensions',
				],
				[
					'option_content'  => '',
					'option_kit_name' => 'elementor_active_kit',
					'file_url'        => 'https://themecrowdy.com/demo-content/arolax/full-width-carousel-slider/site-settings.json',
					'option_name'     => '_elementor_page_settings',
				],
			],
		),

		array(
			'import_file_name'         => esc_html__( 'Full Width Shaders Slider', 'arolax-essential' ),
			'import_file_url'          => 'https://themecrowdy.com/demo-content/arolax/full-width-shaders-slider/contents.xml',
			'import_widget_file_url'   => 'https://themecrowdy.com/demo-content/arolax/full-width-shaders-slider/widgets.wie',
			'import_preview_image_url' => 'https://themecrowdy.com/demo-content/arolax/full-width-shaders-slider/sc.png',
			'import_notice'            => 'Full Width Shaders Slider',
			'preview_url'              => 'https://crowdytheme.com/wp/arolax/full-width-shaders-slider/',
			'import_theme_settings'    => [
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/full-width-shaders-slider/arolax_settings.xml',
					'option_name'    => 'arolax_settings',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_widgets.xml',
					'option_name'    => 'wcf_save_widgets',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_extensions.xml',
					'option_name'    => 'wcf_save_extensions',
				],
				[
					'option_content'  => '',
					'option_kit_name' => 'elementor_active_kit',
					'file_url'        => 'https://themecrowdy.com/demo-content/arolax/full-width-shaders-slider/site-settings.json',
					'option_name'     => '_elementor_page_settings',
				],
			],
		),

		array(
			'import_file_name'         => esc_html__( 'Card Slider', 'arolax-essential' ),
			'import_file_url'          => 'https://themecrowdy.com/demo-content/arolax/card-slider/contents.xml',
			'import_widget_file_url'   => 'https://themecrowdy.com/demo-content/arolax/card-slider/widgets.wie',
			'import_preview_image_url' => 'https://themecrowdy.com/demo-content/arolax/card-slider/sc.png',
			'import_notice'            => 'Card Slider',
			'preview_url'              => 'https://crowdytheme.com/wp/arolax/card-slider/',
			'import_theme_settings'    => [
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/card-slider/arolax_settings.xml',
					'option_name'    => 'arolax_settings',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_widgets.xml',
					'option_name'    => 'wcf_save_widgets',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_extensions.xml',
					'option_name'    => 'wcf_save_extensions',
				],
				[
					'option_content'  => '',
					'option_kit_name' => 'elementor_active_kit',
					'file_url'        => 'https://themecrowdy.com/demo-content/arolax/card-slider/site-settings.json',
					'option_name'     => '_elementor_page_settings',
				],
			],
		),

		array(
			'import_file_name'         => esc_html__( 'Portfolio Masonry', 'arolax-essential' ),
			'import_file_url'          => 'https://themecrowdy.com/demo-content/arolax/portfolio-masonry/contents.xml',
			'import_widget_file_url'   => 'https://themecrowdy.com/demo-content/arolax/portfolio-masonry/widgets.wie',
			'import_preview_image_url' => 'https://themecrowdy.com/demo-content/arolax/portfolio-masonry/sc.png',
			'import_notice'            => 'Portfolio Masonry',
			'preview_url'              => 'https://crowdytheme.com/wp/arolax/portfolio-masonry/',
			'import_theme_settings'    => [
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/portfolio-masonry/arolax_settings.xml',
					'option_name'    => 'arolax_settings',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_widgets.xml',
					'option_name'    => 'wcf_save_widgets',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_extensions.xml',
					'option_name'    => 'wcf_save_extensions',
				],
				[
					'option_content'  => '',
					'option_kit_name' => 'elementor_active_kit',
					'file_url'        => 'https://themecrowdy.com/demo-content/arolax/portfolio-masonry/site-settings.json',
					'option_name'     => '_elementor_page_settings',
				],
			],
		),

		array(
			'import_file_name'         => esc_html__( 'Agency Portfolio', 'arolax-essential' ),
			'import_file_url'          => 'https://themecrowdy.com/demo-content/arolax/agency-portfolio/contents.xml',
			'import_widget_file_url'   => 'https://themecrowdy.com/demo-content/arolax/agency-portfolio/widgets.wie',
			'import_preview_image_url' => 'https://themecrowdy.com/demo-content/arolax/agency-portfolio/sc.png',
			'import_notice'            => 'Agency Portfolio',
			'preview_url'              => 'https://crowdytheme.com/wp/arolax/agency-portfolio/',
			'import_theme_settings'    => [
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/agency-portfolio/arolax_settings.xml',
					'option_name'    => 'arolax_settings',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_widgets.xml',
					'option_name'    => 'wcf_save_widgets',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_extensions.xml',
					'option_name'    => 'wcf_save_extensions',
				],
				[
					'option_content'  => '',
					'option_kit_name' => 'elementor_active_kit',
					'file_url'        => 'https://themecrowdy.com/demo-content/arolax/agency-portfolio/site-settings.json',
					'option_name'     => '_elementor_page_settings',
				],
			],
		),


		// RTL Demos
		array(
			'import_file_name'         => esc_html__( 'SEO Agency RTL', 'arolax-essential' ),
			'import_file_url'          => 'https://themecrowdy.com/demo-content/arolax/seo-agency-rtl/contents.xml',
			'import_widget_file_url'   => 'https://themecrowdy.com/demo-content/arolax/seo-agency-rtl/widgets.wie',
			'import_preview_image_url' => 'https://themecrowdy.com/demo-content/arolax/seo-agency-rtl/sc.png',
			'import_notice'            => 'Content Writer',
			'preview_url'              => 'https://crowdytheme.com/wp/arolax/seo-agency-rtl/',
			'import_theme_settings'    => [
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/seo-agency-rtl/arolax_settings.xml',
					'option_name'    => 'arolax_settings',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_widgets.xml',
					'option_name'    => 'wcf_save_widgets',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_extensions.xml',
					'option_name'    => 'wcf_save_extensions',
				],
				[
					'option_content'  => '',
					'option_kit_name' => 'elementor_active_kit',
					'file_url'        => 'https://themecrowdy.com/demo-content/arolax/seo-agency-rtl/site-settings.json',
					'option_name'     => '_elementor_page_settings',
				],
			],
		),

		array(
			'import_file_name'         => esc_html__( 'Startup Agency RTL', 'arolax-essential' ),
			'import_file_url'          => 'https://themecrowdy.com/demo-content/arolax/startup-agency-rtl/contents.xml',
			'import_widget_file_url'   => 'https://themecrowdy.com/demo-content/arolax/startup-agency-rtl/widgets.wie',
			'import_preview_image_url' => 'https://themecrowdy.com/demo-content/arolax/startup-agency-rtl/sc.png',
			'import_notice'            => 'Startup Agency RTL',
			'preview_url'              => 'https://crowdytheme.com/wp/arolax/startup-agency-rtl/',
			'import_theme_settings'    => [
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/startup-agency-rtl/arolax_settings.xml',
					'option_name'    => 'arolax_settings',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_widgets.xml',
					'option_name'    => 'wcf_save_widgets',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_extensions.xml',
					'option_name'    => 'wcf_save_extensions',
				],
				[
					'option_content'  => '',
					'option_kit_name' => 'elementor_active_kit',
					'file_url'        => 'https://themecrowdy.com/demo-content/arolax/startup-agency-rtl/site-settings.json',
					'option_name'     => '_elementor_page_settings',
				],
			],
		),

		array(
			'import_file_name'         => esc_html__( 'Modern Agency RTL', 'arolax-essential' ),
			'import_file_url'          => 'https://themecrowdy.com/demo-content/arolax/modern-agency-rtl/contents.xml',
			'import_widget_file_url'   => 'https://themecrowdy.com/demo-content/arolax/modern-agency-rtl/widgets.wie',
			'import_preview_image_url' => 'https://themecrowdy.com/demo-content/arolax/modern-agency-rtl/sc.png',
			'import_notice'            => 'Modern Agency RTL',
			'preview_url'              => 'https://crowdytheme.com/wp/arolax/modern-agency-rtl/',
			'import_theme_settings'    => [
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/modern-agency-rtl/arolax_settings.xml',
					'option_name'    => 'arolax_settings',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_widgets.xml',
					'option_name'    => 'wcf_save_widgets',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_extensions.xml',
					'option_name'    => 'wcf_save_extensions',
				],
				[
					'option_content'  => '',
					'option_kit_name' => 'elementor_active_kit',
					'file_url'        => 'https://themecrowdy.com/demo-content/arolax/modern-agency-rtl/site-settings.json',
					'option_name'     => '_elementor_page_settings',
				],
			],
		),

		array(
			'import_file_name'         => esc_html__( 'Design Studio RTL', 'arolax-essential' ),
			'import_file_url'          => 'https://themecrowdy.com/demo-content/arolax/design-studio-rtl/contents.xml',
			'import_widget_file_url'   => 'https://themecrowdy.com/demo-content/arolax/design-studio-rtl/widgets.wie',
			'import_preview_image_url' => 'https://themecrowdy.com/demo-content/arolax/design-studio-rtl/sc.png',
			'import_notice'            => 'Design Studio RTL',
			'preview_url'              => 'https://crowdytheme.com/wp/arolax/design-studio-rtl/',
			'import_theme_settings'    => [
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/design-studio-rtl/arolax_settings.xml',
					'option_name'    => 'arolax_settings',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_widgets.xml',
					'option_name'    => 'wcf_save_widgets',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_extensions.xml',
					'option_name'    => 'wcf_save_extensions',
				],
				[
					'option_content'  => '',
					'option_kit_name' => 'elementor_active_kit',
					'file_url'        => 'https://themecrowdy.com/demo-content/arolax/design-studio-rtl/site-settings.json',
					'option_name'     => '_elementor_page_settings',
				],
			],
		),

		array(
			'import_file_name'         => esc_html__( 'Web Design Agency RTL', 'arolax-essential' ),
			'import_file_url'          => 'https://themecrowdy.com/demo-content/arolax/web-design-agency-rtl/contents.xml',
			'import_widget_file_url'   => 'https://themecrowdy.com/demo-content/arolax/web-design-agency-rtl/widgets.wie',
			'import_preview_image_url' => 'https://themecrowdy.com/demo-content/arolax/web-design-agency-rtl/sc.png',
			'import_notice'            => 'Web Design Agency RTL',
			'preview_url'              => 'https://crowdytheme.com/wp/arolax/web-design-agency-rtl/',
			'import_theme_settings'    => [
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-design-agency-rtl/arolax_settings.xml',
					'option_name'    => 'arolax_settings',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_widgets.xml',
					'option_name'    => 'wcf_save_widgets',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_extensions.xml',
					'option_name'    => 'wcf_save_extensions',
				],
				[
					'option_content'  => '',
					'option_kit_name' => 'elementor_active_kit',
					'file_url'        => 'https://themecrowdy.com/demo-content/arolax/web-design-agency-rtl/site-settings.json',
					'option_name'     => '_elementor_page_settings',
				],
			],
		),

		array(
			'import_file_name'         => esc_html__( 'AI Agency RTL', 'arolax-essential' ),
			'import_file_url'          => 'https://themecrowdy.com/demo-content/arolax/ai-agency-rtl/contents.xml',
			'import_widget_file_url'   => 'https://themecrowdy.com/demo-content/arolax/ai-agency-rtl/widgets.wie',
			'import_preview_image_url' => 'https://themecrowdy.com/demo-content/arolax/ai-agency-rtl/sc.png',
			'import_notice'            => 'AI Agency RTL',
			'preview_url'              => 'https://crowdytheme.com/wp/arolax/ai-agency-rtl/',
			'import_theme_settings'    => [
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/ai-agency-rtl/arolax_settings.xml',
					'option_name'    => 'arolax_settings',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_widgets.xml',
					'option_name'    => 'wcf_save_widgets',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_extensions.xml',
					'option_name'    => 'wcf_save_extensions',
				],
				[
					'option_content'  => '',
					'option_kit_name' => 'elementor_active_kit',
					'file_url'        => 'https://themecrowdy.com/demo-content/arolax/ai-agency-rtl/site-settings.json',
					'option_name'     => '_elementor_page_settings',
				],
			],
		),

		array(
			'import_file_name'         => esc_html__( 'Marketing Agency RTL', 'arolax-essential' ),
			'import_file_url'          => 'https://themecrowdy.com/demo-content/arolax/marketing-agency-rtl/contents.xml',
			'import_widget_file_url'   => 'https://themecrowdy.com/demo-content/arolax/marketing-agency-rtl/widgets.wie',
			'import_preview_image_url' => 'https://themecrowdy.com/demo-content/arolax/marketing-agency-rtl/sc.png',
			'import_notice'            => 'Marketing Agency RTL',
			'preview_url'              => 'https://crowdytheme.com/wp/arolax/marketing-agency-rtl/',
			'import_theme_settings'    => [
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/marketing-agency-rtl/arolax_settings.xml',
					'option_name'    => 'arolax_settings',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_widgets.xml',
					'option_name'    => 'wcf_save_widgets',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_extensions.xml',
					'option_name'    => 'wcf_save_extensions',
				],
				[
					'option_content'  => '',
					'option_kit_name' => 'elementor_active_kit',
					'file_url'        => 'https://themecrowdy.com/demo-content/arolax/marketing-agency-rtl/site-settings.json',
					'option_name'     => '_elementor_page_settings',
				],
			],
		),

		array(
			'import_file_name'         => esc_html__( 'Corporate Agency RTL', 'arolax-essential' ),
			'import_file_url'          => 'https://themecrowdy.com/demo-content/arolax/corporate-agency-rtl/contents.xml',
			'import_widget_file_url'   => 'https://themecrowdy.com/demo-content/arolax/corporate-agency-rtl/widgets.wie',
			'import_preview_image_url' => 'https://themecrowdy.com/demo-content/arolax/corporate-agency-rtl/sc.png',
			'import_notice'            => 'Corporate Agency RTL',
			'preview_url'              => 'https://crowdytheme.com/wp/arolax/corporate-agency-rtl/',
			'import_theme_settings'    => [
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/corporate-agency-rtl/arolax_settings.xml',
					'option_name'    => 'arolax_settings',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_widgets.xml',
					'option_name'    => 'wcf_save_widgets',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_extensions.xml',
					'option_name'    => 'wcf_save_extensions',
				],
				[
					'option_content'  => '',
					'option_kit_name' => 'elementor_active_kit',
					'file_url'        => 'https://themecrowdy.com/demo-content/arolax/corporate-agency-rtl/site-settings.json',
					'option_name'     => '_elementor_page_settings',
				],
			],
		),

		array(
			'import_file_name'         => esc_html__( 'Creative Agency 02 RTL', 'arolax-essential' ),
			'import_file_url'          => 'https://themecrowdy.com/demo-content/arolax/creative-agency-02-rtl/contents.xml',
			'import_widget_file_url'   => 'https://themecrowdy.com/demo-content/arolax/creative-agency-02-rtl/widgets.wie',
			'import_preview_image_url' => 'https://themecrowdy.com/demo-content/arolax/creative-agency-02-rtl/sc.png',
			'import_notice'            => 'Creative Agency 02 RTL',
			'preview_url'              => 'https://crowdytheme.com/wp/arolax/creative-agency-02-rtl/',
			'import_theme_settings'    => [
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/creative-agency-02-rtl/arolax_settings.xml',
					'option_name'    => 'arolax_settings',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_widgets.xml',
					'option_name'    => 'wcf_save_widgets',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_extensions.xml',
					'option_name'    => 'wcf_save_extensions',
				],
				[
					'option_content'  => '',
					'option_kit_name' => 'elementor_active_kit',
					'file_url'        => 'https://themecrowdy.com/demo-content/arolax/creative-agency-02-rtl/site-settings.json',
					'option_name'     => '_elementor_page_settings',
				],
			],
		),

		array(
			'import_file_name'         => esc_html__( 'Digital Agency RTL', 'arolax-essential' ),
			'import_file_url'          => 'https://themecrowdy.com/demo-content/arolax/digital-agency-rtl/contents.xml',
			'import_widget_file_url'   => 'https://themecrowdy.com/demo-content/arolax/digital-agency-rtl/widgets.wie',
			'import_preview_image_url' => 'https://themecrowdy.com/demo-content/arolax/digital-agency-rtl/sc.png',
			'import_notice'            => 'Digital Agency RTL',
			'preview_url'              => 'https://crowdytheme.com/wp/arolax/digital-agency-rtl/',
			'import_theme_settings'    => [
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/digital-agency-rtl/arolax_settings.xml',
					'option_name'    => 'arolax_settings',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_widgets.xml',
					'option_name'    => 'wcf_save_widgets',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_extensions.xml',
					'option_name'    => 'wcf_save_extensions',
				],
				[
					'option_content'  => '',
					'option_kit_name' => 'elementor_active_kit',
					'file_url'        => 'https://themecrowdy.com/demo-content/arolax/digital-agency-rtl/site-settings.json',
					'option_name'     => '_elementor_page_settings',
				],
			],
		),

		array(
			'import_file_name'         => esc_html__( 'Law Firm Agency RTL', 'arolax-essential' ),
			'import_file_url'          => 'https://themecrowdy.com/demo-content/arolax/law-firm-agency-rtl/contents.xml',
			'import_widget_file_url'   => 'https://themecrowdy.com/demo-content/arolax/law-firm-agency-rtl/widgets.wie',
			'import_preview_image_url' => 'https://themecrowdy.com/demo-content/arolax/law-firm-agency-rtl/sc.png',
			'import_notice'            => 'Law Firm Agency RTL',
			'preview_url'              => 'https://crowdytheme.com/wp/arolax/law-firm-agency-rtl/',
			'import_theme_settings'    => [
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/law-firm-agency-rtl/arolax_settings.xml',
					'option_name'    => 'arolax_settings',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_widgets.xml',
					'option_name'    => 'wcf_save_widgets',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_extensions.xml',
					'option_name'    => 'wcf_save_extensions',
				],
				[
					'option_content'  => '',
					'option_kit_name' => 'elementor_active_kit',
					'file_url'        => 'https://themecrowdy.com/demo-content/arolax/law-firm-agency-rtl/site-settings.json',
					'option_name'     => '_elementor_page_settings',
				],
			],
		),

		array(
			'import_file_name'         => esc_html__( 'Film Production Agency RTL', 'arolax-essential' ),
			'import_file_url'          => 'https://themecrowdy.com/demo-content/arolax/film-production-agency-rtl/contents.xml',
			'import_widget_file_url'   => 'https://themecrowdy.com/demo-content/arolax/film-production-agency-rtl/widgets.wie',
			'import_preview_image_url' => 'https://themecrowdy.com/demo-content/arolax/film-production-agency-rtl/sc.png',
			'import_notice'            => 'Film Production Agency RTL',
			'preview_url'              => 'https://crowdytheme.com/wp/arolax/film-production-agency-rtl/',
			'import_theme_settings'    => [
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/film-production-agency-rtl/arolax_settings.xml',
					'option_name'    => 'arolax_settings',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_widgets.xml',
					'option_name'    => 'wcf_save_widgets',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_extensions.xml',
					'option_name'    => 'wcf_save_extensions',
				],
				[
					'option_content'  => '',
					'option_kit_name' => 'elementor_active_kit',
					'file_url'        => 'https://themecrowdy.com/demo-content/arolax/film-production-agency-rtl/site-settings.json',
					'option_name'     => '_elementor_page_settings',
				],
			],
		),

		array(
			'import_file_name'         => esc_html__( 'Travel Agency RTL', 'arolax-essential' ),
			'import_file_url'          => 'https://themecrowdy.com/demo-content/arolax/travel-agency-rtl/contents.xml',
			'import_widget_file_url'   => 'https://themecrowdy.com/demo-content/arolax/travel-agency-rtl/widgets.wie',
			'import_preview_image_url' => 'https://themecrowdy.com/demo-content/arolax/travel-agency-rtl/sc.png',
			'import_notice'            => 'Travel Agency RTL',
			'preview_url'              => 'https://crowdytheme.com/wp/arolax/travel-agency-rtl/',
			'import_theme_settings'    => [
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/travel-agency-rtl/arolax_settings.xml',
					'option_name'    => 'arolax_settings',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_widgets.xml',
					'option_name'    => 'wcf_save_widgets',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_extensions.xml',
					'option_name'    => 'wcf_save_extensions',
				],
				[
					'option_content'  => '',
					'option_kit_name' => 'elementor_active_kit',
					'file_url'        => 'https://themecrowdy.com/demo-content/arolax/travel-agency-rtl/site-settings.json',
					'option_name'     => '_elementor_page_settings',
				],
			],
		),

		array(
			'import_file_name'         => esc_html__( 'Marketing Consulting Agency RTL', 'arolax-essential' ),
			'import_file_url'          => 'https://themecrowdy.com/demo-content/arolax/marketing-consultancy-agency-rtl/contents.xml',
			'import_widget_file_url'   => 'https://themecrowdy.com/demo-content/arolax/marketing-consultancy-agency-rtl/widgets.wie',
			'import_preview_image_url' => 'https://themecrowdy.com/demo-content/arolax/marketing-consultancy-agency-rtl/sc.png',
			'import_notice'            => 'Marketing Consulting Agency RTL',
			'preview_url'              => 'https://crowdytheme.com/wp/arolax/marketing-consultancy-agency-rtl/',
			'import_theme_settings'    => [
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/marketing-consultancy-agency-rtl/arolax_settings.xml',
					'option_name'    => 'arolax_settings',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_widgets.xml',
					'option_name'    => 'wcf_save_widgets',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_extensions.xml',
					'option_name'    => 'wcf_save_extensions',
				],
				[
					'option_content'  => '',
					'option_kit_name' => 'elementor_active_kit',
					'file_url'        => 'https://themecrowdy.com/demo-content/arolax/marketing-consultancy-agency-rtl/site-settings.json',
					'option_name'     => '_elementor_page_settings',
				],
			],
		),

		array(
			'import_file_name'         => esc_html__( 'Branding Agency RTL', 'arolax-essential' ),
			'import_file_url'          => 'https://themecrowdy.com/demo-content/arolax/branding-agency-rtl/contents.xml',
			'import_widget_file_url'   => 'https://themecrowdy.com/demo-content/arolax/branding-agency-rtl/widgets.wie',
			'import_preview_image_url' => 'https://themecrowdy.com/demo-content/arolax/branding-agency-rtl/sc.png',
			'import_notice'            => 'Branding Agency RTL',
			'preview_url'              => 'https://crowdytheme.com/wp/arolax/branding-agency-rtl/',
			'import_theme_settings'    => [
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/branding-agency-rtl/arolax_settings.xml',
					'option_name'    => 'arolax_settings',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_widgets.xml',
					'option_name'    => 'wcf_save_widgets',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_extensions.xml',
					'option_name'    => 'wcf_save_extensions',
				],
				[
					'option_content'  => '',
					'option_kit_name' => 'elementor_active_kit',
					'file_url'        => 'https://themecrowdy.com/demo-content/arolax/branding-agency-rtl/site-settings.json',
					'option_name'     => '_elementor_page_settings',
				],
			],
		),

		array(
			'import_file_name'         => esc_html__( 'Photography Studio RTL', 'arolax-essential' ),
			'import_file_url'          => 'https://themecrowdy.com/demo-content/arolax/photography-studio-rtl/contents.xml',
			'import_widget_file_url'   => 'https://themecrowdy.com/demo-content/arolax/photography-studio-rtl/widgets.wie',
			'import_preview_image_url' => 'https://themecrowdy.com/demo-content/arolax/photography-studio-rtl/sc.png',
			'import_notice'            => 'Photography Studio RTL',
			'preview_url'              => 'https://crowdytheme.com/wp/arolax/photography-studio-rtl/',
			'import_theme_settings'    => [
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/photography-studio-rtl/arolax_settings.xml',
					'option_name'    => 'arolax_settings',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_widgets.xml',
					'option_name'    => 'wcf_save_widgets',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_extensions.xml',
					'option_name'    => 'wcf_save_extensions',
				],
				[
					'option_content'  => '',
					'option_kit_name' => 'elementor_active_kit',
					'file_url'        => 'https://themecrowdy.com/demo-content/arolax/photography-studio-rtl/site-settings.json',
					'option_name'     => '_elementor_page_settings',
				],
			],
		),

		array(
			'import_file_name'         => esc_html__( 'Creative Agency RTL', 'arolax-essential' ),
			'import_file_url'          => 'https://themecrowdy.com/demo-content/arolax/creative-agency-rtl/contents.xml',
			'import_widget_file_url'   => 'https://themecrowdy.com/demo-content/arolax/creative-agency-rtl/widgets.wie',
			'import_preview_image_url' => 'https://themecrowdy.com/demo-content/arolax/creative-agency-rtl/sc.png',
			'import_notice'            => 'Creative Agency RTL',
			'preview_url'              => 'https://crowdytheme.com/wp/arolax/creative-agency-rtl/',
			'import_theme_settings'    => [
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/creative-agency-rtl/arolax_settings.xml',
					'option_name'    => 'arolax_settings',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_widgets.xml',
					'option_name'    => 'wcf_save_widgets',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_extensions.xml',
					'option_name'    => 'wcf_save_extensions',
				],
				[
					'option_content'  => '',
					'option_kit_name' => 'elementor_active_kit',
					'file_url'        => 'https://themecrowdy.com/demo-content/arolax/creative-agency-rtl/site-settings.json',
					'option_name'     => '_elementor_page_settings',
				],
			],
		),

		array(
			'import_file_name'         => esc_html__( 'Business Consulting Agency RTL', 'arolax-essential' ),
			'import_file_url'          => 'https://themecrowdy.com/demo-content/arolax/busienss-consultant-agency-rtl/contents.xml',
			'import_widget_file_url'   => 'https://themecrowdy.com/demo-content/arolax/busienss-consultant-agency-rtl/widgets.wie',
			'import_preview_image_url' => 'https://themecrowdy.com/demo-content/arolax/busienss-consultant-agency-rtl/sc.png',
			'import_notice'            => 'Business Consulting Agency RTL',
			'preview_url'              => 'https://crowdytheme.com/wp/arolax/busienss-consultant-agency-rtl/',
			'import_theme_settings'    => [
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/busienss-consultant-agency-rtl/arolax_settings.xml',
					'option_name'    => 'arolax_settings',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_widgets.xml',
					'option_name'    => 'wcf_save_widgets',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_extensions.xml',
					'option_name'    => 'wcf_save_extensions',
				],
				[
					'option_content'  => '',
					'option_kit_name' => 'elementor_active_kit',
					'file_url'        => 'https://themecrowdy.com/demo-content/arolax/busienss-consultant-agency-rtl/site-settings.json',
					'option_name'     => '_elementor_page_settings',
				],
			],
		),

		array(
			'import_file_name'         => esc_html__( 'IT Consulting Agency RTL', 'arolax-essential' ),
			'import_file_url'          => 'https://themecrowdy.com/demo-content/arolax/it-consultancy-agency-rtl/contents.xml',
			'import_widget_file_url'   => 'https://themecrowdy.com/demo-content/arolax/it-consultancy-agency-rtl/widgets.wie',
			'import_preview_image_url' => 'https://themecrowdy.com/demo-content/arolax/it-consultancy-agency-rtl/sc.png',
			'import_notice'            => 'IT Consulting Agency RTL',
			'preview_url'              => 'https://crowdytheme.com/wp/arolax/it-consultancy-agency-rtl/',
			'import_theme_settings'    => [
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/it-consultancy-agency-rtl/arolax_settings.xml',
					'option_name'    => 'arolax_settings',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_widgets.xml',
					'option_name'    => 'wcf_save_widgets',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_extensions.xml',
					'option_name'    => 'wcf_save_extensions',
				],
				[
					'option_content'  => '',
					'option_kit_name' => 'elementor_active_kit',
					'file_url'        => 'https://themecrowdy.com/demo-content/arolax/it-consultancy-agency-rtl/site-settings.json',
					'option_name'     => '_elementor_page_settings',
				],
			],
		),

		array(
			'import_file_name'         => esc_html__( 'Digital Product Agency  RTL', 'arolax-essential' ),
			'import_file_url'          => 'https://themecrowdy.com/demo-content/arolax/digital-product-agency-rtl/contents.xml',
			'import_widget_file_url'   => 'https://themecrowdy.com/demo-content/arolax/digital-product-agency-rtl/widgets.wie',
			'import_preview_image_url' => 'https://themecrowdy.com/demo-content/arolax/digital-product-agency-rtl/sc.png',
			'import_notice'            => 'Digital Product Agency  RTL',
			'preview_url'              => 'https://crowdytheme.com/wp/arolax/digital-product-agency-rtl/',
			'import_theme_settings'    => [
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/digital-product-agency-rtl/arolax_settings.xml',
					'option_name'    => 'arolax_settings',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_widgets.xml',
					'option_name'    => 'wcf_save_widgets',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_extensions.xml',
					'option_name'    => 'wcf_save_extensions',
				],
				[
					'option_content'  => '',
					'option_kit_name' => 'elementor_active_kit',
					'file_url'        => 'https://themecrowdy.com/demo-content/arolax/digital-product-agency-rtl/site-settings.json',
					'option_name'     => '_elementor_page_settings',
				],
			],
		),

		array(
			'import_file_name'         => esc_html__( 'Portfolio Masonry RTL', 'arolax-essential' ),
			'import_file_url'          => 'https://themecrowdy.com/demo-content/arolax/portfolio-masonry-rtl/contents.xml',
			'import_widget_file_url'   => 'https://themecrowdy.com/demo-content/arolax/portfolio-masonry-rtl/widgets.wie',
			'import_preview_image_url' => 'https://themecrowdy.com/demo-content/arolax/portfolio-masonry-rtl/sc.png',
			'import_notice'            => 'Portfolio Masonry RTL',
			'preview_url'              => 'https://crowdytheme.com/wp/arolax/portfolio-masonry-rtl/',
			'import_theme_settings'    => [
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/portfolio-masonry-rtl/arolax_settings.xml',
					'option_name'    => 'arolax_settings',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_widgets.xml',
					'option_name'    => 'wcf_save_widgets',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_extensions.xml',
					'option_name'    => 'wcf_save_extensions',
				],
				[
					'option_content'  => '',
					'option_kit_name' => 'elementor_active_kit',
					'file_url'        => 'https://themecrowdy.com/demo-content/arolax/portfolio-masonry-rtl/site-settings.json',
					'option_name'     => '_elementor_page_settings',
				],
			],
		),

		array(
			'import_file_name'         => esc_html__( 'Full Width Spring Slider RTL', 'arolax-essential' ),
			'import_file_url'          => 'https://themecrowdy.com/demo-content/arolax/full-width-spring-slider-rtl/contents.xml',
			'import_widget_file_url'   => 'https://themecrowdy.com/demo-content/arolax/full-width-spring-slider-rtl/widgets.wie',
			'import_preview_image_url' => 'https://themecrowdy.com/demo-content/arolax/full-width-spring-slider-rtl/sc.png',
			'import_notice'            => 'Full Width Spring Slider RTL',
			'preview_url'              => 'https://crowdytheme.com/wp/arolax/full-width-spring-slider-rtl/',
			'import_theme_settings'    => [
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/full-width-spring-slider-rtl/arolax_settings.xml',
					'option_name'    => 'arolax_settings',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_widgets.xml',
					'option_name'    => 'wcf_save_widgets',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_extensions.xml',
					'option_name'    => 'wcf_save_extensions',
				],
				[
					'option_content'  => '',
					'option_kit_name' => 'elementor_active_kit',
					'file_url'        => 'https://themecrowdy.com/demo-content/arolax/full-width-spring-slider-rtl/site-settings.json',
					'option_name'     => '_elementor_page_settings',
				],
			],
		),

		array(
			'import_file_name'         => esc_html__( 'Full Width Slicer Slider RTL', 'arolax-essential' ),
			'import_file_url'          => 'https://themecrowdy.com/demo-content/arolax/full-width-slicer-slider-rtl/contents.xml',
			'import_widget_file_url'   => 'https://themecrowdy.com/demo-content/arolax/full-width-slicer-slider-rtl/widgets.wie',
			'import_preview_image_url' => 'https://themecrowdy.com/demo-content/arolax/full-width-slicer-slider-rtl/sc.png',
			'import_notice'            => 'Full Width Slicer Slider RTL',
			'preview_url'              => 'https://crowdytheme.com/wp/arolax/full-width-slicer-slider-rtl/',
			'import_theme_settings'    => [
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/full-width-slicer-slider-rtl/arolax_settings.xml',
					'option_name'    => 'arolax_settings',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_widgets.xml',
					'option_name'    => 'wcf_save_widgets',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_extensions.xml',
					'option_name'    => 'wcf_save_extensions',
				],
				[
					'option_content'  => '',
					'option_kit_name' => 'elementor_active_kit',
					'file_url'        => 'https://themecrowdy.com/demo-content/arolax/full-width-slicer-slider-rtl/site-settings.json',
					'option_name'     => '_elementor_page_settings',
				],
			],
		),

		array(
			'import_file_name'         => esc_html__( 'Full Width Shutters Slider RTL', 'arolax-essential' ),
			'import_file_url'          => 'https://themecrowdy.com/demo-content/arolax/full-width-shutters-slider-rtl/contents.xml',
			'import_widget_file_url'   => 'https://themecrowdy.com/demo-content/arolax/full-width-shutters-slider-rtl/widgets.wie',
			'import_preview_image_url' => 'https://themecrowdy.com/demo-content/arolax/full-width-shutters-slider-rtl/sc.png',
			'import_notice'            => 'Full Width Shutters Slider RTL',
			'preview_url'              => 'https://crowdytheme.com/wp/arolax/full-width-shutters-slider-rtl/',
			'import_theme_settings'    => [
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/full-width-shutters-slider-rtl/arolax_settings.xml',
					'option_name'    => 'arolax_settings',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_widgets.xml',
					'option_name'    => 'wcf_save_widgets',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_extensions.xml',
					'option_name'    => 'wcf_save_extensions',
				],
				[
					'option_content'  => '',
					'option_kit_name' => 'elementor_active_kit',
					'file_url'        => 'https://themecrowdy.com/demo-content/arolax/full-width-shutters-slider-rtl/site-settings.json',
					'option_name'     => '_elementor_page_settings',
				],
			],
		),

		array(
			'import_file_name'         => esc_html__( 'Full Width Shaders Slider RTL', 'arolax-essential' ),
			'import_file_url'          => 'https://themecrowdy.com/demo-content/arolax/full-width-shaders-slider-rtl/contents.xml',
			'import_widget_file_url'   => 'https://themecrowdy.com/demo-content/arolax/full-width-shaders-slider-rtl/widgets.wie',
			'import_preview_image_url' => 'https://themecrowdy.com/demo-content/arolax/full-width-shaders-slider-rtl/sc.png',
			'import_notice'            => 'Full Width Shaders Slider RTL',
			'preview_url'              => 'https://crowdytheme.com/wp/arolax/full-width-shaders-slider-rtl/',
			'import_theme_settings'    => [
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/full-width-shaders-slider-rtl/arolax_settings.xml',
					'option_name'    => 'arolax_settings',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_widgets.xml',
					'option_name'    => 'wcf_save_widgets',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_extensions.xml',
					'option_name'    => 'wcf_save_extensions',
				],
				[
					'option_content'  => '',
					'option_kit_name' => 'elementor_active_kit',
					'file_url'        => 'https://themecrowdy.com/demo-content/arolax/full-width-shaders-slider-rtl/site-settings.json',
					'option_name'     => '_elementor_page_settings',
				],
			],
		),

		array(
			'import_file_name'         => esc_html__( 'Full Width Fashion Slider RTL', 'arolax-essential' ),
			'import_file_url'          => 'https://themecrowdy.com/demo-content/arolax/full-width-fashion-slider-rtl/contents.xml',
			'import_widget_file_url'   => 'https://themecrowdy.com/demo-content/arolax/full-width-fashion-slider-rtl/widgets.wie',
			'import_preview_image_url' => 'https://themecrowdy.com/demo-content/arolax/full-width-fashion-slider-rtl/sc.png',
			'import_notice'            => 'Full Width Fashion Slider RTL',
			'preview_url'              => 'https://crowdytheme.com/wp/arolax/full-width-fashion-slider-rtl/',
			'import_theme_settings'    => [
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/full-width-fashion-slider-rtl/arolax_settings.xml',
					'option_name'    => 'arolax_settings',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_widgets.xml',
					'option_name'    => 'wcf_save_widgets',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_extensions.xml',
					'option_name'    => 'wcf_save_extensions',
				],
				[
					'option_content'  => '',
					'option_kit_name' => 'elementor_active_kit',
					'file_url'        => 'https://themecrowdy.com/demo-content/arolax/full-width-fashion-slider-rtl/site-settings.json',
					'option_name'     => '_elementor_page_settings',
				],
			],
		),

		array(
			'import_file_name'         => esc_html__( 'Full Width Carousel Slider RTL', 'arolax-essential' ),
			'import_file_url'          => 'https://themecrowdy.com/demo-content/arolax/full-width-carousel-slider-rtl/contents.xml',
			'import_widget_file_url'   => 'https://themecrowdy.com/demo-content/arolax/full-width-carousel-slider-rtl/widgets.wie',
			'import_preview_image_url' => 'https://themecrowdy.com/demo-content/arolax/full-width-carousel-slider-rtl/sc.png',
			'import_notice'            => 'Full Width Carousel Slider RTL',
			'preview_url'              => 'https://crowdytheme.com/wp/arolax/full-width-carousel-slider-rtl/',
			'import_theme_settings'    => [
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/full-width-carousel-slider-rtl/arolax_settings.xml',
					'option_name'    => 'arolax_settings',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_widgets.xml',
					'option_name'    => 'wcf_save_widgets',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_extensions.xml',
					'option_name'    => 'wcf_save_extensions',
				],
				[
					'option_content'  => '',
					'option_kit_name' => 'elementor_active_kit',
					'file_url'        => 'https://themecrowdy.com/demo-content/arolax/full-width-carousel-slider-rtl/site-settings.json',
					'option_name'     => '_elementor_page_settings',
				],
			],
		),

		array(
			'import_file_name'         => esc_html__( 'Card Slider RTL', 'arolax-essential' ),
			'import_file_url'          => 'https://themecrowdy.com/demo-content/arolax/card-slider-rtl/contents.xml',
			'import_widget_file_url'   => 'https://themecrowdy.com/demo-content/arolax/card-slider-rtl/widgets.wie',
			'import_preview_image_url' => 'https://themecrowdy.com/demo-content/arolax/card-slider-rtl/sc.png',
			'import_notice'            => 'Card Slider RTL',
			'preview_url'              => 'https://crowdytheme.com/wp/arolax/card-slider-rtl/',
			'import_theme_settings'    => [
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/card-slider-rtl/arolax_settings.xml',
					'option_name'    => 'arolax_settings',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_widgets.xml',
					'option_name'    => 'wcf_save_widgets',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_extensions.xml',
					'option_name'    => 'wcf_save_extensions',
				],
				[
					'option_content'  => '',
					'option_kit_name' => 'elementor_active_kit',
					'file_url'        => 'https://themecrowdy.com/demo-content/arolax/card-slider-rtl/site-settings.json',
					'option_name'     => '_elementor_page_settings',
				],
			],
		),

		array(
			'import_file_name'         => esc_html__( 'Agency Portfolio RTL', 'arolax-essential' ),
			'import_file_url'          => 'https://themecrowdy.com/demo-content/arolax/agency-portfolio-rtl/contents.xml',
			'import_widget_file_url'   => 'https://themecrowdy.com/demo-content/arolax/agency-portfolio-rtl/widgets.wie',
			'import_preview_image_url' => 'https://themecrowdy.com/demo-content/arolax/agency-portfolio-rtl/sc.png',
			'import_notice'            => 'Agency Portfolio RTL',
			'preview_url'              => 'https://crowdytheme.com/wp/arolax/agency-portfolio-rtl/',
			'import_theme_settings'    => [
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/agency-portfolio-rtl/arolax_settings.xml',
					'option_name'    => 'arolax_settings',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_widgets.xml',
					'option_name'    => 'wcf_save_widgets',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_extensions.xml',
					'option_name'    => 'wcf_save_extensions',
				],
				[
					'option_content'  => '',
					'option_kit_name' => 'elementor_active_kit',
					'file_url'        => 'https://themecrowdy.com/demo-content/arolax/agency-portfolio-rtl/site-settings.json',
					'option_name'     => '_elementor_page_settings',
				],
			],
		),

		array(
			'import_file_name'         => esc_html__( 'Insurance Consultancy Agency RTL', 'arolax-essential' ),
			'import_file_url'          => 'https://themecrowdy.com/demo-content/arolax/insurance-consultancy-agency/contents.xml',
			'import_widget_file_url'   => 'https://themecrowdy.com/demo-content/arolax/insurance-consultancy-agency/widgets.wie',
			'import_preview_image_url' => 'https://themecrowdy.com/demo-content/arolax/insurance-consultancy-agency/sc.png',
			'import_notice'            => 'Insurance Consultancy Agency RTL',
			'preview_url'              => 'https://crowdytheme.com/wp/arolax/insurance-consultancy-agency/',
			'import_theme_settings'    => [
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/insurance-consultancy-agency/arolax_settings.xml',
					'option_name'    => 'arolax_settings',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_widgets.xml',
					'option_name'    => 'wcf_save_widgets',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_extensions.xml',
					'option_name'    => 'wcf_save_extensions',
				],
				[
					'option_content'  => '',
					'option_kit_name' => 'elementor_active_kit',
					'file_url'        => 'https://themecrowdy.com/demo-content/arolax/insurance-consultancy-agency/site-settings.json',
					'option_name'     => '_elementor_page_settings',
				],
			],
		),

		array(
			'import_file_name'         => esc_html__( 'Consultant Management Agency RTL', 'arolax-essential' ),
			'import_file_url'          => 'https://themecrowdy.com/demo-content/arolax/consultant-management-agency/contents.xml',
			'import_widget_file_url'   => 'https://themecrowdy.com/demo-content/arolax/consultant-management-agency/widgets.wie',
			'import_preview_image_url' => 'https://themecrowdy.com/demo-content/arolax/consultant-management-agency/sc.png',
			'import_notice'            => 'Consultant Management Agency RTL',
			'preview_url'              => 'https://crowdytheme.com/wp/arolax/consultant-management-agency/',
			'import_theme_settings'    => [
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/consultant-management-agency/arolax_settings.xml',
					'option_name'    => 'arolax_settings',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_widgets.xml',
					'option_name'    => 'wcf_save_widgets',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_extensions.xml',
					'option_name'    => 'wcf_save_extensions',
				],
				[
					'option_content'  => '',
					'option_kit_name' => 'elementor_active_kit',
					'file_url'        => 'https://themecrowdy.com/demo-content/arolax/consultant-management-agency/site-settings.json',
					'option_name'     => '_elementor_page_settings',
				],
			],
		),

		array(
			'import_file_name'         => esc_html__( 'Photographer RTL', 'arolax-essential' ),
			'import_file_url'          => 'https://themecrowdy.com/demo-content/arolax/photographer-rtl/contents.xml',
			'import_widget_file_url'   => 'https://themecrowdy.com/demo-content/arolax/photographer-rtl/widgets.wie',
			'import_preview_image_url' => 'https://themecrowdy.com/demo-content/arolax/photographer/sc.png',
			'import_notice'            => 'Photographer RTL',
			'preview_url'              => 'https://crowdytheme.com/wp/arolax/photographer-rtl/',
			'import_theme_settings'    => [
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/photographer-rtl/arolax_settings.xml',
					'option_name'    => 'arolax_settings',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_widgets.xml',
					'option_name'    => 'wcf_save_widgets',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_extensions.xml',
					'option_name'    => 'wcf_save_extensions',
				],
				[
					'option_content'  => '',
					'option_kit_name' => 'elementor_active_kit',
					'file_url'        => 'https://themecrowdy.com/demo-content/arolax/photographer-rtl/site-settings.json',
					'option_name'     => '_elementor_page_settings',
				],
			],
		),

		array(
			'import_file_name'         => esc_html__( 'Digital Marketer RTL', 'arolax-essential' ),
			'import_file_url'          => 'https://themecrowdy.com/demo-content/arolax/digital-marketer/contents.xml',
			'import_widget_file_url'   => 'https://themecrowdy.com/demo-content/arolax/digital-marketer/widgets.wie',
			'import_preview_image_url' => 'https://themecrowdy.com/demo-content/arolax/digital-marketer/sc.png',
			'import_notice'            => 'Digital Marketer RTL',
			'preview_url'              => 'https://crowdytheme.com/wp/arolax/digital-marketer/',
			'import_theme_settings'    => [
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/digital-marketer/arolax_settings.xml',
					'option_name'    => 'arolax_settings',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_widgets.xml',
					'option_name'    => 'wcf_save_widgets',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_extensions.xml',
					'option_name'    => 'wcf_save_extensions',
				],
				[
					'option_content'  => '',
					'option_kit_name' => 'elementor_active_kit',
					'file_url'        => 'https://themecrowdy.com/demo-content/arolax/digital-marketer/site-settings.json',
					'option_name'     => '_elementor_page_settings',
				],
			],
		),

		array(
			'import_file_name'         => esc_html__( 'Event Planner RTL', 'arolax-essential' ),
			'import_file_url'          => 'https://themecrowdy.com/demo-content/arolax/event-planner-rtl/contents.xml',
			'import_widget_file_url'   => 'https://themecrowdy.com/demo-content/arolax/event-planner-rtl/widgets.wie',
			'import_preview_image_url' => 'https://themecrowdy.com/demo-content/arolax/event-planner/sc.png',
			'import_notice'            => 'Event Planner RTL',
			'preview_url'              => 'https://crowdytheme.com/wp/arolax/event-planner-rtl/',
			'import_theme_settings'    => [
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/event-planner-rtl/arolax_settings.xml',
					'option_name'    => 'arolax_settings',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_widgets.xml',
					'option_name'    => 'wcf_save_widgets',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_extensions.xml',
					'option_name'    => 'wcf_save_extensions',
				],
				[
					'option_content'  => '',
					'option_kit_name' => 'elementor_active_kit',
					'file_url'        => 'https://themecrowdy.com/demo-content/arolax/event-planner-rtl/site-settings.json',
					'option_name'     => '_elementor_page_settings',
				],
			],
		),

		array(
			'import_file_name'         => esc_html__( 'Content Writer RTL', 'arolax-essential' ),
			'import_file_url'          => 'https://themecrowdy.com/demo-content/arolax/content-writer-rtl/contents.xml',
			'import_widget_file_url'   => 'https://themecrowdy.com/demo-content/arolax/content-writer-rtl/widgets.wie',
			'import_preview_image_url' => 'https://themecrowdy.com/demo-content/arolax/content-writer/sc.png',
			'import_notice'            => 'Content Writer RTL',
			'preview_url'              => 'https://crowdytheme.com/wp/arolax/content-writer-rtl/',
			'import_theme_settings'    => [
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/content-writer-rtl/arolax_settings.xml',
					'option_name'    => 'arolax_settings',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_widgets.xml',
					'option_name'    => 'wcf_save_widgets',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_extensions.xml',
					'option_name'    => 'wcf_save_extensions',
				],
				[
					'option_content'  => '',
					'option_kit_name' => 'elementor_active_kit',
					'file_url'        => 'https://themecrowdy.com/demo-content/arolax/content-writer-rtl/site-settings.json',
					'option_name'     => '_elementor_page_settings',
				],
			],
		),

		array(
			'import_file_name'         => esc_html__( 'Freelancer RTL', 'arolax-essential' ),
			'import_file_url'          => 'https://themecrowdy.com/demo-content/arolax/freelancer-rtl/contents.xml',
			'import_widget_file_url'   => 'https://themecrowdy.com/demo-content/arolax/freelancer-rtl/widgets.wie',
			'import_preview_image_url' => 'https://themecrowdy.com/demo-content/arolax/freelancer/sc.png',
			'import_notice'            => 'Content Writer',
			'preview_url'              => 'https://crowdytheme.com/wp/arolax/freelancer-rtl/',
			'import_theme_settings'    => [
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/freelancer-rtl/arolax_settings.xml',
					'option_name'    => 'arolax_settings',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_widgets.xml',
					'option_name'    => 'wcf_save_widgets',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_extensions.xml',
					'option_name'    => 'wcf_save_extensions',
				],
				[
					'option_content'  => '',
					'option_kit_name' => 'elementor_active_kit',
					'file_url'        => 'https://themecrowdy.com/demo-content/arolax/freelancer-rtl/site-settings.json',
					'option_name'     => '_elementor_page_settings',
				],
			],
		),

		array(
			'import_file_name'         => esc_html__( 'Web Developer RTL', 'arolax-essential' ),
			'import_file_url'          => 'https://themecrowdy.com/demo-content/arolax/arolax-developer-rtl/contents.xml',
			'import_widget_file_url'   => 'https://themecrowdy.com/demo-content/arolax/arolax-developer-rtl/widgets.wie',
			'import_preview_image_url' => 'https://themecrowdy.com/demo-content/arolax/web-developer/sc.png',
			'import_notice'            => 'Web Developer RTL',
			'preview_url'              => 'https://crowdytheme.com/wp/arolax/arolax-developer-rtl/',
			'import_theme_settings'    => [
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/arolax-developer-rtl/arolax_settings.xml',
					'option_name'    => 'arolax_settings',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_widgets.xml',
					'option_name'    => 'wcf_save_widgets',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_extensions.xml',
					'option_name'    => 'wcf_save_extensions',
				],
				[
					'option_content'  => '',
					'option_kit_name' => 'elementor_active_kit',
					'file_url'        => 'https://themecrowdy.com/demo-content/arolax/arolax-developer-rtl/site-settings.json',
					'option_name'     => '_elementor_page_settings',
				],
			],
		),

		array(
			'import_file_name'         => esc_html__( 'Health Coach RTL', 'arolax-essential' ),
			'import_file_url'          => 'https://themecrowdy.com/demo-content/arolax/health-coach-rtl/contents.xml',
			'import_widget_file_url'   => 'https://themecrowdy.com/demo-content/arolax/health-coach-rtl/widgets.wie',
			'import_preview_image_url' => 'https://themecrowdy.com/demo-content/arolax/health-coach/sc.png',
			'import_notice'            => 'Health Coach RTL',
			'preview_url'              => 'https://crowdytheme.com/wp/arolax/health-coach-rtl/',
			'import_theme_settings'    => [
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/health-coach-rtl/arolax_settings.xml',
					'option_name'    => 'arolax_settings',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_widgets.xml',
					'option_name'    => 'wcf_save_widgets',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_extensions.xml',
					'option_name'    => 'wcf_save_extensions',
				],
				[
					'option_content'  => '',
					'option_kit_name' => 'elementor_active_kit',
					'file_url'        => 'https://themecrowdy.com/demo-content/arolax/health-coach-rtl/site-settings.json',
					'option_name'     => '_elementor_page_settings',
				],
			],
		),

		array(
			'import_file_name'         => esc_html__( 'Resume RTL', 'arolax-essential' ),
			'import_file_url'          => 'https://themecrowdy.com/demo-content/arolax/resume-rtl/contents.xml',
			'import_widget_file_url'   => 'https://themecrowdy.com/demo-content/arolax/resume-rtl/widgets.wie',
			'import_preview_image_url' => 'https://themecrowdy.com/demo-content/arolax/resume/sc.png',
			'import_notice'            => 'Resume RTL',
			'preview_url'              => 'https://crowdytheme.com/wp/arolax/resume-rtl/',
			'import_theme_settings'    => [
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/resume-rtl/arolax_settings.xml',
					'option_name'    => 'arolax_settings',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_widgets.xml',
					'option_name'    => 'wcf_save_widgets',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_extensions.xml',
					'option_name'    => 'wcf_save_extensions',
				],
				[
					'option_content'  => '',
					'option_kit_name' => 'elementor_active_kit',
					'file_url'        => 'https://themecrowdy.com/demo-content/arolax/resume-rtl/site-settings.json',
					'option_name'     => '_elementor_page_settings',
				],
			],
		),

		array(
			'import_file_name'         => esc_html__( 'Personal Portfolio RTL', 'arolax-essential' ),
			'import_file_url'          => 'https://themecrowdy.com/demo-content/arolax/personal-portfolio-rtl/contents.xml',
			'import_widget_file_url'   => 'https://themecrowdy.com/demo-content/arolax/personal-portfolio-rtl/widgets.wie',
			'import_preview_image_url' => 'https://themecrowdy.com/demo-content/arolax/personal-portfolio/sc.png',
			'import_notice'            => 'Personal Portfolio RTL',
			'preview_url'              => 'https://crowdytheme.com/wp/arolax/personal-portfolio-rtl/',
			'import_theme_settings'    => [
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/personal-portfolio-rtl/arolax_settings.xml',
					'option_name'    => 'arolax_settings',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_widgets.xml',
					'option_name'    => 'wcf_save_widgets',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/web-agency/wcf_save_extensions.xml',
					'option_name'    => 'wcf_save_extensions',
				],
				[
					'option_content'  => '',
					'option_kit_name' => 'elementor_active_kit',
					'file_url'        => 'https://themecrowdy.com/demo-content/arolax/personal-portfolio-rtl/site-settings.json',
					'option_name'     => '_elementor_page_settings',
				],
			],
		),

		array(
			'import_file_name'         => esc_html__( 'Digital Agency Two', 'arolax-essential' ),
			'import_file_url'          => 'https://themecrowdy.com/demo-content/arolax/digital-agency-two/contents.xml',
			'import_widget_file_url'   => 'https://themecrowdy.com/demo-content/arolax/digital-agency-two/widgets.wie',
			'import_preview_image_url' => 'https://themecrowdy.com/demo-content/arolax/digital-agency-two/sc.png',
			'import_notice'            => 'Digital Agency Two',
			'preview_url'              => 'https://crowdytheme.com/wp/arolax/digital-agency-two/',
			'import_theme_settings'    => [
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/digital-agency-two/arolax_settings.xml',
					'option_name'    => 'arolax_settings',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/digital-agency-two/wcf_save_widgets.xml',
					'option_name'    => 'wcf_save_widgets',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/digital-agency-two/wcf_save_extensions.xml',
					'option_name'    => 'wcf_save_extensions',
				],
				[
					'option_content'  => '',
					'option_kit_name' => 'elementor_active_kit',
					'file_url'        => 'https://themecrowdy.com/demo-content/arolax/digital-agency-two/site-settings.json',
					'option_name'     => '_elementor_page_settings',
				],
			],
		),

		array(
			'import_file_name'         => esc_html__( 'Creative Agency Three', 'arolax-essential' ),
			'import_file_url'          => 'https://themecrowdy.com/demo-content/arolax/creative-agency-three/contents.xml',
			'import_widget_file_url'   => 'https://themecrowdy.com/demo-content/arolax/creative-agency-three/widgets.wie',
			'import_preview_image_url' => 'https://themecrowdy.com/demo-content/arolax/creative-agency-three/sc.png',
			'import_notice'            => 'Creative Agency Three',
			'preview_url'              => 'https://crowdytheme.com/wp/arolax/creative-agency-three/',
			'import_theme_settings'    => [
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/creative-agency-three/arolax_settings.xml',
					'option_name'    => 'arolax_settings',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/creative-agency-three/wcf_save_widgets.xml',
					'option_name'    => 'wcf_save_widgets',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/creative-agency-three/wcf_save_extensions.xml',
					'option_name'    => 'wcf_save_extensions',
				],
				[
					'option_content'  => '',
					'option_kit_name' => 'elementor_active_kit',
					'file_url'        => 'https://themecrowdy.com/demo-content/arolax/creative-agency-three/site-settings.json',
					'option_name'     => '_elementor_page_settings',
				],
			],
		),

		array(
			'import_file_name'         => esc_html__( 'Startup Agency Two', 'arolax-essential' ),
			'import_file_url'          => 'https://themecrowdy.com/demo-content/arolax/startup-agency-two/contents.xml',
			'import_widget_file_url'   => 'https://themecrowdy.com/demo-content/arolax/startup-agency-two/widgets.wie',
			'import_preview_image_url' => 'https://themecrowdy.com/demo-content/arolax/startup-agency-two/sc.png',
			'import_notice'            => 'Startup Agency Two',
			'preview_url'              => 'https://crowdytheme.com/wp/arolax/startup-agency-two/',
			'import_theme_settings'    => [
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/startup-agency-two/arolax_settings.xml',
					'option_name'    => 'arolax_settings',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/startup-agency-two/wcf_save_widgets.xml',
					'option_name'    => 'wcf_save_widgets',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/startup-agency-two/wcf_save_extensions.xml',
					'option_name'    => 'wcf_save_extensions',
				],
				[
					'option_content'  => '',
					'option_kit_name' => 'elementor_active_kit',
					'file_url'        => 'https://themecrowdy.com/demo-content/arolax/startup-agency-two/site-settings.json',
					'option_name'     => '_elementor_page_settings',
				],
			],
		),

		array(
			'import_file_name'         => esc_html__( 'Digital Studio Two', 'arolax-essential' ),
			'import_file_url'          => 'https://themecrowdy.com/demo-content/arolax/design-studio-two/contents.xml',
			'import_widget_file_url'   => 'https://themecrowdy.com/demo-content/arolax/design-studio-two/widgets.wie',
			'import_preview_image_url' => 'https://themecrowdy.com/demo-content/arolax/design-studio-two/sc.png',
			'import_notice'            => 'Digital Studio Two',
			'preview_url'              => 'https://crowdytheme.com/wp/arolax/design-studio-two/',
			'import_theme_settings'    => [
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/design-studio-two/arolax_settings.xml',
					'option_name'    => 'arolax_settings',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/design-studio-two/wcf_save_widgets.xml',
					'option_name'    => 'wcf_save_widgets',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/design-studio-two/wcf_save_extensions.xml',
					'option_name'    => 'wcf_save_extensions',
				],
				[
					'option_content'  => '',
					'option_kit_name' => 'elementor_active_kit',
					'file_url'        => 'https://themecrowdy.com/demo-content/arolax/design-studio-two/site-settings.json',
					'option_name'     => '_elementor_page_settings',
				],
			],
		),

		array(
			'import_file_name'         => esc_html__( 'Creative Branding Agency', 'arolax-essential' ),
			'import_file_url'          => 'https://themecrowdy.com/demo-content/arolax/creative-branding-agency/contents.xml',
			'import_widget_file_url'   => 'https://themecrowdy.com/demo-content/arolax/creative-branding-agency/widgets.wie',
			'import_preview_image_url' => 'https://themecrowdy.com/demo-content/arolax/creative-branding-agency/sc.png',
			'import_notice'            => 'Creative Branding Agency',
			'preview_url'              => 'https://crowdytheme.com/wp/arolax/creative-branding-agency/',
			'import_theme_settings'    => [
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/creative-branding-agency/arolax_settings.xml',
					'option_name'    => 'arolax_settings',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/creative-branding-agency/wcf_save_widgets.xml',
					'option_name'    => 'wcf_save_widgets',
				],
				[
					'option_content' => '',
					'file_url'       => 'https://themecrowdy.com/demo-content/arolax/creative-branding-agency/wcf_save_extensions.xml',
					'option_name'    => 'wcf_save_extensions',
				],
				[
					'option_content'  => '',
					'option_kit_name' => 'elementor_active_kit',
					'file_url'        => 'https://themecrowdy.com/demo-content/arolax/creative-branding-agency/site-settings.json',
					'option_name'     => '_elementor_page_settings',
				],
			],
		),

	);
}

function arolax_after_import_setup( $selected_import ) {

	$main_menu = get_term_by( 'name', 'primary', 'nav_menu' );
	if ( isset( $main_menu->term_id ) ) {
		set_theme_mod( 'nav_menu_locations', [
				'main-menu' => $main_menu->term_id,
				// replace 'main-menu' here with the menu location identifier from register_nav_menu() function in your theme.
			]
		);
	}


	// Get the front page.
	$front_page = get_posts(
		[
			'post_type'              => 'page',
			'title'                      => 'Home',
			'post_status'            => 'all',
			'numberposts'            => 1,
			'update_post_term_cache' => false,
			'update_post_meta_cache' => false,
		]
	);

	if ( ! empty( $front_page ) ) {
		update_option( 'page_on_front', $front_page[0]->ID );
	}

	// Get the blog page.
	$blog_page = get_posts(
		[
			'post_type'   => 'page',
			'title'           => 'Blog',
			'post_status' => 'all',
			'numberposts' => 1,
		]
	);

	if ( ! empty( $blog_page ) ) {
		update_option( 'page_for_posts', $blog_page[0]->ID );
	}

	if ( ! empty( $blog_page ) || ! empty( $front_page ) ) {
		update_option( 'show_on_front', 'page' );
	}

	// Disable Elementor's Default Colors and Default Fonts
	update_option( 'elementor_disable_color_schemes', 'yes' );
	update_option( 'elementor_disable_typography_schemes', 'yes' );
	update_option( 'elementor_global_image_lightbox', 'yes' );
	if ( defined( 'ELEMENTOR_VERSION' ) && class_exists( 'Elementor\Plugin' ) ) {
		//\Elementor\Plugin::$instance->files_manager->clear_cache();
	}


}

add_action( 'wcfio/after_import', 'arolax_after_import_setup' );

function ocdi_before_content_import( $selected_import ) {

	if ( isset( $selected_import['import_theme_settings'] ) && is_array( $selected_import['import_theme_settings'] ) ) {
		$settings = $selected_import['import_theme_settings'];
		foreach ( $settings as $item ) {
			wcf_option_update( $item['option_content'], $item['option_name'] );
		}
	}
}


function wcf_option_update( $value, $option_name ) {
	if ( $value ) {
		global $wpdb;
		$new_value = $value;

		$result = $wpdb->update(
			$wpdb->options,
			array( 'option_value' => $new_value ),
			array( 'option_name' => $option_name ),
			array( '%s' ),
			array( '%s' )
		);
	}
}


function arolax_ocdi_before_content_import( $selected_import ) {

	if ( isset( $selected_import['import_theme_settings'] ) && is_array( $selected_import['import_theme_settings'] ) ) {
		$settings = $selected_import['import_theme_settings'];
		foreach ( $settings as $item ) {
			$response = wp_remote_get( $item['file_url'] );
			if ( isset( $item['option_kit_name'] ) ) {

				if ( is_array( $response ) && ! is_wp_error( $response ) ) {
					$json_data = wp_remote_retrieve_body( $response );
					wcf_update_elementor_global_settings( $json_data );
				}

			} else {
				if ( is_array( $response ) && ! is_wp_error( $response ) ) {
					$headers  = $response['headers']; // array of http header lines
					$xml_data = wp_remote_retrieve_body( $response );
					$xml      = simplexml_load_string( $xml_data );
					// Extract the serialized value
					$serialized_data = (string) $xml->value;
					if ( is_string( $serialized_data ) ) {
						$arr = unserialize( $serialized_data );
						if ( is_array( $arr ) ) {
							update_option( $item['option_name'], $arr );
						}
					}
				}
			}

		}
	}
	if ( isset( $_GET['page'] ) && $_GET['page'] === 'wcf-theme-demo-import' && isset( $_GET['import'] ) ) {

	}

}

add_action( 'wcfio/before_content_import', 'arolax_ocdi_before_content_import' );

function wcf_update_elementor_global_settings( $elementor ) {

	$activeKitId = get_option( 'elementor_active_kit' );
	$kit_data    = json_decode( $elementor, true );
	if ( $activeKitId ) {
		$postMeta = get_post_meta( $activeKitId, '_elementor_page_settings', true );
		// Ensure $postMeta is an array
		$newPostMeta = is_array( $postMeta ) ? $postMeta : [];
		// Add or override custom colors
		if ( $kit_data && isset( $kit_data['settings'] ) ) {
			$newPostMeta = $kit_data['settings'];
			update_post_meta( $activeKitId, '_elementor_page_settings', $newPostMeta );
		}
	}
}