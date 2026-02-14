<?php 

/* post view count 
* function to display number of posts.
*/
function arolax_get_postview($postID){

   $count_key = 'arolax_post_views_count';
   $count     = get_post_meta($postID, $count_key, true);
   if($count==''){
       return "0";
   }
   return $count;
}

function arolax_google_fonts_url($font_families	 = []) {
	$fonts_url		 = '';
	/*
    Translators: If there are characters in your language that are not supported
    by chosen font(s), translate this to 'off'. Do not translate into your own language.
    */
	if ( $font_families && 'off' !== _x( 'on', 'Google font: on or off', 'arolax' ) ) { 
		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) )
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}
   
	return esc_url_raw( $fonts_url );
}

// function to count views.
function arolax_set_postview($postID=null) {

   if( is_null($postID) ){
      $postID = get_the_ID();
   }   

   $count_key = 'arolax_post_views_count';
   $count     = get_post_meta($postID, $count_key, true);

   if( $count=='' ){
       $count = 0;
       delete_post_meta( $postID, $count_key );
       add_post_meta( $postID, $count_key, '0' );  
      }else{  
         $count++;
         update_post_meta($postID, $count_key, $count);         
   }

}

/* return the specific value from theme options  */
if(!function_exists('arolax_option')){
   function arolax_option( $option = '', $default = '' , $parent = 'arolax_settings') {
      
      if( class_exists( 'CSF' ) ){
         $options = get_option( $parent );

         return ( isset( $options[$option] ) ) ? $options[$option] : $default;
      }
      
      return $default;
   }
} 

// return the specific value from metabox
// ----------------------------------------------------------------------------------------
if(!function_exists('arolax_meta_option')){

   function arolax_meta_option( $postid, $key, $default_value = '', $parent_key = 'arolax_post_options' ) {
      
      $post_key = $parent_key;
      // page meta
      if(get_post_type() == 'page' ){
         $post_key = 'arolax_page_options';
      }
       // post meta
      if(get_post_type() == 'post'){
         $post_key = 'arolax_post_options';
      }
    
      if( class_exists( 'CSF' ) ){
         $options = get_post_meta( get_the_ID(), $post_key, true );
         return ( isset( $options[$key] ) ) ? $options[$key] : $default_value;          
      }
      
      return $default_value;
   }
   
}


// WP kses allowed tags
// ----------------------------------------------------------------------------------------
function arolax_kses( $raw ) {

	$allowed_tags = array(
		'a'								 => array(
			'class'	 => array(),
			'href'	 => array(),
			'rel'	 => array(),
			'title'	 => array(),
			'target'	 => array(),
      ),
      'option' => array(
         'value'	 => array(),
		
      ),
		'abbr'							 => array(
			'title' => array(),
		),
		'b'								 => array(),
		'blockquote'					 => array(
			'cite' => array(),
		),
		'cite'							 => array(
			'title' => array(),
		),
		'code'							 => array(),
		'del'							 => array(
			'datetime'	 => array(),
			'title'		 => array(),
		),
		'dd'							 => array(),
		'div'							 => array(
			'class'	 => array(),
			'title'	 => array(),
			'style'	 => array(),
		),
		'dl'							 => array(),
		'dt'							 => array(),
		'em'							 => array(),
		'h1'							 => array(),
		'h2'							 => array(),
		'h3'							 => array(),
		'h4'							 => array(),
		'h5'							 => array(),
		'h6'							 => array(),
		'i'								 => array(
			'class' => array(),
		),
		'img'							 => array(
			'alt'	 => array(),
			'class'	 => array(),
			'height' => array(),
			'src'	 => array(),
			'width'	 => array(),
		),
		'li'							 => array(
			'class' => array(),
		),
		'ol'							 => array(
			'class' => array(),
		),
		'p'								 => array(
			'class' => array(),
		),
		'q'								 => array(
			'cite'	 => array(),
			'title'	 => array(),
		),
		'span'							 => array(
			'class'	 => array(),
			'title'	 => array(),
			'style'	 => array(),
		),
		'iframe'						 => array(
			'width'			 => array(),
			'height'		 => array(),
			'scrolling'		 => array(),
			'frameborder'	 => array(),
			'allow'			 => array(),
			'src'			 => array(),
		),
		'strike'						 => array(),
		'br'							 => array(),
		'strong'						 => array(),
		'data-wow-duration'				 => array(),
		'data-wow-delay'				 => array(),
		'data-wallpaper-options'		 => array(),
		'data-stellar-background-ratio'	 => array(),
		'ul'							 => array(
			'class' => array(),
		),
	);

	if ( function_exists( 'wp_kses' ) ) { // WP is here
		$allowed = wp_kses( $raw, $allowed_tags );
	} else {
		$allowed = $raw;
	}

	return $allowed;
}


function arolax_get_excerpt($count = 100 ) {
 
   $count = arolax_desc_limit($count);  
   $arolax_blog_read_more_text = esc_html__('Readmore','arolax');
   
   $excerpt = get_the_excerpt();
   $excerpt = esc_html($excerpt);
   $words   = str_word_count($excerpt, 2);
   $pos     = array_keys($words);

   if(count($words)>$count){
      $excerpt = substr($excerpt, 0, $pos[$count]); 
   }
 
   $excerpt = wp_kses_post($excerpt); 
   return $excerpt;
}

 function arolax_desc_limit($default){

      if(!is_single() && !is_page()) {
        
         if(arolax_option('arolax_categry_post_desc_lenght') ){
            return arolax_option('arolax_categry_post_desc_lenght');
         }else{
            return $default;
         }
         
      }
      
      return $default;
   }


 function arolax_src( $key, $default_value = '', $input_as_attachment = false ) { // for src
   
   if ( $input_as_attachment == true ) {
		$attachment = $key;
	} else {
      $attachment = arolax_option( $key );
     
	}

	if ( isset( $attachment[ 'url' ] ) && !empty( $attachment ) ) {
		return $attachment[ 'url' ];
	}

	return $default_value;
}

if(!function_exists('arolax_get_post_types')) {

   function arolax_get_post_types() {
      global $wp_post_types;
      $posts = array();
    
      foreach ($wp_post_types as $post_type) {
         $skip_posts_type = [
            'post',
            'page',        
            'custom_css',
            'wp_navigation',
            'wp_global_styles',
            'wp_template_part',
            'wp_template',
            'wp_block',
            'user_request',
            'oembed_cache',
            'customize_changeset',
            'revision',
            'attachment',
            'elementor_library'
         ]; 
         
         if(!in_array($post_type->name,$skip_posts_type)){
            $posts[$post_type->name] = $post_type->labels->singular_name;
         }
        
      }
      return $posts;
   }
   
}

if(!function_exists('arolax_get_all_custom_taxonomies')){
   
   function arolax_get_all_custom_taxonomies(){
      global $wp_taxonomies;
	   $taxonomies = array();
      foreach ($wp_taxonomies as $key => $cat_type) {
         $taxonomies[$key] = $cat_type->label; 
      }
      
      return $taxonomies;
   }
}

if(!function_exists('arolax_get_cache_post_types')) {
   
   function arolax_get_cache_post_types() {
      $data = get_option('arolax_get_post_types_cache');
       return $data ? $data : [];
   }

}

if(!function_exists('arolax_get_cache_tax_types')) {
   
   function arolax_get_cache_tax_types() {
       $data = get_option('arolax_get_all_custom_taxonomies_cache');
       return $data ? $data : [];
   }

}


if(!function_exists('arolax_social_share_list')){

   function arolax_social_share_list(){
   
      $data = array(
         ''              => '---',
         'facebook'      => esc_html__('Facebook', 'arolax'),
         'twitter'       => esc_html__('twitter', 'arolax'),
         'linkedin'      => esc_html__('linkedin', 'arolax'),
         'pinterest'     => esc_html__('pinterest ', 'arolax'),
         'digg'          => esc_html__('digg', 'arolax'),
         'tumblr'        => esc_html__('tumblr', 'arolax'),
         'blogger'       => esc_html__('blogger', 'arolax'),
         'reddit'        => esc_html__('reddit', 'arolax'),
         'delicious'     => esc_html__('delicious', 'arolax'),
         'flipboard'     => esc_html__('flipboard', 'arolax'),
         'vkontakte'     => esc_html__('vkontakte', 'arolax'),
         'odnoklassniki' => esc_html__('odnoklassniki', 'arolax'),
         'moimir'        => esc_html__('moimir', 'arolax'),
         'livejournal'   => esc_html__('livejournal', 'arolax'),
         'blogger'       => esc_html__('blogger', 'arolax'),
         'evernote'      => esc_html__('evernote', 'arolax'),
         'flipboard'     => esc_html__('flipboard', 'arolax'),
         'mix'           => esc_html__('mix', 'arolax'),
         'meneame'       => esc_html__('meneame ', 'arolax'),
         'pocket'        => esc_html__('pocket ', 'arolax'),
         'surfingbird'   => esc_html__('surfingbird ', 'arolax'),
         'liveinternet'  => esc_html__('liveinternet ', 'arolax'),
         'buffer'        => esc_html__('buffer ', 'arolax'),
         'instapaper'    => esc_html__('instapaper ', 'arolax'),
         'xing'          => esc_html__('xing ', 'arolax'),
         'wordpres'      => esc_html__('wordpres ', 'arolax'),
         'baidu'         => esc_html__('baidu ', 'arolax'),
         'renren'        => esc_html__('renren ', 'arolax'),
         'weibo'         => esc_html__('weibo ', 'arolax'),        
      );
   
      return $data;
   }
   
}

if( !function_exists( 'arolax_text_logo' ) ) {

	function arolax_text_logo(){
		
		$general_text_logo = arolax_option('general_text_logo',0);
		
		if($general_text_logo == '1' ){
         if ( ! class_exists( 'CSF' ) ) {
             return esc_html__( 'Blog', 'arolax' );
         }
         $general_blog_title = arolax_option('general_blog_title');
         return $general_blog_title;
      }
		
		return false;
    }
    
}


if( !function_exists('arolax_get_fb_share_count') ){

   function arolax_get_fb_share_count($post_id = null){
      
      $cache_key    = 'arolax_fb_share_' . $post_id;
      $url          = get_permalink( $post_id );
      $access_token = arolax_get_fb_secret_key();
     
      $api_url      = 'https://graph.facebook.com/v3.0/?id=' . urlencode( $url ) . '&fields=engagement&access_token=' . $access_token;
      $json_return  = wp_remote_get( $api_url );
      $responseBody = wp_remote_retrieve_body( $json_return );
      $result       = json_decode( $responseBody );
     
      if ( is_object( $result ) && ! is_wp_error( $result ) ) {
         
         if(isset($result->engagement)){
            $fb_share = $result->engagement;
            if(isset($fb_share->share_count)){
               return $fb_share;
            }
         }   
       
      }

      return false;
      
   }

}

// get facebook api key
function arolax_get_fb_secret_key(){

   $facebook_api  = arolax_option('facebook_api');
  
   if( isset($facebook_api['app_id']) && isset($facebook_api['secret_code']) ){
     if($facebook_api['app_id'] !='' && $facebook_api['secret_code'] !=''){
        return $facebook_api['app_id'].'|'.$facebook_api['secret_code'];
     } 
   }
   // default key
   return '3190052791219248|8604c5a80339a8db79877944e852227b';
}


function arolax_lessThanfewMonth($date,$valid = 30) {
   $earlier = new DateTime($date);
   $later   = new DateTime();
   return $later->diff($earlier)->format("%a") > 30?esc_html__('Old Writter','arolax'):esc_html__('New Writter','arolax');
  
}


function arolax_is_footer_widget_active(){

   $footer_widget = false;

    if( 
        is_active_sidebar('footer-one') 
       || is_active_sidebar('footer-two') 
       || is_active_sidebar('footer-three') 
       || is_active_sidebar('footer-four') 
   
      ){
         $footer_widget = true;  
       }else{
         $footer_widget = false;
      }  
    
   return $footer_widget;    
}



// ad allowed pages
if(!function_exists('arolax_footer_allowed_pages')){

   function arolax_footer_allowed_pages($option=null){
      // show in all over blog
      if(is_null($option)){
         return true;
      }
      //filter
      $current_option = []; 
      if(is_category()){
         $current_option[]= 'category'; 
      }

     if(is_tag()){
      $current_option[]= 'tags'; 
     }

     if(is_archive()){
      $current_option[]= 'archive'; 
     }

     if(is_singular('post')){
      $current_option[]= 'post'; 
     }

     if(is_author()){
      $current_option[]= 'author'; 
     }
     
     if(is_search()){
      $current_option[]= 'search'; 
     }
     
     if(is_404()){
      $current_option[]= '404'; 
     }
    
     
     if(is_singular('page')){
      
       $current_option[]= 'page';  
     }

     if(is_main_query()){
         $page_for_posts = get_option( 'page_for_posts' );
         if(get_queried_object_id() == $page_for_posts){
            $current_option[]= 'blog'; 
         }
     }
    
     $found = array_intersect($option, $current_option);
    
     if(is_array($found) && count($found)){
        return true; 
     }   
     return false;

   } 
   
}

if( !function_exists( 'arolax_get_dir_file_list' ) ){

   function arolax_get_dir_file_list($dir = 'dir',$ext = 'php'){
   
      if( ! is_dir($dir) ){
         return [];
      }      
      $files = [];      
      foreach (glob("$dir/*.$ext") as $filename) {
         $files[basename( dirname($filename) ) .'-'. basename($filename,'.'.$ext)] = $filename;
      }   
      return $files;   
   }
   
}


