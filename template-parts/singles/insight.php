                                    
					    <div id="post-<?php the_ID(); ?>" <?php post_class('content-outlay container-app py-7 row flex-row justify-content-between'); ?>  ><!-- CONTENT OUTLAY -->
                            
                            <?php if (have_posts()){
                                
                                while (have_posts()){
                            
                                    the_post();  ?>

                                    <section class="main-post insight-single" >
                                                                                
                                        <article class="insight d-flex mb-4">

                                            <main class="insight__body" >

                                                <?php the_content(); 
                                                
                                                    wp_link_pages();

                                                ?>
                                                
                                            </main>                                          

                                            <?php echo lc_post_metadata(); ?>

                                        </article> 
                                                                    
                                        <?php lc_post_navigation(); ?>
                                                                                                       
                                    </section>                           

                                <?php } 
                            
                            } ?>
 
                            <?php get_sidebar(); ?>
                                                               
                        </div>