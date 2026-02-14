<?php 

   // backup option
   CSF::createSection( 'arolax_settings', array(
           
    'title'  => esc_html__( 'Backup Options', 'arolax-essential' ),
    'icon'   => 'fa fa-share-square-o',
    'fields' => array(
        array(
            'id'    => 'backup_options',
            'type'  => 'backup',
            'title' => esc_html__( 'Backup Your All Options', 'arolax-essential' ),
            'desc'  => esc_html__( 'If you want to take backup your option you can backup here.', 'arolax-essential' ),
        ),
    ),
) );