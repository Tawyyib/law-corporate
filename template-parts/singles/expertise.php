					    <div id="post-<?php the_ID(); ?>" <?php post_class('single-service-post content-outlay container-app py-7 row flex-row justify-content-between'); ?>><!-- CONTENT OUTLAY -->
                            
                            <?php if (have_posts()){
                                
                                while (have_posts()){
                            
                                    the_post();  ?>

                                    <section class="<?php echo esc_attr(' main-post service-post col-smd-12 col-slg-7x'); ?>" >
                                                                                
                                        <article class="<?php echo esc_attr(' main-post '); ?>" >

                                            <div class="<?php echo esc_attr(' main-post__body '); ?>" >

                                                <?php the_content(); 
                                                                                                    
                                                    wp_link_pages();
                                                                                                              
                                                ?>
                                                
                                            </div>                                          

                                        </article> 
                                                            
                                        <nav class="<?php echo esc_attr('navi d-flex justify-content-between mt-4'); ?>" >
                            
                                            <?php
                                                    
                                                    // Reusable helper for navigation link markup
                                                    $prev_link = get_previous_post_link(
                                                        '%link',
                                                        '<span class="previ-arr">&laquo;</span> 
                                                        <span class="previ-mobile">Previous</span> 
                                                        <span class="previ-desktop">%title</span>'
                                                    );

                                                    $next_link = get_next_post_link(
                                                        '%link',
                                                        '<span class="next-desktop">%title</span> 
                                                        <span class="next-mobile">Next</span> 
                                                        <span class="next-arr">&raquo;</span>'
                                                    );

                                            if ($prev_link || $next_link) : ?>
                                                <div class="navi__box previ"><?php echo $prev_link; ?></div>
                                                <div class="navi__box next"><?php echo $next_link; ?></div>
                                            <?php endif; ?>

                                        </nav> 
                                        
                                    </section>                           

                                <?php } 
                            
                            } ?>
  
                            <?php get_sidebar(); ?>
                             
                        </div>