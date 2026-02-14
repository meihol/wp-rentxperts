<?php

namespace WCFAddonsPro\Widgets;

use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Button
 *
 * Elementor widget for testimonial.
 *
 * @since 1.0.0
 */
class Button_Pro extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @return string Widget name.
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function get_name() {
		return 'wfc-button-pro';
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
		return esc_html__( 'Advanced Button', 'wcf-addons-pro' );
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
		return [ 'wcf-addons-pro' ];
	}

	public function get_style_depends() {
		return [ 'wcf--button-pro' ];
	}

	public function get_script_depends() {
		return [ 'wcf--button-pro' ];
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
				'label' => esc_html__( 'Button', 'wcf-addons-pro' ),
			]
		);

		$this->add_control(
			'btn_style',
			[
				'label'     => esc_html__( 'Style', 'wcf-addons-pro' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '1',
				'options'   => [
					'1' => esc_html__( '1', 'wcf-addons-pro' ),
					'2' => esc_html__( '2', 'wcf-addons-pro' ),
					'3' => esc_html__( '3', 'wcf-addons-pro' ),
					'4' => esc_html__( '4', 'wcf-addons-pro' ),
					'5' => esc_html__( '5', 'wcf-addons-pro' ),
					'6' => esc_html__( '6', 'wcf-addons-pro' ),
				],
				'separator' => 'after',
			]
		);

		$this->add_control(
			'btn_text',
			[
				'label'   => esc_html__( 'Text', 'wcf-addons-pro' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Discover More', 'wcf-addons-pro' ),
			]
		);

		$this->add_control(
			'btn_icon',
			[
				'label'       => esc_html__( 'Icon', 'wcf-addons-pro' ),
				'type'        => Controls_Manager::ICONS,
				'skin'        => 'inline',
				'label_block' => false,
				'default'     => [
					'value'   => 'fas fa-arrow-right',
					'library' => 'fa-solid',
				],
			]
		);

		$this->add_control(
			'btn_icon_position',
			[
				'label'     => esc_html__( 'Icon Position', 'wcf-addons-pro' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'row',
				'options'   => [
					'row'         => esc_html__( 'After', 'wcf-addons-pro' ),
					'row-reverse' => esc_html__( 'Before', 'wcf-addons-pro' ),
				],
				'selectors' => [
					'{{WRAPPER}} .btn-text-flip' => 'flex-direction: {{VALUE}};',
				],
				'condition' => [
					'btn_style' => '3',
				],
			]
		);

		$this->add_control(
			'btn_link',
			[
				'label'   => esc_html__( 'Link', 'wcf-addons-pro' ),
				'type'    => Controls_Manager::URL,
				'options' => [ 'url', 'is_external', 'nofollow' ],
				'default' => [
					'url'         => '#',
					'is_external' => false,
					'nofollow'    => true,
				],
			]
		);

		$this->add_responsive_control(
			'btn_align',
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
					'{{WRAPPER}} .helo--btn-wrapper' => 'text-align: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);

		$this->end_controls_section();


		// Button Style
		$this->button_style_controls();

	}

	// Button Style
	public function button_style_controls() {

		$this->start_controls_section(
			'style_button',
			[
				'label' => esc_html__( 'Button', 'wcf-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'btn_typo',
				'selector' => '{{WRAPPER}} .helo--btn, {{WRAPPER}} .wc-btn-primary',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'btn_bg',
				'types'    => [ 'classic', 'gradient' ],
				'exclude'  => [ 'image' ],
				'selector' => '{{WRAPPER}} .helo--btn, {{WRAPPER}} .wc-btn-primary, {{WRAPPER}} .wc-btn-play',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'btn_border',
				'selector' => '{{WRAPPER}} .helo--btn, {{WRAPPER}} .wc-btn-primary, {{WRAPPER}} .wc-btn-play',
			]
		);

		$this->add_responsive_control(
			'btn_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'wcf-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .helo--btn'      => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .wc-btn-primary' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .wc-btn-play'    => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'btn_padding',
			[
				'label'      => esc_html__( 'Padding', 'wcf-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .helo--btn'      => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .wc-btn-primary' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Icon Style
		$this->add_control(
			'btn_icon_heading',
			[
				'label'     => esc_html__( 'Icon', 'wcf-addons-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'btn_icon_size',
			[
				'label'      => esc_html__( 'Icon Size', 'wcf-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .helo--btn .icon, {{WRAPPER}} .wc-btn-play' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .style-4 .wc-btn-primary strong'            => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'btn_icon_size_width',
			[
				'label'      => esc_html__( 'Icon Width', 'wcf-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .wc-btn-play' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; --icon-width: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [ 'btn_style' => [ '5', '6' ] ],
			]
		);

		$this->add_responsive_control(
			'btn_gap',
			[
				'label'      => esc_html__( 'Gap', 'wcf-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .helo--btn, {{WRAPPER}} .wc-btn-primary' => 'gap: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [ 'btn_style!' => [ '5', '6' ] ],
			]
		);

		// Tabs
		$this->start_controls_tabs(
			'btn_style_tabs'
		);

		$this->start_controls_tab(
			'btn_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'wcf-addons-pro' ),
			]
		);

		$this->add_control(
			'btn_color',
			[
				'label'     => esc_html__( 'Color', 'wcf-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .helo--btn, {{WRAPPER}} .btn-text-flip span, {{WRAPPER}} .wc-btn-primary' => 'color: {{VALUE}}; fill: {{VALUE}}',
					'{{WRAPPER}} .style-4 .wc-btn-primary strong'                                          => 'background-color: {{VALUE}}',
					'{{WRAPPER}} svg'                                                                      => 'fill: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		// Hover
		$this->start_controls_tab(
			'btn_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'wcf-addons-pro' ),
			]
		);

		$this->add_control(
			'btn_h_color',
			[
				'label'     => esc_html__( 'Color', 'wcf-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .helo--btn:hover'                                                => 'color: {{VALUE}}; fill: {{VALUE}}',
					'{{WRAPPER}} .btn-text-flip:hover span, {{WRAPPER}} .btn-text-flip:hover svg' => 'color: {{VALUE}}; fill: {{VALUE}}',
					'{{WRAPPER}} .wc-btn-group:hover span, {{WRAPPER}} .wc-btn-primary:hover'     => 'color: {{VALUE}}',
					'{{WRAPPER}} .wc-btn-group:hover .wc-btn-play svg'                            => 'fill: {{VALUE}}',
					'{{WRAPPER}} .style-4 .wc-btn-primary:hover strong'                           => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .style-4 .wc-btn-primary:hover strong::after'                    => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'btn_h_border',
			[
				'label'     => esc_html__( 'Border Color', 'wcf-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .helo--btn:hover, {{WRAPPER}} .wc-btn-primary:hover, {{WRAPPER}} .wc-btn-group:hover span' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'btn_h_bg',
				'types'    => [ 'classic', 'gradient' ],
				'exclude'  => [ 'image' ],
				'selector' => '{{WRAPPER}} .helo--btn:hover, {{WRAPPER}} .wc-btn-group:hover span, .style-4 .wc-btn-primary span',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

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

		if ( ! empty( $settings['btn_link']['url'] ) ) {
			$this->add_link_attributes( 'btn_link', $settings['btn_link'] );
		}
		?>

        <div class="helo--btn-wrapper style-<?php echo esc_html( $settings['btn_style'] ); ?>">
			<?php if ( '1' === $settings['btn_style'] ) { ?>
                <a <?php $this->print_render_attribute_string( 'btn_link' ); ?> class="helo--btn btn-border-divide">
                    <span class="text"><?php echo esc_html( $settings['btn_text'] ); ?></span>
                    <span class="icon">
                        <?php Icons_Manager::render_icon( $settings['btn_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                        <?php Icons_Manager::render_icon( $settings['btn_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                    </span>
                </a>
			<?php } elseif ( '2' === $settings['btn_style'] ) { ?>
                <a <?php $this->print_render_attribute_string( 'btn_link' ); ?> class="helo--btn">
					<?php echo esc_html( $settings['btn_text'] ); ?>
                    <span class="icon"><?php Icons_Manager::render_icon( $settings['btn_icon'], [ 'aria-hidden' => 'true' ] ); ?> </span>
                </a>
			<?php } elseif ( '3' === $settings['btn_style'] ) { ?>
                <a <?php $this->print_render_attribute_string( 'btn_link' ); ?> class="helo--btn btn-text-flip">
                    <span data-text="<?php echo esc_html( $settings['btn_text'] ); ?>">
                        <?php echo esc_html( $settings['btn_text'] ); ?>
                    </span>
					<?php Icons_Manager::render_icon( $settings['btn_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                </a>
			<?php } elseif ( '4' === $settings['btn_style'] ) { ?>
                <a <?php $this->print_render_attribute_string( 'btn_link' ); ?> class="wc-btn-primary btn-hover">
                    <span></span>
					<?php echo esc_html( $settings['btn_text'] ); ?>
                    <strong></strong>
                </a>
			<?php } elseif ( '5' === $settings['btn_style'] ) { ?>
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
			<?php } elseif ( '6' === $settings['btn_style'] ) { ?>
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
		<?php
	}

}
