                                    
					    <div id="post-<?php the_ID(); ?>" <?php post_class('content-outlay d-flex container-app py-7'); ?>><!-- CONTENT OUTLAY -->
                            
                            <?php if (have_posts()){
                                
                                while (have_posts()){
                            
                                    the_post();  ?>

                                <section  class="main-post project-single" >
                                                                                
                                    <article class="project d-flex">
                                                 
                                        <?php echo lc_project_metadata(); ?>

                                        <main class="project__body" >

                                            <?php the_content(); 
                                                
                                                wp_link_pages();

                                            ?>
                                                
                                        </main>                                          

                                    </article>
                                     
                                    <?php lc_post_navigation(); ?>

                                </section>                           

                                <?php } 
                            
                            } ?>
                                                   
                            <?php get_sidebar(); ?>
          
                        </div>                               