<?php
namespace AngieSnippets;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

class RentXperts_Inquiry_Button_5f258409 extends Widget_Base {

	public function get_name() {
		return 'rentxperts_inquiry_button_5f258409';
	}

	public function get_title() {
		return esc_html__( 'RentXperts Inquiry Button', 'angie-snippets' );
	}

	public function get_icon() {
		return 'eicon-button';
	}

	public function get_categories() {
		return [ 'angie-widgets', 'general' ];
	}

	public function get_style_depends() {
		return [ 'rentxperts-inquiry-button-style-5f258409' ];
	}

	public function get_script_depends() {
		return [ 'rentxperts-inquiry-button-script-5f258409' ];
	}

	protected function register_controls() {

		// Content Section
		$this->start_controls_section(
			'section_content_5f258409',
			[
				'label' => esc_html__( 'Button Content', 'angie-snippets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'button_text',
			[
				'label'       => esc_html__( 'Button Text', 'angie-snippets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'View More', 'angie-snippets' ),
				'placeholder' => esc_html__( 'View More', 'angie-snippets' ),
				'dynamic'     => [ 'active' => true ],
			]
		);

		// Get all CF7 Forms
		$cf7_forms = [];
		if ( post_type_exists( 'wpcf7_contact_form' ) ) {
			$posts = get_posts( [
				'post_type'      => 'wpcf7_contact_form',
				'posts_per_page' => -1,
			] );
			foreach ( $posts as $post ) {
				$cf7_forms[ $post->ID ] = $post->post_title . ' (ID: ' . $post->ID . ')';
			}
		}

		if ( empty( $cf7_forms ) ) {
			$cf7_forms['e21c623'] = esc_html__( 'Inquiry Form (Fallback ID: e21c623)', 'angie-snippets' );
		}

		$this->add_control(
			'cf7_form_id',
			[
				'label'   => esc_html__( 'Select Contact Form', 'angie-snippets' ),
				'type'    => Controls_Manager::SELECT,
				'options' => $cf7_forms,
				'default' => array_key_first( $cf7_forms ) ? array_key_first( $cf7_forms ) : 'e21c623',
			]
		);

		$this->add_control(
			'service_page',
			[
				'label'   => esc_html__( 'Service Page', 'angie-snippets' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'None'                              => esc_html__( 'None', 'angie-snippets' ),
					'Corporate Leasing'                 => esc_html__( 'Corporate Leasing', 'angie-snippets' ),
					'Land Acquisition'                  => esc_html__( 'Land Acquisition', 'angie-snippets' ),
					'Investment Advisory'               => esc_html__( 'Investment Advisory', 'angie-snippets' ),
					'Research, Consulting & Valuation'  => esc_html__( 'Research, Consulting & Valuation', 'angie-snippets' ),
				],
				'default' => 'None',
			]
		);

		$this->add_responsive_control(
			'alignment',
			[
				'label'     => esc_html__( 'Alignment', 'angie-snippets' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'left'   => [
						'title' => esc_html__( 'Left', 'angie-snippets' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'angie-snippets' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right'  => [
						'title' => esc_html__( 'Right', 'angie-snippets' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'default'   => 'left',
				'selectors' => [
					'{{WRAPPER}} .rx-btn-container-5f258409' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		// Style Section - Button Style
		$this->start_controls_section(
			'section_button_style_5f258409',
			[
				'label' => esc_html__( 'Button Style', 'angie-snippets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'button_typography',
				'selector' => '{{WRAPPER}} .rx-inquiry-btn-5f258409',
			]
		);

		$this->start_controls_tabs( 'button_tabs_5f258409' );

		$this->start_controls_tab(
			'button_normal_5f258409',
			[
				'label' => esc_html__( 'Normal', 'angie-snippets' ),
			]
		);

		$this->add_control(
			'text_color',
			[
				'label'     => esc_html__( 'Text Color', 'angie-snippets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000000',
				'selectors' => [
					'{{WRAPPER}} .rx-inquiry-btn-5f258409' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'underline_color',
			[
				'label'     => esc_html__( 'Underline Color', 'angie-snippets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000000',
				'selectors' => [
					'{{WRAPPER}} .rx-inquiry-btn-5f258409::after' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label'     => esc_html__( 'Icon Color', 'angie-snippets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000000',
				'selectors' => [
					'{{WRAPPER}} .rx-btn-icon-5f258409 svg' => 'fill: {{VALUE}};',
					'{{WRAPPER}} .rx-btn-icon-5f258409 svg path' => 'fill: {{VALUE}}; stroke: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'button_hover_5f258409',
			[
				'label' => esc_html__( 'Hover', 'angie-snippets' ),
			]
		);

		$this->add_control(
			'text_hover_color',
			[
				'label'     => esc_html__( 'Hover Text Color', 'angie-snippets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000000',
				'selectors' => [
					'{{WRAPPER}} .rx-inquiry-btn-5f258409:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'underline_hover_color',
			[
				'label'     => esc_html__( 'Hover Underline Color', 'angie-snippets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#555555',
				'selectors' => [
					'{{WRAPPER}} .rx-inquiry-btn-5f258409:hover::after' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_hover_color',
			[
				'label'     => esc_html__( 'Hover Icon Color', 'angie-snippets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#555555',
				'selectors' => [
					'{{WRAPPER}} .rx-inquiry-btn-5f258409:hover .rx-btn-icon-5f258409 svg' => 'fill: {{VALUE}};',
					'{{WRAPPER}} .rx-inquiry-btn-5f258409:hover .rx-btn-icon-5f258409 svg path' => 'fill: {{VALUE}}; stroke: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'button_padding',
			[
				'label'      => esc_html__( 'Padding', 'angie-snippets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .rx-inquiry-btn-5f258409' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'  => 'before',
			]
		);

		$this->add_responsive_control(
			'button_margin',
			[
				'label'      => esc_html__( 'Margin', 'angie-snippets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .rx-btn-container-5f258409' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'button_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'angie-snippets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .rx-inquiry-btn-5f258409' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Style Section - Popup Style
		$this->start_controls_section(
			'section_popup_style_5f258409',
			[
				'label' => esc_html__( 'Popup Style', 'angie-snippets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'popup_width',
			[
				'label'      => esc_html__( 'Popup Width', 'angie-snippets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'vw' ],
				'range'      => [
					'px' => [
						'min'  => 300,
						'max'  => 1200,
						'step' => 1,
					],
					'%'  => [
						'min'  => 10,
						'max'  => 100,
						'step' => 1,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 700,
				],
				'tablet_default' => [
					'unit' => '%',
					'size' => 90,
				],
				'mobile_default' => [
					'unit' => '%',
					'size' => 95,
				],
				'selectors'  => [
					'.rx-popup-container-5f258409' => 'max-width: {{SIZE}}{{UNIT}}; width: 100%;',
				],
			]
		);

		$this->add_control(
			'popup_bg_color',
			[
				'label'     => esc_html__( 'Popup Background', 'angie-snippets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'.rx-popup-container-5f258409' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'popup_overlay_color',
			[
				'label'     => esc_html__( 'Overlay Color', 'angie-snippets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(0,0,0,.6)',
				'selectors' => [
					'.rx-popup-overlay-5f258409' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'popup_close_color',
			[
				'label'     => esc_html__( 'Close Icon Color', 'angie-snippets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#333333',
				'selectors' => [
					'.rx-popup-close-5f258409' => 'color: {{VALUE}};',
					'.rx-popup-close-5f258409 svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'popup_padding',
			[
				'label'      => esc_html__( 'Popup Padding', 'angie-snippets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default'    => [
					'top'      => '40',
					'right'    => '40',
					'bottom'   => '40',
					'left'     => '40',
					'unit'     => 'px',
					'isLinked' => true,
				],
				'selectors'  => [
					'.rx-popup-content-5f258409' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$form_id  = ! empty( $settings['cf7_form_id'] ) ? $settings['cf7_form_id'] : 'e21c623';
		$service  = ! empty( $settings['service_page'] ) ? $settings['service_page'] : 'None';

		// Generate shortcode safely
		$shortcode = sprintf( '[contact-form-7 id="%s" title="Inquiry Form"]', esc_attr( $form_id ) );
		$form_html = do_shortcode( $shortcode );

		// Button Text
		$btn_text = ! empty( $settings['button_text'] ) ? $settings['button_text'] : esc_html__( 'View More', 'angie-snippets' );
		?>
		<div class="rx-btn-container-5f258409">
			<button class="rx-inquiry-btn-5f258409" 
				data-service="<?php echo esc_attr( $service ); ?>" 
				data-form-id="<?php echo esc_attr( $form_id ); ?>">
				<span class="rx-btn-text-5f258409"><?php echo esc_html( $btn_text ); ?></span>
				<span class="rx-btn-icon-5f258409">
					<svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M5 12H19M19 12L13 6M19 12L13 18" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
					</svg>
				</span>
			</button>

			<!-- Pre-rendered form template for popup injection -->
			<template class="rx-cf7-template-5f258409">
				<div class="rx-popup-inner-form-5f258409">
					<?php echo $form_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</div>
			</template>
		</div>
		<?php
	}

	protected function content_template() {
		?>
		<#
		var btnText = settings.button_text ? settings.button_text : 'View More';
		#>
		<div class="rx-btn-container-5f258409">
			<button class="rx-inquiry-btn-5f258409">
				<span class="rx-btn-text-5f258409">{{{ btnText }}}</span>
				<span class="rx-btn-icon-5f258409">
					<svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M5 12H19M19 12L13 6M19 12L13 18" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
					</svg>
				</span>
			</button>
		</div>
		<?php
	}
}
