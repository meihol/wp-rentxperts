<?php
/**
 * Animation Effects extension class.
 */

namespace WCFAddonsEX\Extensions;

use Elementor\Element_Base;
use Elementor\Controls_Manager;
use Elementor\Plugin;

defined( 'ABSPATH' ) || die();

class WCF_Animation_Effects {

	public static function init() {

		//animation controls
		add_action( 'elementor/element/common/_section_style/after_section_end', [
			__CLASS__,
			'register_animation_controls',
		] );

		add_action( 'elementor/element/container/section_layout/after_section_end', [
			__CLASS__,
			'register_animation_controls'
		] );

		add_action( 'elementor/frontend/widget/before_render', [ __CLASS__, 'wcf_attributes' ] );
		add_action( 'elementor/frontend/container/before_render', [ __CLASS__, 'wcf_attributes' ] );

		add_action( 'elementor/preview/enqueue_scripts', [ __CLASS__, 'enqueue_scripts' ] );
	}

	public static function enqueue_scripts() {

	}

	/**
	 * Set attributes based extension settings
	 *
	 * @param Element_Base $section
	 *
	 * @return void
	 */
	public static function wcf_attributes( $element ) {
		if ( ! empty( $element->get_settings( 'wcf_enable_scroll_smoother' ) ) ) {
			$attributes = [];

			if ( ! empty( $element->get_settings( 'data-speed' ) ) ) {
				$attributes['data-speed'] = $element->get_settings( 'data-speed' );
			}
			if ( ! empty( $element->get_settings( 'data-lag' ) ) ) {
				$attributes['data-lag'] = $element->get_settings( 'data-lag' );
			}

			$element->add_render_attribute( '_wrapper', $attributes );
		}
	}

	public static function register_animation_controls( $element ) {
		$element->start_controls_section(
			'_section_wcf_animation',
			[
				'label' => sprintf( '<i class="wcf-logo"></i> %s <span class="wcfpro_text">%s<span>', __( 'Animation', 'wcf-addons-pro' ), __( 'Pro', 'wcf-addons-pro' ) ),
				'tab'   => Controls_Manager::TAB_ADVANCED,
			]
		);

		$element->add_control(
			'wcf-animation',
			[
				'label'              => esc_html__( 'Animation', 'wcf-addons-pro' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'none',
				'separator'          => 'before',
				'options'            => [
					'none' => esc_html__( 'none', 'wcf-addons-pro' ),
					'fade' => esc_html__( 'fade animation', 'wcf-addons-pro' ),
					'move'  => esc_html__( '3D Move', 'wcf-addons-pro' ),
				],
				'render_type'        => 'none', // template
				'frontend_available' => true,
			]
		);

		$element->add_control(
			'wcf_enable_animation_editor',
			[
				'label'              => esc_html__( 'Enable On Editor', 'wcf-addons-pro' ),
				'description'        => esc_html__( 'For better performance in editor mode, keep the setting turned off.', 'wcf-addons-pro' ),
				'type'               => Controls_Manager::SWITCHER,
				'frontend_available' => true,
				'return_value'       => 'yes',
				'condition'          => [
					'wcf-animation!' => 'none',
				],
			]
		);

		$element->add_control(
			'play_animation_content',
			[
				'label' => esc_html__( 'Play Animation', 'wcf-addons-pro' ),
				'type' => \Elementor\Controls_Manager::BUTTON,
				'separator' => 'before',
				'button_type' => 'success',
				'text' => esc_html__( 'Play', 'wcf-addons-pro' ),
				'event' => 'wcf:editor:play_animation',
				'condition'          => [
					'wcf-animation' => 'none',
					'wcf_enable_animation_editor' => 'yes'
				],
			]
		);

		$element->add_control(
			'delay',
			[
				'label'              => esc_html__( 'Delay', 'wcf-addons-pro' ),
				'type'               => Controls_Manager::NUMBER,
				'min'                => 0,
				'max'                => 10,
				'step'               => 0.1,
				'default'            => .15,
				'render_type'        => 'none', // template
				'condition'          => [
					'wcf-animation!' => 'none',
				],
				'frontend_available' => true,
			]
		);

		$element->add_control(
			'on-scroll',
			[
				'label'              => esc_html__( 'Animation on scroll', 'wcf-addons-pro' ),
				'type'               => Controls_Manager::SWITCHER,
				'label_on'           => esc_html__( 'Yes', 'wcf-addons-pro' ),
				'label_off'          => esc_html__( 'No', 'wcf-addons-pro' ),
				'return_value'       => 1,
				'default'            => 1,
				'render_type'        => 'none', // template
				'frontend_available' => true,
				'condition'          => [
					'wcf-animation!' => 'none',
				],
			]
		);

		$element->add_control(
			'fade-from',
			[
				'label'              => esc_html__( 'Fade from', 'wcf-addons-pro' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'bottom',
				'render_type'        => 'none', // template
				'options'            => [
					'top'    => esc_html__( 'Top', 'wcf-addons-pro' ),
					'bottom' => esc_html__( 'Bottom', 'wcf-addons-pro' ),
					'left'   => esc_html__( 'Left', 'wcf-addons-pro' ),
					'right'  => esc_html__( 'Right', 'wcf-addons-pro' ),
					'in'     => esc_html__( 'In', 'wcf-addons-pro' ),
					'scale'  => esc_html__( 'Zoom', 'wcf-addons-pro' ),
				],
				'frontend_available' => true,
				'condition'          => [
					'wcf-animation' => 'fade',
				],
			]
		);

		$element->add_control(
			'data-duration',
			[
				'label'              => esc_html__( 'Duration', 'wcf-addons-pro' ),
				'type'               => Controls_Manager::NUMBER,
				'default'            => 1.5,
				'render_type'        => 'none', // template
				'condition'          => [
					'wcf-animation!' => 'none',
				],
				'frontend_available' => true,
			]
		);

		$element->add_control(
			'ease',
			[
				'label'              => esc_html__( 'Ease', 'wcf-addons-pro' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'power2.out',
				'render_type'        => 'none', // template
				'options'            => [
					'power2.out' => esc_html__( 'Power2.out', 'wcf-addons-pro' ),
					'bounce'     => esc_html__( 'Bounce', 'wcf-addons-pro' ),
					'back'       => esc_html__( 'Back', 'wcf-addons-pro' ),
					'elastic'    => esc_html__( 'Elastic', 'wcf-addons-pro' ),
					'slowmo'     => esc_html__( 'Slowmo', 'wcf-addons-pro' ),
					'stepped'    => esc_html__( 'Stepped', 'wcf-addons-pro' ),
					'sine'       => esc_html__( 'Sine', 'wcf-addons-pro' ),
					'expo'       => esc_html__( 'Expo', 'wcf-addons-pro' ),
				],
				'condition'          => [
					'wcf-animation!' => 'none',
				],
				'frontend_available' => true,
			]
		);

		$element->add_control(
			'fade-offset',
			[
				'label'              => esc_html__( 'Fade offset', 'wcf-addons-pro' ),
				'type'               => Controls_Manager::NUMBER,
				'default'            => 50,
				'render_type'        => 'none', // template
				'condition'          => [
					'fade-from!' => [ 'in', 'scale' ],
					'wcf-animation' => 'fade',
				],
				'frontend_available' => true,
			]
		);

		//scale
		$element->add_control(
			'wcf-a-scale',
			[
				'label'              => esc_html__( 'Start Scale', 'wcf-addons-pro' ),
				'type'               => Controls_Manager::NUMBER,
				'default'            => 0.7,
				'condition'          => [
					'fade-from' => 'scale',
					'wcf-animation' => 'fade',
				],
				'render_type'        => 'none',
				'frontend_available' => true,
			]
		);

		//move
		$element->add_control(
			'wcf_a_rotation_di',
			[
				'label'              => esc_html__( 'Rotation Direction', 'wcf-addons-pro' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'x',
				'separator'          => 'before',
				'options'            => [
					'x' => esc_html__( 'X', 'wcf-addons-pro' ),
					'y' => esc_html__( 'Y', 'wcf-addons-pro' ),
				],
				'condition'          => [
					'wcf-animation' => 'move',
				],
				'frontend_available' => true,
				'render_type'        => 'none',
			]
		);

		$element->add_control(
			'wcf_a_rotation',
			[
				'label'              => esc_html__( 'Rotation Value', 'wcf-addons-pro' ),
				'type'               => Controls_Manager::NUMBER,
				'default'            => '-80',
				'condition'          => [
					'wcf-animation' => 'move',
				],
				'frontend_available' => true,
				'render_type'        => 'none',
			]
		);

		$element->add_control(
			'wcf_a_transform_origin',
			[
				'label'              => esc_html__( 'transformOrigin', 'wcf-addons-pro' ),
				'type'               => Controls_Manager::TEXT,
				'frontend_available' => true,
				'default'            => esc_html__( 'top center -50', 'wcf-addons-pro' ),
				'placeholder'        => esc_html__( 'top center', 'wcf-addons-pro' ),
				'condition'          => [
					'wcf-animation' => 'move',
				],
				'render_type'        => 'none',
			]
		);

		$dropdown_options = [
			'' => esc_html__( 'All', 'wcf-addons-pro' ),
		];

		foreach ( Plugin::$instance->breakpoints->get_active_breakpoints() as $breakpoint_key => $breakpoint_instance ) {

			$dropdown_options[ $breakpoint_key ] = sprintf(
			/* translators: 1: Breakpoint label, 2: `>` character, 3: Breakpoint value. */
				esc_html__( '%1$s (%2$dpx)', 'wcf-addons-pro' ),
				$breakpoint_instance->get_label(),
				$breakpoint_instance->get_value()
			);
		}

		$element->add_control(
			'fade_animation_breakpoint',
			[
				'label'              => esc_html__( 'Breakpoint', 'wcf-addons-pro' ),
				'type'               => Controls_Manager::SELECT,
				'description'        => esc_html__( 'Note: Choose at which breakpoint animation will work.', 'wcf-addons-pro' ),
				'options'            => $dropdown_options,
				'frontend_available' => true,
				'render_type'        => 'none', // template
				'default'            => '',
				'condition'          => [
					'wcf-animation!' => 'none',
				],
			]
		);

		$element->add_control(
			'fade_breakpoint_min_max',
			[
				'label'     => esc_html__( 'Breakpoint Min/Max', 'wcf-addons-pro' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'min',
				'render_type'        => 'none', // template
				'options'   => [
					'min' => esc_html__( 'Min(>)', 'wcf-addons-pro' ),
					'max' => esc_html__( 'Max(<)', 'wcf-addons-pro' ),
				],
				'frontend_available' => true,
				'condition' => [
					'wcf-animation!'        => 'none',
					'fade_animation_breakpoint!' => '',
				],
			]
		);

		//smooth scroll animation
		$element->add_control(
			'wcf_enable_scroll_smoother',
			[
				'label'        => esc_html__( 'Enable Scroll Smoother', 'wcf-addons-pro' ),
				'description'  => esc_html__( 'If you want to use scroll smooth, please enable global settings first', 'wcf-addons-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'wcf-addons-pro' ),
				'label_off'    => esc_html__( 'No', 'wcf-addons-pro' ),
				'return_value' => 'yes',
				'render_type'        => 'none', // template
				'separator'    => 'before',
			]
		);

		$element->add_control(
			'data-speed',
			[
				'label'     => esc_html__( 'Speed', 'wcf-addons-pro' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 0.9,
				'render_type'        => 'none', // template
				'condition' => [ 'wcf_enable_scroll_smoother' => 'yes' ],
			]
		);

		$element->add_control(
			'data-lag',
			[
				'label'     => esc_html__( 'Lag', 'wcf-addons-pro' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 0,
				'render_type'        => 'none', // template
				'condition' => [ 'wcf_enable_scroll_smoother' => 'yes' ],
			]
		);

		$element->end_controls_section();
	}

}

WCF_Animation_Effects::init();


