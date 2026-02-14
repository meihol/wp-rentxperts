<?php

namespace arolax\Core;

/**
 * Tags.
 */
class Blog {
	/**
	 * register default hooks and actions for WordPress
	 * @return
	 */
	public function register() {

		add_filter( 'comment_form_defaults', [ $this, 'arolax_add_submit_button_attr_class' ] );
		add_filter( 'get_search_form', [ $this, 'arolax_search_form' ] );
		add_filter( 'next_posts_link_attributes', [ $this, 'next_posts_link_attributes' ] );
		add_filter( 'previous_posts_link_attributes', [ $this, 'previous_posts_link_attributes' ] );

		add_action( 'admin_menu', [ $this, 'remove_fw_settings' ], 999 );
		add_filter( 'csf_welcome_page', '__return_false' );

		add_action( 'wp_head', [ $this, 'pingback_header' ] );
		add_filter( 'body_class', [ $this, 'body_class' ] );
		add_filter( 'admin_init', [ $this, 'update_custom_option_store' ] );

		if ( ! is_admin() ) {
			add_filter( 'pre_get_posts', [ $this, 'arolax_search_filter' ] );
		}

		add_action( 'comment_form_before_fields', [ $this, 'comment_form_before_fields' ] );
		add_action( 'comment_form_after_fields', [ $this, 'comment_form_after_fields' ] );
		add_filter( 'comment_form_submit_field', [ $this, 'comment_form_submit_field' ], 10, 2 );

	}


	function comment_form_submit_field( $bt, $args ) {
		return $bt;
	}

	function comment_form_after_fields() {
		echo '</div>';
	}

	function comment_form_before_fields() {
		echo '<div class="comment-form-fields-wrapper order-3">';
	}

	public function update_custom_option_store() {

		$post_types = arolax_get_post_types();
		$tax        = arolax_get_all_custom_taxonomies();
		update_option( 'arolax_get_post_types_cache', $post_types );
		update_option( 'arolax_get_all_custom_taxonomies_cache', $tax );
	}

	public function body_class( $classes ) {
		$custom_classes = array( 'joya-gl-blog', 'arolax-base' );

		if ( arolax_option( 'enable_preloader', 0 ) ) {
			$custom_classes[] = 'arolax-preloader-active';
			//preloader markup
			add_action( 'wp_body_open', function () {
				get_template_part( 'template-parts/headers/content', 'preloader' );
			} );
		}
		$classes = array_merge( $classes, $custom_classes );

		return $classes;
	}


	public function pingback_header() {
		if ( is_singular() && pings_open() ) {
			printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
		}
	}

	public function remove_fw_settings() {
		remove_submenu_page( 'themes.php', 'fw-settings' );
	}

	public function next_posts_link_attributes( $attr ) {
		return 'class="page-link"';
	}

	public function previous_posts_link_attributes( $attr ) {
		return 'class="page-link"';
	}

	public function arolax_search_form( $form ) {

		$form = '
		    <div class="default-search__again-form">
			<form  method="get" action="' . esc_url( home_url( '/' ) ) . '" class="joya-search-form">
			    <input name="s" type="text" value="' . get_search_query() . '"  placeholder="' . esc_attr__( 'Search here', 'arolax' ) . '">
				<button aria-label="Search Button"><i class="icon-wcf-search"></i></button>
			</form></div>';

		return $form;
	}

	public function arolax_add_submit_button_attr_class( $arg ) {

		$arg['class_submit'] = 'submit btn-comment btn btn-primary';

		return $arg;
	}


	// allow search post type
	function arolax_search_filter( $query ) {

		if ( $query->is_search ) {
			$query->set( 'post_type', 'post' );
		}

		return $query;
	}


}




