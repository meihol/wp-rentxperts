<?php

namespace WCFAddonsPro\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Utils;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

/**
 * Video Popup
 *
 * Elementor widget for Video Popup.
 *
 * @since 1.0.0
 */
class Video_Popup extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @return string Widget name.
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function get_name() {
		return 'wcf--video-popup';
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
		return esc_html__( 'Video Popup', 'wcf-addons-pro' );
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
		return 'wcf eicon-youtube';
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

		// Button Controls
		$this->register_button_controls();

		// Video Link
		$this->start_controls_section(
			'section_video_content',
			[
				'label' => __( 'Video', 'wcf-addons-pro' ),
			]
		);

		$this->add_control(
			'video_link',
			[
				'label'       => esc_html__( 'Video Link', 'wcf-addons-pro' ),
				'type'        => Controls_Manager::TEXT,
				'input_type'  => 'url',
				'placeholder' => 'https://www.youtube.com/watch?v=MLpWrANjFbI',
				'description' => esc_html__( 'YouTube/Vimeo link, or link to video file (mp4 is recommended). Please reload the page seeing update.', 'wcf-addons-pro' ),
				'render_type' => 'template',
				'label_block' => true,
				'default'     => 'https://www.youtube.com/watch?v=MLpWrANjFbI',
			]
		);

		$this->end_controls_section();
	}

	protected function register_button_controls() {
		$this->start_controls_section(
			'section_button',
			[
				'label' => __( 'Button', 'wcf-addons-pro' ),
			]
		);

		$this->add_control(
			'btn_text',
			[
				'label'       => esc_html__( 'Text', 'wcf-addons-pro' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => [
					'active' => true,
				],
				'default'     => esc_html__( 'Play', 'wcf-addons-pro' ),
				'placeholder' => esc_html__( 'Play', 'wcf-addons-pro' ),
			]
		);

		$this->add_control(
			'btn_icon',
			[
				'label'            => esc_html__( 'Icon', 'wcf-addons-pro' ),
				'type'             => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'skin'             => 'inline',
				'label_block'      => false,
			]
		);

		$this->add_control(
			'icon_indent',
			[
				'label'     => esc_html__( 'Icon Spacing', 'wcf-addons-pro' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .wcf-popup-btn' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'active_ripple',
			[
				'label'        => esc_html__( 'Active Ripple', 'wcf-addons-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'yes', 'wcf-addons-pro' ),
				'label_off'    => esc_html__( 'No', 'wcf-addons-pro' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'ripple_color',
			[
				'label'     => esc_html__( 'Ripple Color', 'wcf-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wcf-popup-btn:before' => 'color: {{VALUE}}',
					'{{WRAPPER}} .wcf-popup-btn:after'  => 'color: {{VALUE}}',
				],
				'condition' => [ 'active_ripple' => 'yes' ],
			]
		);

		$this->add_control(
			'active_spinner',
			[
				'label'        => esc_html__( 'Active spinner', 'wcf-addons-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'yes', 'wcf-addons-pro' ),
				'label_off'    => esc_html__( 'No', 'wcf-addons-pro' ),
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'sipper_image',
			[
				'label'     => esc_html__( 'Spinner Image', 'wcf-addons-pro' ),
				'type'      => Controls_Manager::MEDIA,
				'default'   => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [ 'active_spinner' => 'yes' ],
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label'     => esc_html__( 'Alignment', 'wcf-addons-pro' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'left'   => [
						'title' => esc_html__( 'Left', 'wcf-addons-pro' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'wcf-addons-pro' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right'  => [
						'title' => esc_html__( 'Right', 'wcf-addons-pro' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'default'   => '',
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		//style
		$this->start_controls_section(
			'section_button_style',
			[
				'label' => __( 'Button', 'wcf-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'button_typography',
				'selector' => '{{WRAPPER}} .wcf-popup-btn',
			]
		);

		$this->add_responsive_control(
			'button_width',
			[
				'label'      => esc_html__( 'Width', 'wcf-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'separator'  => 'before',
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 500,
						'step' => 5,
					],
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .wcf-popup-btn' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'button_height',
			[
				'label'      => esc_html__( 'Height', 'wcf-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 500,
						'step' => 5,
					],
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .wcf-popup-btn' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'button_border',
				'selector'  => '{{WRAPPER}} .wcf-popup-btn',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'button_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'wcf-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .wcf-popup-btn'                => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .wcf-popup-btn:after'          => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .wcf-popup-btn:before'         => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .wcf-popup-btn .spinner_image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'button_box_shadow',
				'selector' => '{{WRAPPER}} .wcf-popup-btn',
			]
		);

		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => esc_html__( 'Normal', 'wcf-addons-pro' ),
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label'     => esc_html__( 'Text Color', 'wcf-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .wcf-popup-btn' => 'fill: {{VALUE}}; color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'button_background',
				'types'    => [ 'classic', 'gradient' ],
				'exclude'  => [ 'image' ],
				'selector' => '{{WRAPPER}} .wcf-popup-btn',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' => esc_html__( 'Hover', 'wcf-addons-pro' ),
			]
		);

		$this->add_control(
			'button_hover_text_color',
			[
				'label'     => esc_html__( 'Text Color', 'wcf-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wcf-popup-btn:hover, {{WRAPPER}} .wcf-popup-btn:focus'         => 'color: {{VALUE}};',
					'{{WRAPPER}} .wcf-popup-btn:hover svg, {{WRAPPER}} .wcf-popup-btn:focus svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'button_background_hover',
				'types'    => [ 'classic', 'gradient' ],
				'exclude'  => [ 'image' ],
				'selector' => '{{WRAPPER}} .wcf-popup-btn:hover, {{WRAPPER}} .wcf-popup-btn:focus',
			]
		);

		$this->add_control(
			'button_hover_border_color',
			[
				'label'     => esc_html__( 'Border Color', 'wcf-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => [
					'button_border_border!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .wcf-popup-btn:hover, {{WRAPPER}} .wcf-popup-btn:focus' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'hover_animation',
			[
				'label' => esc_html__( 'Hover Animation', 'wcf-addons-pro' ),
				'type'  => Controls_Manager::HOVER_ANIMATION,
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

		$video_link = $settings['video_link'];

		// Youtube Link Checking
		if ( strpos( $video_link, "https://www.youtube.com/" ) === 0 ) {
			parse_str( parse_url( $video_link, PHP_URL_QUERY ), $query );

			if ( isset( $query['v'] ) ) {
				$ytVideoId  = $query['v'];
				$video_link = "https://www.youtube.com/embed/" . $ytVideoId;
			}
		}

		// Vimeo Link Checking
		if ( strpos( $video_link, "https://vimeo.com/" ) === 0 ) {
			$videoId    = str_replace( "https://vimeo.com/", "", $video_link );
			$video_link = "https://player.vimeo.com/video/" . $videoId;
		}

		$this->add_render_attribute( 'wrapper', 'class', 'wcf--video-popup' );
		?>
        <div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
			<?php
			$this->render_popup_button( $settings, $video_link );
			?>
        </div>
		<?php
	}

	protected function render_popup_button( $settings, $video_link ) {
		$this->add_render_attribute( 'button', 'class', 'wcf-popup-btn ' );
		$this->add_render_attribute( 'button', 'data-src', esc_url( $video_link ) );
		if ( ! empty( $settings['active_ripple'] ) ) {
			$this->add_render_attribute( 'button', 'class', 'ripple' );
		}

		if ( ! empty( $settings['hover_animation'] ) ) {
			$this->add_render_attribute( 'button', 'class', 'elementor-animation-' . $settings['hover_animation'] );
		}

		$migrated = isset( $settings['__fa4_migrated']['btn_icon'] );
		$is_new   = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();
		?>
        <button <?php $this->print_render_attribute_string( 'button' ); ?>
                aria-label="<?php echo esc_html__( 'Popup Video Open Icon', 'wcf-addons-pro' ); ?>">
			<?php
			if ( ! empty( $settings['active_spinner'] ) ) {
				echo '<img class="spinner_image" src="' . esc_url( $settings['sipper_image']['url'] ) . '">';
			}
			?>
			<?php $this->print_unescaped_setting( 'btn_text' ); ?>
			<?php if ( $is_new || $migrated ) :
				Icons_Manager::render_icon( $settings['btn_icon'], [ 'aria-hidden' => 'true' ] );
			else : ?>
                <i class="<?php echo esc_attr( $settings['icon'] ); ?>" aria-hidden="true"></i>
			<?php endif; ?>
        </button>
		<?php
	}
}
