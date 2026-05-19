<?php

    // Ensure this code runs within the WordPress environment
    if (!defined('ABSPATH')) { exit; }

    // Defaults Entries
    $default_title = esc_html__('Latest News & Insights', 'law-corporate');
    $default_desc = esc_html('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Adipiscing diam donec adipiscing tristique risus nec.');

    // Custom Entries
    $blog_section_title = get_post_meta($post->ID, 'blog_section_title', true) ? : $default_title;        
    $blog_section_sub = get_post_meta($post->ID, 'blog_section_sub', true) ? : $default_desc;
    
    // link-button properties
    $button_label = __( 'Browse All', 'law-corporate' );
    $post_url = esc_url ( get_permalink( get_option('page_for_posts') ) );
    $button_classes = esc_attr ( 'btn-alternate' );        
    $icon_classes = esc_attr( 'fas fa-arrow-right' );        
    
?>

    <!-- Frontpage Post Lists 2 -->

    <section class="'front-post py-7 bg-light" >

        <div class="content-inner container-app" >      

            <!-- section header -->  
            <div class="section-header mb-6" >

                <h2 class="mb-0" ><?php echo esc_html($blog_section_title); ?></h2>
                
                <p><?php echo esc_html($blog_section_sub); ?></p>

            </div>

            <?php
            
                // 1. Get sticky posts (max 1)
                $sticky_ids = get_option('sticky_posts');
                $featured_id = !empty($sticky_ids) ? $sticky_ids[0] : 0;
            
                $args = array(
                    'post_type'                 => 'post',
                    'ignore_sticky_posts'   => 0,
                );
                
                if ( empty( $featured_id ) ) {

                    $args['posts_per_page'] = 5;

                } else {

                    $args['posts_per_page'] = 4;
                    $args['post__not_in'] = $featured_id ? array ( $featured_id ) : array ();

                }
                
                $blog_query = new WP_Query($args);

                if  ( $blog_query->have_posts() || $featured_id ) :

                    $total_posts = $blog_query->found_posts; // Number of posts retrieved in this query (max 4 in your example)
                
            ?>

                <div class="front-post-reel d- rowl mt-3 mb-6" >
                    
                    <div class="featured-post-block d-flex bg-dark">                                                     
                        <?php                

                            $m_class = 'post-card';
                            $post_card_classes = ['featured col-sm-12'];
                            
                            if ( $featured_id ) {
                                
                                $featured_post = get_post ( $featured_id ); 
                                                    
                                if ($featured_post) {

                                    // Use your lc_post_card() function for the featured post
                                    // (You may need to temporarily set up post data)
                                    $post = $featured_post; 

                                    setup_postdata($post);

                                    if (function_exists('lc_post_card')) {

                                        lc_post_card ( $m_class, $post_card_classes, true, true );

                                    }
                                        
                                    wp_reset_postdata();

                                } 

                            } else {

                                // Scenario B: No sticky? Use the first post from our query
                                if ( $blog_query->have_posts() ) {

                                    $blog_query->the_post(); // Advance pointer
                                        
                                    if ( function_exists( 'lc_post_card' ) ) {

                                        lc_post_card ( $m_class, $post_card_classes, true, true );

                                    }

                                }

                            }

                        ?>
                    </div>
                    
                    <div class="recent-post-block col-md-6lx col-lg-7lx">

                        <div class="small-cards-reel align-items-stretch rowl">

                            <?php while ($blog_query->have_posts()) : $blog_query->the_post(); ?>
                                                            
                                <?php 
                                                                                    
                                    if (function_exists( 'lc_post_card' )) {

                                        $m_class = 'post-card';
                                        $post_card_class = ['small col-sm-'];

                                        lc_post_card ( $m_class, $post_card_class, false, false );

                                    }

                                ?>

                            <?php endwhile; ?>

                        </div>

                    </div>

                </div> 
                
                <?php if ($total_posts > 3) :  ?>
                            
                    <div class="text-center mt-4">

                        <?php lc_cta_button( $button_label, $post_url, $button_classes, '', '', '', $icon_classes ) ?>
                        
                    </div>

                <?php endif ?>

            <?php endif; wp_reset_postdata(); ?>

        </div>

    </section>
