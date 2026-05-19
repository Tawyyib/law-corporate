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
                                        'container_class'   => 'nav-menu',
                                        // containver tag id
                                        'container_id'      => 'nav-menu',
                                        // do not fall back to first non-empty menu
                                        'theme_location'    => 'primary',
                                        //
                                        'depth'		        => 0,
                                        // do not fall back to wp_page_menu()
                                        'fallback_cb'       => false,
                                        // apply menu class
                                        'menu_class'        => 'navbar-nav ',
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
    
    // Post Archive Order
    if ( ! function_exists( 'lc_customize_archive_order' )) {
    
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
    
    }
      
    // fetch current custom taxonomy function - final functional
    if ( ! function_exists ( 'lc_get_current_taxonomy' )) {
            
        /**
         * Get current taxonomy with dynamic detection and manual fallback
         * 
         * @param string $manual_fallback Optional manual taxonomy name (e.g., 'competency', 'category')
         * @return string|null Taxonomy name or null
         */

        function lc_get_current_taxonomy($manual_fallback = '') {
            
            $taxonomy = null;
            $object = get_queried_object();
            
            // Case 1: On taxonomy archive page (category, tag, custom taxonomy)
            if (is_tax() || is_category() || is_tag()) {
                if (is_a($object, 'WP_Term')) {
                    $taxonomy = $object->taxonomy;
                }
            }
            
            // Case 2: On single post/page
            elseif (is_singular()) {
                $post_type = get_post_type();
                $all_taxonomies = get_object_taxonomies($post_type);
                
                // Exclude built-in taxonomies to get custom ones first
                $built_in = ['category', 'post_tag', 'post_format'];
                $custom_taxonomies = array_diff($all_taxonomies, $built_in);
                
                if (!empty($custom_taxonomies)) {
                    $taxonomy = reset($custom_taxonomies);
                } elseif (!empty($all_taxonomies)) {
                    $taxonomy = reset($all_taxonomies);
                }
            }
            
            // Case 3: On post type archive
            elseif (is_post_type_archive()) {
                $post_type = get_query_var('post_type');
                if (is_array($post_type)) {
                    $post_type = reset($post_type);
                }
                
                $all_taxonomies = get_object_taxonomies($post_type);
                $built_in = ['category', 'post_tag', 'post_format'];
                $custom_taxonomies = array_diff($all_taxonomies, $built_in);
                
                if (!empty($custom_taxonomies)) {
                    $taxonomy = reset($custom_taxonomies);
                } elseif (!empty($all_taxonomies)) {
                    $taxonomy = reset($all_taxonomies);
                }
            }
            
            // Case 4: Dynamic fallback for non-post pages (front-page, custom templates, etc.)
            if (empty($taxonomy)) {
                
                // Try to find any registered custom taxonomy
                $all_registered_taxonomies = get_taxonomies(['public' => true], 'names');
                $built_in = ['category', 'post_tag', 'post_format', 'nav_menu', 'link_category', 'wp_theme', 'wp_template_part'];
                $available_custom = array_diff($all_registered_taxonomies, $built_in);
                
                if (!empty($available_custom)) {
                    // Return the first custom taxonomy found
                    $taxonomy = reset($available_custom);
                } elseif (taxonomy_exists('category')) {
                    $taxonomy = 'category';
                }
            }
            
            // Apply manual fallback if provided and no taxonomy was found
            if (empty($taxonomy) && !empty($manual_fallback)) {
                $taxonomy = $manual_fallback;
            }
            
            // Final check: ensure taxonomy exists
            if (!empty($taxonomy) && !taxonomy_exists($taxonomy)) {
                $taxonomy = null;
            }
            
            return $taxonomy;
        }

        /*
            // Automatic detection (no manual fallback)
            $tax = lc_get_current_taxonomy();
            // Returns: detected taxonomy or first custom taxonomy found

            // With manual fallback (if automatic detection fails)
            $tax = lc_get_current_taxonomy('competency');
            // Returns: detected taxonomy OR 'competency' if nothing found

            // Force specific fallback on front page
            $tax = lc_get_current_taxonomy('expertise');
            // Returns: detected taxonomy OR 'expertise'

            // On custom page template, force fallback
            if (is_page_template('page-what-we-do.php')) {
                $tax = lc_get_current_taxonomy('competency');
            } 
        */
                
    }

    /**    Fetch Related Items Query     **/
    if ( ! function_exists( 'lc_get_related_items_query' )) {
                            
        function lc_get_related_items_query($post_type) {
            
            $posts_per_page = is_tax() ? 2 : 3;
            $taxonomy = lc_get_current_taxonomy();
            
            if (!$taxonomy) {
                return null;
            }
            
            $term_ids = array();
            $exclude_ids = array();
            
            if (is_tax()) {
                $term = get_queried_object();
                $term_ids = array($term->term_id);
                
            } elseif (is_singular()) {
                $terms = get_the_terms(get_the_ID(), $taxonomy);
                
                if (empty($terms) || is_wp_error($terms)) {
                    return null;
                }
                
                $term_ids = wp_list_pluck($terms, 'term_id');
                $exclude_ids = array(get_the_ID());
                
            } else {
                return null;
            }
            
            if (empty($term_ids)) {
                return null;
            }
            
            $args = array(
                'post_type' => $post_type,
                'post_status' => 'publish',
                'posts_per_page' => $posts_per_page,
                'tax_query' => array(
                    array(
                        'taxonomy' => $taxonomy,
                        'field' => 'term_id',
                        'terms' => $term_ids,
                    ),
                ),
                'orderby' => 'date',
                'order' => 'DESC',
            );
            
            if (!empty($exclude_ids)) {
                $args['post__not_in'] = $exclude_ids;
            }
            
            return new WP_Query($args);
        }

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

    /**  BREADCRUMB OBJECTS  **/
    $crumbObjects = get_template_directory() . '/inc/functions/crumbObjects.php';
    require_once $crumbObjects;
    
    /** THEME BUTTON OBJECTS   **/
    $buttonObjects = get_template_directory() . '/inc/functions/buttonObjects.php';
    require_once $buttonObjects;

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


/** FOOTER AND UNDERFOOTER */
         
    // F. Footer Branding    
    if(!function_exists('lc_footer_branding')){

        function lc_footer_branding() {

            // Get the brand image URLs
            $brand_image_url = get_theme_mod('brand_image', 0);
            $brand_image_mobile_url = get_theme_mod('brand_image_mobile', 0);
            
            // Get the statement of purpose
            $statement_of_purpose = get_theme_mod('statement_of_purpose', 0);
                        
            // Get the statement of purpose
            $certification_statement = get_theme_mod('certification_statement', 0);
            
            // Start outputting brand information
            $brand_label = '<div class="brand-info d-flex">';
            
            // Output brand images
            if ( !empty( $brand_image_url ) ) {
                $brand_label .= '<div class="brand-info__img">';
                $brand_label .= '<img src="' . esc_url( $brand_image_url ) . '" alt="' . esc_attr('Brand Image') . '">';
                $brand_label .= '</div>';
                
                // Check for mobile image only if present
                if ( !empty( $brand_image_mobile_url ) ) {
                    $brand_label .= '<div class="brand-info__img-mobile">';
                    $brand_label .= '<img src="' . esc_url( $brand_image_mobile_url ) . '" alt="Brand Image Mobile">';
                    $brand_label .= '</div>';
                }
            }
            
            // Output statement of purpose
            if ( !empty( $statement_of_purpose ) ) {
                $brand_label .= '<p class="brand-info__statement">';
                $brand_label .= esc_html__( $statement_of_purpose, 'law-corporate' );
                $brand_label .= '</p>';
            }

            if ( ! empty ( $certification_statement )) {
                $brand_label .= '<div class="brand-info__trustBadge">';
                    $brand_label .= '<span class="fas fa-certificate"></span>';
                    $brand_label .= esc_html__( $certification_statement ) ;
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
                                '<li><a href="%s" class="%s" target="_blank" rel="noopener noreferrer" title="%s"><span class="fab fa-%s"></span></a></li>',
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

    // Footer Menu
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
                                
                <div class="modal fade" id="searchModal" tabindex="-1'" aria-labelledby="'searchModalLabel" aria-hidden="true'" >
                    
                    <!-- Modal -->

                        <div class="modal-dialog container-app">

                            <div class="modal-content">

                                <!-- modal-close-button -->

                                <div class="modal-header">

                                    <div class="btn-wrapper">

                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        <span><?php echo esc_html__('CLOSE', "law-corporate"); ?></span>
                                        
                                    </div>

                                </div>

                                <!-- modal-close-button -->

                                <div class="'modal-body">

                                    <div class="search-box">

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
