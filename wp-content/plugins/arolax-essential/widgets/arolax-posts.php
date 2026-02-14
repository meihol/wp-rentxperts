<?php

namespace ArolaxEssentialApp\Widgets;

use Elementor\Controls_Manager;
use Elementor\Control_Media;
use Elementor\Group_Control_Background;
use Elementor\Utils;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Plugin;
use Elementor\Widget_Base;
use Elementor\Icons_Manager;
use WP_Query;

if ( ! defined( 'ABSPATH' ) ) {
	exit;   // Exit if accessed directly.
}

class Arolax_Posts extends Widget_Base {

	/**
	 * @var \WP_Query
	 */
	protected $query = null;

	public function get_name() {
		return 'arolax--posts';
	}

	public function get_title() {
		return esc_html__( 'Arolax Posts', 'arolax-essential' );
	}

	public function get_icon() {
		return 'wcf eicon-post-list';
	}

	public function get_categories() {
		return [ 'weal-coder-addon' ];
	}

	public function get_style_depends() {
		wp_register_style( 'arolax-button', AROLAX_ESSENTIAL_ASSETS_URL . 'css/arolax-button.css' );
		wp_register_style( 'arolax-posts', AROLAX_ESSENTIAL_ASSETS_URL . 'css/arolax-post.css' );

		return [ 'arolax-button', 'arolax-posts' ];
	}

	// Content Control
	public function register_content_controls() {
		$this->start_controls_section(
			'arolax_sec_post_layout',
			[
				'label' => __( 'Layout', 'arolax-essential' ),
			]
		);

		$this->add_control(
			'element_list',
			[
				'label'     => esc_html__( 'Style', 'arolax-essential' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '1',
				'separator' => 'after',
				'options'   => [
					'1' => esc_html__( 'One', 'arolax-essential' ),
					'2' => esc_html__( 'Two', 'arolax-essential' ),
					'3' => esc_html__( 'Three', 'arolax-essential' ),
					'4' => esc_html__( 'Four', 'arolax-essential' ),
					'5' => esc_html__( 'Five', 'arolax-essential' ),
				],
			]
		);

		$this->add_control(
			'btn_text',
			[
				'label'       => esc_html__( 'Read More Text', 'arolax-essential' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Read More', 'arolax-essential' ),
				'placeholder' => esc_html__( 'Type your text here', 'arolax-essential' ),
				'condition'   => [
					'element_list' => ['2', '4'],
				],
			]
		);

		$this->add_control(
			'btn_icon',
			[
				'label'       => esc_html__( 'Read More Icon', 'arolax-essential' ),
				'type'        => Controls_Manager::ICONS,
				'skin'        => 'inline',
				'label_block' => false,
				'default'     => [
					'value'   => 'fas fa-arrow-right',
					'library' => 'fa-solid',
				],
				'condition'   => [
					'element_list' => ['2', '4'],
				],
			]
		);

		$this->add_control(
			'author_text',
			[
				'label'       => esc_html__( 'Date Text', 'arolax-essential' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Written by', 'arolax-essential' ),
				'placeholder' => esc_html__( 'Type your text here', 'arolax-essential' ),
				'condition'   => [
					'element_list' => '2',
				],
			]
		);

		$this->add_control(
			'link_icon',
			[
				'label'       => esc_html__( 'Link Icon', 'arolax-essential' ),
				'type'        => Controls_Manager::ICONS,
				'skin'        => 'inline',
				'label_block' => false,
				'default'     => [
					'value'   => 'fas fa-arrow-right',
					'library' => 'fa-solid',
				],
				'condition'   => [
					'element_list' => [ '1', '3' ],
				],
			]
		);

		$this->add_control(
			'arolax_show_title',
			[
				'label'     => esc_html__( 'Show Title', 'arolax-essential' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'label_off' => esc_html__( 'Off', 'arolax-essential' ),
				'label_on'  => esc_html__( 'On', 'arolax-essential' ),
			]
		);

		$this->add_control(
			'arolax_show_excerpt',
			[
				'label'     => esc_html__( 'Show Excerpt', 'arolax-essential' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'label_off' => esc_html__( 'Off', 'arolax-essential' ),
				'label_on'  => esc_html__( 'On', 'arolax-essential' ),
			]
		);

		$this->add_control(
			'arolax_show_thumb',
			[
				'label'     => esc_html__( 'Show Thumbnail', 'arolax-essential' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_off' => esc_html__( 'Off', 'arolax-essential' ),
				'label_on'  => esc_html__( 'On', 'arolax-essential' ),
			]
		);

		$this->add_control(
			'arolax_show_meta',
			[
				'label'     => esc_html__( 'Show Meta', 'arolax-essential' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'label_off' => esc_html__( 'Off', 'arolax-essential' ),
				'label_on'  => esc_html__( 'On', 'arolax-essential' ),
			]
		);

		$this->add_control(
			'arolax_show_author',
			[
				'label'     => esc_html__( 'Show Author', 'arolax-essential' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'label_off' => esc_html__( 'Off', 'arolax-essential' ),
				'label_on'  => esc_html__( 'On', 'arolax-essential' ),
				'condition' => [
					'arolax_show_meta' => 'yes',
				],
			]
		);

		$this->add_control(
			'arolax_show_date',
			[
				'label'     => esc_html__( 'Show Date', 'arolax-essential' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'label_off' => esc_html__( 'Off', 'arolax-essential' ),
				'label_on'  => esc_html__( 'On', 'arolax-essential' ),
				'condition' => [
					'arolax_show_meta' => 'yes',
				],
			]
		);

		$this->add_control(
			'arolax_show_category',
			[
				'label'     => esc_html__( 'Show Category', 'arolax-essential' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'label_off' => esc_html__( 'Off', 'arolax-essential' ),
				'label_on'  => esc_html__( 'On', 'arolax-essential' ),
				'condition' => [
					'arolax_show_meta' => 'yes',
				],
			]
		);

		$this->add_control(
			'arolax_show_comment',
			[
				'label'     => esc_html__( 'Show Comment', 'arolax-essential' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'label_off' => esc_html__( 'Off', 'arolax-essential' ),
				'label_on'  => esc_html__( 'On', 'arolax-essential' ),
				'condition' => [
					'arolax_show_meta' => 'yes',
				],
			]
		);

		$this->add_control(
			'arolax_show_rm',
			[
				'label'     => esc_html__( 'Show Read More', 'arolax-essential' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'label_off' => esc_html__( 'Off', 'arolax-essential' ),
				'label_on'  => esc_html__( 'On', 'arolax-essential' ),
				'condition' => [
					'element_list' => ['2', '4'],
				],
			]
		);

		$this->add_control(
			'arolax_show_link',
			[
				'label'     => esc_html__( 'Show Link Icon', 'arolax-essential' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'label_off' => esc_html__( 'Off', 'arolax-essential' ),
				'label_on'  => esc_html__( 'On', 'arolax-essential' ),
				'condition' => [
					'element_list' => [ '1', '3' ],
				],
			]
		);

		$this->end_controls_section();


		// Query
		$this->start_controls_section(
			'arolax_sec_post_query',
			[
				'label' => __( 'Query', 'arolax-essential' ),
			]
		);

		$this->add_control(
			'query_type',
			[
				'label'   => esc_html__( 'Query Type', 'arolax-essential' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'post',
				'options' => [
					'post'    => esc_html__( 'Posts', 'arolax-essential' ),
					'archive' => esc_html__( 'Archive', 'arolax-essential' ),
					'related' => esc_html__( 'related', 'arolax-essential' ),
				],
			]
		);

		$this->add_control(
			'posts_id',
			[
				'label'       => esc_html__( 'Include Posts', 'arolax-essential' ),
				'type'        => Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple'    => true,
				'options'     => $this->get_all_posts(),
				'condition'   => [
					'query_type' => 'post',
				],
			]
		);

		$this->add_control(
			'arolax_post_order_by',
			[
				'label'     => esc_html__( 'Order By', 'arolax-essential' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'date',
				'options'   => [
					'date'          => esc_html__( 'Date', 'arolax-essential' ),
					'title'         => esc_html__( 'Title', 'arolax-essential' ),
					'menu_order'    => esc_html__( 'Menu Order', 'arolax-essential' ),
					'modified'      => esc_html__( 'Last Modified', 'arolax-essential' ),
					'comment_count' => esc_html__( 'Comment Count', 'arolax-essential' ),
					'rand'          => esc_html__( 'Random', 'arolax-essential' ),
				],
				'condition' => [
					'query_type' => [ 'post', 'related' ],
				],
			]
		);

		$this->add_control(
			'arolax_post_order',
			[
				'label'     => esc_html__( 'Order', 'arolax-essential' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'desc',
				'options'   => [
					'asc'  => esc_html__( 'ASC', 'arolax-essential' ),
					'desc' => esc_html__( 'DESC', 'arolax-essential' ),
				],
				'condition' => [
					'query_type' => [ 'post', 'related' ],
				],
			]
		);

		$this->add_control(
			'arolax_posts_ppage',
			[
				'label'     => esc_html__( 'Posts Per Page', 'arolax-essential' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 6,
				'condition' => [
					'query_type' => [ 'post', 'related' ],
				],
			]
		);

		$this->end_controls_section();
	}

	// Style Control
	public function register_style_controls() {

		$this->start_controls_section(
			'arolax_style_layout',
			[
				'label' => esc_html__( 'Layout', 'arolax-essential' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'blog_cols',
			[
				'label'     => esc_html__( 'Columns', 'arolax-essential' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '1',
				'options'   => [
					'1' => esc_html__( '1', 'arolax-essential' ),
					'2' => esc_html__( '2', 'arolax-essential' ),
					'3' => esc_html__( '3', 'arolax-essential' ),
					'4' => esc_html__( '4', 'arolax-essential' ),
				],
				'selectors' => [
					'{{WRAPPER}} .arolax--post' => 'grid-template-columns: repeat({{VALUE}}, 1fr);',
				],
			]
		);

		$this->add_responsive_control(
			'blog_col_gap',
			[
				'label'      => esc_html__( 'Column Gap', 'arolax-essential' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .arolax--post' => 'column-gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'blog_row_gap',
			[
				'label'      => esc_html__( 'Row Gap', 'arolax-essential' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .arolax--post' => 'row-gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'blog_item_gap',
			[
				'label'      => esc_html__( 'Item Inner Gap', 'arolax-essential' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .arolax--post .item' => 'gap: {{SIZE}}{{UNIT}};',
				],
				'condition' => [ 'element_list' => '4' ],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'blog_wrap_bg',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .arolax--post .item',
                'condition' => ['element_list' => '4'],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'blog_border',
				'selector' => '{{WRAPPER}} .arolax--post .item',
			]
		);

		$this->add_responsive_control(
			'blog_b_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'arolax-essential' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .arolax--post .item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'blog_h_border_color',
			[
				'label'     => esc_html__( 'Border Hover Color', 'arolax-essential' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .arolax--post .item:hover' => 'border-color: {{VALUE}}',
				],
				'condition' => [
					'element_list' => '1',
				],
			]
		);

		$this->add_responsive_control(
			'blog_padding',
			[
				'label'      => esc_html__( 'Padding', 'arolax-essential' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .arolax--post .item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Item
		$this->start_controls_section(
			'sec_style_item',
			[
				'label'     => esc_html__( 'Item', 'arolax-essential' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'element_list' => ['3', '5'],
				],
			]
		);

		$this->add_responsive_control(
			'content_width',
			[
				'label'      => esc_html__( 'Width', 'arolax-essential' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 500,
					],
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .arolax--post .wrapper' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'element_list' =>  '5',
				],
			]
		);

		$this->add_control(
			'item_bg_color',
			[
				'label'     => esc_html__( 'Background Color', 'arolax-essential' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .arolax--post.post-style-3 .item::after, {{WRAPPER}} .arolax--post .wrapper' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'item_b_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'arolax-essential' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .arolax--post .wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'item_padding',
			[
				'label'      => esc_html__( 'Padding', 'arolax-essential' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .arolax--post .wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Thumbnail
		$this->start_controls_section(
			'sec_style_thumb',
			[
				'label'     => esc_html__( 'Thumbnail', 'arolax-essential' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'arolax_show_thumb' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'bthumb_width',
			[
				'label'      => esc_html__( 'Width', 'arolax-essential' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 5,
					],
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .thumb img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'bthumb_height',
			[
				'label'      => esc_html__( 'Height', 'arolax-essential' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 5,
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
			'thumb_b_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'arolax-essential' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .thumb img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'bthumb_margin',
			[
				'label'      => esc_html__( 'Spacing', 'arolax-essential' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .thumb' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		//  Title
		$this->start_controls_section(
			'sec_style_title',
			[
				'label'     => esc_html__( 'Title', 'arolax-essential' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'arolax_show_title' => 'yes',
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

		$this->add_responsive_control(
			'title_margin',
			[
				'label'      => esc_html__( 'Spacing', 'arolax-essential' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs(
			'title_style_tabs'
		);

		$this->start_controls_tab(
			'title_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'arolax-essential' ),
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__( 'Color', 'arolax-essential' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'title_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'arolax-essential' ),
			]
		);

		$this->add_control(
			'title_h_color',
			[
				'label'     => esc_html__( 'Color', 'arolax-essential' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .title a:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();


		// Excerpt
		$this->start_controls_section(
			'arolax_style_excerpt',
			[
				'label'     => esc_html__( 'Excerpt', 'arolax-essential' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'arolax_show_excerpt' => 'yes',
				],
			]
		);

		$this->add_control(
			'excerpt_color',
			[
				'label'     => esc_html__( 'Color', 'arolax-essential' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cf_text p' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'excerpt_typo',
				'selector' => '{{WRAPPER}} .cf_text p',
			]
		);

		$this->add_responsive_control(
			'excerpt_margin',
			[
				'label'      => esc_html__( 'Spacing', 'arolax-essential' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .cf_text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Meta
		$this->start_controls_section(
			'sec_style_meta',
			[
				'label'     => esc_html__( 'Meta', 'arolax-essential' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'arolax_show_meta' => 'yes',
				],
			]
		);

		$this->add_control(
			'blog_meta_color',
			[
				'label'     => esc_html__( 'Color', 'arolax-essential' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .post-meta' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'blog_meta_typo',
				'selector' => '{{WRAPPER}} .post-meta',
			]
		);

		$this->add_control(
			'separator_color',
			[
				'label'     => esc_html__( 'Separator Color', 'arolax-essential' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .post-meta span' => 'background-color: {{VALUE}}',
				],
                'condition' => [
                        'element_list!' => '4',
                ],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'meta_bg_color',
				'types'    => [ 'classic', 'gradient' ],
				'exclude'  => [ 'image' ],
				'selector' => '{{WRAPPER}} .jpost-cat, {{WRAPPER}} .pmeta, {{WRAPPER}} .name',
				'condition' => [
					'element_list' => '4',
				],
			]
		);

		$this->add_responsive_control(
			'meta_b_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'arolax-essential' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .jpost-cat, {{WRAPPER}} .pmeta, {{WRAPPER}} .name' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'element_list' => '4',
				],
			]
		);

		$this->add_responsive_control(
			'blog_meta_padding',
			[
				'label'      => esc_html__( 'Padding', 'arolax-essential' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .jpost-cat, {{WRAPPER}} .pmeta, {{WRAPPER}} .name' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'element_list' => '4',
				],
			]
		);

		$this->start_controls_tabs(
			'meta_style_tabs'
		);

		// Normal Tab
		$this->start_controls_tab(
			'meta_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'arolax-essential' ),
				'condition' => [
					'element_list' => '4',
				],
			]
		);

		$this->add_control(
			'meta_cat_color',
			[
				'label'     => esc_html__( 'Color', 'arolax-essential' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jpost-cat, {{WRAPPER}} .pmeta, {{WRAPPER}} .name' => 'color: {{VALUE}}',
				],
				'condition' => [
					'element_list' => '4',
				],
			]
		);

		$this->end_controls_tab();

		// Hover Tab
		$this->start_controls_tab(
			'meta_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'arolax-essential' ),
				'condition' => [
					'element_list' => '4',
				],
			]
		);

		$this->add_control(
			'blog_meta_h_color',
			[
				'label'     => esc_html__( 'Color', 'arolax-essential' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jpost-cat:hover, {{WRAPPER}} .pmeta:hover, {{WRAPPER}} .name:hover' => 'color: {{VALUE}}',
				],
				'condition' => [
					'element_list' => '4',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'meta_h_bg_color',
				'types'    => [ 'classic', 'gradient' ],
				'exclude'  => [ 'image' ],
				'selector' => '{{WRAPPER}} .jpost-cat:hover, {{WRAPPER}} .pmeta:hover, {{WRAPPER}} .name:hover',
				'condition' => [
					'element_list' => '4',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();






		$this->add_responsive_control(
			'blog_meta_margin',
			[
				'label'      => esc_html__( 'Margin', 'arolax-essential' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .post-meta' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Author
		$this->start_controls_section(
			'sec_style_author',
			[
				'label'     => esc_html__( 'Author', 'arolax-essential' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'arolax_show_author' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'blog_author_width',
			[
				'label'      => esc_html__( 'Width', 'arolax-essential' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 1,
						'max'  => 400,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .author-wrap' => 'flex-basis: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'element_list' => '2',
				],
			]
		);

		// Image
		$this->add_control(
			'blog_author_img_heading',
			[
				'label'     => esc_html__( 'Image', 'arolax-essential' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'element_list' => '2',
				],
			]
		);

		$this->add_responsive_control(
			'blog_author_img_size',
			[
				'label'      => esc_html__( 'Size', 'arolax-essential' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .author-img img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'element_list' => '2',
				],
			]
		);

		$this->add_responsive_control(
			'blog_author_img_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'arolax-essential' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .author-img img' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'element_list' => '2',
				],
			]
		);

		// Text
		$this->add_control(
			'blog_author_text_heading',
			[
				'label'     => esc_html__( 'Text', 'arolax-essential' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'element_list' => '2',
				],
			]
		);

		$this->add_control(
			'blog_author_text_color',
			[
				'label'     => esc_html__( 'Color', 'arolax-essential' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .author h4' => 'color: {{VALUE}}',
				],
				'condition' => [
					'element_list' => '2',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'blog_author_text_typo',
				'selector'  => '{{WRAPPER}} .author h4',
				'condition' => [
					'element_list' => '2',
				],
			]
		);

		$this->add_responsive_control(
			'blog_author_text_margin',
			[
				'label'      => esc_html__( 'Spacing', 'arolax-essential' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .author h4' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'element_list' => '2',
				],
			]
		);

		$this->add_control(
			'author_name_heading',
			[
				'label'     => esc_html__( 'Name', 'arolax-essential' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'element_list' => '2',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'author_name_typo',
				'selector' => '{{WRAPPER}} .name',
			]
		);

		$this->start_controls_tabs(
			'author_name_tabs'
		);

		$this->start_controls_tab(
			'author_name_normal',
			[
				'label' => esc_html__( 'Normal', 'arolax-essential' ),
			]
		);

		$this->add_control(
			'author_name_color',
			[
				'label'     => esc_html__( 'Color', 'arolax-essential' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .name' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'author_name_hover',
			[
				'label' => esc_html__( 'Hover', 'arolax-essential' ),
			]
		);

		$this->add_control(
			'author_name_h_color',
			[
				'label'     => esc_html__( 'Color', 'arolax-essential' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .name:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		// Category
		$this->start_controls_section(
			'sec_style_category',
			[
				'label'     => esc_html__( 'Category', 'arolax-essential' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'arolax_show_category' => 'yes',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'blog_cat_typo',
				'selector' => '{{WRAPPER}} .jpost-cat',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'cat_bg_color',
				'types'    => [ 'classic', 'gradient' ],
				'exclude'  => [ 'image' ],
				'selector' => '{{WRAPPER}} .jpost-cat',
			]
		);

		$this->add_responsive_control(
			'cat_b_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'arolax-essential' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .jpost-cat' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'blog_cat_padding',
			[
				'label'      => esc_html__( 'Padding', 'arolax-essential' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .jpost-cat' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs(
			'cat_style_tabs'
		);

		// Normal Tab
		$this->start_controls_tab(
			'cat_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'arolax-essential' ),
			]
		);

		$this->add_control(
			'blog_cat_color',
			[
				'label'     => esc_html__( 'Color', 'arolax-essential' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jpost-cat' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		// Hover Tab
		$this->start_controls_tab(
			'cat_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'arolax-essential' ),
			]
		);

		$this->add_control(
			'blog_cat_h_color',
			[
				'label'     => esc_html__( 'Color', 'arolax-essential' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jpost-cat:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'cat_h_bg_color',
				'types'    => [ 'classic', 'gradient' ],
				'exclude'  => [ 'image' ],
				'selector' => '{{WRAPPER}} .jpost-cat:hover',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		// Read More
		$this->start_controls_section(
			'style_read_more',
			[
				'label'     => esc_html__( 'Read More', 'arolax-essential' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'arolax_show_rm' => 'yes',
					'element_list'   => ['2', '4'],
				],
			]
		);

		$this->add_control(
			'btn_style',
			[
				'label'   => esc_html__( 'Style', 'arolax-essential' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '1',
				'options' => [
					'1' => esc_html__( '1', 'arolax-essential' ),
					'2' => esc_html__( '2', 'arolax-essential' ),
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
					'{{WRAPPER}} .wc-btn-play'                                             => '--icon-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'btn_text_typo',
				'selector' => '{{WRAPPER}} .wc-btn-primary, {{WRAPPER}} .btn-border-crop',
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

		$this->add_responsive_control(
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
					'{{WRAPPER}} .wc-btn-primary' => 'color: {{VALUE}}; fill: {{VALUE}}',
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
					'{{WRAPPER}} .wc-btn-primary:hover' => 'color: {{VALUE}}; fill: {{VALUE}}',
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

		// Icon Style
		$this->add_control(
			'btn_heading',
			[
				'label'     => esc_html__( 'Icon', 'arolax-essential' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
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

		// Link Icon
		$this->start_controls_section(
			'sec_style_icon',
			[
				'label'     => esc_html__( 'Link Icon', 'arolax-essential' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'arolax_show_link' => 'yes',
					'element_list'     => [ '1', '3' ],
				],
			]
		);

		$this->add_control(
			'blog_icon_color',
			[
				'label'     => esc_html__( 'Color', 'arolax-essential' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .link' => 'color: {{VALUE}}; fill: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'blog_icon_size',
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
					'{{WRAPPER}} .link' => 'font-size: {{SIZE}}{{UNIT}}; min-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Number Style
		$this->start_controls_section(
			'sec_style_number',
			[
				'label'     => esc_html__( 'Number', 'arolax-essential' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'element_list' => '1',
				],
			]
		);

		$this->add_control(
			'blog_num_color',
			[
				'label'     => esc_html__( 'Color', 'arolax-essential' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .number' => 'color: {{VALUE}}; fill: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'number_typo',
				'selector' => '{{WRAPPER}} .number',
			]
		);

		$this->end_controls_section();
	}

	protected function register_controls() {
		$this->register_content_controls();
		$this->register_style_controls();
		$this->register_pagination_section_controls();
	}

	public function register_pagination_section_controls() {
		$this->start_controls_section(
			'section_pagination',
			[
				'label' => esc_html__( 'Pagination', 'arolax-essential' ),
			]
		);

		$this->add_control(
			'pagination_type',
			[
				'label'   => esc_html__( 'Pagination', 'arolax-essential' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					''                      => esc_html__( 'None', 'arolax-essential' ),
					'numbers_and_prev_next' => esc_html__( 'Numbers', 'arolax-essential' ) . ' + ' . esc_html__( 'Previous/Next', 'arolax-essential' ),
				],
			]
		);

		$this->add_control(
			'pagination_page_limit',
			[
				'label'     => esc_html__( 'Page Limit', 'arolax-essential' ),
				'default'   => '5',
				'condition' => [
					'pagination_type' => 'numbers_and_prev_next',
				],
			]
		);

		$this->add_control(
			'pagination_numbers_shorten',
			[
				'label'     => esc_html__( 'Shorten', 'arolax-essential' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => '',
				'condition' => [
					'pagination_type' => 'numbers_and_prev_next',
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
				'condition'        => [
					'pagination_type' => [
						'numbers',
						'numbers_and_prev_next',
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
				'condition'        => [
					'pagination_type' => [
						'numbers',
						'numbers_and_prev_next',
					],
				],
			]
		);

		$this->add_control(
			'pagination_align',
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
				'default'   => 'center',
				'selectors' => [
					'{{WRAPPER}} .post-pagination' => 'justify-content: {{VALUE}};',
				],
				'condition' => [
					'pagination_type!' => '',
				],
			]
		);

		$this->add_responsive_control(
			'pagination_spacing_top',
			[
				'label'      => esc_html__( 'Spacing', 'arolax-essential' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem', 'custom' ],
				'default'    => [
					'size' => 70,
				],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .post-pagination' => 'margin-top: {{SIZE}}{{UNIT}}',
				],
				'condition'  => [
					'pagination_type!' => '',
				],
			]
		);

		$this->end_controls_section();

		// Pagination style controls for prev/next and numbers pagination.
		$this->start_controls_section(
			'section_pagination_style',
			[
				'label'     => esc_html__( 'Pagination', 'arolax-essential' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'pagination_type' => 'numbers_and_prev_next',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'pagination_typography',
				'selector' => '{{WRAPPER}} .post-pagination .page-numbers',
			]
		);

		$this->add_control(
			'pagination_color_heading',
			[
				'label'     => esc_html__( 'Colors', 'arolax-essential' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->start_controls_tabs( 'pagination_colors' );

		$this->start_controls_tab(
			'pagination_color_normal',
			[
				'label' => esc_html__( 'Normal', 'arolax-essential' ),
			]
		);

		$this->add_control(
			'pagination_color',
			[
				'label'     => esc_html__( 'Color', 'arolax-essential' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .post-pagination .page-numbers' => 'color: {{VALUE}}; fill: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'pagination_color_hover',
			[
				'label' => esc_html__( 'Hover', 'arolax-essential' ),
			]
		);

		$this->add_control(
			'pagination_hover_color',
			[
				'label'     => esc_html__( 'Color', 'arolax-essential' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .post-pagination .page-numbers:not(.dots):hover, {{WRAPPER}} .post-pagination .page-numbers.current' => 'color: {{VALUE}}; fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'pagination_hover_bg_color',
			[
				'label'     => esc_html__( 'Background Color', 'arolax-essential' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .post-pagination .page-numbers.current, {{WRAPPER}} .post-pagination .page-numbers:not(.prev, .next, .dots):hover' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'pagination_list' => '2',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'pagination_spacing',
			[
				'label'      => esc_html__( 'Space Between', 'arolax-essential' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem', 'custom' ],
				'separator'  => 'before',
				'default'    => [
					'size' => 10,
				],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .post-pagination' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function query_arg() {
		$query_args = [];

		//related post
		if ( 'related' === $this->get_settings( 'query_type' ) && is_singular() ) {
			$post_id         = get_queried_object_id();
			$related_post_id = is_singular() && ( 0 !== $post_id ) ? $post_id : null;

			$taxonomies    = get_object_taxonomies( get_post_type( $related_post_id ) );
			$tax_query_arg = [];

			foreach ( $taxonomies as $taxonomy ) {

				$terms = get_the_terms( $post_id, $taxonomy );

				if ( empty( $terms ) ) {
					continue;
				}

				$term_list = wp_list_pluck( $terms, 'slug' );


				if ( ! empty( $tax_query_arg ) && empty( $tax_query_arg['relation'] ) ) {
					$tax_query_arg['relation'] = 'OR';
				}

				$tax_query_arg[] = [
					'taxonomy' => $taxonomy,
					'field'    => 'slug',
					'terms'    => $term_list
				];
			}

			$query_args['post_type']      = get_post_type( $related_post_id );
			$query_args['posts_per_page'] = $this->get_settings( 'arolax_posts_ppage' );
			$query_args['post__not_in']   = [ $related_post_id ];
			$query_args['orderby']        = 'rand';

			if ( ! empty( $tax_query_arg ) ) { //backward compatibility if post has no taxonomies
				$query_args['tax_query'] = $tax_query_arg;
			}

			return $query_args;
		}

		$query_args = [
			'post_type'      => 'post',
			'posts_per_page' => $this->get_settings( 'arolax_posts_ppage' ),
			'paged'          => $this->get_current_page(),
			'order'          => $this->get_settings( 'arolax_post_order' ),
			'orderby'        => $this->get_settings( 'arolax_post_order_by' ),
			'post__in'       => $this->get_settings( 'posts_id' ),
		];

		return $query_args;
	}

	public function get_query() {
		global $wp_query;

		if ( 'archive' === $this->get_settings( 'query_type' ) && ! \Elementor\Plugin::$instance->editor->is_edit_mode() && ( $wp_query->is_archive || $wp_query->is_search ) ) {

			return $this->query = $wp_query;
		} else {
			return $this->query = new WP_Query( $this->query_arg() );
		}
	}

	public function get_current_page() {
		if ( '' === $this->get_settings_for_display( 'pagination_type' ) ) {
			return 1;
		}

		return max( 1, get_query_var( 'paged' ), get_query_var( 'page' ) );
	}

	public function get_all_posts() {
		$posts = [];

		foreach ( get_posts() as $post ) {

			$posts[ $post->ID ] = esc_html( $post->post_title );
		}

		return $posts;
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$arolax_query = $this->get_query();

		?>
        <div class="arolax--post post-style-<?php echo $settings['element_list']; ?>">
			<?php
			$post_count = 1;
			while ( $arolax_query->have_posts() ) {
				$arolax_query->the_post();

				if ( '1' === $settings['element_list'] ) {
					$this->render_post_1( $settings, $post_count );
					$post_count ++;
				} elseif ( '2' === $settings['element_list'] ) {
					$this->render_post_2( $settings );
				} elseif ( '3' === $settings['element_list'] ) {
					$this->render_post_3( $settings );
				} elseif ( '4' === $settings['element_list'] ) {
					$this->render_post_4( $settings );
				} else {
					$this->render_post_5( $settings );
				}
			}
			?>
        </div>
		<?php
		$this->render_pagination( $arolax_query );
		wp_reset_postdata();
	}

	protected function render_pagination( $query ) {

		$settings = $this->get_settings_for_display();

		if ( '' === $settings['pagination_type'] ) {
			return;
		}

		$page_limit = $query->max_num_pages;

		// Page limit control should not effect in load more mode.
		if ( '' !== $settings['pagination_page_limit'] && 'load_more' !== $settings['pagination_type'] ) {
			$page_limit = min( $settings['pagination_page_limit'], $page_limit );
		}

		if ( 2 > $page_limit ) {
			return;
		}

		//number and prev next
		if ( 'numbers_and_prev_next' === $settings['pagination_type'] ) {
			$paginate_args = [
				'current'            => $this->get_current_page(),
				'total'              => $page_limit,
				'prev_next'          => true,
				'prev_text'          => sprintf( '%1$s', $this->render_next_prev_button( 'prev' ) ),
				'next_text'          => sprintf( '%1$s', $this->render_next_prev_button( 'next' ) ),
				'show_all'           => 'yes' !== $settings['pagination_numbers_shorten'],
				'before_page_number' => '<span class="elementor-screen-only">' . esc_html__( 'Page', 'arolax-essential' ) . '</span>',
			];

			//pagination class
			$this->add_render_attribute( 'pagination', 'class', 'post-pagination' );
			?>
            <nav <?php $this->print_render_attribute_string( 'pagination' ); ?>
                    aria-label="<?php esc_attr_e( 'Pagination', 'arolax-essential' ); ?>" style="display: flex">
				<?php echo wp_kses_post( paginate_links( $paginate_args ) ); ?>
            </nav>
			<?php
		}
	}

	private function render_next_prev_button( $type ) {
		$direction     = 'next' === $type ? 'right' : 'left';
		$icon_settings = $this->get_settings( 'navigation_' . $type . '_icon' );

		if ( empty( $icon_settings['value'] ) ) {
			$icon_settings = [
				'library' => 'eicons',
				'value'   => 'eicon-chevron-' . $direction,
			];
		}

		if ( 'next' === $type ) {
			return esc_html( $type ) . ' ' . Icons_Manager::try_get_icon_html( $icon_settings, [ 'aria-hidden' => 'true' ] );
		} else {
			return Icons_Manager::try_get_icon_html( $icon_settings, [ 'aria-hidden' => 'true' ] ) . ' ' . esc_html( $type );
		}
	}

	private function render_post_1( $settings, $post_count ) {
		?>
        <article <?php post_class( 'item' ); ?>>
			<?php
			if ( 'yes' === $settings['arolax_show_thumb'] ) {
				?>
                <div class="thumb">
					<?php if ( has_post_thumbnail() ): ?>
                        <a href="<?php the_permalink(); ?>"><img
                                    src="<?php echo get_the_post_thumbnail_url(); ?>"
                                    alt="<?php the_title_attribute(); ?>"></a>
					<?php endif; ?>
                </div>
				<?php
			}
			?>

            <div class="wrapper">
                <div class="number"><?php if ( $post_count < 9 ) {
						echo esc_html__('0', 'arolax-essential');
					}
					echo $post_count; ?></div>
                <div class="content">
					<?php
					$post_meta = [];
					$category  = arolax_get_random_category();

					if ( 'yes' === $settings['arolax_show_author'] ) {
						$get_author  = get_the_author();
						$_posts_url  = esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) );
						$post_meta[] = "<a class='name' href='{$_posts_url}'>&nbsp;{$get_author}</a>";
					}

					if ( 'yes' === $settings['arolax_show_category'] ) {
						$post_meta[] = $category;
					}

					if ( 'yes' === $settings['arolax_show_date'] ) {
						$post_meta[] = get_the_date( get_option( 'date_format' ) );
					}

					if ( 'yes' === $settings['arolax_show_comment'] ) {
						$comments_number = get_comments_number();
						$post_meta[]     = $comments_number > 1 ? sprintf( esc_html__( '%s comments', 'arolax' ), $comments_number ) : sprintf( esc_html__( '%s comment', 'arolax' ), $comments_number );
					}
					?>
					<?php if ( 'yes' === $settings['arolax_show_meta'] ) { ?>
                        <div class="post-meta">
							<?php
							echo arolax_kses( implode( '<span></span>', $post_meta ) );
							?>
                        </div>
					<?php } ?>

					<?php
					if ( 'yes' === $settings['arolax_show_title'] ) {
						?>
                        <h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<?php
					}

					if ( 'yes' === $settings['arolax_show_excerpt'] ) {
						?>
                        <div class="cf_text">
							<?php arolax_excerpt( 40, null ); ?>
                        </div>
						<?php
					}
					?>
                </div>
				<?php
				if ( 'yes' === $settings['arolax_show_link'] ) {
					?>
                    <div class="link-wrap">
                        <a href="<?php the_permalink(); ?>" class="link" aria-label="<?php the_title(); ?>">
							<?php Icons_Manager::render_icon( $settings['link_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                        </a>
                    </div>
					<?php
				}
				?>
            </div>
        </article>
		<?php
	}

	private function render_post_2( $settings ) {
		?>
        <article <?php post_class( 'item' ); ?>>
            <div class="wrapper">
				<?php
				if ( 'yes' === $settings['arolax_show_author'] ) {
					?>
                    <div class="author-wrap">
                        <div class="author">
                            <div class="author-img">
								<?php echo wp_kses_post( get_avatar( get_the_author_meta( 'ID' ), 60 ) ); ?>
                            </div>
                            <div class="author-bio">
                                <a class="name"
                                   href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php the_author(); ?></a>
                                <h4><?php if ( ! empty( $settings['author_text'] ) ) {
										echo esc_html( $settings['author_text'] );
									} ?></h4>
                            </div>
                        </div>
                    </div>
					<?php
				}
				?>
                <div class="content">
					<?php
					if ( 'yes' === $settings['arolax_show_thumb'] ) {
						?>
                        <div class="thumb">
							<?php if ( has_post_thumbnail() ): ?>
                                <a href="<?php the_permalink(); ?>"><img
                                            src="<?php echo get_the_post_thumbnail_url(); ?>"
                                            alt="<?php the_title_attribute(); ?>"></a>
							<?php endif; ?>
                        </div>
						<?php
					}
					?>
					<?php
					$post_meta = [];
					$category  = arolax_get_random_category();

					if ( 'yes' === $settings['arolax_show_category'] ) {
						$post_meta[] = $category;
					}

					if ( 'yes' === $settings['arolax_show_date'] ) {
						$post_meta[] = get_the_date( get_option( 'date_format' ) );
					}

					if ( 'yes' === $settings['arolax_show_comment'] ) {
						$comments_number = get_comments_number();
						$post_meta[]     = $comments_number > 1 ? sprintf( esc_html__( '%s comments', 'arolax' ), $comments_number ) : sprintf( esc_html__( '%s comment', 'arolax' ), $comments_number );
					}
					?>
					<?php if ( 'yes' === $settings['arolax_show_meta'] ) { ?>
                        <div class="post-meta">
							<?php
							echo arolax_kses( implode( '<span></span>', $post_meta ) );
							?>
                        </div>
					<?php } ?>

					<?php
					if ( 'yes' === $settings['arolax_show_title'] ) {
						?>
                        <h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<?php
					}

					if ( 'yes' === $settings['arolax_show_excerpt'] ) {
						?>
                        <div class="cf_text">
							<?php arolax_excerpt( 40, null ); ?>
                        </div>
						<?php
					}
					?>

					<?php
					if ( 'yes' === $settings['arolax_show_rm'] ) {
						?>
                        <div class="wc-btn-wrapper style-<?php echo esc_html( $settings['btn_style'] ); ?>">
                            <a href="<?php the_permalink(); ?>" class="wc-btn-group">
                                <span class="wc-btn-play">
                                    <?php Icons_Manager::render_icon( $settings['btn_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                </span>
                                <span class="wc-btn-primary">
                                    <div class="screen-reader-text"><?php echo esc_html__('Read Post Details', 'arolax-essential'); ?></div>
                                    <?php echo esc_html( $settings['btn_text'] ); ?>
                                </span>
                                <span class="wc-btn-play">
                                    <?php Icons_Manager::render_icon( $settings['btn_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                </span>
                            </a>
                        </div>
						<?php
					}
					?>
                </div>
            </div>
        </article>
		<?php
	}

	private function render_post_3( $settings ) {
		?>
        <article <?php post_class( 'item' ); ?>>
			<?php
			if ( 'yes' === $settings['arolax_show_thumb'] ) {
				?>
                <div class="thumb">
					<?php if ( has_post_thumbnail() ): ?>
                        <a href="<?php the_permalink(); ?>"><img
                                    src="<?php echo get_the_post_thumbnail_url(); ?>"
                                    alt="<?php the_title_attribute(); ?>"></a>
					<?php endif; ?>
                </div>
				<?php
			}
			?>

            <div class="wrapper">
                <div class="content">
					<?php
					$post_meta = [];
					$category  = arolax_get_random_category();

					if ( 'yes' === $settings['arolax_show_category'] ) {
						?>
                        <div class="cat-wrap"><?php echo $category; ?></div>
						<?php
					}

					if ( 'yes' === $settings['arolax_show_author'] ) {
						$get_author  = get_the_author();
						$_posts_url  = esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) );
						$post_meta[] = "<a class='name' href='{$_posts_url}'>&nbsp;{$get_author}</a>";
					}

					if ( 'yes' === $settings['arolax_show_date'] ) {
						$post_meta[] = get_the_date( get_option( 'date_format' ) );
					}

					if ( 'yes' === $settings['arolax_show_comment'] ) {
						$comments_number = get_comments_number();
						$post_meta[]     = $comments_number > 1 ? sprintf( esc_html__( '%s comments', 'arolax' ), $comments_number ) : sprintf( esc_html__( '%s comment', 'arolax' ), $comments_number );
					}
					?>
					<?php if ( 'yes' === $settings['arolax_show_meta'] ) { ?>
                        <div class="post-meta">
							<?php
							echo arolax_kses( implode( '<span></span>', $post_meta ) );
							?>
                        </div>
					<?php } ?>

					<?php
					if ( 'yes' === $settings['arolax_show_title'] ) {
						?>
                        <h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<?php
					}

					if ( 'yes' === $settings['arolax_show_excerpt'] ) {
						?>
                        <div class="cf_text">
							<?php arolax_excerpt( 40, null ); ?>
                        </div>
						<?php
					}
					?>
                </div>
				<?php
				if ( 'yes' === $settings['arolax_show_link'] ) {
					?>
                    <div class="link-wrap">
                        <a href="<?php the_permalink(); ?>" class="link">
							<?php Icons_Manager::render_icon( $settings['link_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                        </a>
                    </div>
					<?php
				}
				?>
            </div>
        </article>
		<?php
	}

	private function render_post_4( $settings ) {
		?>
        <article <?php post_class( 'item' ); ?>>
			<?php
			if ( 'yes' === $settings['arolax_show_thumb'] ) {
				?>
                <div class="thumb">
					<?php if ( has_post_thumbnail() ): ?>
                        <a href="<?php the_permalink(); ?>"><img
                                    src="<?php echo get_the_post_thumbnail_url(); ?>"
                                    alt="<?php the_title_attribute(); ?>"></a>
					<?php endif; ?>
                </div>
				<?php
			}
			?>

            <div class="wrapper">
                <div class="content">
	                <?php
	                $post_meta = [];
	                $category  = arolax_get_random_category();

	                if ( 'yes' === $settings['arolax_show_category'] ) {
		                $post_meta[] = $category;
	                }

	                if ( 'yes' === $settings['arolax_show_author'] ) {
		                $get_author  = get_the_author();
		                $_posts_url  = esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) );
		                $post_meta[] = "<a class='name' href='{$_posts_url}'>&nbsp;{$get_author}</a>";
	                }

	                if ( 'yes' === $settings['arolax_show_date'] ) {
//		                $post_meta[] = get_the_date( get_option( 'date_format' ) );
		                $post_meta[] = "<div class='pmeta'>". get_the_date( get_option( 'date_format' ) ) ."</div>";
	                }

	                if ( 'yes' === $settings['arolax_show_comment'] ) {
		                $comments_number = get_comments_number();
		                $post_meta[]     = $comments_number > 1 ? sprintf( "<div class='pmeta'>" . esc_html__( '%s comments', 'arolax' ), $comments_number ) ."</div>" : sprintf( "<div class='pmeta'>" . esc_html__( '%s comment', 'arolax' ), $comments_number ) ."</div>";
	                }
	                ?>
	                <?php if ( 'yes' === $settings['arolax_show_meta'] ) { ?>
                        <div class="post-meta">
			                <?php
			                echo arolax_kses( implode( '<span></span>', $post_meta ) );
			                ?>
                        </div>
	                <?php } ?>

					<?php
					if ( 'yes' === $settings['arolax_show_title'] ) {
						?>
                        <h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<?php
					}

					if ( 'yes' === $settings['arolax_show_excerpt'] ) {
						?>
                        <div class="cf_text">
							<?php arolax_excerpt( 40, null ); ?>
                        </div>
						<?php
					}

					if ( 'yes' === $settings['arolax_show_rm'] ) {
						?>
                        <div class="wc-btn-wrapper style-<?php echo esc_html( $settings['btn_style'] ); ?>">
                            <a href="<?php the_permalink(); ?>" class="wc-btn-group">
                                <span class="wc-btn-play">
                                    <?php Icons_Manager::render_icon( $settings['btn_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                </span>
                                <span class="wc-btn-primary">
                                    <div class="screen-reader-text"><?php echo esc_html__('Read Post Details', 'arolax-essential'); ?></div>
                                    <?php echo esc_html( $settings['btn_text'] ); ?>
                                </span>
                                <span class="wc-btn-play">
                                    <?php Icons_Manager::render_icon( $settings['btn_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                </span>
                            </a>
                        </div>
						<?php
					}
					?>
                </div>
            </div>
        </article>
		<?php
	}

	private function render_post_5( $settings ) {
		?>
        <article <?php post_class( 'item' ); ?>>
			<?php
			if ( 'yes' === $settings['arolax_show_thumb'] ) {
				?>
                <div class="thumb">
					<?php if ( has_post_thumbnail() ): ?>
                        <a href="<?php the_permalink(); ?>"><img
                                    src="<?php echo get_the_post_thumbnail_url(); ?>"
                                    alt="<?php the_title_attribute(); ?>"></a>
					<?php endif; ?>
                </div>
				<?php
			}
			?>

            <div class="wrapper">
                <div class="content">
					<?php
					$post_meta = [];
					$category  = arolax_get_random_category();

					if ( 'yes' === $settings['arolax_show_category'] ) {
						$post_meta[] = $category;
					}

					if ( 'yes' === $settings['arolax_show_author'] ) {
						$get_author  = get_the_author();
						$_posts_url  = esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) );
						$post_meta[] = "<a class='name' href='{$_posts_url}'>&nbsp;{$get_author}</a>";
					}

					if ( 'yes' === $settings['arolax_show_date'] ) {
//		                $post_meta[] = get_the_date( get_option( 'date_format' ) );
						$post_meta[] = "<div class='pmeta'>". get_the_date( get_option( 'date_format' ) ) ."</div>";
					}

					if ( 'yes' === $settings['arolax_show_comment'] ) {
						$comments_number = get_comments_number();
						$post_meta[]     = $comments_number > 1 ? sprintf( "<div class='pmeta'>" . esc_html__( '%s comments', 'arolax' ), $comments_number ) ."</div>" : sprintf( "<div class='pmeta'>" . esc_html__( '%s comment', 'arolax' ), $comments_number ) ."</div>";
					}
					?>
					<?php if ( 'yes' === $settings['arolax_show_meta'] ) { ?>
                        <div class="post-meta">
							<?php
							echo arolax_kses( implode( '<span></span>', $post_meta ) );
							?>
                        </div>
					<?php } ?>

					<?php
					if ( 'yes' === $settings['arolax_show_title'] ) {
						?>
                        <h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<?php
					}

					if ( 'yes' === $settings['arolax_show_excerpt'] ) {
						?>
                        <div class="cf_text">
							<?php arolax_excerpt( 40, null ); ?>
                        </div>
						<?php
					}

					if ( 'yes' === $settings['arolax_show_rm'] ) {
						?>
                        <div class="wc-btn-wrapper style-<?php echo esc_html( $settings['btn_style'] ); ?>">
                            <a href="<?php the_permalink(); ?>" class="wc-btn-group">
                                <span class="wc-btn-play">
                                    <?php Icons_Manager::render_icon( $settings['btn_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                </span>
                                <span class="wc-btn-primary">
                                    <div class="screen-reader-text"><?php echo esc_html__('Read Post Details', 'arolax-essential'); ?></div>
                                    <?php echo esc_html( $settings['btn_text'] ); ?>
                                </span>
                                <span class="wc-btn-play">
                                    <?php Icons_Manager::render_icon( $settings['btn_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                </span>
                            </a>
                        </div>
						<?php
					}
					?>
                </div>
            </div>
        </article>
		<?php
	}
}
