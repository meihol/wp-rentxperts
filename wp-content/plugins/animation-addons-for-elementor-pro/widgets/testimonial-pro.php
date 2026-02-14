<?php

namespace WCFAddonsPro\Widgets;

use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Plugin;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;

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
class Testimonial_Pro extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @return string Widget name.
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function get_name() {
		return 'wcf--testimonial-pro';
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
		return esc_html__( 'Advanced Testimonial', 'wcf-addons-pro' );
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
		return [ 'swiper', 'wcf--testimonial-pro' ];
	}

	public function get_script_depends() {
		return [ 'swiper', 'wcf--testimonial-pro' ];
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
				'label' => esc_html__( 'Advanced Testimonial', 'wcf-addons-pro' ),
			]
		);

		$this->add_control(
			'element_list',
			[
				'label'   => esc_html__( 'Testimonial Style', 'wcf-addons-pro' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '1',
				'options' => [
					'1' => esc_html__( 'One', 'wcf-addons-pro' ),
					'2' => esc_html__( 'Two', 'wcf-addons-pro' ),
					'3' => esc_html__( 'Three', 'wcf-addons-pro' ),
					'4' => esc_html__( 'Four', 'wcf-addons-pro' ),
					'5' => esc_html__( 'Five', 'wcf-addons-pro' ),
					'6' => esc_html__( 'Six', 'wcf-addons-pro' ),
				],
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'tsm_reason',
			[
				'label' => esc_html__( 'Feedback Reason', 'wcf-addons-pro' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Flexibility', 'wcf-addons-pro' ),
			]
		);

		$repeater->add_control(
			'tsm_content',
			[
				'label'   => esc_html__( 'Feedback', 'wcf-addons-pro' ),
				'type'    => Controls_Manager::TEXTAREA,
				'dynamic' => [
					'active' => true,
				],
				'rows'    => '10',
				'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'wcf-addons-pro' ),
			]
		);

		$repeater->add_control(
			'tsm_image',
			[
				'label'   => esc_html__( 'Client Image', 'wcf-addons-pro' ),
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
			'tsm_quote',
			[
				'label'   => esc_html__( 'Quote/Brand Image', 'wcf-addons-pro' ),
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
			'tsm_rating',
			[
				'label'   => esc_html__( 'Rating Image', 'wcf-addons-pro' ),
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
			'tsm_name',
			[
				'label'       => esc_html__( 'Name', 'wcf-addons-pro' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'dynamic'     => [
					'active' => true,
				],
				'default'     => 'John Doe',
			]
		);

		$repeater->add_control(
			'tsm_role',
			[
				'label'       => esc_html__( 'Designation', 'wcf-addons-pro' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'dynamic'     => [
					'active' => true,
				],
				'default'     => 'Designer',
			]
		);

		$repeater->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'tsm_item_bg',
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}',
			]
		);

		$this->add_control(
			'testimonials',
			[
				'label'   => esc_html__( 'Testimonials', 'wcf-addons-pro' ),
				'type'    => Controls_Manager::REPEATER,
				'fields'  => $repeater->get_controls(),
				'default' => [ [], [], [], [], [] ],
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'image',
				'default'   => 'full',
				'separator' => 'none',
			]
		);

		$this->add_control(
			'reason_show',
			[
				'label' => esc_html__( 'Show Feedback Reason', 'wcf-addons-pro' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'wcf-addons-pro' ),
				'label_off' => esc_html__( 'Hide', 'wcf-addons-pro' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'quote_show',
			[
				'label' => esc_html__( 'Show Quote/Image', 'wcf-addons-pro' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'wcf-addons-pro' ),
				'label_off' => esc_html__( 'Hide', 'wcf-addons-pro' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'img_show',
			[
				'label' => esc_html__( 'Show Client Image', 'wcf-addons-pro' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'wcf-addons-pro' ),
				'label_off' => esc_html__( 'Hide', 'wcf-addons-pro' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'rating_show',
			[
				'label' => esc_html__( 'Show Rating Image', 'wcf-addons-pro' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'wcf-addons-pro' ),
				'label_off' => esc_html__( 'Hide', 'wcf-addons-pro' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_responsive_control(
			'tsm_align',
			[
				'label'     => esc_html__( 'Alignment', 'wcf-addons-pro' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'start'  => [
						'title' => esc_html__( 'Left', 'wcf-addons-pro' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'wcf-addons-pro' ),
						'icon'  => 'eicon-text-align-center',
					],
					'end'    => [
						'title' => esc_html__( 'Right', 'wcf-addons-pro' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'toggle'    => true,
				'selectors' => [
					'{{WRAPPER}} .swiper-slide'       => 'text-align: {{VALUE}};',
					'{{WRAPPER}} .swiper-slide .wrap' => 'justify-content: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'quoat_icon',
			[
				'label' => esc_html__( 'Quote Icon', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-circle',
					'library' => 'fa-solid',
				],
				'condition' => ['element_list' => '4'],
			]
		);

		$this->add_responsive_control(
			'quoat_icon_size',
			[
				'label'      => esc_html__( 'Icon Size', 'wcf-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => -100,
						'max'  => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} i.helo-theme.wcftheme-wcf-icon.icon-wcf-quote-style-2' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'condition' => ['element_list' => '4'],
			]
		);

		$this->end_controls_section();

		// Slider Control
		$this->regsiter_slider_controls();

		// Layout Style
		$this->start_controls_section(
			'style_slide',
			[
				'label' => esc_html__( 'Slide', 'wcf-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'slide_background',
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .slide',
			]
		);

		$this->add_responsive_control(
			'slide_padding',
			[
				'label'      => esc_html__( 'Padding', 'wcf-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .slide' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'slide_border',
				'selector' => '{{WRAPPER}} .slide',
			]
		);

		$this->add_responsive_control(
			'slide_b_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'wcf-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .slide' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'      => 'slide_box_shadow',
				'selector'  => '{{WRAPPER}} .slide.six',
			]
		);

		$this->add_control(
			'slide_sep_color',
			[
				'label'     => esc_html__( 'Separator Color', 'wcf-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .swiper-slide::after' => 'background-color: {{VALUE}};',
				],
                'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'slide_sep_right',
			[
				'label'      => esc_html__( 'Separator Position', 'wcf-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => -100,
						'max'  => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .swiper-slide::after' => 'right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();


		// Reason Style
		$this->start_controls_section(
			'style_tsm_reason',
			[
				'label' => esc_html__( 'Reason', 'wcf-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => ['reason_show' => 'yes'],
			]
		);

		$this->add_control(
			'reason_color',
			[
				'label'     => esc_html__( 'Color', 'wcf-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .reason' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'reason_typo',
				'selector' => '{{WRAPPER}} .reason',
			]
		);

		$this->add_responsive_control(
			'reason_padding',
			[
				'label'      => esc_html__( 'Padding', 'wcf-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .reason' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();


		// Feedback Style
		$this->start_controls_section(
			'style_tsm_content',
			[
				'label' => esc_html__( 'Feedback', 'wcf-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'feedback_color',
			[
				'label'     => esc_html__( 'Color', 'wcf-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .feedback' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'feedback_typo',
				'selector' => '{{WRAPPER}} .feedback',
			]
		);

		$this->add_responsive_control(
			'feedback_padding',
			[
				'label'      => esc_html__( 'Padding', 'wcf-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .feedback' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'feedback_margin',
			[
				'label'      => esc_html__( 'Margin', 'wcf-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .feedback' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'feedback_border',
				'selector' => '{{WRAPPER}} .feedback',
			]
		);

		$this->end_controls_section();


		// Client Info
		$this->start_controls_section(
			'style_client_content',
			[
				'label' => esc_html__( 'Client Content', 'wcf-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'separator_color',
			[
				'label'     => esc_html__( 'Border Color', 'wcf-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .info' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'separator_padding',
			[
				'label'      => esc_html__( 'Border Padding', 'wcf-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .info' => 'padding-left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'name_heading',
			[
				'label'     => esc_html__( 'Name', 'wcf-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'name_heading_tsm_align',
			[
				'label'     => esc_html__( 'Alignment', 'wcf-addons-pro' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'start'  => [
						'title' => esc_html__( 'Left', 'wcf-addons-pro' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'wcf-addons-pro' ),
						'icon'  => 'eicon-text-align-center',
					],
					'end'    => [
						'title' => esc_html__( 'Right', 'wcf-addons-pro' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'toggle'    => true,
				'selectors' => [
					'{{WRAPPER}} .swiper-slide .wrap' => 'justify-content: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'name_text_color',
			[
				'label'     => esc_html__( 'Color', 'wcf-addons-pro' ),
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
				'name'     => 'name_typo',
				'selector' => '{{WRAPPER}} .name',
			]
		);

		$this->add_responsive_control(
			'name_padding',
			[
				'label'      => esc_html__( 'Padding', 'wcf-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'separator'  => 'before',
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .name' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'role_heading',
			[
				'label'     => esc_html__( 'Designation', 'wcf-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'role_text_color',
			[
				'label'     => esc_html__( 'Color', 'wcf-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .designation' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'job_typo',
				'selector' => '{{WRAPPER}} .designation',
			]
		);

		$this->add_responsive_control(
			'designation_padding',
			[
				'label'      => esc_html__( 'Padding', 'wcf-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'separator'  => 'before',
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .designation' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'img_heading',
			[
				'label'     => esc_html__( 'Image', 'wcf-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [ 'img_show' => 'yes' ],
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
						'min' => 0,
						'max' => 1000,
					],
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .image img' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [ 'img_show' => 'yes' ],
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
						'min' => 1,
						'max' => 1000,
					],
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .image img' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [ 'img_show' => 'yes' ],
			]
		);

		$this->add_responsive_control(
			'image_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'wcf-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [ 'img_show' => 'yes' ],
			]
		);

		$this->add_responsive_control(
			'image_margin',
			[
				'label'      => esc_html__( 'Margin', 'wcf-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [ 'img_show' => 'yes' ],
			]
		);

		$this->end_controls_section();


		// Quote Image Style.
		$this->start_controls_section(
			'style_quote_img',
			[
				'label'     => esc_html__( 'Quote/Brand Image', 'wcf-addons-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [ 'quote_show' => 'yes' ],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'quote_bg',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .quote::after',
				'condition' => [ 'element_list' => '3' ],
			]
		);

		$this->add_responsive_control(
			'quote_width',
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
					'{{WRAPPER}} .quote img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'quote_height',
			[
				'label'      => esc_html__( 'Height', 'wcf-addons-pro' ),
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
					'{{WRAPPER}} .quote img' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'quote_wrapper_width',
			[
				'label'      => esc_html__( 'Wrapper Width', 'wcf-addons-pro' ),
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
					'{{WRAPPER}} .quote' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [ 'element_list' => '3' ],
			]
		);

		$this->add_responsive_control(
			'quote_padding',
			[
				'label'      => esc_html__( 'Image Padding', 'wcf-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .quote img, .quote svg' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [ 'element_list' => '3' ],
			]
		);

		$this->add_responsive_control(
			'quote_margin',
			[
				'label'      => esc_html__( 'Margin', 'wcf-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .quote' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();


		// Rating Image Style
		$this->start_controls_section(
			'style_tsm_rating',
			[
				'label'     => esc_html__( 'Rating Image', 'wcf-addons-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [ 'rating_show' => 'yes' ],
			]
		);

		$this->add_responsive_control(
			'rating_width',
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
					'{{WRAPPER}} .rating img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'rating_height',
			[
				'label'      => esc_html__( 'Height', 'wcf-addons-pro' ),
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
					'{{WRAPPER}} .rating img' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'rating_margin',
			[
				'label'      => esc_html__( 'Margin', 'wcf-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .rating' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();


		// Slider Navigation
		$this->style_slider_navigation();
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
	private function regsiter_slider_controls() {
		$this->start_controls_section(
			'sec_slider_options',
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

		// Loop requires a re-render so no 'render_type = none'
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
					'cards'     => esc_html__( 'Cards', 'wcf-addons-pro' ),
					'flip'      => esc_html__( 'Flip', 'wcf-addons-pro' ),
					'fade'      => esc_html__( 'Fade', 'wcf-addons-pro' ),
					'cube'      => esc_html__( 'Cube', 'wcf-addons-pro' ),
					'coverflow' => esc_html__( 'CoderFlow', 'wcf-addons-pro' ),
					'creative'  => esc_html__( 'Creative', 'wcf-addons-pro' ),
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
				'label'     => esc_html__( 'Navigation', 'wcf-addons-pro' ),
				'type'      => Controls_Manager::SELECT,
				'separator' => 'before',
				'default'   => 'both',
				'options'   => [
					'both'   => esc_html__( 'Arrows and Dots', 'wcf-addons-pro' ),
					'arrows' => esc_html__( 'Arrows', 'wcf-addons-pro' ),
					'dots'   => esc_html__( 'Dots', 'wcf-addons-pro' ),
					'none'   => esc_html__( 'None', 'wcf-addons-pro' ),
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
	private function style_slider_navigation() {
		$this->start_controls_section(
			'style_navigation',
			[
				'label'     => esc_html__( 'Navigation', 'wcf-addons-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
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
						'min' => 20,
						'max' => 60,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .wcf-arrow.wcf-arrow-prev, {{WRAPPER}} .wcf-arrow.wcf-arrow-next' => 'font-size: {{SIZE}}{{UNIT}};',
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
				'label'      => esc_html__( 'Border Radius', 'wcf-addons-pro' ),
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
				'label'      => esc_html__( 'Padding', 'wcf-addons-pro' ),
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
				'label'     => esc_html__( 'Arrows Position Type', 'wcf-addons-pro' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'static',
				'options'   => [
					'static'   => esc_html__( 'Default', 'wcf-addons-pro' ),
					'absolute' => esc_html__( 'Absolute', 'wcf-addons-pro' ),
				],
				'selectors' => [
					'{{WRAPPER}} .wcf-arrow' => 'position: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'arrows_align',
			[
				'label'     => esc_html__( 'Alignment', 'wcf-addons-pro' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'flex-start'    => [
						'title' => esc_html__( 'Start', 'wcf-addons-pro' ),
						'icon'  => 'eicon-justify-start-h',
					],
					'center'        => [
						'title' => esc_html__( 'Center', 'wcf-addons-pro' ),
						'icon'  => 'eicon-justify-center-h',
					],
					'flex-end'      => [
						'title' => esc_html__( 'End', 'wcf-addons-pro' ),
						'icon'  => 'eicon-justify-end-h',
					],
					'space-between' => [
						'title' => esc_html__( 'Space Between', 'wcf-addons-pro' ),
						'icon'  => 'eicon-justify-space-between-h',
					],
				],
				'toggle'    => true,
				'selectors' => [
					'{{WRAPPER}} .ts-navigation' => 'justify-content: {{VALUE}};',
				],
				'condition' => [
					'arrows_type' => 'static',
				],
			]
		);

		$this->add_control(
			'prev_pos_toggle',
			[
				'type'         => Controls_Manager::POPOVER_TOGGLE,
				'label'        => esc_html__( 'Arrow Prev', 'wcf-addons-pro' ),
				'label_off'    => esc_html__( 'Default', 'wcf-addons-pro' ),
				'label_on'     => esc_html__( 'Custom', 'wcf-addons-pro' ),
				'return_value' => 'yes',
				'condition'    => [
					'arrows_type' => 'absolute',
				],
			]
		);

		$this->start_popover();

		$this->add_responsive_control(
			'prev_pos_left',
			[
				'label'      => esc_html__( 'Left', 'wcf-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range'      => [
					'px' => [
						'min' => - 1000,
						'max' => 1000,
					],
					'%'  => [
						'min' => - 100,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .wcf-arrow.wcf-arrow-prev' => 'left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'prev_pos_btm',
			[
				'label'      => esc_html__( 'Bottom', 'wcf-addons-pro' ),
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
					'{{WRAPPER}} .wcf-arrow.wcf-arrow-prev' => 'bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_popover();

		$this->add_control(
			'next_pos_toggle',
			[
				'type'         => Controls_Manager::POPOVER_TOGGLE,
				'label'        => esc_html__( 'Arrow Next', 'wcf-addons-pro' ),
				'label_off'    => esc_html__( 'Default', 'wcf-addons-pro' ),
				'label_on'     => esc_html__( 'Custom', 'wcf-addons-pro' ),
				'return_value' => 'yes',
				'condition'    => [
					'arrows_type' => 'absolute',
				],
			]
		);

		$this->start_popover();

		$this->add_responsive_control(
			'next_pos_right',
			[
				'label'      => esc_html__( 'Right', 'wcf-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range'      => [
					'px' => [
						'min' => - 1000,
						'max' => 1000,
					],
					'%'  => [
						'min' => - 100,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .wcf-arrow.wcf-arrow-next' => 'right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'next_pos_btm',
			[
				'label'      => esc_html__( 'Bottom', 'wcf-addons-pro' ),
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
				'label' => esc_html__( 'Normal', 'wcf-addons-pro' ),
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
				'label' => esc_html__( 'Hover', 'wcf-addons-pro' ),
			]
		);

		$this->add_control(
			'arrows_h_color',
			[
				'label'     => esc_html__( 'Color', 'wcf-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wcf-arrow.wcf-arrow-prev:hover, {{WRAPPER}} .wcf-arrow.wcf-arrow-next:hover'         => 'color: {{VALUE}};',
					'{{WRAPPER}} .wcf-arrow.wcf-arrow-prev:hover svg, {{WRAPPER}} .wcf-arrow.wcf-arrow-next:hover svg' => 'fill: {{VALUE}};',
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
				'label'     => esc_html__( 'Border Color', 'wcf-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wcf-arrow.wcf-arrow-prev:hover, {{WRAPPER}} .wcf-arrow.wcf-arrow-next:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();


		// Pagination
		$this->start_controls_section(
			'style_pagination',
			[
				'label'     => esc_html__( 'Pagination', 'wcf-addons-pro' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'navigation' => [ 'dots', 'both' ],
				],
			]
		);

		$this->add_control(
			'dots_inactive_color',
			[
				'label'     => esc_html__( 'Color', 'wcf-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .swiper-pagination-bullet:not(.swiper-pagination-bullet-active)'  => 'background: {{VALUE}}; opacity: 1',
					'{{WRAPPER}} .swiper-pagination-current, {{WRAPPER}} .swiper-pagination-total' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'dots_width',
			[
				'label'     => esc_html__( 'Width', 'wcf-addons-pro' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 1,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .swiper-pagination-bullet' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'dots_height',
			[
				'label'     => esc_html__( 'Height', 'wcf-addons-pro' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 1,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .swiper-pagination-bullet' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'dots_gap',
			[
				'label'     => esc_html__( 'Gap', 'wcf-addons-pro' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .swiper-pagination-bullets' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'pg_b_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'wcf-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .swiper-pagination-bullet' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'dots_show_type',
			[
				'label'     => esc_html__( 'Dots Show', 'wcf-addons-pro' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'static',
				'options'   => [
					'row'    => esc_html__( 'Beside', 'wcf-addons-pro' ),
					'column' => esc_html__( 'Up & Down', 'wcf-addons-pro' ),
				],
				'selectors' => [
					'{{WRAPPER}} .swiper-pagination-bullets' => 'flex-direction: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'dots_type',
			[
				'label'     => esc_html__( 'Dots Position Type', 'wcf-addons-pro' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'static',
				'options'   => [
					'static'   => esc_html__( 'Default', 'wcf-addons-pro' ),
					'absolute' => esc_html__( 'Absolute', 'wcf-addons-pro' ),
				],
				'selectors' => [
					'{{WRAPPER}} .swiper-pagination' => 'position: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'dots_align',
			[
				'label'     => esc_html__( 'Alignment', 'wcf-addons-pro' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'flex-start' => [
						'title' => esc_html__( 'Start', 'wcf-addons-pro' ),
						'icon'  => 'eicon-justify-start-h',
					],
					'center'     => [
						'title' => esc_html__( 'Center', 'wcf-addons-pro' ),
						'icon'  => 'eicon-justify-center-h',
					],
					'flex-end'   => [
						'title' => esc_html__( 'End', 'wcf-addons-pro' ),
						'icon'  => 'eicon-justify-end-h',
					],
				],
				'toggle'    => true,
				'selectors' => [
					'{{WRAPPER}} .swiper-pagination' => 'justify-content: {{VALUE}};',
				],
				'condition' => [
					'dots_type'      => 'static',
					'dots_show_type' => 'row',
				],
			]
		);

		$this->add_control(
			'dots_toggle',
			[
				'type'         => Controls_Manager::POPOVER_TOGGLE,
				'label'        => esc_html__( 'Dots Position', 'wcf-addons-pro' ),
				'label_off'    => esc_html__( 'Default', 'wcf-addons-pro' ),
				'label_on'     => esc_html__( 'Custom', 'wcf-addons-pro' ),
				'return_value' => 'yes',
				'condition'    => [
					'dots_type' => 'absolute',
				],
			]
		);

		$this->start_popover();

		$this->add_responsive_control(
			'dots_pos_left',
			[
				'label'      => esc_html__( 'Left', 'wcf-addons-pro' ),
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
			'dots_pos_btm',
			[
				'label'      => esc_html__( 'Bottom', 'wcf-addons-pro' ),
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
					'{{WRAPPER}} .swiper-pagination' => 'bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_popover();

		// Dots Active
		$this->add_control(
			'dots_heading',
			[
				'label'     => esc_html__( 'Dots Active', 'wcf-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'dots_color',
			[
				'label'     => esc_html__( 'Color', 'wcf-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .swiper-pagination-bullet'  => 'background: {{VALUE}};',
					'{{WRAPPER}} .swiper-pagination-current' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'dots_a_width',
			[
				'label'     => esc_html__( 'Width', 'wcf-addons-pro' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 1,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .swiper-pagination-bullet-active' => 'width: {{SIZE}}{{UNIT}};',
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
				'el'        => '.elementor-element-' . $this->get_id() . ' .swiper-pagination',
				'clickable' => true,
			];
		}

		//slider breakpoints
		$active_breakpoints = Plugin::$instance->breakpoints->get_active_breakpoints();

		foreach ( $active_breakpoints as $breakpoint_name => $breakpoint ) {
			$slides_to_show = ! empty( $settings[ 'slides_to_show_' . $breakpoint_name ] ) ? $settings[ 'slides_to_show_' . $breakpoint_name ] : $settings['slides_to_show'];
			$space_between = ! empty( $settings[ 'space_between_' . $breakpoint_name ] ) ? $settings[ 'space_between_' . $breakpoint_name ] : $settings['space_between'];

			$slider_settings['breakpoints'][ $breakpoint->get_value() ]['slidesPerView'] = $slides_to_show;
			$slider_settings['breakpoints'][ $breakpoint->get_value() ]['spaceBetween'] = $space_between;
		}

		$this->add_render_attribute(
			'wrapper',
			[
				'class'         => [ 'helo_testimonial_wrapper helo__testimonial-' . $settings['element_list'] ],
				'data-settings' => json_encode( $slider_settings ), //phpcs:ignore
			]
		);

		$this->add_render_attribute(
			'carousel-wrapper',
			[
				'class' => 'helo_testimonial_slider swiper',
				'style' => 'position: static',
				'dir'   => 'ltr',
			]
		);
		?>
        <div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>

            <div <?php $this->print_render_attribute_string( 'carousel-wrapper' ); ?>>
                <div class="swiper-wrapper">
					<?php foreach ( $settings['testimonials'] as $index => $item ) { ?>
                        <div class="swiper-slide">
							<?php
							if ( '1' === $settings['element_list'] ) {
								$this->render_testimonial_one( $settings, $item, $index );
							} elseif ( '2' === $settings['element_list'] ) {
								$this->render_testimonial_two( $settings, $item, $index );
							} elseif ( '3' === $settings['element_list'] ) {
								$this->render_testimonial_three( $settings, $item, $index );
							}elseif ( '4' === $settings['element_list'] ) {
								$this->render_testimonial_four( $settings, $item, $index );
							}
							elseif ( '5' === $settings['element_list'] ) {
								$this->render_testimonial_five( $settings, $item, $index );
							}
							elseif ( '6' === $settings['element_list'] ) {
								$this->render_testimonial_six( $settings, $item, $index );
							}

							?>
                        </div>
					<?php } ?>
                </div>
            </div>

            <!-- navigation and pagination -->
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

				<?php if ( $show_dots ) : ?>
                    <div class="ts-pagination">
                        <div class="swiper-pagination"></div>
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

	protected function render_testimonial_one( $settings, $item, $index ) {
		?>
        <div class="slide elementor-repeater-item-<?php echo esc_attr( $item['_id'] ) ?>">
			<?php if ( $item['tsm_quote']['url'] && 'yes' === $settings['quote_show'] ) { ?>
                <div class="quote">
                    <img src="<?php echo $item['tsm_quote']['url']; ?>" alt="Quote">
                </div>
			<?php } ?>

            <?php if ( 'yes' === $settings['reason_show'] ) { ?>
                <div class="reason">
		            <?php $this->print_unescaped_setting( 'tsm_reason', 'testimonials', $index ); ?>
                </div>
			<?php } ?>

            <div class="feedback">
				<?php $this->print_unescaped_setting( 'tsm_content', 'testimonials', $index ); ?>
            </div>
            <div class="wrap">
                <div class="author">
					<?php if ( $item['tsm_image']['url'] && 'yes' === $settings['img_show'] ) { ?>
                        <div class="image">
                            <img src="<?php echo $item['tsm_image']['url']; ?>" alt="Image">
                        </div>
					<?php } ?>
                    <div class="info">
                        <div class="name"><?php $this->print_unescaped_setting( 'tsm_name', 'testimonials', $index ); ?></div>
                        <div class="designation"><?php $this->print_unescaped_setting( 'tsm_role', 'testimonials', $index ); ?></div>
						<?php if ( $item['tsm_rating']['url'] && 'yes' === $settings['rating_show'] ) { ?>
                            <div class="rating">
                                <img src="<?php echo $item['tsm_rating']['url']; ?>" alt="Quote">
                            </div>
						<?php } ?>
                    </div>
                </div>
            </div>
        </div>
		<?php
	}

	protected function render_testimonial_two( $settings, $item, $index ) {
		?>
        <div class="slide elementor-repeater-item-<?php echo esc_attr( $item['_id'] ) ?>">
			<?php if ( $item['tsm_quote']['url'] && 'yes' === $settings['quote_show'] ) { ?>
                <div class="quote">
                    <img src="<?php echo $item['tsm_quote']['url']; ?>" alt="Quote">
                </div>
			<?php } ?>

			<?php if ( 'yes' === $settings['reason_show'] ) { ?>
                <div class="reason">
					<?php $this->print_unescaped_setting( 'tsm_reason', 'testimonials', $index ); ?>
                </div>
			<?php } ?>

            <div class="feedback">
				<?php $this->print_unescaped_setting( 'tsm_content', 'testimonials', $index ); ?>
            </div>
	        <?php if ( $item['tsm_rating']['url'] && 'yes' === $settings['rating_show'] ) { ?>
                <div class="rating">
                    <img src="<?php echo $item['tsm_rating']['url']; ?>" alt="Quote">
                </div>
	        <?php } ?>
            <div class="wrap">
                <div class="author">
					<?php if ( $item['tsm_image']['url'] && 'yes' === $settings['img_show'] ) { ?>
                        <div class="image">
                            <img src="<?php echo $item['tsm_image']['url']; ?>" alt="Image">
                        </div>
					<?php } ?>
                    <div class="info">
                        <div class="name"><?php $this->print_unescaped_setting( 'tsm_name', 'testimonials', $index ); ?></div>
                        <div class="designation"><?php $this->print_unescaped_setting( 'tsm_role', 'testimonials', $index ); ?></div>
                    </div>
                </div>
            </div>
        </div>
		<?php
	}

	protected function render_testimonial_three( $settings, $item, $index ) {
		?>
        <div class="slide elementor-repeater-item-<?php echo esc_attr( $item['_id'] ) ?>">
	        <?php if ( $item['tsm_rating']['url'] && 'yes' === $settings['rating_show'] ) { ?>
                <div class="rating">
                    <img src="<?php echo $item['tsm_rating']['url']; ?>" alt="Quote">
                </div>
	        <?php } ?>
			<?php if ( 'yes' === $settings['reason_show'] ) { ?>
                <div class="reason">
					<?php $this->print_unescaped_setting( 'tsm_reason', 'testimonials', $index ); ?>
                </div>
			<?php } ?>
	        <?php if ( $item['tsm_quote']['url'] && 'yes' === $settings['quote_show'] ) { ?>
                <div class="quote">
                    <img src="<?php echo $item['tsm_quote']['url']; ?>" alt="Quote">
                </div>
	        <?php } ?>
            <div class="feedback">
				<?php $this->print_unescaped_setting( 'tsm_content', 'testimonials', $index ); ?>
            </div>
            <div class="wrap">
                <div class="author">
					<?php if ( $item['tsm_image']['url'] && 'yes' === $settings['img_show'] ) { ?>
                        <div class="image">
                            <img src="<?php echo $item['tsm_image']['url']; ?>" alt="Image">
                        </div>
					<?php } ?>
                    <div class="info">
                        <div class="name"><?php $this->print_unescaped_setting( 'tsm_name', 'testimonials', $index ); ?></div>
                        <div class="designation"><?php $this->print_unescaped_setting( 'tsm_role', 'testimonials', $index ); ?></div>
                    </div>
                </div>
            </div>
        </div>
		<?php
	}

	protected function render_testimonial_four( $settings, $item, $index ) {
		?>
        <div class="slide elementor-repeater-item-<?php echo esc_attr( $item['_id'] ) ?>">
			<div class="content_top_area">
				<?php if ( 'yes' === $settings['reason_show'] ) { ?>
					<div class="reason">
						<?php $this->print_unescaped_setting( 'tsm_reason', 'testimonials', $index ); ?>
					</div>
				<?php } ?>
				<?php if ( $item['tsm_quote']['url'] && 'yes' === $settings['quote_show'] ) { ?>
					<div class="quote">
						<img src="<?php echo $item['tsm_quote']['url']; ?>" alt="Quote">
					</div>
				<?php } ?>
				<?php if ( $item['tsm_rating']['url'] && 'yes' === $settings['rating_show'] ) { ?>
					<div class="rating">
						<img src="<?php echo $item['tsm_rating']['url']; ?>" alt="Quote">
					</div>
				<?php } ?>
			</div>
            <div class="feedback">
				<?php $this->print_unescaped_setting( 'tsm_content', 'testimonials', $index ); ?>
            </div>
            <div class="wrap">
                <div class="author">
					<?php if ( $item['tsm_image']['url'] && 'yes' === $settings['img_show'] ) { ?>
                        <div class="image">
                            <img src="<?php echo $item['tsm_image']['url']; ?>" alt="Image">
                        </div>
					<?php } ?>
                    <div class="info">
                        <div class="name"><?php $this->print_unescaped_setting( 'tsm_name', 'testimonials', $index ); ?></div>
                        <div class="designation"><?php $this->print_unescaped_setting( 'tsm_role', 'testimonials', $index ); ?></div>
                    </div>
                </div>
				<div class="quote_icon">
					<?php \Elementor\Icons_Manager::render_icon( $settings['quoat_icon'], [ 'aria-hidden' => 'true' ] ); ?>	
				</div>
            </div>
        </div>
		<?php
	}

	protected function render_testimonial_five( $settings, $item, $index ) {
		?>
        <div class="slide elementor-repeater-item-<?php echo esc_attr( $item['_id'] ) ?>">
			<div class="testimonials_style_5">
				<div class="content_top_area five">
					<?php if ( 'yes' === $settings['reason_show'] ) { ?>
						<div class="reason">
							<?php $this->print_unescaped_setting( 'tsm_reason', 'testimonials', $index ); ?>
						</div>
					<?php } ?>
					<?php if ( $item['tsm_quote']['url'] && 'yes' === $settings['quote_show'] ) { ?>
						<div class="quote">
							<img src="<?php echo $item['tsm_quote']['url']; ?>" alt="Quote">
						</div>
					<?php } ?>
				</div>
				<div class="content-wrap">
					<?php if ( $item['tsm_rating']['url'] && 'yes' === $settings['rating_show'] ) { ?>
						<div class="rating">
							<img src="<?php echo $item['tsm_rating']['url']; ?>" alt="Quote">
						</div>
					<?php } ?>

					<div class="feedback">
						<?php $this->print_unescaped_setting( 'tsm_content', 'testimonials', $index ); ?>
					</div>
					<div class="wrap">
						<div class="author">
							<?php if ( $item['tsm_image']['url'] && 'yes' === $settings['img_show'] ) { ?>
								<div class="image">
									<img src="<?php echo $item['tsm_image']['url']; ?>" alt="Image">
								</div>
							<?php } ?>
							<div class="info">
								<div class="name"><?php $this->print_unescaped_setting( 'tsm_name', 'testimonials', $index ); ?></div>
								<div class="designation"><?php $this->print_unescaped_setting( 'tsm_role', 'testimonials', $index ); ?></div>
							</div>
						</div>
						<div class="quote_icon">
							<?php \Elementor\Icons_Manager::render_icon( $settings['quoat_icon'], [ 'aria-hidden' => 'true' ] ); ?>	
						</div>
					</div>
				</div>
			</div>
        </div>
		<?php
	}
	protected function render_testimonial_six( $settings, $item, $index ) {
		?>
        <div class="slide six elementor-repeater-item-<?php echo esc_attr( $item['_id'] ) ?>">
	        <?php if ( $item['tsm_rating']['url'] && 'yes' === $settings['rating_show'] ) { ?>
                <div class="rating">
                    <img src="<?php echo $item['tsm_rating']['url']; ?>" alt="Quote">
                </div>
	        <?php } ?>
			<?php if ( 'yes' === $settings['reason_show'] ) { ?>
                <div class="reason">
					<?php $this->print_unescaped_setting( 'tsm_reason', 'testimonials', $index ); ?>
                </div>
			<?php } ?>
	        <?php if ( $item['tsm_quote']['url'] && 'yes' === $settings['quote_show'] ) { ?>
                <div class="quote">
                    <img src="<?php echo $item['tsm_quote']['url']; ?>" alt="Quote">
                </div>
	        <?php } ?>
            <div class="feedback">
				<?php $this->print_unescaped_setting( 'tsm_content', 'testimonials', $index ); ?>
            </div>
            <div class="wrap">
                <div class="author">
					<?php if ( $item['tsm_image']['url'] && 'yes' === $settings['img_show'] ) { ?>
                        <div class="image">
                            <img src="<?php echo $item['tsm_image']['url']; ?>" alt="Image">
                        </div>
					<?php } ?>
                    <div class="info">
                        <div class="name"><?php $this->print_unescaped_setting( 'tsm_name', 'testimonials', $index ); ?></div>
                        <div class="designation"><?php $this->print_unescaped_setting( 'tsm_role', 'testimonials', $index ); ?></div>
                    </div>
                </div>
            </div>
        </div>
		<?php
	}
}
