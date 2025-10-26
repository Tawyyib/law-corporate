<section 

    <?php

        // 1. Slider / Banner Image Setup
        $banner_image = get_template_directory_uri() . '/public/images/items-judges.webp'; // default fallback

        $custom_banner_id = get_theme_mod('front_banner_image', '');
        if ( ! empty($custom_banner_id) ) {
            $custom_banner_url = wp_get_attachment_url($custom_banner_id);
            if ( $custom_banner_url ) {
                $banner_image = esc_url($custom_banner_url);
            }
        }
        
        // 4. Slide Buttons
        $banner_url =esc_url( '#main');                             
        if(get_theme_mod('front_banner_url','') !='')
        {
            $button_url = get_theme_mod('front_banner_url','');
        }
                            
        $banner_label =esc_html( 'Scroll');                             
        if(get_theme_mod('front_banner_label','') !='')
        {
            $button_label = get_theme_mod('front_banner_label',''); 
        }

    ?>

    class="<?php 

        if (is_front_page()){ 

            echo esc_attr('banner__front bg-image-center'); 

        } elseif (is_singular('post')) {

            echo esc_attr('banner__single_post bg-image-center');

        } elseif (is_singular('projects')) {

            echo esc_attr('banner__single_project bg-image-center');

        } elseif (is_home()) {

            echo esc_attr('banner__taxes bg-image-center'); 

        } elseif (is_archive() || is_singular('people') || is_page('contact')) {

            echo esc_attr('banner__taxes bg-image-center'); 

        } else {

            echo esc_attr('banner__pages bg-image-center'); 
        
        } ?>" 

    style="background-image: url('<?php 

        if (is_front_page()) { 

            echo esc_url($banner_image); 

        } elseif (is_home()) {

            echo esc_url(get_header_image()); 

        } elseif (has_post_thumbnail()) {

            echo esc_url(get_the_post_thumbnail_url(null, 'post-thumbnail')); 
            
        } ?>')"
    
>

    <!-- Overlay -->
    <div class="banner-overlay d-flex flex-column">
        
        <div class="banner-overlay-inner container-app">

            <?php 
                if(is_front_page()) { 

                    get_template_part('template-parts/header/front-banner-texts');

                } else { 

                    get_template_part('template-parts/header/page-header');

                } 
            ?>

        </div>

        <?php if (is_front_page()) { ?>

            <a id=" " class="scroll-down-button" data-target="<?php echo esc_url($banner_url); ?>">

                <span class="text scroll-texts"><?php echo esc_html($banner_label); ?></span>
                <span class="arrow fas fa-chevron-circle-down"></span>

            </a>

        <?php } ?>

    </div>

</section>

