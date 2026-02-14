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

class Arolax_Draggable_Item extends \Elementor\Widget_Base {

	public function get_name() {
		return 'arolax--draggable-item';
	}

	public function get_title() {
		return esc_html__( 'arolax Draggable Item', 'arolax-essential' );
	}

	public function get_icon() {
		return 'wcf eicon-button';
	}

	public function get_categories() {
		return [ 'weal-coder-addon' ];
	}

	public function get_script_depends() {
		wp_register_script( 'arolax-draggable', AROLAX_ESSENTIAL_ASSETS_URL . 'js/widgets/arolax-draggable.js', [ 'jquery' ], false, true );

		return [ 'jquery-ui-draggable', 'arolax-draggable' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Draggable Item', 'arolax-essential' ),
			]
		);

		$repeater = new REPEATER();

		$repeater->add_control(
			'item_title',
			[
				'label'   => esc_html__( 'Title', 'arolax-essential' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Technology', 'arolax-essential' ),
			]
		);

		$repeater->add_control(
			'item_link',
			[
				'label'       => esc_html__( 'Link', 'arolax-essential' ),
				'type'        => Controls_Manager::URL,
				'options'     => [ 'url', 'is_external', 'nofollow' ],
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'title_color',
			[
				'label'     => esc_html__( 'Text Color', 'arolax-essential' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'color: {{VALUE}}',
				],
			]
		);

		$repeater->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'item_bg',
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}',
			]
		);

		$repeater->add_responsive_control(
			'item_rotate',
			[
				'label'      => esc_html__( 'Rotate', 'arolax-essential' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min' => - 180,
						'max' => 180,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'transform: rotate({{SIZE}}deg);',
				],
			]
		);

		$this->add_control(
			'item_list',
			[
				'label'       => esc_html__( 'Item', 'arolax-essential' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[
						'item_title' => esc_html__( 'Technology', 'arolax-essential' ),
					],
					[
						'item_title' => esc_html__( 'Manufacturing', 'arolax-essential' ),
					],
					[
						'item_title' => esc_html__( 'Insurance', 'arolax-essential' ),
					],
					[
						'item_title' => esc_html__( 'Transportation', 'arolax-essential' ),
					],
					[
						'item_title' => esc_html__( 'Entertainment', 'arolax-essential' ),
					],
				],
				'title_field' => '{{{ item_title }}}',
			]
		);

		$this->end_controls_section();


		// Style
		$this->start_controls_section(
			'sec_style_draggable_item',
			[
				'label' => esc_html__( 'Draggable Item', 'arolax-essential' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'item_typo',
				'selector' => '{{WRAPPER}} .drag--item',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'item_border',
				'selector' => '{{WRAPPER}} .drag--item',
			]
		);

		$this->add_responsive_control(
			'border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'arolax-essential' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .drag--item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'item_padding',
			[
				'label' => esc_html__( 'Padding', 'arolax-essential' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .drag--item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'item_margin',
			[
				'label' => esc_html__( 'Margin', 'arolax-essential' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .drag--item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		?>
        <style>
            .draggable--items {
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
            }

            .drag--item {
                display: inline-block;
                padding: 14px 20px 13px;
                border-radius: 50px;
                background-color: #FFC3C3;
            }

            .drag--item:nth-child(1) {
                transform: rotate(15deg);
            }

            .drag--item:nth-child(4) {
                transform: rotate(15deg);
            }

            .drag--item:nth-child(3) {
                transform: rotate(-15deg);
            }

            .drag--item:nth-child(7) {
                transform: rotate(10deg);
            }

            .drag--item:nth-child(10) {
                transform: rotate(-5deg);
            }
        </style>

        <div class="draggable--items">
			<?php
			if ( $settings['item_list'] ) {
				foreach ( $settings['item_list'] as $index => $item ) {

					$link_key = 'link_' . $index;

					if ( ! empty( $item['item_link']['url'] ) ) {
						$this->add_link_attributes( $link_key, $item['item_link'] );
					}

					?>
                    <a <?php $this->print_render_attribute_string( $link_key ); ?>
                            class="drag--item elementor-repeater-item-<?php echo esc_attr( $item['_id'] ) ?>">
						<?php echo esc_html( $item['item_title'] ); ?>
                    </a>
					<?php
				}
			}
			?>
        </div>
		<?php
	}

}