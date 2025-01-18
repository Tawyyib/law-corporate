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

