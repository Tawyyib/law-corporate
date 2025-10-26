<?php

    if (!defined('ABSPATH')) exit;

    // Helper: Get post meta or return default
    function get_meta_or_default($post_id, $key, $default = '') {
        $value = get_post_meta($post_id, $key, true);
        return !empty($value) ? $value : $default;
    }

    // Get About Page
    $about_page = get_posts([
        'meta_key'       => '_wp_page_template',
        'meta_value'     => 'page-about.php',
        'post_type'      => 'page',
        'posts_per_page' => 1,
    ]);

    if (!$about_page) return;

    $about_page_id = $about_page[0]->ID;

    // Default CEO Message
    $default_message = implode(' ', [
        'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
        'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
        'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.',
        'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
        'Together, we win more..'
    ]);

    // Retrieve fields
    $message_title = get_meta_or_default($about_page_id, 'message_title', 'Message from The CEO.');
    $message_body  = get_meta_or_default($about_page_id, 'message_body', $default_message);
    $designation   = 'Chief Executive Officer'; // Default fallback
    $ceo_name      = 'Corporate Lawyer'; // Default fallback

    // Query CEO (people post type)
    $ceo_query = new WP_Query([
        'post_type'      => 'people',
        'meta_key'       => 'position',
        'meta_value'     => 'CEO',
        'posts_per_page' => 1,
    ]);

    // Begin section output
    ?>

    <section id="ceo-message" class="about-message py-7 my-0 bg-light">
        
        <div class="about-message__inner container-app">

            <figure class="about-message__banner">

                <?php if ($ceo_query->have_posts()) { 

                    $ceo_query->the_post();
                    $ceo_name = get_the_title() ?: $ceo_name;
                                    
                    $designation = get_post_meta(get_the_ID(), 'designation', true) ? : $designation;

                    if (has_post_thumbnail()) {

                        the_post_thumbnail('', [
                            'class' => 'about-message__banner-image',
                            'alt'   => esc_attr($designation),
                            'title' => esc_attr($designation)
                        ]);
                        
                    } else { ?>

                        <img src="<?php echo esc_url(get_template_directory_uri() . '/public/images/picture-placeholder.webp'); ?>" alt="" class="about-message__banner-image">

                    <?php }

                } else { ?>

                    <img src="<?php echo esc_url(get_template_directory_uri() . '/public/images/picture-placeholder.webp'); ?>" alt="" class="about-message__banner-image">

                <?php } ?>

            </figure>

            <div class="about-message__body">

                <h2 class="about-message__body-title mb-2"><?php echo esc_html($message_title); ?></h2>

                <div class="about-message__body-content">

                    <?php echo wpautop(wp_kses_post($message_body)); ?>

                    <div class="person-meta d-flex flex-column">
                        <span class="person-meta__name mb-1"><?php echo esc_html($ceo_name); ?></span>
                        <span class="person-meta__role"><?php echo esc_html($designation); ?></span>
                    </div>

                </div>

            </div>

        </div>
        
    </section>

    <?php

    wp_reset_postdata();

?>
