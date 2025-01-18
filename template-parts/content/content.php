
                                    
					    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?> class="<?php echo esc_attr(' content-outlay container-app py-7'); ?><?php if(!is_page('Contact')){ echo esc_attr(' row flex-row justify-content-between '); } ?>" ><!-- CONTENT OUTLAY -->
                            
                            <?php if (have_posts()){
                                
                                while (have_posts()){
                            
                                    the_post();  ?>
                                                                            
                                <article class="<?php echo esc_attr(' main-post col-sm-12 col-lmd-8 '); ?>" >
                                    
                                    <div class="<?php echo esc_attr(' '); ?>" >

                                        <?php the_content(); ?>
                                        
                                    </div>            

                                </article> 

                                <?php get_sidebar(); ?>
                                        
                            <?php } 
                            
                            } ?>
                        
                        </div>