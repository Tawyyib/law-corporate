<?php
// Ensure this code runs within the WordPress environment
if (!defined('ABSPATH')) {
    exit;
}

// Get the 'about' page ID based on the template name
$args_about = array(
    'meta_key' => '_wp_page_template',
    'meta_value' => 'page-about.php',
    'post_type' => 'page',
    'posts_per_page' => 1
);

$about_page = new WP_Query($args_about);

if ($about_page->have_posts()) {
    $about_page->the_post();
    $about_page_id = get_the_ID();

    // Fetch the 'about' page custom fields
    $message_title = esc_html('Message from The CEO.');
    if (get_post_meta($about_page_id, 'message_title', true) != '') {

        $message_title = get_post_meta($about_page_id, 'message_title', true);

    }
        $message_body = esc_html('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.');
        $message_body .= esc_html(' ');
        $message_body .= esc_html('Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Ut enim ad minim veniam, quis nostrud exercitation.');
        $message_body .= esc_html(' ');
        $message_body .= esc_html('Together, we win more..') ;
    // echo $message_body;
    if ((get_post_meta($about_page_id, 'message_body', true) != "") && (get_post_meta(get_the_ID(), 'designation', true) != '')) {

        $message_body = get_post_meta($about_page_id, 'message_body', true);

    }
    $ceo_name = esc_html('Corporate Lawyer');
    $designation = esc_html('Chief Executive Officer');


    // Reset post data
    wp_reset_postdata();

    // Custom query to fetch 'people' posts with 'top-management' position
    $args_people = array(
        'post_type' => 'people',
        'meta_key' => 'position',
        'meta_value' => 'Top Management',
        'posts_per_page' => -1,
    );

    $top_management_query = new WP_Query($args_people);

    if ($top_management_query->have_posts()) {

        // CEO Message Section
        echo '<section id="' . esc_attr('ceo-message') . '" class="' . esc_attr('about-message py-7 my-0 bg-light') . '">';

        while ($top_management_query->have_posts()) {

            $top_management_query->the_post();
            $ceo_name = 'Corporate Lawyer';

            if (get_the_title() != '') {
                $ceo_name = get_the_title();
            }
            $designation = esc_html('Chief Executive Officer');
            if (get_post_meta(get_the_ID(), 'designation', true) != '') {
                $designation = get_post_meta(get_the_ID(), 'designation', true);
            }

        ?>

            <div class="<?php echo esc_attr('content-inner container-app row flex-row justify-content-between'); ?>">

                <!-- section thumbnail -->
                <figure class="<?php echo esc_attr('about-message__banner col-xxxl-6 col-sxxl-5 col-sxl-5 col-slg-5 col-md-12 bg-dar'); ?>">

                    <?php if (has_post_thumbnail()) {

                            the_post_thumbnail('', ['class' => 'about-message__banner-image', 'alt' => esc_attr($designation), 'title' => esc_attr($designation)]);

                       }else{ ?>

                        <img src="<?php echo esc_url(get_template_directory_uri() . '/public/images/picture-placeholder.webp'); ?>" alt="<?php echo esc_attr(''); ?>" class="<?php echo esc_attr('about-message__banner-image'); ?>">

                    <?php }

                     ?>

                </figure>

                <!-- section body -->
                <div class="<?php echo esc_attr('about-message__body col-xxxl-6 col-sxxl-7 col-sxl-7 col-slg-7 col-md-12'); ?>">

                    <?php if (!empty($message_title)) { ?>

                        <h2 class="<?php echo esc_attr('about-message__body-title mb-3'); ?>"><?php echo esc_html($message_title); ?></h2>

                    <?php } ?>

                    <div class="<?php echo esc_attr('about-message__body-content mb-3'); ?>">

                        <?php if (!empty($message_body)) { ?>

                            <?php echo wpautop(wp_kses_post($message_body)); ?>

                        <?php } ?>

                        <div class="<?php echo esc_attr('person-meta d-flex flex-column'); ?>">
                            
                            <span class="<?php echo esc_attr('person-meta__name mb-1'); ?>"><?php echo esc_html($ceo_name); ?></span>
                            <?php if (!empty($designation)) {
                                echo '<span class="person-meta__role">' . esc_html($designation) . '</span>';
                            } ?>

                        </div>

                    </div>

                </div>

            </div>


            <?php
        }
        echo '</section>';

    } else {

        // Display default CEO message section if no 'Top Management' posts found

        ?>
        <section id="<?php echo esc_attr('ceo-message'); ?>" class="<?php echo esc_attr('about-message py-7 my-0 bg-light'); ?>">

            <div class="<?php echo esc_attr('content-inner container-app row flex-row justify-content-between'); ?>">

                <!-- section thumbnail -->
                <figure class="<?php echo esc_attr('about-message__banner col-xxxl-6 col-sxxl-5 col-sxl-5 col-slg-5 col-md-12 bg-dar'); ?>">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/public/images/picture-placeholder.webp'); ?>" alt="<?php echo esc_attr(''); ?>" class="<?php echo esc_attr('about-message__banner-image'); ?>">
                </figure>

                <!-- section body -->
                <div class="<?php echo esc_attr('about-message__body col-xxxl-6 col-sxxl-7 col-sxl-7 col-slg-7 col-md-12'); ?>">

                    <h2 class="<?php echo esc_attr('about-message__body-title mb-3'); ?>"><?php echo esc_html($message_title); ?></h2>

                    <div class="<?php echo esc_attr('about-message__body-content mb-3'); ?>">

                        <p><?php echo esc_html($message_body); ?></p>

                        <div class="<?php echo esc_attr('person-meta d-flex flex-column'); ?>">
                            <span class="<?php echo esc_attr('person-meta__name mb-1'); ?>"><?php echo esc_html($ceo_name); ?></span>
                            <span class="<?php echo esc_attr('person-meta__role'); ?>"><?php echo esc_html($designation); ?></span>
                        </div>

                    </div>

                </div>

            </div>

        </section>

        <?php
    }

    // Reset post data
    wp_reset_postdata();

}

?>