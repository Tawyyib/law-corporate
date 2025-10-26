    <?php

    // Ensure this code runs within the WordPress environment
    if (!defined('ABSPATH')) { exit; }        
        
        $service_section_title = esc_html('Our Expertise');
        if (get_post_meta($post->ID, 'service_section_title', true) != '') {
            $service_section_title = get_post_meta($post->ID, 'service_section_title', true);
        }
        
        $service_section_desc = esc_html('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Adipiscing diam donec adipiscing tristique risus nec.');
        if (get_post_meta($post->ID, 'service_section_desc', true) != '') {
            $service_section_desc = get_post_meta($post->ID, 'service_section_desc', true);
        }

        // Define the slugs you want to check for.
        $slug_1 = 'services';
        $slug_2 = 'expertise';

        // Get the page object using the first slug.
        $page_object = get_page_by_path($slug_1);

        // If the first page doesn't exist, try the second one.
        if (empty($page_object)) {
            $page_object = get_page_by_path($slug_2);
        }

    ?>
    
    <!-- service-taxonomy-List -->
     
    <section class="<?php echo esc_attr('front-tax py-7 bg-light') ?>" >
        
        <div class="<?php echo esc_attr('content-inner container-app py-0'); ?>">
                  
            <!-- section header --> 

            <div class="<?php echo esc_attr('section-header mb-5'); ?>" >
                <h2 class="<?php echo esc_attr('mb-0'); ?>" ><?php echo esc_html($service_section_title); ?></h2>
                <!--<p ><?php // echo esc_html($service_section_desc); ?></p>-->
                <!--<hr>-->
            </div>
                
            <!-- section content -->     

            <div class="<?php echo esc_attr('section-content'); ?>" >

                <div class="front-tax__inner">

                    <!-- tax-section-thumbnail -->                        

                    <figure class="<?php echo esc_attr('front-tax__banner'); ?>">

                    <?php 

                         // Check if a page was found and if it has a featured image.
                        if ($page_object && has_post_thumbnail($page_object->ID)) {
                            
                            // If a page with a featured image is found, get its ID.
                            $featured_image_id = get_post_thumbnail_id($page_object->ID);

                            $featured_image_html = get_the_post_thumbnail($page_object->ID, 'full', array( 'class' => 'front-about__banner-image' ) );

                            echo $featured_image_html;

                        } else {  ?>

                            <img src="<?php echo esc_url(get_template_directory_uri() . '/public/images/image-placeholder.webp'); ?>" alt="<?php echo esc_attr(''); ?>" class="<?php echo esc_attr(' front-tax__banner-image '); ?>">
                                
                    <?php } ?>

                    </figure>

                    <!-- tax-cards-listing -->

                    <div class="front-tax__listings accordion" id="taxAccordion">
                        
                        <?php  lc_tax_cards ('technical-areas', 'general' ); ?>

                    </div>                    

                </div>

            </div>
                        
        </div>

    </section>

    
