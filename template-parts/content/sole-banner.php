<?php

    // Ensure this code runs within the WordPress environment
    if (!defined('ABSPATH')) { exit; }
        
    // 1. Properly get the Post ID
    global $post;

    // Ensure $post_id is set before this block (e.g., $post_id = get_the_ID();)
    $post_id = $post_id 
                ?? ( isset( $post ) && isset( $post->ID ) ? $post->ID : 0 )
                ?? get_queried_object_id()
                ?? get_the_ID()
                ?? 0;

    // 2. Set the fallback (Default Image)
    $default_bg_url = get_template_directory_uri() . '/public/images/items-judges.webp';

    // 3. Retrieve and resolve custom meta
    $bg_meta = get_post_meta($post_id, 'sole_banner', true);

    // If numeric, treat as attachment ID; otherwise, treat as URL
    $background_image = is_numeric($bg_meta) ? wp_get_attachment_image_url($bg_meta, 'large') : $bg_meta;

    // 4. Final Sanitization with fallback
    $background_image = esc_url($background_image ?: $default_bg_url);

?>

     <!-- Front-Page Intro Summary -->
    <section id="value-props" class="value-props position-relative py-0 bg-dark bg-image-center" 
        style="background-image: url('<?php echo $background_image; ?>')"
        >

        <div class="<?php echo esc_attr(' value-props__overlay py- '); ?>">

        </div>

    </section>