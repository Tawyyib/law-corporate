                                    
					    <div  id="post-<?php the_ID(); ?>" <?php post_class('content-outlay container-app py-7'); ?> ><!-- CONTENT OUTLAY -->
                            
                            <?php if (have_posts()){
                                
                                while (have_posts()){
                            
                                    the_post();  ?>

                                <section  class="<?php echo esc_attr(' main-post project-single row col-smd-12 d-flex justify-content-between'); ?>" >
                                                                                
                                    <article class="<?php echo esc_attr('project col-slg-7x col-smd-12'); ?>" >

                                            <div class="<?php echo esc_attr(' project__body '); ?>" >

                                                <?php the_content(); 
                                                
                                                    wp_link_pages();
                                                
                                                ?>
                                                
                                            </div>                                          
                                                                
                                        <nav class="<?php echo esc_attr('navi d-flex justify-content-between mt-4'); ?>" >
                        
                                            <div  class="<?php echo esc_attr('navi__box previ'); ?>" >
                        
                                                <?php previous_post_link('%link', '<span class="previ-arr" >&laquo;</span> <span class="previ-mobile" >Previous</span> <span class="previ-desktop" >%title</span>' ); ?>
                        
                                            </div>  
                                
                                            <div  class="<?php echo esc_attr('navi__box next'); ?>" >
                        
                                                <?php next_post_link('%link', '<span class="next-desktop">%title</span> <span class="next-mobile" >Next</span> <span class="next-arr" >&raquo;</span>' ); ?>
                        
                                            </div>

                                        </nav> 
                                            
                                    </article>
                                    
                                    <?php get_sidebar(); ?>

                                </section>                           

                                <?php } 
                            
                            } ?>
                         
                        </div>
 
                        <?php get_template_part('template-parts/front/project-counter'); ?>
     
                        <?php get_template_part('template-parts/front/blog-list'); ?>                                