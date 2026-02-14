<?php 

    // Woo a top-tab
    CSF::createSection( AROLAX_OPTION_KEY, array(
        'id'    => 'wcf_rtl_tab',                     // Set a unique slug-like ID
        'title' => esc_html__( 'RTL', 'arolax-essential' ),
        'icon'  => 'eicon-rtl',
        'fields' => array(

	        array(
		        'id'      => 'wcf_enable_rtl',
		        'type'    => 'switcher',
		        'title'   => esc_html__( 'Enable RTL (Frontend)', 'arolax-essential' ),
		        'default' => false,
	        ),

        )
    ) );

