<?php

// Ensure this code runs within the WordPress environment
if (!defined('ABSPATH')) {
    exit;
}
 
    $blog_section_title = esc_html('Latest News & Insights', 'law-corporate');
    if (get_post_meta($post->ID, 'blog_section_title', true) != '') {
        $blog_section_title = get_post_meta($post->ID, 'blog_section_title', true);
    }
    $blog_section_sub = esc_html('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Adipiscing diam donec adipiscing tristique risus nec.');
    if (get_post_meta($post->ID, 'blog_section_sub', true) != '') {
        $blog_section_sub = get_post_meta($post->ID, 'blog_section_sub', true);
    }
    
?>

    <!-- Frontpage Post Lists -->

    <section class="<?php echo esc_attr('front-post py-7 bg-light'); ?>" >

        <div class="<?php echo esc_attr('content-inner container-app'); ?>" >      

            <!-- section header -->  
            <div class="<?php echo esc_attr('section-header mb-6'); ?>" >
                <h2 class="<?php echo esc_attr(' mb-0'); ?>" ><?php echo esc_html($blog_section_title); ?></h2>
                <!--<p><?php // echo esc_html($blog_section_sub); ?></p>-->
                <!--<hr>-->
            </div>

            <?php $posts= get_posts(array('numberposts' => 1, 'posts_per_page' => 2, ));

                if(count($posts) > 0){
                                
                foreach ($posts as $post) : setup_postdata($post); 
            
            ?>

            <!-- section content -->  
            <div class="<?php echo esc_attr(' section-content mt-3 mb-6 '); ?>" >

                <div class="<?php echo esc_attr(' post-list section-content-inner row flex-row justify-content-between'); ?>">

                    <?php                

                        if (function_exists('lc_post_card')) {

                            lc_post_card();

                        }
                                
                        endforeach; 

                        wp_reset_postdata();
                            
                    ?>

                </div>

            </div>

            <?php if (count($posts) >= 2) { ?>
                                        
                <div class="<?php echo esc_attr('text-center') ?>" >

                    <a href="<?php echo get_permalink(get_option('page_for_posts')); ?>" class="<?php echo esc_attr('btn btn-alternate')?>"><?php echo esc_html('See More'); ?></a>
                                    
                </div>

            <?php  } 

             }else {

                echo '<p class="'. esc_attr('no-content extra') .'"  >'. esc_html__('Media related content not created yet, please check back later.', 'law-corporate') . '</p>';

            } ?>
  
        </div>                      
        
    </section>
    