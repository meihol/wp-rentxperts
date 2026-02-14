<?php

CSF::createSection( AROLAX_OPTION_KEY, array(
    'id'    => 'cpt_tab',                         // Set a unique slug-like ID
    'title' => esc_html__( 'CPT & Taxonomy', 'arolax-essential' ),
    'icon'  => 'fa fa-cog',
) ); 

CSF::createSection( 'arolax_settings', array(
    'parent' => 'cpt_tab', // The slug id of the parent section
    'title'  => esc_html__( 'Settings', 'arolax-essential' ),
    'icon'   => 'fa fa-share-alt',
    'fields' => array(     
         
        array(
            'id'     => 'cpt_options',
            'type'   => 'repeater',
            'title'  => esc_html__('Custom Post Type','arolax-essential'),
            'fields' => array(
          
                array(
                    'id'      => 'posttype',
                    'type'    => 'text',
                    'title'   => esc_html__( 'Post Type (Unique)', 'arolax-essential' ),                   
                ),
                
                array(
                    'id'      => 'singular_name',
                    'type'    => 'text',
                    'title'   => esc_html__( 'Singular Name', 'arolax-essential' ),                   
                ),
                
                array(
                    'id'      => 'plural_name',
                    'type'    => 'text',
                    'title'   => esc_html__( 'Plural Name', 'arolax-essential' ),                   
                ),
                 
                array(
                    'id'      => 'slug',
                    'type'    => 'text',
                    'title'   => esc_html__( 'Front Slug', 'arolax-essential' ),                   
                ),
                
                array(
                    'id'          => 'supports',
                    'type'        => 'select',
                    'title'       => esc_html__('Select Supports','arolax-essential'),
                    'chosen'      => true,
                    'multiple'    => true,
                    'placeholder' => esc_html__('Select an option','arolax-essential'),
                    'options'     => array(
                        'title' => 'Title', 
                        'editor' => 'Editor',
                        'author' => 'Author',
                        'thumbnail' => 'Thumbnail',
                        'excerpt' => 'Excerpt',
                        'comments' => 'Comments'
                    ),
                    'default'     => 'title'
                ),                  
                
                array(
                    'id'         => 'exclude_from_search',
                    'type'       => 'switcher',
                    'title'      => esc_html__('Exclude From Search?','arolax-essential'),
                    'default'    => false
                ),
                
                array(
                    'id'         => 'has_archive',
                    'type'       => 'switcher',
                    'title'      => esc_html__('Has Archive?','arolax-essential'),
                    'default'    => false
                ),
                
                array(
                    'id'         => 'publicly_queryable',
                    'type'       => 'switcher',
                    'title'      => esc_html__('Publicly Queryable?','arolax-essential'),
                    'default'    => false
                ),
             
                array(
                    'id'         => 'show_in_menu',
                    'type'       => 'switcher',
                    'title'      => esc_html__('Show in admin menu?','arolax-essential'),
                    'default'    => true
                ),               
                array(
                    'id'      => 'icon',
                    'type'    => 'media',
                    'title' => esc_html__('Nav Icon','arolax-essential'),
                    'library' => 'image',
                    'preview' => true
                  ),
                array(
                    'id'         => 'show_in_nav_menus',
                    'type'       => 'switcher',
                    'title'      => esc_html__('Show in nav menus?','arolax-essential'),
                    'default'    => false
                ), 
          
            ),
          ),
          array(
            'type'    => 'heading',
            'content' => esc_html__('Custom Taxonomy','arolax-essential'),
          ),
          
          array(
            'id'     => 'cpt_taxonomy_options',
            'type'   => 'repeater',
            'title'  => esc_html__('Custom Taxonomy Type','arolax-essential'),
            'fields' => array(
          
                array(
                    'id'      => 'taxonomy_name',
                    'type'    => 'text',
                    'title'   => esc_html__( 'Taxonomy Name (Unique)', 'arolax-essential' ),                   
                ),
                
                array(
                    'id'      => 'taxonomy_label',
                    'type'    => 'text',
                    'title'   => esc_html__( 'Singular Name', 'arolax-essential' ),                   
                ),
                
                array(
                    'id'      => 'taxonomy_plural_label',
                    'type'    => 'text',
                    'title'   => esc_html__( 'Plural Name', 'arolax-essential' ),                   
                ),
                 
                array(
                    'id'      => 'slug',
                    'type'    => 'text',
                    'title'   => esc_html__( 'Front Slug', 'arolax-essential' ),                   
                ),
                
                array(
                    'id'          => 'post_types',
                    'type'        => 'select',
                    'title'       => esc_html__('Select post types','arolax-essential'),
                    'chosen'      => true,
                    'multiple'    => true,
                    'placeholder' => esc_html__('Select an post type','arolax-essential'),
                    'options'     => function_exists('arolax_get_cache_post_types') ?  arolax_get_cache_post_types() : [],
                    'default'     => ''
                ),
                
                array(
                    'id'         => 'publicly_queryable',
                    'type'       => 'switcher',
                    'title'      => esc_html__('Publicly Queryable?','arolax-essential'),
                    'default'    => true
                ),
                
                array(
                    'id'         => 'show_in_menu',
                    'type'       => 'switcher',
                    'title'      => esc_html__('Show in admin menu?','arolax-essential'),
                    'default'    => true
                ),  
                 
                
                array(
                    'id'         => 'show_in_nav_menus',
                    'type'       => 'switcher',
                    'title'      => esc_html__('Show in nav menus?','arolax-essential'),
                    'default'    => false
                ),
                
                array(
                    'id'         => 'show_ui',
                    'type'       => 'switcher',
                    'title'      => esc_html__('Show in ui?','arolax-essential'),
                    'default'    => true
                ), 
                array(
                    'id'         => 'show_in_rest',
                    'type'       => 'switcher',
                    'title'      => esc_html__('Show in Rest?','arolax-essential'),
                    'default'    => false
                ), 
                         
            ),
          ),         
    ),

) );