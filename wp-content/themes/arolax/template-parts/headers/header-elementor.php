<?php 

    if(!class_exists('Elementor\Plugin')){
        return; 
    }
    
?>

<header class="arolax-theme-elementor-header-section">
    <?php echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $args['post_id'], true); ?>
</header>