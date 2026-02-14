<?php 

    include_once(AROLAX_ESSENTIAL_DIR_PATH.'inc/sidebar-widgets/recent-post.php');
    include_once(AROLAX_ESSENTIAL_DIR_PATH.'inc/sidebar-widgets/social.php');
    include_once(AROLAX_ESSENTIAL_DIR_PATH.'inc/sidebar-widgets/cta-banner.php');
    
    add_action( 'widgets_init', 'arolax_register_sidebar_widgets' );
    
    function arolax_register_sidebar_widgets() {
    	register_widget( 'Arolax_Recent_Post' );
    	register_widget( 'Arolax_Banner_Widget' );
    }
