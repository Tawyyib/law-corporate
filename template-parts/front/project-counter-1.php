<?php

// Ensure this code runs within the WordPress environment
if (!defined('ABSPATH')) {
    exit;
}        

         // Retrieve current value
         $counter_underlay = get_template_directory_uri() . '/public/images/items-judges.webp'; // ;
         if(get_post_meta($post->ID, 'background_image', true) !='')
         {
             $counter_underlay = get_post_meta($post->ID, 'background_image', true);           
         }

        $counter_title = esc_html('Experience By Numbers');
        if (get_post_meta($post->ID, 'counter_title', true) != '') {
            $counter_title = get_post_meta($post->ID, 'counter_title', true);
        }

        $counter_sub = esc_html('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Adipiscing diam donec adipiscing tristique risus nec.');
        if (get_post_meta($post->ID, 'counter_sub', true) != '') {
            $counter_sub = get_post_meta($post->ID, 'counter_sub', true);
        }

        $elements = array(
            array(
                'over' => get_post_meta(get_the_ID(), 'element_1_over', true),
                'count' => get_post_meta(get_the_ID(), 'element_1_count', true),
                'under' => get_post_meta(get_the_ID(), 'element_1_under', true),
            ),
            array(
                'over' => get_post_meta(get_the_ID(), 'element_2_over', true),
                'count' => get_post_meta(get_the_ID(), 'element_2_count', true),
                'under' => get_post_meta(get_the_ID(), 'element_2_under', true),
            ),
            array(
                'over' => get_post_meta(get_the_ID(), 'element_3_over', true),
                'count' => get_post_meta(get_the_ID(), 'element_3_count', true),
                'under' => get_post_meta(get_the_ID(), 'element_3_under', true),
            ),
            array(
                'over' => get_post_meta(get_the_ID(), 'element_4_over', true),
                'count' => get_post_meta(get_the_ID(), 'element_4_count', true),
                'under' => get_post_meta(get_the_ID(), 'element_4_under', true),
            ),
        );

?>

<!-- Metrics / Project Counter -->
    <section class="<?php echo esc_attr(' count-board position-relative py-0 bg-dar bg-image-center ') ?>" style="background-image: url('<?php echo esc_url($counter_underlay); ?>')">
        
        <!--- underlay-image -->
        
        <div class="<?php echo esc_attr(' count-board__overlay py-7 '); ?>">

            <div class="<?php echo esc_attr('count-board__overlay-inner container-app'); ?>">
          
                <!-- section header -->             
                <div class="<?php echo esc_attr('section-header mb-7'); ?>" >
                    <h2 class="<?php echo esc_attr('mb-0'); ?>" ><?php echo $counter_title ?></h2>
                    <!--<p ><?php // echo $counter_sub ?></p>-->
                    <!--<hr>-->
                </div>
                
                <!-- section content -->     

                <div class="<?php echo esc_attr(' section-content mt-3 mb-6 '); ?>" >

                    <div class="<?php echo esc_attr('metrics section-content-inner row align-items-center align-content-center justify-content-center'); ?>">
                            
                    <?php

                            // Generate elements 1 to 4
                        foreach ($elements as $element) { 

                            if (! empty($element['count'])) {               
                            
                        ?>
                            <!-- Card One -->     
                            <div class="<?php echo esc_attr(' counter-card bg-ligh'); ?>" >                        
                                <div class="<?php echo esc_attr(' counter-card-inner'); ?>" >                        
                                    <span class="<?php echo esc_attr('counter-card-over'); ?>" ><?php echo $element['over'] ?></span>                        
                                    <span class="<?php echo esc_attr('counter-card-major counter'); ?>"  data-count="<?php echo $element['count'] ?>" ><?php echo esc_html('0'); ?></span>                        
                                    <span class="<?php echo esc_attr('counter-card-under'); ?>" ><?php echo $element['under'] ?></span>
                                </div>
                            </div>

                            <div  class="<?php echo esc_attr('divider'); ?>" >
                                <div  class="<?php echo esc_attr(' divider-vertical '); ?>" ></div>
                                <div  class="<?php echo esc_attr(' divider-horizontal '); ?>" ></div>
                            </div>

                        <?php   }
                    
                    } ?>

                    </div>

                </div>

                <!-- section buttom -->
                <div class="<?php echo esc_attr('text-center') ?>" >

                    <a href="<?php if (function_exists('get_projects_permalink')) { echo get_projects_permalink(); } ?>" class="<?php echo esc_attr('btn btn-primary')?>"><?php echo esc_html('Know More'); ?></a>
                                    
                </div>

            </div>

        </div>

    </section>

<?php

// Ensure this code runs within the WordPress environment
if (!defined('ABSPATH')) {
    exit;
}        
    
    $page_id = get_option('page_on_front');
 
    if (!$page_id) {
        return; // No page ID found
    }

    $counter_fields = array(
        'background_image' => get_template_directory_uri() . '/public/images/items-judges.webp', // Default background image
        'counter_title' => 'Experience By Numbers', // Default title
        'counter_desc' => 'Lorem ipsum dolor sit amet...', // Default description
        'element_1_over' => '', 'element_1_count' => '', 'element_1_under' => '',
        'element_2_over' => '', 'element_2_count' => '', 'element_2_under' => '',
        'element_3_over' => '', 'element_3_count' => '', 'element_3_under' => '',
        'element_4_over' => '', 'element_4_count' => '', 'element_4_under' => '',
    );

    //Retrieve the meta data from the front page id.
    foreach ($counter_fields as $key => &$value) {

        $meta_value = get_post_meta($page_id, $key, true);
        if ($meta_value !== '') { // Only override if a value is actually saved
            $value = $meta_value;
        }

    }

    //Check if at least one count is set before outputting anything.
    if(empty($counter_fields["element_1_count"]) && empty($counter_fields["element_2_count"]) && empty($counter_fields["element_3_count"]) && empty($counter_fields["element_4_count"])){
        return;
    }

?>

<!-- Metrics / Project Counter -->
    <section class="<?php echo esc_attr(' count-board position-relative py-0 bg-image-center ') ?>" style="background-image: url('<?php echo esc_url($counter_fields['background_image']); ?>')">
        
        <!--- underlay-image -->        
        <div class="<?php echo esc_attr(' count-board__overlay py-7 '); ?>">

            <div class="<?php echo esc_attr('count-board__overlay-inner container-app'); ?>">
          
                <!-- section header -->             
                <div class="<?php echo esc_attr('section-header mb-7'); ?>" >
                    <h2 class="<?php echo esc_attr('mb-0'); ?>" ><?php echo esc_html($counter_fields['counter_title']); ?></h2>
                </div>
                
                <!-- section content -->     
                <div class="<?php echo esc_attr(' section-content mt-3 mb-6 '); ?>" >

                    <div class="<?php echo esc_attr('metrics section-content-inner row align-items-center align-content-center justify-content-center'); ?>">
                            
                    <?php

                        // Generate elements 1 to 4
                        for ($i = 1; $i <= 4; $i++) { 

                            if (! empty($counter_fields["element_{$i}_count"])) {               
                            
                        ?>
                            <!-- Card One -->     
                            <div class="counter-card" >                        
                                <div class="counter-card-inner" >                        
                                    <span class="counter-card-over" ><?php echo esc_html($counter_fields["element_{$i}_over"]); ?></span>                        
                                    <span class="counter-card-major counter"  data-count="<?php echo esc_attr($counter_fields["element_{$i}_count"]); ?>" ><?php echo esc_html('0'); ?></span>                        
                                    <span class="counter-card-under" ><?php echo esc_html($counter_fields["element_{$i}_under"]); ?></span>
                                </div>
                            </div>

                            <div  class="divider" >
                                <div  class="divider-vertical" ></div>
                                <div  class="divider-horizontal" ></div>
                            </div>

                        <?php   }
                    
                    } ?>

                    </div>

                </div>

                <!-- section buttom -->
                <div class="<?php echo esc_attr('text-center') ?>" >

                    <a href="<?php if (function_exists('get_projects_permalink')) { echo get_projects_permalink(); } ?>" class="<?php echo esc_attr('btn btn-primary')?>"><?php echo esc_html('Know More'); ?></a>
                                    
                </div>

            </div>

        </div>

    </section>