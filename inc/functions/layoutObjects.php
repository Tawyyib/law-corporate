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
    
// Breadcrumb
if (!function_exists('lc_breadcrumb')) {

       function lc_breadcrumb() {
        // Custom Breadcrumb Navigation Function
        $showOnHome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
        $delimiter = '&nbsp;&nbsp;&raquo;&nbsp;&nbsp;'; // delimiter between crumbs
        $home = 'Home'; // text for the 'Home' link
        $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
        $before = '<span class="current">'; // tag before the current crumb
        $after = '</span>'; // tag after the current crumb

        global $post;

        $homeLink = esc_url(home_url());

        if (is_home() || is_page('Contact') || is_front_page()) {

            if ($showOnHome == 1) echo '<div id="crumbs" class="crumbs"><a href="' . $homeLink . '">' . $home . '</a></div>';

        } else {

            echo '<div id="crumbs" class="crumbs"><a href="' . $homeLink . '">' . $home . '</a>';

            if (is_category()) {

                $thisCat = get_category(get_query_var('cat'), false);

                if ($thisCat->parent != 0) {

                    //displays parent category
                    echo $delimiter . get_category_parents($thisCat->parent, TRUE, '', '');
                }
                //displays current category
                echo $delimiter . $before . single_cat_title('', false) . $after;

            } elseif (is_search()) {

                echo $delimiter . $before . 'Search results for "' . get_search_query() . '"' . $after;

            } elseif (is_day()) {

                echo $delimiter;
                echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a>' . $delimiter;
                echo '<a href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . get_the_time('F') . '</a>' . $delimiter;
                echo $before . get_the_time('d') . $after;

            } elseif (is_month()) {

                echo $delimiter;
                echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a>' . $delimiter;
                echo $before . get_the_time('F') . $after;

            } elseif (is_year()) {

                echo $delimiter . $before . get_the_time('Y') . $after;

            } elseif (is_tax() && !is_category() && !is_tag()) {

                $post_type = get_post_type();

                $post_type_object = get_post_type_object($post_type);

                if ($post_type_object) {

                     echo $delimiter . '<a href="' . /** get_post_type_archive_link($post_type) .  */'">' . $post_type_object->labels->name . '</a>';
     
                        $taxonomy = get_queried_object();

                        // Checks if taxonomy has offspring
                        if ($taxonomy->parent != 0) {

                            $parent = get_term($taxonomy->parent, $taxonomy->taxonomy);

                            // Display parent terms
                            echo $delimiter . get_term_parents_list($parent->term_id, $taxonomy->taxonomy, array('link' => true, 'separator' => ''));
                        }
                        // Display current term without additional delimiter
                        echo $delimiter . $before . single_term_title('', false) . $after;

                } else {

                        echo $delimiter . get_the_archive_title();

                }

            } elseif (is_single() && !is_attachment()) {

                $post_type = get_post_type();
                $output = false;

                // For 'services' post type
                if ($post_type == 'services') {

                    $post_type_object = get_post_type_object($post_type);
                    echo $delimiter . '<a href="' . get_post_type_archive_link($post_type) . '">' . $post_type_object->labels->name . '</a>';

                    $taxonomies = get_object_taxonomies($post_type, 'objects');

                    foreach ($taxonomies as $taxonomy) {

                        $terms = get_the_terms($post->ID, $taxonomy->name);

                        // check if the taxonomy is not a tag
                        if ($taxonomy->name !== 'post_tag') {
                            
                            if ($terms && !is_wp_error($terms)) {

                                $main_term = $terms[0]; // Assuming the first term is the main term

                                if ($main_term->parent != 0) {

                                    $parent = get_term($main_term->parent, $taxonomy->name);
                                    echo $delimiter . get_term_parents_list($parent->term_id, $taxonomy->name, array('link' => true, 'separator' => $delimiter));
                                    
                                }
                                echo $delimiter .  '<a href="' . get_term_link($main_term) . '">' . $main_term->name . '</a>';
                                $output = true;
                                break; // Stop after the first taxonomy with terms
                            }

                        }

                    }

                // For 'projects' post type
                } elseif ($post_type == 'projects' || $post_type == 'people') {

                    $post_type_obj = get_post_type_object($post_type);
                    $slug = $post_type_obj->rewrite;
                    echo $delimiter . '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type_obj->labels->name . '</a>';
                    $output = true;

                // For default post type (blog posts)
                } else {

                    $categories = get_the_category();
                    if ($categories) {
                        $category = $categories[0];
                        echo $delimiter . get_category_parents($category, true, $delimiter, false);
                        $output = true;
                    }

                }

                // Show current post title
                if (($showCurrent == 1) && ($post_type == 'post')){

                    echo $before . shorten_title(get_the_title(), 40) . $after;

                }else {

                    echo $delimiter . $before . shorten_title(get_the_title(), 40) . $after;

                }
                
            } elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {

                if (get_post_type() != '') {

                    // For custom post type archives
                    $post_type = get_post_type_object(get_post_type());
                    echo $delimiter . $before . $post_type->labels->name . $after;

                }else {

                    echo $delimiter . get_the_archive_title();

                }
                
            } elseif (is_attachment()) {

                $parent = get_post($post->post_parent);
                $cat = get_the_category($parent->ID); $cat = $cat[0];
                echo $delimiter . get_category_parents($cat, TRUE, $delimiter);
                echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a>';
                if ($showCurrent == 1) echo $delimiter . $before . get_the_title() . $after;

            } elseif (is_page() && !$post->post_parent) {

                if ($showCurrent == 1) echo $delimiter . $before . get_the_title() . $after;

            } elseif (is_page() && $post->post_parent) {

                $parent_id  = $post->post_parent;
                $breadcrumbs = array();

                while ($parent_id) {
                    $page = get_page($parent_id);
                    $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
                    $parent_id  = $page->post_parent;
                }

                $breadcrumbs = array_reverse($breadcrumbs);

                for ($i = 0; $i < count($breadcrumbs); $i++) {

                    echo $delimiter . $breadcrumbs[$i];

                }
                if ($showCurrent == 1) echo $delimiter . $before . get_the_title() . $after;

            } elseif (is_tag()) {

                echo $delimiter . $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;

            } elseif (is_author()) {

                global $author;
                $userdata = get_userdata($author);
                echo $delimiter . $before . 'Posts authored by ' . $userdata->display_name . $after;

            } elseif (is_404()) {

                echo $delimiter . $before . 'Error 404' . $after;
                
            }

            if (get_query_var('paged')) {
                if (is_category() || is_post_type_archive() || is_tax()  || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) echo ' (';

                echo __('Page', "law-corporate") . ' ' . get_query_var('paged');

                if (is_category() || is_post_type_archive() || is_tax()  || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) echo ')';
            }

            echo '</div>';
        }
    }

}

    // Call Button
    if(!function_exists('lc_call_button')){

        function lc_call_button (){ 
            
            // Get site's phone number
            $phone_no = get_theme_mod('phone', '');

            if(!empty($phone_no)){

                $call_button = '<a class="' .    esc_attr(' btn btn-call ') . '" ';
                $call_button .= 'href="'    .   esc_attr(' tel:+234'. $phone_no) . '" alt="'   .   esc_attr(' tel:+234'. $phone_no)    .   '"';
                $call_button .= 'title="'    .   esc_attr('+234'. $phone_no)   .   '"     type="' .   esc_attr(' button ')    .   '" >';
                $call_button .= '<i class="'    .   esc_attr('fa-solid fa-phone')   .   '"></i>';
                $call_button .= '</a>';

                echo $call_button;

            }

            }
            add_action('', 'lc_call_button');

    }
  
    // A. FrontPage Banner Layout
    if(!function_exists('lc_site_banner')){
                
        function lc_site_banner (){ 
                                
                // 1. Slider . $i Image Set
                $banner_image = get_template_directory_uri() . '/public/images/items-judges.webp'; // 
                    if (get_theme_mod('front_banner_image','') != '') 
                    {
                        $banner_image = wp_get_attachment_image_src(get_theme_mod('front_banner_image',''));
                    }
                    							
					// 3. Banner Title and Texts
					$banner_title = 'Best in Class Advisory Services'; 
					if(get_theme_mod('front_banner_title','') !='')
					{
						$banner_title = get_theme_mod('front_banner_title','');
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

    /**     BLOG POST Excerpt      */
    if(! function_exists('lc_get_the_excerpt')){
        
        function lc_get_the_excerpt($length = 20) {

            $excerpt = get_the_excerpt();
            $excerpt = wp_trim_words($excerpt, $length, '...');
        
            $read_more = '<a class="read-more" href="' . get_permalink(get_the_ID()) . '">Read More</a>';
            return $excerpt . ' ' . $read_more;
        }

    }

    /**     BLOG POST CARD      */
    if(! function_exists('lc_post_card')){

        function lc_post_card(){

            ?>

                <article class="<?php echo esc_attr('post-card col-sm-12 col-smd-6') ?>" > 

                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="<?php echo esc_attr('post-card__thumbnail mb-0'); ?>" >
                                        
                        <?php if ( has_post_thumbnail() ) : ?>

                            <?php the_post_thumbnail('post-thumbnail', array('class' => 'post-card__thumbnail-img', 'alt' => get_the_title(), 'title' => get_the_title() )); ?>
    
                        <?php else : ?>

                            <img src="<?php echo esc_url(get_template_directory_uri() . '/public/images/image-placeholder.webp'); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" title="<?php echo esc_attr(get_the_title()) ?>" class="<?php echo esc_attr('post-card-header-image'); ?>" >
                                   
                        <?php endif; ?>
                                                          
                    </a>
                            
                    <div class="<?php echo esc_attr('post-card__body  mt-2'); ?>" >

                        <div class="<?php echo esc_attr('post-card__body-title mb-0'); ?>" >

                            <h3 class="<?php echo esc_attr('mb-2'); ?>" ><a href="<?php echo the_permalink() ?>"  class="<?php echo esc_attr(''); ?>" ><?php the_title(); ?></a></h3>
                                        
                            <div class="<?php echo esc_attr('post-card__body-stamp d-flex '); ?>"  >
                                            
                                <?php the_category(); ?>&nbsp;&nbsp;&diams;&nbsp;&nbsp;

                                <span  class="<?php echo esc_attr('post-card__body-stamp-time '); ?>"  ><?php the_time(' d F, Y '); ?></span>

                            </div>
                                    
                        </div>

                        <div class="<?php echo esc_attr('post-card__body-text my-2 '); ?>" >

                            <p><?php echo substr(get_the_excerpt(),0,166, ) ?></p>
                                        
                        </div>

                        <div class="<?php echo esc_attr('post-card__body-extra '); ?>" >

                            <a href="<?php the_permalink(); ?>" class="<?php echo esc_attr('btn btn-slim'); ?>"><?php echo esc_html('Read'); ?></a>

                        </div>

                    </div>   
                                                                                              
                </article>

            <?php

        }
        add_action('', 'lc_post_card');

    }
    
    /**     PERSON POST CARD      */
    if (!function_exists('lc_person_card')) {

        function lc_person_card() {
            $gender = get_post_meta(get_the_ID(), 'gender', true);
            $designation = get_post_meta(get_the_ID(), 'designation', true);
    
            $person_card = '<figure class="' . esc_attr('person-card col-mxl-3 col-lmd-5 col-sm-12 mb-0 ') . '">';
    
            $person_card .= '<a href="' . esc_url(get_permalink()) . '" ';
            $person_card .= 'title="' . esc_attr(get_the_title()) . '" ';
            $person_card .= 'class="' . esc_attr('person-card__thumbnail mb-0') . '">';
    
            if (has_post_thumbnail()) {
                $person_card .= get_the_post_thumbnail(get_the_ID(), 'post-thumbnail', array('class' => 'person-card__thumbnail-image', 'alt' => get_the_title(), 'title' => get_the_title()));
            } else {
                $image_url = ($gender === 'Female') ? get_template_directory_uri() . '/public/images/female-avatar.webp' : get_template_directory_uri() . '/public/images/male-avatar.webp';
                $person_card .= '<img src="' . esc_url($image_url) . '" alt="' . esc_attr(get_the_title()) . '" title="' . esc_attr(get_the_title()) . '" class="' . esc_attr('person-card__thumbnail-image') . '">';
            }    
            $person_card .= '</a>';    
            $person_card .= '<div class="' . esc_attr('person-card__meta d-flex flex-column mb-3') . '">';
            $person_card .= '<span class="' . esc_attr('person-card__meta-name mb-1') . '"><a href="' . esc_url(get_permalink()) . '" class="' . esc_attr('') . '">' . esc_html(get_the_title()) . '</a></span>';
    
            if (!empty($designation)) {
                $person_card .= '<span class="person-card__meta-role">' . esc_html($designation) . '</span>';
            }    
            $person_card .= '</div>';
    
            $person_card .= '</figure>';
    
            echo $person_card;

        }
        add_action('', 'lc_person_card');

    }    
    
    /**     PROJECT POST CARD      */
    if(! function_exists('lc_projects_card')){

        function lc_projects_card(){

            $location_city = get_post_meta(get_the_ID(), 'location_city', true);
            $location_state = get_post_meta(get_the_ID(), 'location_state', true);
            $location_country = get_post_meta(get_the_ID(), 'location_country', true);

            $location_parts = array(
                $location_city,
                $location_state,
                $location_country,
            );
            $project_location = implode(', ', array_filter($location_parts, function($value) {
                return !empty($value);
            }));

            ?>

                <article class="<?php echo esc_attr(' project-card d-flex '); ?>" > 
                                    
                    <?php if ( has_post_thumbnail() ) : ?>

                    <a href="<?php esc_url(get_the_permalink()); ?>" title="<?php the_title_attribute(); ?>" class="<?php echo esc_attr('project-card__thumbnail col-slg-6 mb-0'); ?>" >

                        <?php the_post_thumbnail('post-thumbnail', array('class' => 'project-card__thumbnail-image', 'alt' => get_the_title(), 'title' => get_the_title() )); ?>
                                
                    </a>

                    <?php endif; ?>
                                                        
                    <div class="<?php echo esc_attr('project-card__body col-slg-6 d-flex flex-column justify-content-center mt-0'); ?>" >

                        <h3 class="<?php echo esc_attr('project-card__body-title mb-0'); ?>" ><a href="<?php echo the_permalink() ?>"  class="<?php echo esc_attr(''); ?>" ><?php the_title(); ?></a></h3>
                               
                        <div class="<?php echo esc_attr('project-card__body-text my-2 '); ?>" >

                            <p><?php echo substr(get_the_excerpt(),0, 400, ) ?></p>
                                            
                        </div>
                                                                                    
                        <div class="<?php echo esc_attr('project-card__meta mb-1'); ?>"><b><?php echo esc_html('Location:');  ?>&nbsp;</b><span class="<?php echo esc_attr('project-card__meta-location mb-1'); ?>" ><?php echo esc_html($project_location);  ?></span></div>
                        
                        <!-- <a href="<?php // the_permalink(); ?>" class="btn btn-slim"><?php // echo esc_html('Read Details'); ?></a> -->

                    </div>   
                                                                                              
                </article>

            <?php

        }
        add_action('', 'lc_projects_card');

    }

    /**     SERVICE CARD      */
    if(! function_exists('lc_service_card')){

        function lc_service_card(){

            ?>

                <div class="<?php echo esc_attr('service-card col-sm-12'); ?>" > 
                
                    <a href="<?php echo the_permalink() ?>"  class="<?php echo esc_attr('service-card__term d-flex align-items-center justify-content-between p-3'); ?>" ><span class="<?php echo esc_attr(''); ?>" ><?php the_title(); ?></span><i class="<?php echo esc_attr('fas fa-chevron-circle-right'); ?>"></i></a>
                                        
                    <span class="<?php echo esc_attr('service-card__excerpt px-3 py-2 bg-dar'); ?>"  ><?php echo the_excerpt(); ?></span>
                                                                                              
                </div>

            <?php

        }
        add_action('', 'lc_service_card');

    }

    /**   SERVICE-TAXONOMY CARD      */
    if(! function_exists('lc_expert_card')){

        function lc_expert_card($taxonomy, $exclude_term_slug){

            $exclude_term = get_term_by('slug', $exclude_term_slug, $taxonomy);

            // Check if the term exists
            if ($exclude_term) {

                // Retrieve terms excluding the specified term
                $terms = get_terms( [
                                    'taxonomy' => 'technical-areas' ,
                                    'exclude' => array($exclude_term->term_id) ,
                                    'orderby' => 'time' ,
                                    'order' => 'desc' ,
                                    'hide_empty' => true ,
                                ]);

                // Check if there are any terms            
                if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
                        
                    $service = '<div class="'  .  esc_attr(' section-content-inner row align-items-stretch align-content-center justify-content-between')  .  '">';
                                        
                    foreach( $terms as $term ) {

                        $icon_url = wp_get_attachment_url( get_term_meta($term->term_id, 'taxonomy-icon', true));
                        
                        $tax_excerpt = esc_html('Experts with difference, top-notch services.');
                        if (get_term_meta( $term->term_id, 'taxonomy-excerpt', true ) !='' ) {

                            $tax_excerpt = get_term_meta($term->term_id, 'taxonomy-excerpt', true);
                    
                        }

                        $service .= '<a href="' .  get_term_link($term)  . '" alt="' .  $term->name  .  '" class="' . esc_attr('tax-card col-mlg-4 my-0') . '" >';                        
                    //    $service .= '<div class="' . esc_attr('tax-card col-mlg-4 my-0') . '" >' ;

                            $service .= '<div class="'  .  esc_attr('tax-card__header d-flex align-items-center align-content-center  mb-4')  .  '">';
                                $service .= '<figure class="'  .  esc_attr('tax-card__header-icon')  .  '">';
                                    $service .= '<img src="'  .  esc_url($icon_url)  .  '" class="'  .  esc_attr('svg-icon')  .  '" alt="'  . $term->name .  '">';
                                $service .= '</figure>';
                                $service .= '<span class="'.  esc_attr('tax-card__header-title')  .'" >' . $term->name;  '</span>';
                            $service .= '</div>';
                            
                            $service .= '<div class="'  .  esc_attr('tax-card__content')  .  '">';
                                $service .= '<p class="'  .  esc_attr('tax-card__content-body mb-4')  .  '">'  .  $tax_excerpt  .  '</p>';
                                $service .= '<i class="'  .  esc_attr('tax-card__content-button fas fa-chevron-circle-right') .  '"></i>' ;
                            $service .= '</div>';
                                    
                    //    $service .=  '</div>';
                        $service .= '</a>';

                    } 
                                    
                    $service .=  '</div>';

                    echo $service;
                        
                } else{

                    echo '<p class="'. esc_attr('no-content extra') .'"  >'. esc_html__('Services related content not created yet, please check back later.', "law-corporate") . '</p>';

                }

            }

        }
        add_action('','lc_expert_card');

    }

    /** Back Button */
    if(! function_exists('lc_back_button')){

        function lc_back_button(){

            if ( wp_get_referer() )
            {
                $back_text = __( '&laquo;&nbsp;&nbsp;Go Back', "law-corporate" );
                $back_button    = "\n<button id='back-button' class='btn btn-back back-button' onclick='javascript:history.back()'>$back_text</button>";
                echo $back_button;
            }
        }
        add_action( '', 'lc_back_button' );

    }

    /** POST AUTHOR DETAILS OUTSIDE OF LOOP */
    if(! function_exists('lc_post_author_data')){

        function lc_post_author_data(){

            // Get the ID of the current post
            $post_id = get_queried_object_id();

            // Check if we have a valid post ID
            if ($post_id) {
                
                // Get the author ID of the current post
                $author_id = get_post_field('post_author', $post_id);

                // Get the author's display name
                $author_name = get_the_author_meta('display_name', $author_id);

                 // Get the URL to the author's archive page
                $author_url = get_author_posts_url($author_id);

                // Display the author's name
                $post_author_name  =  '<a href="' .  esc_url($author_url)  .  '">';
                $post_author_name  .= esc_html($author_name);
                $post_author_name  .=  '</a>';

                echo $post_author_name;
                
            }

        }
        add_action('post_author_data', 'lc_post_author_data');

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
                'Facebook' => 'fab fa-facebook-f',
                'Instagram' => 'fab fa-instagram',
                'LinkedIn' => 'fab fa-linkedin-in',
                'Twitter' => 'fab fa-twitter',
                'X-Twitter' => 'fab fa-x-twitter',
                'YouTube' => 'fab fa-youtube'
            );
            $output = '<ul class="social-profile bg-dar">';
            foreach ($social_media as $platform => $icon_class) {
    
                $url = get_post_meta($post_id, 'social_media_' . strtolower($platform), true);
    
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

    // A. Project Page Permalink
    if(!function_exists('get_projects_permalink')){

        function get_projects_permalink(){ 
            
            // Get the permalink for the 'about' page
            $project_permalink = get_permalink_by_slug('projects');

            if ($project_permalink) {

                echo esc_url($project_permalink);

            } else {

                echo esc_html__('link not found.', "law-corporate");

            }

        }
        add_action('', 'get_projects_permalink');

    }

    // A. teams Page Permalink
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

    // A. About Page Permalink
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

    /** SIDE BAR SECTIION */
    if(!function_exists('lc_porject_metadata')){

        function lc_project_metadata(){

            echo '<section  class="' . esc_attr('project__metadata col-smd-12 bg-light') . '" >';

                $technical_areas = wp_get_post_terms( get_the_ID(), 'technical-areas', array("fields" => "names"));

                // Fetch Project
                $project_owner = get_post_meta(get_the_ID(), 'project_owner', true);
                $project_sponsor = get_post_meta(get_the_ID(), 'project_sponsor', true);

                $location_city = get_post_meta(get_the_ID(), 'location_city', true);
                $location_state = get_post_meta(get_the_ID(), 'location_state', true);
                $location_country = get_post_meta(get_the_ID(), 'location_country', true);

                $start_date = get_post_meta(get_the_ID(), 'start_date', true);
                $end_date = get_post_meta(get_the_ID(), 'end_date', true);

                $location_parts = array(
                    $location_city,
                    $location_state,
                    $location_country,
                );
                $project_location = implode(', ', array_filter($location_parts, function($value) {
                    return !empty($value);
                }));

                // Initialize variables for date display
                $project_start_date = '';
                $project_end_date = '';

                if ($start_date || $end_date) {

                    // Convert the date string to a DateTime object
                    $start_date_obj = DateTime::createFromFormat('Y-m-d', $start_date);
                        $end_date_obj = DateTime::createFromFormat('Y-m-d', $end_date);

                    if ($start_date_obj) {
                        // Format the date to show only the year
                        $project_start_date = $start_date_obj->format('Y');
                    }
                    if ($end_date_obj) {
                        // Format the date to show only the year
                        $project_end_date = $end_date_obj->format('Y');
                    }
                        
                }

                ?>

                <div class="<?php echo esc_attr('project__metadata_inner row p-4_5'); ?>">

                    <div class="<?php echo esc_attr('project__metadata_item'); ?>">
                        <span class="<?php echo esc_attr('project__metadata_item-title'); ?>"><?php echo esc_html('Technical Summary'); ?></span>
                        <span class="<?php echo esc_attr('project__metadata_item-value'); ?>"><?php echo esc_html(implode(', ', $technical_areas)); ?></span>
                    </div>  

                    <div class="<?php echo esc_attr('project__metadata_item'); ?>">

                        <span class="<?php echo esc_attr('project__metadata_item-title'); ?>"><?php echo esc_html('Project Owner'); ?></span>
                        <span class="<?php echo esc_attr('project__metadata_item-value'); ?>"><?php // esc_html($project_owner); ?>
                        <?php
                            if($project_owner != ''){

                                echo implode( ', ' , $project_owner );
                                
                            }else{

                                echo esc_html__( 'No sponsors found.', "law-corporate");

                            }
                            ?>
                         </span>

                    </div>     

                    <div class="<?php echo esc_attr('project__metadata_item'); ?>">
                        <span class="<?php echo esc_attr('project__metadata_item-title'); ?>"><?php echo esc_html('Location'); ?></span>
                        <span class="<?php echo esc_attr('project__metadata_item-value'); ?>"><?php echo esc_html($project_location); ?></span>
                    </div>    

                    <div class="<?php echo esc_attr('project__metadata_item'); ?>">
                        <span class="<?php echo esc_attr('project__metadata_item-title'); ?>"><?php echo esc_html('Duration'); ?></span>
                        <span class="<?php echo esc_attr('project__metadata_item-value'); ?>"><?php echo esc_html($project_start_date); ?> - <?php echo esc_html($project_end_date); ?></span>
                    </div>                    

                </div>

                <?php

            echo '</section>';

        }

    }
    
    if(!function_exists('lc_services_rel')){
        
        function lc_services_rel(){

            global $post;

            echo '<section  class="' . esc_attr('side-item col-smd-12') . '" >';

                echo  '<h4 class="' . esc_html('side-item__header d-flex px-3 mb-2') . '"><span>' . esc_html('Related Services') . '</span><i class="'  .  esc_attr('fas fa-folder-tree ms-4') .  '"></i></h4>';
                echo  '<hr>';

                // get terms associated with the current post.
                $terms = get_the_terms( get_the_ID(), 'technical-areas' );

                //
                if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {

                    $term_ids = array_map( function( $term ) {

                        return $term->term_id;

                    }, $terms );
                
                    // Query for related posts
                    $args = array(
                        'post_type' => 'services',
                        'post_status' => 'publish',
                        'posts_per_page' => 4,
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'technical-areas',
                                'field' => 'term_id',
                                'terms' => $term_ids,
                            ),
                        ),
                        'post__not_in' => array( $post->ID ),
                    );
                
                    $related_services = new WP_Query( $args );
                
                    if ( $related_services->have_posts() ) {

                        // list all services related
                        $service_item = '<ul class="' . esc_attr('side-item__list bg-ligh') . '">';

                            while ( $related_services->have_posts() ){
                                    
                                $related_services->the_post();
                                    
                                $service_item .=  '<li><a href="' ;
                                $service_item .=    get_the_permalink();
                                $service_item .=   '" class="' . esc_attr('px-3 py-2 d-flex align-items-center justify-content-between bg-light') . '">';
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

            echo '</section>';
        
        }

    }

    if(!function_exists('lc_projects_rel')){
        
        function lc_projects_rel(){

            global $post;
            
            $post_type = get_post_type();;

            echo '<section  class="' . esc_attr('side-item col-smd-12') . '" >';

            if ($post_type == 'post' || $post_type == 'projects') {

                echo  '<h4 class="' . esc_attr('side-item__header d-flex px-3 mb-2 ') . '"><span>' . esc_html__('Related Projects', "law-corporate")  .  '</span><i class="'  .  esc_attr('fas fa-magnifying-glass-chart ms-4') .  '"></i></h4>';

            } else {

                echo '<h4 class="' . esc_attr('side-item__header d-flex px-3 mb-2') . '"><span>' . esc_html__('Recent Projects', "law-corporate")  .  '</span><i class="'  .  esc_attr('fas fa-magnifying-glass-chart ms-4') .  '"></i></h4>';

            }

            echo '<hr class="' . esc_attr('') . '" >';

                // get terms associated with the current post.
                $terms = get_the_terms( get_the_ID(), 'technical-areas' );

                //
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
                                'taxonomy' => 'technical-areas',
                                'field' => 'term_id',
                                'terms' => $term_ids,
                            ),
                        ),
                        'post__not_in' => array( $post->ID ),
                    );
                
                    $related_projects = new WP_Query( $args );
                
                    if ( $related_projects->have_posts() ) {

                        $project_item = '<ul class="' . esc_attr('side-item__list bg-ligh') . '">';

                            while ( $related_projects->have_posts() ){
                                    
                                $related_projects->the_post();
                                    
                                $project_item .=  '<li><a href="' ;
                                $project_item .=    get_the_permalink();
                                $project_item .=   '" class="' . esc_attr('p-3 d-flex align-items-center justify-content-between bg-light') . '">';
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

            echo '<section  class="' . esc_attr('side-item col-smd-12') . '" >';

                echo  '<h4 class="' . esc_attr('side-item__header d-flex px-3 mb-2 ') . '"><span>' . esc_html__('Related Posts', "law-corporate")  .  '</span><i class="'  .  esc_attr('fas fa-magnifying-glass-chart ms-4') .  '"></i></h4>';

            echo '<hr class="' . esc_attr('') . '" >';

                // get terms associated with the current post.
                $terms = get_the_terms( get_the_ID(), 'technical-areas' );

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
                                'taxonomy' => 'technical-areas',
                                'field' => 'term_id',
                                'terms' => $term_ids,
                            ),
                        ),
                        'post__not_in' => array( $post->ID ),
                    );
                
                    $related_post = new WP_Query( $args );
                
                    if ( $related_post->have_posts() ) {

                        $post_item = '<ul class="' . esc_attr('side-item__list bg-ligh') . '">';

                            while ( $related_post->have_posts() ){
                                    
                                $related_post->the_post();
                                    
                                $post_item .=  '<li><a href="' ;
                                $post_item .=    get_the_permalink();
                                $post_item .=   '" class="' . esc_attr('p-3 d-flex align-items-center justify-content-between bg-light') . '">';
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
  
    /** CONTACT SECTIION */
  
        // A. Contact Information Layout
    if(!function_exists('lc_contact_map')){

        function lc_contact_map(){ 
        
            $map_url = get_theme_mod('map_url', 'law-cprporate');

            $map_canvas = '<div class="' . esc_attr(' map-canvas container-fluid ') . '" >';
                $map_canvas .= '<iframe  class="' . esc_attr('map-iframe') . '"';
                    $map_canvas .= 'src="' . esc_url($map_url) . '" frameborder="' . esc_attr(0) . '" allowfullscreen="' . esc_attr('') . '"';
                    $map_canvas .= 'loading="' . esc_attr('lazy') . '"';
                    $map_canvas .= 'referrerpolicy="' . esc_attr('no-referrer-when-downgrade') . '">';
                $map_canvas .= '</iframe>';
            $map_canvas .= '</div>';
    
            echo $map_canvas;
        
        }
        add_action('', 'lc_contact_map');

    }

    // A. Contact Information Layout
    if(!function_exists('lc_contact_info')){

        function lc_contact_info(){ 
        
            ?>

            <div class="<?php echo esc_attr('contact-details d-flex'); ?>">

                <!-- Contact Address Section -->
                <div class="<?php echo esc_attr('contact-address'); ?>" >

                    <span class="<?php echo esc_attr('contact-header'); ?>" ><i class="<?php echo esc_attr('fa-solid fa-location-dot'); ?>" ></i></span>
                
                    <?php lc_contact_address(); ?>               

                </div>
                
                <!-- Phone Number Section -->                
                <div class="<?php echo esc_attr('contact-phone'); ?>">

                    <span class="<?php echo esc_attr('contact-header'); ?>" ><i class="<?php echo esc_attr('fa-solid fa-phone'); ?>" ></i></span>
                    
                    <?php lc_contact_phone(); ?>               

                </div>          

                <!-- Email Address Section -->                
                <div class="<?php echo esc_attr('contact-mail'); ?>">
                    
                    <span class="<?php echo esc_attr('contact-header'); ?>" ><i class="<?php echo esc_attr('fa-solid fa-envelope'); ?>" ></i></span>
                    
                    <?php lc_contact_email(); ?>               
                    
                </div>             

            </div>          
        
        <?php
        
        }
        add_action('', 'lc_contact_info');

    }

    // B. Contact Address Object        
    if(!function_exists('lc_contact_address')){

        function lc_contact_address(){ 

            // Get site's address information
            $address_line_1 = get_theme_mod('address_line_1', 0);
            $address_line_2 = get_theme_mod('address_line_2', 0);
            $address_line_3 = get_theme_mod('address_line_3', 0);
            $address_line_4 = get_theme_mod('address_line_4', 0);
                      
            // Out site's address 
            $address = '<div class="' . esc_attr('contact-address-in') .'">';

                $address .= '<p class="' . esc_attr('address-lines') . '">';

                if(!empty($address_line_1)){

                    $address .= '<span>' . esc_html($address_line_1) . '</span>';

                }
                if(!empty($address_line_2)){

                    $address .= '<span>' . esc_html($address_line_2) . '</span>';

                }
                if(!empty($address_line_3)){

                    $address .= '<span>' . esc_html($address_line_3) . '</span>';

                }
                if(!empty($address_line_4)){

                    $address .= '<span>' . esc_html($address_line_4) . '</span>';
                    
                }

                $address .= '</p>';

            $address .= '</div>';

            echo $address;

        } 
        add_action('', 'lc_contact_address'); 

    }

    // C. Phone Number Object        
    if(!function_exists('lc_contact_phone')){

        function lc_contact_phone(){ 

            // Get site's phone number
            $phone_no = get_theme_mod('phone', 0);

            // Out the phone number
            if(!empty($phone_no)){
                $phone = '<p>';
                $phone .= '<a href="' . esc_attr('tel: +234'. $phone_no) . '" >' . esc_html('0'. $phone_no) . '</a>';
                $phone .= '</p>';
            }

            echo $phone;

        } 
        add_action('', 'lc_contact_phone');

    }

    // D. Email Address Object   
    if(!function_exists('lc_contact_email')){

        function lc_contact_email(){ 

            // Get site email address
            $email_addr = get_theme_mod('email', 0);

            // Output the email address
            if(!empty($email_addr)){
            $email = '<p>';
            $email .= '<a href="' . esc_attr('mailto:' . $email_addr) . '" >' . esc_html($email_addr) . '</a>';
            $email .= '</p>';
            }

            echo $email;

        } 
        add_action('', 'lc_contact_email');

    }

    /** FORK SECTION */

    // E. Contact Form  
    if(!function_exists('lc_contact_form')){

        function lc_contact_form(){ 
            
            ?>
            <div class="<?php echo esc_attr('contact-form col-md-11 col-ms'); ?>" >
                                                                                            
                <p class="<?php echo esc_attr('form-note'); ?>"><?php echo esc_html__('Fields marked with "*" are required, and must be filled.', "law-corporate"); ?></p>

                <?php the_content(); ?>

                <div class="<?php echo esc_attr('clear'); ?>"></div> 
                        
            </div>
            
            <?php

        } 

    }    

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
