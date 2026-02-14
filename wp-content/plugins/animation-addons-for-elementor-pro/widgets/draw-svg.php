<?php

namespace WCFAddonsPro\Widgets;

if ( ! defined( 'ABSPATH' ) ) {
	exit;   // Exit if accessed directly.
}

class Draw_Svg extends \Elementor\Widget_Base {

    public function get_name() {
        return 'wcf-gsap-drawsvg';
    }

    public function get_title() {
        return __('GSAP DrawSVG', 'wcf-addons-pro');
    }

    public function get_icon() {
        return 'wcf eicon-animation';
    }

    public function get_categories() {
        return ['wcf-addons-pro'];
    }
    
    
	public function get_style_depends() {		
		return [ ];
	}

	public function get_script_depends() {
	 // Register DrawSVG Plugin
        wp_register_script('gsap-drawsvg', WCF_ADDONS_PRO_URL.'assets/js/DrawSVGPlugin.js', ['gsap'], '3.12.2', true);
		wp_register_script( 'wcf-gsapdrawsvg', WCF_ADDONS_PRO_URL. 'assets/js/gsap-draw.js' , [ 'gsap-drawsvg' ], false, true );
		return ['wcf-gsapdrawsvg' ];
	}

    protected function register_controls() {
    
        $this->start_controls_section(
            'animation_settings',
            [
                'label' => __('Settings', 'wcf-addons-pro'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        
            $this->add_control(
                'svg_code',
                [
                    'label' => __('SVG Code', 'wcf-addons-pro'),
                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                    'description' => __('Paste your SVG code here. Ensure paths are used.', 'wcf-addons-pro'),
                    'default' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" width="100" height="100">
                                      <path
                                        d="M50,50 C60,20 80,20 90,50 C80,80 60,80 50,50"
                                        fill="none"
                                        stroke="green"
                                        stroke-width="2"
                                      />
                                      <path
                                        d="M50,50 C40,20 20,20 10,50 C20,80 40,80 50,50"
                                        fill="none"
                                        stroke="green"
                                        stroke-width="2"
                                      />
                                    </svg>
                                    '
                ]
            );
            
             // ScrollTrigger Controls
             $this->add_control(
                'scroll_trigger',
                [
                    'label' => __('Enable ScrollTrigger', 'wcf-addons-pro'),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'default' => 'yes',
                ]
            );
            
            $this->add_control(
                'animation_method',
                [
                    'label' => __( 'Animation Method', 'wcf-addons-pro' ),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'options' => [
                        'fromTo' => 'fromTo',
                        'from'   => 'from',
                        'to'     => 'to',
                    ],
                    'default' => 'fromTo',
                    'label_block' => true,                    
                    'condition' => [
                         'scroll_trigger!' => ['yes'],
                    ],
                ]
            );
            
            $this->add_control(
                'animation_method_scroll',
                [
                    'label' => __( 'Animation Method', 'wcf-addons-pro' ),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'options' => [
                        'fromTo' => 'fromTo',
                        'from'   => 'from'                        
                    ],
                    'default' => 'fromTo',
                    'label_block' => true,
                    'condition' => [
                         'scroll_trigger' => ['yes'],
                    ],
                    
                ]
            );
            
            $this->add_control(
                'draw_percent',
                [
                    'label' => __( 'Draw %', 'wcf-addons-pro' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => '0%',
                    'description' => 'you can add percent end',
                    'label_block' => true,
                    'condition' => [
                         'animation_method' => ['from','to'],
                    ],
                ]
                
            );
    
            // From (Start) Value Control
            $this->add_control(
                'animation_from',
                [
                    'label' => __( 'From Value (Start)', 'wcf-addons-pro' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => '0%',
                    'label_block' => true,
                    'condition' => [
                        'animation_method' => ['fromTo'],
                    ],
                ]
                
            );
            
            $this->add_control(
                'animation_from_scroll',
                [
                    'label' => __( 'From Value (Start)', 'wcf-addons-pro' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => '0%',
                    'label_block' => true,
                    'condition' => [
                        'animation_method_scroll' => ['fromTo'],
                        'scroll_trigger' => ['yes'],
                    ],
                ]
                
            );
    
            // To (End) Value Control
            $this->add_control(
                'animation_to',
                [
                    'label' => __( 'To Value (End)', 'wcf-addons-pro' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => '100%',
                    'label_block' => true,
                    'condition' => [
                        'animation_method' => ['fromTo'],
                    ],
                ]
            );
    
    
            $this->add_control(
                'duration',
                [
                    'label' => __('Animation Duration', 'wcf-addons-pro'),
                    'type' => \Elementor\Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 2,
                    ],
                    'range' => [
                        'px' => [
                            'min' => 0.1,
                            'max' => 10,
                            'step' => 0.1,
                        ],
                    ],
                ]
            );

            $this->add_control(
                'delay',
                [
                    'label' => __('Path Delay Multiplier', 'wcf-addons-pro'),
                    'type' => \Elementor\Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 0.5,
                    ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 5,
                            'step' => 0.1,
                        ],
                    ],
                ]
            );

            $this->add_control(
                'ease',
                [
                    'label' => __('Easing', 'wcf-addons-pro'),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'options' => [
                        'linear' => 'Linear',
                        'power1.inOut' => 'Power1 InOut',
                        'power2.inOut' => 'Power2 InOut',
                        'elastic.out' => 'Elastic Out',
                    ],
                    'default' => 'power2.inOut',
                ]
            );  
            
            $this->add_control(
                'repeat_count',
                [
                    'label' => __('Repeat Count', 'wcf-addons-pro'),
                    'type' => \Elementor\Controls_Manager::NUMBER,
                    'default' => 0,
                    'description' => __('Number of times the animation repeats. Use -1 for infinite repetition.', 'wcf-addons-pro'),
                    'condition' => [
                        'enable_yoyo' => 'yes',
                    ],
                ]
            );  
            
            $this->add_control(
                'enable_yoyo',
                [
                    'label' => __('Enable Yoyo', 'wcf-addons-pro'),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'default' => 'no',
                    'description' => __('Reverse the animation after completing a loop.', 'wcf-addons-pro'),
                ]
            );  
                
         
            
            $this->add_control(
                'trigger_start',
                [
                    'label' => __('Trigger Start', 'wcf-addons-pro'),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => 'top 75%',
                    'description' => __('Position where the animation starts (e.g., "top 75%").', 'wcf-addons-pro'),
                    'condition' => [
                        'scroll_trigger' => 'yes',
                    ],
                ]
            );
    
            $this->add_control(
                'trigger_end',
                [
                    'label' => __('Trigger End', 'wcf-addons-pro'),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => 'top 25%',
                    'description' => __('Position where the animation ends (e.g., "top 25%").', 'wcf-addons-pro'),
                    'condition' => [
                        'scroll_trigger' => 'yes',
                    ],
                ]
            );       
                
    
            $this->add_control(
                'scrub',
                [
                    'label' => __('Enable Scrub', 'wcf-addons-pro'),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'default' => 'no',
                    'description' => __('Smooth animation as you scroll.', 'wcf-addons-pro'),
                    'condition' => [
                        'scroll_trigger' => 'yes',
                    ],
                ]
            );
    
            // $this->add_control(
            //     'scrub_duration',
            //     [
            //         'label' => __('Scrub Duration', 'wcf-addons-pro'),
            //         'type' => \Elementor\Controls_Manager::SLIDER,
            //         'default' => [
            //             'size' => 1,
            //         ],
            //         'range' => [
            //             'px' => [
            //                 'min' => 0.1,
            //                 'max' => 10,
            //                 'step' => 0.1,
            //             ],
            //         ],
            //         'condition' => [
            //             'scroll_trigger' => 'yes',
            //             'scrub' => 'yes',
            //         ],
            //     ]
            // );        
          
            // $this->add_control(
            //     'enable_pin',
            //     [
            //         'label' => __('Enable Pin', 'wcf-addons-pro'),
            //         'type' => \Elementor\Controls_Manager::SWITCHER,
            //         'default' => 'no',
            //         'description' => __('Pin the element during the scroll.', 'wcf-addons-pro'),
            //     ]
            // );
                
            // $this->add_control(
            //     'pin_spacing',
            //     [
            //         'label' => __('Enable Pin Spacing', 'wcf-addons-pro'),
            //         'type' => \Elementor\Controls_Manager::SWITCHER,
            //         'default' => 'yes',
            //         'description' => __('Enable to add spacing after pinning. Disable for overlapping layouts.', 'wcf-addons-pro'),
            //         'condition' => [
            //             'enable_pin' => 'yes',
            //         ],
            //     ]
            // );
            
            // $this->add_control(
            //     'pin_duration',
            //     [
            //         'label' => __('Pin Duration', 'wcf-addons-pro'),
            //         'type' => \Elementor\Controls_Manager::TEXT,
            //         'default' => '200%',
            //         'description' => __('Set how long the element stays pinned. Use values like "100%", "200%", or pixel values (e.g., "500px").', 'wcf-addons-pro'),
            //         'condition' => [
            //             'enable_pin' => 'yes',
            //         ],
            //     ]
            // );
     

        $this->end_controls_section();
        
       
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        // Get animation settings
        $scroll_trigger = $settings['scroll_trigger'];
        $method         = $settings['scroll_trigger'] == 'yes' ? $settings['animation_method_scroll'] : $settings['animation_method'];
        $from           = $settings['scroll_trigger'] == 'yes' ? $settings['animation_from_scroll'] : $settings['animation_from']; 
        $to             = $settings['animation_to'];
        $draw_percent   = $settings['draw_percent'];
        $duration       = isset($settings['duration']['size']) ? $settings['duration']['size'] : 1;
        $delay          = isset($settings['delay']['size']) ? $settings['delay']['size'] : 0.5;
        $repeat         = isset($settings['repeat_count']['size']) ? $settings['repeat_count']['size'] : 1;
        $ease           = $settings['ease'];
        $scrub           = $settings['scrub'] == 'yes' ? true : false;
        $timeline_yoyo  = $settings['enable_yoyo'] == 'yes' ? true : false;
        $start          = $settings['trigger_start'];
        $end            = $settings['trigger_end'];

        // Render HTML and pass animation data through data attributes
        echo '<div class="gsap-draw-svg" 
                 data-scroll_trigger="' . esc_attr($scroll_trigger) . '" 
                 data-method="' . esc_attr($method) . '" 
                 data-draw_percent="' . esc_attr($draw_percent) . '" 
                 data-from="' . esc_attr($from) . '" 
                 data-to="' . esc_attr($to) . '" 
                 data-duration="' . esc_attr($duration) . '" 
                 data-delay="' . esc_attr($delay) . '" 
                 data-repeat="' . esc_attr($repeat) . '" 
                 data-ease="' . esc_attr($ease) . '" 
                 data-scrub="' . esc_attr($scrub) . '" 
                 data-timeline_yoyo="' . esc_attr($timeline_yoyo) . '" 
                 data-scrolltrigger-start="' . esc_attr($start) . '" 
                 data-scrolltrigger-end="' . esc_attr($end) . '">
                  '.$settings["svg_code"].'
              </div>';
    }

}
