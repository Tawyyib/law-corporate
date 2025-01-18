<?php

    // Ensure this code runs within the WordPress environment
    if (!defined('ABSPATH')) {
        exit;
    }
     
         // Retrieve current value
        $background_image = get_template_directory_uri() . '/public/images/items-judges.webp'; // ;
        if(get_post_meta($post->ID, 'background_image', true) !='')
        {
            $background_image = get_post_meta($post->ID, 'background_image', true);           
        }
        $value_section_title = esc_html('Our Core Values');
        if (get_post_meta($post->ID, 'value_section_title', true) != '') {
            $value_section_title = get_post_meta($post->ID, 'value_section_title', true);
        }
        $value_section_desc = esc_html('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Adipiscing diam donec adipiscing tristique risus nec.');
        if (get_post_meta($post->ID, 'value_section_desc', true) != '') {
            $value_section_desc = get_post_meta($post->ID, 'value_section_desc', true);
        }

        // Cards
        $card_1_title = esc_html('Value One');
        if (get_post_meta($post->ID, 'card_1_title', true) != '') {
            $card_1_title = get_post_meta($post->ID, 'card_1_title', true);
        }
        $card_1_content = esc_html('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor et dolore magna aliqua. Platea dictumst quisque sagittis purus sit amet volutpat.');
        if (get_post_meta($post->ID, 'card_1_content', true) != '') {
            $card_1_content = get_post_meta($post->ID, 'card_1_content', true);
        }        
                
        // Card Two
        $card_2_title = esc_html('Value Two');
        if (get_post_meta($post->ID, 'card_2_title', true) != '') {
            $card_2_title = get_post_meta($post->ID, 'card_2_title', true);
        }
        $card_2_content = esc_html('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor et dolore magna aliqua. Platea dictumst quisque sagittis purus sit amet volutpat.');
        if (get_post_meta($post->ID, 'card_2_content', true) != '') {
            $card_2_content = get_post_meta($post->ID, 'card_2_content', true);
        }        
        
        // Card Three
        $card_3_title = esc_html('Value Three');
        if (get_post_meta($post->ID, 'card_3_title', true) != '') {
            $card_3_title = get_post_meta($post->ID, 'card_3_title', true);
        }
        $card_3_content = esc_html('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor et dolore magna aliqua. Platea dictumst quisque sagittis purus sit amet volutpat.');
        if (get_post_meta($post->ID, 'card_3_content', true) != '') {
            $card_3_content = get_post_meta($post->ID, 'card_3_content', true);
        }
        
    ?>

     <!-- Front-Page Intro Summary -->
     <section id="<?php echo esc_attr('value-props'); ?>" class="<?php echo esc_attr('value-props position-relative py-0 bg-dark bg-image-center '); ?>" style="background-image: url('<?php echo esc_url($background_image); ?>')" >
        
        <!--- underlay-image -->

        <div class="<?php echo esc_attr(' value-props__overlay py-7 '); ?>">

            <div class="<?php echo esc_attr('value-props__overlay-inner container-app'); ?>">
          
                <!-- section header -->             
                <div class="<?php echo esc_attr('section-header mb-6'); ?>" >
                    <h2 class="<?php echo esc_attr('mb-0'); ?>" ><?php echo esc_html($value_section_title); ?></h2>
                    <!--<p ><?php echo esc_html($value_section_desc); ?></p>-->
                </div>
                
                <!-- section content -->             
                <div class="<?php echo esc_attr('section-content mt-4_5 mb-4_5 '); ?>" >

                    <div class="<?php echo esc_attr(' section-content-inner row align-items-stretch align-content-center justify-content-between'); ?>">

                    <!-- value-card-one -->
                    <div class="<?php echo esc_attr('value-card col-mlg-4 my-0'); ?>">
                        <div class="<?php echo esc_attr('value-card__header mb-2'); ?>">
                            <h3 class="<?php echo esc_attr('value-card__header-title mb-0'); ?>"><?php echo esc_html($card_1_title); ?></h3>
                            <hr>
                        </div>
                        <div class="<?php echo esc_attr('value-card__content'); ?>">
                            <p class="<?php echo esc_attr('value-card__content-body'); ?>"><?php echo esc_html($card_1_content); ?></p>
                        </div>                      
                    </div>

                    <!-- value-card-two -->
                    <div class="<?php echo esc_attr('value-card col-mlg-4 my-0 '); ?>">
                        <div class="<?php echo esc_attr('value-card__header mb-2'); ?>">
                            <h3 class="<?php echo esc_attr('value-card__header-title mb-0'); ?>"><?php echo esc_html($card_2_title); ?></h3>
                            <hr>
                        </div>
                        <div class="<?php echo esc_attr('value-card__content'); ?>">
                            <p class="<?php echo esc_attr('value-card__content-body '); ?>"><?php echo esc_html($card_2_content); ?></p>
                        </div>                      
                    </div>

                    <!-- value-card-three -->
                    <div class="<?php echo esc_attr('value-card col-mlg-4 my-0 '); ?>">
                        <div class="<?php echo esc_attr('value-card__header mb-2'); ?>">
                            <h3 class="<?php echo esc_attr('value-card__header-title mb-0'); ?>"><?php echo esc_html($card_3_title); ?></h3>
                            <hr>
                        </div>
                        <div class="<?php echo esc_attr('value-card__content'); ?>">
                            <p class="<?php echo esc_attr('value-card__content-body'); ?>"><?php echo esc_html($card_3_content); ?></p>
                        </div>                      
                    </div>

                </div>

            </div>

        </div>

    </section>