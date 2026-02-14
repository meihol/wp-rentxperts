<?php 

   // Theme Update
   CSF::createSection( 'arolax_settings', array(
           
    'title'  => esc_html__( 'Theme Update', 'arolax-essential' ),
    'icon'   => 'fa fa-share-square-o',
    'fields' => array(
        // A Heading
        array(
            'type'    => 'heading',
            'content' => esc_html__('Theme Update','arolax-essential'),
        ),
        
        array(
            'type'    => 'notice',
            'style'   => 'warning',
            'content' => '<p>Check Latest Theme Update</p> <a class="button" id="wcf--check-theme-update-status">Check Update</a>',
          ),
  
        array(
            'type'     => 'callback',
            'function' => 'wcf__theme__update__html',
          ),
    ),
) );