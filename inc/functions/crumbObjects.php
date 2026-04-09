<?php
    
// Breadcrumb
if (! function_exists('lc_breadcrumb')) {

    //$term hierarchy helper
    function lc_get_deepest_term($terms, $taxonomy) {

        if (empty($terms) || is_wp_error($terms)) return null;

        $depth_cache = [];

        foreach ($terms as $term) {
            $depth_cache[$term->term_id] = count(get_ancestors($term->term_id, $taxonomy));
        }

        usort($terms, function($a, $b) use ($depth_cache) {
            return $depth_cache[$b->term_id] - $depth_cache[$a->term_id];
        });

        return $terms[0];
        
    }

    //term ancestors helper
    function lc_get_term_ancestors($term, $taxonomy, $delimiter) {

        if (! $term || is_wp_error($term)) return;

        $ancestors = array_reverse(get_ancestors($term->term_id, $taxonomy));

        foreach ($ancestors as $ancestor_id) {

            $ancestor = get_term($ancestor_id, $taxonomy);

            if (!is_wp_error($ancestor)) {

                echo $delimiter . '<a href="' . esc_url(get_term_link($ancestor)) . '">'
                    . esc_html($ancestor->name) . '</a>';

            }

        }

    }

    function lc_breadcrumb() {

        // Custom Breadcrumb Navigation Function
        $showOnHome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
        $delimiter = '&nbsp;&nbsp;&raquo;&nbsp;&nbsp;'; // delimiter between crumbs
        $home = 'Home'; // text for the 'Home' link
        $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
        $before = '<span class="current">'; // tag before the current crumb
        $after = '</span>'; // tag after the current crumb

        $post_id = get_the_ID();

        $current_post = get_post();

        $homeLink = esc_url(home_url());

        echo '<div id="crumbs" class="crumbs">';

            /* ---------------- HOME ---------------- */
            if (is_front_page()) {

                if ( $showOnHome ) {
                        
                    echo '<a href="' . $homeLink . '">' . esc_html( $home ) . '</a>';
                
                }
                
                echo '</div>';
                return;

            } 

            /* ---------------- BLOG INDEX (POSTS PAGE) ---------------- */
            elseif ( is_home() ) {

                $blog_page_id = get_option('page_for_posts');

                echo '<a href="' . esc_url($homeLink) . '">' . esc_html($home) . '</a>';

                if ( $blog_page_id ) {

                    echo $delimiter . $before . esc_html( get_the_title($blog_page_id) ) . $after;

                } else {

                    echo $delimiter . $before . 'Blog' . $after;

                }

                echo '</div>';
                return;

            }

            echo '<a href="' . $homeLink . '">' . esc_html( $home ) . '</a>';
        
            /* ---------------- CATEGORY ---------------- */
            if (is_category()) {

                $blog_page_id = get_option('page_for_posts');

                if ( $blog_page_id ) {

                    echo $delimiter . '<a href="' . esc_url( get_permalink($blog_page_id) ) . '">' . esc_html( get_the_title($blog_page_id) ) . '</a>';

                }

                $thisCat = get_queried_object();

                if ( $thisCat->parent != 0 ) {

                    //Ancestors - 1
                    lc_get_term_ancestors( $thisCat, 'category', $delimiter );

                }

                echo $delimiter . $before . esc_html( single_cat_title('', false) )  . $after;

            } 
                
            /* ---------------- TAXONOMY ---------------- */                                
            elseif (is_tax() ) {

                $term = get_queried_object();

               if ( ! $term || is_wp_error( $term ) ) {
                    echo '</div>';
                    return;
                }
                                
                $tax_obj = get_taxonomy( $term->taxonomy );

                if ( $tax_obj && ! empty( $tax_obj->object_type ) ) {

                    $post_type = get_post_type();

                    if ( in_array( $post_type, $tax_obj->object_type, true ) ) {

                        $post_type_object = get_post_type_object( $post_type );

                    }

                    if ( $post_type_object ) {

                        echo $delimiter . '<span class="no-link-crumb">' . esc_html( $post_type_object->labels->name ) . '</span>';

                    }

                }

                if ( $term->term_id ) {

                    //Ancestors - 2
                    lc_get_term_ancestors( $term, $term->taxonomy, $delimiter );                  

                }

                echo $delimiter . $before . esc_html( $term->name ) . $after;

            }
                
            /* ---------------- SINGLE POST ---------------- */
            elseif (is_single() && !is_attachment()) {

                $post_type = get_post_type();

                    // SERVICES
                    if ($post_type === 'services') {

                        $post_type_object = get_post_type_object($post_type);

                        if ( $post_type_object ) {
                        
                            // CPT LABEL (NOT CLICKABLE — YOUR DESIGN)
                            echo $delimiter . '<span class="no-link-crumb">' . esc_html( $post_type_object->labels->name ) . '</span>';

                        }

                        $taxonomies = get_object_taxonomies($post_type, 'objects');

                        foreach ($taxonomies as $taxonomy) {

                            // check if the taxonomy is not a tag
                            if ($taxonomy->hierarchical === false) continue;

                            $terms = get_the_terms($post_id, $taxonomy->name);
                                
                            if ($terms && !is_wp_error($terms)) {

                                $term = lc_get_deepest_term($terms, $taxonomy );

                                if ( $term->term_id ) {

                                    //Ancestors - 3
                                    lc_get_term_ancestors( $term, $term->taxonomy, $delimiter ); 
                                        
                                }

                                echo $delimiter .  '<a href="' . esc_url(get_term_link($term) ) . '">' . esc_html($term->name) . '</a>';
                                break; // Stop after the first taxonomy with terms

                            }

                        }
                    
                    } 
                    
                // PROJECTS + PEOPLE
                elseif ( in_array( $post_type, [ 'projects', 'people' ], true ) ) {

                    $post_type_obj = get_post_type_object($post_type);

                    if ( $post_type_obj ) {

                        echo $delimiter . '<a href="' . esc_url( get_post_type_archive_link($post_type) ) . '">' . esc_html( $post_type_obj->labels->name ) . '</a>';

                    }
                   
                }
                     
                    // BLOG POSTS
                    else {

                        $blog_page_id = get_option('page_for_posts');

                        if ( $blog_page_id ) {

                            echo $delimiter . '<a href="' . esc_url( get_permalink($blog_page_id) ) . '">' . esc_html( get_the_title($blog_page_id) ) . '</a>';
                            
                        }

                        $categories = get_the_category();

                        if ( $categories ) {

                            $category = lc_get_deepest_term($categories, 'category');

                            if ( $category ) {

                                // Ancestors - 4
                                lc_get_term_ancestors( $category, 'category', $delimiter );

                            }

                            // Current category
                            echo $delimiter . '<a href="' . esc_url( get_term_link( $category ) ) . '">' . esc_html( $category->name ) . '</a>';

                        }

                    }

                // Show current post title
                if (( $showCurrent )){

                    echo $delimiter . $before . esc_html(shorten_title(get_the_title(), 40)) . $after;

                }
                    
            } 
                            
            /* ---------------- CPT ARCHIVE ---------------- */
            elseif ( is_post_type_archive() ) {

                $post_type = get_queried_object();

                if ( $post_type && isset($post_type->labels->name) ) {
                
                    echo $delimiter . $before . esc_html( $post_type->labels->name ) . $after;
                
                }

            }
                                
            /* ---------------- SEARCH ---------------- */                
            elseif (is_search()) {
                    
                echo $delimiter . $before . 'Search results for "' . esc_html(get_search_query() ) . '"' . $after;
                
            } 
                
            /* ---------------- DAY ---------------- */                                           
            elseif (is_day()) {

                $year  = get_query_var('year');
                $month = get_query_var('monthnum');
                $day   = get_query_var('day');            
                                    
                echo $delimiter;
                echo '<a href="' . esc_url( get_year_link( $year ) ) . '">' . esc_html( $year ) . '</a>' . $delimiter;
                echo '<a href="' . esc_url( get_month_link( $year, $month ) ) . '">' 
                . esc_html( date_i18n( 'F', mktime(0,0,0,$month,1) ) ) . '</a>' . $delimiter;
                echo $before . esc_html( $day ) . $after;                

            } 
                
            /* ---------------- MONTH ---------------- */                          
            elseif (is_month()) {

                $year  = get_query_var('year');
                $month = get_query_var('monthnum');

                echo $delimiter;
                echo '<a href="' . esc_url( get_year_link( $year ) ) . '">' . esc_html( $year ) . '</a>' . $delimiter;
                echo $before .  esc_html( date_i18n( 'F', mktime(0,0,0,$month,1) ) ) . $after;

            } 
                
            /* ---------------- YEAR ---------------- */                        
            elseif (is_year()) {
                
                $year  = get_query_var('year');

                echo $delimiter . $before . esc_html( $year ) . $after;

            } 
                
            /* ---------------- ATTACHMENT ---------------- */         
            elseif (is_attachment()) {

                $parent = null;
                
                if ( $current_post && $current_post->post_parent ) {

                    $parent = get_post( $current_post->post_parent );

                }

                if ( $parent ) {

                    $parent_type = get_post_type( $parent );

                    // 🔹 If parent is a blog post
                    if ( $parent_type === 'post' ) {

                        $blog_page_id = get_option('page_for_posts');

                        if ( $blog_page_id ) {
                            
                            echo $delimiter . '<a href="' . esc_url( get_permalink($blog_page_id) ) . '">' . esc_html( get_the_title($blog_page_id) ) . '</a>';
                        
                        }

                        $categories = get_the_category( $parent->ID );

                        if ( ! empty($categories) ) {

                            $category = lc_get_deepest_term($categories, 'category');

                            if ( $category ) {
                                                            
                                // Ancestors - 5
                                lc_get_term_ancestors( $category, 'category', $delimiter );

                            }

                            // Current category
                            echo $delimiter . '<a href="' . esc_url( get_term_link( $category ) ) . '">' . esc_html( $category->name ) . '</a>';
                                
                        }

                    }

                    // 🔹 If parent is CPT
                    elseif ( $parent_type !== 'page' ) {

                        $post_type_obj = get_post_type_object( $parent_type );

                        if ( $post_type_obj ) {

                            echo $delimiter . '<span class="no-link-crumb">' . esc_html( $post_type_obj->labels->name ) . '</span>';

                        }

                    }

                    // 🔹 Parent link (always safe)
                    echo $delimiter . '<a href="' . esc_url( get_permalink( $parent ) ) . '">' . esc_html( get_the_title( $parent ) ) . '</a>';

                }

                // 🔹 Current attachment
                if ( $showCurrent ) {

                    echo $delimiter . $before . esc_html( get_the_title() ) . $after;

                }

            } elseif (is_page()  && $current_post && ! $current_post->post_parent) {

                if ($showCurrent == 1) echo $delimiter . $before . esc_html( get_the_title() ) . $after;

            } elseif (is_page() && $current_post->post_parent) {

                $parent_id  = $current_post->post_parent;
                $breadcrumbs = array();

                while ($parent_id) {

                    $page = get_post($parent_id);
                    if ( ! $page ) break;

                    $breadcrumbs[] = '<a href="' . esc_url( get_permalink($page->ID) )  . '">' . esc_html( get_the_title($page->ID) ) . '</a>';
                    $parent_id = $page->post_parent;

                }

                $breadcrumbs = array_reverse($breadcrumbs);

                for ($i = 0; $i < count($breadcrumbs); $i++) {

                    echo $delimiter . $breadcrumbs[$i];

                }
                
                if ($showCurrent == 1) echo $delimiter . $before . esc_html( get_the_title() ) . $after;

            }
                
            /* ---------------- TAG ---------------- */           
            elseif (is_tag()) {

                echo $delimiter . $before . 'Posts tagged "' . esc_html( single_tag_title('', false) ) . '"' . $after;

            } 
        
            /* ---------------- AUTHOR ---------------- */                
            elseif (is_author()) {

                $author = get_queried_object();

                if ( $author && isset($author->display_name) ) {

                    echo $delimiter . $before . 'Posts authored by ' . esc_html( $author->display_name ) . $after;

                }

            } 
                
            /* ---------------- 404 ---------------- */
            elseif (is_404()) {

                echo $delimiter . $before . 'Error 404' . $after;
                    
            }

            /* ---------------- PAGINATION ---------------- */
            $wrap = is_category() || is_post_type_archive() || is_tax() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author();

            if ( get_query_var('paged') ) {

                if ( $wrap ) echo ' (';

                echo esc_html__('Page', "law-corporate") . ' ' . intval(get_query_var('paged'));

                if ( $wrap ) echo ')';

            }

        echo '</div>';

    }

}
