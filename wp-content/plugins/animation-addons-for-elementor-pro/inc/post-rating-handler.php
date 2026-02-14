<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Register Custom Post Type for Post Ratings
function aaeaddon_register_post_rating_cpt() {
	$args = [
		'labels'    => [
			'name'          => 'Post Ratings',
			'singular_name' => 'Post Rating'
		],
		'public'    => false,
		'show_ui'   => true,
		'menu_icon' => 'dashicons-star-filled',
		'supports'  => [ 'title' ],
	];
	register_post_type( 'aaeaddon_post_rating', $args );
}

add_action( 'init', 'aaeaddon_register_post_rating_cpt' );

// Add custom columns to the `aaeaddon_post_rating` admin table
function aaeaddon_post_rating_columns( $columns ) {
	$columns = [
		'cb'     => '<input type="checkbox" />',
		'title'  => 'Post ID',
		'rating' => 'Rating',
		'review' => 'Review',
		'date'   => 'Date'
	];

	return $columns;
}

add_filter( 'manage_aaeaddon_post_rating_posts_columns', 'aaeaddon_post_rating_columns' );

// Populate the custom columns with data
function aaeaddon_post_rating_custom_column_content( $column, $post_id ) {
	switch ( $column ) {
		case 'rating':
			$rating = get_post_meta( $post_id, 'rating', true );
			echo $rating ? intval( $rating ) : 'No rating';
			break;

		case 'review':
			$review = get_post_meta( $post_id, 'review', true );
			echo $review ? esc_html( $review ) : 'No review';
			break;
	}
}

add_action( 'manage_aaeaddon_post_rating_posts_custom_column', 'aaeaddon_post_rating_custom_column_content', 10, 2 );


// AJAX Handler for Rating Submission
add_action( 'wp_ajax_aaeaddon_submit_post_review_rating', 'handle_post_rating_submission' );
add_action( 'wp_ajax_nopriv_aaeaddon_submit_post_review_rating', 'handle_post_rating_submission' ); // Allow non-logged-in users

function handle_post_rating_submission() {
	if ( ! wp_verify_nonce( $_REQUEST['nonce'], 'wcf-addons-frontend' ) ) {
		exit( 'No naughty business please' );
	}

	if ( ! isset( $_POST['post_id'], $_POST['rating'], $_POST['review'] ) ) {
		wp_send_json_error( [ 'message' => 'Invalid request' ] );

		return;
	}

	$post_id     = intval( $_POST['post_id'] );
	$rating      = intval( $_POST['rating'] );
	$review_text = sanitize_text_field( $_POST['review'] );
	$user_id     = get_current_user_id();
	// Insert rating as custom post type entry
	$rating_post_id = wp_insert_post( [
		'post_type'   => 'aaeaddon_post_rating',
		'post_title'  => "$post_id",
		'post_status' => 'publish',
		'meta_input'  => [
			'post_id' => $post_id,
			'user_id' => $user_id,
			'rating'  => $rating,
			'review'  => $review_text
		]
	] );

	if ( $rating_post_id ) {
		wp_send_json_success( [ 'message' => 'Review submitted successfully!' ] );
	} else {
		wp_send_json_error( [ 'message' => 'Error saving review.' ] );
	}
}
