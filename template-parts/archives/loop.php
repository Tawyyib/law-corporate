                
        <?php          
            
            // declare container class variable
            $container_class = 'content-inner mb-2 ';

            if ( is_post_type_archive('people') ) {

                $container_class .= 'personnel-reel justify-content-evenly';
                
            } else if ( is_post_type_archive('projects') ) {

                $container_class .= 'project-reel ';

            } else {

                $container_class .= 'post-reel justify-content-start';

            }

        ?>

        <div id="post-<?php the_ID(); ?>" <?php post_class('content-outlay container-app py-7'); ?> >
            
            <?php if (is_home() || (is_archive() && !is_post_type_archive('people') && !is_post_type_archive('services')) && !is_tax() ) { ?>  

            <?php  if(count($posts) > 0){ ?>

                <!-- SORT BAR  -->
                <div class="<?php echo esc_attr(' sort-bar mb-4 '); ?>" >
                
                    <h5 class="<?php echo esc_attr(' sort-title d-flex flex-row justify-content-start text-uppercase'); ?>" ><?php echo esc_html_e('SORT', 'law-corporate'); ?>&nbsp;
                    <em class="<?php echo esc_attr('sort-title-extra'); ?>" >
                    <?php if (is_home() ) { echo single_post_title(); 
                            } else {echo the_archive_title(); 
                            } ?>                
                    </em></h5>

                </div> 

            <?php } ?>
            
            <?php } ?>
                                                          
            <div class="<?php echo esc_attr($container_class); ?>" >
                            
                <?php if (have_posts()){
                    
                    while (have_posts()){
                
                        the_post(); 
                        
                        if (is_post_type_archive('people')) {

                            $classes = ['person-card'];
                                
                            lc_person_card( $classes ) ;

                        }
                        
                        elseif (is_post_type_archive('projects')) {

                            lc_projects_card() ;

                        } elseif (is_post_type_archive('services') || is_tax()) {

                            lc_service_card() ;

                        } else if (is_home() || is_category( ) || is_post_type_archive('post')){

                            $m_class = 'post-card';
                            $post_card_classes = ['col-sm-12'];

                            lc_post_card( $m_class, $post_card_classes, true, false );
                                                                                    
                        }

                        wp_reset_postdata();
                                
                    } 
                
                } else { 
                        
                    echo '<p class="'. esc_attr('no-content ') .'"  >'. esc_html__('Content(s) not created yet, please check back later.', 'law-corporate') . '</p>';                        

                } ?>    
                    
            </div>

            <?php lc_paginate(); ?>

        </div>