<?php

/**
 * Plugin Name: Theme's Contact Map Widget
 * Plugin URI: https://dubshop
 * Description: Display of Theme's Payment Methods
 * Author: Toheeb Sobowale
 * Author URI: https://dubshop.com
 * 
 * 
 * @package WordPress
 * @subpackage Law Corporate
 * @since Law Corporate 1.0.0
 *  
 * ++++++++++++++++++++++++++++++++++++++++++
 * +	    COLLECTION OF FUNCTIONS         +
 * ++++++++++++++++++++++++++++++++++++++++++
 * 
 * */

// Exit if accessed directly

if(!defined('ABSPATH')){
    exit;
}

// Code to flush cache
add_action( 'after_switch_theme', 'flush_rewrite_rules' );
 
/** shorten post titles */
if (!function_exists('shorten_title')) {
  
    function shorten_title($title, $limit = 40) {

      if (strlen($title) > $limit) {
    
        return substr($title, 0, $limit) . '...';
    
      } else {
    
        return $title;
    
      }
    
    }

}

/** 2. */
// Remove 'Category: ' prefix from archive_title
if (!function_exists('lc_archive_title')) {

    function lc_archive_title( $title ) {

        if ( is_category() ) {
            $title = single_cat_title( '', false );
        } elseif ( is_tag() ) {
            $title = single_tag_title( '', false );
        } elseif ( is_author() ) {
            $title = '<span class="vcard">' . get_the_author() . '</span>';
        } elseif ( is_post_type_archive() ) {
            $title = post_type_archive_title( '', false );
        } elseif ( is_tax() ) {
            $title = single_term_title( '', false );
        }
        return $title;
    
    }
    add_filter( 'get_the_archive_title', 'lc_archive_title' );

}

/** 3. */
// Function to get the permalink of a specific page by slug
if ( ! function_exists( 'get_permalink_by_slug' ) ) {

  function get_permalink_by_slug($slug) {

      $page = get_page_by_path($slug);
      if ($page) {

        return get_permalink($page->ID);
          
      }
      return false;
      
  }

}

  /** 4. */
// Allow SVG
if ( ! function_exists( 'fix_svg' ) ) {

  add_filter( 'wp_check_filetype_and_ext', function($data, $file, $filename, $mimes) {

    global $wp_version;

    if ( $wp_version !== '4.7.1' ) {
      return $data;
    }

    $filetype = wp_check_filetype( $filename, $mimes );
    return [
        'ext'             => $filetype['ext'],
        'type'            => $filetype['type'],
        'proper_filename' => $data['proper_filename']
    ];

  }, 10, 4 );

  function fix_svg() {

    echo '<style type="text/css">
          .attachment-266x266, .thumbnail img {
              width: 100% !important;
              height: auto !important;
          }
          </style>';

  }
  add_action( 'admin_head', 'fix_svg' );

}

if ( file_exists( get_template_directory() .'/inc/functions/layoutObjects.php' ) ){

  include get_template_directory() . '/inc/functions/layoutObjects.php';

};

if ( file_exists( get_template_directory() . '/inc/functions/registerLogout.php' ) ){

  include get_template_directory() . '/inc/functions/registerLogout.php';

};

if(!function_exists('lc_data_refresh')){

	function lc_data_refresh(){

		?>
			<!-- Refreshes Web Forms History -->
			<script> 
				if(window.history.replaceState){
					
					window.history.replaceState( null, null, window.location.href );
					
				}
			</script>
						
		<?php 

	}
	add_action('after_theme_setup', 'lc_data_refresh');

}