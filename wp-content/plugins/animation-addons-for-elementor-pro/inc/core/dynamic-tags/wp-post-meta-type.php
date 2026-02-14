<?php 

namespace WCFAddonsPro\Base\Tags;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class AAE_Post_Meta extends \Elementor\Core\DynamicTags\Tag {

    public function get_name() {
        return 'aae-post-meta';
    }

    public function get_title() {
        return esc_html__( 'Post Meta', 'wcf-addons-pro' );
    }

    public function get_group() {
        return [ 'aae-posts' ];
    }

    public function get_categories(): array {
        return [ \Elementor\Modules\DynamicTags\Module::TEXT_CATEGORY , \Elementor\Modules\DynamicTags\Module::NUMBER_CATEGORY ]; // Can also use `TEXT_CATEGORY` for numeric fields.
    }

    protected function register_controls() {
        // Meta Type Control (e.g., comment count, view count, etc.)
        $this->add_control(
            'meta_type',
            [
                'label' => __( 'Meta Type', 'wcf-addons-pro' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'comments' => __( 'Comments Count', 'wcf-addons-pro' ),
                    'views' => __( 'Views Count', 'wcf-addons-pro' ),                   
                    'categories' => __( 'Categories (Comma Separated)', 'wcf-addons-pro' ),
                    'tags' => __( 'Tags (Comma Separated)', 'wcf-addons-pro' ),
                    'author' => __( 'Author Name with Avatar', 'wcf-addons-pro' ),
                    'author_name' => __( 'Author Name', 'wcf-addons-pro' ),
                    'shares' => __( 'Total Share Count', 'wcf-addons-pro' ),
                    'reactions' => __( 'Total Reaction Count', 'wcf-addons-pro' ),
                    'date' => __( 'Post Date', 'wcf-addons-pro' ),
                    'created_date' => __( 'Post Created Date', 'wcf-addons-pro' ), // New option added
                    'modified_date' => __( 'Post Modified Date', 'wcf-addons-pro' ),
                    'excerpt' => __( 'Post Excerpt', 'wcf-addons-pro' ),
                    'title' => __( 'Post Title', 'wcf-addons-pro' ),
                    'permalink' => __( 'Post Permalink', 'wcf-addons-pro' ),
                    'status' => __( 'Post Status', 'wcf-addons-pro' ),
                    'post_type' => __( 'Post Type', 'wcf-addons-pro' ),
                ],
                'default' => 'comments',
            ]
        );
    }

    public function render() {
        $meta_type = $this->get_settings( 'meta_type' );

        switch ( $meta_type ) {
            case 'comments':
                $this->render_comment_count();
                break;
            case 'views':
                $this->render_view_count();
                break;
            case 'categories':
                $this->render_category();
                break;
            case 'tags':
                $this->render_tags();
                break;
            case 'author':
                $this->render_author_info();
                break;
            case 'author_name':
                $this->render_author_info('name');
                break;
            case 'shares':
                $this->render_share_count();
                break;
            case 'reactions':
                $this->render_reactions_count();
                break;
            case 'date':
                $this->render_post_date();
                break;
            case 'created_date': // New case for Post Created Date
                $this->render_created_date();
                break;
            case 'modified_date':
                $this->render_modified_date();
                break;
            case 'excerpt':
                $this->render_excerpt();
                break;
            case 'title':
                $this->render_title();
                break;
            case 'permalink':
                $this->render_permalink();
                break;
            case 'status':
                $this->render_post_status();
                break;
            case 'post_type':
                $this->render_post_type();
                break;
        }
    }

    // Render Comment Count
    private function render_comment_count() {
        $comments_count = get_comments_number();
        echo esc_html( $comments_count );
    }
    
    private function render_reactions_count() {
        $reactions = (int) get_post_meta( get_the_ID(), 'aaeaddon_post_total_reactions', true );
        $reactions = aaeaddon_format_number_count($reactions);
        echo esc_html( $reactions );
    }

    // Render Views Count (custom)
    private function render_view_count() {
        $view_count = (int) get_post_meta( get_the_ID(), 'wcf_post_views_count', true );
        $view_count = aaeaddon_format_number_count($view_count);
        echo esc_html( $view_count ?: 0 );
    }

    // Render Categories (Comma Separated with Links)
    private function render_category() {      
        $categories = [];
        if(get_post_type() === 'wcf-addons-template' ){
            $args = [
                'numberposts' => 1,
                'post_type'   => 'post',
                'orderby'     => 'menu_order',
                'order'       => 'ASC',
            ]; 
            $latest_posts = get_posts($args);      
            if (!is_wp_error( $latest_posts ) && !empty($latest_posts) && isset($latest_posts[0])) {  
                $categories = get_the_category($latest_posts[0]->ID);
            }
           
        }else{
            $categories = get_the_category();
        }
       
        if ( ! empty( $categories ) ) {
            $category_links = [];
            foreach ( $categories as $category ) {
                $category_links[] = sprintf( '<a href="%s">%s</a>', esc_url( get_category_link( $category->term_id ) ), esc_html( $category->name ) );
            }
            echo implode( ', ', $category_links );
        }
    }
    private function render_tags() {
        $categories = [];
        if(get_post_type() === 'wcf-addons-template' ){
            $args = [
                'numberposts' => 1,
                'post_type'   => 'post',
                'orderby'     => 'menu_order',
                'order'       => 'ASC',
            ]; 
            $latest_posts = get_posts($args);      
            if (!is_wp_error( $latest_posts ) && !empty($latest_posts) && isset($latest_posts[0])) {  
                $categories = get_the_tags($latest_posts[0]->ID);
            }
           
        }else{
            $categories = get_the_tags();
        }
       
        if ( ! empty( $categories ) ) {
            $category_links = [];
            foreach ( $categories as $category ) {
                $category_links[] = sprintf( '<a href="%s">%s</a>', esc_url( get_category_link( $category->term_id ) ), esc_html( $category->name ) );
            }
            echo implode( ', ', $category_links );
        }
    }

    // Render Author Info with Avatar and Name (Clickable)
    private function render_author_info($type=false) {
        $author_id = get_the_author_meta( 'ID' );
        $author_name = get_the_author();
        $author_avatar = get_avatar( $author_id, 32 ); // 32px avatar size
        $author_url = get_author_posts_url( $author_id ); // Get the author archive URL
        if($type=='name'){
            echo sprintf(
                '<a class="author-name" href="%s">%s</a>',
                esc_url( $author_url ),
                esc_html( $author_name )
            );
        }else{
            echo sprintf(
                '<span class="author-avatar">%s</span> <a class="author-name" href="%s">%s</a>',
                $author_avatar,
                esc_url( $author_url ),
                esc_html( $author_name )
            );
        }
      
    }

    // Render Share Count (Custom Meta Key)
    private function render_share_count() {
        $share_count = (int) get_post_meta( get_the_ID(), 'aae_post_shares_count', true );
        $share_count = aaeaddon_format_number_count($share_count);
        echo esc_html( $share_count );
    }

    // Render Post Date
    private function render_post_date() {
        $post_date = get_the_date();
        echo esc_html( $post_date );
    }

    // Render Post Created Date
    private function render_created_date() {
        $created_date = get_the_date( 'F j, Y' ); // Or use any format like 'Y-m-d'
        echo esc_html( $created_date );
    }

    // Render Post Modified Date
    private function render_modified_date() {
        $modified_date = get_the_modified_date();
        echo esc_html( $modified_date );
    }

    // Render Post Excerpt
    private function render_excerpt() {
        $excerpt = get_the_excerpt();
        echo esc_html( $excerpt );
    }

    // Render Post Title
    private function render_title() {
        $title = get_the_title();
        echo esc_html( $title );
    }

    // Render Post Permalink
    private function render_permalink() {
        $permalink = get_permalink();
        echo esc_url( $permalink );
    }

    // Render Post Status
    private function render_post_status() {
        $post_status = get_post_status();
        echo esc_html( ucfirst( $post_status ) );
    }

    // Render Post Type
    private function render_post_type() {
        $post_type = get_post_type();
        echo esc_html( ucfirst( $post_type ) );
    }
}
