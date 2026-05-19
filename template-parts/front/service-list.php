    <?php

        // Ensure this code runs within the WordPress environment
        if (!defined('ABSPATH')) { exit; }        
        
        // fetch taxonomy
        $taxonomy = lc_get_current_taxonomy ();
        $taxonomy_obj   = get_taxonomy($taxonomy);

        // 1. Handle Titles and Descriptions
        $service_section_title = get_post_meta($post->ID, 'service_section_title', true) ?: esc_html__('Our ' . $taxonomy_obj->label, 'law-corporate-custom-ui');
        $service_section_desc = get_post_meta($post->ID, 'service_section_sub', true) ?: esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'law-corporate-custom-ui');

        // Define the slugs you want to check for.
        $slug_1 = 'services';
        $slug_2 = $taxonomy;

        // Get the page object using the first slug.
        $page_object = get_page_by_path($slug_1);

        // If the first page doesn't exist, try the second one.
        if (empty($page_object)) {
            $page_object = get_page_by_path($slug_2);
        }

    ?>
    
    <!-- service-taxonomy-List -->
     
    <section class="front-tax py-7" >
        
        <div class="content-inner container-app py-0">
                  
            <!-- section header --> 

            <div class="section-header mb-5" >

                <h2 class="mb-0" ><?php echo esc_html($service_section_title); ?></h2>
                <p ><?php echo esc_html($service_section_desc); ?></p>

            </div>
                
            <!-- section content -->     

            <div class="section-content" >

                <div class="front-tax__inner">

                    <!-- tax-section-thumbnail -->                        

                    <figure class="front-tax__banner">
                    <?php 

                         // Check if a page was found and if it has a featured image.
                        if ($page_object && has_post_thumbnail($page_object->ID)) {
                            
                            // If a page with a featured image is found, get its ID.
                            $featured_image_id = get_post_thumbnail_id($page_object->ID);

                            $featured_image_html = get_the_post_thumbnail($page_object->ID, 'full', array( 'class' => 'front-about__banner-image' ) );

                            echo $featured_image_html;

                        } else {  ?>

                            <img src="<?php echo esc_url(get_template_directory_uri() . '/public/images/image-placeholder.webp'); ?>" alt="<?php echo esc_attr(''); ?>" class="<?php echo esc_attr(' front-tax__banner-image '); ?>">
                                
                        <?php } 
                        
                    ?>
                    </figure>

                    <!-- tax-cards-listing -->

                    <div class="front-tax__listings accordion" id="taxAccordion">
                        
                        <?php lc_tax_terms_accordion ( $taxonomy, 'general', 1 ); ?>

                    </div>                    

                </div>

            </div>
                        
        </div>

    </section>

    
