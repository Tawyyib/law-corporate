<?php

    // Ensure this code runs within the WordPress environment
    if (!defined('ABSPATH')) { exit; }

        // Properly get post ID with fallbacks
        global $post;

        // Ensure $post_id is set before this block (e.g., $post_id = get_the_ID();)
        $post_id = $post_id ?? $post->ID ?? get_the_ID() ?? 0;
        
        // Default values
        $defaults = [
            'background_image' => get_template_directory_uri() . '/public/images/items-judges.webp',
            'title' => 'Our Core Values',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            'card_content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor et dolore magna aliqua.'
        ];

        // Handle background image (ID or URL)
        $bg_meta = get_post_meta($post_id, 'background_image', true);
        
        $background_image = is_numeric($bg_meta) 
            ? wp_get_attachment_image_url($bg_meta, 'large') 
            : $bg_meta;
        $background_image = esc_url($background_image ?: $defaults['background_image']);
        
        // Section data
        $section_data = [
            'title' => esc_html(get_post_meta($post_id, 'value_section_title', true) ?: $defaults['title']),
            'description' => esc_html(get_post_meta($post_id, 'value_section_desc', true) ?: $defaults['description'])
        ];


        // Cards data
        $cards_data = [];
        for ($i = 1; $i <= 3; $i++) {
            $cards_data[] = [
                'title' => esc_html(get_post_meta($post_id, "card_{$i}_title", true) ?: "Value {$i}"),
                'content' => esc_html(get_post_meta($post_id, "card_{$i}_content", true) ?: $defaults['card_content']),
                'index' => $i
            ];
        }  

    ?>

     <!-- Front-Page Intro Summary -->
    <section id="value-props" class="value-props position-relative py-0 bg-dark bg-image-center" 
                style="background-image: url('<?php echo $background_image; ?>')"
        >
            
        <div class="value-props__overlay py-7">

            <div class="value-props__overlay-inner container-app">
          
                <!-- section header -->             
                <div class="section-header mb-5" >
                        <h2 class="mb-0"><?php echo $section_data['title']; ?></h2>
                        <p><?php echo $section_data['description']; ?></p>
                </div>
                
                <!-- section content -->             
                <div class="section-content" >

                    <div class="section-content-inner value-props__cards-reel">

                        <?php foreach ($cards_data as $card) : ?>
                                
                            <!-- value-card-<?php echo $card['index']; ?>-->
                                <div class="value-card value-card-<?php echo $card['index']; ?>">
                                    
                                    <div class="value-card__header mb-2">
                                        <h3 class="value-card__header-title mb-0"><?php echo $card['title']; ?></h3>
                                        <hr>
                                    </div>

                                    <div class="value-card__content">
                                        <p class="value-card__content-body"><?php echo $card['content']; ?></p>
                                    </div>

                                </div>

                        <?php endforeach; ?>
                        
                    </div>
            
                </div>

            </div>

        </div>

    </section>

    