<?php
/**
 * Animation Effects extension class.
 */

namespace WCFAddonsEX\Extensions;

use Elementor\Controls_Manager;
use Elementor\Plugin;

defined( 'ABSPATH' ) || die();

class WCF_Pin_Effects {

	public static function init() {
		//ping area controls
		add_action( 'elementor/element/section/section_advanced/after_section_end', [
			__CLASS__,
			'register_ping_area_controls'
		] );

		add_action( 'elementor/element/container/section_layout/after_section_end', [
			__CLASS__,
			'register_ping_area_controls'
		] );
	}

	public static function register_ping_area_controls( $element ) {
		$element->start_controls_section(
			'_section_pin-area',
			[
				'label' => sprintf( '<i class="wcf-logo"></i> %s <span class="wcfpro_text">%s<span>', __( 'Pin Element', 'wcf-addons-pro' ), __( 'Pro', 'wcf-addons-pro' ) ),
				'tab'   => Controls_Manager::TAB_ADVANCED,
			]
		);

		$element->add_control(
			'wcf_enable_pin_area',
			[
				'label'              => esc_html__( 'Enable Pin', 'wcf-addons-pro' ),
				'type'               => Controls_Manager::SWITCHER,
				'frontend_available' => true,
				'render_type'        => 'none',
				'return_value'       => 'yes',
			]
		);

		$element->add_control(
			'wcf_pin_alert',
			[
				'label'           => esc_html__( 'Important Note', 'wcf-addons-pro' ),
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => esc_html__( 'Please use full width Container to work properly and see the result in view mode.', 'wcf-addons-pro' ),
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
				'condition'       => [ 'wcf_enable_pin_area!' => '' ],
				'render_type'     => 'none',
			]
		);

		$element->add_control(
			'wcf_pin_area_trigger',
			[
				'label'       => esc_html__( 'Pin Wrapper', 'wcf-addons-pro' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => '',
				'options'     => [
					''       => esc_html__( 'Default', 'wcf-addons-pro' ),
					'custom' => esc_html__( 'Custom', 'wcf-addons-pro' ),
				],
				'condition'   => [ 'wcf_enable_pin_area!' => '' ],
				'render_type' => 'none',
			]
		);

		$element->add_control(
			'wcf_custom_pin_area',
			[
				'label'              => esc_html__( 'Custom Pin Area', 'wcf-addons-pro' ),
				'description'        => esc_html__( 'Add the section class where the element will be pin. please use the parent section or container class.', 'wcf-addons-pro' ),
				'type'               => Controls_Manager::TEXT,
				'ai'                 => false,
				'placeholder'        => esc_html__( '.pin_area', 'wcf-addons-pro' ),
				'frontend_available' => true,
				'render_type'        => 'none',
				'condition'          => [
					'wcf_pin_area_trigger' => 'custom',
					'wcf_enable_pin_area!' => '',
				]
			]
		);

		$element->add_control(
			'wcf_pin_end_trigger',
			[
				'label'              => esc_html__( 'End Trigger', 'wcf-addons-pro' ),
				'type'               => Controls_Manager::TEXT,
				'ai'                 => false,
				'placeholder'        => esc_html__( '.end_trigger', 'wcf-addons-pro' ),
				'frontend_available' => true,
				'render_type'        => 'none',
				'condition'          => [
					'wcf_enable_pin_area!' => '',
				]
			]
		);

		$element->add_control(
			'wcf_pin_area_start',
			[
				'label'              => esc_html__( 'Start', 'wcf-addons-pro' ),
				'description'        => esc_html__( 'First value is element position, Second value is display position', 'wcf-addons-pro' ),
				'type'               => Controls_Manager::SELECT,
				'separator'          => 'before',
				'default'            => 'top top',
				'frontend_available' => true,
				'options'            => [
					'top top'       => esc_html__( 'Top Top', 'wcf-addons-pro' ),
					'top center'    => esc_html__( 'Top Center', 'wcf-addons-pro' ),
					'top bottom'    => esc_html__( 'Top Bottom', 'wcf-addons-pro' ),
					'center top'    => esc_html__( 'Center Top', 'wcf-addons-pro' ),
					'center center' => esc_html__( 'Center Center', 'wcf-addons-pro' ),
					'center bottom' => esc_html__( 'Center Bottom', 'wcf-addons-pro' ),
					'bottom top'    => esc_html__( 'Bottom Top', 'wcf-addons-pro' ),
					'bottom center' => esc_html__( 'Bottom Center', 'wcf-addons-pro' ),
					'bottom bottom' => esc_html__( 'Bottom Bottom', 'wcf-addons-pro' ),
					'custom'        => esc_html__( 'custom', 'wcf-addons-pro' ),
				],
				'render_type'        => 'none',
				'condition'          => [ 'wcf_enable_pin_area!' => '' ],

			]
		);

		$element->add_control(
			'wcf_pin_area_start_custom',
			[
				'label'              => esc_html__( 'Custom', 'wcf-addons-pro' ),
				'type'               => Controls_Manager::TEXT,
				'default'            => esc_html__( 'top top', 'wcf-addons-pro' ),
				'placeholder'        => esc_html__( 'top top+=100', 'wcf-addons-pro' ),
				'frontend_available' => true,
				'render_type'        => 'none',
				'condition'          => [
					'wcf_enable_pin_area!' => '',
					'wcf_pin_area_start'   => 'custom',
				],
			]
		);

		$element->add_control(
			'wcf_pin_area_end',
			[
				'label'              => esc_html__( 'End', 'wcf-addons-pro' ),
				'description'        => esc_html__( 'First value is element position, Second value is display position', 'wcf-addons-pro' ),
				'type'               => Controls_Manager::SELECT,
				'separator'          => 'before',
				'default'            => 'bottom top',
				'frontend_available' => true,
				'render_type'        => 'none',
				'options'            => [
					'top top'       => esc_html__( 'Top Top', 'wcf-addons-pro' ),
					'top center'    => esc_html__( 'Top Center', 'wcf-addons-pro' ),
					'top bottom'    => esc_html__( 'Top Bottom', 'wcf-addons-pro' ),
					'center top'    => esc_html__( 'Center Top', 'wcf-addons-pro' ),
					'center center' => esc_html__( 'Center Center', 'wcf-addons-pro' ),
					'center bottom' => esc_html__( 'Center Bottom', 'wcf-addons-pro' ),
					'bottom top'    => esc_html__( 'Bottom Top', 'wcf-addons-pro' ),
					'bottom center' => esc_html__( 'Bottom Center', 'wcf-addons-pro' ),
					'bottom bottom' => esc_html__( 'Bottom Bottom', 'wcf-addons-pro' ),
					'custom'        => esc_html__( 'custom', 'wcf-addons-pro' ),
				],
				'condition'          => [ 'wcf_enable_pin_area!' => '' ],
			]
		);

		$element->add_control(
			'wcf_pin_area_end_custom',
			[
				'label'              => esc_html__( 'Custom', 'wcf-addons-pro' ),
				'type'               => Controls_Manager::TEXT,
				'frontend_available' => true,
				'render_type'        => 'none',
				'default'            => esc_html__( 'bottom top', 'wcf-addons-pro' ),
				'placeholder'        => esc_html__( 'bottom top+=100', 'wcf-addons-pro' ),
				'condition'          => [
					'wcf_enable_pin_area!' => '',
					'wcf_pin_area_end'     => 'custom',
				],
			]
		);

		$dropdown_options = [
			'' => esc_html__( 'None', 'wcf-addons-pro' ),
		];

		$excluded_breakpoints = [
			'laptop',
			'tablet_extra',
			'widescreen',
		];

		foreach ( Plugin::$instance->breakpoints->get_active_breakpoints() as $breakpoint_key => $breakpoint_instance ) {
			// Exclude the larger breakpoints from the dropdown selector.
			if ( in_array( $breakpoint_key, $excluded_breakpoints, true ) ) {
				continue;
			}

			$dropdown_options[ $breakpoint_key ] = sprintf(
			/* translators: 1: Breakpoint label, 2: `>` character, 3: Breakpoint value. */
				esc_html__( '%1$s (%2$s %3$dpx)', 'wcf-addons-pro' ),
				$breakpoint_instance->get_label(),
				'>',
				$breakpoint_instance->get_value()
			);
		}

		$element->add_control(
			'wcf_pin_breakpoint',
			[
				'label'              => esc_html__( 'Breakpoint', 'wcf-addons-pro' ),
				'type'               => Controls_Manager::SELECT,
				'separator'          => 'before',
				'description'        => esc_html__( 'Note: Choose at which breakpoint Pin element will work.', 'wcf-addons-pro' ),
				'options'            => $dropdown_options,
				'frontend_available' => true,
				'render_type'        => 'none',
				'default'            => 'mobile',
				'condition'          => [ 'wcf_enable_pin_area!' => '' ],
			]
		);

		$element->end_controls_section();
	}
}

WCF_Pin_Effects::init();
