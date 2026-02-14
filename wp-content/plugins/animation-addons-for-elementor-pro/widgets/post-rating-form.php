<?php

namespace WCFAddonsPro\Widgets;

use Elementor\Controls_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Utils;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Post_Rating_Form extends Widget_Base {

	public function get_name() {
		return 'aae--post-rating-form';
	}

	public function get_title() {
		return esc_html__( 'Post Rating Form', 'animation-addons-for-elementor' );
	}

	public function get_icon() {
		return 'wcf eicon-rating';
	}

	public function get_categories() {
		return [ 'animation-addons-for-elementor' ];
	}

	public function get_keywords() {
		return [ 'rating', 'review', 'feedback', 'form' ];
	}

	/**
	 * Requires css files.
	 *
	 * @return array
	 */
	public function get_style_depends() {
		return [ 'aae-post-rating' ];
	}

	public function get_script_depends() {
		return [ 'aae-post-rating' ];
	}

	protected function register_controls() {

		$this->register_rating_content_controls();

		$this->register_rating_form_controls();
	}

	protected function register_rating_content_controls() {
		$this->start_controls_section(
			'section_rating_content',
			[
				'label' => esc_html__( 'Content', 'animation-addons-for-elementor' ),
			]
		);

		$this->add_control(
			'title',
			[
				'label'       => esc_html__( 'Title', 'animation-addons-for-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => false,
				'default'     => esc_html__( 'How useful was this post?', 'animation-addons-for-elementor' ),
				'placeholder' => esc_html__( 'Type your title here', 'animation-addons-for-elementor' ),
			]
		);

		$this->add_control(
			'title_tag',
			[
				'label'   => esc_html__( 'Title HTML Tag', 'animation-addons-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
				],
				'default' => 'h3',
			]
		);

		$this->add_control(
			'text',
			[
				'label'       => esc_html__( 'Text', 'animation-addons-for-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => false,
				'default'     => esc_html__( 'click on the star to rate it.', 'animation-addons-for-elementor' ),
				'placeholder' => esc_html__( 'Type your text here', 'animation-addons-for-elementor' ),
			]
		);

		$this->add_responsive_control(
			'alignment',
			[
				'label'     => esc_html__( 'Alignment', 'animation-addons-for-elementor' ),
				'type'      => Controls_Manager::CHOOSE,
				'toggle'    => false,
				'default'   => 'center',
				'options'   => [
					'left'   => [
						'title' => esc_html__( 'Left', 'animation-addons-for-elementor' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'animation-addons-for-elementor' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right'  => [
						'title' => esc_html__( 'Right', 'animation-addons-for-elementor' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .aae--post-rating-form, {{WRAPPER}} .rating' => 'text-align: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);

		$this->end_controls_section();

		// Style Title
		$this->start_controls_section(
			'style_title',
			[
				'label' => esc_html__( 'Title', 'animation-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__( 'Color', 'animation-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .title' => 'color: {{VALUE}}',
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
				'label'      => esc_html__( 'Margin', 'animation-addons-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Style Text
		$this->start_controls_section(
			'style_text',
			[
				'label' => esc_html__( 'Text', 'animation-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'text_color',
			[
				'label'     => esc_html__( 'Color', 'animation-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .text' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'text_typo',
				'selector' => '{{WRAPPER}} .text',
			]
		);

		$this->add_responsive_control(
			'text_margin',
			[
				'label'      => esc_html__( 'Margin', 'animation-addons-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function register_rating_form_controls() {
		$this->start_controls_section(
			'section_rating_form',
			[
				'label' => esc_html__( 'Form', 'animation-addons-for-elementor' ),
			]
		);

		$this->add_control(
			'rating_icon',
			[
				'label'       => esc_html__( 'Rating Icon', 'animation-addons-for-elementor' ),
				'type'        => Controls_Manager::ICONS,
				'skin'        => 'inline',
				'label_block' => false,
				'default'     => [
					'value'   => 'fas fa-star',
					'library' => 'fa-solid',
				],
			]
		);

		$this->add_control(
			'show_review',
			[
				'label'        => esc_html__( 'Show Review', 'animation-addons-for-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'animation-addons-for-elementor' ),
				'label_off'    => esc_html__( 'Hide', 'animation-addons-for-elementor' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'review_placeholder',
			[
				'label'       => esc_html__( 'Review Placeholder', 'animation-addons-for-elementor' ),
				'type'        => Controls_Manager::TEXTAREA,
				'label_block' => true,
				'default'     => esc_html__( 'Write your review...', 'animation-addons-for-elementor' ),
				'placeholder' => esc_html__( 'Type your placeholder here', 'animation-addons-for-elementor' ),
				'condition'   => [ 'show_review' => 'yes' ],
			]
		);

		$this->add_control(
			'btn_text',
			[
				'label'       => esc_html__( 'Button Text', 'animation-addons-for-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => false,
				'default'     => esc_html__( 'Submit', 'animation-addons-for-elementor' ),
				'placeholder' => esc_html__( 'Type your button text here', 'animation-addons-for-elementor' ),
			]
		);

		$this->end_controls_section();

		// Style Rating
		$this->start_controls_section(
			'style_rating',
			[
				'label' => esc_html__( 'Rating', 'animation-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'rating_color',
			[
				'label'     => esc_html__( 'Normal Color', 'animation-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rating' => 'color: {{VALUE}}; fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'rating_fill_color',
			[
				'label'     => esc_html__( 'Fill Color', 'animation-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rating label:hover, {{WRAPPER}} .rating label:hover ~ label, {{WRAPPER}} .rating input:checked + label, {{WRAPPER}} .rating input:checked + label ~ label ' => 'color: {{VALUE}}; fill: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'rating_icon_size',
			[
				'label'      => esc_html__( 'Icon Size', 'animation-addons-for-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rating' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'rating_icon_gap',
			[
				'label'      => esc_html__( 'Icon Gap', 'animation-addons-for-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min' => - 50,
						'max' => 50,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rating label' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);


		$this->add_responsive_control(
			'rating_margin',
			[
				'label'      => esc_html__( 'Margin', 'animation-addons-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .rating' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Style Review
		$this->start_controls_section(
			'style_review',
			[
				'label'     => esc_html__( 'Review', 'animation-addons-for-elementor' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [ 'show_review' => 'yes' ],
			]
		);
		$this->add_control(
			'review_color',
			[
				'label'     => esc_html__( 'Color', 'animation-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .review' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'review_plh_color',
			[
				'label'     => esc_html__( 'Placeholder Color', 'animation-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .review::placeholder' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'review_typo',
				'selector' => '{{WRAPPER}} .review',
			]
		);

		$this->add_control(
			'review_width',
			[
				'label'      => esc_html__( 'Width', 'animation-addons-for-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default'    => [
					'unit' => '%',
					'size' => 50,
				],
				'selectors'  => [
					'{{WRAPPER}} .review' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'review_border',
				'selector' => '{{WRAPPER}} .review',
			]
		);

		$this->add_responsive_control(
			'review_b_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'animation-addons-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .review' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'review_padding',
			[
				'label'      => esc_html__( 'Padding', 'animation-addons-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .review' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->end_controls_section();

		// Style Button
		$this->start_controls_section(
			'style_button',
			[
				'label' => esc_html__( 'Button', 'animation-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'btn_typo',
				'selector' => '{{WRAPPER}} .submit-btn',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'btn_bg',
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .submit-btn',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'btn_border',
				'selector' => '{{WRAPPER}} .submit-btn',
			]
		);

		$this->add_responsive_control(
			'btn_b_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'animation-addons-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .submit-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'btn_padding',
			[
				'label'      => esc_html__( 'Padding', 'animation-addons-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .submit-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Hover Tabs
		$this->start_controls_tabs(
			'style_btn_tabs'
		);

		// Normal
		$this->start_controls_tab(
			'btn_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'animation-addons-for-elementor' ),
			]
		);

		$this->add_control(
			'btn_color',
			[
				'label'     => esc_html__( 'Color', 'animation-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .submit-btn' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		// Hover
		$this->start_controls_tab(
			'btn_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'animation-addons-for-elementor' ),
			]
		);

		$this->add_control(
			'btn_h_color',
			[
				'label'     => esc_html__( 'Color', 'animation-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .submit-btn:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'btn_h_bg',
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .submit-btn:hover',
			]
		);

		$this->add_control(
			'btn_h_b_color',
			[
				'label'     => esc_html__( 'Border Color', 'animation-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .submit-btn:hover' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'btn_margin',
			[
				'label'      => esc_html__( 'Margin', 'animation-addons-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .submit-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'  => 'before',
			]
		);

		$this->end_controls_section();

		// Style Success Message
		$this->start_controls_section(
			'style_success_message',
			[
				'label' => esc_html__( 'Success Message', 'animation-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'success_color',
			[
				'label'     => esc_html__( 'Color', 'animation-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} #aae-review-success-message p' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'success_typo',
				'selector' => '{{WRAPPER}} #aae-review-success-message p',
			]
		);

		$this->add_responsive_control(
			'success_margin',
			[
				'label'      => esc_html__( 'Margin', 'animation-addons-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} #aae-review-success-message' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'  => 'before',
			]
		);

		$this->end_controls_section();

		// Style Error Message
		$this->start_controls_section(
			'style_error_message',
			[
				'label' => esc_html__( 'Error Message', 'animation-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'error_color',
			[
				'label'     => esc_html__( 'Color', 'animation-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} #aae-review-error-message p' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'error_typo',
				'selector' => '{{WRAPPER}} #aae-review-error-message p',
			]
		);

		$this->add_responsive_control(
			'error_margin',
			[
				'label'      => esc_html__( 'Margin', 'animation-addons-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} #aae-review-error-message' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'  => 'before',
			]
		);

		$this->end_controls_section();
	}


	// Render
	protected function render() {
		$settings = $this->get_settings_for_display();
		$post_id  = get_the_ID();

		?>
        <div class="aae--post-rating-form">
        <<?php Utils::print_validated_html_tag( $settings['title_tag'] ); ?> class="title">
		<?php echo esc_html( $settings['title'] ); ?>
        </<?php Utils::print_validated_html_tag( $settings['title_tag'] ); ?>>
        <p class="text"><?php echo esc_html( $settings['text'] ); ?></p>
        <div class="rating-form">
            <input type="hidden" id="post_id" value="<?php echo $post_id; ?>">
            <div class="rating">
				<?php
				for ( $i = 5; $i >= 1; $i -- ) {
					?>
                    <input id="rating-<?php echo $i; ?>" type="radio" name="rating" value="<?php echo $i; ?>">
                    <label for="rating-<?php echo $i; ?>">
						<?php Icons_Manager::render_icon( $settings['rating_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                    </label>
					<?php
				}
				?>
            </div>

            <div class="review-message">
                <input type="hidden" id="selected_rating" value="">
                <textarea name="review" id="review_text" class="review"
                          placeholder="<?php echo esc_attr( $settings['review_placeholder'] ); ?>"></textarea>
            </div>

            <button type="submit" id="aae-post-rating-btn" class="submit-btn">
				<?php echo esc_html( $settings['btn_text'] ); ?>
            </button>
        </div>

        <div id="aae-review-success-message"></div>
        <div id="aae-review-error-message"></div>
        </div>
		<?php
	}
}
