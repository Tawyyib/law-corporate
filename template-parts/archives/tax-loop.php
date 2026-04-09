
        <div id="post-<?php the_ID(); ?>" <?php post_class('content-outlay container-app py-7 '); ?> >

            <div class="epxert-tax container-inner d-flex justify-content-between">

                <!-- taxonomy's description -->
                <div class="<?php echo esc_attr(' tax-description col-slg-7x col-smd-12'); ?>" >            
                            
                    <div class="<?php echo esc_attr('tax-description__inner p-0 bg-ligh'); ?>">

                        <?php if(is_tax('competency')) { ?>

                            <h2 class="tax-description__title mb-3" ><?php echo single_term_title() ?></h2>
                            
                            <?php  // display the taxonomy term description
                            echo term_description();

                        }?>         

                    </div>
           
                </div> 
                    
                <!-- taxonomy's child posts -->
                <div class="tax-terms col-slg-4 col-smd-12">

                    <h4 class="<?php echo esc_attr('tax-terms__header d-flex px-3 mb-2 '); ?>"><span><?php echo esc_html('How We Can Help'); ?></span><i class="<?php echo esc_attr('fas fa-pen-nib'); ?>"></i></h4>
                    <hr>
                            
                        <?php 
                            
                            // get terms associated with the current post.
                            $terms = get_the_terms( get_the_ID(), 'competency' );

                            // checks if terms (services) are not empty
                            if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
                                
                                $term_ids = array_map( function( $term ) {

                                    return $term->term_id;

                                }, $terms );
                                                    
                                // Query for related posts
                                $args = array(
                                    'post_type' => 'services',
                                    'post_status' => 'publish',
                                    //'posts_per_page' => 4,
                                    'tax_query' => array(
                                        array(
                                            'taxonomy' => 'competency',
                                            'field' => 'term_id',
                                            'terms' => $term_ids,
                                        ),
                                    ),
                                    //'post__not_in' => array( $post->ID ),
                                );
                        
                                $tax_services = new WP_Query($args);

                            }

                        ?>
                             
                        <!-- list all posts related to the taxonomy term -->

                        <?php if ( $tax_services->have_posts() ){ ?>

                            <ul class="<?php echo esc_attr('tax-terms__list'); ?>" >
                                            
                                <?php while ( $tax_services->have_posts() ){
                                        
                                $tax_services-> the_post(); ?>
                                                
                                    <li class="<?php echo esc_attr('tax-terms__item bg-light'); ?>" ><?php lc_service_card() ;?></li>                                                                                           
                            
                                <?php } 

                                    wp_reset_postdata(); 
                                            
                                ?>

                            </ul>     

                        <?php } else { 
                                
                            echo '<p class="'. esc_attr('no-content px-3') .'"  >'. esc_html__('Related services content not created yet, please check back later.', 'law-corporate') . '</p>';

                        } ?>    
                            
                </div>

            </div>

            <?php lc_services_rel(); ?>

        </div>