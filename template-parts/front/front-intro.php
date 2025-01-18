<?php

// Ensure this code runs within the WordPress environment
if (!defined('ABSPATH')) {
    exit;
}            
        $intro_header = esc_html('Innovative Ideation is our Thing');
        if (get_post_meta($post->ID, 'intro_header', true) != '') {
            $intro_header = get_post_meta($post->ID, 'intro_header', true);
        }
        
        $intro_body = esc_html('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. ');
        $intro_body .= esc_html('Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. ');
        $intro_body .= esc_html('Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.');
        $intro_body .= esc_html('Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');
        $intro_body .= esc_html('Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.');
        if (get_post_meta($post->ID, 'intro_body', true) != '') {
            $intro_body = get_post_meta($post->ID, 'intro_body', true);
        }

?>

     <!-- Front-Page Intro Summary -->
    <section class="<?php echo esc_attr('front-about py-7 my-0 '); ?>">

        <div class="<?php echo esc_attr('content-inner container-app row flex-row justify-content-between'); ?>" >

            <figure class="<?php echo esc_attr('front-about__banner col-xxxl-6 col-sxxl-5 col-sxl-5 col-slg-5 col-md-12'); ?>">

                    <img src="<?php echo esc_url(get_template_directory_uri() . '/public/images/image-placeholder.webp'); ?>" alt="<?php echo esc_attr(''); ?>" class="<?php echo esc_attr(' front-about__banner-image '); ?>">
                        
            </figure>

            <div class="<?php echo esc_attr('front-about__body col-xxxl-6  col-sxxl-7 col-sxl-7 col-slg-7 col-md-12 '); ?>">

                <h2 class="<?php echo esc_attr('front-about__body-title mb-3'); ?>"><?php echo esc_html($intro_header); ?></h2>

                <div class="<?php echo esc_attr('front-about__body-content mb-3'); ?>">

                     <?php if (!empty($intro_body)) { ?>

                        <?php echo wpautop(wp_kses_post($intro_body)); ?>

                    <?php } ?>
                                                                                                                                     
                </div>
                                    
                <div class="<?php echo esc_attr('text-center') ?>" >
                    
                <a href="<?php if (function_exists('get_about_permalink')) { echo get_about_permalink(); } ?>" class="<?php echo esc_attr('btn btn-alternate')?>"><?php echo esc_html('Know More'); ?></a>
                                
                </div>

            </div>

        </div>    

    </section>