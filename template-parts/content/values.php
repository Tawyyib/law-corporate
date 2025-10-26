<?php

    // Ensure this code runs within the WordPress environment
    if (!defined('ABSPATH')) { exit; }

        // Ensure $post_id is set before this block (e.g., $post_id = get_the_ID();)
        $post_id = isset($post_id) ? $post_id : get_the_ID();

        // Retrieve meta, falling back to the default if empty.
        $background_image = get_post_meta($post_id, 'background_image', true) ? : get_template_directory_uri() . '/public/images/items-judges.webp';
        $value_section_title = get_post_meta($post_id, 'value_section_title', true) ? : 'Our Core Values';
        $value_section_desc = get_post_meta($post_id, 'value_section_desc', true) ? : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Adipiscing diam donec adipiscing tristique risus nec.';

        // Apply final escaping (mandatory before output)
        $background_image = esc_url($background_image);
        $value_section_title = esc_html($value_section_title);
        $value_section_desc  = esc_html($value_section_desc); 

        // Cards
        // Define the number of cards you expect to retrieve
        $card_count = 3; 

        // Base default content for the cards
        $default_content = esc_html('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor et dolore magna aliqua. Platea dictumst quisque sagittis purus sit amet volutpat.');

        // We'll store the final, processed card data in this array
        $cards_data = [];

        // Loop through the cards to retrieve data dynamically
        for ($i = 1; $i <= $card_count; $i++) {
            
            $title_key   = "card_{$i}_title";
            $content_key = "card_{$i}_content";

            // --- 1. Title Retrieval (using null coalescing for brevity) ---
            $default_title = esc_html("Value " . $i); 
            $card_title = get_post_meta($post_id, $title_key, true) ? : $default_title;
            
            // --- 2. Content Retrieval ---
            $card_content = get_post_meta($post_id, $content_key, true) ? : $default_content;
            
            // --- 3. Store and Escape Data ---
            $cards_data[] = [
                'title'   => esc_html($card_title),
                // Use wp_kses_post if you allow limited HTML in the content field
                'content' => esc_html($card_content), 
            ];
            
        }        

    ?>

     <!-- Front-Page Intro Summary -->
     <section id="value-props" class="value-props position-relative py-0 bg-dark bg-image-center" style="background-image: url('<?php echo $background_image; ?>')" >
        
        <!--- underlay-image -->

        <div class="value-props__overlay py-7">

            <div class="value-props__overlay-inner container-app">
          
                <!-- section header -->             
                <div class="section-header mb-5" >
                    <h2 class="mb-0" ><?php echo $value_section_title; ?></h2>
                    <p ><?php echo $value_section_desc; ?></p>
                </div>
                
                <!-- section content -->             
                <div class="section-content" >

                    <div class="section-content-inner value-props__cards-reel">

                        <?php 
                            $counter = 1;
                            foreach ($cards_data as $card) : 
                        ?>
                                
                            <!-- value-card-<?php echo $counter; ?>-->
                            <div class="value-card value-card-<?php echo $counter; ?>">
                                <div class="value-card__header mb-2">
                                    <h3 class="value-card__header-title mb-0"><?php echo $card['title']; ?></h3>
                                    <hr>
                                </div>
                                <div class="value-card__content">
                                    <p class="value-card__content-body"><?php echo $card['content']; ?></p>
                                </div>                      
                            </div>

                        <?php 
                            $counter++;
                            endforeach; 
                        ?>
                        
                    </div>

            </div>

        </div>

    </section>