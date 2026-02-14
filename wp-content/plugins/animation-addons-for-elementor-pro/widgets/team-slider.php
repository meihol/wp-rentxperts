<?php

namespace WCFAddonsPro\Widgets;

use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Plugin;
use Elementor\Repeater;
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
class Team_Slider extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @return string Widget name.
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function get_name() {
		return 'wfc--team-slider';
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
		return esc_html__( 'Team Slider', 'wcf-addons-pro' );
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
		return 'wcf eicon-post-slider';
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
		return [ 'swiper', 'wcf--team-slider' ];
	}

	public function get_script_depends() {
		return [ 'swiper', 'wcf--team-slider' ];
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
			'section_content',
			[
				'label' => esc_html__( 'Team Slider', 'wcf-addons-pro' ),
			]
		);

		$this->add_control(
			'slider_style',
			[
				'label'   => esc_html__( 'Slider Style', 'wcf-addons-pro' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '1',
				'options' => [
					'1' => esc_html__( '1', 'wcf-addons-pro' ),
				],
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'title',
			[
				'label'       => esc_html__( 'Name', 'wcf-addons-pro' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => esc_html__( 'Jeanel Christina', 'wcf-addons-pro' ),
			]
		);

		$repeater->add_control(
			'desc',
			[
				'label'       => esc_html__( 'Designation', 'wcf-addons-pro' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => esc_html__( 'Senior Developer', 'wcf-addons-pro' ),
			]
		);

		$repeater->add_control(
			'image',
			[
				'label'   => esc_html__( 'Image', 'wcf-addons-pro' ),
				'type'    => Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater->add_control(
			'team_link',
			[
				'label'       => esc_html__( 'Link', 'wcf-addons-pro' ),
				'type'        => Controls_Manager::URL,
				'options'     => [ 'url', 'is_external', 'nofollow' ],
				'default'     => [
					'url'         => '#',
					'is_external' => false,
					'nofollow'    => true,
				],
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'social_icon_01',
			[
				'label'            => esc_html__( 'Social One', 'wcf-addons-pro' ),
				'type'             => Controls_Manager::ICONS,
				'skin'				=> 'inline',
				'label_block'		=> false,
				'fa4compatibility' => 'social',
			]
		);

		$repeater->add_control(
			'link_one',
			[
				'label'       => esc_html__( 'Link', 'wcf-addons-pro' ),
				'type'        => Controls_Manager::URL,
				'default'     => [
					'is_external' => 'true',
				],
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => esc_html__( 'https://your-link.com', 'wcf-addons-pro' ),
			]
		);

		$repeater->add_control(
			'social_icon_02',
			[
				'label'            => esc_html__( 'Social Two', 'wcf-addons-pro' ),
				'type'             => Controls_Manager::ICONS,
				'skin'				=> 'inline',
				'label_block'		=> false,
				'fa4compatibility' => 'social',
			]
		);

		$repeater->add_control(
			'link_two',
			[
				'label'       => esc_html__( 'Link', 'wcf-addons-pro' ),
				'type'        => Controls_Manager::URL,
				'default'     => [
					'is_external' => 'true',
				],
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => esc_html__( 'https://your-link.com', 'wcf-addons-pro' ),
			]
		);

		$repeater->add_control(
			'social_icon_03',
			[
				'label'            => esc_html__( 'Social Three', 'wcf-addons-pro' ),
				'type'             => Controls_Manager::ICONS,
				'skin'				=> 'inline',
				'label_block'		=> false,
				'fa4compatibility' => 'social',
			]
		);

		$repeater->add_control(
			'link_three',
			[
				'label'       => esc_html__( 'Link', 'wcf-addons-pro' ),
				'type'        => Controls_Manager::URL,
				'default'     => [
					'is_external' => 'true',
				],
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => esc_html__( 'https://your-link.com', 'wcf-addons-pro' ),
			]
		);

		$repeater->add_control(
			'social_icon_04',
			[
				'label'            => esc_html__( 'Social Four', 'wcf-addons-pro' ),
				'type'             => Controls_Manager::ICONS,
				'skin'				=> 'inline',
				'label_block'		=> false,
				'fa4compatibility' => 'social',
			]
		);

		$repeater->add_control(
			'link_four',
			[
				'label'       => esc_html__( 'Link', 'wcf-addons-pro' ),
				'type'        => Controls_Manager::URL,
				'default'     => [
					'is_external' => 'true',
				],
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => esc_html__( 'https://your-link.com', 'wcf-addons-pro' ),
			]
		);


		

		$repeater->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'tabackground',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}',
			]
		);

		$this->add_control(
			'team_slides',
			[
				'label'   => esc_html__( 'Team Slides', 'wcf-addons-pro' ),
				'type'    => Controls_Manager::REPEATER,
				'fields'  => $repeater->get_controls(),
				'default' => [ [], [], [] ],
			]
		);

		$this->add_control(
			'title_tag',
			[
				'label'   => esc_html__( 'Title HTML Tag', 'wcf-addons-pro' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'h1'   => 'H1',
					'h2'   => 'H2',
					'h3'   => 'H3',
					'h4'   => 'H4',
					'h5'   => 'H5',
					'h6'   => 'H6',
					'div'  => 'div',
					'span' => 'span',
					'p'    => 'p',
				],
				'default' => 'h2',
			]
		);

		$this->end_controls_section();

		// Slider Control
		$this->slider_controls();


		// Content
		$this->start_controls_section(
			'style_content',
			[
				'label' => esc_html__( 'Content', 'wcf-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'content_bg',
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .content',
			]
		);

		$this->add_responsive_control(
			'content_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'wcf-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'content_padding',
			[
				'label'      => esc_html__( 'Padding', 'wcf-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();


		// Title Style
		$this->start_controls_section(
			'style_title',
			[
				'label'     => esc_html__( 'Title', 'wcf-addons-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__( 'Color', 'wcf-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typo',
				'selector' => '{{WRAPPER}} .title',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'title_bg',
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .title',
                'condition' => [ 'slider_style' => '1' ],
			]
		);

		$this->add_responsive_control(
			'title_b_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'wcf-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [ 'slider_style' => '1' ],
			]
		);

		$this->add_responsive_control(
			'title_padding',
			[
				'label'      => esc_html__( 'Padding', 'wcf-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [ 'slider_style' => '1' ],
			]
		);

		$this->add_responsive_control(
			'title_margin',
			[
				'label'      => esc_html__( 'Margin', 'wcf-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();


		// Description Style
		$this->start_controls_section(
			'style_desc',
			[
				'label'     => esc_html__( 'Description', 'wcf-addons-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'desc_color',
			[
				'label'     => esc_html__( 'Color', 'wcf-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .desc' => 'color: {{VALUE}}; fill: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'desc_typo',
				'selector' => '{{WRAPPER}} .desc',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'desc_bg',
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .desc',
				'condition' => [ 'slider_style' => '1' ],
			]
		);

		$this->add_responsive_control(
			'desc_b_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'wcf-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .desc' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [ 'slider_style' => '1' ],
			]
		);

		$this->add_responsive_control(
			'desc_padding',
			[
				'label'      => esc_html__( 'Padding', 'wcf-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .desc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [ 'slider_style' => '1' ],
			]
		);

		$this->end_controls_section();
		// Image style.
		$this->start_controls_section(
			'style_image',
			[
				'label' => esc_html__( 'Image', 'wcf-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'img_width',
			[
				'label'      => esc_html__( 'Width', 'wcf-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					],
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .thumb img' => 'width: {{SIZE}}{{UNIT}}; flex-basis: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'img_height',
			[
				'label'      => esc_html__( 'Height', 'wcf-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem' ],
				'range'      => [
					'px' => [
						'min'  => 1,
						'max'  => 700,
					],
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .thumb img' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'img_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'wcf-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .thumb img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'img_margin',
			[
				'label'      => esc_html__( 'Margin', 'wcf-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .thumb' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();


		// Social style.
		$this->start_controls_section(
			'style_social',
			[
				'label' => esc_html__( 'Social Media', 'wcf-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'helo_show_social',
			[
				'label'     => esc_html__( 'Show Social', 'wcf-addons-pro' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'label_off' => esc_html__( 'Off', 'wcf-addons-pro' ),
				'label_on'  => esc_html__( 'On', 'wcf-addons-pro' ),
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'atbackground',
				'types' => [ 'classic', 'gradient'],
				'selector' => '{{WRAPPER}} .social-media',
			]
		);

		$this->add_responsive_control(
			'social_width',
			[
				'label'      => esc_html__( 'Width', 'wcf-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					],
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .social-media' => 'width: {{SIZE}}{{UNIT}}; flex-basis: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'social_height',
			[
				'label'      => esc_html__( 'Height', 'wcf-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem' ],
				'range'      => [
					'px' => [
						'min'  => 1,
						'max'  => 700,
					],
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .social-media' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'social_gap_buttom',
			[
				'label'      => esc_html__( 'Gap Bottom', 'wcf-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem' ],
				'range'      => [
					'px' => [
						'min'  => 1,
						'max'  => 700,
					],
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .social-media' => 'bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'social_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'wcf-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .social-media' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'social_padding',
			[
				'label'      => esc_html__( 'Padding', 'wcf-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .social-media' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->end_controls_section();

		//slider navigation style control
		$this->slider_navigation_style_controls();
	}


	/**
	 * Register the slider controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	private function slider_controls() {
		$this->start_controls_section(
			'section_slider_options',
			[
				'label' => esc_html__( 'Slider Options', 'wcf-addons-pro' ),
			]
		);

		$slides_to_show = range( 1, 10 );
		$slides_to_show = array_combine( $slides_to_show, $slides_to_show );

		$this->add_responsive_control(
			'slides_to_show',
			[
				'label'       => esc_html__( 'Slides to Show', 'wcf-addons-pro' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'auto',
				'required'    => true,
				'options'     => [
					                 'auto' => esc_html__( 'Auto', 'wcf-addons-pro' ),
				                 ] + $slides_to_show,
				'render_type' => 'template',
				'selectors'   => [
					'{{WRAPPER}}' => '--slides-to-show: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'autoplay',
			[
				'label'   => esc_html__( 'Autoplay', 'wcf-addons-pro' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'yes',
				'options' => [
					'yes' => esc_html__( 'Yes', 'wcf-addons-pro' ),
					'no'  => esc_html__( 'No', 'wcf-addons-pro' ),
				],
			]
		);

		$this->add_control(
			'autoplay_delay',
			[
				'label'     => esc_html__( 'Autoplay delay', 'wcf-addons-pro' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 3000,
				'condition' => [
					'autoplay' => 'yes',
				],
			]
		);

		$this->add_control(
			'autoplay_interaction',
			[
				'label'     => esc_html__( 'Autoplay Interaction', 'wcf-addons-pro' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'true',
				'options'   => [
					'true'  => esc_html__( 'Yes', 'wcf-addons-pro' ),
					'false' => esc_html__( 'No', 'wcf-addons-pro' ),
				],
				'condition' => [
					'autoplay' => 'yes',
				],
			]
		);

		$this->add_control(
			'allow_touch_move',
			[
				'label'     => esc_html__( 'Allow Touch Move', 'wcf-addons-pro' ),
				'type'      => Controls_Manager::SELECT,
				'separator' => 'before',
				'default'   => 'false',
				'options'   => [
					'true'  => esc_html__( 'Yes', 'wcf-addons-pro' ),
					'false' => esc_html__( 'No', 'wcf-addons-pro' ),
				],
			]
		);

		$this->add_control(
			'loop',
			[
				'label'   => esc_html__( 'Loop', 'wcf-addons-pro' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'true',
				'options' => [
					'true'  => esc_html__( 'Yes', 'wcf-addons-pro' ),
					'false' => esc_html__( 'No', 'wcf-addons-pro' ),
				],
			]
		);

		$this->add_control(
			'slide_effect',
			[
				'label'   => esc_html__( 'Effect', 'wcf-addons-pro' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'slide',
				'options' => [
					'slide'     => esc_html__( 'Slide', 'wcf-addons-pro' ),
					'flip'      => esc_html__( 'Flip', 'wcf-addons-pro' ),
					'cube'      => esc_html__( 'Cube', 'wcf-addons-pro' ),
					'coverflow' => esc_html__( 'CoderFlow', 'wcf-addons-pro' ),
				],
			]
		);

		$this->add_control(
			'speed',
			[
				'label'   => esc_html__( 'Animation Speed', 'wcf-addons-pro' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 500,
			]
		);

		$this->add_responsive_control(
			'space_between',
			[
				'label'       => esc_html__( 'Space Between', 'wcf-addons-pro' ),
				'type'        => Controls_Manager::NUMBER,
				'default'     => 20,
				'render_type' => 'template',
				'selectors'   => [
					'{{WRAPPER}}' => '--space-between: {{VALUE}}px;',
				],
			]
		);

		//slider navigation
		$this->add_control(
			'navigation',
			[
				'label'     => esc_html__( 'Slider Controls', 'wcf-addons-pro' ),
				'type'      => Controls_Manager::SELECT,
				'separator' => 'before',
				'default'   => 'both',
				'options'   => [
					'both'   => esc_html__( 'Both', 'wcf-addons-pro' ),
					'arrows' => esc_html__( 'Navigation', 'wcf-addons-pro' ),
					'dots'   => esc_html__( 'Pagination', 'wcf-addons-pro' ),
					'none'   => esc_html__( 'None', 'wcf-addons-pro' ),
				],
			]
		);

		$this->add_control(
			'pagination_type',
			[
				'label'     => esc_html__( 'Pagination Type', 'wcf-addons-pro' ),
				'type'      => Controls_Manager::SELECT,
				'separator' => 'before',
				'default'   => 'bullets',
				'options'   => [
					'bullets'     => esc_html__( 'Dots', 'wcf-addons-pro' ),
					'fraction'    => esc_html__( 'Fraction', 'wcf-addons-pro' ),
					'progressbar' => esc_html__( 'Progressbar', 'wcf-addons-pro' ),
				],
				'condition' => [
					'navigation' => [ 'both', 'dots' ],
				],
			]
		);

		$this->add_control(
			'navigation_previous_icon',
			[
				'label'            => esc_html__( 'Previous Arrow Icon', 'wcf-addons-pro' ),
				'type'             => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'skin'             => 'inline',
				'label_block'      => false,
				'skin_settings'    => [
					'inline' => [
						'none' => [
							'label' => 'Default',
							'icon'  => 'eicon-chevron-left',
						],
						'icon' => [
							'icon' => 'eicon-star',
						],
					],
				],
				'recommended'      => [
					'fa-regular' => [
						'arrow-alt-circle-left',
						'caret-square-left',
					],
					'fa-solid'   => [
						'angle-double-left',
						'angle-left',
						'arrow-alt-circle-left',
						'arrow-circle-left',
						'arrow-left',
						'caret-left',
						'caret-square-left',
						'chevron-circle-left',
						'chevron-left',
						'long-arrow-alt-left',
					],
				],
				'conditions'       => [
					'relation' => 'or',
					'terms'    => [
						[
							'name'     => 'navigation',
							'operator' => '=',
							'value'    => 'both',
						],
						[
							'name'     => 'navigation',
							'operator' => '=',
							'value'    => 'arrows',
						],
					],
				],
			]
		);

		$this->add_control(
			'navigation_next_icon',
			[
				'label'            => esc_html__( 'Next Arrow Icon', 'wcf-addons-pro' ),
				'type'             => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'skin'             => 'inline',
				'label_block'      => false,
				'skin_settings'    => [
					'inline' => [
						'none' => [
							'label' => 'Default',
							'icon'  => 'eicon-chevron-right',
						],
						'icon' => [
							'icon' => 'eicon-star',
						],
					],
				],
				'recommended'      => [
					'fa-regular' => [
						'arrow-alt-circle-right',
						'caret-square-right',
					],
					'fa-solid'   => [
						'angle-double-right',
						'angle-right',
						'arrow-alt-circle-right',
						'arrow-circle-right',
						'arrow-right',
						'caret-right',
						'caret-square-right',
						'chevron-circle-right',
						'chevron-right',
						'long-arrow-alt-right',
					],
				],
				'conditions'       => [
					'relation' => 'or',
					'terms'    => [
						[
							'name'     => 'navigation',
							'operator' => '=',
							'value'    => 'both',
						],
						[
							'name'     => 'navigation',
							'operator' => '=',
							'value'    => 'arrows',
						],
					],
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Register the slider navigation style controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	private function slider_navigation_style_controls() {
		$this->start_controls_section(
			'style_slider_controls',
			[
				'label'     => esc_html__( 'Slider Controls', 'wcf-addons-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'navigation' => [ 'arrows', 'dots', 'both' ],
				],
			]
		);

		// Navigation
		$this->add_control(
			'navigation_heading',
			[
				'label'     => esc_html__( 'Navigation', 'wcf-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'navigation' => [ 'arrows', 'both' ],
				],
			]
		);

		$this->add_control(
			'arrows_color',
			[
				'label'     => esc_html__( 'Color', 'wcf-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wcf-arrow.wcf-arrow-prev, {{WRAPPER}} .wcf-arrow.wcf-arrow-next'         => 'color: {{VALUE}};',
					'{{WRAPPER}} .wcf-arrow.wcf-arrow-prev svg, {{WRAPPER}} .wcf-arrow.wcf-arrow-next svg' => 'fill: {{VALUE}};',
					'{{WRAPPER}} .swiper-button-disabled::after'                                           => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'navigation' => [ 'arrows', 'both' ],
				],
			]
		);

		$this->add_responsive_control(
			'arrows_size',
			[
				'label'     => esc_html__( 'Size', 'wcf-addons-pro' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 60,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .wcf-arrow.wcf-arrow-prev, {{WRAPPER}} .wcf-arrow.wcf-arrow-next' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'navigation' => [ 'arrows', 'both' ],
				],
			]
		);

		$this->add_responsive_control(
			'arrows_margin',
			[
				'label'      => esc_html__( 'Margin', 'wcf-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .team-navigation' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Pagination
		$this->add_control(
			'pagination_heading',
			[
				'label'     => esc_html__( 'Pagination', 'wcf-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'dots_inactive_color',
			[
				'label'     => esc_html__( 'Color', 'wcf-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .swiper-pagination span'        => 'color: {{VALUE}};',
					'{{WRAPPER}} .swiper-pagination-bullet'      => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .swiper-pagination-progressbar' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'navigation' => [ 'dots', 'both' ],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'dot_typo',
				'selector'  => '{{WRAPPER}} .swiper-pagination span',
				'condition' => [
					'navigation'      => [ 'dots', 'both' ],
					'pagination_type' => 'fraction',
				],
			]
		);

		$this->add_responsive_control(
			'progress_height',
			[
				'label'      => esc_html__( 'Height', 'wcf-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .swiper-pagination-progressbar' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'navigation'      => [ 'dots', 'both' ],
					'pagination_type' => 'progressbar',
				],
			]
		);

		$this->add_responsive_control(
			'bullet_size',
			[
				'label'      => esc_html__( 'Size', 'wcf-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .swiper-pagination-bullet' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'navigation'      => [ 'dots', 'both' ],
					'pagination_type' => 'bullets',
				],
			]
		);

		$this->add_responsive_control(
			'pagination_left',
			[
				'label'      => esc_html__( 'Position Left', 'wcf-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range'      => [
					'px' => [
						'min' => - 500,
						'max' => 500,
					],
					'%'  => [
						'min' => - 100,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .swiper-pagination' => 'left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'pagination_btm',
			[
				'label'      => esc_html__( 'Position Bottom', 'wcf-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range'      => [
					'px' => [
						'min' => - 200,
						'max' => 500,
					],
					'%'  => [
						'min' => - 100,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .swiper-pagination' => 'bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		// Pagination Active
		$this->add_control(
			'pagination_active',
			[
				'label'     => esc_html__( 'Pagination Active', 'wcf-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'dots_active_color',
			[
				'label'     => esc_html__( 'Color', 'wcf-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} span.swiper-pagination-current'      => 'color: {{VALUE}}',
					'{{WRAPPER}} .swiper-pagination-bullet-active'    => 'background: {{VALUE}}!important',
					'{{WRAPPER}} .swiper-pagination-progressbar-fill' => 'background: {{VALUE}}',
				],
				'condition' => [
					'navigation' => [ 'dots', 'both' ],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'dot_active_typo',
				'selector'  => '{{WRAPPER}} span.swiper-pagination-current',
				'condition' => [
					'navigation'      => [ 'dots', 'both' ],
					'pagination_type' => 'fraction',
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

		if ( empty( $settings['team_slides'] ) ) {
			return;
		}

		//slider settings
		$show_dots   = ( in_array( $settings['navigation'], [ 'dots', 'both' ] ) );
		$show_arrows = ( in_array( $settings['navigation'], [ 'arrows', 'both' ] ) );

		$slider_settings = $this->get_slider_settings( $settings );

		$this->add_render_attribute(
			'wrapper',
			[
				'class'         => [ 'helo_team_wrapper' ],
				'data-settings' => json_encode( $slider_settings ), //phpcs:ignore
			]
		);

		$slider_thumb_settings = [
			'slidesPerView'       => '1',
			'centeredSlides'      => 'true',
			'slideToClickedSlide' => 'true',
			'effect'              => 'flip',
		];

		$this->add_render_attribute(
			'thumb-wrapper',
			[
				'class'         => [ 'team_thumb_wrapper' ],
				'data-settings' => json_encode( $slider_thumb_settings ), //phpcs:ignore
			]
		);

		$this->add_render_attribute(
			'carousel-wrapper',
			[
				'class' => 'helo_team_slider swiper',
				'style' => 'position: static',
				'dir'   => 'ltr',
			]
		);

		$this->add_render_attribute(
			'thumb-carousel',
			[
				'class' => 'team_thumb_slider swiper',
				'style' => 'position: static',
				'dir'   => 'ltr',
			]
		);

		?>
    <div class="team--main-wrapper helo--team-slider-<?php echo $settings['slider_style']; ?>" >
        <div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
            <div <?php $this->print_render_attribute_string( 'carousel-wrapper' ); ?>>
                <div class="swiper-wrapper">
					<?php foreach ( $settings['team_slides'] as $index => $item ) {
						if ( '1' === $settings['slider_style'] ) {
							$this->render_team_slider_one( $settings, $index, $item );
						}
					} ?>
                </div>
            </div>
            <!-- navigation and pagination -->
			<?php if ( 1 < count( $settings['team_slides'] ) ) : ?>
                <div class="controls-wrap">
					<?php if ( $show_arrows ) : ?>
                        <div class="team-navigation">
                            <div class="wcf-arrow wcf-arrow-prev" role="button" tabindex="0">
								<?php $this->render_swiper_button( 'previous' ); ?>
                            </div>
                            <div class="wcf-arrow wcf-arrow-next" role="button" tabindex="0">
								<?php $this->render_swiper_button( 'next' ); ?>
                            </div>
                        </div>
					<?php endif; ?>

					<?php if ( $show_dots ) : ?>
                        <div class="team-pagination">
                            <div class="swiper-pagination"></div>
                        </div>
					<?php endif; ?>
                </div>
			<?php endif; ?>
        </div>
        </div>
		<?php
	}

	private function get_slider_settings( $settings ) {

		$show_dots   = ( in_array( $settings['navigation'], [ 'dots', 'both' ] ) );
		$show_arrows = ( in_array( $settings['navigation'], [ 'arrows', 'both' ] ) );

		$slider_settings = [
			'loop'           => 'true' === $settings['loop'],
			'speed'          => $settings['speed'],
			'allowTouchMove' => $settings['allow_touch_move'],
			'slidesPerView'  => $settings['slides_to_show'],
			'spaceBetween'   => $settings['space_between'],
			'effect'         => $settings['slide_effect'],
		];

		if ( 'yes' === $settings['autoplay'] ) {
			$slider_settings['autoplay'] = [
				'delay'                => $settings['autoplay_delay'],
				'disableOnInteraction' => $settings['autoplay_interaction'],
			];
		}

		if ( $show_arrows ) {
			$slider_settings['navigation'] = [
				'nextEl' => '.elementor-element-' . $this->get_id() . ' .wcf-arrow-next',
				'prevEl' => '.elementor-element-' . $this->get_id() . ' .wcf-arrow-prev',
			];
		}

		if ( $show_dots ) {
			$slider_settings['pagination'] = [
				'el'   => '.elementor-element-' . $this->get_id() . ' .swiper-pagination',
				'type' => $settings['pagination_type'],
			];
		}

		//slider breakpoints
		$active_breakpoints = Plugin::$instance->breakpoints->get_active_breakpoints();

		foreach ( $active_breakpoints as $breakpoint_name => $breakpoint ) {
			$slides_to_show = ! empty( $settings[ 'slides_to_show_' . $breakpoint_name ] ) ? $settings[ 'slides_to_show_' . $breakpoint_name ] : $settings['slides_to_show'];
			$space_between  = ! empty( $settings[ 'space_between_' . $breakpoint_name ] ) ? $settings[ 'space_between_' . $breakpoint_name ] : $settings['space_between'];

			$slider_settings['breakpoints'][ $breakpoint->get_value() ]['slidesPerView'] = $slides_to_show;
			$slider_settings['breakpoints'][ $breakpoint->get_value() ]['spaceBetween']  = $space_between;
		}

		return $slider_settings;
	}

	/**
	 * Render swiper button.
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	private function render_swiper_button( $type ) {
		$direction     = 'next' === $type ? 'right' : 'left';
		$icon_settings = $this->get_settings_for_display( 'navigation_' . $type . '_icon' );

		if ( empty( $icon_settings['value'] ) ) {
			$icon_settings = [
				'library' => 'eicons',
				'value'   => 'eicon-chevron-' . $direction,
			];
		}

		Icons_Manager::render_icon( $icon_settings, [ 'aria-hidden' => 'true' ] );
	}

	protected function render_team_slider_one( $settings, $index, $item ) { ?>
        <div class="swiper-slide elementor-repeater-item-<?php echo esc_attr( $item['_id'] ) ?>" >
			 <div class="content">
				<div class="title-wrap">
					<<?php Utils::print_validated_html_tag( $settings['title_tag'] ); ?> class="title">
						<?php echo wp_kses_post( $item['title'] ); ?>
					</<?php Utils::print_validated_html_tag( $settings['title_tag'] ); ?>>
					<?php if ( $item['desc'] ) { ?>
						<p class="desc"><?php echo wp_kses_post( $item['desc'] ); ?></p>
					<?php } ?>
				</div>
				<div class="thumb">
					<?php
					$team_link = 'team_link_' . $index;
					if ( ! empty( $item['team_link']['url'] ) ) {
						$this->add_link_attributes( $team_link, $item['team_link'] );
					}
					?>
					<a <?php $this->print_render_attribute_string( $team_link ); ?>>
						<img src="<?php echo esc_url( $item['image']['url'] ); ?>" alt="Portfolio Image">
					</a>
            	</div>
				<?php if($settings['helo_show_social'] == 'yes'): ?>
				<div class="social-media">
					<?php 
					if ( ! empty( $item['link_one']['url'] ) ) {
					?>
						<a href='<?php echo esc_url( $item['link_one']['url'] ); ?>'>
							<?php \Elementor\Icons_Manager::render_icon( $item['social_icon_01'], [ 'aria-hidden' => 'true' ] ); ?>
						</a>
					<?php } ?>

					<?php 
					if ( ! empty( $item['link_two']['url'] ) ) {
					?>
						<a href='<?php echo esc_url( $item['link_one']['url'] ); ?>'>
							<?php \Elementor\Icons_Manager::render_icon( $item['social_icon_02'], [ 'aria-hidden' => 'true' ] ); ?>
						</a>
					<?php } ?>

					<?php 
					if ( ! empty( $item['link_three']['url'] ) ) {
					?>
						<a href='<?php echo esc_url( $item['link_one']['url'] ); ?>'>
							<?php \Elementor\Icons_Manager::render_icon( $item['social_icon_03'], [ 'aria-hidden' => 'true' ] ); ?>
						</a>
					<?php } ?>

					<?php 
					if ( ! empty( $item['link_four']['url'] ) ) {
					?>
						<a href='<?php echo esc_url( $item['link_one']['url'] ); ?>'>
							<?php \Elementor\Icons_Manager::render_icon( $item['social_icon_04'], [ 'aria-hidden' => 'true' ] ); ?>
						</a>
					<?php } ?>
						
					</ul>
				</div>
				<?php endif; ?>
			</div>
           
        </div>
		<?php
	}

}
