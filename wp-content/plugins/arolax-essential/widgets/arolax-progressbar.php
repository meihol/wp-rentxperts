<?php

namespace ArolaxEssentialApp\Widgets;

use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;
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
class Arolax_Progressbar extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @return string Widget name.
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function get_name() {
		return 'arolax--progressbar';
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
		return esc_html__( 'Arolax Progressbar', 'arolax-essential' );
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
		return 'wcf eicon-skill-bar';
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
		wp_register_style( 'arolax-progressbar', AROLAX_ESSENTIAL_ASSETS_URL . 'css/progressbar.css' );
		return [ 'arolax-progressbar' ];
	}

	public function get_script_depends() {
		wp_register_script( 'arolax-progressbar', AROLAX_ESSENTIAL_ASSETS_URL. '/js/widgets/progressbar.js' , [ 'jquery' ], false, true );
		return [ 'arolax-progressbar' ];
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
				'label' => esc_html__( 'Progress Bar', 'arolax-essential' ),
			]
		);

		$this->add_control(
			'progressbar_title',
			[
				'label' => esc_html__( 'Title', 'arolax-essential' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__( 'Business Analysis', 'arolax-essential' ),
			]
		);

		$this->add_control(
			'progressbar_percentage',
			[
				'label' => esc_html__( 'Percentage', 'arolax-essential' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 80,
				],
			]
		);

		$this->add_control(
			'show_percentage',
			[
				'label' => esc_html__( 'Display Percentage', 'arolax-essential' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'arolax-essential' ),
				'label_off' => esc_html__( 'Hide', 'arolax-essential' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'pgb_animation_type',
			[
				'label' => esc_html__( 'Animation Type', 'arolax-essential' ),
				'type' => Controls_Manager::SELECT,
				'separator' => 'before',
				'default' => 'once',
				'options' => [
					'once' => esc_html__( 'Once', 'arolax-essential' ),
					'repeat' => esc_html__( 'Repeatable', 'arolax-essential' ),
				],
			]
		);


		$this->add_control(
			'pgb_animation_duration',
			[
				'label' => esc_html__( 'Animation Duration', 'arolax-essential' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'render_type' => 'template',
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 5,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .percentage, {{WRAPPER}} .arolax_progressbar .bar::after' => 'transition: all {{SIZE}}s;',
				],
			]
		);

		$this->end_controls_section();


		// Progress Bar style
		$this->start_controls_section(
			'style_progressbar',
			[
				'label' => esc_html__( 'Progress Bar', 'arolax-essential' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'progressbar_color',
			[
				'label' => esc_html__( 'Color', 'arolax-essential' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .arolax_progressbar .bar' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'pgb_active_color',
			[
				'label' => esc_html__( 'Active Color', 'arolax-essential' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .arolax_progressbar .bar::after' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'pgb_height',
			[
				'label' => esc_html__( 'Height', 'arolax-essential' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 20,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .arolax_progressbar .bar, {{WRAPPER}} .arolax_progressbar .bar::after' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .arolax_progressbar .percentage' => 'bottom: calc({{SIZE}}{{UNIT}} + 6px);',
				],
			]
		);

		$this->add_control(
			'progressbar_b_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'arolax-essential' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .arolax_progressbar .bar, {{WRAPPER}} .arolax_progressbar .bar::after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Title Style
		$this->start_controls_section(
			'style_title',
			[
				'label' => esc_html__( 'Title', 'arolax-essential' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__( 'Color', 'arolax-essential' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
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

		$this->end_controls_section();

		// Percentage Style
		$this->start_controls_section(
			'style_percentage',
			[
				'label' => esc_html__( 'Percentage', 'arolax-essential' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'percentage_color',
			[
				'label'     => esc_html__( 'Color', 'arolax-essential' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .percentage' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'percentage_size',
			[
				'label' => esc_html__( 'Size', 'arolax-essential' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .percentage' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'percentage_bg',
				'types' => [ 'classic', 'gradient' ],
				'exclude' => ['image'],
				'selector' => '{{WRAPPER}} .percentage, {{WRAPPER}} .percentage::after',
			]
		);

		$this->add_control(
			'percentage_b_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'arolax-essential' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .percentage' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'percentage_padding',
			[
				'label'      => esc_html__( 'Padding', 'arolax-essential' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .percentage' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

		$this->add_render_attribute(
			'wrapper',
			[
				'class'         => [ 'arolax_progressbar' ],
				'data-percentage' =>  $settings['progressbar_percentage']['size'],
				'data-animation' => $settings['pgb_animation_type'],
				'data-duration' => $settings['pgb_animation_duration']['size'],
			]
		);

		?>
		<div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
			<div class="title"><?php echo esc_html( $settings['progressbar_title'] ); ?></div>
			<div class="b-progressbar">
				<div class="percentage">
					<span class="number"><?php echo esc_html( $settings['progressbar_percentage']['size'] ); ?></span>
					<?php if ( 'yes' === $settings['show_percentage'] ) { ?>
						<span class="symbol">%</span>
					<?php } ?>
				</div>
				<div class="bar"></div>
			</div>
		</div>
		<?php

	}

}
