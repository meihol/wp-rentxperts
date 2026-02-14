<?php
/**
 * Animation Effects extension class.
 */

namespace WCFAddonsEX\Extensions;

use Elementor\Element_Base;
use Elementor\Controls_Manager;
use Elementor\Plugin;

defined( 'ABSPATH' ) || die();

class WCF_Image_Animation_Effects {

	public static function init() {

		$image_elements = [
			[
				'name'    => 'image',
				'section' => 'section_image',
			],
			[
				'name'    => 'wcf--image',
				'section' => 'section_content',
			],
		];
		foreach ( $image_elements as $element ) {
			add_action( 'elementor/element/' . $element['name'] . '/' . $element['section'] . '/after_section_end', [
				__CLASS__,
				'register_image_animation_controls',
			], 10, 2 );
		}

		//image reveal
		$image_reveal_elements = [
			[
				'name'    => 'wcf--image-box',
				'section' => 'section_button_content',
			],
			[
				'name'    => 'wcf--timeline',
				'section' => 'section_timeline',
			],
		];
		foreach ( $image_reveal_elements as $element ) {
			add_action( 'elementor/element/' . $element['name'] . '/' . $element['section'] . '/after_section_end', [
				__CLASS__,
				'register_image_reveal_animation_controls',
			], 10, 2 );
		}
	}

	public static function register_image_animation_controls( $element ) {
		$element->start_controls_section(
			'_section_wcf_image_animation',
			[
				'label' => sprintf( '<i class="wcf-logo"></i> %s <span class="wcfpro_text">%s<span>', __( 'Image Animation', 'wcf-addons-pro' ), __( 'Pro', 'wcf-addons-pro' ) ),
			]
		);

		$element->add_control(
			'wcf-image-animation',
			[
				'label'              => esc_html__( 'Animation', 'wcf-addons-pro' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'none',
				'separator'          => 'before',
				'options'            => [
					'none'    => esc_html__( 'none', 'wcf-addons-pro' ),
					'reveal'  => esc_html__( 'Reveal', 'wcf-addons-pro' ),
					'scale'   => esc_html__( 'Scale', 'wcf-addons-pro' ),
					'stretch' => esc_html__( 'Stretch', 'wcf-addons-pro' ),
				],
				'render_type'        => 'none',
				'frontend_available' => true,
			]
		);

		$element->add_control(
			'wcf_img_animation_editor',
			[
				'label'              => esc_html__( 'Enable On Editor', 'wcf-addons-pro' ),
				'description'        => esc_html__( 'For better performance in editor mode, keep the setting turned off.', 'wcf-addons-pro' ),
				'type'               => Controls_Manager::SWITCHER,
				'frontend_available' => true,
				'return_value'       => 'yes',
				'condition'          => [
					'wcf-image-animation!' => 'none',
				],
			]
		);

		$element->add_control(
			'play_image_animation',
			[
				'label' => esc_html__( 'Play Animation', 'wcf-addons-pro' ),
				'type' => Controls_Manager::BUTTON,
				'separator' => 'before',
				'button_type' => 'success',
				'text' => esc_html__( 'Play', 'wcf-addons-pro' ),
				'event' => 'wcf:editor:play_animation',
				'condition'          => [
					'wcf-image-animation!' => 'none',
					'wcf_img_animation_editor' => 'yes'
				],
			]
		);

		$element->add_control(
			'wcf-scale-start',
			[
				'label'     => esc_html__( 'Start Scale', 'wcf-addons-pro' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 0.7,
				'condition' => [ 'wcf-image-animation' => 'scale' ],
				'render_type'        => 'none',
				'frontend_available' => true,
			]
		);

		$element->add_control(
			'wcf-scale-end',
			[
				'label'     => esc_html__( 'End Scale', 'wcf-addons-pro' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 1,
				'condition' => [ 'wcf-image-animation' => 'scale' ],
				'render_type'        => 'none',
				'frontend_available' => true,
			]
		);

		$element->add_control(
			'wcf-animation-start',
			[
				'label'              => esc_html__( 'Animation Start', 'wcf-addons-pro' ),
				'description'        => esc_html__( 'First value is element position, Second value is display position', 'wcf-addons-pro' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'top top',
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
					'custom'        => esc_html__( 'Custom', 'wcf-addons-pro' ),
				],
				'condition'          => [ 'wcf-image-animation' => 'scale' ],
			]
		);

		$element->add_control(
			'wcf_animation_custom_start',
			[
				'label'       => esc_html__( 'Custom', 'wcf-addons-pro' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'top 90%', 'wcf-addons-pro' ),
				'placeholder' => esc_html__( 'top 90%', 'wcf-addons-pro' ),
				'render_type'        => 'none',
				'condition'   => [
					'wcf-image-animation' => 'scale',
					'wcf-animation-start' => 'custom'
				],
				'frontend_available' => true,
			]
		);

		$element->add_control(
			'image-ease',
			[
				'label'              => esc_html__( 'Data ease', 'wcf-addons-pro' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'power2.out',
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
				'condition'          => [ 'wcf-image-animation' => 'reveal' ],
				'render_type'        => 'none',
				'frontend_available' => true,
			]
		);

		$element->end_controls_section();
	}

	public static function register_image_reveal_animation_controls( $element ) {
		$element->start_controls_section(
			'_section_wcf_image_animation',
			[				
				'label' => sprintf( '<i class="wcf-logo"></i> %s <span class="wcfpro_text">%s<span>', __( 'Image Animation', 'wcf-addons-pro' ), __( 'Pro', 'wcf-addons-pro' ) ),
			]
		);

		$element->add_control(
			'wcf-image-animation',
			[
				'label'              => esc_html__( 'Animation', 'wcf-addons-pro' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'none',
				'separator'          => 'before',
				'options'            => [
					'none'   => esc_html__( 'none', 'wcf-addons-pro' ),
					'reveal' => esc_html__( 'Reveal', 'wcf-addons-pro' ),
				],
				'frontend_available' => true,
			]
		);

		$element->add_control(
			'image-ease',
			[
				'label'              => esc_html__( 'Data ease', 'wcf-addons-pro' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'power2.out',
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
				'condition'          => [ 'wcf-image-animation' => 'reveal' ],
				'frontend_available' => true,
			]
		);

		$element->end_controls_section();
	}

}

WCF_Image_Animation_Effects::init();
