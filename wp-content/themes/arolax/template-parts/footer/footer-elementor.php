<?php

    if(!class_exists('Elementor\Plugin')){
        return; 
    }

    echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $args['post_id'], true); 

?>