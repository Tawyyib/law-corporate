<?php

    // Ensure this code runs within the WordPress environment
    if (!defined('ABSPATH')) { exit; }            
    
    // 1. Get the custom value (will be empty string if not set)
    $custom_intro_header = get_post_meta($post->ID, 'intro_header', true);

    // 2. Use the custom value if it exists, otherwise use the default
    $intro_header = !empty($custom_intro_header) ? $custom_intro_header : 'Innovative Ideation is our Thing';
                
    $intro_body = esc_html('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. ');
    $intro_body .= esc_html('Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. ');
    $intro_body .= esc_html('Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.');
    $intro_body .= esc_html('Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');
    $intro_body .= esc_html('Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.');
    if (get_post_meta($post->ID, 'intro_body', true) != '') {
        $intro_body = get_post_meta($post->ID, 'intro_body', true);
    }

    // Define the slugs you want to check for.
    $slug_1 = 'about';
    $slug_2 = 'about-us';

    // Get the page object using the first slug.
    $page_object = get_page_by_path($slug_1);

    // If the first page doesn't exist, try the second one.
    if (empty($page_object)) {
        $page_object = get_page_by_path($slug_2);
    }
    
    $page_id = $page_object->ID ?? 0;

    // link-button properties
    $button_label = __( 'Know More', 'law-corporate' );
    $post_url = esc_url (lc_get_page_link ( 'about' ));
    $button_classes = esc_attr ( 'btn-alternate' );        
    $icon_classes = esc_attr( 'fas fa-arrow-right' );        

?>

     <!-- Front-Page Intro Summary -->
    <section class="front-about py-7 my-0 bg-light">

        <div class="front-about__inner container-app" >
                
            <!-- section thumbnail -->

            <figure class="front-about__banner">

                <?php 

                    // Check if a page was found and if it has a featured image.
                    if ($page_object && has_post_thumbnail($page_id )) {
                            
                        // If a page with a featured image is found, get its ID.
                        $featured_image_html = get_the_post_thumbnail($page_id, 'full', array( 'class' => 'front-about__banner-image' ) );

                        echo $featured_image_html;

                    } else {  ?>

                        <img src="<?php echo esc_url(get_template_directory_uri() . '/public/images/image-placeholder.webp'); ?>" alt="<?php echo esc_attr(''); ?>" class="<?php echo esc_attr(' front-tax__banner-image '); ?>">
                                
                <?php } ?>

            </figure>

            <!-- section body -->

            <div class="front-about__body">

                <h2 class="front-about__body-title"><?php echo esc_html($intro_header); ?></h2>

                <div class="front-about__body-content">

                     <?php if (!empty($intro_body)) { ?>

                        <?php echo wpautop(wp_kses_post($intro_body)); ?>

                    <?php } ?>
                                                                                                                                     
                </div>
                                    
                <div class="link-meta" >
                    
                    <?php lc_cta_button( $button_label, $post_url, $button_classes, '', '', '', $icon_classes ) ?>

                </div>

            </div>

        </div>    

    </section>