<?php

    // Ensure this code runs within the WordPress environment
    if (!defined('ABSPATH')) { exit; }            

    // 1. Placeholder default
    $default_body = implode(' ', [
        'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
        'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
        'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.',
        'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
        'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.'
    ]);

    // 2. Get the custom section title (will be empty string if not set)
    $custom_intro_header = get_post_meta($post->ID, 'intro_header', true);

    // 3. Use the custom value if it exists, otherwise use the default
    $intro_header = $custom_intro_header ? : 'Innovative Ideation is our Thing';
    $intro_body = get_post_meta($post->ID, 'intro_body', true) ? : $default_body;          

    // Try multiple possible slugs for the About page
    foreach (['about', 'about-us'] as $slug) {
        if ($page = get_page_by_path($slug)) {
            $page_object = $page;
            break;
        }
    }

    $page_id = $page_object->ID ?? 0;

?>

     <!-- Front-Page Intro Summary -->
    <section class="front-about py-7 my-0" style="background-image: url('/public/images/industrial-concept.webp');" >

        <div class="<?php echo esc_attr('front-about__inner'); ?>" >
                
            <!-- section thumbnail -->

            <figure class="<?php echo esc_attr('front-about__banner'); ?>">

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

            <!-- section body -->

            <div class="<?php echo esc_attr('front-about__body'); ?>">

                <h3 class="<?php echo esc_attr('front-about__body-title mb-3'); ?>"><?php echo esc_html($intro_header); ?></h3>

                <div class="<?php echo esc_attr('front-about__body-content container-ap mb-4'); ?>">

                    <?php echo wpautop(wp_kses_post($intro_body)); ?>
                                                                                                                                     
                </div>
                                    
                <div class="<?php echo esc_attr('text-cente') ?>" >
                    
                    <a href="<?php if (function_exists('get_about_permalink')) { echo get_about_permalink(); } ?>" class="<?php echo esc_attr('btn btn-alternate')?>"><?php echo esc_html('Know More'); ?></a>
                                
                </div>

            </div>

        </div>    

    </section>