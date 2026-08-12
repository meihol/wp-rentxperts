<?php
/**
 * Floating Inquiry Button with Modal Popup
 * Suffix: bd4ab031
 */

namespace AngieSnippets\FloatingInquiryButton_bd4ab031;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

const FLOATING_INQUIRY_BUTTON_ASSETS_VERSION_bd4ab031 = '1.1.0';

/**
 * Enqueue scripts and styles
 */
function enqueue_assets_bd4ab031() {
	wp_enqueue_style(
		'floating-inquiry-button-style-bd4ab031',
		angie_cs_get_snippet_asset_url( __FILE__, 'style.css' ),
		[],
		FLOATING_INQUIRY_BUTTON_ASSETS_VERSION_bd4ab031
	);

	wp_enqueue_script(
		'floating-inquiry-button-script-bd4ab031',
		angie_cs_get_snippet_asset_url( __FILE__, 'script.js' ),
		[ 'jquery' ],
		FLOATING_INQUIRY_BUTTON_ASSETS_VERSION_bd4ab031,
		true
	);
}
add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\\enqueue_assets_bd4ab031' );

/**
 * Render Floating Button and Modal in Footer
 */
function render_floating_button_bd4ab031() {
	$form_shortcode = '[contact-form-7 id="e21c623" title="Inquiry Form"]';
	?>
	<!-- Floating Inquiry Button Trigger -->
	<div class="rx-floating-btn-wrap-bd4ab031">
		<button class="rx-floating-trigger-bd4ab031" aria-label="<?php esc_attr_e( 'Inquiry Form', 'angie-snippets' ); ?>">
			<span class="rx-floating-icon-bd4ab031">
				<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
					<path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
				</svg>
			</span>
			<span class="rx-floating-text-bd4ab031"><?php esc_html_e( 'Enquire Now', 'angie-snippets' ); ?></span>
		</button>
	</div>

	<!-- Floating Modal Popup -->
	<div class="rx-floating-modal-bd4ab031" id="rx-floating-modal-bd4ab031" aria-hidden="true" role="dialog">
		<div class="rx-modal-overlay-bd4ab031"></div>
		<div class="rx-modal-container-bd4ab031">
			<button class="rx-modal-close-bd4ab031" aria-label="<?php esc_attr_e( 'Close Modal', 'angie-snippets' ); ?>">
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
					<line x1="18" y1="6" x2="6" y2="18"></line>
					<line x1="6" y1="6" x2="18" y2="18"></line>
				</svg>
			</button>
			<div class="rx-modal-content-bd4ab031">
				<div class="rx-modal-header-bd4ab031">
					<h3><?php esc_html_e( 'Inquiry Form', 'angie-snippets' ); ?></h3>
				</div>
				<div class="rx-modal-body-bd4ab031">
					<?php echo do_shortcode( $form_shortcode ); ?>
				</div>
			</div>
		</div>
	</div>
	<?php
}
add_action( 'wp_footer', __NAMESPACE__ . '\\render_floating_button_bd4ab031' );
