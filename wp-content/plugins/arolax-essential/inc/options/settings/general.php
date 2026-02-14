<?php 

CSF::createSection( AROLAX_OPTION_KEY, array(
        'icon'   => 'fa fa-book',
        'title'  => esc_html__( 'General','arolax-essential'),
        'fields' => array(

//            array(
//                'id'      => 'breadcrumb_enable',
//                'type'    => 'switcher',
//                'title'   => esc_html__( 'Breadcrumb', 'arolax-essential' ),
//                'default' => true
//            ),

//            array(
//                'id'         => 'general_breadcrumb_limit',
//                'type'       => 'number',
//                'title'      => esc_html__( 'Breadcrumb limit', 'arolax-essential' ),
//                'desc'       => esc_html__( 'Set the breadcrump text limit', 'arolax-essential' ),
//                'default'    => '50',
//            ),
            
            array(
                'id'      => 'general_full_site_background',
                'type'    => 'switcher',
                'title'   => esc_html__( 'FullSite Background Pattern', 'arolax-essential' ),
                'default' => false
            ), 
            
            array(
                'id'        => 'general_fullsite_background_preset',
                'type'      => 'image_select',
                'title'     => esc_html__('Background Pattern Select','arolax-essential'),
                'options'   => AROLAX_ESSENTIAL_get_background_patterns(),
                'dependency' => array( 'general_full_site_background', '==', 'true' ),
                'default'   => '',                
            ),

            array(
                'id'        => 'general_full_site_custom_background',
                'type'      => 'media',
                'preview'   => false,
                'library'   => 'image',
                'dependency' => array( 'general_fullsite_background_preset|general_full_site_background','==|==','custom|true' ),
                'title'     => esc_html__('Custom Background Pattern','arolax-essential'),
            ),
            
//            array(
//                'id'     => 'general_custom_post_type',
//                'type'   => 'repeater',
//                'title'  => esc_html__('Post Types','arolax-essential'),
//                'fields' => array(
//
//                    array(
//                        'id'           => 'cpt',
//                        'type'         => 'select',
//                        'title'        => esc_html__('Select an post type','arolax-essential'),
//                        'placeholder'  => esc_html__('Select an post type','arolax-essential'),
//                        'options'      => arolax_get_cache_post_types()
//                    ),
//
//                    array(
//                        'id'           => 'cpt_primary_tax',
//                        'type'         => 'select',
//                        'title'        => esc_html__('Select Primary Taxonomy','arolax-essential'),
//                        'placeholder'  => esc_html__('Select Primary Taxonomy','arolax-essential'),
//                        'options'      => arolax_get_cache_tax_types()
//                    )
//                ),
//            ),
            
            array(
                'id'      => 'theme_demo_activate',
                'type'    => 'switcher',
                'title'   => esc_html__( 'Activate Theme Demo', 'arolax-essential' ),
                'default' => true,               
            ), 
            
            array(
                'id'      => 'hide_unwanted_warning',
                'type'    => 'switcher',
                'title'   => esc_html__( 'Hide Unwanted Warning', 'arolax-essential' ),
                'default' => true,               
            ), 
            
            // array(
            //     'id'      => 'debug_mode',
            //     'type'    => 'switcher',
            //     'title'   => esc_html__( 'Debug Mode', 'arolax-essential' ),
            //     'default' => false,               
            // ), 
              
       
        )
    ) ); 