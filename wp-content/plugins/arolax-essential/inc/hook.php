<?php

/**
 * Add footer html from theme settings
 * @version 1.0 
 */
function AROLAX_ESSENTIAL_theme_option_footer_code()
{
   $html = arolax_option('opt-tabbed-code');
   // html
   if (is_array($html) && array_key_exists('opt_code_editor_html', $html) && $html['opt_code_editor_html'] != '') {

      libxml_use_internal_errors(true);
      $dom = new DOMDocument();
      $dom->loadHTML($html['opt_code_editor_html']);
      if (empty(libxml_get_errors())) {
         echo $html['opt_code_editor_html'];
      }

   }
   // js
   if (is_array($html) && array_key_exists('opt_code_editor_js', $html) && $html['opt_code_editor_js'] != '') {
      echo '<script>';
      echo $html['opt_code_editor_js'];
      echo '</script>';
   }

}
add_action('wp_footer', 'AROLAX_ESSENTIAL_theme_option_footer_code');

function AROLAX_ESSENTIAL_theme_option_page_footer_code()
{

   if (is_page()) {
      $html = arolax_meta_option(get_the_id(), 'opt-tabbed-code', false);
      // html
      if (is_array($html) && array_key_exists('opt_code_editor_html', $html) && $html['opt_code_editor_html'] != '') {
         libxml_use_internal_errors(true);
         $dom = new DOMDocument();
         $dom->loadHTML($html['opt_code_editor_html']);
         if (empty(libxml_get_errors())) {
            echo $html['opt_code_editor_html'];
         }

      }
      // js
      if (is_array($html) && array_key_exists('opt_code_editor_js', $html) && $html['opt_code_editor_js'] != '') {
         echo '<script>';
         echo $html['opt_code_editor_js'];
         echo '</script>';
      }
   }

}
add_action('wp_footer', 'AROLAX_ESSENTIAL_theme_option_page_footer_code');

function wcf_wp_ajax_update_theme()
{

   if (empty($_POST['slug'])) {
      wp_send_json_error(
         array(
            'slug' => '',
            'errorCode' => 'no_theme_specified',
            'errorMessage' => __('No theme specified.'),
         )
      );
   }

   $stylesheet = preg_replace('/[^A-z0-9_\-]/', '', wp_unslash($_POST['slug']));
   $status = array(
      'update' => 'theme',
      'slug' => $stylesheet,
      'oldVersion' => '',
      'newVersion' => '',
   );

   if (!current_user_can('update_themes')) {
      $status['errorMessage'] = __('Sorry, you are not allowed to update themes for this site.');
      wp_send_json_error($status);
   }

   $theme = wp_get_theme($stylesheet);
   if ($theme->exists()) {
      $status['oldVersion'] = $theme->get('Version');
   }

   require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';

   $current = get_site_transient('update_themes');
   if (empty($current)) {
      wp_update_themes();
   }

   $skin = new WP_Ajax_Upgrader_Skin();
   $upgrader = new Theme_Upgrader($skin);
   $result = $upgrader->bulk_upgrade(array($stylesheet));

   if (defined('WP_DEBUG') && WP_DEBUG) {
      $status['debug'] = $skin->get_upgrade_messages();
   }

   if (is_wp_error($skin->result)) {

      $status['errorCode'] = $skin->result->get_error_code();
      $status['errorMessage'] = $skin->result->get_error_message();
      wp_send_json_error($status);

   } elseif ($skin->get_errors()->has_errors()) {

      $status['errorMessage'] = $skin->get_error_messages();
      wp_send_json_error($status);

   } elseif (is_array($result) && !empty($result[$stylesheet])) {
      // Theme is already at the latest version.
      if (true === $result[$stylesheet]) {
         $status['errorMessage'] = $upgrader->strings['up_to_date'];
         wp_send_json_error($status);
      }

      $theme = wp_get_theme($stylesheet);
      if ($theme->exists()) {
         $status['newVersion'] = $theme->get('Version');
      }
      wp_send_json_success($status);

   } elseif (false === $result) {

      global $wp_filesystem;
      $status['errorCode'] = 'unable_to_connect_to_filesystem';
      $status['errorMessage'] = __('Unable to connect to the filesystem. Please confirm your credentials.');

      // Pass through the error from WP_Filesystem if one was raised.
      if ($wp_filesystem instanceof WP_Filesystem_Base && is_wp_error($wp_filesystem->errors) && $wp_filesystem->errors->has_errors()) {
         $status['errorMessage'] = esc_html($wp_filesystem->errors->get_error_message());
      }

      wp_send_json_error($status);
   }

   // An unhandled error occurred.
   $status['errorMessage'] = __('Theme update failed.');
   wp_send_json_error($status);
}

add_action('wp_ajax_wcf_update_theme', 'wcf_wp_ajax_update_theme');

add_action('wp_ajax_wcf_update_theme_status', 'wcf_update_theme_status');

function wcf_update_theme_status()
{
   // https://themecrowdy.com/wp-json/licensor/product/update/2

   if (class_exists('Arolax_Base')) {
      $obj = new Arolax_Base();
      $url = $obj->server_host . "product/update/" . $obj->product_id;
      $args = [
         'sslverify' => true,
         'timeout' => 120,
         'redirection' => 5,
         'cookies' => array(),
         'headers' => array(
            'Accept' => 'application/json',
         )
      ];

      $response = wp_remote_get($url, $args);

      if ((!is_wp_error($response)) && (200 === wp_remote_retrieve_response_code($response))) {
         $responseBody = json_decode($response['body']);
         if (json_last_error() === JSON_ERROR_NONE) {
            $theme_data = wp_get_theme();

            if (version_compare($theme_data->get('Version'), $responseBody->data->new_version, '<')) {
               wp_send_json_success($responseBody->data);
            } else {
               wp_send_json_error(['msg' => esc_html__('Update not available', 'arolax-essential')]);
            }

         }
      }
      wp_send_json_error(['msg' => esc_html__('Update not available', 'arolax-essential')]);
   }
}

function AROLAX_ESSENTIAL_theme_option_header_code()
{
   $html = arolax_option('opt-tabbed-code');
   $tab_size = '991.98';
   $mobile_size = '767.98';

   ?>
   <style id="arolax-theme-global-css">
      <?php

      if (is_array($html) && array_key_exists('custom_css', $html) && $html['custom_css'] != '') {
         echo $html['custom_css'];
      }

      if (is_array($html) && array_key_exists('custom_css_tab', $html) && $html['custom_css_tab'] != '') {
         if (strpos($html['custom_css_tab'], '@media') !== false) {
            echo $html['custom_css_tab'];
         } else {
            echo "@media (max-width: {$tab_size}px) {" . $html['custom_css_tab'] . '}';
         }
      }

      if (is_array($html) && array_key_exists('custom_css_mobile', $html) && $html['custom_css_mobile'] != '') {
         if (strpos($html['custom_css_mobile'], '@media') !== false) {
            echo $html['custom_css_mobile'];
         } else {
            echo "@media (max-width: {$mobile_size}px) {" . $html['custom_css_mobile'] . '}';
         }
      }

      ?>
   </style>
   <?php

}
add_action('wp_head', 'AROLAX_ESSENTIAL_theme_option_header_code');

function AROLAX_ESSENTIAL_theme_option_page_header_code()
{
   $html = arolax_meta_option(get_the_id(), 'opt-tabbed-code', false);
   $tab_size = '991.98';
   $mobile_size = '767.98';
   if (!$html) {
      return;
   }
   ?>
   <style id="arolax-theme-global-page-css">
      <?php

      if (is_array($html) && array_key_exists('custom_css', $html) && $html['custom_css'] != '') {
         echo $html['custom_css'];
      }

      if (is_array($html) && array_key_exists('custom_css_tab', $html) && $html['custom_css_tab'] != '') {
         if (strpos($html['custom_css_tab'], '@media') !== false) {
            echo $html['custom_css_tab'];
         } else {
            echo "@media (max-width: {$tab_size}px) {" . $html['custom_css_tab'] . '}';
         }
      }

      if (is_array($html) && array_key_exists('custom_css_mobile', $html) && $html['custom_css_mobile'] != '') {
         if (strpos($html['custom_css_mobile'], '@media') !== false) {
            echo $html['custom_css_mobile'];
         } else {
            echo "@media (max-width: {$mobile_size}px) {" . $html['custom_css_mobile'] . '}';
         }
      }

      ?>
   </style>
   <?php

}
add_action('wp_head', 'AROLAX_ESSENTIAL_theme_option_page_header_code');

function arolax_script_custom_data($data)
{

   if (arolax_option('offcanvas_responsive_enable', 0)) {
      $data['offcanvas_responsive_enable'] = true;
      $data['offcanvas_responsive_menu_width'] = arolax_option('offcanvas_responsive_menu_width');
   }

   if (arolax_option('offcanvas_menu_icon_plus') && arolax_option('offcanvas_menu_icon_plus') != '') {
      $data['offcanvas_menu_icon_plus'] = sprintf('<i class="%s"></i>', arolax_option('offcanvas_menu_icon_plus'));
   }

   if (arolax_option('offcanvas_menu_icon_minus') && arolax_option('offcanvas_menu_icon_minus') != '') {
      $data['offcanvas_menu_icon_minus'] = sprintf('<i class="%s"></i>', arolax_option('offcanvas_menu_icon_minus'));
   }

   if (arolax_option('sticky_header', 0)) {
      $data['sticky_enable'] = true;
      $data['sticky_header_top'] = arolax_option('sticky_header_start_from', 150);
   }

   return $data;
}

add_filter('arolax/script/custom/data', 'arolax_script_custom_data');


function arolax_esssen_preloader_template_part()
{
   get_template_part('template-parts/headers/content', 'preloader');
}
function wcf_rec_insert_fb_in_head()
{

   global $post;

   if (!is_single()) {
      return;
   }

   if (isset($post->ID) && has_post_thumbnail($post->ID)) {
      $allowed_html = array(
         'meta' => array(
            'property' => [],
            'content' => [],
            'name' => [],
         ),
         'link' => array(
            'rel' => [],
            'href' => [],
            'name' => [],
         )
      );

      $thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
      if (isset($thumbnail_src[0])) {
         echo wp_kses(sprintf('<meta property="og:image" content="%s"/>', esc_attr($thumbnail_src[0])), $allowed_html);
         echo wp_kses(sprintf('<link rel="apple-touch-icon" href="%s">', esc_url($thumbnail_src[0])), $allowed_html);
      }
   }

}
add_action('wp_head', 'wcf_rec_insert_fb_in_head', 5);

function wcf_body_open_scroll_listner()
{
   echo sprintf('<div id="wcf--top--scroll" hidden></div>');
}
add_action('wp_body_open', 'wcf_body_open_scroll_listner', 5);

add_filter('wp_check_filetype_and_ext', function ($data, $file, $filename, $mimes) {
   $filetype = wp_check_filetype($filename, $mimes);
   return [
      'ext' => $filetype['ext'],
      'type' => $filetype['type'],
      'proper_filename' => $data['proper_filename']
   ];

}, 10, 4);

add_action('admin_init', 'AROLAX_ESSENTIAL_re_counter_schedule_checker');

function AROLAX_ESSENTIAL_re_counter_schedule_checker()
{

   if (get_option('arolax_lic_Key') != '') {

      if (false === ($retuern_data = get_transient('arolax_theme_private_cft_data'))) {

         $server_host = "https://themecrowdy.com/wp-json/licensor/";
         $curl = curl_init();
         $code = get_option('arolax_lic_Key');
         curl_setopt_array($curl, array(
            CURLOPT_URL => $server_host . 'license/view',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('api_key' => 'A7C12D69-AD46D1C1-EE0C60DF-49869A2F', 'license_code' => $code),
         )
         );

         $response = curl_exec($curl);
         curl_close($curl);
         set_transient('arolax_theme_private_cft_data', $response, 60);
         $res_data = json_decode($response, true);

         if (isset($res_data['data']['status']) && ($res_data['data']['status'] == 'I' || $res_data['data']['status'] == 'R')) {
            update_option('arolax_lic_Key', '');
            deactivate_plugins('animation-addons-for-elementor/animation-addons-for-elementor.php');
            deactivate_plugins('elementor/elementor.php');
         }
      }

   }
}

function wcf_body_open_enable_page_background()
{

   $bg_enable = false;
   $global_settings = arolax_option('general_full_site_background');
   $background_preset = arolax_option('general_fullsite_background_preset');
   $custom_background = arolax_option('general_full_site_custom_background');
   $url = '';

   if ($global_settings) {
      if ($background_preset == 'custom' && isset($custom_background['url'])) {
         $bg_enable = true;
         $url = $custom_background['url'];
      } else {
         if ($the_url = AROLAX_ESSENTIAL_get_background_patterns($background_preset)) {
            $url = $the_url;
            $bg_enable = true;
         }
      }
   }

   if (is_page()) {
      $global_settings = arolax_meta_option(get_the_id(), 'general_full_site_background');
      $background_preset = arolax_meta_option(get_the_id(), 'general_fullsite_background_preset');
      $custom_background = arolax_meta_option(get_the_id(), 'general_full_site_custom_background');

      if ($global_settings) {
         if ($background_preset == 'custom' && isset($custom_background['url'])) {
            $bg_enable = true;
            $url = $custom_background['url'];
         } else {
            if ($the_url = AROLAX_ESSENTIAL_get_background_patterns($background_preset)) {
               $url = $the_url;
               $bg_enable = true;
            }
         }
      }

   }

   if ($bg_enable) {
      echo sprintf('<style>.wcf-body-bg {
         position: fixed;
         z-index: 99999;
         pointer-events: none;
         top: 0;
         opacity: 1;
         left: 0;
         width: 100vw;
         height: 100vh;
         background-repeat: repeat;
         background-position: top left;
         background-image: url(%s);
       }</style><div class="wcf-body-bg"></div>', $url);
   }


}
add_action('wp_body_open', 'wcf_body_open_enable_page_background', 5);


add_action('elementor/widgets/register', function ($widget_manager) {
   if (arolax_theme_service_pass()) {
      return;
   }

   $all_widgets = [
      'toggle-switch',
      'a-pricing-table',
      'image-box',
      'image-box-slider',
      'typewriter',
      'animated-title',
      'animated-text',
      'social-icons',
      'image',
      'image-gallery',
      'text-hover-image',
      'brand-slider',
      'counter',
      'icon-box',
      'testimonial',
      'a-portfolio',
      'scroll-elements',
      'testimonial2',
      'testimonial3',
      'portfolio',
      'text',
      'title',
      'posts',
      'button',
      'pricing-table',
      'image-compare',
      'progressbar',
      'video-popup',
      'team',
      'one-page-nav',
      'timeline',
      'video-box',
      'contact-form-7',
      'mailchimp',
      'tabs',
      'services-tab',
      'floating-elements',
      'event-slider',
      'video-box-slider',
      'content-slider',
      'countdown',
      'video-mask',
      'animated-heading',
      'header-preset',
      'offcanvas-menu',
      'lottie-animation',
      'theme-post-content'
   ];
   $widget_manager->unregister_widget_type('arolax-service');
   foreach ($all_widgets as $key) {
      $widget_manager->unregister_widget_type('wcf--' . $key);
   }

}, 100);

// Wp v4.7.1 and higher
add_filter('wp_check_filetype_and_ext', function ($data, $file, $filename, $mimes) {
   $filetype = wp_check_filetype($filename, $mimes);
   return [
      'ext' => $filetype['ext'],
      'type' => $filetype['type'],
      'proper_filename' => $data['proper_filename']
   ];

}, 10, 4);

function AROLAX_ESSENTIAL_crw_mime_types($mimes)
{
   $mimes['svg'] = 'image/svg+xml';
   return $mimes;
}
add_filter('upload_mimes', 'AROLAX_ESSENTIAL_crw_mime_types');

function AROLAX_ESSENTIAL_crw_fix_svg()
{
   echo '<style type="text/css">
         .attachment-266x266, .thumbnail img {
              width: 100% !important;
              height: auto !important;
         }
         </style>';
}
add_action('admin_head', 'AROLAX_ESSENTIAL_crw_fix_svg');


add_filter('single_product_archive_thumbnail_size', '_arolax_ess_single_product_archive_thumbnail_size', 25);

function _arolax_ess_single_product_archive_thumbnail_size($size)
{

   $c_size = arolax_option('wcf_shop_thumb_size', 'full');

   if ($c_size && $c_size != '') {
      return $c_size;
   }

   return $size;
}

function arolax_wcf_enable_styles_method()
{

   if (is_admin()) {
      return;
   }

   if (arolax_option('wcf_enable_rtl', false) || is_rtl() ) {
          
      wp_enqueue_style(
         'rtl-style',
         get_template_directory_uri() . '/rtl.css',
         array(),
         AROLAX_ESSENTIAL_VERSION
     );       

   }
}
add_action('wp_enqueue_scripts', 'arolax_wcf_enable_styles_method', 120);

add_filter( 'body_class', 'arolax_rtl_base_csscls' , 999 );

function arolax_rtl_base_csscls($classes)
{
  
   if (arolax_option('wcf_enable_rtl', false) || is_rtl() ) {
      $classes[] = 'rtl';     
   } 
    
   return $classes;
}

add_filter( 'wcf_addons_dashboard_config', 'arolax_addon_theme_dashboard_config', 154, 1 );
function arolax_addon_theme_dashboard_config($configs){

   if (!arolax_theme_service_pass()) {
      return $configs;
   }
   
   $configs['wcf_valid'] = true;  
   $configs['sl_lic']       = get_option('wcf_addon_sl_license_key');
   $configs['sl_lic_email'] = get_option('wcf_addon_sl_license_email');     
   return $configs;
}


add_filter( 'option_wcf_save_extensions', function( $extensions ){
   $serialize = serialize($extensions); 
   if (strpos($serialize, 'animation') !== false) {
      $extensions['gsap-extensions'] = true;
      $extensions['wcf-gsap'] = true;
   }
   if(get_option('wcf_extension_dashboardv2')){
      return $extensions;
   }
   
	if(defined('WCF_ADDONS_EX_PATH') && file_exists( WCF_ADDONS_EX_PATH . 'inc/extensions/wcf-portfolio-filter.php') ){
      $extensions['portfolio-filter'] = true;	
 	}
 	
 	if(defined('WCF_ADDONS_DASHBOARD_V2') ){
       $extensions['cursor-hover-effect'] = true;
       $extensions['hover-effect-image']  = true;
       $extensions['cursor-move-effect']  = true;
       $extensions['scroll-trigger']      = true;
       $extensions['horizontal-scroll']   = true;     
   }
	
	return $extensions;
});

add_filter( 'option_wcf_save_widgets', function( $widgets ){

   if(get_option('wcf_widget_dashboardv2')){
      return $widgets;
   }

	if(defined('WCF_ADDONS_DASHBOARD_V2') ){
      
      $widgets['toggle-switcher']       = true;
      $widgets['advance-pricing-table'] = true;
      $widgets['scroll-elements']       = true;
      $widgets['image-accordion']       = true;
      $widgets['flip-box']              = true;
      $widgets['advance-slider']        = true;
      $widgets['filterable-slider']     = true;
      $widgets['advance-accordion']     = true;
      $widgets['filterable-gallery']    = true;
      $widgets['advance-portfolio']     = true;
      $widgets['table-of-contents']     = true;
      $widgets['author-box']            = true;
      $widgets['video-popup']           = true;
      $widgets['video-box']             = true;
      $widgets['video-box-slider']      = true;
      $widgets['video-mask']            = true;
      $widgets['portfolio']             = true;
      $widgets['mailchimp']             = true;
      $widgets['breadcrumbs']           = true;
      
	}
	
	return $widgets;
});

add_filter('wcf__addons__pro__status', function($value){
	if ( ! arolax_theme_service_pass() ) {
		return $value;
	}	
	return 'valid';
});

add_filter('wcf_pro_template_status',function($status){
   if ( arolax_theme_service_pass() ) {
		return false;
	}	
	return $status;
});