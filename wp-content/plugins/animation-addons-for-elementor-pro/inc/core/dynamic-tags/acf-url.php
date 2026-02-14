<?php

namespace WCFAddonsPro\Base\Tags;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class AAE_ACF_URL extends \Elementor\Core\DynamicTags\Tag {
    use CustomPostIdTrait;
    public function get_name() {
        return 'aae-acf-url';
    }

    public function get_title() {
        return esc_html__( 'ACF URL Field', 'wcf-addons-pro' );
    }

    public function get_group() {
        return [ 'aae' ];
    }

    public function get_categories(): array {
        return [ \Elementor\Modules\DynamicTags\Module::URL_CATEGORY ];
    }

    protected function register_controls() {      
        
        $tax = $this->get_cpt_taxonomies();    
        
        if(!empty($tax)){
            $this->add_control(
                'field_key',
                [
                    'label' => __('Field Key', 'wcf-addons-pro'),
                    'type' => \Elementor\Controls_Manager::TEXT,                   
                    'default' => '',
                ]
            );
            $this->add_control(
                'taxonomy',
                [
                    'label' => __('Taxonomy', 'wcf-addons-pro'),
                    'type' => \Elementor\Controls_Manager::SELECT2, // SELECT2 for search functionality.
                    'options' => $tax,               
                    'default' => '',
                ]
            );
        }else{
            $options = $this->get_acf_fields_options(); 
            
            if(!empty($options)){            
                $this->add_control(
                    'field_key',
                    [
                        'label' => __( 'Field Key', 'wcf-addons-pro' ),
                        'type' => \Elementor\Controls_Manager::SELECT2, // SELECT2 for search functionality.
                        'options' => $options,
                        'description' => __( 'Search and select an ACF field.', 'wcf-addons-pro' ),
                    ]
                );
            }else{
                $this->add_control(
                    'field_key',
                    [
                        'label' => __('Field Key', 'wcf-addons-pro'),
                        'type' => \Elementor\Controls_Manager::TEXT,                   
                        'default' => '',
                    ]
                );
            }
        }
        
    }

    public function render() {
        if ( ! function_exists( 'get_field' ) || ! function_exists( 'get_field_objects' ) ) {
            echo esc_html__( 'ACF plugin is not active.', 'wcf-addons-pro' );
            return;
        }

        $field_key = $this->get_settings( 'field_key' );
      
        $taxonomy = $this->get_settings( 'taxonomy' );  
      
        if(!is_null($taxonomy) && $taxonomy !=''){
            $this->tax = $taxonomy;
        }
        if ( ! $field_key ) {
            echo esc_html__( 'Field key is not selected.', 'wcf-addons-pro' );
            return;
        }
        $post_id = $this->get_custom_id();
        $url = get_field( $field_key , $post_id );

        if ( ! $url ) {
            echo esc_html__( 'URL field is empty or invalid.', 'wcf-addons-pro' );
            return;
        }
      
       echo esc_url( $url );
    }

    private function get_acf_fields_options() {
        if ( ! function_exists( 'get_field_objects' ) ) {
            return [];
        }

        $post_id = get_the_ID(); // Current post ID.
        $post_id = $this->get_custom_id($post_id);
        // Fallback for Elementor templates or archives.
        if ( ! $post_id ) {
            $post_id = apply_filters( 'elementor/dynamic_tags/post_id', 0 );
        }

        $fields = $post_id ? get_field_objects( $post_id ) : [];
        $options = [];

        if ( $fields ) {
            foreach ( $fields as $key => $field ) {
                if ( $field['type'] === 'url' ) {
                    $options[ $key ] = $field['label'];
                }
            }
        }

        // Include Global ACF Fields (Options Page).
        $global_fields = get_field_objects( 'options' );
        if ( $global_fields ) {
            foreach ( $global_fields as $key => $field ) {
                if ( $field['type'] === 'url' ) {
                    $options[ $key ] = '[Global] ' . $field['label'];
                }
            }
        }

        return $options;
    }
}
