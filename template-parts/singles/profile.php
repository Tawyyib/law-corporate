                                    
					    <div id="post-<?php the_ID(); ?>" <?php post_class('content-outlay container-app py-7 row flex-row justify-content-between'); ?> ><!-- CONTENT OUTLAY -->

                            <?php if (have_posts()){
                                
                                while (have_posts()){
                            
                                    the_post();  ?>
                                                                            
                                    <section class="main-post mb-4" >                                        

                                        <main class="person d-flex flex-column" >                                            
                                                                              
                                            <div class="<?php echo esc_attr('person__meta d-flex flex-column'); ?>">

                                                <?php 

                                                    $designation = get_post_meta(get_the_ID(), 'designation', true);
                                                    $honours = get_post_meta(get_the_ID(), 'honours', true);

                                                ?>
                                                
                                            <span class="<?php echo esc_attr('person__meta-name'); ?>"><?php the_title(); ?>

                                                <?php // Get and display the role or designation

                                                    if (!empty($honours)){

                                                        echo '<span class="person__meta-role">' . esc_html($honours) . '</span>';

                                                }?>                                               
                                            
                                            </span>

                                                <?php // Get and display the role or designation

                                                    if (!empty($designation)){

                                                        echo '<span class="person__meta-role">' . esc_html($designation) . '</span>';

                                                }?>     

                                            </div>                                          
                                                
                                            <article class="<?php echo esc_attr('person__profile'); ?>">

                                                <!-- section thumbnail -->
                                                <div class="<?php echo esc_attr('person__profile-body'); ?>">

                                                    <?php the_content(); 
                                                                                                    
                                                        wp_link_pages();
                                                                                                               
                                                    ?>

                                                </div>

                                                <!-- section thumbnail -->
                                                <figure class="<?php echo esc_attr('person__profile-thumbnail'); ?>">
                                                    
                                                    <img src="<?php  

                                                                        $gender = get_post_meta(get_the_ID(), 'gender', true);
                                                                        
                                                                    if ((has_post_thumbnail())) { 
                                                                        
                                                                        echo the_post_thumbnail_url(); 
                                                                        
                                                                    } else { 

                                                                        if ($gender === 'Female') {

                                                                            echo esc_url(get_template_directory_uri() . '/public/images/female-avatar.webp');

                                                                        }else {
                                                                            
                                                                            echo esc_url(get_template_directory_uri() . '/public/images/male-avatar.webp'); 
                                                                        }
                                                                                                                                            
                                                                    } ?>" 
                                                                    
                                                                    alt="<?php the_title(); ?>"  title="<?php the_title(); ?>" class="<?php echo esc_attr('person__profile-thumbnail-image'); ?>" >
                                                                                                                                                                                                                                                    
                                                </figure>

                                            </article>
                                                
                                            <div class="<?php echo esc_attr('person__socials-links');?>">

                                                <?php lc_show_social_meta(get_the_ID()); ?>

                                            </div>

                                        </main>                                          

                                    </section>                                                                       
                                     
                                    <?php lc_post_navigation(); ?>
                                        
                                <?php } 
                            
                            } ?>
                                               
                        </div>

                        <?php get_template_part('template-parts/content/values'); ?>