<?php 
    /** 
     * POST PAGE OBJECTS
     * Displays project details in a structured sidebar format
     */

    
    /**     BLOG POST Excerpt      */
    if(! function_exists('lc_get_the_excerpt')){
        
        function lc_get_the_excerpt($length = 20) {

            $excerpt = get_the_excerpt();
            $excerpt = wp_trim_words($excerpt, $length, '...');
        
            $read_more = '<a class="' . esc_attr('read-more') . '" href="' . esc_url(get_permalink(get_the_ID())) . '">' . esc_html_('Read More') . '</a>';
            return $excerpt . ' ' . $read_more;
        }

    }

    /**     BLOG POST CARD      */
    if(! function_exists('lc_post_card')){

        function lc_post_card( $m_class, $class = [], $show_excerpts = true, $show_more = true){
    
            // Safety check: Ensure $class is an array for implode to work smoothly
            if ( ! is_array( $class ) ) { $class = array(); }

            // 1. Convert $class to an array if it's a string, then implode it.
            $classes  = implode( ' ', (array) $class );

            // 2. CONCATENATE: Combine the two class variables into one string.
            $full_classes = trim( $m_class . ' ' . $classes );

            ?>

                <article class="<?php echo esc_attr( $full_classes ) ?>" > 

                    <!-- thumbnail -->

                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="<?php echo esc_attr('post-card__header'); ?>" >
                                        
                        <?php if ( has_post_thumbnail() ) : ?>

                            <?php the_post_thumbnail('post-thumbnail', array('class' => $m_class .'__thumbnail', 'alt' => get_the_title(), 'title' => get_the_title() )); ?>
    
                        <?php else : ?>

                            <img src="<?php echo esc_url(get_template_directory_uri() . '/public/images/image-placeholder.webp'); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" title="<?php echo esc_attr(get_the_title()) ?>" class="<?php echo esc_attr('post-card-header-image'); ?>" >
                                   
                        <?php endif; ?>
                                                          
                    </a> 
                                    
                    <!-- body -->
            
                    <div class="<?php echo esc_attr('post-card__body justify-content-between'); ?>" >

                        <div class="post-card__body-top">
                                    
                            <div class="post-card__body-title" >
                                                       
                                <span class="post-card__body-title-category" ><?php the_category(); ?><?php // the_time(' d F, Y '); ?></span>
                 
                                <h5 class="post-card__body-title-heading" ><a href="<?php echo the_permalink() ?>"  class="<?php echo esc_attr(''); ?>" ><?php the_title(); ?></a></h5>

                            </div>
                                    
                            <?php if ( $show_excerpts ) { ?>

                                <div class="post-card__body-text" >

                                    <p><?php echo substr(get_the_excerpt(),0,150, ) ?></p>
                                                
                                </div>                                                       
                                
                            <?php } ?> 

                        </div>

                        <div class="post-card__body-footer bg-white">

                            <?php if ( $show_more ) { ?>

                                <div class="<?php echo esc_attr('post-card-2__body-extra '); ?>" >
                                                
                                    <?php

                                        $text =  esc_html__( 'Read', 'law-corporate' );																		
                                        $url = esc_url( get_the_permalink() );																		
                                        $classes =  ['btn-slim', 'wide-button',];	
                                        $target = '_self';
                                        $rel = '';
            
                                        echo lc_cta_button ($text, $url, $classes, $target, $rel);                              
                        
                                    ?>

                                </div>
                                
                            <?php } ?>     
                                                                                    
                            <div class="<?php echo esc_attr('post-card__body-footer-stamp d-flex justify-content-between'); ?>"  >
                                                
                                <span  class="time"  ><?php // the_category(); ?><?php the_time(' d F, Y '); ?></span>

                                <span  class="time"  ></span>

                                <span  class="time"  ><?php echo esc_html(get_avg_read_time()); ?><span class="read-text"> Read</span></span>

                            </div>

                        </div>
  
                    </div>   
                                     
                    <!-- body -->
                      <!--                  
                    <div class="<?php echo esc_attr('post-card__body'); ?>" >

                        <div class="<?php echo esc_attr('post-card__body-title mb-0'); ?>" >

                            <h4 class="<?php echo esc_attr('mb-2'); ?>" ><a href="<?php echo the_permalink() ?>"  class="<?php echo esc_attr(''); ?>" ><?php the_title(); ?></a></h4>
                                        
                            <div class="<?php echo esc_attr('post-card__body-stamp d-flex '); ?>"  >

                                <?php echo esc_html('By'); ?>&nbsp;&nbsp;<?php if (function_exists('lc_post_author_data')) {lc_post_author_data();} ?>
                                            
                                <?php // the_category(); ?>&nbsp;&nbsp;&diams;&nbsp;&nbsp;

                                <span  class="<?php echo esc_attr('post-card__body-stamp-time '); ?>"  ><?php the_time(' d F, Y '); ?>&nbsp;&nbsp;&diams;&nbsp;&nbsp;

                                <?php // echo esc_html(get_avg_read_time()); ?></span>

                            </div>
                                    
                        </div>
                            
                        <?php if ( $show_excerpts ) { ?>

                            <div class="<?php echo esc_attr('post-card__body-text my-2 '); ?>" >

                                <p><?php echo substr(get_the_excerpt(),0,30, ) ?></p>
                                            
                            </div>                                                       
                            
                        <?php } ?>     
                                                        
                        <div class="<?php echo esc_attr('post-card__body-stamp d-flex '); ?>"  >
                                                
                            <?php the_category(); ?>

                            <span  class="<?php echo esc_attr('post-card__body-stamp-time '); ?>"  ><?php echo esc_html(get_avg_read_time()); ?></span>

                        </div>

                        <?php if ( $show_more ) { ?>

                            <div class="<?php echo esc_attr('post-card__body-extra '); ?>" >
                                            
                                <?php

                                    $text =  esc_html__( 'Read', 'law-corporate' );																		
                                    $url = esc_url( get_the_permalink() );																		
                                    $classes =  ['btn-slim', 'wide-button',];	
                                    $target = '_self';
                                    $rel = '';
        
                              //      echo lc_cta_button ($text, $url, $classes, $target, $rel);                              
                    
                                ?>

                            </div>
                            
                        <?php } ?>   

                    </div>-->   

                </article>

            <?php

        }

    }

    /**     BLOG POST CARD - FEATURED    */
    if(! function_exists('lc_post_card_featured')){

        function lc_post_card_featured ( $m_class, $class = [], $show_excerpts = true, $show_more = true){
    
            // Safety check: Ensure $class is an array for implode to work smoothly
            if ( ! is_array( $class ) ) {
                $class = array();
            }

            // 1. Convert $class to an array if it's a string, then implode it.
            $classes  = implode( ' ', (array) $class );

            // 2. CONCATENATE: Combine the two class variables into one string.
            $full_classes = trim( $m_class . ' ' . $classes );

            ?>

                <article class="<?php echo esc_attr( $full_classes ) ?>" > 

                    <!-- thumbnail -->

                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="<?php echo esc_attr('post-card__header'); ?>" >
                                        
                        <?php if ( has_post_thumbnail() ) : ?>

                            <?php the_post_thumbnail('post-thumbnail', array('class' => $m_class .'__header-thumbnail', 'alt' => get_the_title(), 'title' => get_the_title() )); ?>
    
                        <?php else : ?>

                            <img src="<?php echo esc_url(get_template_directory_uri() . '/public/images/image-placeholder.webp'); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" title="<?php echo esc_attr(get_the_title()) ?>" class="<?php echo esc_attr('post-card-2__header-thumbnail'); ?>" >
                                   
                        <?php endif; ?>
                                                          
                    </a>
                                    
                    <!-- body -->
            
                    <div class="<?php echo esc_attr('post-card__body justify-content-between'); ?>" >

                        <div class="post-card__body-top">
                                    
                            <div class="post-card__body-title" >
                                                       
                                <span class="post-card__body-title-category" ><?php the_category(); ?><?php // the_time(' d F, Y '); ?></span>
                 
                                <h5 class="post-card__body-title-heading" ><a href="<?php echo the_permalink() ?>"  class="<?php echo esc_attr(''); ?>" ><?php the_title(); ?></a></h5>

                            </div>
                                    
                            <?php if ( $show_excerpts ) { ?>

                                <div class="post-card__body-text" >

                                    <p><?php echo substr(get_the_excerpt(),0,165, ) ?></p>
                                                
                                </div>                                                       
                                
                            <?php } ?> 

                        </div>

                        <div class="post-card__body-footer bg-white">

                            <?php if ( ! $show_more ) { ?>

                                <div class="<?php echo esc_attr('post-card-2__body-extra '); ?>" >
                                                
                                    <?php

                                        $text =  esc_html__( 'Read', 'law-corporate' );																		
                                        $url = esc_url( get_the_permalink() );																		
                                        $classes =  ['btn-slim', 'wide-button',];	
                                        $target = '_self';
                                        $rel = '';
            
                                        echo lc_cta_button ($text, $url, $classes, $target, $rel);                              
                        
                                    ?>

                                </div>
                                
                            <?php } ?>     
                                                                                    
                            <div class="<?php echo esc_attr('post-card__body-footer-stamp d-flex justify-content-between'); ?>"  >
                                                
                                <span  class="time"  ><?php // the_category(); ?><?php the_time(' d F, Y '); ?></span>

                                <span  class="time"  ></span>

                                <span  class="time"  ><?php echo esc_html(get_avg_read_time()); ?><span class="read-text"> Read</span></span>

                            </div>

                        </div>
  
                    </div>   
 
                </article>

            <?php

        }

    }

    /**     BLOG POST CARD - FEATURED SMALL     */
    if(! function_exists('lc_post_card_small')){

        function lc_post_card_small ( $m_class, $class = [], $show_excerpts = true, $show_more = true){
    
            // Safety check: Ensure $class is an array for implode to work smoothly
            if ( ! is_array( $class ) ) {
                $class = array();
            }

            // 1. Convert $class to an array if it's a string, then implode it.
            $classes  = implode( ' ', (array) $class );

            // 2. CONCATENATE: Combine the two class variables into one string.
            $full_classes = trim( $m_class . ' ' . $classes );

            ?>

                <article class="<?php echo esc_attr( $full_classes ) ?>" > 

                    <!-- thumbnail -->

                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="<?php echo esc_attr('post-card__header'); ?>" >
                                        
                        <?php if ( has_post_thumbnail() ) : ?>

                            <?php the_post_thumbnail('post-thumbnail', array('class' => $m_class .'__header-thumbnail', 'alt' => get_the_title(), 'title' => get_the_title() )); ?>
    
                        <?php else : ?>

                            <img src="<?php echo esc_url(get_template_directory_uri() . '/public/images/image-placeholder.webp'); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" title="<?php echo esc_attr(get_the_title()) ?>" class="<?php echo esc_attr('post-card-2__header-thumbnail'); ?>" >
                                   
                        <?php endif; ?>
                                                          
                    </a>
                                    
                    <!-- body -->
            
                    <div class="<?php echo esc_attr('post-card__body justify-content-between'); ?>" >

                        <div class="post-card__body-top">
                                    
                            <div class="post-card__body-title" >
                                                        
                                <span class="post-card__body-title-category d-flex" ><?php  the_category(); ?><?php // the_time(' d F, Y '); ?></span>
                
                                <h5 class="post-card__body-title-heading" ><a href="<?php echo the_permalink() ?>"  class="title-link" ><?php the_title(); ?></a></h5>

                            </div>
                                    
                            <?php if ( $show_excerpts ) { ?>

                                <div class="post-card__body-text mt-2" >

                                    <p><?php echo substr(get_the_excerpt(),0,165, ) ?></p>
                                                
                                </div>                                                       
                                
                            <?php } ?> 

                        </div>

                        <div class="post-card__body-footer d- bg-white">

                            <?php if ( $show_more ) { ?>

                                <div class="<?php echo esc_attr('post-card-2__body-extra '); ?>" >
                                                
                                    <?php

                                        $text =  esc_html__( 'Read', 'law-corporate' );																		
                                        $url = esc_url( get_the_permalink() );																		
                                        $classes =  ['btn-slim', 'wide-button',];	
                                        $target = '_self';
                                        $rel = '';
            
                                        echo lc_cta_button ($text, $url, $classes, $target, $rel);                              
                        
                                    ?>

                                </div>
                                
                            <?php } ?>     
                                                                                    
                            <div class="<?php echo esc_attr('post-card__body-footer-stamp d-flex justify-content-between'); ?>"  >
                                                
                                <span  class="time"  ><?php//  the_category(); ?><?php the_time(' d F, Y '); ?></span>

                                <span  class="time"  ></span>

                                <span  class="time"  ><?php echo esc_html(get_avg_read_time()); ?> <span class="read-text">Read</span></span>

                            </div>

                        </div>
  
                    </div>   
 

                </article>

            <?php

        }

    }

    /**     BLOG POST CARD 2     */
    if(! function_exists('lc_post_card_2')){

        function lc_post_card_2 ( $m_class, $class = [], $show_excerpts = true, $show_more = true){
    
            // Safety check: Ensure $class is an array for implode to work smoothly
            if ( ! is_array( $class ) ) {
                $class = array();
            }

            // 1. Convert $class to an array if it's a string, then implode it.
            $classes  = implode( ' ', (array) $class );

            // 2. CONCATENATE: Combine the two class variables into one string.
            $full_classes = trim( $m_class . ' ' . $classes );

            ?>

                <article class="<?php echo esc_attr( $full_classes ) ?>" > 

                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="<?php echo esc_attr('post-card-2__header'); ?>" >
                                        
                        <?php if ( has_post_thumbnail() ) : ?>

                            <?php the_post_thumbnail('post-thumbnail', array('class' => $m_class .'__header-thumbnail', 'alt' => get_the_title(), 'title' => get_the_title() )); ?>
    
                        <?php else : ?>

                            <img src="<?php echo esc_url(get_template_directory_uri() . '/public/images/image-placeholder.webp'); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" title="<?php echo esc_attr(get_the_title()) ?>" class="<?php echo esc_attr('post-card-2__header-thumbnail'); ?>" >
                                   
                        <?php endif; ?>
                                                          
                    </a>
                            
                    <div class="<?php echo esc_attr('post-card-2__body'); ?>" >

                        <div class="<?php echo esc_attr('post-card-2__body-title mb-0'); ?>" >

                            <h4 class="<?php echo esc_attr('mb-2'); ?>" ><a href="<?php echo the_permalink() ?>"  class="<?php echo esc_attr(''); ?>" ><?php the_title(); ?></a></h4>
                                        
                            <div class="<?php echo esc_attr('post-card-2__body-stamp d-flex '); ?>"  >
                                            
                                <?php the_category(); ?>&nbsp;&nbsp;&diams;&nbsp;&nbsp;

                                <span  class="<?php echo esc_attr('post-card-2__body-stamp-time '); ?>"  ><?php the_time(' d F, Y '); ?>&nbsp;&nbsp;&diams;&nbsp;&nbsp;

                                <?php echo esc_html(get_avg_read_time()); ?></span>

                            </div>
                                    
                        </div>
                            
                        <?php if ( $show_excerpts ) { ?>

                            <div class="<?php echo esc_attr('post-card-2__body-text my-2 '); ?>" >

                                <p><?php echo substr(get_the_excerpt(),0,166, ) ?></p>
                                            
                            </div>                                                       
                            
                        <?php } ?>     

                        <?php if ( $show_more ) { ?>

                            <div class="<?php echo esc_attr('post-card-2__body-extra '); ?>" >
                                            
                                <?php

                                    $text =  esc_html__( 'Read', 'law-corporate' );																		
                                    $url = esc_url( get_the_permalink() );																		
                                    $classes =  ['btn-slim', 'wide-button',];	
                                    $target = '_self';
                                    $rel = '';
        
                                    echo lc_cta_button ($text, $url, $classes, $target, $rel);                              
                    
                                ?>

                            </div>
                            
                        <?php } ?>     

                    </div>   
                                                                                              
                </article>

            <?php

        }

    }
    
    /**     READ TIME FUNCTION      **/
    if ( ! function_exists( 'get_avg_read_time' )) {

            /**
             * Estimates the reading time of a post.
             * * @param int $post_id The ID of the post to calculate.
             * @return string The estimated read time (e.g., "5 min read").
             */
            function get_avg_read_time($post_id = null) {
                if (is_null($post_id)) {
                    $post_id = get_the_ID();
                }
                if (!$post_id) {
                    return '';
                }

                // --- 1. SET CONSTANTS ---
                $words_per_minute = 200; // Standard reading speed
                $seconds_per_image = 12; // Time to process the first image
                $image_time_decrease = 2; // Decrease time for subsequent images

                // --- 2. GET CONTENT AND WORD COUNT ---
                $content = get_post_field('post_content', $post_id);
                
                // Remove shortcodes, HTML tags, and other non-readable elements
                $clean_content = strip_shortcodes($content);
                $clean_content = wp_strip_all_tags($clean_content);
                
                // Count the words
                $word_count = str_word_count($clean_content);

                // --- 3. CALCULATE WORD TIME ---
                $minutes_word_time = floor($word_count / $words_per_minute);
                $seconds_word_time = floor(($word_count % $words_per_minute) / ($words_per_minute / 60));
                
                // --- 4. CALCULATE IMAGE TIME ---
                // Count images using regex (adjust for your specific HTML structure if needed)
                preg_match_all('/<img\s[^>]*>/i', $content, $images);
                $image_count = count($images[0]);
                $seconds_image_time = 0;

                // Apply the decreasing time logic for the first 10 images
                for ($i = 1; $i <= $image_count; $i++) {
                    if ($i <= 10) {
                        $seconds_image_time += max(1, $seconds_per_image - (($i - 1) * $image_time_decrease));
                    } else {
                        // After 10 images, add a fixed 5 seconds per image
                        $seconds_image_time += 5; 
                    }
                }

                // --- 5. CALCULATE TOTAL TIME ---
                $total_seconds = ($minutes_word_time * 60) + $seconds_word_time + $seconds_image_time;
                
                // Final time, rounded up to the nearest minute
                $final_minutes = ceil($total_seconds / 60);

                // Return the formatted string
                return $final_minutes . ($final_minutes <= 1 ?  ' minute' : ' minutes' );
                
            }

    }
        
    if(!function_exists('lc_post_metadata')){

            function lc_post_metadata() {

                echo '<aside class="' . esc_attr('insight-aside col-md-12') . '" >';

                    // Get the ID of the current post
                    $post_id = get_queried_object_id();

                    $authors = get_post_meta($post_id, '_selected_authors', true);

                    $competency = wp_get_post_terms( get_the_ID(), 'competency', array("fields" => "names"));

                    ?>

                    <div class="insight-aside__inner">

                        <div class="insight-aside__item">
                            <span class="insight-aside__item-title">
                                <?php if (!empty($authors)) { echo (count($authors) > 1) ? 'Authors' : 'Author'; } else { echo 'Author'; } ?>                        
                            </span>
                            <?php lc_post_authors_det(); ?>
                        </div>  

                        <div class="insight-aside__item">
                            <span class="insight-aside__item-title"><?php echo esc_html('Related Expertise Area'); ?></span>
                            <span class="<?php echo esc_attr('insight-aside__item-value'); ?>"><?php echo esc_html(implode(', ', $competency)); ?></span>
                        </div>  

                    <?php

                echo '</aside>';

            }

    }
            
    function frontend_author_show () {

            /**
             * FRONTEND/PUBLIC: AUTHORS DISPLAY FUNCTIONS
             * Handles displaying selected authors on the public-facing website
             */

            // 1️⃣ Helper function to display selected authors on frontend
            function lc_display_selected_authors($post_id = null) {

                if (!$post_id) {
                    $post_id = get_the_ID();
                }
                
                $selected_authors = get_post_meta($post_id, '_lc_selected_authors', true);
                
                if (empty($selected_authors) || !is_array($selected_authors)) {
                    return '';
                }
                
                $output = '<div class="lc-post-authors">';
                $output .= '<h4>' . __('Post Authors', LCC_UI_TEXT_DOMAIN) . '</h4>';
                $output .= '<ul class="author-list">';
                
                foreach ($selected_authors as $author_id) {
                    $author_name = get_the_title($author_id);
                    $author_link = get_permalink($author_id);
                    $author_designation = get_post_meta($author_id, 'designation', true);
                    
                    $output .= '<li class="author-item">';
                    $output .= '<a href="' . esc_url($author_link) . '" class="author-link">';
                    $output .= '<span class="author-name">' . esc_html($author_name) . '</span>';
                    
                    if (!empty($author_designation)) {
                        $output .= ' <span class="author-designation">(' . esc_html($author_designation) . ')</span>';
                    }
                    
                    $output .= '</a>';
                    $output .= '</li>';
                }
                
                $output .= '</ul>';
                $output .= '</div>';
                
                return $output;
            }

            // 2️⃣ Shortcode for displaying authors
            function lc_authors_shortcode($atts) {

                $atts = shortcode_atts([
                    'post_id' => null,
                ], $atts);
                
                return lc_display_selected_authors($atts['post_id']);

            }
            add_shortcode('lc_post_authors', 'lc_authors_shortcode');

            // 3️⃣ Template tag for direct use in themes
            function lc_the_selected_authors($post_id = null) {
                echo lc_display_selected_authors($post_id);
            }

            // 4️⃣ Get selected authors as array (for custom implementations)
            function lc_get_selected_authors_data($post_id = null) {

                if (!$post_id) {
                    $post_id = get_the_ID();
                }
                
                $selected_authors = get_post_meta($post_id, '_lc_selected_authors', true);
                
                if (empty($selected_authors) || !is_array($selected_authors)) {
                    return [];
                }
                
                $authors_data = [];
                foreach ($selected_authors as $author_id) {
                    $authors_data[] = [
                        'id' => $author_id,
                        'name' => get_the_title($author_id),
                        'link' => get_permalink($author_id),
                        'designation' => get_post_meta($author_id, 'designation', true),
                        'position' => get_post_meta($author_id, 'position', true),
                        'thumbnail' => get_the_post_thumbnail($author_id, 'thumbnail'),
                        'excerpt' => get_the_excerpt($author_id)
                    ];
                }
                
                return $authors_data;
            }

            // 5️⃣ Enqueue frontend styles
            function lc_enqueue_authors_frontend_styles() {

                if (!is_admin()) {
                    
                    wp_add_inline_style('lc-authors-styles', '

                        .lc-post-authors {
                            margin: 20px 0;
                            padding: 15px;
                            background: #f9f9f9;
                            border-left: 4px solid #2271b1;
                        }
                        .lc-post-authors h4 {
                            margin: 0 0 10px 0;
                            color: #2271b1;
                            font-size: 18px;
                        }
                        .author-list {
                            list-style: none;
                            margin: 0;
                            padding: 0;
                        }
                        .author-item {
                            margin-bottom: 8px;
                            padding: 8px;
                            background: white;
                            border-radius: 3px;
                        }
                        .author-link {
                            text-decoration: none;
                            color: #2c3338;
                        }
                        .author-link:hover {
                            color: #2271b1;
                        }
                        .author-name {
                            font-weight: 600;
                        }
                        .author-designation {
                            color: #666;
                            font-size: 0.9em;
                            font-style: italic;
                        }

                    ');
                }
            }
            add_action('wp_enqueue_scripts', 'lc_enqueue_authors_frontend_styles');

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

    }

    if(! function_exists('lc_post_authors')){

        function lc_post_authors(){

            // Get the ID of the current post
            $post_id = get_queried_object_id();

            if (empty($post_id)) return;

            // Get assigned authors (array of CPT IDs)
            $authors = get_post_meta($post_id, '_lc_selected_authors', true);
            
            $author_links = [];

            if (!empty($authors) && is_array($authors)) {

                foreach( $authors as $author_id) {

                    $author_name = get_the_title($author_id);
                    $author_url  = get_permalink($author_id);

                    if ($author_name) {

                        // Build linked author name
                        $author_links[] = '<a href="' . esc_url($author_url) . '" class="lc-author-link">' . esc_html($author_name) . '</a>';  

                    }

                }

            } else {
                // Fallback: use the default post author
                $default_author_id   = get_post_field('post_author', $post_id);
                $default_author_name = get_the_author_meta('display_name', $default_author_id);
                $default_author_url  = get_author_posts_url($default_author_id);
                $author_links[] = '<a href="' . esc_url($default_author_url) . '" class="lc-author-link">' . esc_html($default_author_name) . '</a>';
            }
        
            // Format as "Author A and Author B" or "Author A, Author B, and Author C"
            $author_count = count($author_links);

            if ($author_count === 1) {

                $formatted_authors = $author_links[0];

            } elseif ($author_count === 2) {

                $formatted_authors = $author_links[0] . '&nbsp;and&nbsp;' . $author_links[1];

            } else {

                $last_author = array_pop($author_links);
                $formatted_authors = implode(',&nbsp; ', $author_links) . '&nbsp;and&nbsp;' . $last_author;

            }

            // Display the author's name
            //$post_authors  =  '<a href="' .  esc_url($author_url)  .  '">';
            $post_authors  = $formatted_authors;
            //$post_authors  .=  '</a>';

            echo $post_authors;
                
        }

    }

    if (! function_exists('lc_post_authors_det')) {

        /*
        function lc_post_authors_det() {

            // Get the current post ID
            $post_id = get_queried_object_id();

            if (! $post_id) { return; }

            // Get assigned authors (array of CPT IDs)
            $authors = get_post_meta($post_id, '_lc_selected_authors', true);

            if (empty($authors) || !is_array($authors)) {
                return;
            }

            echo '<div class="lc-post-authors">';
            echo '<h4>Authors</h4>';
            echo '<ul class="lc-author-list">';

            foreach ($authors as $author_id) {

                //
                $author_name = get_the_title($author_id);
                $author_url  = get_permalink($author_id);
                $author_img  = get_the_post_thumbnail($author_id, 'thumbnail', ['class' => 'author-thumb']);
                $position    = get_post_meta($author_id, 'position_title', true);

                $linkedin = get_post_meta($author_id, 'linkedin_url', true);
                $twitter = get_post_meta($author_id, 'twitter_url', true);
                $facebook = get_post_meta($author_id, 'facebook_url', true);
                $website = get_post_meta($author_id, 'website_url', true);

                echo '<li class="lc-author-item">';
                if ($author_img) {
                    echo '<div class="author-thumb-wrap">' . $author_img . '</div>';
                }
                echo '<div class="author-info">';
                echo '<a href="' . esc_url($author_url) . '" class="author-name">' . esc_html($author_name) . '</a>';
                if ($position) {
                    echo '<p class="author-position">' . esc_html($position) . '</p>';
                }
                    // Social links
                    $links = [];
                    if ($linkedin) $links[] = '<a href="' . esc_url($linkedin) . '" target="_blank" aria-label="LinkedIn">🔗 LinkedIn</a>';
                    if ($twitter) $links[] = '<a href="' . esc_url($twitter) . '" target="_blank" aria-label="Twitter">🐦 Twitter</a>';
                    if ($facebook) $links[] = '<a href="' . esc_url($facebook) . '" target="_blank" aria-label="Facebook">📘 Facebook</a>';
                    if ($website) $links[] = '<a href="' . esc_url($website) . '" target="_blank" aria-label="Website">🌐 Website</a>';

                    if (!empty($links)) {
                        echo '<div class="lc-author-social">' . implode(' | ', $links) . '</div>';
                    }
                echo '</div>';
                echo '</li>';
            }

            echo '</ul>';
            echo '</div>';

        }
        */

        function lc_post_authors_det() {

            // Get the current post ID
            $post_id = get_queried_object_id();
            if (!$post_id) return;

            // Get assigned authors (array of CPT IDs)
            $authors = get_post_meta($post_id, '_lc_selected_authors', true);

            echo '<section class="lc-authors">';

                // If no custom authors are found, fallback to post author
                if (empty($authors) || !is_array($authors)) {

                    $default_author_id = get_post_field('post_author', $post_id);
                    $default_author_name = get_the_author_meta('display_name', $default_author_id);
                    $default_author_img = get_avatar( $default_author_id, $default_author_name , ['class' => 'author-avatar__img rounded-full'] );
                    $default_author_url = get_author_posts_url($default_author_id);

                    //echo '<span class="insight-aside__item-title lc-post_author-title">Author</span>';
                    echo '<ul class="lc-authors-list">';
                        echo '<li class="lc-authors-item">';
                            echo '<div class="author">';
                                echo '<div class="author-avatar">';
                                    echo '<a href="' . esc_url($default_author_url) . '" class="author-avatar__link">';
                                        echo $default_author_img ?: '<span class="author-avatar__icon"><i class="fa-solid fa-user"></i></span>';
                                    echo '</a>';
                                echo '</div>';
                                echo '<div class="author-info"><h5 class="  class="author-info__name">';
                                    echo '<a href="' . esc_url($default_author_url) . '" >' . esc_html($default_author_name) . '</a></h5>';
                                echo '</div>';
                            echo '</div>';
                    echo '</li></ul>';
                    return;
                }

                //echo '<span class="insight-aside__item-title lc-post-author-title">';
                //echo (count($authors) > 1 ? 'Authors' : 'Author');
                //echo '</span>';

                echo '<ul class="lc-authors-list">';

                    foreach ($authors as $author_id) {

                        $author_name = get_the_title($author_id);
                        $author_url  = get_permalink($author_id);
                        $author_img  = get_the_post_thumbnail($author_id, 'thumbnail', [
                            'class' => 'author-avatar__img',
                            'alt'   => esc_attr($author_name),
                        ]);
                        $position = get_post_meta($author_id, 'designation', true);

                        // Social links
                        $socials = [
                            'facebook' => get_post_meta($author_id, 'facebook', true),
                            'instagram' => get_post_meta($author_id, 'instagram', true),
                            'linkedin' => get_post_meta($author_id, 'linkedin', true),
                            'x-twitter'  => get_post_meta($author_id, 'x-twitter', true),
                            'website'  => get_post_meta($author_id, 'website', true),
                            'youtube'  => get_post_meta($author_id, 'youtube', true),
                        ];

                        echo '<li class="lc-authors-item">';

                            echo '<div class="author">';

                                echo '<div class="author-avatar">';
                                    echo '<a href="' . esc_url($author_url) . '" class="author-avatar__link">';
                                         echo $author_img ?: '<span class="author-avatar__icon"><i class="fa-solid fa-user"></i></span>';
                                    echo '</a>';
                                echo '</div>';

                                echo '<div class="author-info"><h5  class="author-info__name">';

                                    echo '<a href="' . esc_url($author_url) . '">' . esc_html($author_name) . '</a></h5>';
                                    if ($position) {
                                        echo '<h6 class="author-info__position">' . esc_html($position) . '</h6>';
                                    }

                                    // Render social links (if any)
                                    $links_output = [];
                                    foreach ($socials as $network => $url) {

                                        if (!$url) continue;

                                        $icons = [
                                            'facebook' => 'fa-brands fa-facebook-square',
                                            'instagram' => 'fa-brands fa-instagram',
                                            'linkedin' => 'fa-brands fa-linkedin',
                                            'x-twitter'  => 'fa-brands fa-x-twitter',
                                            'youtube'  => 'fa-brands fa-youtube',
                                            'website'  => 'fa-solid fa-globe',
                                        ];

                                        $links_output[] = sprintf(
                                            '<a href="%s" target="_blank" rel="noopener" class="author-info__social-link %s" aria-label="%s">
                                                <i class="%s"></i>
                                            </a>',
                                            esc_url($url),
                                            esc_attr($network),
                                            ucfirst($network),
                                            esc_attr($icons[$network])
                                        );

                                    }

                                    if (!empty($links_output)) {
                                        echo '<span class="author-info__social">' . implode('', $links_output) . '</span>';
                                    }
                                echo '</div>';
                                
                            echo '</div>';

                        echo '</li>';

                    }

                echo '</ul>';

                if ((count($authors) > 2 )) {
                
                    echo '<button class="show-more-authors mt-2" type="button">+ Show more</button>';

                }

            echo '</section>';

        }

    }    
