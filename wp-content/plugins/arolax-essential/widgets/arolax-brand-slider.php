<?php

namespace ArolaxEssentialApp\Widgets;

use Elementor\Control_Media;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Plugin;
use Elementor\Repeater;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;


if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

/**
 * BrandSlider
 *
 * Elementor widget for brand slider.
 *
 * @since 1.0.0
 */
class Arolax_Brand_Slider extends Widget_Base
{

    /**
     * Retrieve the widget name.
     *
     * @return string Widget name.
     * @since 1.0.0
     *
     * @access public
     */
    public function get_name()
    {
        return 'arolax--brand-slider';
    }

    /**
     * Retrieve the widget title.
     *
     * @return string Widget title.
     * @since 1.0.0
     *
     * @access public
     */
    public function get_title()
    {
        return esc_html__('Arolax Brand Slider', 'arolax-essential');
    }

    /**
     * Retrieve the widget icon.
     *
     * @return string Widget icon.
     * @since 1.0.0
     *
     * @access public
     */
    public function get_icon()
    {
        return 'wcf eicon-slides';
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
    public function get_categories()
    {
        return ['weal-coder-addon'];
    }

    /**
     * Retrieve the list of scripts the widget depended on.
     *
     * Used to set scripts dependencies required to run the widget.
     *
     * @return array Widget scripts dependencies.
     * @since 1.0.0
     *
     * @access public
     */
    public function get_script_depends()
    {
        wp_register_script('arolax-brand-slider', AROLAX_ESSENTIAL_ASSETS_URL . 'js/widgets/arolax-brand-slider.js', [], false, true);
        return ['swiper', 'arolax-brand-slider'];
    }

    /**
     * Retrieve the list of scripts the widget depended on.
     *
     * Used to set scripts dependencies required to run the widget.
     *
     * @return array Widget scripts dependencies.
     * @since 1.0.0
     *
     * @access public
     */
    public function get_style_depends()
    {
        wp_register_style('arolax-brand-slider', AROLAX_ESSENTIAL_ASSETS_URL . 'css/arolax-brand-slider.css');
        return ['swiper', 'arolax-brand-slider'];
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
    protected function register_controls()
    {
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__('Brand Slider', 'arolax-essential'),
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'separator' => 'none',
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'brand_title',
            [
                'label' => esc_html__('Title', 'arolax-essential'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Designer', 'arolax-essential'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'brand_image',
            [
                'label' => esc_html__('Choose Image', 'arolax-essential'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'brand_list',
            [
                'label' => esc_html__('Brand List', 'arolax-essential'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'list_text' => esc_html__('Content', 'arolax-essential'),
                    ],
                    [
                        'list_text' => esc_html__('(Health Advisor & Coach)', 'arolax-essential'),
                    ],
                    [
                        'list_text' => esc_html__('News', 'arolax-essential'),
                    ],
                    [
                        'list_text' => esc_html__('Creative Director', 'arolax-essential'),
                    ],
                ],
                'title_field' => '{{{ brand_title }}}',//phpcs:ignore
            ]
        );

        $this->end_controls_section();

        $this->slider_controls();

        // Item style
        $this->start_controls_section(
            'section_item',
            [
                'label' => esc_html__('item', 'arolax-essential'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'padding',
            [
                'label' => esc_html__('Padding', 'arolax-essential'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'default' => [
                    'top' => 2,
                    'right' => 0,
                    'bottom' => 2,
                    'left' => 0,
                    'unit' => 'em',
                    'isLinked' => false,
                ],
                'selectors' => [
                    '{{WRAPPER}} .brand-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'item_background',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .brand-item',
            ]
        );
        $this->end_controls_section();

        //image style control
        $this->slider_image_style_controls();

        //text style control
        $this->slider_text_style_controls();


    }

    /**
     * Register the slider controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     *
     * @access private
     */
    private function slider_controls()
    {
        $this->start_controls_section(
            'section_slider_options',
            [
                'label' => esc_html__('Slider Options', 'arolax-essential'),
            ]
        );

        $slides_to_show = range(1, 10);
        $slides_to_show = array_combine($slides_to_show, $slides_to_show);

        $this->add_responsive_control(
            'slides_to_show',
            [
                'label' => esc_html__('Slides to Show', 'arolax-essential'),
                'type' => Controls_Manager::SELECT,
                'default' => '3',
                'required' => true,
                'options' => [
                        'auto' => esc_html__('Auto', 'arolax-essential'),
                    ] + $slides_to_show,
                'render_type' => 'template',
                'selectors' => [
                    '{{WRAPPER}}' => '--slides-to-show: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label' => esc_html__('Autoplay', 'arolax-essential'),
                'type' => Controls_Manager::SELECT,
                'default' => 'yes',
                'options' => [
                    'yes' => esc_html__('Yes', 'arolax-essential'),
                    'no' => esc_html__('No', 'arolax-essential'),
                ],
            ]
        );

        $this->add_control(
            'autoplay_delay',
            [
                'label' => esc_html__('Autoplay delay', 'arolax-essential'),
                'type' => Controls_Manager::NUMBER,
                'default' => 3000,
                'condition' => [
                    'autoplay' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'autoplay_interaction',
            [
                'label' => esc_html__('Autoplay Interaction', 'arolax-essential'),
                'type' => Controls_Manager::SELECT,
                'default' => 'true',
                'options' => [
                    'true' => esc_html__('Yes', 'arolax-essential'),
                    'false' => esc_html__('No', 'arolax-essential'),
                ],
                'condition' => [
                    'autoplay' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'allow_touch_move',
            [
                'label' => esc_html__('Allow Touch Move', 'arolax-essential'),
                'type' => Controls_Manager::SELECT,
                'separator' => 'before',
                'default' => 'false',
                'options' => [
                    'true' => esc_html__('Yes', 'arolax-essential'),
                    'false' => esc_html__('No', 'arolax-essential'),
                ],
            ]
        );

        // Loop requires a re-render so no 'render_type = none'
        $this->add_control(
            'loop',
            [
                'label' => esc_html__('Loop', 'arolax-essential'),
                'type' => Controls_Manager::SELECT,
                'default' => 'true',
                'options' => [
                    'true' => esc_html__('Yes', 'arolax-essential'),
                    'false' => esc_html__('No', 'arolax-essential'),
                ],
            ]
        );

        $this->add_control(
            'speed',
            [
                'label' => esc_html__('Animation Speed', 'arolax-essential'),
                'type' => Controls_Manager::NUMBER,
                'default' => 500,
            ]
        );

        $this->add_control(
            'space_between',
            [
                'label' => esc_html__('Space Between', 'arolax-essential'),
                'type' => Controls_Manager::NUMBER,
                'default' => 20,
                'render_type' => 'template',
                'selectors' => [
                    '{{WRAPPER}}' => '--space-between: {{VALUE}}px;',
                ],
            ]
        );

        //slider navigation
        $this->add_control(
            'navigation',
            [
                'label' => esc_html__('Navigation', 'arolax-essential'),
                'type' => Controls_Manager::SELECT,
                'separator' => 'before',
                'default' => 'both',
                'options' => [
                    'both' => esc_html__('Arrows and Dots', 'arolax-essential'),
                    'arrows' => esc_html__('Arrows', 'arolax-essential'),
                    'dots' => esc_html__('Dots', 'arolax-essential'),
                    'none' => esc_html__('None', 'arolax-essential'),
                ],
            ]
        );

        $this->add_control(
            'navigation_previous_icon',
            [
                'label' => esc_html__('Previous Arrow Icon', 'arolax-essential'),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'skin' => 'inline',
                'label_block' => false,
                'skin_settings' => [
                    'inline' => [
                        'none' => [
                            'label' => 'Default',
                            'icon' => 'eicon-chevron-left',
                        ],
                        'icon' => [
                            'icon' => 'eicon-star',
                        ],
                    ],
                ],
                'recommended' => [
                    'fa-regular' => [
                        'arrow-alt-circle-left',
                        'caret-square-left',
                    ],
                    'fa-solid' => [
                        'angle-double-left',
                        'angle-left',
                        'arrow-alt-circle-left',
                        'arrow-circle-left',
                        'arrow-left',
                        'caret-left',
                        'caret-square-left',
                        'chevron-circle-left',
                        'chevron-left',
                        'long-arrow-alt-left',
                    ],
                ],
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'name' => 'navigation',
                            'operator' => '=',
                            'value' => 'both',
                        ],
                        [
                            'name' => 'navigation',
                            'operator' => '=',
                            'value' => 'arrows',
                        ],
                    ],
                ],
            ]
        );

        $this->add_control(
            'navigation_next_icon',
            [
                'label' => esc_html__('Next Arrow Icon', 'arolax-essential'),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'skin' => 'inline',
                'label_block' => false,
                'skin_settings' => [
                    'inline' => [
                        'none' => [
                            'label' => 'Default',
                            'icon' => 'eicon-chevron-right',
                        ],
                        'icon' => [
                            'icon' => 'eicon-star',
                        ],
                    ],
                ],
                'recommended' => [
                    'fa-regular' => [
                        'arrow-alt-circle-right',
                        'caret-square-right',
                    ],
                    'fa-solid' => [
                        'angle-double-right',
                        'angle-right',
                        'arrow-alt-circle-right',
                        'arrow-circle-right',
                        'arrow-right',
                        'caret-right',
                        'caret-square-right',
                        'chevron-circle-right',
                        'chevron-right',
                        'long-arrow-alt-right',
                    ],
                ],
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'name' => 'navigation',
                            'operator' => '=',
                            'value' => 'both',
                        ],
                        [
                            'name' => 'navigation',
                            'operator' => '=',
                            'value' => 'arrows',
                        ],
                    ],
                ],
            ]
        );

        $this->add_control(
            'direction',
            [
                'label' => esc_html__('Direction', 'arolax-essential'),
                'type' => Controls_Manager::SELECT,
                'separator' => 'before',
                'default' => 'ltr',
                'options' => [
                    'ltr' => esc_html__('Left', 'arolax-essential'),
                    'rtl' => esc_html__('Right', 'arolax-essential'),
                ],
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Register the slider image style controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     *
     * @access private
     */
    private function slider_image_style_controls()
    {
        $this->start_controls_section(
            'section_style_image',
            [
                'label' => esc_html__('Image', 'arolax-essential'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'img_padding',
            [
                'label' => esc_html__('Padding', 'arolax-essential'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'default' => [
                    'top' => 2,
                    'right' => 0,
                    'bottom' => 2,
                    'left' => 0,
                    'unit' => 'em',
                    'isLinked' => false,
                ],
                'selectors' => [
                    '{{WRAPPER}} .brand-image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'img_width',
            [
                'label' => esc_html__('Width', 'arolax-essential'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 50,
                ],
                'selectors' => [
                    '{{WRAPPER}} .brand-image img' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'image_border',
                'selector' => '{{WRAPPER}} .brand-image img',
            ]
        );

        $this->add_responsive_control(
            'image_border_radius',
            [
                'label' => esc_html__('Border Radius', 'arolax-essential'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .brand-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Register the slider text style controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     *
     * @access private
     */

    private function slider_text_style_controls()
    {
        $this->start_controls_section(
            'section_style_text',
            [
                'label' => esc_html__('Text', 'arolax-essential'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Text Color', 'arolax-essential'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .brand-title' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'typography',
                'selector' => '{{WRAPPER}} .brand-title',
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
    protected function render()
    {
        $settings = $this->get_settings_for_display();

        if (empty($settings['brand_list'])) {
            return;
        }

        //slider settings
        $show_dots = (in_array($settings['navigation'], ['dots', 'both']));
        $show_arrows = (in_array($settings['navigation'], ['arrows', 'both']));

        $slider_settings = [
            'loop' => $settings['loop'],
            'speed' => $settings['speed'],
            'allowTouchMove' => $settings['allow_touch_move'],
            'slidesPerView' => $settings['slides_to_show'],
            'spaceBetween' => $settings['space_between'],
        ];

        if ('yes' === $settings['autoplay']) {
            $slider_settings['autoplay'] = [
                'delay' => $settings['autoplay_delay'],
                'disableOnInteraction' => $settings['autoplay_interaction'],
            ];
        }

        if ($show_arrows) {
            $slider_settings['navigation'] = [
                'nextEl' => '.elementor-element-' . $this->get_id() . ' .wcf-arrow-next',
                'prevEl' => '.elementor-element-' . $this->get_id() . ' .wcf-arrow-prev',
            ];
        }

        if ($show_dots) {
            $slider_settings['pagination'] = [
                'el' => '.elementor-element-' . $this->get_id() . ' .swiper-pagination',
                'clickable' => true,
            ];
        }

        //slider breakpoints
        $active_breakpoints = Plugin::$instance->breakpoints->get_active_breakpoints();

        foreach ( $active_breakpoints as $breakpoint_name => $breakpoint ) {
            $slides_to_show = ! empty( $settings[ 'slides_to_show_' . $breakpoint_name ] ) ? $settings[ 'slides_to_show_' . $breakpoint_name ] : $settings['slides_to_show'];
            $space_between = ! empty( $settings[ 'space_between_' . $breakpoint_name ] ) ? $settings[ 'space_between_' . $breakpoint_name ] : $settings['space_between'];

            $slider_settings['breakpoints'][ $breakpoint->get_value() ]['slidesPerView'] = $slides_to_show;
            $slider_settings['breakpoints'][ $breakpoint->get_value() ]['spaceBetween'] = $space_between;
        }


        $this->add_render_attribute(
            'wrapper',
            [
                'class' => ['arolax--brand-slider-wrapper'],
                'data-settings' => json_encode($slider_settings), //phpcs:ignore
            ]
        );


        $this->add_render_attribute(
            'carousel-wrapper',
            [
                'class' => 'arolax__slider swiper',
                'style' => 'position: static',
            ]
        );
        ?>
        <div <?php $this->print_render_attribute_string('wrapper'); ?>>
            <div <?php $this->print_render_attribute_string('carousel-wrapper'); ?>>
                <div class="swiper-wrapper">
                    <?php foreach ($settings['brand_list'] as $brand) : ?>
                        <div class="swiper-slide">
                            <div class="brand-item">
                                <h4 class="brand-title"><?php echo esc_html($brand['brand_title']) ?></h4>
                                <div class="brand-image">
                                    <?php
                                    $image_url = Group_Control_Image_Size::get_attachment_image_src($brand['brand_image']['id'], 'thumbnail', $settings);

                                    if (!$image_url && isset($brand['brand_image']['url'])) {
                                        $image_url = $brand['brand_image']['url'];
                                    }
                                    $image_html = '<img class="swiper-slide-image" src="' . esc_url($image_url) . '" alt="' . esc_attr(Control_Media::get_image_alt ($brand['brand_image'])) . '" />';

                                    echo wp_kses_post($image_html);
                                    ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- navigation and pagination -->
            <?php if (1 < count($settings['brand_list'])) : ?>
                <?php if ($show_arrows) : ?>
                    <div class="ts-navigation">
                        <div class="wcf-arrow wcf-arrow-prev" role="button" tabindex="0">
                            <?php $this->render_swiper_button('previous'); ?>
                        </div>
                        <div class="wcf-arrow wcf-arrow-next" role="button" tabindex="0">
                            <?php $this->render_swiper_button('next'); ?>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if ($show_dots) : ?>
                    <div class="ts-pagination">
                        <div class="swiper-pagination"></div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
        <?php
    }

    /**
     * Render swiper button.
     *
     * @since 1.0.0
     *
     * @access private
     */
    private function render_swiper_button($type)
    {
        $direction = 'next' === $type ? 'right' : 'left';
        $icon_settings = $this->get_settings_for_display('navigation_' . $type . '_icon');

        if (empty($icon_settings['value'])) {
            $icon_settings = [
                'library' => 'eicons',
                'value' => 'eicon-chevron-' . $direction,
            ];
        }

        Icons_Manager::render_icon($icon_settings, ['aria-hidden' => 'true']);
    }

}
