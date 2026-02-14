<?php 

namespace ArolaxEssentialApp\Inc;

Class Elementor_ShortCode_Tpl{

    public function __construct(){
        add_filter( 'manage_elementor_library_posts_columns', [ $this,'arolax_edit_elementor_library_posts_columns'] );
        add_action( 'manage_elementor_library_posts_custom_column', [ $this,'arolax_add_elementor_library_columns'], 10, 2 );
        add_shortcode( 'WCF_ELEMENTOR_TPL', [ $this, 'arolax_add_elementor' ] );
    }    
    
    function arolax_edit_elementor_library_posts_columns( $columns ) {
    	$columns['arolax_shortcode_column'] = esc_html__( 'Shortcode', 'arolax-essential' );
    
    	return $columns;
    }    
    
    function arolax_add_elementor_library_columns( $column, $post_id ) {
    	switch ( $column ) {
    		case 'arolax_shortcode_column' :
    			echo '<input type="text" class="widefat" value=\'[WCF_ELEMENTOR_TPL id="' . $post_id . '"]\' readonly>';
    			break;
    	}
    }    
    
    function arolax_add_elementor( $atts ) {
    
    	if ( ! class_exists( 'Elementor\Plugin' ) ) {
    		return false;
    	}
    	
    	if ( ! isset( $atts['id'] ) || empty( $atts['id'] ) ) {
    		return false;
    	}
    
    	$post_id  = $atts['id'];
    	$response = \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $post_id );    
    	return $response;
    }
}

new Elementor_ShortCode_Tpl();


