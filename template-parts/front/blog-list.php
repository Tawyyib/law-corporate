<?php

    // Ensure this code runs within the WordPress environment
    if (!defined('ABSPATH')) { exit; }

    // Defaults Entries
    $default_title = esc_html__('Latest News & Insights', 'law-corporate');
    $default_desc = esc_html('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Adipiscing diam donec adipiscing tristique risus nec.');

    // Custom Entries
    $blog_section_title = get_post_meta($post->ID, 'blog_section_title', true) ? : $default_title;        
    $blog_section_sub = get_post_meta($post->ID, 'blog_section_sub', true) ? : $default_desc;
    
?>

    <!-- Frontpage Post Lists 2 -->

    <section class="<?php echo esc_attr('front-post py-7 bg-light'); ?>" >

        <div class="<?php echo esc_attr('content-inner container-app'); ?>" >      

            <!-- section header -->  

            <div class="<?php echo esc_attr('section-header mb-6'); ?>" >

                <h2 class="<?php echo esc_attr(' mb-0'); ?>" ><?php echo esc_html($blog_section_title); ?></h2>
                
                <p><?php echo esc_html($blog_section_sub); ?></p>

            </div>

            <?php
            
                $args = array(
                    'post_type'  => 'post',
                    'posts_per_page' => 5, // 1 featured + 3 grid posts
                    'ignore_sticky_posts' => 1,
                );
                
                $blog_query = new WP_Query($args);

                if ($blog_query->have_posts()) :

                $total_posts = $blog_query->found_posts; // Number of posts retrieved in this query (max 4 in your example)
                
            ?>

            <div class="front-post-reel d- rowl mt-3 mb-6" >

                <?php $blog_query->the_post(); // Get the first post for the featured block ?>

                <div class="featured-post-block d-flex bg-dark">
                                                        
                    <?php 
                                                                                
                        if (function_exists('lc_post_card_featured')) {

                            $m_class = 'post-card';
                            $post_card_class = ['featured col-sm-12'];

                            lc_post_card_featured( $m_class, $post_card_class, true, true );;

                        }

                    ?>

                </div>

                <div class="recent-post-block col-md-6lx col-lg-7lx">

                    <div class="small-cards-reel align-items-stretch rowl">

                        <?php while ($blog_query->have_posts()) : $blog_query->the_post(); ?>
                                                        
                            <?php 
                                
                                //echo '<div class="col-12"> ';
                                                
                                if (function_exists('lc_post_card_small')) {

                                    $m_class = 'post-card';
                                    $post_card_class = ['small col-sm-'];

                                    lc_post_card_small( $m_class, $post_card_class, false, false );

                                }

                                //echo '</div>';

                            ?>

                        <?php endwhile; ?>

                    </div>

                </div>

            </div> 
            
            <?php if ($total_posts > 3) :  ?>
                        
                <div class="text-center mt-4">
                    <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>" class="btn btn-outline-dark btn-lg">Browse All Articles →</a>
                </div>

            <?php endif ?>

            <?php endif; wp_reset_postdata(); ?>

        </div>

    </section>
