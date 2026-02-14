<?php

namespace ArolaxEssentialApp\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Plugin;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Widget_Base;

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
class Arolax_Testimonial_2 extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @return string Widget name.
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function get_name() {
		return 'arolax--testimonial-2';
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
		return esc_html__( 'Arolax Testimonial 2', 'arolax-essential' );
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
		return 'wcf eicon-testimonial';
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
		wp_register_style( 'arolax-testimonial', AROLAX_ESSENTIAL_ASSETS_URL . 'css/arolax-testimonial.css' );
		return [ 'swiper', 'arolax-testimonial' ];
	}

	public function get_script_depends() {
		wp_register_script( 'arolax-testimonial-2', AROLAX_ESSENTIAL_ASSETS_URL . '/js/widgets/arolax-testimonial-2.js', [ 'jquery' ], false, true );

		return [ 'swiper', 'arolax-testimonial-2' ];
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
				'label' => esc_html__( 'Testimonial', 'arolax-essential' ),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'tsm_quote',
			[
				'label'   => esc_html__( 'Quote', 'textdomain' ),
				'type'    => Controls_Manager::ICONS,
				'default' => [
					'value'   => 'fas fa-quote-left',
					'library' => 'fa-solid',
				],
			]
		);

		$repeater->add_control(
			'tsm_feedback',
			[
				'label'   => esc_html__( 'Feedback', 'arolax-essential' ),
				'type'    => Controls_Manager::TEXTAREA,
				'dynamic' => [
					'active' => true,
				],
				'rows'    => '10',
				'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'arolax-essential' ),
			]
		);

		$repeater->add_control(
			'tsm_client_image',
			[
				'label'   => esc_html__( 'Client Image', 'arolax-essential' ),
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
			'tsm_client_name',
			[
				'label'       => esc_html__( 'Name', 'arolax-essential' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'dynamic'     => [
					'active' => true,
				],
				'default'     => 'John Doe',
			]
		);

		$repeater->add_control(
			'tsm_client_role',
			[
				'label'       => esc_html__( 'Designation', 'arolax-essential' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'dynamic'     => [
					'active' => true,
				],
				'default'     => 'CEO',
			]
		);

		$this->add_control(
			'testimonials',
			[
				'label'   => esc_html__( 'Testimonials', 'arolax-essential' ),
				'type'    => Controls_Manager::REPEATER,
				'fields'  => $repeater->get_controls(),
				'default' => [ [], [], [], [], [] ],
			]
		);

		$this->end_controls_section();

		//slider control
		$this->slider_controls();

		//layout style
		$this->start_controls_section(
			'sec_slide_style',
			[
				'label' => esc_html__( 'Slide', 'arolax-essential' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'content_heading',
			[
				'label' => esc_html__( 'Content', 'arolax-essential' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'slide_align',
			[
				'label' => esc_html__( 'Alignment', 'arolax-essential' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'arolax-essential' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'arolax-essential' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'arolax-essential' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'center',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .content' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'client_heading',
			[
				'label' => esc_html__( 'Client', 'arolax-essential' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'ts_padding',
			[
				'label' => esc_html__( 'Padding', 'arolax-essential' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .prod_testimonial_thumb' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'ts_margin',
			[
				'label' => esc_html__( 'Margin', 'arolax-essential' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .prod_testimonial_thumb' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Quote style.
		$this->start_controls_section(
			'style_tm_quote',
			[
				'label' => esc_html__( 'Quote', 'arolax-essential' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'quote_width',
			[
				'label'      => esc_html__( 'Width', 'arolax-essential' ),
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
					'{{WRAPPER}} .quote' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'quote_margin',
			[
				'label'      => esc_html__( 'Margin', 'arolax-essential' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .quote' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Feedback style
		$this->start_controls_section(
			'style_tm_feedback',
			[
				'label' => esc_html__( 'Feedback', 'arolax-essential' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'feedback_color',
			[
				'label'     => esc_html__( 'Color', 'arolax-essential' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .content p' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'content_typography',
				'selector' => '{{WRAPPER}} .content p',
			]
		);

		$this->add_responsive_control(
			'content_margin',
			[
				'label'      => esc_html__( 'Margin', 'arolax-essential' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .content p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);;

		$this->end_controls_section();

		// Image style.
		$this->start_controls_section(
			'style_tm_image',
			[
				'label' => esc_html__( 'Image', 'arolax-essential' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'img_width',
			[
				'label'      => esc_html__( 'Width', 'arolax-essential' ),
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
					'{{WRAPPER}} .avatar img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'img_height',
			[
				'label'      => esc_html__( 'Height', 'arolax-essential' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem' ],
				'range'      => [
					'px' => [
						'min'  => 1,
						'max'  => 700,
						'step' => 1,
					],
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .avatar img' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'image_b_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'arolax-essential' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .avatar img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Name.
		$this->start_controls_section(
			'style_tm_name',
			[
				'label' => esc_html__( 'Name', 'arolax-essential' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'name_text_color',
			[
				'label'     => esc_html__( 'Text Color', 'arolax-essential' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .name' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'name_typography',
				'selector' => '{{WRAPPER}} .name',
			]
		);

		$this->add_responsive_control(
			'name_margin',
			[
				'label'      => esc_html__( 'Margin', 'arolax-essential' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'separator'  => 'before',
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Designation.
		$this->start_controls_section(
			'style_tm_role',
			[
				'label' => esc_html__( 'Designation', 'arolax-essential' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'job_text_color',
			[
				'label'     => esc_html__( 'Color', 'arolax-essential' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .role' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'role_typography',
				'selector' => '{{WRAPPER}} .role',
			]
		);

		$this->end_controls_section();

		//slider navigation style control
		$this->slider_navigation_style_controls();

		//slider navigation style control
		$this->slider_pagination_style_controls();
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
				'label' => esc_html__( 'Slider Options', 'arolax-essential' ),
			]
		);

		$slides_to_show = range( 1, 10 );
		$slides_to_show = array_combine( $slides_to_show, $slides_to_show );

		$this->add_responsive_control(
			'slides_to_show',
			[
				'label'       => esc_html__( 'Slides to Show', 'arolax-essential' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => '3',
				'required'    => true,
				'options'     => [
					                 'auto' => esc_html__( 'Auto', 'arolax-essential' ),
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
				'label'   => esc_html__( 'Autoplay', 'arolax-essential' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'yes',
				'options' => [
					'yes' => esc_html__( 'Yes', 'arolax-essential' ),
					'no'  => esc_html__( 'No', 'arolax-essential' ),
				],
			]
		);

		$this->add_control(
			'autoplay_delay',
			[
				'label'     => esc_html__( 'Autoplay delay', 'arolax-essential' ),
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
				'label'     => esc_html__( 'Autoplay Interaction', 'arolax-essential' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'true',
				'options'   => [
					'true'  => esc_html__( 'Yes', 'arolax-essential' ),
					'false' => esc_html__( 'No', 'arolax-essential' ),
				],
				'condition' => [
					'autoplay' => 'yes',
				],
			]
		);

		// Loop requires a re-render so no 'render_type = none'
		$this->add_control(
			'loop',
			[
				'label'   => esc_html__( 'Loop', 'arolax-essential' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'true',
				'options' => [
					'true'  => esc_html__( 'Yes', 'arolax-essential' ),
					'false' => esc_html__( 'No', 'arolax-essential' ),
				],
			]
		);


		$this->add_control(
			'speed',
			[
				'label'   => esc_html__( 'Animation Speed', 'arolax-essential' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 500,
			]
		);

		$this->add_control(
			'space_between',
			[
				'label'       => esc_html__( 'Space Between', 'arolax-essential' ),
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
				'label'     => esc_html__( 'Navigation', 'arolax-essential' ),
				'type'      => Controls_Manager::SELECT,
				'separator' => 'before',
				'default'   => 'both',
				'options'   => [
					'both'   => esc_html__( 'Arrows and Pagination', 'arolax-essential' ),
					'arrows' => esc_html__( 'Arrows', 'arolax-essential' ),
					'dots'   => esc_html__( 'Pagination', 'arolax-essential' ),
					'none'   => esc_html__( 'None', 'arolax-essential' ),
				],
			]
		);

		$this->add_control(
			'navigation_previous_icon',
			[
				'label'            => esc_html__( 'Previous Arrow Icon', 'arolax-essential' ),
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
				'label'            => esc_html__( 'Next Arrow Icon', 'arolax-essential' ),
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

	// Navigation
	private function slider_navigation_style_controls() {
		$this->start_controls_section(
			'style_navigation',
			[
				'label'     => esc_html__( 'Navigation', 'arolax-essential' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'navigation' => [ 'arrows', 'both' ],
				],
			]
		);

		$this->add_responsive_control(
			'arrows_size',
			[
				'label'     => esc_html__( 'Size', 'arolax-essential' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 20,
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

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'arrows_border',
				'selector' => '{{WRAPPER}} .wcf-arrow.wcf-arrow-prev, {{WRAPPER}} .wcf-arrow.wcf-arrow-next',
			]
		);

		$this->add_control(
			'arrows_b_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'arolax-essential' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .wcf-arrow.wcf-arrow-prev, {{WRAPPER}} .wcf-arrow.wcf-arrow-next' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'arrows_padding',
			[
				'label'      => esc_html__( 'Padding', 'arolax-essential' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .wcf-arrow.wcf-arrow-prev, {{WRAPPER}} .wcf-arrow.wcf-arrow-next' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'arrows_type',
			[
				'label' => esc_html__( 'Arrows Position Type', 'arolax-essential' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'static',
				'options' => [
					'static' => esc_html__( 'Default', 'arolax-essential' ),
					'absolute' => esc_html__( 'Absolute', 'arolax-essential' ),
				],
				'selectors' => [
					'{{WRAPPER}} .wcf-arrow' => 'position: {{VALUE}};',
				],
				'condition' => [
					'navigation' => [ 'arrows', 'both' ],
				],
			]
		);

		$this->add_control(
			'prev_pos_toggle',
			[
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'label' => esc_html__( 'Arrow Prev', 'arolax-essential' ),
				'label_off' => esc_html__( 'Default', 'arolax-essential' ),
				'label_on' => esc_html__( 'Custom', 'arolax-essential' ),
				'return_value' => 'yes',
				'condition' => [
					'arrows_type' => 'absolute',
				],
			]
		);

		$this->start_popover();

		$this->add_responsive_control(
			'prev_pos_left',
			[
				'label' => esc_html__( 'Left', 'arolax-essential' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => -50,
						'max' => 500,
					],
					'%' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .wcf-arrow.wcf-arrow-prev' => 'left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'prev_pos_btm',
			[
				'label' => esc_html__( 'Bottom', 'arolax-essential' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => -500,
						'max' => 500,
					],
					'%' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .wcf-arrow.wcf-arrow-prev' => 'bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_popover();

		$this->add_control(
			'next_pos_toggle',
			[
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'label' => esc_html__( 'Arrow Next', 'arolax-essential' ),
				'label_off' => esc_html__( 'Default', 'arolax-essential' ),
				'label_on' => esc_html__( 'Custom', 'arolax-essential' ),
				'return_value' => 'yes',
				'condition' => [
					'arrows_type' => 'absolute',
				],
			]
		);

		$this->start_popover();

		$this->add_responsive_control(
			'next_pos_right',
			[
				'label' => esc_html__( 'Right', 'arolax-essential' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => -500,
						'max' => 500,
					],
					'%' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .wcf-arrow.wcf-arrow-next' => 'right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'next_pos_btm',
			[
				'label' => esc_html__( 'Bottom', 'arolax-essential' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => -500,
						'max' => 500,
					],
					'%' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .wcf-arrow.wcf-arrow-next' => 'bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_popover();

		$this->start_controls_tabs(
			'arrows_style_tabs'
		);

		$this->start_controls_tab(
			'arrows_style_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'arolax-essential' ),
			]
		);

		$this->add_control(
			'arrows_color',
			[
				'label'     => esc_html__( 'Color', 'arolax-essential' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wcf-arrow.wcf-arrow-prev, {{WRAPPER}} .wcf-arrow.wcf-arrow-next'         => 'color: {{VALUE}};',
					'{{WRAPPER}} .wcf-arrow.wcf-arrow-prev svg, {{WRAPPER}} .wcf-arrow.wcf-arrow-next svg' => 'fill: {{VALUE}};',
					'{{WRAPPER}} .swiper-button-disabled::after'         => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'navigation' => [ 'arrows', 'both' ],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'arrows_bg_color',
				'types'    => [ 'classic', 'gradient' ],
				'exclude'  => [ 'image' ],
				'selector' => '{{WRAPPER}} .wcf-arrow.wcf-arrow-prev, {{WRAPPER}} .wcf-arrow.wcf-arrow-next',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'arrows_style_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'arolax-essential' ),
			]
		);

		$this->add_control(
			'arrows_h_color',
			[
				'label'     => esc_html__( 'Color', 'arolax-essential' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wcf-arrow.wcf-arrow-prev:hover, {{WRAPPER}} .wcf-arrow.wcf-arrow-next:hover'         => 'color: {{VALUE}};',
					'{{WRAPPER}} .wcf-arrow.wcf-arrow-prev:hover svg, {{WRAPPER}} .wcf-arrow.wcf-arrow-next:hover svg' => 'fill: {{VALUE}};',
				],
				'condition' => [
					'navigation' => [ 'arrows', 'both' ],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'arrows_h_bg_color',
				'types'    => [ 'classic', 'gradient' ],
				'exclude'  => [ 'image' ],
				'selector' => '{{WRAPPER}} .wcf-arrow.wcf-arrow-prev:hover, {{WRAPPER}} .wcf-arrow.wcf-arrow-next:hover',
			]
		);

		$this->add_control(
			'arrows_hb_color',
			[
				'label'     => esc_html__( 'Border Color', 'arolax-essential' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wcf-arrow.wcf-arrow-prev:hover, {{WRAPPER}} .wcf-arrow.wcf-arrow-next:hover' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'navigation' => [ 'arrows', 'both' ],
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	// Pagination
	private function slider_pagination_style_controls() {
		$this->start_controls_section(
			'style_pagination',
			[
				'label'     => esc_html__( 'Pagination', 'arolax-essential' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'navigation' => [ 'dots', 'both' ],
				],
			]
		);

		$this->add_responsive_control(
			'p_bar_height',
			[
				'label'     => esc_html__( 'Height', 'arolax-essential' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 1,
						'max' => 10,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .swiper-pagination-progressbar' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'p_bar_color',
			[
				'label'     => esc_html__( 'Color', 'arolax-essential' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .swiper-pagination-progressbar'  => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'bar_fill_color',
			[
				'label'     => esc_html__( 'Fill Color', 'arolax-essential' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .swiper-pagination-progressbar-fill'  => 'background: {{VALUE}};',
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

		if ( empty( $settings['testimonials'] ) ) {
			return;
		}

		//slider settings
		$show_dots   = ( in_array( $settings['navigation'], [ 'dots', 'both' ] ) );
		$show_arrows = ( in_array( $settings['navigation'], [ 'arrows', 'both' ] ) );

		$slider_settings = [
			'loop'         => 'true' === $settings['loop'],
			'speed'        => $settings['speed'],
			'loopedSlides' => count( $settings['testimonials'] ),
			'spaceBetween' => $settings['space_between'],
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
				'el'        => '.elementor-element-' . $this->get_id() . ' .swiper-pagination',
				'type'      => 'progressbar',
				'clickable' => true,
			];
		}

		//slider breakpoints
		$active_breakpoints = Plugin::$instance->breakpoints->get_active_breakpoints();

		$this->add_render_attribute(
			'wrapper',
			[
				'class'         => [ 'prod--common prod_testimonial_wrapper' ],
				'data-settings' => json_encode( $slider_settings ), //phpcs:ignore
			]
		);


		$this->add_render_attribute(
			'carousel-wrapper',
			[
				'class' => 'prod_testimonial_thumb swiper',
				'style' => 'position: relative',
			]
		);

		$this->add_render_attribute(
			'carousel-wrapper-2',
			[
				'class' => 'prod_testimonial_content swiper',
				'style' => 'position: static',
			]
		);
		?>
        <style>
        .elementor-widget-arolax--testimonial-2 .prod_testimonial_thumb .swiper-slide {
            width: calc(100% / <?php echo esc_attr( $settings['slides_to_show'] ) ?>);
        }
        <?php
        foreach ( array_reverse($active_breakpoints) as $breakpoint_name => $breakpoint ) {
            $slides_to_show = ! empty( $settings[ 'slides_to_show_' . $breakpoint_name ] ) ? $settings[ 'slides_to_show_' . $breakpoint_name ] : $settings['slides_to_show'];
                if ( 'widescreen' === $breakpoint->get_name() ){
                    ?>
                    @media (min-width: <?php echo esc_attr( $breakpoint->get_value() ); ?>px) {
                        .elementor-widget-arolax--testimonial-2 .prod_testimonial_thumb .swiper-slide {
                            width: calc(100% / <?php echo esc_attr( $slides_to_show ) ?>);
                        }
                    }
                    <?php
                } else {
                    ?>
                    @media (max-width: <?php echo esc_attr( $breakpoint->get_value() ); ?>px) {
                        .elementor-widget-arolax--testimonial-2 .prod_testimonial_thumb .swiper-slide {
                            width: calc(100% / <?php echo esc_attr( $slides_to_show ) ?>);
                        }
                    }
                    <?php
                }
            }
        ?>
        </style>
        <div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>

            <div <?php $this->print_render_attribute_string( 'carousel-wrapper-2' ); ?>>
                <div class="swiper-wrapper">
					<?php foreach ( $settings['testimonials'] as $index => $item ) { ?>
                        <div class="swiper-slide">
                            <div class="content">
                                <div class="quote">
									<?php Icons_Manager::render_icon( $item['tsm_quote'], [ 'aria-hidden' => 'true' ] ); ?>
                                </div>
                                <p><?php echo esc_html( $item['tsm_feedback'] ); ?></p>
                            </div>
                        </div>
					<?php } ?>
                </div>
            </div>

            <div <?php $this->print_render_attribute_string( 'carousel-wrapper' ); ?>>
                <div class="swiper-wrapper">
					<?php foreach ( $settings['testimonials'] as $index => $item ) { ?>
                        <div class="swiper-slide">
                            <div class="author">
                                <div class="avatar">
                                    <img src="<?php echo esc_url( $item['tsm_client_image']['url'] ); ?>"
                                         alt="Quote Image">
                                </div>
                                <div class="info">
                                    <div class="name"><?php echo esc_html( $item['tsm_client_name'] ); ?></div>
                                    <div class="role"><?php echo esc_html( $item['tsm_client_role'] ); ?></div>
                                </div>
                            </div>
                        </div>
					<?php } ?>
                </div>

	            <?php if ( 1 < count( $settings['testimonials'] ) ) : ?>
		            <?php if ( $show_dots ) : ?>
                        <div class="ts-pagination">
                            <div class="swiper-pagination"></div>
                        </div>
		            <?php endif; ?>
	            <?php endif; ?>
            </div>

			<?php if ( 1 < count( $settings['testimonials'] ) ) : ?>
				<?php if ( $show_arrows ) : ?>
                    <div class="ts-navigation">
                        <div class="wcf-arrow wcf-arrow-prev" role="button" tabindex="0">
							<?php $this->render_swiper_button( 'previous' ); ?>
                        </div>
                        <div class="wcf-arrow wcf-arrow-next" role="button" tabindex="0">
							<?php $this->render_swiper_button( 'next' ); ?>
                        </div>
                    </div>
				<?php endif; ?>
			<?php endif; ?>
        </div>
		<?php
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
}
