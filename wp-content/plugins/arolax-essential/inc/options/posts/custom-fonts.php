<?php 

// Control core classes for avoid errors
if( class_exists( 'CSF' ) ) {

    // Set a unique slug-like ID
    $post_prefix = 'arolax_custom_fonts_options';
  
    CSF::createMetabox( $post_prefix, array(
      'title'     => 'Settings',
      'post_type' => 'wcf-custom-font',
    ) );
     
    
    CSF::createSection( $post_prefix, array(
      'title'  =>  esc_html__( 'Settings', 'arolax-essential'),
      'fields' => array(
      
        array(
          'type'     => 'callback',
          'function' =>  'wcf_custom_font_demo_review_callback',
        ),
      
        array(
          'id'     => 'wcf_font_variation',
          'type'   => 'repeater',
          'title'  => esc_html__('Add Font Variation','joya-essential'),
          'fields' => array(
        
            array(
              'id'          => 'font_weight',
              'type'        => 'select',
              'title'       => esc_html__('Font Weight','arolax-essential'),
              'placeholder' => esc_html__('Select an Weight','arolax-essential'),
              'options'     => array(
                '100'  => '100',
                '200'  => '200',                
                '300'  => '300',                
                '400'  => '400 Regular',                
                '500'  => '500',                
                '600'  => '600',                
                '700'  => '700',                
                '800'  => '800',                
                '900'  => '900',                
              ),
              'default'     => '400'
            ),
            
            array(
              'id'          => 'font_style',
              'type'        => 'select',
              'title'       => esc_html__('Style','arolax-essential'),
              'placeholder' => 'Select an Style',
              'options'     => array(
                'normal'  => 'Normal',
                'italic'  => 'Italic',
                'oblique'  => 'Oblique'                             
              ),
              'default'     => 'normal'
            ),
            
            array(
              'id'      => 'woff_file',
              'type'    => 'upload',
              'placeholder' => esc_html__('The Web Open Font Format','arolax-essential'),
              'title'   => esc_html__('WOFF FILE','arolax-essential'),             
            ),
            
            array(
              'id'      => 'woff2_file',
              'type'    => 'upload',
              'placeholder' => esc_html__('The Web Open Font Format 2 . Used by modern browser','arolax-essential'),
              'title'   => esc_html__('WOFF2 FILE','arolax-essential'),             
            ),
            
            array(
              'id'      => 'ttf_file',
              'type'    => 'upload',
              'placeholder' => esc_html__('The TrueType Font Format  . Best used for safari , android ios','arolax-essential'),
              'title'   => esc_html__('TTF FILE','arolax-essential'),             
            ),
            
            array(
              'id'      => 'eot_file',
              'type'    => 'upload',
              'placeholder' => esc_html__('Embeded Open Type   . Best used for IE6-9','arolax-essential'),
              'title'   => esc_html__('EOT FILE','arolax-essential'),             
            ),            
        
          ),
        ),
  
      )
      
    ) );    
  
  }
  