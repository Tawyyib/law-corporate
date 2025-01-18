                                    
					    <section id="<?php echo esc_attr('the-firm'); ?>" class="<?php echo esc_attr(' content-outlay container-app py-4_5'); ?><?php if(! is_page('')){ echo esc_attr(' row flex-row justify-content-between '); } ?>" ><!-- CONTENT OUTLAY -->
                            
                            <?php if (have_posts()){
                                
                                while (have_posts()){
                            
                                    the_post();  ?>
                                                                                
                                    <article class="<?php echo esc_attr(' page-content col-sm-12 py-5'); ?>" >
                                        
                                        <div class="<?php echo esc_attr(' page-content__body '); ?>" >

                                            <?php the_content(); ?>
                                            
                                        </div>            

                                    </article> 
                                           
                                <?php } 
                            
                            } else {

                                echo '<p class="'. esc_attr('no-content extra') .'"  >'. esc_html__('Content(s) not created yet, please check back later.', 'law-corporate') . '</p>';                        

                            }
                                                        
                            ?>
                        
                        </section>

                        <?php if (is_page('about')) { 

                            get_template_part('template-parts/content/values');

                            get_template_part('template-parts/content/message');

                            get_template_part('template-parts/front/project-counter');

                            get_template_part('template-parts/content/people');
                            
                        }; ?>