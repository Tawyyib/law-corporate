
        <div id="post-<?php the_ID(); ?>" <?php post_class('content-outlay container-app py-7 '); ?> >

            <div class="<?php echo esc_attr('single-service-tax container-inner d-flex justify-content-between'); ?>">

                <!-- taxonomy's description -->
                <div class="<?php echo esc_attr(' tax-description col-slg-7x col-smd-12'); ?>" >            
                            
                    <div class="<?php echo esc_attr('tax-description__inner p-0 bg-ligh'); ?>">

                        <?php if(is_tax('technical-areas')) { ?>

                            <h2 class="<?php echo esc_attr('tax-description__title mb-3'); ?>" ><?php echo single_term_title() ?></h2>
                            
                            <?php  // display the taxonomy term description
                            echo term_description();

                        }?>         

                    </div>
           
                </div> 
                    
                <!-- taxonomy's child posts -->
                <div class="<?php echo esc_attr('tax-terms col-slg-4 col-smd-12'); ?>">

                    <h4 class="<?php echo esc_attr('tax-terms__header d-flex px-3 mb-2 '); ?>"><span><?php echo esc_html('How We Can Help'); ?></span><i class="<?php echo esc_attr('fas fa-pen-nib'); ?>"></i></h4>
                    <hr>
                                                                                                
                        <!-- list all posts related to the taxonomy term -->

                        <?php if (have_posts()){ ?>

                            <ul class="<?php echo esc_attr('tax-terms__list'); ?>" >
                                    
                                <?php while (have_posts()){
                                
                                    the_post(); ?>
                                        
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

            <?php lc_paginate(); ?>

        </div>