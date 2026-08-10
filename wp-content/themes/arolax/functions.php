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
        <div class="custom-blog-search">

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

        </div>


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


    <style>

        /* =========================
           MAIN WRAPPER
        ========================= */

        .custom-blog-wrapper {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 25px 60px;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }


        /* =========================
           SEARCH BAR
        ========================= */

        .custom-blog-search {
            width: 100%;
            height: 88px;
            border: 3px solid #666;
            border-radius: 50px;
            background: #f5f5f5;

            display: flex;
            align-items: center;

            padding: 0 18px 0 45px;
            box-sizing: border-box;

            margin-bottom: 85px;
        }


        .blog-search-left {
            flex: 1;

            display: flex;
            align-items: center;
        }


        .blog-search-icon {
            width: 43px;
            height: 43px;
            flex-shrink: 0;
            color: #000;
        }


        #custom-blog-search {
            width: 100%;
            border: 0;
            outline: none;
            background: transparent;

            font-size: 22px;
            padding: 8px 15px;
            color: #222;
        }


        .blog-mic-btn,
        .blog-filter-btn {
            border: 0;
            background: transparent;

            width: 52px;
            height: 52px;

            padding: 10px;

            display: flex;
            align-items: center;
            justify-content: center;

            cursor: pointer;

            color: #777;
        }


        .blog-mic-btn svg {
            width: 38px;
            height: 38px;
        }


        .blog-filter-btn svg {
            width: 37px;
            height: 37px;
        }


        /* =========================
           CATEGORY FILTER
        ========================= */

        .custom-blog-filter-list {
            display: none;

            flex-wrap: wrap;
            gap: 10px;

            justify-content: center;

            margin-top: -55px;
            margin-bottom: 55px;
        }


        .custom-blog-filter-list.show {
            display: flex;
        }


        .blog-category-filter {
            border: 1px solid #c52828;
            background: #fff;
            color: #c52828;

            padding: 9px 18px;

            border-radius: 25px;

            font-size: 15px;
            cursor: pointer;

            transition: all .2s ease;
        }


        .blog-category-filter:hover,
        .blog-category-filter.active {
            background: #c52828;
            color: #fff;
        }


        /* =========================
           HEADING
        ========================= */

        .custom-blog-heading {
            text-align: center;
            margin-bottom: 62px;
        }


        .custom-blog-heading h1 {
            margin: 0 0 25px;

            font-size: 62px;
            line-height: 1;

            font-weight: 800;

            color: #c52828;

            letter-spacing: 5px;
        }


        .custom-blog-heading h2 {
            margin: 0;

            font-size: 37px;
            line-height: 1.2;

            font-weight: 500;

            color: #333;

            letter-spacing: 1px;
        }


        /* =========================
           GRID
        ========================= */

        .custom-blog-grid {
            display: grid;

            grid-template-columns: repeat(2, minmax(0, 1fr));

            column-gap: 32px;
            row-gap: 45px;
        }


        /* =========================
           CARD
        ========================= */

        .custom-blog-card {
            min-width: 0;
        }


        /* =========================
           IMAGE
        ========================= */

        .custom-blog-image {
            position: relative;

            display: block;

            width: 100%;

            aspect-ratio: 1.38 / 1;

            overflow: hidden;

            text-decoration: none;

            background: #eee;
        }


        .custom-blog-image img {
            width: 100%;
            height: 100%;

            object-fit: cover;

            display: block;

            transition: transform .35s ease;
        }


        .custom-blog-image:hover img {
            transform: scale(1.04);
        }


        /* =========================
           CATEGORY BADGE
        ========================= */

        .custom-blog-category {
            position: absolute;

            right: 0;
            top: 0;

            background: #c52828;
            color: #fff;

            padding: 11px 18px 12px;

            min-width: 105px;

            text-align: center;

            font-size: 16px;
            font-weight: 500;

            text-transform: uppercase;

            line-height: 1.2;

            border-radius: 0 0 0 20px;

            box-sizing: border-box;
        }


        /* =========================
           CONTENT
        ========================= */

        .custom-blog-content {
            padding-top: 24px;
        }


        .custom-blog-content h3 {
            margin: 0 0 18px;

            font-size: 31px;
            line-height: 1.55;

            font-weight: 500;

            color: #050505;
        }


        .custom-blog-content h3 a {
            color: inherit;
            text-decoration: none;
        }


        .custom-blog-content h3 a:hover {
            color: #c52828;
        }


        .custom-blog-date {
            font-size: 21px;
            line-height: 1.3;

            color: #111;
        }


        /* =========================
           NO IMAGE
        ========================= */

        .blog-no-image {
            width: 100%;
            height: 100%;
            background: #ddd;
        }


        /* =========================
           NO RESULT
        ========================= */

        .custom-blog-search-result {
            display: none;

            text-align: center;

            font-size: 20px;

            padding: 40px 0;

            color: #555;
        }


        .custom-blog-search-result.show {
            display: block;
        }


        /* =========================
           TABLET
        ========================= */

        @media (max-width: 900px) {

            .custom-blog-wrapper {
                padding-left: 20px;
                padding-right: 20px;
            }


            .custom-blog-search {
                height: 75px;

                padding-left: 30px;

                margin-bottom: 65px;
            }


            .custom-blog-heading {
                margin-bottom: 45px;
            }


            .custom-blog-heading h1 {
                font-size: 52px;
            }


            .custom-blog-heading h2 {
                font-size: 32px;
            }


            .custom-blog-content h3 {
                font-size: 25px;
                line-height: 1.45;
            }


            .custom-blog-date {
                font-size: 18px;
            }

        }


        /* =========================
           MOBILE
        ========================= */

        @media (max-width: 600px) {

            .custom-blog-wrapper {
                padding: 0 16px 40px;
            }


            .custom-blog-search {
                height: 64px;

                border-width: 2px;

                padding: 0 8px 0 20px;

                margin-bottom: 55px;
            }


            .blog-search-icon {
                width: 32px;
                height: 32px;
            }


            #custom-blog-search {
                font-size: 17px;
                padding: 5px 8px;
            }


            .blog-mic-btn,
            .blog-filter-btn {
                width: 40px;
                height: 40px;
                padding: 7px;
            }


            .blog-mic-btn svg,
            .blog-filter-btn svg {
                width: 27px;
                height: 27px;
            }


            .custom-blog-filter-list {
                margin-top: -30px;
                margin-bottom: 35px;

                gap: 7px;
            }


            .blog-category-filter {
                font-size: 13px;
                padding: 7px 13px;
            }


            .custom-blog-heading {
                margin-bottom: 38px;
            }


            .custom-blog-heading h1 {
                font-size: 43px;

                margin-bottom: 17px;

                letter-spacing: 3px;
            }


            .custom-blog-heading h2 {
                font-size: 27px;
            }


            .custom-blog-grid {
                grid-template-columns: 1fr;

                row-gap: 42px;
            }


            .custom-blog-image {
                aspect-ratio: 1.38 / 1;
            }


            .custom-blog-category {
                min-width: 95px;

                padding: 9px 13px;

                font-size: 13px;

                border-radius: 0 0 0 15px;
            }


            .custom-blog-content {
                padding-top: 17px;
            }


            .custom-blog-content h3 {
                font-size: 25px;
                line-height: 1.4;

                margin-bottom: 12px;
            }


            .custom-blog-date {
                font-size: 17px;
            }

        }

    </style>


    <script>

        document.addEventListener("DOMContentLoaded", function () {

            const searchInput =
                document.getElementById("custom-blog-search");

            const cards =
                document.querySelectorAll(".custom-blog-card");

            const filterBtn =
                document.getElementById("custom-blog-filter-btn");

            const filterList =
                document.getElementById("custom-blog-filter-list");

            const filterButtons =
                document.querySelectorAll(".blog-category-filter");

            const noResult =
                document.getElementById("custom-blog-no-result");


            let selectedCategory = "all";


            /* =========================
               FILTER BUTTON
            ========================= */

            filterBtn.addEventListener("click", function () {

                filterList.classList.toggle("show");

            });


            /* =========================
               CATEGORY FILTER
            ========================= */

            filterButtons.forEach(function (button) {

                button.addEventListener("click", function () {

                    filterButtons.forEach(function (btn) {
                        btn.classList.remove("active");
                    });

                    this.classList.add("active");

                    selectedCategory =
                        this.getAttribute("data-category");

                    filterPosts();

                });

            });


            /* =========================
               SEARCH
            ========================= */

            searchInput.addEventListener("input", function () {

                filterPosts();

            });


            /* =========================
               FILTER POSTS
            ========================= */

            function filterPosts() {

                const search =
                    searchInput.value.toLowerCase().trim();

                let visiblePosts = 0;


                cards.forEach(function (card) {

                    const title =
                        card.getAttribute("data-title") || "";

                    const content =
                        card.getAttribute("data-content") || "";

                    const category =
                        card.getAttribute("data-category") || "";


                    const searchMatch =
                        title.includes(search) ||
                        content.includes(search);


                    const categoryMatch =
                        selectedCategory === "all" ||
                        category === selectedCategory;


                    if (searchMatch && categoryMatch) {

                        card.style.display = "";

                        visiblePosts++;

                    } else {

                        card.style.display = "none";

                    }

                });


                if (visiblePosts === 0) {

                    noResult.classList.add("show");

                } else {

                    noResult.classList.remove("show");

                }

            }

        });

    </script>

    <?php

    return ob_get_clean();
}

add_shortcode('custom_blog_posts', 'custom_blog_posts_shortcode');