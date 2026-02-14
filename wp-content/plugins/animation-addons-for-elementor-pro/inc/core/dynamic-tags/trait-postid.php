<?php
namespace WCFAddonsPro\Base\Tags;
trait CustomPostIdTrait
{
    public $tax = null;
    private function get_cpt_taxonomies($post_id = null) {
        
        if (is_null($post_id)) {
            $post_id = get_the_ID();
        }
        
        $options = [];
        $post_type     = null;
        $meta_type     = get_post_meta($post_id, 'wcf-addons-template-meta_type', true);
        $meta_location = get_post_meta($post_id, 'wcf-addons-template-meta_location', true);
       
        if ($meta_type === 'archive' && !empty($meta_location)) {
            $exclude = explode('-archive',$meta_location);    
            if(isset($exclude[0])){
                $post_type = $exclude[0];   
            }else{
                return $options;
            }
        }
        
        $taxonomies = get_object_taxonomies($post_type, 'objects');        

        if (!empty($taxonomies)) {
            foreach ($taxonomies as $taxonomy_slug => $taxonomy_object) {
                $options[$taxonomy_slug] = $taxonomy_object->label;
            }
        }
        
        return $options;
    }  
    
    
    public function get_custom_id($post_id = null)
    {
        // Use the current post ID if none is provided.
        if (is_null($post_id)) {
            $post_id = get_the_ID();
        }
         // Fallback logic for 'wcf-addons-template' post type.
        if (get_post_type($post_id) === 'wcf-addons-template') {
        
            $args = [
                'numberposts' => 1,
                'post_type'   => 'post',
                'orderby'     => 'menu_order',
                'order'       => 'ASC',
            ];
            
            $meta_type = get_post_meta($post_id, 'wcf-addons-template-meta_type', true);
            $meta_location = get_post_meta($post_id, 'wcf-addons-template-meta_location', true);
           
            if ($meta_type === 'single' && !empty($meta_location)) {
                $explode = explode('-sing', $meta_location);
                if (isset($explode[0])) {                 
                    if ($explode[0] !='') {                                       
                        $args['post_type'] = $explode[0];
                        $latest_posts = get_posts($args);      
                        if (!is_wp_error( $latest_posts ) && !empty($latest_posts) && isset($latest_posts[0])) {                           
                            $post_id = $latest_posts[0]->ID;
                        }
                    }
                }elseif($meta_location==='singulars'){
                    $latest_posts = get_posts($args);
                    // Update $post_id if a valid post is found.
                    if (!is_wp_error( $latest_posts ) && !empty($latest_posts) && isset($latest_posts[0])) {
                        $post_id = $latest_posts[0]->ID;
                    }
                }
            }elseif ($meta_type === 'archive' && !empty($meta_location) && $this->tax !='') {
            
                $tax_args = [
                    'taxonomy' => 'category',
                    'orderby'    => 'id', // Order by term ID (creation order).
                    'order'      => 'DESC', // Get the latest one.
                    'number'     => 1, // Limit to 1 result.
                    'hide_empty' => false, // Include terms without posts.
                ];              
                
                if (preg_match('/^(.*?)-/', $meta_location, $matches))
                {
                
                    if (!empty($matches[1])) {                                       
                        $tax_args['taxonomy'] = $this->tax;  
                        $taxonomy_term = get_terms($tax_args);  
                       
                        if (!is_wp_error( $taxonomy_term ) && !empty($taxonomy_term)) 
                        {                           
                            $post_id = $taxonomy_term[0];                   
                        } 
                       
                    }
                    
                }elseif($meta_location==='archives'){
                
                    $tax_args['taxonomy'] = 'category';                  
                    $taxonomy_term = get_terms($tax_args);  
                    if (!is_wp_error( $taxonomy_term ) && !empty($latest_taxonomy_term)) 
                    {
                        $post_id = $taxonomy_term[0];                   
                    } 
                    
                }
            }
            
        }elseif(is_tax() ){
            $term = get_queried_object();
            return $term->taxonomy . '_' . $term->term_id;
        }         
      
        return $post_id;
    }
}
