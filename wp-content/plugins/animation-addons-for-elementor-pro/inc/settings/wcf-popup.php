<?php

namespace WCFAddonsPro\Settings\Tabs;

use Elementor\Controls_Manager;
use Elementor\Core\Kits\Documents\Tabs\Tab_Base;
use Elementor\Group_Control_Background;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Popup extends Tab_Base {

	public function get_id() {
		return 'settings-wcf-popup';
	}

	public function get_title() {
		return esc_html__( 'AAE Popup', 'wcf-addons-pro' );
	}

	public function get_group() {
		return 'theme-style';
	}

	public function get_icon() {
		return 'wcf eicon-play';
	}

	protected function register_tab_controls() {
		$this->start_controls_section(
			'section_' . $this->get_id(),
			[
				'label' => $this->get_title(),
				'tab'   => $this->get_id(),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'wcf_popup_bg',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '#wcf-aae-global--popup-js, .wcf--popup-video-wrapper',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'video_width',
			[
				'label'      => esc_html__( 'Video Width', 'wcf-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 1200,
					],
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'  => [
					'.wcf--popup-video' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'video_height',
			[
				'label'      => esc_html__( 'Video Height', 'wcf-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 800,
					],
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'  => [
					'.wcf--popup-video' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'close_icon',
			[
				'label'       => esc_html__( 'Close Icon', 'wcf-addons-pro' ),
				'type'        => Controls_Manager::ICONS,
				'skin'        => 'inline',
				'label_block' => false,
				'default'     => [
					'value'   => 'far fa-window-close',
					'library' => 'fa-solid',
				],
			]
		);

		$this->add_control(
			'close_i_color',
			[
				'label'     => esc_html__( 'Icon Color', 'wcf-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'.wcf--popup-close' => 'fill: {{VALUE}}; color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'wcf_popup_b_color',
			[
				'label'     => esc_html__( 'Border Color', 'wcf-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'.wcf--popup-close' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'close_i_size',
			[
				'label'      => esc_html__( 'Icon Size', 'wcf-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'  => [
					'.wcf--popup-close' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'close_position',
			[
				'label'   => esc_html__( 'Close Icon Position', 'wcf-addons-pro' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'right',
				'options' => [
					'right' => esc_html__( 'Right', 'wcf-addons-pro' ),
					'left'  => esc_html__( 'Left', 'wcf-addons-pro' ),
				],
			]
		);

		$this->add_responsive_control(
			'close_top_spacing',
			[
				'label'      => esc_html__( 'Top', 'wcf-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min' => - 100,
						'max' => 100,
					],
				],
				'selectors'  => [
					'.wcf--popup-close' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'close_left_spacing',
			[
				'label'      => esc_html__( 'Left', 'wcf-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min' => - 100,
						'max' => 100,
					],
				],
				'selectors'  => [
					'.wcf--popup-close' => 'right: unset; left: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [ 'close_position' => 'left' ],
			]
		);

		$this->add_responsive_control(
			'close_right_spacing',
			[
				'label'      => esc_html__( 'Right', 'wcf-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min' => - 100,
						'max' => 100,
					],
				],
				'selectors'  => [
					'.wcf--popup-close' => 'left: unset; right: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [ 'close_position' => 'right' ],
			]
		);

		$this->end_controls_section();
	}
}
