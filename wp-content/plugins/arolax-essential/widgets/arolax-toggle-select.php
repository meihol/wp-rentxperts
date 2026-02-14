<?php

namespace ArolaxEssentialApp\Widgets;

use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Plugin;
use Elementor\Repeater;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

/**
 * Toggle Select
 *
 * Elementor widget for toggle.
 *
 * @since 1.0.0
 */
class Arolax_Toggle_Select extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @return string Widget name.
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function get_name() {
		return 'arolax-toggle-select';
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
		return esc_html__( 'Arolax Toggle Select', 'arolax-essential' );
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
		return 'wcf eicon-t-letter';
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

	// Script Dependency
	public function get_script_depends() {
		wp_register_script( 'arolax-toggle-select', AROLAX_ESSENTIAL_ASSETS_URL . '/js/widgets/arolax-toggle-select.js', [ 'jquery' ], false, true );

		return [ 'arolax-toggle-select' ];
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
			'sec_toggle_select',
			[
				'label' => esc_html__( 'Toggle Select', 'arolax-essential' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'option_title',
			[
				'label'       => esc_html__( 'Title', 'arolax-essential' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Monthly', 'arolax-essential' ),
			]
		);

		$repeater->add_control(
			'content_type',
			[
				'label'   => esc_html__( 'Content Type', 'arolax-essential' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'content'  => esc_html__( 'Content', 'arolax-essential' ),
					'template' => esc_html__( 'Saved Templates', 'arolax-essential' ),
				],
				'default' => 'content',
			]
		);

		$repeater->add_control(
			'elementor_templates',
			[
				'label'       => esc_html__( 'Save Template', 'arolax-essential' ),
				'type'        => Controls_Manager::SELECT2,
				'label_block' => false,
				'multiple'    => false,
				'options'     => function_exists('wcf_addons_get_saved_template_list') ? wcf_addons_get_saved_template_list() : [],
				'condition'   => [
					'content_type' => 'template',
				],
			]
		);

		$repeater->add_control(
			'select_content',
			[
				'label'     => esc_html__( 'Content', 'arolax-essential' ),
				'default'   => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'arolax-essential' ),
				'type'      => Controls_Manager::WYSIWYG,
				'condition' => [
					'content_type' => 'content',
				],
			]
		);

		$this->add_control(
			'select_option',
			[
				'label'        => esc_html__( 'Select Options', 'arolax-essential' ),
				'type'         => Controls_Manager::REPEATER,
				'fields'       => $repeater->get_controls(),
				'item_actions' => [
					'add'       => true,
					'duplicate' => false,
					'remove'    => true,
					'sort'      => true,
				],
				'default'      => [
					[ 'option_title' => 'Monthly' ],
					[ 'option_title' => 'Yearly' ]
				],
				'title_field'  => '{{{ option_title }}}',
			]
		);

		$this->end_controls_section();


		// Select Wrapper
		$this->start_controls_section(
			'style_select_wrap',
			[
				'label' => __( 'Toggle Select Wrapper', 'arolax-essential' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'select_wrap_bg',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .arolax-toggle-wrapper',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'select_wrap_border',
				'selector' => '{{WRAPPER}} .arolax-toggle-wrapper',
			]
		);

		$this->add_control(
			'select_wrap_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'arolax-essential' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .arolax-toggle-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'select_wrap_padding',
			[
				'label'      => esc_html__( 'Padding', 'arolax-essential' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .arolax-toggle-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'select_wrap_margin',
			[
				'label'      => esc_html__( 'Margin', 'arolax-essential' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .arolax-toggle-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

        // Select
		$this->start_controls_section(
			'style_toggle_select',
			[
				'label' => __( 'Toggle Select', 'arolax-essential' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'select_width',
			[
				'label' => esc_html__( 'Select Width', 'arolax-essential' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'auto',
				'options' => [
					'auto' => esc_html__( 'Default', 'arolax-essential' ),
					'100%' => esc_html__( 'Full Width', 'arolax-essential' ),
				],
				'selectors' => [
					'{{WRAPPER}} .arolax-toggle-wrapper .select-wrap' => 'width: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'select_color',
			[
				'label' => esc_html__( 'Color', 'arolax-essential' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .arolax-toggle-wrapper select, {{WRAPPER}} .arolax-toggle-wrapper::after' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'select_typo',
				'selector' => '{{WRAPPER}} .arolax-toggle-wrapper select',
			]
		);



		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'select_bg',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .arolax-toggle-wrapper select',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'select_border',
				'selector' => '{{WRAPPER}} .arolax-toggle-wrapper select',
			]
		);

		$this->add_control(
			'select_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'arolax-essential' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .arolax-toggle-wrapper select' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'select_padding',
			[
				'label'      => esc_html__( 'Padding', 'arolax-essential' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .arolax-toggle-wrapper select' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Icon
		$this->add_control(
			'select_icon_heading',
			[
				'label' => esc_html__( 'Icon', 'arolax-essential' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'select_icon_size',
			[
				'label' => esc_html__( 'Icon Size', 'arolax-essential' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 40,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .arolax-toggle-wrapper .select-wrap::after' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'select_icon_padding',
			[
				'label' => esc_html__( 'Right Padding', 'arolax-essential' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .arolax-toggle-wrapper .select-wrap::after' => 'right: {{SIZE}}{{UNIT}};',
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
		$selector     = $settings['select_option'];

		$this->add_render_attribute( 'wrapper', 'class', [ 'arolax__toggle_select' ] );
		?>
        <style>
            .arolax__toggle_select .toggle-pane {
                display: none;
            }

            .arolax__toggle_select .toggle-pane.show {
                display: block;
            }

            .arolax-toggle-wrapper select {
                appearance: none;
                -moz-appearance: none;
                -webkit-appearance: none;
                padding: 10px 35px 10px 18px;
                background-image: none;
                width: 100%;
            }

            .arolax-toggle-wrapper .select-wrap {
                position: relative;
                display: inline-block;
            }

            .arolax-toggle-wrapper .select-wrap::after {
                font-family: eicons;
                content: "\e8ad";
                position: absolute;
                top: 50%;
                transform: translateY(-50%);
                right: 15px;
                pointer-events: none;
                font-size: 20px;
            }

        </style>

		<div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
            <div class="arolax-toggle-wrapper">
                <div class="select-wrap">
                    <select name="arolax-select" id="view-<?php echo esc_attr( $this->get_id() ) ?>" aria-label="<?php echo esc_attr__('Select Option', 'arolax-essential'); ?>">
						<?php
						foreach ( $selector as $index => $item ) {
							?>
                            <option
                            value="<?php echo esc_html( $item['_id'] ); ?>"><?php echo esc_html( $item['option_title'] ); ?></option><?php
						}
						?>
                    </select>
                </div>
            </div>

			<div class="toggle-content">
				<?php
				foreach ( $selector as $index => $item ) {
					?>
					<div class="toggle-pane <?php echo esc_attr( 0 === $index ? 'show' : '' ); ?>" data-target="<?php echo $item['_id'] ?>">
						<?php
						if ( 'content' === $item['content_type'] ) {
							$this->print_text_editor( $item['select_content'] );
						} else {
							if ( ! empty( $item['elementor_templates'] ) ) {
								echo Plugin::$instance->frontend->get_builder_content( $item['elementor_templates'], true); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							}
						}
						?>
					</div>
					<?php
				}
				?>
			</div>
		</div>
		<?php
	}
}
