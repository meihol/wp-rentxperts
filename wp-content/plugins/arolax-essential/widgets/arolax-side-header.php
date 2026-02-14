<?php

namespace ArolaxEssentialApp\Widgets;

use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Utils;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Testimonial
 *
 * Elementor widget for testimonial.
 *
 * @since 1.0.0
 */
class Arolax_Side_Header extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @return string Widget name.
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function get_name() {
		return 'arolax--side-header';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @return string Widget title.
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function get_title() {
		return esc_html__( 'Arolax Side Header', 'arolax-essential' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @return string Widget icon.
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function get_icon() {
		return 'wcf eicon-header';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @return array Widget categories.
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function get_categories() {
		return [ 'weal-coder-addon' ];
	}

	public function get_style_depends() {
		wp_register_style( 'arolax--header', AROLAX_ESSENTIAL_ASSETS_URL . 'css/side-header.css' );
		wp_register_style( 'arolax--button', AROLAX_ESSENTIAL_ASSETS_URL . 'css/arolax-button.css' );
		return [ 'arolax--header', 'arolax--button' ];
	}

	public function get_script_depends() {
		wp_register_script( 'arolax--header', AROLAX_ESSENTIAL_ASSETS_URL . '/js/widgets/side-header.js', [ 'jquery' ], false, true );
		return [ 'swiper', 'arolax--header' ];
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function register_controls() {
		$this->start_controls_section(
			'sec_side_header',
			[
				'label' => esc_html__( 'Header', 'arolax-essential' ),
			]
		);

		// Logo Control
		$this->add_control(
			'logo',
			[
				'label' => esc_html__( 'Choose Logo', 'arolax-essential' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		// Menu Select
		$this->add_control(
			'menu_selected',
			[
				'label' => esc_html__( 'Select Menu', 'arolax-essential' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => arolax_menu_list()
			]
		);


		$this->add_control(
			'mobile_open',
			[
				'label' => esc_html__( 'Hamburger Icon', 'arolax-essential' ),
				'type' => Controls_Manager::ICONS,
				'skin' => 'inline',
				'label_block' => false,
			]
		);

		$this->add_control(
			'mobile_close',
			[
				'label' => esc_html__( 'Mobile Menu Close Icon', 'arolax-essential' ),
				'type' => Controls_Manager::ICONS,
				'skin' => 'inline',
				'label_block' => false,
			]
		);

		$this->end_controls_section();

		// Button Controls
		$this->button_controls();

		// Header Style
		$this->start_controls_section(
			'arolax_style_header',
			[
				'label' => esc_html__( 'Header', 'arolax-essential' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'header_position',
			[
				'label' => esc_html__( 'Header Position', 'arolax-essential' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'prefix_class' => 'h-pos-',
				'options' => [
					'' => esc_html__( 'Default', 'arolax-essential' ),
					'fixed' => esc_html__( 'Fixed', 'arolax-essential' ),
				],
				'selectors' => [
					'{{WRAPPER}} .arolax--side-header' => 'position: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'header_type',
			[
				'label' => esc_html__( 'Header Type', 'arolax-essential' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'normal',
				'options' => [
					'normal' => esc_html__( 'Default', 'arolax-essential' ),
					'exclusion' => esc_html__( 'Blend', 'arolax-essential' ),
				],
				'selectors' => [
					'{{WRAPPER}} .arolax--side-header' => 'mix-blend-mode: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'header_width',
			[
				'label' => esc_html__( 'Width', 'arolax-essential' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .arolax--side-header' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'header_bg',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .arolax--side-header',
			]
		);

		$this->add_responsive_control(
			'header_padding',
			[
				'label' => esc_html__( 'Padding', 'arolax-essential' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .arolax--side-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Logo Style
		$this->logo_style_controls();

		// Menu Style
		$this->menu_style_controls();

		// Sub Menu Style
		$this->sub_menu_style_controls();

		// Button Style
		$this->button_style_controls();

		// Mobile Style
		$this->mobile_style_controls();
	}

	// Logo Style Function
	protected function logo_style_controls() {
		$this->start_controls_section(
			'arolax_style_logo',
			[
				'label' => esc_html__( 'Logo', 'arolax-essential' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);


		$this->add_responsive_control(
			'logo_width',
			[
				'label' => esc_html__( 'Width', 'arolax-essential' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 150,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .logo img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);


		$this->end_controls_section();
	}


	// Menu Style Function
	protected function menu_style_controls() {
		$this->start_controls_section(
			'arolax_style_menu',
			[
				'label' => esc_html__( 'Menu', 'arolax-essential' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'menu_color',
			[
				'label' => esc_html__( 'Color', 'arolax-essential' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .arolax--side-menu a' => 'color: {{VALUE}}',
					'{{WRAPPER}} .toggle::after' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'menu_h_color',
			[
				'label' => esc_html__( 'Hover Color', 'arolax-essential' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .arolax--side-menu a:hover' => 'color: {{VALUE}}',
					'{{WRAPPER}} .toggle:hover::after' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'menu_typo',
				'selector' => '{{WRAPPER}} .arolax--side-menu a',
			]
		);

		$this->add_control(
			'menu_padding',
			[
				'label' => esc_html__( 'Padding', 'arolax-essential' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .arolax--side-menu a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'dd_open_size',
			[
				'label' => esc_html__( 'Dropdown Open Icon Size', 'arolax-essential' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 80,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .toggle::after' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'dd_close_size',
			[
				'label' => esc_html__( 'Dropdown Close Icon Size', 'arolax-essential' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 80,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .toggle.open::after' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}


	// Sub Menu Style Function
	protected function sub_menu_style_controls() {
		$this->start_controls_section(
			'arolax_style_sub_menu',
			[
				'label' => esc_html__( 'Sub Menu', 'arolax-essential' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'sub_menu_color',
			[
				'label' => esc_html__( 'Color', 'arolax-essential' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .arolax--side-menu .sub-menu a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'sub_menu_h_color',
			[
				'label' => esc_html__( 'Hover Color', 'arolax-essential' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .arolax--side-menu .sub-menu a:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'sub_menu_typo',
				'selector' => '{{WRAPPER}} .arolax--side-menu .sub-menu a',
			]
		);

		$this->add_control(
			'sub_menu_padding',
			[
				'label' => esc_html__( 'Padding', 'arolax-essential' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .arolax--side-menu .sub-menu a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->end_controls_section();
	}


	// Button Control Function
	public function button_controls() {
		$this->start_controls_section(
			'arolax_sec_button',
			[
				'label' => __( 'Button', 'arolax-essential' ),
			]
		);

		$this->add_control(
			'btn_style',
			[
				'label' => esc_html__( 'Style', 'arolax-essential' ),
				'type' => Controls_Manager::SELECT,
				'default' => '1',
				'options' => [
					'1' => esc_html__( '1', 'arolax-essential' ),
					'2' => esc_html__( '2', 'arolax-essential' ),
					'3'  => esc_html__( '3', 'arolax-essential' ),
				],
			]
		);


		$this->add_control(
			'btn_text',
			[
				'label'       => esc_html__( 'Text', 'arolax-essential' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Button', 'arolax-essential' ),
				'placeholder' => esc_html__( 'Type your text here', 'arolax-essential' ),
			]
		);

		$this->add_control(
			'btn_link',
			[
				'label'   => esc_html__( 'Link', 'arolax-essential' ),
				'type'    => Controls_Manager::URL,
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => '#',
				],
			]
		);

		$this->add_control(
			'btn_icon',
			[
				'label'            => esc_html__( 'Icon', 'arolax-essential' ),
				'type'             => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'skin'             => 'inline',
				'label_block'      => false,
				'default'          => [
					'value'   => 'fas fa-arrow-right',
					'library' => 'fa-solid',
				],
			]
		);

		$this->add_control(
			'btn_icon_position',
			[
				'label'        => esc_html__( 'Icon Position', 'arolax-essential' ),
				'type'         => Controls_Manager::SELECT,
				'default'      => 'row',
				'options'      => [
					'row'         => esc_html__( 'After', 'arolax-essential' ),
					'row-reverse' => esc_html__( 'Before', 'arolax-essential' ),
				],
				'selectors'    => [
					'{{WRAPPER}} .btn-text-flip' => 'flex-direction: {{VALUE}};',
				],
				'condition' => [
					'btn_style' => '3',
				],
			]
		);

		$this->add_responsive_control(
			'icon_gap',
			[
				'label' => esc_html__( 'Icon Gap', 'arolax-essential' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .btn-text-flip' => 'gap: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'btn_style' => '3',
				],
			]
		);

		$this->add_responsive_control(
			'btn_icon_width',
			[
				'label'     => esc_html__( 'Icon Width', 'arolax-essential' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .style-1 .wc-btn-play, {{WRAPPER}} .style-2 .wc-btn-play' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .wc-btn-play' => '--icon-width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'btn_style' => ['1', '2'],
				],
			]
		);

		$this->add_responsive_control(
			'btn_align',
			[
				'label'     => esc_html__( 'Alignment', 'arolax-essential' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'left'   => [
						'title' => esc_html__( 'Left', 'arolax-essential' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'arolax-essential' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right'  => [
						'title' => esc_html__( 'Right', 'arolax-essential' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}


	// Button Style Function
	public function button_style_controls() {
		// Text Style
		$this->start_controls_section(
			'arolax_style_button',
			[
				'label' => esc_html__( 'Button', 'arolax-essential' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'btn_text_typo',
				'selector' => '{{WRAPPER}} .wc-btn-primary',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'btn_text_bg',
				'types'    => [ 'classic', 'gradient' ],
				'exclude'  => [ 'image' ],
				'selector' => '{{WRAPPER}} .wc-btn-primary',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'btn_text_border',
				'selector' => '{{WRAPPER}} .wc-btn-primary',
			]
		);

		$this->add_control(
			'text_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'arolax-essential' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .wc-btn-primary' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'text_padding',
			[
				'label'      => esc_html__( 'Padding', 'arolax-essential' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .wc-btn-primary' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Tabs
		$this->start_controls_tabs(
			'text_style_tabs'
		);

		$this->start_controls_tab(
			'text_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'arolax-essential' ),
			]
		);

		$this->add_control(
			'btn_text_color',
			[
				'label'     => esc_html__( 'Color', 'arolax-essential' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wc-btn-primary, {{WRAPPER}} .btn-text-flip span' => 'color: {{VALUE}}; fill: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'text_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'arolax-essential' ),
			]
		);

		$this->add_control(
			'btn_text_h_color',
			[
				'label'     => esc_html__( 'Color', 'arolax-essential' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wc-btn-primary:hover, {{WRAPPER}} .btn-text-flip:hover span' => 'color: {{VALUE}}; fill: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'btn_text_h_bg',
				'types'    => [ 'classic', 'gradient' ],
				'exclude'  => [ 'image' ],
				'selector' => '{{WRAPPER}} .wc-btn-primary:hover',
			]
		);

		$this->add_control(
			'btn_text_h_border',
			[
				'label'     => esc_html__( 'Border Color', 'arolax-essential' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wc-btn-primary:hover' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'btn_icon_size2',
			[
				'label'      => esc_html__( 'Icon Size', 'arolax-essential' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .btn-text-flip svg, {{WRAPPER}} .btn-text-flip i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();


		// Icon Style
		$this->start_controls_section(
			'arolax_style_btn_icon',
			[
				'label' => esc_html__( 'Icon', 'arolax-essential' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'btn_style' => ['1', '2'],
				],
			]
		);

		$this->add_responsive_control(
			'btn_icon_size',
			[
				'label'      => esc_html__( 'Size', 'arolax-essential' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .style-1 .wc-btn-play, {{WRAPPER}} .style-2 .wc-btn-play' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'btn_icon_bg',
				'types'    => [ 'classic', 'gradient' ],
				'exclude'  => [ 'image' ],
				'selector' => '{{WRAPPER}} .style-1 .wc-btn-play, {{WRAPPER}} .style-2 .wc-btn-play',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'btn_icon_border',
				'selector' => '{{WRAPPER}} .style-1 .wc-btn-play, {{WRAPPER}} .style-2 .wc-btn-play',
			]
		);

		$this->add_control(
			'icon_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'arolax-essential' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .style-1 .wc-btn-play, {{WRAPPER}} .style-2 .wc-btn-play' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Tabs
		$this->start_controls_tabs(
			'icon_style_tabs'
		);

		$this->start_controls_tab(
			'icon_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'arolax-essential' ),
			]
		);

		$this->add_control(
			'btn_icon_color',
			[
				'label'     => esc_html__( 'Color', 'arolax-essential' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .style-1 .wc-btn-play, {{WRAPPER}} .style-2 .wc-btn-play' => 'color: {{VALUE}}; fill: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'icon_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'arolax-essential' ),
			]
		);

		$this->add_control(
			'btn_icon_h_color',
			[
				'label'     => esc_html__( 'Color', 'arolax-essential' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .style-1 .wc-btn-play:hover, {{WRAPPER}} .style-2 .wc-btn-play:hover' => 'color: {{VALUE}}; fill: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'btn_icon_h_bg',
				'types'    => [ 'classic', 'gradient' ],
				'exclude'  => [ 'image' ],
				'selector' => '{{WRAPPER}} .style-1 .wc-btn-play:hover, {{WRAPPER}} .style-2 .wc-btn-play:hover',
			]
		);

		$this->add_control(
			'btn_icon_h_border',
			[
				'label'     => esc_html__( 'Border Color', 'arolax-essential' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .style-1 .wc-btn-play:hover, {{WRAPPER}} .style-2 .wc-btn-play:hover' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	// Mobile Style Function
	protected function mobile_style_controls() {
		$this->start_controls_section(
			'arolax_style_mobile',
			[
				'label' => esc_html__( 'Mobile', 'arolax-essential' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'mobile_off_bg',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .side-header-mobile',
			]
		);

		$this->add_control(
			'mobile_off_menu_bg',
			[
				'label' => esc_html__( 'Menu Background Color', 'arolax-essential' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .arolax--side-header.mobile' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'mobile_header_padding',
			[
				'label' => esc_html__( 'Padding', 'arolax-essential' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .side-header-mobile' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		// Menu Open Icon
		$this->add_control(
			'mm_open_heading',
			[
				'label' => esc_html__( 'Hamburger Icon', 'arolax-essential' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'mmo_icon_color',
			[
				'label' => esc_html__( 'Color', 'arolax-essential' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .menu--open' => 'color: {{VALUE}}; fill: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'mm_icon_size',
			[
				'label' => esc_html__( 'Icon Size', 'arolax-essential' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .menu--open' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);


		// Menu Close Icon
		$this->add_control(
			'mm_close_heading',
			[
				'label' => esc_html__( 'Close Icon', 'arolax-essential' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'mmc_icon_color',
			[
				'label' => esc_html__( 'Color', 'arolax-essential' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .menu--close' => 'color: {{VALUE}}; fill: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'mmc_icon_size',
			[
				'label' => esc_html__( 'Icon Size', 'arolax-essential' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .menu--close' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);



		$this->end_controls_section();
	}


	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$menu_selected = $settings[ 'menu_selected' ];

		if($menu_selected == ''){
			return;
		}

		$args = [
			'menu'            => $menu_selected,
			'container'       => 'nav',
			'container_class' => 'arolax--side-menu',
			'menu_class'      =>  'side-menu',
		];

		if ( ! empty( $settings['btn_link']['url'] ) ) {
			$this->add_link_attributes( 'btn_link', $settings['btn_link'] );
		}

		?>

		<header class="side-header-area">
			<div class="side-header-mobile">
				<div class="arolax--logo">
					<div class="logo">
						<?php if ( $settings['logo']['url'] ): ?>
							<a href="#"><img src="<?php echo esc_url( $settings['logo']['url'] ); ?>" alt="site-logo"></a>
						<?php
						else:
							echo esc_html("Add Logo");
						endif;
						?>
					</div>
				</div>

				<div class="menu--open">
					<?php Icons_Manager::render_icon( $settings['mobile_open'], [ 'aria-hidden' => 'true' ] ); ?>
				</div>
			</div>

			<div class="arolax--side-header">
				<div class="menu--close">
					<?php Icons_Manager::render_icon( $settings['mobile_close'], [ 'aria-hidden' => 'true' ] ); ?>
				</div>

				<div class="arolax--logo">
					<div class="logo">
						<?php if ( $settings['logo']['url'] ): ?>
							<a href="#"><img src="<?php echo esc_url( $settings['logo']['url'] ); ?>" alt="site-logo"></a>
						<?php
						else:
							echo esc_html("Add Logo");
						endif;
						?>
					</div>
				</div>

				<?php wp_nav_menu($args); ?>

				<div class="wc-btn-wrapper style-<?php echo esc_html( $settings['btn_style'] ); ?>">
					<?php if ( '3' === $settings['btn_style'] ) { ?>
						<a <?php $this->print_render_attribute_string( 'btn_link' ); ?> class="wc-btn-primary btn-text-flip">
											<span data-text="<?php echo esc_html( $settings['btn_text'] ); ?>">
													<?php echo esc_html( $settings['btn_text'] ); ?>
											</span>
							<?php Icons_Manager::render_icon( $settings['btn_icon'], [ 'aria-hidden' => 'true' ] ); ?>
						</a>
					<?php } else { ?>
						<a <?php $this->print_render_attribute_string( 'btn_link' ); ?> class="wc-btn-group">
									<span class="wc-btn-play">
										<?php Icons_Manager::render_icon( $settings['btn_icon'], [ 'aria-hidden' => 'true' ] ); ?>
									</span>
							<span class="wc-btn-primary">
											<?php echo esc_html( $settings['btn_text'] ); ?>
									</span>
							<span class="wc-btn-play">
									<?php Icons_Manager::render_icon( $settings['btn_icon'], [ 'aria-hidden' => 'true' ] ); ?>
									</span>
						</a>
					<?php } ?>
				</div>
			</div>
		</header>

		<?php
	}
}
