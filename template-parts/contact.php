

				<div  id="post-<?php the_ID(); ?>" <?php post_class(); ?> class="<?php echo esc_attr('content-outlay'); ?>" ><!-- CONTACT OUTLAY -->
          
          <?php if (have_posts()){
                    
                    while (have_posts()){
                
                      the_post();

                $map = get_theme_mod('map_url');

                if(!empty($map)){ ?>

                <section class="<?php echo esc_attr('map'); ?>" >

                    <?php if (function_exists('lc_contact_map')) { lc_contact_map(); }  ?>
                  
                </section><?php

                }

            ?>

                <section class="<?php echo esc_attr('lower-contact'); ?>" >

                    <div class="<?php echo esc_attr('lower-contact-container pt-6'); ?>" >

                      <h2 class="<?php echo esc_attr('container-app mb-5'); ?>" ><?php echo esc_html_e(' We appreciate your interest in CLACCS Associates.', 'law-corporate'); ?></h2>

                      <div class="<?php echo esc_attr('lower-contact-inner d-flex'); ?>" >

                        <!-- DETAILS SECTION -->
                        
                        <div class="<?php echo esc_attr('contact-info'); ?>" >

                          <div class="<?php echo esc_attr('contact-info-inner container-app mb-5'); ?>">

                          <?php if (function_exists('lc_contact_info')) { lc_contact_info(); } ?>

                          </div>        
                          
                        </div>

                        <!-- FORM SECTION -->
                        
                        <div class="<?php echo esc_attr('contact-inquiry pt-4 bg-light'); ?>" >
                          
                          <div class="<?php echo esc_attr('container-inner container-app'); ?>" >

                            <h3 class="<?php echo esc_attr('my-4'); ?>" ><?php echo esc_html_e('Share your thoughts with us, and we shall get back you in quick time.', 'law-corporate'); ?></h3>

                            <?php if (function_exists('lc_contact_form')) { lc_contact_form(); } ?>

                          </div>

                        </div>
                        
                        <!-- LOWER INNER END -->        

                      </div>

                    </div>

                </section>
                
                <?php

                } 
            
          } ?>
						
        </div>