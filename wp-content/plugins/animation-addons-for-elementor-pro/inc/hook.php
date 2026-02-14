<?php
use Elementor\Modules\Library\Documents\Library_Document;
use Elementor\Plugin as ElementorPlugin;

add_filter( 'wcf_addons_dashboard_config', 'wcf_addon_pro_dashboard_config', 9, 1 );
add_filter( 'wcf_addons_dashboard_config', 'wcf_addon_pro_widgets_config', 9, 1 );
add_filter( 'wcf_addons_editor_config', 'wcf_addon_pro_dashboard_config', 9, 1 );

function wcf_addon_pro_widgets_config( $configs ) {

	$wgt           = get_option( 'wcf_save_widgets' );
	$saved_widgets = is_array( $wgt ) ? array_keys( $wgt ) : [];

	if ( isset( $configs['dashboardProWidget'] ) ) {

		foreach ( $configs['dashboardProWidget'] as $slug => &$proitem ) {

			if ( in_array( $slug, $saved_widgets ) ) {
				$proitem['is_active'] = true;
			}

		}

	}

	return $configs;
}

if ( ! function_exists( 'wcf_animation_builder_body_class' ) ) {

	function wcf_animation_builder_body_class( $cls = [] ) {
		$css_class = apply_filters( 'wcf_animation_builder_body_class', $cls );
		echo 'class="' . esc_attr( implode( ' ', $css_class ) ) . '"';
	}
}


add_action( 'init', function () {
	$wgt = get_option( 'wcf_save_widgets' );

	if ( isset( $wgt['video-story'] ) ) {
		$post_type = 'video-story';
		$args      = [
			'label'    => __( 'Video Story', 'animation-addons-for-elementor-pro' ),
			'public'   => true,
			'supports' => [ 'title', 'editor', 'thumbnail' ],
		];
		register_post_type( $post_type, $args );

		// Category
		$taxonomy_args = [
			'hierarchical' => true,
			'label' => __('Categories', 'animation-addons-for-elementor-pro'),
		];
		register_taxonomy('video-story-category', 'video-story', $taxonomy_args);
	}
} );

function wcf_addon_pro_dashboard_config($configs){$status=get_option('wcf_addon_sl_license_status');if($status&&$status=='valid'){$configs['wcf_valid']=true;$configs['product_status']=get_transient(WCF_ADDONS_PRO_STATUS_CACH_KEY);}else{$configs['wcf_valid']=false;}$configs['sl_lic']=get_option('wcf_addon_sl_license_key');$configs['sl_lic_email']=get_option('wcf_addon_sl_license_email');return $configs;}

add_action( 'init', function () {
	// Get saved widgets option
	$wgt = get_option( 'wcf_save_widgets' );

	// Check if the widget 'video-story' is set
	if ( isset( $wgt['video-story'] ) ) {
		$post_type = 'video-story';

		// Register the custom post type 'video-story'
		$args = [
			'label'               => __( 'Video Story', 'animation-addons-for-elementor-pro' ),
			'public'              => true,
			'supports'            => [ 'title', 'editor', 'thumbnail' ],
			'show_ui'             => true,
			'show_in_rest'        => true, // For Gutenberg support
			'has_archive'         => true, // Optional, for having an archive page
			'rewrite'             => [ 'slug' => 'video-story' ],
			'menu_position'       => 5,
			'menu_icon'           => 'dashicons-video-alt2', // Optional, icon for the post type
		];
		// Register the post type
		register_post_type( $post_type, $args );

		// Register taxonomy for 'video-story' post type
		$taxonomy_args = [
			'hierarchical'        => true,
			'label'               => __( 'Categories', 'animation-addons-for-elementor-pro' ),
			'show_ui'             => true,
			'show_admin_column'   => true,
			'show_in_rest'        => true, // For Gutenberg support
			'rewrite'             => [ 'slug' => 'video-story-category' ],
		];
		// Register the taxonomy
		register_taxonomy( 'video-story-category', 'video-story', $taxonomy_args );
	}
});

// Add the 'Video Link' metabox
add_action( 'add_meta_boxes', function () {
	add_meta_box(
		'video_story_link',               // Metabox ID
		'Video Link',                     // Metabox Title
		'render_video_link_metabox',       // Callback function to render the metabox
		'video-story',                    // Post type where the metabox will appear
		'normal',                          // Context (normal, side, etc.)
		'high'                             // Priority (high, low, etc.)
	);
});

// Callback function to render the metabox content
function render_video_link_metabox( $post ) {
	// Retrieve current video link if it exists
	$video_link = get_post_meta( $post->ID, '_video_story_link', true );

	// Display the form field for the video link
	echo sprintf('<label for="video_link">%s</label>', esc_html__('Enter Video URL:','animation-addons-for-elementor-pro'));
	echo '<input type="url" id="video_link" name="video_link" value="' . esc_attr( $video_link ) . '" class="widefat" />';
}

// Save the 'Video Link' metabox value
add_action( 'save_post', function ( $post_id ) {
	// Check if our nonce is set
	if ( ! isset( $_POST['video_link_nonce'] ) ) {
		return $post_id;
	}

	$nonce = $_POST['video_link_nonce'];

	// Verify that the nonce is valid
	if ( ! wp_verify_nonce( $nonce, 'save_video_link' ) ) {
		return $post_id;
	}

	// Check if this is a valid 'video-story' post
	if ( 'video-story' !== get_post_type( $post_id ) ) {
		return $post_id;
	}

	// Check if the video link is being updated
	if ( isset( $_POST['video_link'] ) ) {
		$video_link = sanitize_text_field( $_POST['video_link'] );

		// Update the meta field in the database
		update_post_meta( $post_id, '_video_story_link', $video_link );
	}

	return $post_id;
});

// Add nonce for security when saving the metabox data
add_action( 'edit_form_after_title', function ( $post ) {
	if ( 'video-story' === $post->post_type ) {
		wp_nonce_field( 'save_video_link', 'video_link_nonce' );
	}
});


function aaeaddons_pro_set_visited_post_cookie() {
  // Check if we're on a single post page
  if ( is_single() ) {
      global $post;

      // Get the current post ID and post type
      $post_id = $post->ID;
      $post_type = $post->post_type;

      // Define the max visited posts per post type and expiration (these can be customized)
      $max_visited_posts = 15; // Maximum posts per post type
      $cookie_expiration = 14 * 24 * 60 * 60; // 14 days expiration

      // Get the current visited posts cookie (if exists)
      $visited_posts = isset( $_COOKIE['aae_visited_posts'] ) ? json_decode( stripslashes( $_COOKIE['aae_visited_posts'] ), true ) : [];

      // Check if the current post type already has a visited list, otherwise create one
      if ( ! isset( $visited_posts[$post_type] ) ) {
          $visited_posts[$post_type] = [];
      }

      // If the post ID is not in the current post type's visited list, add it
      if ( ! in_array( $post_id, $visited_posts[$post_type] ) ) {
          // Add the new post ID at the start of the array (for latest posts)
          array_unshift( $visited_posts[$post_type], $post_id );

          // Ensure we only store a maximum of $max_visited_posts post IDs per post type
          if ( count( $visited_posts[$post_type] ) > $max_visited_posts ) {
              array_pop( $visited_posts[$post_type] ); // Remove the oldest post (last element)
          }

          // Set the cookie with the updated visited posts list
          setcookie( 'aae_visited_posts', json_encode( $visited_posts ), time() + $cookie_expiration, '/' );
      }
  }
}
add_action( 'template_redirect', 'aaeaddons_pro_set_visited_post_cookie' );

if(!function_exists('aae_widget_wp_query_type')){
	function aae_widget_wp_query_type($types){

		$types['most_share_count']    = esc_html__( 'Most Share Posts', 'animation-addons-for-elementor-pro' );
		$types['trending_score']      = esc_html__( 'Trending Posts', 'animation-addons-for-elementor-pro' );
		$types['most_popular']        = esc_html__( 'Most Popular', 'animation-addons-for-elementor-pro' );
		$types['most_reactions']      = esc_html__( 'Most Reactions', 'animation-addons-for-elementor-pro' );
		$types['most_reactions_love'] = esc_html__( 'Most Love', 'animation-addons-for-elementor-pro' );
		$types['most_reactions_like'] = esc_html__( 'Most Like', 'animation-addons-for-elementor-pro' );
		$types['recent_visited']      = esc_html__( 'Recent Visited(cookie)', 'animation-addons-for-elementor-pro' );
		$types['most_views']          = esc_html__( 'Most Views', 'animation-addons-for-elementor-pro' );
		$types['top_post_week']       = esc_html__( 'Top Post This Week', 'animation-addons-for-elementor-pro' );

		return $types;
	}
}

add_filter('aae_widget_wp_query_type', 'aae_widget_wp_query_type');

function aae_post_update_trending_score($post_id) {    
    // Fetch metrics
    $views = (int) get_post_meta($post_id, 'wcf_post_views_count', true);
    $comments = (int) get_comments_number($post_id);
    $likes = (int) get_post_meta($post_id, 'aae_post_likes', true);
    // Calculate the trending score
    $trending_score = ($views * 0.5) + ($comments * 0.3) + ($likes * 0.2);  
    update_post_meta($post_id, 'aae_trending_score', floatval($trending_score));
}

function aaeaddon_track_post_views_and_update_score($post_id) {
    if (!is_single() || empty($post_id)) return;
	
    // Update post views count
    $count_key = 'wcf_post_views_count';
    $count     = get_post_meta($post_id, $count_key, true);
    $count     = $count ? $count + 1 : 1;
    update_post_meta($post_id, $count_key, $count);
    // Update trending score after increasing views
    aae_post_update_trending_score($post_id);
}

add_action('wp', function () {

    if (is_single()) {
        global $post;
        if ($post && !is_user_logged_in()) { // Optional: Skip for logged-in users to avoid skewed metrics
			if (!isset($_COOKIE['aaepost_viewed_' . $post->ID])) {				
				 setcookie('aaepost_viewed_' . $post->ID, true, time() + 3600, '/');
                 aaeaddon_track_post_views_and_update_score($post->ID);
			}
        }		
    }   
	
});


function aaeaddon_post_reaction_ajax() {
	if ( ! wp_verify_nonce( $_REQUEST['nonce'], 'wcf-addons-frontend' ) ) {
		exit( 'No naughty business please' );
	}
	
    $post_id = absint( $_POST['post_id'] );
    $reaction = sanitize_text_field( $_POST['reaction'] );

    if ( ! $post_id || ! $reaction ) {
        wp_send_json_error( 'Invalid data' );
    }

    $reactions = get_post_meta( $post_id, 'aaeaddon_post_reactions', true );
    if ( ! is_array( $reactions ) ) {
        $reactions = [];
    }

    if ( isset( $reactions[ $reaction ] ) ) {
        $reactions[ $reaction ]++;
    } else {
        $reactions[ $reaction ] = 1;
    }
    
	$reactions_count = array_sum( array_values($reactions) );
	
	foreach($reactions as $k=> $single){
		update_post_meta( $post_id, 'aaeaddon_post_reactions_'.$k, $single );
	}
    update_post_meta( $post_id, 'aaeaddon_post_reactions', $reactions );
    update_post_meta( $post_id, 'aaeaddon_post_total_reactions', $reactions_count );
    wp_send_json_success( $reactions );
}
add_action( 'wp_ajax_nopriv_aaeaddon_post_reaction', 'aaeaddon_post_reaction_ajax' );
add_action( 'wp_ajax_aaeaddon_post_reaction', 'aaeaddon_post_reaction_ajax' );

add_action( 'wp_body_open', function () {
	echo '<div id="smooth-wrapper"><div id="smooth-content">';
} );

add_action( 'wp_footer', function () {
	echo '</div></div>';
}, - 1 );


add_filter( 'option_wcf_save_extensions', function( $extensions ){

	$serialize = serialize($extensions); 
	
	if (strpos($serialize, 'animation') !== false ) {
		$extensions['gsap-extensions']     = true;
		$extensions['wcf-gsap']            = true;
		$extensions['wcf-smooth-scroller'] = true;
	}
	
	if (strpos($serialize, 'pin') !== false) {	
	   $extensions['wcf-smooth-scroller'] = true;
	}
	
	if (strpos($serialize, 'scroll') !== false || strpos($serialize, 'animation-builder') !== false) {	
		$extensions['scroll-trigger']  = true;
		$extensions['gsap-extensions'] = true;
		$extensions['wcf-gsap']        = true;
	}
	
	if (strpos($serialize, 'portfolio-filter') !== false || strpos($serialize, 'flip') !== false) {	
		$extensions['gsap-extensions'] = true;
		$extensions['wcf-gsap']        = true;
		$extensions['flip-extension']  = true;
	}
	
	if (strpos($serialize, 'effect') !== false) {	
		$extensions['gsap-extensions'] = true;
		$extensions['effect']          = true;
	}	
	
	return $extensions;
});

function aaeaddon_stemplate_download_custom_fonts() {			
   

		ini_set('max_execution_time', '300');
        $args = array(
			'post_type' => 'wcf-custom-fonts',
			'post_status' => 'any',
            'posts_per_page' => -1, // Get all posts
            'meta_query'     => array(
                array(
                    'key'     => 'wcf_addon_custom_fonts',
                    'compare' => 'EXISTS', // Ensure the meta key exists
                ),
                array(
                    'key'     => 'wcf_addon_custom_fonts',
                    'value'   => '',
                    'compare' => '!=', // Ensure value is not empty
                ),
            ),
            'fields'         => 'ids', // Fetch only post IDs for better performance
        );

        $post_ids = get_posts($args);

        if (!empty($post_ids)) { 
            foreach ($post_ids as $post_id) {
                // Retrieve the meta data for the post
                $font_data = get_post_meta($post_id, 'wcf_addon_custom_fonts', true);             

                // Check if meta data is valid and process it
                if (is_array($font_data) && !empty($font_data)) {
                    aaeaddon_update_font_files_for_post($post_id, $font_data);
                }
            }
        } else {
            error_log('No matching posts found for post type: ' . $post_type . ' and post status: ' . $post_status);
        }
    	
}


function aaeaddon_update_font_files_for_post( $post_id, $fonts ) {
    // Get local domain for comparison.
    $local_domain = parse_url(home_url(), PHP_URL_HOST);

    // Skip file processing entirely if running on localhost.
    // if (in_array($local_domain, array('localhost', '127.0.0.1'), true)) {
    //     return $fonts;
    // }

    // Allowed font file types.
    $filetypes = ['woff', 'woff2', 'ttf', 'otf', 'eot'];

    // Loop through each font in the array.
    foreach ($fonts as $index => $font) {
		
        foreach ($filetypes as $filetype) {
            // Check if the file URL exists for each file type.
            if (!empty($font[$filetype]['file']['url'])) {
                $file_url   = $font[$filetype]['file']['url'];
                $parsed_url = parse_url($file_url);
				
                // If the file's domain differs from the local domain, process it.
                if (isset($parsed_url['host']) && $parsed_url['host'] !== $local_domain) {
                    // Retrieve the remote file.
                    $response = wp_remote_get($file_url, array('sslverify' => false, 'timeout' => 30,));
					
                    if (is_wp_error($response)) {
                        continue; // Skip this file if there's an error.
                    }

                    $file_data = wp_remote_retrieve_body($response);
                    if (empty($file_data)) {
                        continue;
                    }

                    // Determine filename from URL.
                    $filename = basename($file_url);			
					
                    // Save file to local uploads directory.
                    $upload = wp_upload_bits($filename, null, $file_data);
                    if (!empty($upload['error'])) {
                        continue;
                    }

                    $new_url   = $upload['url'];
                    $file_path = $upload['file'];
					
                    // Prepare attachment data.
                    $wp_filetype = wp_check_filetype($filename, null);
                    $attachment  = array(
                        'guid'           => $new_url,
                        'post_mime_type' => $wp_filetype['type'],
                        'post_title'     => sanitize_file_name($filename),
                        'post_content'   => '',
                        'post_status'    => 'inherit'
                    );

                    // Insert attachment into the database.
                    $attach_id = wp_insert_attachment($attachment, $file_path, $post_id);
                    if (!is_wp_error($attach_id)) {
                        // Include image.php for generating metadata.
                        require_once(ABSPATH . 'wp-admin/includes/image.php');
                        $attach_data = wp_generate_attachment_metadata($attach_id, $file_path);
                        wp_update_attachment_metadata($attach_id, $attach_data);

                        // Update the file URL and ID in the fonts array.
                        $fonts[$index][$filetype]['file']['url'] = $new_url;
                        $fonts[$index][$filetype]['file']['id']  = $attach_id;
                    }
                }
            }
        }
    }

    // Update the meta key 'wcf_addon_custom_fonts' for the given post ID.
    update_post_meta($post_id, 'wcf_addon_custom_fonts', $fonts);

    // Optionally return the updated fonts array.
    return $fonts;
}

add_action('aaeaddon/starter-template/import/step/metasettings', 'aaeaddon_stemplate_download_custom_fonts');

add_filter('elementor/image_url', function ($url) {
    return str_replace(['http://', 'https://'], '', $url);
});


function aaeaddon_hk_allow_svg_uploads($mimes) {
    // Allow SVG files
    $mimes['svg']  = 'image/svg+xml';
    $mimes['svgz'] = 'image/svg+xml'; // Compressed SVG
    return $mimes;
}

add_filter('upload_mimes', 'aaeaddon_hk_allow_svg_uploads');