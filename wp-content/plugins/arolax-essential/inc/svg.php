<?php

// Allow SVG
function arolax_wcf_n_allow_mime_types( $mimes ){
   $mimes['svg']  = 'image/svg+xml';
   $mimes['svgz'] = 'image/svg+xml';
   return $mimes;
 }
 add_filter( 'upload_mimes', 'arolax_wcf_n_allow_mime_types' );
 // add svg ext support
 function arolax_wcf_n_allow_mime_types_ext($data, $file, $filename, $mimes) {
        $ext = isset( $data['ext'] ) ? $data['ext'] : '';
        if ( strlen( $ext ) < 1 ) {
             $exploded = explode( '.', $filename );
             $ext      = strtolower( end( $exploded ) );
         }
         if ( 'svg' === $ext ) {
             $data['type'] = 'image/svg+xml';
             $data['ext']  = 'svg';
         } elseif ( 'svgz' === $ext ) {
             $data['type'] = 'image/svg+xml';
             $data['ext']  = 'svgz';
         }
         return $data;
 }
 add_filter( 'wp_check_filetype_and_ext', 'arolax_wcf_n_allow_mime_types_ext', 10, 4 );
 
 // fix features image
 function arolax_wcf_n_featured_image_fix( $content, $post_id, $thumbnail_id ){
         $mime = get_post_mime_type( $thumbnail_id );
         if ( 'image/svg+xml' === $mime ) {
             $content = sprintf( '<span class="svg">%s</span>', $content );
         }
         return $content;
 }
 add_filter( 'admin_post_thumbnail_html', 'arolax_wcf_n_featured_image_fix', 10, 3 );
 
 // disable srcset
 function arolax_wcf_n_disable_srcset(  $image_meta, $size_array, $image_src, $attachment_id ){
 
      if ( $attachment_id && 'image/svg+xml' === get_post_mime_type(   $attachment_id ) ) {
             $image_meta['sizes'] = array();
         }
      return $image_meta;
 }
 add_filter( 'wp_calculate_image_srcset_meta', 'arolax_wcf_n_disable_srcset', 10, 4 );