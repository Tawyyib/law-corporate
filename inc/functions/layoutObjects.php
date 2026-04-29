<?php
/**
 * Plugin Name: Theme's Custom layout
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
if(!defined('ABSPATH')){ exit; }

/** HEADER */

 // Main Menu
if(!function_exists('lc_main_menu')){

        function lc_main_menu (){ 

                if(has_nav_menu('primary')){

                     wp_nav_menu(

                         array(

                                    'menu'              => 'Main Menu',
                                    // menu container tag
                                    'container'         => 'div',
                                    // containver tag class
                                    'container_class'   => ' nav-body',
                                    // containver tag id
                                     'container_id'      => ' menu-container ',
                                    // do not fall back to first non-empty menu
                                    'theme_location'    => 'primary',
                                    //
                                    'depth'		        => 0,
                                    // do not fall back to wp_page_menu()
                                    'fallback_cb'       => false,
                                    // apply menu class
                                    'menu_class'        => ' navbar-nav justify-content-end align-items-start align-content-center flex-grow-1 pe-3 ',
                                    //Specifies or call the new walker nav_class
                                    'walker'            => new walkerNavMenuPrimary()
                            
                        )
                                
                    );

                }

        }

}

// Search Form
if(!function_exists('lc_search_form')){

        function lc_search_form (){ 

            $search_form = '<form role="' .   esc_attr('search')  .   '" method="'  .  esc_attr('get')  .  '" action="'  .  home_url( '/' )  .  '" class="'  .  esc_attr('searchForm d-flex')  .  '">';
                $search_form .= '<input name="'  .  esc_attr('s')  .  '" class="'  .  esc_attr('form-control')  .  '" type="'  .  esc_attr('search')  .  '" placeholder="'  .  esc_attr('What are you looking for?')  .  '" value="'  .  esc_attr( get_search_query() )  .  '" >'; 
                $search_form .= '<button type="'  .  esc_attr('submit')  .  '" class="'  .  esc_attr('search-btn-bg')  .  '" ><i title="'  .  esc_attr('Search')  .  '" class="'  .  esc_attr('fa-solid fa-search')  . '" role="'  .  esc_attr('image')  .  '" ></i></button>';
            $search_form .= '</form>';

            echo $search_form;

        }
        add_action('', 'lc_search_form');

}

    /**  BREADCRUMB OBJECTS  **/
    $crumbObjects = get_template_directory() . '/inc/functions/crumbObjects.php';
    require_once $crumbObjects;

// Call Button
if(!function_exists('lc_call_button')){

    function lc_call_button (){ 
            
            // Get site's phone number
            $phone_no = get_theme_mod('phone', 0);

            if(!empty($phone_no)){

                $call_button = '<a class="' .    esc_attr(' btn btn-call ') . '" ';
                $call_button .= 'href="'    .   esc_attr(' tel:+234'. $phone_no) . '" alt="'   .   esc_attr(' tel:+234'. $phone_no)    .   '"';
                $call_button .= 'title="'    .   esc_attr('+234'. $phone_no)   .   '"     type="' .   esc_attr(' button ')    .   '" >';
                $call_button .= '<i class="'    .   esc_attr('fa-solid fa-phone')   .   '"></i>';
                $call_button .= '</a>';

                echo $call_button;

            }

        }
        //add_action('', 'lc_call_button');

}
  
    // A. FrontPage Banner Layout
    if(!function_exists('lc_site_banner')){
                
        function lc_site_banner (){ 
                                
                // 1. Slider . $i Image Set
                $banner_image = get_template_directory_uri() . '/public/images/items-judges.webp'; // 
                    if (get_theme_mod('front_banner_image','law-corporate') != '') 
                    {
                        $banner_image = wp_get_attachment_image_src(get_theme_mod('front_banner_image','law-corporate'));
                    }
                    							
					// 3. Banner Title and Texts
					$banner_title = 'Best in Class Advisory Services'; 
					if(get_theme_mod('front_banner_title','law-corporate') !='')
					{
						$banner_title = get_theme_mod('front_banner_title','law-corporate');
					}
 

                    $banner =   '<section ';
                    
                    $banner .=   'class='; 
                    if(is_front_page()){
                        $banner .= '"'   .   esc_attr(' banner-front bg-image-center ')   .   '"';
                    }else{
                        $banner .=  '"'   .   esc_attr(' banner-pages bg-image-left ')    .    '"';
                    }
                    //$banner .=   'style=';
                    //if (is_front_page()){

                  //      $banner .=  '"'   .  'background-image:'  . url('  echo $banner_image ')  .   '"'; 

                //    } elseif (is_home()){

                //        $banner .=   '"'   .   'background-image:' .  url(' header_image();  ')   .   '"';

                //    } else{
                                        
                  //      $banner .=   '"'   .   'background-image:' . url('  the_post_thumbnail_url( )  ')   .   '"'; 
                //    }
                    $banner .=   '>';
                        
                    $banner .=   '<div class="'  . esc_attr(' banner-overlay d-flex flex-column ')  .  '" >';
                                                    
                        $banner .=   '<div class="'  . esc_attr(' banner-overlay-inner d-inline-block container-app ') . '" >';
                        if(is_front_page()) {
                            
                            $banner .=   '  <div class="'  .  esc_attr(' banner-overlay-inner-texts ')  .  '">  ' ;
                            $banner .=   '<h1>' .    esc_html($banner_title)  .   '</h1>';
                            $banner .=   '</div>';
                        }else{ 

                            $banner .=   '<h1>'; 
                            if (is_home()){

                                $banner .='<h1>' .  single_post_title()  .  '</h1>';  

                            }elseif(is_archive()){

                                $banner .=' .   esc_html(the_archive_title())   .   ';
                                
                            } elseif(is_category()){

                                $banner .= esc_html(single_cat_title());
                                
                            }                             
                            else {

                                $banner .= esc_html(the_title());

                            }	                                                       
                                                       
                            $banner .=   '</h1>';                            

                        }
                    $banner .= '</div>';

                    $banner .= '</div>';

                    $banner .=   '</section>';

                    echo $banner;
            }

            add_action('', 'lc_site_banner');

    }

    // Theme Button
    if(!function_exists('lc_cta_button')){

        function lc_cta_button ($text, $url, $class = array(), $target = '_self', $rel =''){ 

            $classes      = implode( ' ', (array) $class );
            $rel_attr     = $rel ? ' rel="' . esc_attr( $rel ) . '"' : '';

            $button_cta = '<a href="'  .  esc_url( $url )  .  '" class="btn ' .  esc_attr($classes)  .  ' btn-pressed"';
            $button_cta .= ' target="' . esc_attr( $target ) . '"' . $rel_attr . '>';
            $button_cta .= esc_html( $text );
             $button_cta .= '</a>';

            return $button_cta;

        }   

    }

    // Theme Button
    if(!function_exists('lc_scroll_button')){

        function lc_icon_button (
            $text, 
            $link_id,
            $url = '#', 
            $class = array(), 
            $data_target = '', 
            $target = '_self', 
            $rel ='',
            ){ 

            $classes      = implode( ' ', (array) $class );
            $rel_attr = $rel ? ' rel="' . esc_attr( $rel ) . '"' : '';
            $id_attr = $link_id ? ' id="' . esc_attr( $link_id ) . '"' : '';



            if ( $data_target ) {

                // Use data-target version (drop href, target, rel)
                $button_cta = '<a '. $id_attr . ' class="'. esc_attr( $classes ) .'" data-target="' . esc_attr( $data_target ) . '">';

            } else {

                // Normal link version
                $button_cta = '<a href="' . esc_url( $url ) . '" class="btn ' . esc_attr( $classes ) . ' btn-pressed" target="' . esc_attr( $target ) . '"' . $rel_attr . '>';

            }

            $button_cta .= esc_html( $text ) . '</a>';

            return $button_cta;

        }   

        function lc_scroll_button (
            
            $text, 
            $link_id,
            $icon,
            $class = array(), 
            $data_target = '', 
            ){ 

            $classes      = implode( ' ', (array) $class );
            $id_attr = $link_id ? ' id="' . esc_attr( $link_id ) . '"' : '';



            // Use data-target version (drop href, target, rel)
            $button_scroll = '<a '. $id_attr . ' class="'. esc_attr( $classes ) .'" data-target="' . esc_attr( $data_target ) . '">';

            $button_scroll .= esc_html( $text ) . '</a>';

            $button_scroll = '<a '. $id_attr  .  '" class="' .  esc_attr($classes)  .  '"';
            $button_scroll .= ' data-target="' . esc_attr( $data_target ) . '">';
            $button_scroll .= esc_html( $text );
            $button_scroll .= '<i class="fas' . esc_html('fa-chevron-circle-down') .'"></i>';
             $button_scroll .= '</a>';

            return $button_scroll;

        }   
        
    }

    //
    function lc_customize_archive_order( $query ) {
        if ( ! is_admin() && $query->is_main_query() ) {

            // For People archive
            if ( $query->is_post_type_archive( 'people' ) ) {
                //$query->set( 'meta_key', 'rank' );
                //$query->set( 'orderby', 'meta_value_num' );
                $query->set( 'order', 'ASC' );
            }

            // For Projects archive
            elseif ( $query->is_post_type_archive( 'projects' ) ) {
                $query->set( 'orderby', 'date' );
                $query->set( 'order', 'DESC' );
            }

            // For Services archive
            elseif ( $query->is_post_type_archive( 'services' ) || $query->is_tax() ) {
                $query->set( 'orderby', 'menu_order' );
                $query->set( 'order', 'ASC' );
            }

            // For blog posts or categories
            elseif ( $query->is_home() || $query->is_category() ) {
                $query->set( 'orderby', 'date' );
                $query->set( 'order', 'DESC' );
            }
        }
    }
    add_action( 'pre_get_posts', 'lc_customize_archive_order' );


if(! function_exists('lc_post_navigation')){

    function lc_post_navigation() {

        $post_nav = '<nav class="navi d-flex justify-content-between mt-4" >';
                                                                        
            // Reusable helper for navigation link markup
            $prev_link = get_previous_post_link(
                '%link',
                '<span class="previ-arr">&laquo;</span> 
                <span class="previ-mobile">Previous</span> 
                <span class="previ-desktop">%title</span>'
            );

            $next_link = get_next_post_link(
                '%link',
                '<span class="next-desktop">%title</span> 
                <span class="next-mobile">Next</span> 
                <span class="next-arr">&raquo;</span>'
            );

            if ($prev_link || $next_link) {

                $post_nav .= '<div class="navi__box previ">' . $prev_link . '</div>';
                $post_nav .= '<div class="navi__box next">' . $next_link . '</div>';
                
            }

        $post_nav .= '</nav>';

        echo $post_nav;

    }
    
}


    /**  PROJECT ITEM RELATED OBJECTS  **/
    $serviceObjects = get_template_directory() . '/inc/functions/serviceObjects.php';
    require_once $serviceObjects;

    /**     PERSON POST CARD      */
    if (!function_exists('lc_person_card')) {

        function lc_person_card ($class) {
                
            $classes  = implode( ' ', (array) $class );

            $gender = get_post_meta(get_the_ID(), 'gender', true);
            $designation = get_post_meta(get_the_ID(), 'designation', true);
    
            $person_card = '<figure class="' . esc_attr( $classes ) . '">';
    
            $person_card .= '<a href="' . esc_url(get_permalink()) . '" ';
            $person_card .= 'title="' . esc_attr(get_the_title()) . '" ';
            $person_card .= 'class="' . esc_attr('person-card__thumbnail') . '">';
    
            if (has_post_thumbnail()) {

                $person_card .= get_the_post_thumbnail(get_the_ID(), 'post-thumbnail', array('class' => 'person-card__thumbnail-image', 'alt' => get_the_title(), 'title' => get_the_title()));

            } else {

                $image_url = ($gender === 'Female') ? get_template_directory_uri() . '/public/images/female-avatar.webp' : get_template_directory_uri() . '/public/images/male-avatar.webp';
                $person_card .= '<img src="' . esc_url($image_url) . '" alt="' . esc_attr(get_the_title()) . '" title="' . esc_attr(get_the_title()) . '" class="' . esc_attr('person-card__thumbnail-image') . '">';

            }    
            $person_card .= '</a>';    
            $person_card .= '<div class="' . esc_attr('person-card__meta d-flex flex-column') . '">';
            $person_card .= '<span class="' . esc_attr('person-card__meta-name') . '"><a href="' . esc_url(get_permalink()) . '" class="' . esc_attr('') . '">' . esc_html(get_the_title()) . '</a></span>';
    
            if (!empty($designation)) {
                $person_card .= '<span class="person-card__meta-role">' . esc_html($designation) . '</span>';
            }    
            $person_card .= '</div>';
    
            $person_card .= '</figure>';
    
            echo $person_card;

        }
        add_action('', 'lc_person_card');

    }    


    /** Back Button */
    if(! function_exists('lc_back_button')){

        function lc_back_button(){

            if ( wp_get_referer() )
            {
                $back_text = __( '&laquo;&nbsp;&nbsp;Go Back','law-corporate' );
                $back_button    = "\n<button id='back-button' class='btn btn-back back-button' onclick='javascript:history.back()'>$back_text</button>";
                echo $back_button;
            }
        }
        add_action( '', 'lc_back_button' );

    }

    /**     Theme Pagination      */
    if(! function_exists('lc_paginate')){

        function lc_paginate(){
                                
            $pag = get_the_posts_pagination(); 
            $pag = str_replace('div', 'ul', $pag);
            $pag = str_replace('nav-links', 'pagination', $pag);
            $pag = str_replace('<a', '<li class="page-item"><a', $pag);
            $pag = str_replace('</a>', '</a></li>', $pag);
            $pag = str_replace('<span', '<li class="page-item active"><a', $pag);
            $pag = str_replace('</span>', '</a></li>', $pag);
            $pag = str_replace('page-numbers', 'page-link', $pag);
            $pag = str_replace('Previous', '&laquo;', $pag);
            $pag = str_replace('Next', '&raquo;', $pag);

            echo $pag;

        }
        add_action('', 'lc_paginate');

    }

    // display social_metaboxes
    if (!function_exists('lc_show_social_meta')) {

        function lc_show_social_meta($post_id) {

            $social_media = array(
                'Facebook' => 'fab fa-facebook',
                'Instagram' => 'fab fa-instagram',
                'LinkedIn' => 'fab fa-linkedin',
                'X-Twitter' => 'fab fa-x-twitter',
                'Website' => 'fa-solid fa-globe',
                'YouTube' => 'fab fa-youtube',
            );
            $output = '<ul class="social-profile bg-dar">';
            foreach ($social_media as $platform => $icon_class) {
    
                $url = get_post_meta($post_id, strtolower($platform), true);
    
                if (!empty($url)) {
    
                    $output .= '<li class="social-profile-link"><a href="' . esc_url($url) . '" target="_blank" rel="noopener noreferrer"><i class="' . esc_attr($icon_class) . '"></i></a></li>';
    
                }
    
            }
            $output .= '</ul>';
        
            echo $output;
    
        }

    }    

    // A. About Page Permalink
    if(!function_exists('get_about_permalink')){

        function get_about_permalink(){ 
            
            // Get the permalink for the 'about' page
            $about_permalink = get_permalink_by_slug('about');

            if ($about_permalink) {

                echo esc_url($about_permalink);

            } else {

                echo esc_html__('link not found.', "law-corporate");

            }

        }
        add_action('', 'get_about_permalink');

    }


    // C. teams Page Permalink
    if(!function_exists('get_people_permalink')){

        function get_people_permalink(){ 
            
            // Get the permalink for the 'about' page
            $people_permalink = get_permalink_by_slug('people');

            if ($people_permalink) {

                echo esc_url($people_permalink);

            } else {

                echo esc_html__('link not found.', "law-corporate");

            }

        }
        add_action('', 'get_people_permalink');

    }

    // D. About Page Permalink
    if(!function_exists('get_page_permalink')){

        function get_page_permalink(){ 
            
            // define an array of slugs for pages to fetch
            $page_slugs = array(
                'about',
                'projects',
                'services',
                'teams'
            );

            // Loop through each slug and display the link
            foreach ($page_slugs as $slug ) {

                $page_permalink = get_permalink_by_slug($slug);
                    
                if ($page_permalink) {

                    echo esc_url($page_permalink);

                } else {

                    echo esc_html__('link not found.', "law-corporate");

                }

            }

        }
        add_action('', 'get_page_permalink');

    }

    // Get Page Post Featured Image Data by slug
    if(!function_exists('get_featured_image_data')){

        /**
         * Get both featured image HTML and URL for a page found by slugs
         * 
         * @param array $slugs Array of slugs to check in order
         * @param string $image_class Optional CSS class for the image
         * @return array ['html' => string, 'url' => string]
         */
        function get_featured_image_data ( $slugs = ['slug-1', 'slug-2'], $image_class = 'banner-image-class' ) {
            
            $placeholder_url = get_template_directory_uri() . '/public/images/image-placeholder.webp';
            $page_object = null;
            
            // Find page by slug
            foreach ($slugs as $slug) {
                $page_object = get_page_by_path($slug);
                if (!empty($page_object)) break;
            }
            
            $page_id = $page_object->ID;
            
            // Return both HTML and URL
            if ($page_object && has_post_thumbnail($page_id)) {
                return [
                    'img' => get_the_post_thumbnail($page_id, 'full', array( 'class' => $image_class ) ),
                    'url'  => get_the_post_thumbnail_url($page_id, 'full')
                ];
            } else {
                return [
                    'img' => '<img src="' . esc_url($placeholder_url) . '" alt="" class="' . esc_attr($image_class) . '">',
                    'url'  => $placeholder_url
                ];
            }
        }

        // Usage Instructions:
        // 1 - $featured_image_data = get_featured_image_data(['services', 'competency']);
        // 2 - $featured_image = $featured_image_data['img'];
        // 3 - $featured_image_url = $featured_image_data['url'];

    }

    // Get Page Post Data by slug for Terms
    if ( ! function_exists('get_pagepost_data')) {

        /**
         * Get page content by matching term slug
         * 
         * @param WP_Term $term The term object
         * @return array|false Returns page data or false if no matching page
         */
        function get_pagepost_data ( $term, $thumbnail_class = [] ) {
            
            if ( ! $term || !isset ( $term->slug ) ) {
                return false;
            }
            
            $page = get_page_by_path( $term->slug );
            
            if ( ! $page ) {
                return false;
            }

            // Build thumbnail HTML with custom class if provided
            $thumbnail_html = '';
            if (has_post_thumbnail($page)) {
                $args = [];
                if (!empty($thumbnail_class)) {
                    $args['class'] = $thumbnail_class;
                }
                $thumbnail_html = get_the_post_thumbnail($page, 'full', $args);
            }

            return [
                'id' => $page->ID,
                'title' => get_the_title($page),
                'content' => apply_filters('the_content', $page->post_content),
                'excerpt' => get_the_excerpt($page),
                'thumbnail_url' => has_post_thumbnail($page) ? get_the_post_thumbnail_url($page, 'full') : '',
                'thumbnail_html' => $thumbnail_html,
                'permalink' => get_permalink($page),
            ];

        }

        // Usage in your term template
        // $term = get_queried_object();
        // $page_data = get_page_content_by_term_slug($term);    

        // if ($page_data) {
            // Display the page content
        // }

    }

    /** SIDE BAR SECTIION */

    /**  PROJECT ITEM RELATED OBJECTS  **/
    $projectObjects = get_template_directory() . '/inc/functions/projectObjects.php';
    require_once $projectObjects;
      
    /**  POST ITEM RELATED  OBJECTS  **/
    $postObjects = get_template_directory() .'/inc/functions/postObjects.php';
    require_once $postObjects;
 
    /** 
     * SERVICES METADATA SIDEBAR
     * Displays RELATIVES details in a structured sidebar format
     */
    if(!function_exists('lc_services_rel')){
        
        function lc_services_rel(){

            global $post;

            echo '<aside  class="' . esc_attr('service-aside col-md-12') . '" >';

                echo  '<h4 class="' . esc_html('side-item__header d-flex pe-3 mb-2') . '"><span>' . esc_html('Related Services') . '</span><i class="'  .  esc_attr('fas fa-folder-tree ms-4') .  '"></i></h4>';
                echo  '<hr>';

                // get terms associated with the current post.
                $terms = get_the_terms( get_the_ID(), 'competency' );

                //
                if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {

                    $term_ids = array_map( function( $term ) {

                        return $term->term_id;

                    }, $terms );
                
                    // Query for related posts
                    $args = array(
                        'post_type' => 'services',
                        'post_status' => 'publish',
                        //'posts_per_page' => 4,
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'competency',
                                'field' => 'term_id',
                                'terms' => $term_ids,
                            ),
                        ),
                        'post__not_in' => array( $post->ID ),
                    );
                
                    $related_services = new WP_Query( $args );
                
                    if ( $related_services->have_posts() ) {

                        // list all services related
                        $service_item = '<ul class="' . esc_attr('side-item__list') . '">';

                            while ( $related_services->have_posts() ){
                                    
                                $related_services->the_post();
                                    
                                $service_item .=  '<li><a href="' ;
                                $service_item .=    get_the_permalink();
                                $service_item .=   '" class="' . esc_attr('d-flex align-items-center justify-content-between bg-light') . '">';
                                $service_item .=   '<span class="' . esc_attr('term_title') . '" >';
                                $service_item .=   get_the_title() . '</span>';
                                $service_item .=   '<span class="' . esc_attr('arrow') . '"><i class="'  .  esc_attr('fas fa-arrow-right') .  '"></i></span></a></li>';

                            }

                        $service_item .=   '</ul>';

                        echo $service_item;

                        wp_reset_postdata();

                    } else {

                        echo '<p class="' . esc_attr('px-3') . '">' . esc_html__('Related service(s) not posted yet.', "law-corporate") . '.</p>';
                        
                    }
                        
                }

            echo '</aside>';
        
        }

    }

    if(!function_exists('lc_projects_rel')){
        
        function lc_projects_rel(){

            global $post;
            
            $post_type = get_post_type();;

            echo '<section  class="' . esc_attr('related-item col-smd-12') . '" >';

            if ($post_type == 'post' || $post_type == 'projects') {

                echo  '<h4 class="' . esc_attr('related-item__header d-flex pe-3 mb-2 ') . '"><span>' . esc_html__('Related Projects', "law-corporate")  .  '</span><i class="'  .  esc_attr('fas fa-magnifying-glass-chart ms-4') .  '"></i></h4>';

            } else {

                echo '<h4 class="' . esc_attr('related-item__header d-flex pe-3 mb-2') . '"><span>' . esc_html__('Recent Projects', "law-corporate")  .  '</span><i class="'  .  esc_attr('fas fa-magnifying-glass-chart ms-4') .  '"></i></h4>';

            }

            echo '<hr class="' . esc_attr('') . '" >';

                // get terms associated with the current post.
                $terms = get_the_terms( get_the_ID(), 'competency' );

                // checks if terms (services) are not empty
                if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {

                    $term_ids = array_map( function( $term ) {

                        return $term->term_id;

                    }, $terms );
                
                    // Query for related posts
                    $args = array(
                        'post_type' => 'projects',
                        'post_status' => 'publish',
                        'posts_per_page' => 4,
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'competency',
                                'field' => 'term_id',
                                'terms' => $term_ids,
                            ),
                        ),
                        'post__not_in' => array( $post->ID ),
                    );
                
                    $related_projects = new WP_Query( $args );
                
                    if ( $related_projects->have_posts() ) {

                        $project_item = '<ul class="' . esc_attr('related-item__list bg-ligh') . '">';

                            while ( $related_projects->have_posts() ){
                                    
                                $related_projects->the_post();
                                    
                                $project_item .=  '<li><a href="' ;
                                $project_item .=    get_the_permalink();
                                $project_item .=   '" class="' . esc_attr('d-flex bg-light') . '">';
                                if (has_post_thumbnail()) {
                                    $project_item .=   '<span class="' . esc_attr('term_thumbnail') . '" >';
                                    $project_item .=  get_the_post_thumbnail();
                                    $project_item .=  '</span>';
                                }
                                $project_item .=   '<span class="' . esc_attr('term_title') . '" >';
                                $project_item .=   get_the_title() . '</span>';
                                $project_item .=   '</a></li>';

                            }

                        $project_item .=  '</ul>';

                        echo $project_item;

                        wp_reset_postdata();

                    } else {

                        echo '<p class="' . esc_attr('px-3') . '" >' . esc_html__('Related project(s) not posted yet.', "law-corporate") . '.</p>';

                    }
                        
                }

            echo '</section>';

        }

    }
  
    if(!function_exists('lc_posts_rel')){
        
        function lc_posts_rel(){

            global $post;
            
            $post_type = get_post_type();;

            echo '<section  class="'. esc_attr('related-item col-smd-12') . '" >';

                echo  '<h4 class="' . esc_attr('related-item__header d-flex pe-3 mb-2 ') . '"><span>' . esc_html__('Related Insights', "law-corporate")  .  '</span><i class="'  .  esc_attr('fas fa-magnifying-glass-chart ms-4') .  '"></i></h4>';

                echo '<hr class="' . esc_attr('') . '" >';

                // get terms associated with the current post.
                $terms = get_the_terms( get_the_ID(), 'competency' );

                //
                if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {

                    $term_ids = array_map( function( $term ) {

                        return $term->term_id;

                    }, $terms );
                
                    // Query for related posts
                    $args = array(
                        'post_type' => 'post',
                        'post_status' => 'publish',
                        'posts_per_page' => 4,
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'competency',
                                'field' => 'term_id',
                                'terms' => $term_ids,
                            ),
                        ),
                        'post__not_in' => array( $post->ID ),
                    );
                
                    $related_post = new WP_Query( $args );
                
                    if ( $related_post->have_posts() ) {

                        $post_item = '<ul class="' . esc_attr('related-item__list') . '">';

                            while ( $related_post->have_posts() ){
                                    
                                $related_post->the_post();
                                    
                                $post_item .=  '<li><a href="' ;
                                $post_item .=    get_the_permalink();
                                $post_item .=   '" class="' . esc_attr('d-flex align-items-center justify-content-between bg-light') . '">';
                                if (has_post_thumbnail()) {
                                    $post_item .=   '<span class="' . esc_attr('term_thumbnail') . '" >';
                                    $post_item .=  get_the_post_thumbnail();
                                    $post_item .=  '</span>';
                                }
                                $post_item .=   '<span class="' . esc_attr('term_title') . '" >';
                                $post_item .=   get_the_title() . '</span>';
                                $post_item .=   '</a></li>';

                            }

                        $post_item .=  '</ul>';

                        echo $post_item;

                        wp_reset_postdata();

                    } else {

                        echo '<p class="' . esc_attr('px-3') . '" >' . esc_html__('Related publication content not posted yet.', "law-corporate") . '</p>';    

                    }
                        
                }

            echo '</section>';

        }

    }
  
    /**  CONTACT ITEM RELATED  OBJECTS  **/
    $contactObjects = get_template_directory() .'/inc/functions/contactObjects.php';
    require_once $contactObjects;
   

    // F. Footer Branding    
    if(!function_exists('lc_footer_branding')){

        function lc_footer_branding() {

            // Get the brand image URLs
            $brand_image_url = get_theme_mod('brand_image', 0);
            $brand_image_mobile_url = get_theme_mod('brand_image_mobile', 0);
            
            // Get the statement of purpose
            $statement_of_purpose = get_theme_mod('statement_of_purpose', 0);
            
            // Start outputting brand information
            $brand_label = '<div class="' . esc_attr('brand-info') . '">';
            
            // Output brand images
            if ( !empty( $brand_image_url ) ) {
                $brand_label .= '<div class="' . esc_attr('brand-info-img') . '">';
                $brand_label .= '<img src="' . esc_url( $brand_image_url ) . '" alt="' . esc_attr('Brand Image') . '">';
                $brand_label .= '</div>';
                
                // Check for mobile image only if present
                if ( !empty( $brand_image_mobile_url ) ) {
                    $brand_label .= '<div class="' . esc_attr('brand-info-img-mobile') . '">';
                    $brand_label .= '<img src="' . esc_url( $brand_image_mobile_url ) . '" alt="' . esc_attr('Brand Image Mobile') . '">';
                    $brand_label .= '</div>';
                }
            }
            
            // Output statement of purpose
            if ( !empty( $statement_of_purpose ) ) {
                $brand_label .= '<div class="' . esc_attr('brand-info-statement mt-3') . '">';
                $brand_label .= '<p class="' . esc_attr('statement-of-purpose') . '">' . sprintf( esc_html__( '%s', "law-corporate" ), esc_html($statement_of_purpose) ) . '</p>';
                $brand_label .= '</div>';
            }
            
            $brand_label .= '</div>';
            
            // Echo the output
            echo $brand_label;
        }
        
    }    

    // G. Social Media Links    
    if(!function_exists('lc_SocialMediaItems')){

        function lc_SocialMediaItems(){

                // Get the social media links
                $social_icons_links = array(
                    'behance'  	=> get_theme_mod('behance_link'),
                    'facebook'  => get_theme_mod('facebook_link'),
                    'github' 	=> get_theme_mod('github_link'),
                    'instagram' => get_theme_mod('instagram_link'),
                    'linkedin'  => get_theme_mod('linkedin_link'),
                    'pinteres'  => get_theme_mod('pinterest_link'),
                    'tiktok'   	=> get_theme_mod('tiktok_link'),
                    'x-twitter' => get_theme_mod('x-twitter_link'),
                    'youtube' 	=> get_theme_mod('youtube_link'),
                    // Add more social media links as needed
                );
                //var_dump($social_icons); // Check the contents of the array
                
                // Output social media links
                $social_items = '<div class="' . esc_attr('social-links-widget') . '" >';
                    $social_items .= '<ul class="' . esc_attr('social-links-list') . '">';

                    foreach ($social_icons_links as $platform => $link) {

                        if (!empty($link)) {

                            // Proper string interpolation and escaping
                            $social_items .= sprintf(
                                '<li><a href="%s" class="%s" target="_blank" rel="noopener noreferrer" title="%s"><i class="fab fa-%s"></i></a></li>',
                                esc_url($link),
                                esc_attr($platform),
                                esc_attr(ucfirst($platform)),
                                esc_attr($platform)
                            );

                        }
                    }
                    $social_items .= '</ul>';
                $social_items .= '</div>';

                echo $social_items;
                            
        }

    }


/** FOOTER AND UNDERFOOTER */
      
    // Main Menu
    if(!function_exists('lc_footer_menu')){

        function lc_footer_menu (){ 

                if(has_nav_menu('primary')){

                    wp_nav_menu(

                        array(

                                    'menu'              => 'Footer Menu',
                                    // menu container tag
                                    'container'         => 'div',
                                    // containver tag class
                                    'container_class'   => ' footer-menu',
                                    // containver tag id
                                    'container_id'      => 'footer-menu ',
                                    // do not fall back to first non-empty menu
                                    'theme_location'    => 'footer',
                                    //
                                    'depth'		        => 0,
                                    // do not fall back to wp_page_menu()
                                    'fallback_cb'       => false,
                                    // apply menu class
                                    'menu_class'        => ' footer-nav d-flex justify-content-end',
                                    //Specifies or call the new walker nav_class
                                    'walker'            => new walkerNavMenuPrimary()
                            
                            )
                                
                    );

                }

        }

    }

    // Search Modal 
    if(!function_exists('lc_search_modal')){

            function lc_search_modal(){

               ?>
                                
                <div class="<?php echo esc_attr('modal fade'); ?>" id="<?php echo esc_attr('exampleModal'); ?>" tabindex="<?php echo esc_attr('-1'); ?>" aria-labelledby="<?php echo esc_attr('exampleModalLabel'); ?>" aria-hidden="<?php echo esc_attr('true'); ?>" >
                    
                    <!-- Modal -->

                        <div class="<?php echo esc_attr('modal-dialog container-app'); ?> ">

                            <div class=" <?php echo esc_attr('modal-content'); ?> ">

                                <!-- modal-close-button -->

                                <div class=" <?php echo esc_attr('modal-header'); ?> ">

                                    <div class="<?php echo esc_attr('btn-wrapper'); ?> ">

                                        <button type=" <?php echo esc_attr('button'); ?> " class=" <?php echo esc_attr('btn-close'); ?> " data-bs-dismiss="modal" aria-label="<?php echo esc_attr('Close'); ?> "></button>
                                        <span><?php echo esc_html__('CLOSE', "law-corporate"); ?></span>
                                        
                                    </div>

                                </div>

                                <!-- modal-close-button -->

                                <div class=" <?php echo esc_attr('modal-body'); ?> ">

                                    <div class=" <?php echo esc_attr('search-box'); ?> ">

                                        <?php lc_search_form(); ?>
                                                                        
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

               <?php
                            
        }
        // add_action('', 'lc_search_modal');

    }
