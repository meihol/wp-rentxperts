<?php

namespace arolax\Core;

/**
 * Enqueue.
 */
class Enqueue {

	/**
	 * register default hooks and actions for WordPress
	 * @return
	 */
	public function register() {
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
	}

	public function enqueue_scripts() {
		wp_register_style( 'wcf-custom-icons', AROLAX_CSS . '/custom-icons.min.css', null, AROLAX_VERSION );

		// ::::::::::::::::::::::::::::::::::::::::::
		if ( ! is_admin() ) {
			wp_enqueue_style( 'arolax-fonts', arolax_google_fonts_url( [
				'DM Sans:300,400;500,600,700,800,900',
				'PT Serif:400;500,600,700'
			] ), null, AROLAX_VERSION );

			// Theme style
			wp_enqueue_style( 'wcf-custom-icons' );
			wp_enqueue_style( 'arolax-style', AROLAX_CSS . '/master.min.css', null, AROLAX_VERSION );

			if ( class_exists( 'WooCommerce' ) ) {
				wp_enqueue_style( 'arolax-woo', AROLAX_CSS . '/woo.css', null, AROLAX_VERSION );
			}
		}

		// javascripts
		// :::::::::::::::::::::::::::::::::::::::::::::::
		if ( ! is_admin() ) {
			wp_enqueue_script( 'arolax-script', AROLAX_JS . '/script.min.js', array( 'jquery' ), AROLAX_VERSION, true );

			$arolax_data = apply_filters( 'arolax/script/custom/data', [
				'ajax_url' => admin_url( 'admin-ajax.php' ),
				'cart_update_qty_change' => arolax_option( 'cart_uwq_change', false ),
			] );
			wp_localize_script( 'arolax-script', 'arolax_obj', $arolax_data );

			// Load WordPress Comment js
			if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
				wp_enqueue_script( 'comment-reply' );
			}
		}
	}
}
