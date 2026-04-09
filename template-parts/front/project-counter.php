<?php
if (!defined('ABSPATH')) exit;

$page_id = get_option('page_on_front');

if (!$page_id) return;

// -----------------------------------------------------------
// DEFAULT VALUES
// -----------------------------------------------------------
$defaults = [
    'counter_underlay' => get_template_directory_uri() . '/public/images/items-judges.webp',
    'counter_title'    => 'Experience By Numbers',
    'counter_sub'    => 'We are good with the Numbers',
];

for ($i = 1; $i <= 4; $i++) {
    $defaults["element_{$i}_over"]  = '';
    $defaults["element_{$i}_count"] = '';
    $defaults["element_{$i}_under"] = '';
}

// Start with defaults
$fields = $defaults;

// -----------------------------------------------------------
// LOAD META VALUES (including attachment ID conversion)
// -----------------------------------------------------------
foreach ($fields as $key => &$value) {

    $meta = get_post_meta($page_id, $key, true);

    if ($meta === '' || $meta === null) {
        continue; // keep default
    }

    // Handle attachment ID (background image)
    if ($key === 'counter_underlay' && is_numeric($meta)) {

        $url = wp_get_attachment_url($meta);

        if ($url) { $value = $url; }

        continue;

    }

    // Normal meta string (URL or text)
    $value = $meta;

}
unset($value);

// -----------------------------------------------------------
// CHECK IF WE HAVE ANY COUNTERS AT ALL
// -----------------------------------------------------------
$has_counts = false;
foreach ([1,2,3,4] as $i) {

    if (!empty($fields["element_{$i}_count"])) {

        $has_counts = true;
        break;

    }
    
}

if (!$has_counts) return;

?>

<!-- Metrics / Project Counter -->
<section class="count-board position-relative py-0 bg-image-center"
         style="background-image: url('<?php echo esc_url($fields['counter_underlay']); ?>')">

    <div class="count-board__overlay py-7">
        <div class="count-board__overlay-inner container-app">

            <!-- Header -->
            <div class="section-header mb-6">
                <h2 class="mb-0"><?php echo esc_html( $fields['counter_title'] ); ?></h2>
                <!--<p><?php echo esc_html($fields['counter_sub'] ); ?></p>-->
            </div>

            <!-- Content -->
            <div class="section-content mt-6 mb-6">
                <div class="metrics section-content-inner align-items-center justify-content-center">

                    <?php foreach ([1,2,3,4] as $i) :
                        if (empty($fields["element_{$i}_count"])) continue;
                    ?>

                        <div class="counter-card">
                            <div class="counter-card-inner">
                                <span class="counter-card-over">
                                    <?php echo esc_html($fields["element_{$i}_over"]); ?>
                                </span>

                                <span class="counter-card-major counter"
                                      data-count="<?php echo esc_attr($fields["element_{$i}_count"]); ?>">
                                    0
                                </span>

                                <span class="counter-card-under">
                                    <?php echo esc_html($fields["element_{$i}_under"]); ?>
                                </span>
                            </div>
                        </div>

                        <div class="divider">
                            <div class="divider-vertical"></div>
                            <div class="divider-horizontal"></div>
                        </div>

                    <?php endforeach; ?>

                </div>
            </div>

            <!-- Button -->
            <div class="text-center">
                                    
                <a class="btn btn-primary" 
                    href="<?php if (function_exists('get_projects_permalink')) { echo get_projects_permalink(); } else {echo esc_html('#');} ?>" >
                    Know More
                </a>

            </div>

        </div>
    </div>
</section>
