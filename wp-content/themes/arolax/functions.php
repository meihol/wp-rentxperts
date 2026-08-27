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

/**
 * Custom Blog Posts Shortcode
 * Usage: [custom_blog_posts]
 */

function custom_blog_posts_shortcode($atts) {

    $atts = shortcode_atts(array(
        'posts_per_page' => 6,
    ), $atts, 'custom_blog_posts');

    $categories = get_categories(array(
        'hide_empty' => true,
    ));

    $query = new WP_Query(array(
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'posts_per_page' => intval($atts['posts_per_page']),
        'orderby'        => 'date',
        'order'          => 'DESC',
    ));

    ob_start();
    ?>

    <div class="custom-blog-wrapper">

        <!-- Search -->
        <!-- <div class="custom-blog-search">

            <div class="blog-search-left">

                <svg class="blog-search-icon"
                     viewBox="0 0 24 24"
                     fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <circle cx="11" cy="11" r="7.5"
                            stroke="currentColor"
                            stroke-width="2.2"/>
                    <path d="M16.5 16.5L21 21"
                          stroke="currentColor"
                          stroke-width="2.2"
                          stroke-linecap="round"/>
                </svg>

                <input
                    type="text"
                    id="custom-blog-search"
                    placeholder=""
                    autocomplete="off"
                >

            </div>

            <!-- Mic -->
            <button type="button"
                    class="blog-mic-btn"
                    aria-label="Voice search">

                <svg viewBox="0 0 24 24"
                     fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <rect x="8" y="2.5"
                          width="8"
                          height="13"
                          rx="4"
                          stroke="currentColor"
                          stroke-width="2"/>
                    <path d="M5 11.5C5 15.366 8.134 18 12 18C15.866 18 19 15.366 19 11.5"
                          stroke="currentColor"
                          stroke-width="2"
                          stroke-linecap="round"/>
                    <path d="M12 18V21.5"
                          stroke="currentColor"
                          stroke-width="2"
                          stroke-linecap="round"/>
                    <path d="M9 21.5H15"
                          stroke="currentColor"
                          stroke-width="2"
                          stroke-linecap="round"/>
                </svg>

            </button>

            <!-- Filter -->
            <button type="button"
                    class="blog-filter-btn"
                    id="custom-blog-filter-btn"
                    aria-label="Filter">

                <svg viewBox="0 0 24 24"
                     fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <path d="M3 5H21L14 13V19L10 21V13L3 5Z"
                          stroke="currentColor"
                          stroke-width="2"
                          stroke-linejoin="round"/>
                </svg>

            </button>

        </div> -->


        <!-- Category Filter -->
        <div class="custom-blog-filter-list" id="custom-blog-filter-list">

            <button type="button"
                    class="blog-category-filter active"
                    data-category="all">
                All
            </button>

            <?php foreach ($categories as $category) : ?>

                <button type="button"
                        class="blog-category-filter"
                        data-category="<?php echo esc_attr($category->term_id); ?>">
                    <?php echo esc_html($category->name); ?>
                </button>

            <?php endforeach; ?>

        </div>


        <!-- Heading -->
        <div class="custom-blog-heading">

            <h1>Blog</h1>

            <h2>Latest Posts</h2>

        </div>


        <!-- Posts -->
        <div class="custom-blog-grid"
             id="custom-blog-grid">

            <?php

            if ($query->have_posts()) :

                while ($query->have_posts()) :
                    $query->the_post();

                    $post_id = get_the_ID();

                    $post_categories = get_the_category();

                    $category_name = '';
                    $category_id = '';

                    if (!empty($post_categories)) {
                        $category_name = $post_categories[0]->name;
                        $category_id   = $post_categories[0]->term_id;
                    }

                    ?>

                    <article
                        class="custom-blog-card"
                        data-title="<?php echo esc_attr(strtolower(get_the_title())); ?>"
                        data-content="<?php echo esc_attr(strtolower(wp_strip_all_tags(get_the_excerpt()))); ?>"
                        data-category="<?php echo esc_attr($category_id); ?>">

                        <!-- Image -->
                        <a href="<?php the_permalink(); ?>"
                           class="custom-blog-image">

                            <?php

                            if (has_post_thumbnail()) {

                                the_post_thumbnail(
                                    'large',
                                    array(
                                        'loading' => 'lazy',
                                        'alt' => esc_attr(get_the_title()),
                                    )
                                );

                            } else {

                                echo '<div class="blog-no-image"></div>';

                            }

                            ?>

                            <?php if ($category_name) : ?>

                                <span class="custom-blog-category">
                                    <?php echo esc_html($category_name); ?>
                                </span>

                            <?php endif; ?>

                        </a>


                        <!-- Content -->
                        <div class="custom-blog-content">

                            <h3>
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h3>

                            <div class="custom-blog-date">
                                <?php echo esc_html(get_the_date('M j, Y')); ?>
                            </div>

                        </div>

                    </article>

                    <?php

                endwhile;

                wp_reset_postdata();

            else :

                ?>

                <div class="custom-blog-no-results">
                    No posts found.
                </div>

                <?php

            endif;

            ?>

        </div>

        <!-- No Search Result -->
        <div class="custom-blog-search-result"
             id="custom-blog-no-result">
            No matching posts found.
        </div>

    </div>
    <?php
    return ob_get_clean();
}

add_shortcode('custom_blog_posts', 'custom_blog_posts_shortcode');