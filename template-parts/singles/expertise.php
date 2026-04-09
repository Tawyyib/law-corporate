					    <div id="post-<?php the_ID(); ?>" <?php post_class('single-service-post content-outlay container-app py-7 row flex-row justify-content-between'); ?> ><!-- CONTENT OUTLAY -->
                            
                            <?php if (have_posts()){
                                
                                while (have_posts()){
                            
                                    the_post();  ?>

                                    <section class="<?php echo esc_attr('main-post service-single'); ?>" >
                                                                                
                                        <article class="<?php echo esc_attr('service d-flex mb-4'); ?>" >

                                            <main class="<?php echo esc_attr('service__body'); ?>" >

                                                <?php the_content(); 
                                                
                                                    wp_link_pages();                                                                                                       
                                                
                                                ?>
                                                
                                            </main>         
                                            
                                            <?php lc_services_rel(); ?>

                                        </article> 
                                                                    
                                        <?php lc_post_navigation(); ?>
                                            
                                    </section>                           

                                <?php } 
                            
                            } ?>
  
                            <?php get_sidebar(); ?>
                             
                        </div>