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

class Post_Rating extends Widget_Base {

	public function get_name() {
		return 'aae--post-rating';
	}

	public function get_title() {
		return esc_html__( 'Post Rating', 'animation-addons-for-elementor' );
	}

	public function get_icon() {
		return 'wcf eicon-rating';
	}

	public function get_categories() {
		return [ 'animation-addons-for-elementor' ];
	}

	public function get_keywords() {
		return [ 'rating', 'review', 'feedback' ];
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
		$this->register_rating_controls();

		$this->register_rating_style();
	}

	protected function register_rating_controls() {
		$this->start_controls_section(
			'section_rating_layout',
			[
				'label' => esc_html__( 'Layout', 'animation-addons-for-elementor' ),
			]
		);

		$this->add_control(
			'rating_layout',
			[
				'label'   => esc_html__( 'Layout', 'animation-addons-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'average-rating',
				'options' => [
					'average-rating' => esc_html__( 'Average Rating', 'animation-addons-for-elementor' ),
				],
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

		$this->add_responsive_control(
			'alignment',
			[
				'label'     => esc_html__( 'Alignment', 'animation-addons-for-elementor' ),
				'type'      => Controls_Manager::CHOOSE,
				'toggle'    => false,
				'default'   => 'start',
				'options'   => [
					'start'  => [
						'title' => esc_html__( 'Left', 'animation-addons-for-elementor' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'animation-addons-for-elementor' ),
						'icon'  => 'eicon-text-align-center',
					],
					'end'    => [
						'title' => esc_html__( 'Right', 'animation-addons-for-elementor' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .average-rating' => 'justify-self: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);

		$this->end_controls_section();
	}

	protected function register_rating_style() {

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
				'label'     => esc_html__( 'Color', 'animation-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rating' => 'color: {{VALUE}}; fill: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'rating_typo',
				'selector' => '{{WRAPPER}} .rating',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'rating_border',
				'selector' => '{{WRAPPER}} .rating',
			]
		);

		$this->add_responsive_control(
			'rating_b_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'animation-addons-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .rating' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'rating_padding',
			[
				'label'      => esc_html__( 'Padding', 'animation-addons-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .rating' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'circle_size',
			[
				'label'      => esc_html__( 'Circle Size', 'animation-addons-for-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rating' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'rating_icon_gap',
			[
				'label'      => esc_html__( 'Gap', 'animation-addons-for-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rating' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'Rating_icon_heading',
			[
				'label' => esc_html__( 'Icon', 'animation-addons-for-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'rating_icon_color',
			[
				'label'     => esc_html__( 'Color', 'animation-addons-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rating .icon' => 'color: {{VALUE}}; fill: {{VALUE}};',
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
					'{{WRAPPER}} .rating .icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}


	// Render
	protected function render() {
		$settings = $this->get_settings_for_display();
		$post_id  = get_the_ID();

		$this->add_render_attribute( 'wrapper', 'class', 'aae--post-rating ' . $settings['rating_layout'] );

		?>
        <div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
			<?php
			if ( 'average-rating' === $settings['rating_layout'] ) {
				$this->render_average_post_rating( $settings );
			}
			?>
        </div>
		<?php
	}


	protected function render_average_post_rating( $settings ) {
		$post_id = get_the_ID();

		$ratings = get_posts( [
			'post_type'  => 'aaeaddon_post_rating',
			'meta_query' => [
				[
					'key'   => 'post_id',
					'value' => $post_id,
				]
			]
		] );

		$total_ratings = count( $ratings );
		$total_stars   = 0;

		foreach ( $ratings as $rating ) {
			$total_stars += get_post_meta( $rating->ID, 'rating', true );
		}

		$average_rating = $total_ratings > 0 ? round( $total_stars / $total_ratings, 1 ) : 'No ratings yet.';
		?>
        <div class="rating-item">
            <div class="rating">
                <div class="icon">
					<?php Icons_Manager::render_icon( $settings['rating_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                </div>
                <p>
                    <span><?php echo $average_rating; ?></span>/<?php echo esc_html__( '5', 'animation-addons-for-elementor' ); ?>
                </p>
            </div>
        </div>
		<?php
	}


}
