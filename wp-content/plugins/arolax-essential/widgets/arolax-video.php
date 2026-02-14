<?php

namespace ArolaxEssentialApp\Widgets;

use Elementor\Control_Media;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Plugin;
use Elementor\Repeater;
use Elementor\Utils;
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
class Arolax_Video extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @return string Widget name.
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function get_name() {
		return 'arolax--video';
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
		return esc_html__( 'Arolax Video', 'arolax-essential' );
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

	public function get_script_depends() {
		wp_register_script( 'arolax-video', AROLAX_ESSENTIAL_ASSETS_URL. '/js/widgets/video.js' , [ 'jquery' ], false, true );
		return [ 'arolax-video' ];
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
				'label' => esc_html__( 'Video', 'arolax-essential' ),
			]
		);

		$this->add_control(
			'video_link',
			[
				'label'   => esc_html__( 'Video Link', 'arolax-essential' ),
				'type'    => Controls_Manager::TEXT,
				'label_block'=> true,
				'default' => 'https://wealcoder.com/dev/video/dancer.mp4',
			]
		);

		$this->add_control(
			'play_icon',
			[
				'label' => esc_html__( 'Play Icon', 'arolax-essential' ),
				'type' => Controls_Manager::ICONS,
				'skin' => 'inline',
				'label_block' => false,
				'default' => [
					'value' => 'fas fa-play',
					'library' => 'fa-solid',
				],
			]
		);

		$this->end_controls_section();


		// Video style.
		$this->start_controls_section(
			'sec_style_vtm_image',
			[
				'label' => esc_html__( 'Video', 'arolax-essential' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'video_width',
			[
				'label' => esc_html__( 'Width', 'arolax-essential' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 600,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .video' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'video_height',
			[
				'label' => esc_html__( 'Height', 'arolax-essential' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 800,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .video' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'image_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'arolax-essential' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .video' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'image_margin',
			[
				'label'      => esc_html__( 'Margin', 'arolax-essential' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .arolax--video' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Play Icon
		$this->start_controls_section(
			'style_vtm_play',
			[
				'label' => esc_html__( 'Play Icon', 'arolax-essential' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'play_icon_color',
			[
				'label'     => esc_html__( 'Color', 'arolax-essential' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .play-video' => 'color: {{VALUE}}; fill: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'play_icon_size',
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
					'{{WRAPPER}} .play-video' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'play_wrap_size',
			[
				'label' => esc_html__( 'Wrapper Size', 'arolax-essential' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .play-video' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'play_icon_border',
				'selector' => '{{WRAPPER}} .play-video',
			]
		);

		$this->add_responsive_control(
			'play_icon_b_radius',
			[
				'label' => esc_html__( 'Border Radius', 'arolax-essential' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .play-video' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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



		?>
        <style>

            .arolax--video {
                position: relative;
                cursor: pointer;
            }

            .arolax--video svg {
                width: 1em;
                height: 1em;
            }

            .arolax--video .play-video {
                width: 160px;
                height: 160px;
                display: inline-flex;
                justify-content: center;
                align-items: center;
                border: 1px solid #fff;
                color: #fff;
                fill: #fff;
                border-radius: 50%;
                transition: all 0.5s;
                font-size: 24px;
                position: absolute;
                left: 50%;
                top: 50%;
                transform: translate(-50%, -50%);
                pointer-events: none;
            }

        </style>
        <div class="arolax--video">
            <video class="video">
                <source src="<?php echo esc_url($settings['video_link']); ?>" type="video/mp4">
            </video>
            <div class="play-video">
				<?php Icons_Manager::render_icon( $settings['play_icon'], [ 'aria-hidden' => 'true' ] ); ?>
            </div>
        </div>
		<?php
	}
}
