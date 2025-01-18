                                    
					    <div  id="post-<?php the_ID(); ?>" <?php post_class('content-outlay container-app py-7 row flex-row justify-content-between'); ?> ><!-- CONTENT OUTLAY -->

                            <?php if (have_posts()){
                                
                                while (have_posts()){
                            
                                    the_post();  ?>
                                                                            
                                    <section class="<?php echo esc_attr('main-post'); ?>" >                                        

                                        <main class="<?php echo esc_attr('person d-flex row justify-content-between '); ?>" >
                                            
                                            <!-- section thumbnail -->

                                            <article class="<?php echo esc_attr('person-profile col-xxxl-6 col-sxxl-7 col-sxl-7 col-slg-7 col-smd-12 '); ?>">
                                                                            
                                                <div class="<?php echo esc_attr('person-profile__meta d-flex flex-column mb-3'); ?>">
                                                
                                                    <!--<span class="<?php echo esc_attr('person-profile__meta-header mb-1'); ?>">About</span>-->

                                                    <span class="<?php echo esc_attr('person-profile__meta-name mb-2'); ?>"><?php the_title(); ?></span>

                                                    <?php // Get and display the role or designation

                                                        $designation = get_post_meta(get_the_ID(), 'designation', true);

                                                        if (!empty($designation)){

                                                            echo '<span class="person-profile__meta-role">' . esc_html($designation) . '</span>';

                                                        } ?>     

                                                    <?php //** Get and display the role or designation

                                                        $position = get_post_meta(get_the_ID(), 'position', true);

                                                        if (!empty($position)){

                                                    //    echo '<span class="person-profile__meta-role">' . esc_html($position) . '</span>';

                                                    }?>

                                                </div>

                                                <div class="<?php echo esc_attr('person-profile__body mb-3'); ?>">

                                                    <?php the_content(); 
                                                                                                    
                                                        wp_link_pages();
                                                                                                                  
                                                    ?>

                                                </div>

                                                <div class="<?php echo esc_attr('person-profile__socials-links');?>">

                                                    <?php lc_show_social_meta(get_the_ID()); ?>

                                                </div>

                                            </article>

                                            <!-- section thumbnail -->

                                            <figure class="<?php echo esc_attr('person-thumbnail col-xxxl-col-sxxl-5 col-sxl-5 col-slg-5 col-smd-12 '); ?>">
                                                
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
                                                                
                                                                alt="<?php the_title(); ?>"  title="<?php the_title(); ?>" class="<?php echo esc_attr(' person-thumbnail-image '); ?>" >
                                                                                                                                                                                                                                                
                                            </figure>

                                        </main>                                          

                                    </section> 
                                                        
                                    <nav class="<?php echo esc_attr('navi d-flex justify-content-between mt-4'); ?>" >
                
                                        <div  class="<?php echo esc_attr('navi__box previ'); ?>" >
                
                                            <?php previous_post_link('%link', '<span class="previ-arr" >&laquo;</span> <span class="previ-mobile" >Previous</span> <span class="previ-desktop" >%title</span>' ); ?>
                
                                        </div>  
                         
                                        <div  class="<?php echo esc_attr('navi__box next'); ?>" >
                
                                            <?php next_post_link('%link', '<span class="next-desktop">%title</span> <span class="next-mobile" >Next</span> <span class="next-arr" >&raquo;</span>' ); ?>
                
                                        </div>

                                    </nav>                            
                                        
                                <?php } 
                            
                            } ?>
                                               
                        </div>

                        <?php get_template_part('template-parts/content/values'); ?>