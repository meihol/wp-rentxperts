<?php

namespace ArolaxEssentialApp\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Utils;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Widget_Base;
use Elementor\Icons_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit;   // Exit if accessed directly.
}

class Arolax_Gallery extends Widget_Base {

	public function get_name() {
		return 'arolax--gallery';
	}

	public function get_title() {
		return esc_html__( 'Arolax Gallery', 'arolax-essential' );
	}

	public function get_icon() {
		return 'wcf eicon-gallery-grid';
	}

	public function get_categories() {
		return [ 'weal-coder-addon' ];
	}

	public function get_style_depends() {
		wp_register_style( 'arolax-gallery', AROLAX_ESSENTIAL_ASSETS_URL . 'css/arolax-gallery.css' );

		return [ 'arolax-gallery' ];
	}

	public function get_script_depends() {
		wp_register_script( 'arolax-gallery', AROLAX_ESSENTIAL_ASSETS_URL . '/js/widgets/arolax-gallery.js', [ 'jquery' ], false, true );

		return [ 'arolax-gallery' ];
	}

	// Controls
	protected function register_controls() {
		$this->start_controls_section(
			'sec_gallery',
			[
				'label' => __( 'Gallery', 'arolax-essential' ),
			]
		);

		$this->add_control(
			'gallery_title',
			[
				'label'       => esc_html__( 'Title', 'arolax-essential' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Case Study', 'arolax-essential' ),
				'label_block' => true,
				'dynamic'     => [
					'active' => true,
				],
			]
		);

		$this->add_control(
			'gallery_title_url',
			[
				'label'       => esc_html__( 'Title URL', 'arolax-essential' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => __( 'https://rentexpert.com', 'arolax-essential' ),
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => false,
					'nofollow' => false,
				],
				'condition' => [
					'gallery_title!' => '',
				],
			]
		);

		$this->add_control(
			'g_title_tag',
			[
				'label'   => esc_html__( 'HTML Tag', 'arolax-essential' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
				],
				'default' => 'h2',
			]
		);

		$this->end_controls_section();

		$this->gallery_slider_one_controls();

		$this->gallery_slider_two_controls();

		$this->register_style_controls();
	}

    // Gallery Slider One
	protected function gallery_slider_one_controls() {
		$this->start_controls_section(
			'sec_g_slider',
			[
				'label' => __( 'Gallery Slider One', 'arolax-essential' ),
			]
		);

		$g_slider = new Repeater();

		$g_slider->add_control(
			'gs_source',
			[
				'label'   => esc_html__( 'Type', 'arolax-essential' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'image',
				'options' => [
					'image' => esc_html__( 'Image', 'arolax-essential' ),
					'video' => esc_html__( 'Video', 'arolax-essential' ),
				],
			]
		);

		$g_slider->add_control(
			'gs_image',
			[
				'label'   => esc_html__( 'Choose Image', 'arolax-essential' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition'   => [
					'gs_source' => 'image',
				],
			]
		);

		$g_slider->add_control(
			'gs_video',
			[
				'label'       => esc_html__( 'Video Link', 'arolax-essential' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => 'https://crowdytheme.com/assets/wp-content/uploads/2024/05/insurance-video.mp4',
				'condition'   => [
					'gs_source' => 'video',
				],
				'ai'          => [
					'active' => false,
				],
			]
		);

		$g_slider->add_control(
			'gs_title',
			[
				'label'       => esc_html__( 'Title', 'arolax-essential' ),
				'type'        => Controls_Manager::TEXT,
				'default' => __( 'Mastartery', 'arolax-essential' ),
				'label_block' => true,
				'dynamic'     => [
					'active' => true,
				],
			]
		);

		$g_slider->add_control(
			'gs_text',
			[
				'label'       => esc_html__( 'Text', 'arolax-essential' ),
				'type'        => Controls_Manager::TEXT,
				'default' => __( 'Design - 2019', 'arolax-essential' ),
				'label_block' => true,
				'dynamic'     => [
					'active' => true,
				],
			]
		);

		$g_slider->add_control(
			'gs_link',
			[
				'label' => esc_html__( 'Link', 'arolax-essential' ),
				'type' => Controls_Manager::URL,
				'options' => [ 'url', 'is_external', 'nofollow' ],
				'default' => [
					'url' => '#',
					'is_external' => true,
					'nofollow' => true,
				],
				'label_block' => true,
			]
		);

		$this->add_control(
			'gs_items',
			[
				'label'       => esc_html__( 'Gallery Slider Items', 'arolax-essential' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $g_slider->get_controls(),
				'default'     => [	[], [], [], []	],
				'title_field' => '{{{ gs_title }}}',
			]
		);

		$this->add_control(
			'gs_title_tag',
			[
				'label'   => esc_html__( 'Title HTML Tag', 'arolax-essential' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'h1'   => 'H1',
					'h2'   => 'H2',
					'h3'   => 'H3',
					'h4'   => 'H4',
					'h5'   => 'H5',
					'h6'   => 'H6',
				],
				'default' => 'h2',
			]
		);

		$this->add_control(
			'gs_icon',
			[
				'label'       => esc_html__( 'Icon', 'arolax-essential' ),
				'type'        => Controls_Manager::ICONS,
				'skin'        => 'inline',
				'default' => [
					'value' => 'fas fa-arrow-right',
					'library' => 'fa-regular',
				],
				'label_block' => false,
			]
		);

		$this->end_controls_section();
	}

	// Gallery Slider Two
	protected function gallery_slider_two_controls() {
		$this->start_controls_section(
			'sec_g_slider_2',
			[
				'label' => __( 'Gallery Slider Two', 'arolax-essential' ),
			]
		);

		$g_slider_2 = new Repeater();

		$g_slider_2->add_control(
			'gs_source_2',
			[
				'label'   => esc_html__( 'Type', 'arolax-essential' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'image',
				'options' => [
					'image' => esc_html__( 'Image', 'arolax-essential' ),
					'video' => esc_html__( 'Video', 'arolax-essential' ),
				],
			]
		);

		$g_slider_2->add_control(
			'gs_image_2',
			[
				'label'   => esc_html__( 'Choose Image', 'arolax-essential' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition'   => [
					'gs_source_2' => 'image',
				],
			]
		);

		$g_slider_2->add_control(
			'gs_video_2',
			[
				'label'       => esc_html__( 'Video Link', 'arolax-essential' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => 'https://crowdytheme.com/assets/wp-content/uploads/2024/05/insurance-video.mp4',
				'condition'   => [
					'gs_source_2' => 'video',
				],
				'ai'          => [
					'active' => false,
				],
			]
		);

		$g_slider_2->add_control(
			'gs_title_2',
			[
				'label'       => esc_html__( 'Title', 'arolax-essential' ),
				'type'        => Controls_Manager::TEXT,
				'default' => __( 'Mastartery', 'arolax-essential' ),
				'label_block' => true,
				'dynamic'     => [
					'active' => true,
				],
			]
		);

		$g_slider_2->add_control(
			'gs_text_2',
			[
				'label'       => esc_html__( 'Text', 'arolax-essential' ),
				'type'        => Controls_Manager::TEXT,
				'default' => __( 'Design - 2019', 'arolax-essential' ),
				'label_block' => true,
				'dynamic'     => [
					'active' => true,
				],
			]
		);

		$g_slider_2->add_control(
			'gs_link_2',
			[
				'label' => esc_html__( 'Link', 'arolax-essential' ),
				'type' => Controls_Manager::URL,
				'options' => [ 'url', 'is_external', 'nofollow' ],
				'default' => [
					'url' => '#',
					'is_external' => true,
					'nofollow' => true,
				],
				'label_block' => true,
			]
		);

		$this->add_control(
			'gs_items_2',
			[
				'label'       => esc_html__( 'Gallery Slider Items', 'arolax-essential' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $g_slider_2->get_controls(),
				'default'     => [	[], [], [], []	],
				'title_field' => '{{{ gs_title_2 }}}',
			]
		);

		$this->add_control(
			'gs_title2_tag',
			[
				'label'   => esc_html__( 'Title HTML Tag', 'arolax-essential' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'h1'   => 'H1',
					'h2'   => 'H2',
					'h3'   => 'H3',
					'h4'   => 'H4',
					'h5'   => 'H5',
					'h6'   => 'H6',
				],
				'default' => 'h2',
			]
		);

		$this->add_control(
			'gs_icon_2',
			[
				'label'       => esc_html__( 'Icon', 'arolax-essential' ),
				'type'        => Controls_Manager::ICONS,
				'skin'        => 'inline',
				'default' => [
					'value' => 'fas fa-arrow-right',
					'library' => 'fa-regular',
				],
				'label_block' => false,
			]
		);

		$this->end_controls_section();
	}

    // Style
	public function register_style_controls() {

		// Gallery Style
		$this->start_controls_section(
			'sec_style_item',
			[
				'label' => esc_html__( 'Gallery', 'arolax-essential' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'col_gap',
			[
				'label' => esc_html__( 'Column Gap', 'arolax-essential' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .g-slider--one, {{WRAPPER}} .g-slider--two' => 'column-gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'row_gap',
			[
				'label' => esc_html__( 'Row Gap', 'arolax-essential' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .g-slider--one, {{WRAPPER}} .g-slider--two' => 'row-gap: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .g-slider--one' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'item_padding',
			[
				'label' => esc_html__( 'Padding', 'arolax-essential' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .content-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'img_vdo_height',
			[
				'label' => esc_html__( 'Image/Video Height', 'arolax-essential' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'separator' => 'before',
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .source img, {{WRAPPER}} .source video' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Circle Style
		$this->start_controls_section(
			'sec_style_circle',
			[
				'label' => esc_html__( 'Circle', 'arolax-essential' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'circle_size',
			[
				'label' => esc_html__( 'Circle Size', 'arolax-essential' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .g-slider--title' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'circle_bg',
			[
				'label' => esc_html__( 'Background', 'arolax-essential' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .g-slider--title' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .progress-circle' => '--bg-color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'progress_size',
			[
				'label' => esc_html__( 'Progress Size', 'arolax-essential' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .progress-circle' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'progress_color',
			[
				'label' => esc_html__( 'Color', 'arolax-essential' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .progress-circle' => '--fg: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'p_text_heading',
			[
				'label' => esc_html__( 'Text', 'arolax-essential' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'p_text_color',
			[
				'label' => esc_html__( 'Color', 'arolax-essential' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .g-title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'p_text_typo',
				'selector' => '{{WRAPPER}} .g-title',
			]
		);

		$this->add_control(
			'p_num_heading',
			[
				'label' => esc_html__( 'Number', 'arolax-essential' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'num_color',
			[
				'label' => esc_html__( 'Color', 'arolax-essential' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .progress-circle' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'num_typo',
				'selector' => '{{WRAPPER}} .progress-circle',
			]
		);

		$this->end_controls_section();

		// Icon Style
		$this->start_controls_section(
			'sec_style_icon',
			[
				'label' => esc_html__( 'Icon', 'arolax-essential' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'arolax-essential' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .icon' => 'color: {{VALUE}}; fill: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'icon_size',
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
					'{{WRAPPER}} .icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'icon_border',
				'selector' => '{{WRAPPER}} .icon',
			]
		);

		$this->add_responsive_control(
			'icon_b_radius',
			[
				'label' => esc_html__( 'Border Radius', 'arolax-essential' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_padding',
			[
				'label' => esc_html__( 'Padding', 'arolax-essential' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Title Style
		$this->start_controls_section(
			'sec_style_title',
			[
				'label' => esc_html__( 'Title', 'arolax-essential' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Color', 'arolax-essential' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typo',
				'selector' => '{{WRAPPER}} .title',
			]
		);

		$this->add_responsive_control(
			'title_margin',
			[
				'label' => esc_html__( 'Margin', 'arolax-essential' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Text Style
		$this->start_controls_section(
			'sec_style_text',
			[
				'label' => esc_html__( 'Text', 'arolax-essential' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'desc_color',
			[
				'label' => esc_html__( 'Color', 'arolax-essential' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .desc' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'desc_typo',
				'selector' => '{{WRAPPER}} .desc',
			]
		);

		$this->end_controls_section();

		// Hover Style
		$this->start_controls_section(
			'sec_style_hover',
			[
				'label' => esc_html__( 'Hover', 'arolax-essential' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'item_h_bg',
				'types' => [ 'classic', 'gradient' ],
				'exclude' => ['image'],
				'selector' => '{{WRAPPER}} .item:hover .content-wrap',
			]
		);

		$this->add_responsive_control(
			'item_h_padding',
			[
				'label' => esc_html__( 'Padding', 'arolax-essential' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .content-wrap:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
        <div class="gallery--slider">
            <div class="g-slider--title">
				<?php if(($settings['gallery_title_url'])){ 
					$gallery_title_url = $settings['gallery_title_url']['url'] ?? '';
					$gallery_title_external = $settings['gallery_title_url']['is_external'] ? ' target="_blank"' : '';
					$gallery_nofollow = $settings['gallery_title_url']['nofollow'] ? ' rel="nofollow"' : '';
					?>
					<a href="<?php echo esc_url( $gallery_title_url ); ?>"<?php echo $gallery_title_external . $gallery_nofollow; ?>>
				<?php } ?>
					<div class="progress-circle" style="--value:0"></div>
					<<?php echo Utils::validate_html_tag( $settings['g_title_tag'] ); ?> class="g-title">
						<?php echo wp_kses_post( $settings['gallery_title'] ); ?>
					</<?php echo Utils::validate_html_tag( $settings['g_title_tag'] ); ?>>
				<?php if(($settings['gallery_title_url'])){ ?>
					</a>
				<?php } ?>
            </div>
        <div class="g-slider--one-wrap" dir="ltr">
            <div class="g-slider--one">
		        <?php
		        if ( $settings['gs_items'] ):
		        foreach (  $settings['gs_items'] as $index => $item ):
		        $gs_link = 'gs_link_' . $index;

		        if ( ! empty( $item['gs_link']['url'] ) ) {
			        $this->add_link_attributes( $gs_link, $item['gs_link'] );
		        }
		        ?>
                <a class="item" <?php $this->print_render_attribute_string( $gs_link ); ?>>
                    <div class="source">
				        <?php if ( 'image' === $item['gs_source'] ): ?>
                            <img src="<?php echo esc_url( $item['gs_image']['url'] ); ?>" alt="<?php echo esc_html( $item['gs_title'] ); ?>">
				        <?php else: ?>
                            <video muted autoplay loop>
                                <source src="<?php echo esc_url( $item['gs_video'] ); ?>" type="video/mp4">
                            </video>
				        <?php endif; ?>
                    </div>
                    <div class="content-wrap">
                        <div class="icon-wrap">
                            <div class="icon"><?php Icons_Manager::render_icon( $settings['gs_icon'], [ 'aria-hidden' => 'true' ] ); ?></div>
                        </div>
                        <div class="content">
                            <<?php echo Utils::validate_html_tag( $settings['gs_title_tag'] ); ?> class="title">
					        <?php echo esc_html( $item['gs_title'] ); ?>
                        </<?php echo Utils::validate_html_tag( $settings['gs_title_tag'] ); ?>>
                        <p class="desc"><?php echo esc_html( $item['gs_text'] ); ?></p>
                    </div>
            </div>
            </a>
	        <?php
	        endforeach;
	        endif;
	            ?>
            </div>
        </div>
        <div class="g-slider--two-wrap" dir="rtl">
            <div class="g-slider--two">
		        <?php
		        if ( $settings['gs_items_2'] ):
		        foreach (  $settings['gs_items_2'] as $index => $item ):
							
		        if ( ! empty( $item['gs_link_2']['url'] ) ) {
			        $this->add_link_attributes( 'link', $item['gs_link_2'] );
		        }
		        ?>
                <a class="item" <?php $this->print_render_attribute_string( 'link' ); ?>>
                    <div class="source">
				        <?php if ( 'image' === $item['gs_source_2'] ): ?>
                            <img src="<?php echo esc_url( $item['gs_image_2']['url'] ); ?>" alt="<?php echo esc_html( $item['gs_title_2'] ); ?>">
				        <?php else: ?>
                            <video muted autoplay loop>
                                <source src="<?php echo esc_url( $item['gs_video_2'] ); ?>" type="video/mp4">
                            </video>
				        <?php endif; ?>
                    </div>
                    <div class="content-wrap">
                        <div class="icon-wrap">
                            <div class="icon"><?php Icons_Manager::render_icon( $settings['gs_icon_2'], [ 'aria-hidden' => 'true' ] ); ?></div>
                        </div>
                        <div class="content">
                            <<?php echo Utils::validate_html_tag( $settings['gs_title2_tag'] ); ?> class="title">
					        <?php echo esc_html( $item['gs_title_2'] ); ?>
                        </<?php echo Utils::validate_html_tag( $settings['gs_title2_tag'] ); ?>>
                        <p class="desc"><?php echo esc_html( $item['gs_text_2'] ); ?></p>
                    </div>
            </div>
            </a>
	        <?php
					$this->remove_render_attribute( 'link' );
	        endforeach;
	        endif;
                ?>
            </div>
        </div>

        </div>
		<?php
	}
}
