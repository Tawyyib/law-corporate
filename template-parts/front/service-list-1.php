    <?php

    // Ensure this code runs within the WordPress environment
    if (!defined('ABSPATH')) { exit; }      

            $service_section_title = esc_html('Competencies and Expertise');
            if (get_post_meta($post->ID, 'service_section_title', true) != '') {
                $service_section_title = get_post_meta($post->ID, 'service_section_title', true);
            }
            $service_section_desc = esc_html('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Adipiscing diam donec adipiscing tristique risus nec.');
            if (get_post_meta($post->ID, 'service_section_desc', true) != '') {
                $service_section_desc = get_post_meta($post->ID, 'service_section_desc', true);
            }

    ?>
    
    <!-- service-taxonomy-List -->
     
    <section class="<?php echo esc_attr('tax-listing py-7 bg-light') ?>" >
        
        <div class="<?php echo esc_attr('content-inner container-app py-0'); ?>">
                  
            <!-- section header --> 

            <div class="<?php echo esc_attr('section-header mb-6'); ?>" >
                <h2 class="<?php echo esc_attr('mb-0'); ?>" ><?php echo esc_html($service_section_title); ?></h2>
                <!--<p ><?php // echo esc_html($service_section_desc); ?></p>-->
                <!--<hr>-->
            </div>
                
            <!-- section content -->     

            <div class="<?php echo esc_attr(' section-content mt-3 '); ?>" >

                <div class="<?php echo esc_attr(' section-content-inner row align-items-stretch align-content-center justify-content-between'); ?>">

                    <!-- service-tax-card-one -->

                    <?php  lc_expert_card('competency', 'general' ); ?>

                </div>

            </div>
                        
        </div>

    </section>