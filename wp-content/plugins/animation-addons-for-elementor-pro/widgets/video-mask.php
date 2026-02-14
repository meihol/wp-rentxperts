<?php

namespace WCFAddonsPro\Widgets;

use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

/**
 * Video Mask
 *
 * Elementor widget for Video Mask.
 *
 * @since 1.0.0
 */
class Video_Mask extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @return string Widget name.
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function get_name() {
		return 'wcf--video-mask';
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
		return esc_html__( 'Video Mask', 'wcf-addons-pro' );
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
		return 'wcf  eicon-youtube';
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
	 * Get style dependencies.
	 *
	 * Retrieve the list of style dependencies the element requires.
	 *
	 * @since 1.9.0
	 * @access public
	 *
	 * @return array Element styles dependencies.
	 */
	public function get_style_depends() {
		return ['wcf--video-mask'];
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
			'section_button',
			[
				'label' => __( 'Button', 'wcf-addons-pro' ),
			]
		);

		$this->add_control(
			'important_note',
			[
				'label' => esc_html__( 'Important Note', 'wcf-addons-pro' ),
				'type' => Controls_Manager::RAW_HTML,
				'raw' => esc_html__( 'On-click if you want to change the section text color, please use the class"wcf-video-msk-content" in main section.', 'wcf-addons-pro' ),
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
			]
		);

		$this->add_control(
			'mask_content_color',
			[
				'label'     => esc_html__( 'Other Section Text Color', 'wcf-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'.wcf-video-mask-content-{{ID}} *' => 'color: {{VALUE}} !important; fill: {{VALUE}} !important; border-color: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'wcf-addons-pro' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Watch Video', 'wcf-addons-pro' ),
			]
		);

		$this->add_control(
			'close_title',
			[
				'label' => esc_html__( 'Close Title', 'wcf-addons-pro' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Close Video', 'wcf-addons-pro' ),
			]
		);

		$this->add_control(
			'play_icon',
			[
				'label'            => esc_html__( 'Play Icon', 'wcf-addons-pro' ),
				'type'             => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default' => [
					'value' => 'fas fa-play',
					'library' => 'fa-solid',
				],
				'skin'             => 'inline',
				'label_block'      => false,
			]
		);

		$this->add_control(
			'icon_position',
			[
				'label' => esc_html__( 'Icon Position', 'wcf-addons-pro' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'row' => [
						'title' => esc_html__( 'Left', 'wcf-addons-pro' ),
						'icon' => 'eicon-arrow-left',
					],
					'column' => [
						'title' => esc_html__( 'Top', 'wcf-addons-pro' ),
						'icon' => 'eicon-arrow-up',
					],
                    'row-reverse' => [
						'title' => esc_html__( 'Right', 'wcf-addons-pro' ),
						'icon' => 'eicon-arrow-right',
					],
					'column-reverse' => [
						'title' => esc_html__( 'Bottom', 'wcf-addons-pro' ),
						'icon' => 'eicon-arrow-down',
					],
				],
				'toggle' => true,
				'default' => 'row',
				'selectors' => [
					'{{WRAPPER}} .video--btn' => 'flex-direction: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'btn_offset',
			[
				'label' => esc_html__( 'Offset', 'wcf-addons-pro' ),
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'label_off' => esc_html__( 'Default', 'wcf-addons-pro' ),
				'label_on' => esc_html__( 'Custom', 'wcf-addons-pro' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->start_popover();

		$this->add_responsive_control(
			'btn_offset_x',
			[
				'label' => esc_html__( 'Offset X', 'wcf-addons-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 2000,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .video--btn' => 'left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'btn_offset_y',
			[
				'label' => esc_html__( 'Offset Y', 'wcf-addons-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 2000,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .video--btn' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_popover();

		$this->end_controls_section();


        // Video Controls
		$this->start_controls_section(
			'section_video',
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
				'placeholder' => 'https://wealcoder.com/dev/video/dancer.mp4',
				'default'     => 'https://wealcoder.com/dev/video/dancer.mp4',
				'description' => esc_html__( 'Upload your mp4 video.', 'wcf-addons-pro' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'wcf_video_options',
			[
				'label' => esc_html__( 'Video Options', 'wcf-addons-pro' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'wcf_video_autoplay',
			[
				'label' => esc_html__( 'Autoplay', 'wcf-addons-pro' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'wcf_video_mute',
			[
				'label' => esc_html__( 'Mute', 'wcf-addons-pro' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'wcf_video_playsinline',
			[
				'label' => esc_html__( 'playsinline', 'wcf-addons-pro' ),
				'type' => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'wcf_video_loop',
			[
				'label' => esc_html__( 'Loop', 'wcf-addons-pro' ),
				'type' => Controls_Manager::SWITCHER,
				'frontend_available' => true,
			]
		);


        $this->add_control(
			'wcf_video_poster',
			[
				'label' => esc_html__( 'Poster', 'wcf-addons-pro' ),
				'type' => Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'wcf_video_mask',
			[
				'label' => esc_html__( 'Mask', 'wcf-addons-pro' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'wcf_mask_shape',
			[
				'label' => esc_html__( 'Shape', 'wcf-addons-pro' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'circle' => esc_html__( 'Circle', 'wcf-addons-pro' ),
					'flower' => esc_html__( 'Flower', 'wcf-addons-pro' ),
					'sketch' => esc_html__( 'Sketch', 'wcf-addons-pro' ),
					'triangle' => esc_html__( 'Triangle', 'wcf-addons-pro' ),
					'blob' => esc_html__( 'Blob', 'wcf-addons-pro' ),
                ],
				'default' => 'circle',
				'selectors' => [
					'{{WRAPPER}} .video-wrapper' => '-webkit-mask-image: url( ' . ELEMENTOR_ASSETS_URL . '/mask-shapes/{{VALUE}}.svg );',
				],
			]
		);

		$this->add_responsive_control(
			'video_mask_size',
			[
				'label' => esc_html__( 'Size', 'wcf-addons-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 50,
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .video-wrapper' => '-webkit-mask-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'video_mask_offset',
			[
				'label' => esc_html__( 'Offset', 'wcf-addons-pro' ),
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'label_off' => esc_html__( 'Default', 'wcf-addons-pro' ),
				'label_on' => esc_html__( 'Custom', 'wcf-addons-pro' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->start_popover();

		$this->add_responsive_control(
			'video_offset_x',
			[
				'label' => esc_html__( 'Offset X', 'wcf-addons-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 2000,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .video-wrapper' => '-webkit-mask-position-x: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'video_offset_y',
			[
				'label' => esc_html__( 'Offset Y', 'wcf-addons-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 2000,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .video-wrapper' => '-webkit-mask-position-y: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_popover();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'wrapper_border',
				'selector' => '{{WRAPPER}} .wcf--video-mask',
                'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'video_height',
			[
				'label'      => esc_html__( 'Video height', 'wcf-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 1500,
					],
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} video' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();


		// Style
		$this->start_controls_section(
			'section_mask_btn_style',
			[
				'label' => __( 'Button', 'wcf-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'btn_gap',
			[
				'label' => esc_html__( 'Gap', 'wcf-addons-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .video--btn' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'text_align',
			[
				'label' => esc_html__( 'Alignment', 'wcf-addons-pro' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'wcf-addons-pro' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'wcf-addons-pro' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'wcf-addons-pro' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'toggle' => true,
				'default' => 'left',
				'selectors' => [
					'{{WRAPPER}} .video--btn' => 'text-align: {{VALUE}};',
				],
			]
		);

		// Title
		$this->add_control(
			'wcf_title_style',
			[
				'label' => esc_html__( 'Title', 'wcf-addons-pro' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Color', 'wcf-addons-pro' ),
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

		// Icon
		$this->add_control(
			'wcf_icon_style',
			[
				'label' => esc_html__( 'Icon', 'wcf-addons-pro' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'wcf-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .icon' => 'color: {{VALUE}}; fill: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'icon_size',
			[
				'label' => esc_html__( 'Size', 'wcf-addons-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 2000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		// Hover
		$this->add_control(
			'wcf_btn_hover_style',
			[
				'label' => esc_html__( 'Hover', 'wcf-addons-pro' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'title_hover_color',
			[
				'label' => esc_html__( 'Color', 'wcf-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .video--btn:hover .title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'icon_hover_color',
			[
				'label' => esc_html__( 'Icon Color', 'wcf-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .video--btn:hover .icon' => 'color: {{VALUE}}; fill: {{VALUE}}',
				],
			]
		);

        // Active
		$this->add_control(
			'wcf_btn_active_style',
			[
				'label' => esc_html__( 'Active', 'wcf-addons-pro' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'title_active_color',
			[
				'label' => esc_html__( 'Title Color', 'wcf-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}.mask-open .title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'icon_active_color',
			[
				'label' => esc_html__( 'Icon Color', 'wcf-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}.mask-open .icon' => 'color: {{VALUE}}; fill: {{VALUE}}',
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

		// Video Attr
		$video_attr = [
			'width'  => '100%',
			'src'    => $settings['video_link'],
		];

		if ( ! empty( $settings['wcf_video_autoplay'] ) ) {
			$video_attr['autoplay'] = '';
		}

		if ( ! empty( $settings['wcf_video_mute'] ) ) {
			$video_attr['muted'] = '';
		}

		if ( ! empty( $settings['wcf_video_playsinline'] ) ) {
			$video_attr['playsinline'] = '';
		}

		if ( ! empty( $settings['wcf_video_loop'] ) ) {
			$video_attr['loop'] = '';
		}

		if ( ! empty( $settings['wcf_video_poster'] ) ) {
			$video_attr['poster'] = $settings['wcf_video_poster']['url'];
		}

		$this->add_render_attribute( 'video-attr', $video_attr );

		?>
        <div class="wcf--video-mask">
            <button class="video--btn">
                <span class="icon"><?php Icons_Manager::render_icon( $settings['play_icon'], [ 'aria-hidden' => 'true' ] ); ?></span>
                <span class="title open-title"><?php $this->print_unescaped_setting( 'title' ); ?></span>
                <span class="title close-title"><?php $this->print_unescaped_setting( 'close_title' ); ?></span>
            </button>
            <div class="video-wrapper">
                <video <?php $this->print_render_attribute_string('video-attr'); ?>></video>
            </div>
        </div>
		<?php
	}
}
