<?php

namespace AngieSnippets;
if ( ! defined( 'ABSPATH' ) ) { exit; }

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Repeater;

class Brand_Logo_Tabs_8ac671e4 extends Widget_Base {
    public function get_name() { return 'brand_logo_tabs_8ac671e4'; }
    public function get_title() { return esc_html__( 'Brand Logo Tabs', 'angie-snippets' ); }
    public function get_icon() { return 'eicon-logo'; }
    public function get_categories() { return [ 'angie-widgets', 'general' ]; }
    public function get_script_depends() { return [ 'brand-logo-tabs-script-8ac671e4' ]; }
    public function get_style_depends() { return [ 'brand-logo-tabs-style-8ac671e4' ]; }

    protected function register_controls() {
        // --- CONTENT TAB ---
        $this->start_controls_section(
            'section_header',
            [
                'label' => esc_html__( 'Header', 'angie-snippets' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'show_header',
            [
                'label' => esc_html__( 'Show Header', 'angie-snippets' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'angie-snippets' ),
                'label_off' => esc_html__( 'Hide', 'angie-snippets' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'header_title',
            [
                'label' => esc_html__( 'Title', 'angie-snippets' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Logos', 'angie-snippets' ),
                'condition' => [
                    'show_header' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'header_see_all_text',
            [
                'label' => esc_html__( 'See All Text', 'angie-snippets' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'See All', 'angie-snippets' ),
                'condition' => [
                    'show_header' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'header_see_all_url',
            [
                'label' => esc_html__( 'See All URL', 'angie-snippets' ),
                'type' => Controls_Manager::URL,
                'placeholder' => esc_html__( 'https://your-link.com', 'angie-snippets' ),
                'condition' => [
                    'show_header' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'show_arrow',
            [
                'label' => esc_html__( 'Show Arrow', 'angie-snippets' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'angie-snippets' ),
                'label_off' => esc_html__( 'Hide', 'angie-snippets' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'show_header' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'header_alignment',
            [
                'label' => esc_html__( 'Header Alignment', 'angie-snippets' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__( 'Left', 'angie-snippets' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'angie-snippets' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'flex-end' => [
                        'title' => esc_html__( 'Right', 'angie-snippets' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'flex-start',
                'selectors' => [
                    '{{WRAPPER}} .blt-8ac671e4-header-container' => 'justify-content: {{VALUE}};',
                ],
                'condition' => [
                    'show_header' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

        // TABS SECTION
        $this->start_controls_section(
            'section_tabs',
            [
                'label' => esc_html__( 'Tabs', 'angie-snippets' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $tabs_repeater = new Repeater();

        $tabs_repeater->add_control(
            'tab_name',
            [
                'label' => esc_html__( 'Tab Name', 'angie-snippets' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Tab Title', 'angie-snippets' ),
            ]
        );

        $tabs_repeater->add_control(
            'tab_id',
            [
                'label' => esc_html__( 'Tab ID (slug, lowercase, unique)', 'angie-snippets' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'lifestyle', 'angie-snippets' ),
            ]
        );

        $this->add_control(
            'tabs_list',
            [
                'label' => esc_html__( 'Tabs', 'angie-snippets' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $tabs_repeater->get_controls(),
                'default' => [
                    [ 'tab_name' => 'All', 'tab_id' => 'all' ],
                    [ 'tab_name' => 'Lifestyle', 'tab_id' => 'lifestyle' ],
                    [ 'tab_name' => 'Footwear', 'tab_id' => 'footwear' ],
                    [ 'tab_name' => 'FNB', 'tab_id' => 'fnb' ],
                    [ 'tab_name' => 'Jewellery', 'tab_id' => 'jewellery' ],
                    [ 'tab_name' => 'Electronics', 'tab_id' => 'electronics' ],
                    [ 'tab_name' => 'Watches', 'tab_id' => 'watches' ],
                ],
                'title_field' => '{{{ tab_name }}} ({{{ tab_id }}})',
            ]
        );

        $this->end_controls_section();

        // LOGOS SECTION
        $this->start_controls_section(
            'section_logos',
            [
                'label' => esc_html__( 'Logos', 'angie-snippets' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $logos_repeater = new Repeater();

        $logos_repeater->add_control(
            'brand_name',
            [
                'label' => esc_html__( 'Group Name / Label', 'angie-snippets' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Logo Group', 'angie-snippets' ),
            ]
        );

        $logos_repeater->add_control(
            'logos_gallery',
            [
                'label' => esc_html__( 'Logos Gallery (Add Multiple Images)', 'angie-snippets' ),
                'type' => Controls_Manager::GALLERY,
                'default' => [],
            ]
        );

        $logos_repeater->add_control(
            'category',
            [
                'label' => esc_html__( 'Category (Tab ID)', 'angie-snippets' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'lifestyle',
                'description' => esc_html__( 'Enter the Tab ID these logos belong to (e.g. lifestyle).', 'angie-snippets' ),
            ]
        );

        $this->add_control(
            'logos_list',
            [
                'label' => esc_html__( 'Logo Groups', 'angie-snippets' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $logos_repeater->get_controls(),
                'default' => [
                    [ 'brand_name' => 'Lifestyle Group', 'category' => 'lifestyle' ],
                    [ 'brand_name' => 'Footwear Group', 'category' => 'footwear' ],
                ],
                'title_field' => '{{{ brand_name }}} ({{{ category }}})',
            ]
        );

        $this->end_controls_section();


        // --- STYLE TAB ---
        // 1. HEADER STYLE
        $this->start_controls_section(
            'section_style_header',
            [
                'label' => esc_html__( 'Header', 'angie-snippets' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_header' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'header_title_color',
            [
                'label' => esc_html__( 'Title Color', 'angie-snippets' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#111111',
                'selectors' => [
                    '{{WRAPPER}} .blt-8ac671e4-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'header_title_typography',
                'selector' => '{{WRAPPER}} .blt-8ac671e4-title',
            ]
        );

        $this->add_control(
            'see_all_color',
            [
                'label' => esc_html__( 'See All Color', 'angie-snippets' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#111111',
                'selectors' => [
                    '{{WRAPPER}} .blt-8ac671e4-see-all' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'see_all_hover_color',
            [
                'label' => esc_html__( 'See All Hover Color', 'angie-snippets' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#ff3333',
                'selectors' => [
                    '{{WRAPPER}} .blt-8ac671e4-see-all:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'see_all_typography',
                'selector' => '{{WRAPPER}} .blt-8ac671e4-see-all',
            ]
        );

        $this->add_control(
            'see_all_icon_color',
            [
                'label' => esc_html__( 'Icon Color', 'angie-snippets' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#ff3333',
                'selectors' => [
                    '{{WRAPPER}} .blt-8ac671e4-see-all svg' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .blt-8ac671e4-see-all-arrow' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'see_all_gap',
            [
                'label' => esc_html__( 'Gap', 'angie-snippets' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', 'rem' ],
                'range' => [
                    'px' => [ 'min' => 0, 'max' => 50 ],
                ],
                'default' => [
                    'size' => 8,
                ],
                'selectors' => [
                    '{{WRAPPER}} .blt-8ac671e4-see-all' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'divider_heading',
            [
                'label' => esc_html__( 'Divider', 'angie-snippets' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'divider_color',
            [
                'label' => esc_html__( 'Color', 'angie-snippets' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#e2e8f0',
                'selectors' => [
                    '{{WRAPPER}} .blt-8ac671e4-divider' => 'border-bottom-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'divider_thickness',
            [
                'label' => esc_html__( 'Thickness', 'angie-snippets' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [ 'min' => 1, 'max' => 10 ],
                ],
                'default' => [
                    'size' => 1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .blt-8ac671e4-divider' => 'border-bottom-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'divider_margin',
            [
                'label' => esc_html__( 'Margin', 'angie-snippets' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem' ],
                'default' => [
                    'top' => '0',
                    'bottom' => '20',
                    'left' => '0',
                    'right' => '0',
                    'unit' => 'px',
                    'isLinked' => false,
                ],
                'selectors' => [
                    '{{WRAPPER}} .blt-8ac671e4-divider' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // 2. TABS STYLE
        $this->start_controls_section(
            'section_style_tabs',
            [
                'label' => esc_html__( 'Tabs', 'angie-snippets' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'tabs_typography',
                'selector' => '{{WRAPPER}} .blt-8ac671e4-tab',
            ]
        );

        $this->add_control(
            'tab_text_color',
            [
                'label' => esc_html__( 'Text Color', 'angie-snippets' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#333333',
                'selectors' => [
                    '{{WRAPPER}} .blt-8ac671e4-tab' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'tab_active_color',
            [
                'label' => esc_html__( 'Active Color', 'angie-snippets' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#ff3333',
                'selectors' => [
                    '{{WRAPPER}} .blt-8ac671e4-tab.blt-active' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'tab_hover_color',
            [
                'label' => esc_html__( 'Hover Color', 'angie-snippets' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#ff3333',
                'selectors' => [
                    '{{WRAPPER}} .blt-8ac671e4-tab:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'tab_active_border_color',
            [
                'label' => esc_html__( 'Active Border Color', 'angie-snippets' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#ff3333',
                'selectors' => [
                    '{{WRAPPER}} .blt-8ac671e4-tab.blt-active' => 'border-bottom-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'tab_border_thickness',
            [
                'label' => esc_html__( 'Border Thickness', 'angie-snippets' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [ 'min' => 1, 'max' => 10 ],
                ],
                'default' => [
                    'size' => 3,
                ],
                'selectors' => [
                    '{{WRAPPER}} .blt-8ac671e4-tab' => 'border-bottom-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'tab_padding',
            [
                'label' => esc_html__( 'Padding', 'angie-snippets' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem' ],
                'default' => [
                    'top' => '10',
                    'bottom' => '10',
                    'left' => '15',
                    'right' => '15',
                    'unit' => 'px',
                    'isLinked' => false,
                ],
                'selectors' => [
                    '{{WRAPPER}} .blt-8ac671e4-tab' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'tab_margin',
            [
                'label' => esc_html__( 'Margin', 'angie-snippets' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem' ],
                'selectors' => [
                    '{{WRAPPER}} .blt-8ac671e4-tab' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'tab_gap',
            [
                'label' => esc_html__( 'Gap Between Tabs', 'angie-snippets' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [ 'min' => 0, 'max' => 100 ],
                ],
                'default' => [
                    'size' => 15,
                ],
                'selectors' => [
                    '{{WRAPPER}} .blt-8ac671e4-tabs-list' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'tab_radius',
            [
                'label' => esc_html__( 'Border Radius', 'angie-snippets' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem' ],
                'selectors' => [
                    '{{WRAPPER}} .blt-8ac671e4-tab' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'tab_animation_duration',
            [
                'label' => esc_html__( 'Animation Duration (ms)', 'angie-snippets' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 300,
                'selectors' => [
                    '{{WRAPPER}} .blt-8ac671e4-tab' => 'transition-duration: {{VALUE}}ms;',
                ],
            ]
        );

        $this->end_controls_section();

        // 3. LOGO CARD STYLE
        $this->start_controls_section(
            'section_style_logo_card',
            [
                'label' => esc_html__( 'Logo Card', 'angie-snippets' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'card_width',
            [
                'label' => esc_html__( 'Card Width', 'angie-snippets' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em', 'rem', 'vw' ],
                'range' => [
                    'px' => [ 'min' => 50, 'max' => 500 ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .blt-8ac671e4-logo-card' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'card_height',
            [
                'label' => esc_html__( 'Card Height', 'angie-snippets' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', 'rem', 'vh' ],
                'range' => [
                    'px' => [ 'min' => 50, 'max' => 500 ],
                ],
                'default' => [
                    'size' => 100,
                ],
                'selectors' => [
                    '{{WRAPPER}} .blt-8ac671e4-logo-card' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'card_padding',
            [
                'label' => esc_html__( 'Padding', 'angie-snippets' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem' ],
                'default' => [
                    'top' => '10',
                    'bottom' => '10',
                    'left' => '10',
                    'right' => '10',
                    'unit' => 'px',
                    'isLinked' => true,
                ],
                'selectors' => [
                    '{{WRAPPER}} .blt-8ac671e4-logo-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'card_margin',
            [
                'label' => esc_html__( 'Margin', 'angie-snippets' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem' ],
                'selectors' => [
                    '{{WRAPPER}} .blt-8ac671e4-logo-card' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'card_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'angie-snippets' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem' ],
                'default' => [
                    'top' => '8',
                    'bottom' => '8',
                    'left' => '8',
                    'right' => '8',
                    'unit' => 'px',
                    'isLinked' => true,
                ],
                'selectors' => [
                    '{{WRAPPER}} .blt-8ac671e4-logo-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'card_border',
                'selector' => '{{WRAPPER}} .blt-8ac671e4-logo-card',
            ]
        );

        $this->add_control(
            'card_background',
            [
                'label' => esc_html__( 'Background Color', 'angie-snippets' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .blt-8ac671e4-logo-card' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'card_hover_background',
            [
                'label' => esc_html__( 'Hover Background Color', 'angie-snippets' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blt-8ac671e4-logo-card:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'card_shadow',
                'selector' => '{{WRAPPER}} .blt-8ac671e4-logo-card',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'card_hover_shadow',
                'selector' => '{{WRAPPER}} .blt-8ac671e4-logo-card:hover',
            ]
        );

        $this->add_control(
            'card_hover_scale',
            [
                'label' => esc_html__( 'Hover Scale', 'angie-snippets' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [ 'min' => 0.8, 'max' => 1.5, 'step' => 0.05 ],
                ],
                'default' => [
                    'size' => 1.05,
                ],
                'selectors' => [
                    '{{WRAPPER}} .blt-8ac671e4-logo-card:hover' => 'transform: scale({{SIZE}});',
                ],
            ]
        );

        $this->add_control(
            'card_transition_duration',
            [
                'label' => esc_html__( 'Transition Duration (ms)', 'angie-snippets' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 300,
                'selectors' => [
                    '{{WRAPPER}} .blt-8ac671e4-logo-card' => 'transition-duration: {{VALUE}}ms;',
                ],
            ]
        );

        $this->end_controls_section();

        // 4. LOGO IMAGE STYLE
        $this->start_controls_section(
            'section_style_logo_image',
            [
                'label' => esc_html__( 'Logo Image', 'angie-snippets' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'image_width',
            [
                'label' => esc_html__( 'Width', 'angie-snippets' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em', 'rem' ],
                'selectors' => [
                    '{{WRAPPER}} .blt-8ac671e4-logo-card img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_height',
            [
                'label' => esc_html__( 'Height', 'angie-snippets' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em', 'rem' ],
                'selectors' => [
                    '{{WRAPPER}} .blt-8ac671e4-logo-card img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_max_width',
            [
                'label' => esc_html__( 'Max Width', 'angie-snippets' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em', 'rem' ],
                'default' => [
                    'size' => 100,
                    'unit' => '%',
                ],
                'selectors' => [
                    '{{WRAPPER}} .blt-8ac671e4-logo-card img' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'image_object_fit',
            [
                'label' => esc_html__( 'Object Fit', 'angie-snippets' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'fill' => esc_html__( 'Fill', 'angie-snippets' ),
                    'contain' => esc_html__( 'Contain', 'angie-snippets' ),
                    'cover' => esc_html__( 'Cover', 'angie-snippets' ),
                    'none' => esc_html__( 'None', 'angie-snippets' ),
                ],
                'default' => 'contain',
                'selectors' => [
                    '{{WRAPPER}} .blt-8ac671e4-logo-card img' => 'object-fit: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'angie-snippets' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem' ],
                'selectors' => [
                    '{{WRAPPER}} .blt-8ac671e4-logo-card img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // 5. GRID STYLE
        $this->start_controls_section(
            'section_style_grid',
            [
                'label' => esc_html__( 'Grid Layout', 'angie-snippets' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'grid_columns',
            [
                'label' => esc_html__( 'Columns', 'angie-snippets' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6',
                    '7' => '7',
                    '8' => '8',
                ],
                'devices' => [ 'desktop', 'tablet', 'mobile' ],
                'desktop_default' => '6',
                'tablet_default' => '5',
                'mobile_default' => '4',
                'selectors' => [
                    '{{WRAPPER}} .blt-8ac671e4-logo-grid' => 'grid-template-columns: repeat({{VALUE}}, minmax(0, 1fr));',
                ],
            ]
        );

        $this->add_responsive_control(
            'grid_column_gap',
            [
                'label' => esc_html__( 'Column Gap', 'angie-snippets' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em', 'rem' ],
                'default' => [
                    'size' => 15,
                ],
                'selectors' => [
                    '{{WRAPPER}} .blt-8ac671e4-logo-grid' => 'column-gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'grid_row_gap',
            [
                'label' => esc_html__( 'Row Gap', 'angie-snippets' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em', 'rem' ],
                'default' => [
                    'size' => 20,
                ],
                'selectors' => [
                    '{{WRAPPER}} .blt-8ac671e4-logo-grid' => 'row-gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'grid_vertical_alignment',
            [
                'label' => esc_html__( 'Vertical Alignment', 'angie-snippets' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'start' => [
                        'title' => esc_html__( 'Start', 'angie-snippets' ),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'angie-snippets' ),
                        'icon' => 'eicon-v-align-middle',
                    ],
                    'end' => [
                        'title' => esc_html__( 'End', 'angie-snippets' ),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                    'stretch' => [
                        'title' => esc_html__( 'Stretch', 'angie-snippets' ),
                        'icon' => 'eicon-v-align-stretch',
                    ],
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .blt-8ac671e4-logo-grid' => 'align-items: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'grid_horizontal_alignment',
            [
                'label' => esc_html__( 'Horizontal Alignment', 'angie-snippets' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'start' => [
                        'title' => esc_html__( 'Start', 'angie-snippets' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'angie-snippets' ),
                        'icon' => 'eicon-h-align-center',
                    ],
                    'end' => [
                        'title' => esc_html__( 'End', 'angie-snippets' ),
                        'icon' => 'eicon-h-align-right',
                    ],
                    'stretch' => [
                        'title' => esc_html__( 'Stretch', 'angie-snippets' ),
                        'icon' => 'eicon-h-align-stretch',
                    ],
                ],
                'default' => 'stretch',
                'selectors' => [
                    '{{WRAPPER}} .blt-8ac671e4-logo-grid' => 'justify-items: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // 6. SECTION CONTROLS (Wrapper Styling)
        $this->start_controls_section(
            'section_style_wrapper',
            [
                'label' => esc_html__( 'Container Styling', 'angie-snippets' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'wrapper_background',
                'selector' => '{{WRAPPER}} .blt-8ac671e4-wrapper',
            ]
        );

        $this->add_responsive_control(
            'wrapper_padding',
            [
                'label' => esc_html__( 'Padding', 'angie-snippets' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem' ],
                'selectors' => [
                    '{{WRAPPER}} .blt-8ac671e4-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'wrapper_margin',
            [
                'label' => esc_html__( 'Margin', 'angie-snippets' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem' ],
                'selectors' => [
                    '{{WRAPPER}} .blt-8ac671e4-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'wrapper_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'angie-snippets' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem' ],
                'selectors' => [
                    '{{WRAPPER}} .blt-8ac671e4-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'wrapper_box_shadow',
                'selector' => '{{WRAPPER}} .blt-8ac671e4-wrapper',
            ]
        );

        $this->add_control(
            'wrapper_animation',
            [
                'label' => esc_html__( 'Grid Filter Animation', 'angie-snippets' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'fade' => esc_html__( 'Fade', 'angie-snippets' ),
                    'zoom' => esc_html__( 'Zoom', 'angie-snippets' ),
                    'slide-up' => esc_html__( 'Slide Up', 'angie-snippets' ),
                    'scale' => esc_html__( 'Scale', 'angie-snippets' ),
                ],
                'default' => 'fade',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $widget_id = $this->get_id();
        ?>
        <div class="blt-8ac671e4-wrapper" id="blt-8ac671e4-<?php echo esc_attr( $widget_id ); ?>" data-animation="<?php echo esc_attr( $settings['wrapper_animation'] ); ?>">
            
            <?php if ( 'yes' === $settings['show_header'] ) : ?>
                <div class="blt-8ac671e4-header-container">
                    <?php if ( ! empty( $settings['header_title'] ) ) : ?>
                        <h2 class="blt-8ac671e4-title"><?php echo esc_html( $settings['header_title'] ); ?></h2>
                    <?php endif; ?>

                    <?php if ( ! empty( $settings['header_see_all_text'] ) ) : 
                        $target = $settings['header_see_all_url']['is_external'] ? ' target="_blank"' : '';
                        $nofollow = $settings['header_see_all_url']['nofollow'] ? ' rel="nofollow"' : '';
                        $url = ! empty( $settings['header_see_all_url']['url'] ) ? esc_url( $settings['header_see_all_url']['url'] ) : '#';
                        ?>
                        <a class="blt-8ac671e4-see-all" href="<?php echo $url; ?>"<?php echo $target . $nofollow; ?>>
                            <?php echo esc_html( $settings['header_see_all_text'] ); ?>
                            <?php if ( 'yes' === $settings['show_arrow'] ) : ?>
                                <span class="blt-8ac671e4-see-all-arrow">➔</span>
                            <?php endif; ?>
                        </a>
                    <?php endif; ?>
                </div>
                <div class="blt-8ac671e4-divider"></div>
            <?php endif; ?>

            <?php if ( ! empty( $settings['tabs_list'] ) ) : ?>
                <div class="blt-8ac671e4-tabs-container">
                    <div class="blt-8ac671e4-tabs-list">
                        <?php 
                        $first = true;
                        foreach ( $settings['tabs_list'] as $index => $tab ) : 
                            $active_class = $first ? ' blt-active' : '';
                            $first = false;
                            ?>
                            <button class="blt-8ac671e4-tab<?php echo esc_attr( $active_class ); ?>" data-tab-id="<?php echo esc_attr( $tab['tab_id'] ); ?>">
                                <?php echo esc_html( $tab['tab_name'] ); ?>
                            </button>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>

            <?php if ( ! empty( $settings['logos_list'] ) ) : ?>
                <div class="blt-8ac671e4-logo-grid">
                    <?php 
                    // Build unique logo maps to merge duplicate cards and support multi-categories
                    $unique_logos = [];
                    foreach ( $settings['logos_list'] as $logo ) {
                        if ( empty( $logo['logos_gallery'] ) ) {
                            continue;
                        }
                        $category_id = trim( strtolower( $logo['category'] ) );
                        foreach ( $logo['logos_gallery'] as $image ) {
                            if ( empty( $image['url'] ) ) {
                                continue;
                            }
                            $img_url = $image['url'];
                            if ( ! isset( $unique_logos[ $img_url ] ) ) {
                                $unique_logos[ $img_url ] = [
                                    'url' => $img_url,
                                    'categories' => [],
                                    'brand_name' => $logo['brand_name']
                                ];
                            }
                            if ( ! in_array( $category_id, $unique_logos[ $img_url ]['categories'] ) ) {
                                $unique_logos[ $img_url ]['categories'][] = $category_id;
                            }
                        }
                    }

                    foreach ( $unique_logos as $logo_data ) :
                        $cats_string = implode( ' ', $logo_data['categories'] );
                        ?>
                        <div class="blt-8ac671e4-logo-card" data-category="<?php echo esc_attr( $cats_string ); ?>">
                            <img src="<?php echo esc_url( $logo_data['url'] ); ?>" alt="<?php echo esc_attr( $logo_data['brand_name'] ); ?>" loading="lazy" />
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

        </div>
        <?php
    }

    protected function content_template() {
        ?>
        <# 
        var animation = settings.wrapper_animation || 'fade';
        #>
        <div class="blt-8ac671e4-wrapper" data-animation="{{ animation }}">
            
            <# if ( 'yes' === settings.show_header ) { #>
                <div class="blt-8ac671e4-header-container">
                    <# if ( settings.header_title ) { #>
                        <h2 class="blt-8ac671e4-title">{{{ settings.header_title }}}</h2>
                    <# } #>

                    <# if ( settings.header_see_all_text ) { 
                        var url = settings.header_see_all_url.url ? settings.header_see_all_url.url : '#';
                        #>
                        <a class="blt-8ac671e4-see-all" href="{{ url }}">
                            {{{ settings.header_see_all_text }}}
                            <# if ( 'yes' === settings.show_arrow ) { #>
                                <span class="blt-8ac671e4-see-all-arrow">➔</span>
                            <# } #>
                        </a>
                    <# } #>
                </div>
                <div class="blt-8ac671e4-divider"></div>
            <# } #>

            <# if ( settings.tabs_list.length ) { #>
                <div class="blt-8ac671e4-tabs-container">
                    <div class="blt-8ac671e4-tabs-list">
                        <# _.each( settings.tabs_list, function( tab, index ) { 
                            var activeClass = index === 0 ? ' blt-active' : '';
                            #>
                            <button class="blt-8ac671e4-tab{{ activeClass }}" data-tab-id="{{ tab.tab_id }}">
                                {{{ tab.tab_name }}}
                            </button>
                        <# } ); #>
                    </div>
                </div>
            <# } #>

            <# if ( settings.logos_list.length ) { #>
                <div class="blt-8ac671e4-logo-grid">
                    <# 
                    var uniqueLogos = {};
                    _.each( settings.logos_list, function( logo ) {
                        if ( logo.logos_gallery && logo.logos_gallery.length ) {
                            var categoryId = logo.category ? logo.category.trim().toLowerCase() : '';
                            _.each( logo.logos_gallery, function( image ) {
                                if ( image.url ) {
                                    if ( ! uniqueLogos[ image.url ] ) {
                                        uniqueLogos[ image.url ] = {
                                            url: image.url,
                                            categories: [],
                                            brand_name: logo.brand_name
                                        };
                                    }
                                    if ( ! _.contains( uniqueLogos[ image.url ].categories, categoryId ) ) {
                                        uniqueLogos[ image.url ].categories.push( categoryId );
                                    }
                                }
                            } );
                        }
                    } );

                    _.each( uniqueLogos, function( logoData ) {
                        var catsString = logoData.categories.join(' ');
                        #>
                        <div class="blt-8ac671e4-logo-card" data-category="{{ catsString }}">
                            <img src="{{ logoData.url }}" alt="{{ logoData.brand_name }}" />
                        </div>
                        <#
                    } );
                    #>
                </div>
            <# } #>

        </div>
        <?php
    }
}
