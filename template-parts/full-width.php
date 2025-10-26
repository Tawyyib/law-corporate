                                    
					    <section id="<?php echo esc_attr('the-firm'); ?>" class="content-outlay container-app py-4_5 <?php if(! is_page('')){ echo esc_attr(' row flex-row justify-content-between '); } ?>" ><!-- CONTENT OUTLAY -->
                                
                            <div class="content-inner page-content dual-body col-sm-12 py-5">

                                <?php if (have_posts()){ 
                                                                                                                
                                    while (have_posts()){           

                                        echo '<article class="page-content__body p- bg-ligh">';

                                            the_post(); 

                                            the_content(); 
                                    
                                        echo '</article>'; 
                                                                
                                    }  
                
                                    }
                                                                                            
                                    get_template_part('template-parts/content/values-new');
                                
                                ?>                                
                            
                            </div>
                        
                        </section>

                        <?php if (is_page('about')) { 

                            get_template_part('template-parts/content/values');

                            get_template_part('template-parts/content/message');

                            get_template_part('template-parts/front/project-counter');

                            get_template_part('template-parts/content/people');
                            
                        }; ?>