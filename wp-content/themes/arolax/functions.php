<?php

/*----------------------------------------------------
SHORTHAND CONTANTS FOR THEME VERSION
-----------------------------------------------------*/
if ( site_url() === 'http://localhost:8080/development' ) {
    define( 'AROLAX_VERSION', time() );
} else {
    define( 'AROLAX_VERSION', 2.0 );
    
}

/*----------------------------------------------------
SHORTHAND CONTANTS FOR THEME ASSETS URL
-----------------------------------------------------*/
define( 'AROLAX_THEME_URI', get_template_directory_uri() );
define( 'AROLAX_ASSETS', AROLAX_THEME_URI . '/assets/' );
define( 'AROLAX_IMG', AROLAX_THEME_URI . '/assets/imgs' );
define( 'AROLAX_CSS', AROLAX_THEME_URI . '/assets/css' );
define( 'AROLAX_JS', AROLAX_THEME_URI . '/assets/js' );

/*----------------------------------------------------
SHORTHAND CONTANTS FOR THEME ASSETS DIRECTORY PATH
-----------------------------------------------------*/
define( 'AROLAX_THEME_DIR', get_template_directory() );
define( 'AROLAX_IMG_DIR', AROLAX_THEME_DIR . '/assets/imgs' );
define( 'AROLAX_CSS_DIR', AROLAX_THEME_DIR . '/assets/css' );
define( 'AROLAX_JS_DIR', AROLAX_THEME_DIR . '/assets/js' );



/*----------------------------------------------------
LOAD Classes
-----------------------------------------------------*/
if ( file_exists( dirname( __FILE__ ) . '/app/loader.php' ) ):
    require_once dirname( __FILE__ ) . '/app/loader.php';    
endif;
/*----------------------------------------------------
SET UP THE CONTENT WIDTH VALUE BASED ON THE THEME'S DESIGN
-----------------------------------------------------*/
if ( !isset( $content_width ) ) {
    $content_width = 800;
}

add_filter( 'use_block_editor_for_post', '__return_false' );

// Disable Gutenberg for widgets.
add_filter( 'use_widgets_block_editor', '__return_false' );


//Woocommerce Supports
function arolex_add_woocommerce_support() {
	add_theme_support( 'woocommerce', array(
		'thumbnail_image_width' => 350,
		'single_image_width'    => 350,
		'product_grid'          => array(
			'default_rows'    => 3,
			'min_rows'        => 2,
			'max_rows'        => 8,
			'default_columns' => 4,
			'min_columns'     => 2,
			'max_columns'     => 5,
		),
	) );

	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );


}

add_action( 'after_setup_theme', 'arolex_add_woocommerce_support' );

function arolax_enqueue_scripts() {
	// Swiper CSS
    // wp_enqueue_style(
    //     'swiper-css',
    //     'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css',
    //     array(),
    //     null
    // );

    // // Swiper JS
    // wp_enqueue_script(
    //     'swiper-js',
    //     'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js',
    //     array(),
    //     null,
    //     true
    // );

    wp_enqueue_script(
        'arolax-main-js',               // Handle
        AROLAX_JS . '/theme-script.js',         // Path to JS file
        array('jquery'),                // Dependencies (optional)
        null,                           // Version (set to null or use a version number)
        true                            // Load in footer
    );
	
	wp_enqueue_style(
        'arolax-main-css',                     // Handle
        AROLAX_CSS . '/theme-style.css',       // Path to CSS file
        array(),                               // Dependencies
        null                                    // Version
    );
}
add_action( 'wp_enqueue_scripts', 'arolax_enqueue_scripts' );

function rentexpert_popup(){ ?>
	<div id="careerPopup" class="career-popup-overlay">
		<div class="career-popup-box">
			<button id="closeCareerPopup" class="popup-close-btn">&times;</button>
			<h2 class="popup-title">Apply for Job</h2>
			<div id="careerFormContainer">
			<?php echo do_shortcode('[contact-form-7 id="c5f8f5d" title="Job Apply Form"]'); ?>
			</div>
		</div>
	</div>
<?php }
add_action('wp_footer','rentexpert_popup');

function wp_convert_to_webp_on_upload($file) {

    $file_path = $file['file'];
    
    // $file_type = mime_content_type($file_path);
    
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $file_type = finfo_file($finfo,$file_path);
    finfo_close($finfo);

    if (in_array($file_type, ['image/jpeg', 'image/png'])) {

        $image = null;

        if ($file_type == 'image/jpeg') {
            $image = imagecreatefromjpeg($file_path);
        } elseif ($file_type == 'image/png') {
            $image = imagecreatefrompng($file_path);
        }

        if ($image) {
            $webp_path = preg_replace('/\.(jpg|jpeg|png)$/i', '.webp', $file_path);

            // Quality (0-100)
            imagewebp($image, $webp_path, 98);

            imagedestroy($image);

            // Replace original file
            unlink($file_path);

            $file['file'] = $webp_path;
            $file['url'] = preg_replace('/\.(jpg|jpeg|png)$/i', '.webp', $file['url']);
            $file['type'] = 'image/webp';
        }
    }

    return $file;
}
add_filter('wp_handle_upload', 'wp_convert_to_webp_on_upload');