<?php

namespace ArolaxEssentialApp\Widgets;

use Elementor\Controls_Manager;
use Elementor\Control_Media;
use Elementor\Group_Control_Background;
use Elementor\Utils;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Group_Control_Image_Size;
use Elementor\Repeater;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Plugin;
use Elementor\Widget_Base;
use Elementor\Icons_Manager;
use WP_Query;

if ( ! defined( 'ABSPATH' ) ) {
	exit;   // Exit if accessed directly.
}

class Arolax_Service extends Widget_Base {

	public function get_name() {
		return 'arolax--service';
	}

	public function get_title() {
		return esc_html__( 'Arolax Service', 'arolax-essential' );
	}

	public function get_icon() {
		return 'wcf eicon-gallery-grid';
	}

	public function get_categories() {
		return [ 'weal-coder-addon' ];
	}

	public function get_style_depends() {
		wp_register_style( 'arolax-service', AROLAX_ESSENTIAL_ASSETS_URL . 'css/arolax-service.css' );

		return [ 'arolax-service' ];
	}

	public function register_content_controls() {
		$this->start_controls_section(
			'sec_content',
			[
				'label' => __( 'Service', 'arolax-essential' ),
			]
		);

		$this->add_control(
			'service_style',
			[
				'label' => esc_html__( 'Style', 'arolax-essential' ),
				'type' => Controls_Manager::SELECT,
				'separator' => 'after',
				'default' => '1',
				'options' => [
					'1' => esc_html__( '1', 'arolax-essential' ),
					'2' => esc_html__( '2', 'arolax-essential' ),
				],
			]
		);

		$this->add_control(
			'service_num',
			[
				'label'       => esc_html__( 'Number', 'arolax-essential' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( '01', 'arolax-essential' ),
                'condition' => [
                        'service_style' => '1',
                ],
			]
		);

		$this->add_control(
			'service_img',
			[
				'label' => esc_html__( 'Choose Image', 'arolax-essential' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'service_style' => '1',
				],
			]
		);

		$this->add_control(
			'service_title',
			[
				'label'       => esc_html__( 'Title', 'arolax-essential' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Service Title', 'arolax-essential' ),
                'label_block' => true,
			]
		);

		$this->add_control(
			'service_desc',
			[
				'label' => esc_html__( 'Description', 'arolax-essential' ),
				'type' => Controls_Manager::TEXTAREA,
				'rows' => 3,
				'default' => esc_html__( 'we approach each project with meticulous attention to detail and best quality.', 'arolax-essential' ),
			]
		);

		$this->add_control(
			'btn_text',
			[
				'label'       => esc_html__( 'Button Text', 'arolax-essential' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Button', 'arolax-essential' ),
				'condition' => [
					'service_style' => '2',
				],
			]
		);

		$this->add_control(
			'btn_icon',
			[
				'label'            => esc_html__( 'Button Icon', 'arolax-essential' ),
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
			'btn_link',
			[
				'label'   => esc_html__( 'Button Link', 'arolax-essential' ),
				'type'    => Controls_Manager::URL,
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => '#',
				],
			]
		);

		$this->end_controls_section();
	}

    // Style
	public function register_style_controls() {

		// Service Style
		$this->start_controls_section(
			'sec_style_item',
			[
				'label' => esc_html__( 'Service', 'arolax-essential' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'item_padding',
			[
				'label' => esc_html__( 'Padding', 'arolax-essential' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .a-service--item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Number Style
		$this->start_controls_section(
			'sec_style_num',
			[
				'label' => esc_html__( 'Number', 'arolax-essential' ),
				'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                        'service_style' => '1',
                ],
			]
		);

		$this->add_control(
			'num_color',
			[
				'label' => esc_html__( 'Color', 'arolax-essential' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .number' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'num_typo',
				'selector' => '{{WRAPPER}} .number',
			]
		);

		$this->end_controls_section();

		// Image Style
		$this->start_controls_section(
			'sec_style_image',
			[
				'label' => esc_html__( 'Image', 'arolax-essential' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'service_style' => '1',
				],
			]
		);

		$this->add_responsive_control(
			'img_width',
			[
				'label' => esc_html__( 'Width', 'arolax-essential' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .image img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'img_b_radius',
			[
				'label' => esc_html__( 'Border Radius', 'arolax-essential' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'img_margin',
			[
				'label' => esc_html__( 'Margin', 'arolax-essential' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

		$this->end_controls_section();

		// Desc Style
		$this->start_controls_section(
			'sec_style_desc',
			[
				'label' => esc_html__( 'Description', 'arolax-essential' ),
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

		$this->add_responsive_control(
			'desc_margin',
			[
				'label' => esc_html__( 'Margin', 'arolax-essential' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Button Style
		$this->start_controls_section(
			'sec_style_button',
			[
				'label' => esc_html__( 'Button', 'arolax-essential' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'btn_circle_width',
			[
				'label' => esc_html__( 'Circle Width', 'arolax-essential' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .a-btn-circle, {{WRAPPER}} .wc-btn-play' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'btn_icon_size',
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
					'{{WRAPPER}} .a-btn-circle, {{WRAPPER}} .wc-btn-play' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'btn_icon_border',
				'selector' => '{{WRAPPER}} .wc-btn-play, {{WRAPPER}} .a-btn-circle',
			]
		);

		$this->add_responsive_control(
			'btn_icon_b_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'arolax-essential' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .wc-btn-play, {{WRAPPER}} .a-btn-circle' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        // Text
		$this->add_control(
			'text_heading',
			[
				'label' => esc_html__( 'Text', 'arolax-essential' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
                'condition' => [
                        'service_style' => '2',
                ],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'btn_text_typo',
				'selector' => '{{WRAPPER}} .wc-btn-primary',
                'condition' => [
                        'service_style' => '2',
                ],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'btn_border',
				'selector' => '{{WRAPPER}} .wc-btn-primary',
				'condition' => [
					'service_style' => '2',
				],
			]
		);

		$this->add_responsive_control(
			'btn_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'arolax-essential' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .wc-btn-primary' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'service_style' => '2',
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
                'condition' => [
                        'service_style' => '2',
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
					'{{WRAPPER}} .wc-btn-primary, {{WRAPPER}} .a-btn-circle, {{WRAPPER}} .wc-btn-play' => 'color: {{VALUE}}; fill: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'btn_bg',
				'types'    => [ 'classic', 'gradient' ],
				'exclude'  => [ 'image' ],
				'selector' => '{{WRAPPER}} .wc-btn-primary, {{WRAPPER}} .a-btn-circle, {{WRAPPER}} .wc-btn-play',
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
					'{{WRAPPER}} .wc-btn-group:hover .wc-btn-primary, {{WRAPPER}} .wc-btn-group:hover .wc-btn-play, {{WRAPPER}} .a-btn-circle:hover' => 'color: {{VALUE}}; fill: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'btn_text_h_bg',
				'types'    => [ 'classic', 'gradient' ],
				'exclude'  => [ 'image' ],
				'selector' => '{{WRAPPER}} .wc-btn-group:hover .wc-btn-primary, {{WRAPPER}} .wc-btn-group:hover .wc-btn-play, {{WRAPPER}} .a-btn-circle:hover',
			]
		);

		$this->add_control(
			'btn_text_h_border',
			[
				'label'     => esc_html__( 'Border Color', 'arolax-essential' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wc-btn-group:hover .wc-btn-primary, {{WRAPPER}} .wc-btn-group:hover .wc-btn-play, {{WRAPPER}} .a-btn-circle:hover' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		// Hover Style
		$this->start_controls_section(
			'sec_style_hover',
			[
				'label' => esc_html__( 'Hover', 'arolax-essential' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'num_h_color',
			[
				'label' => esc_html__( 'Number Color', 'arolax-essential' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .a-service--item:hover .number' => 'color: {{VALUE}}',
				],
                'condition' => [
                        'service_style' => '1',
                ],
			]
		);

		$this->add_control(
			'title_h_color',
			[
				'label' => esc_html__( 'Title Color', 'arolax-essential' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .a-service--item:hover .title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'desc_h_color',
			[
				'label' => esc_html__( 'Desc Color', 'arolax-essential' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .a-service--item:hover .desc' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'item_bg',
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .a-service--item:hover',
			]
		);

		$this->add_control(
			'overlay_color',
			[
				'label' => esc_html__( 'Overlay Color', 'arolax-essential' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .a-service--item::before' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'overlay_opacity',
			[
				'label' => esc_html__( 'Opacity', 'arolax-essential' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .a-service--item::before' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_responsive_control(
			'item_h_padding',
			[
				'label' => esc_html__( 'Padding', 'arolax-essential' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .a-service--item:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function register_controls() {
		$this->register_content_controls();
		$this->register_style_controls();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		if ( ! empty( $settings['btn_link']['url'] ) ) {
			$this->add_link_attributes( 'btn_link', $settings['btn_link'] );
		}

		?>
        <div class="a-service--item style-<?php echo esc_html( $settings['service_style'] ); ?>">
			<?php
			if ( '1' === $settings['service_style'] ): ?>
                <div class="number">
					<?php echo esc_html( $settings['service_num'] ); ?>
                </div>
                <div class="image">
                    <img src="<?php echo esc_url( $settings['service_img']['url'] ); ?>" alt="<?php echo wp_kses_post( $settings['service_title'] ); ?>">
                </div>
			<?php endif; ?>

            <div class="title">
	            <?php echo wp_kses_post( $settings['service_title'] ); ?>
            </div>
            <div class="desc">
	            <?php echo esc_html( $settings['service_desc'] ); ?>
            </div>
            <div class="btn-wrapper">
		        <?php if ( '1' === $settings['service_style'] ): ?>
                    <a <?php $this->print_render_attribute_string( 'btn_link' ); ?> class="a-btn-circle" aria-label="<?php echo esc_attr__('Read Service Details', 'arolax-essential'); ?>">
				        <?php Icons_Manager::render_icon( $settings['btn_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                    </a>
		        <?php elseif ( '2' === $settings['service_style'] ): ?>
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
		        <?php endif; ?>
            </div>
        </div>
		<?php
	}

}