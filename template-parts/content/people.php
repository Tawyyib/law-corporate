<?php

    // Ensure this code runs within the WordPress environment
    if (!defined('ABSPATH')) { exit; }
     
    // Defaults
    $default_title = __( 'CEO', 'law-corporate' );
    $default_desc  = __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Adipiscing diam donec adipiscing tristique risus nec.', 'law-corporate' );

    // Fetch meta
    $post_id            = get_queried_object_id();
    $lead_section_title = get_post_meta( $post_id, 'profile_section_title', true );
    $lead_section_desc  = get_post_meta( $post_id, 'profile_section_sub', true );
    
    // Fallback if empty
    $lead_section_title = $lead_section_title ? : $default_title;
    $lead_section_desc  = $lead_section_desc ? : $default_desc;
        
    ?>

     <!-- Front-Page Intro Summary -->
     <section id="leadership" class="about-message py-7 my-0 bg-light">

        <div class="content-inner container-app" >
                  
            <!-- section header -->             
            <div class="section-header mb-6" >
                <h2 class="mb-0" ><?php echo esc_html($lead_section_title); ?></h2>
                <p ><?php echo esc_html($lead_section_desc); ?></p>
            </div>
                    
            <?php

                $persons = new WP_Query([
                    'post_type'      => 'people',
                    'posts_per_page' => 6,
                    'orderby'        => 'date',  // specify the ordering field
                    'order'          => 'ASC',
                    'no_found_rows'  => true,    // improves performance when pagination isn't needed
                ]);

                if ($persons->have_posts()){
                
            ?>     

                <!-- section content -->  
                            
                <div class="section-content mt-4_5 mb-4_5" >             
                                        
                    <div class="section-content-inner swiper management-reel">

                        <?php
       
                            echo '<div class="swiper-wrapper management-reel__wrapper">';
                            
                                while ($persons->have_posts()){                                                          
                                
                                    $persons->the_post();

                                    if (function_exists('lc_person_card')) {

                                        $classes = ['swiper-slide person-card'];
                                    
                                        lc_person_card( $classes ) ;

                                    }

                                                                                                    
                                } 
                                            
                                wp_reset_postdata();
                                
                            echo '</div>';

                        ?>
                                                
                        <div class="ts-navigation-buttons">
                            <div class="swiper-button-next lc-people"></div>
                            '<div class="swiper-button-prev lc-people"></div>
                        </div>
                                                    
                    </div>

                </div>

                <!-- section buttom -->
                <div class="<?php echo esc_attr('text-center') ?>" >

                    <a href="<?php echo get_people_permalink(); ?>" class="<?php echo esc_attr('btn btn-alternate')?>"><?php echo esc_html('See More'); ?></a>
                                        
                </div>
                            
            <?php } else { 
                                    
                        echo '<p class="'. esc_attr('no-content extra') .'"  >'. esc_html__('Personnel related contents have not been created yet, please check back later.', 'law-corporate') . '</p>';                        
            
                    } 

            ?>            
                        
        </div>    

    </section>