<?php

    // Ensure this code runs within the WordPress environment
    if (!defined('ABSPATH')) {
        exit;
    }
     
        $lead_section_title = esc_html('The Management');
        if (get_post_meta($post->ID, 'lead_section_title', true) != '') {
            $lead_section_title = get_post_meta($post->ID, 'lead_section_title', true);
        }
        $lead_section_desc = esc_html('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Adipiscing diam donec adipiscing tristique risus nec.');
        if (get_post_meta($post->ID, 'lead_section_desc', true) != '') {
            $lead_section_desc = get_post_meta($post->ID, 'lead_section_desc', true);
        }
        
    ?>

     <!-- Front-Page Intro Summary -->
     <section id="<?php echo esc_attr('leadership'); ?>" class="<?php echo esc_attr('about-message py-7 my-0 bg-light '); ?>">

        <div class="<?php echo esc_attr('content-inner container-app'); ?>" >
                  
            <!-- section header -->             
            <div class="<?php echo esc_attr('section-header mb-6'); ?>" >
                <h2 class="<?php echo esc_attr('mb-0'); ?>" ><?php echo esc_html($lead_section_title); ?></h2>
                <!--<p ><?php echo esc_html($lead_section_desc); ?></p>-->
            </div>
                    
            <?php

                $person  = array(
                        'post_type' => 'people',
                        'posts_per_page' => 6,
                                //    'numberposts' => 1,
                    );

                $persons = new WP_Query($person);

                if ($persons->have_posts()){
                        
                    while ($persons->have_posts()){  
                        
                    ?>     

                <!-- section content -->             
                <div class="<?php echo esc_attr('section-content mt-4_5 mb-4_5'); ?>" >             
                                        
                    <div class="<?php echo esc_attr(' section-content-inner row align-items-stretch align-content-center justify-content-start'); ?>">

                    <?php
                                
                        $persons->the_post(); 

                            if (function_exists('lc_person_card')) {

                                lc_person_card() ;

                            }
                                                                                        
                    } 
                                    
                        wp_reset_postdata();

                     ?>

                    </div>

                </div>

                <!-- section buttom -->
                <div class="<?php echo esc_attr('text-center') ?>" >

                    <a href="<?php echo get_people_permalink(); ?>" class="<?php echo esc_attr('btn btn-alternate')?>"><?php echo esc_html('See More'); ?></a>
                                        
                </div>
                            
                <?php } else { 
                                    
                        echo '<p class="'. esc_attr('no-content extra') .'"  >'. esc_html__('Staff Profile related content not created yet, please check back later.', 'law-corporate') . '</p>';                        
            
                    } 

                 ?>            
                        
        </div>    

    </section>