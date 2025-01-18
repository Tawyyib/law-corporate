					<?php
							
						// 3. Banner Title and Texts
						$banner_title = esc_html('Best in Class Advisory Services'); 
						if(get_theme_mod('front_banner_title') !='')
						{
							$banner_title = get_theme_mod('front_banner_title');
						}

						$banner_details = esc_html( 'Some representative placeholder content for the slide. Some more representative placeholder content for the slide');
						if(get_theme_mod('front_banner_details') !='')
						{
							$banner_details = get_theme_mod('front_banner_details');
						}

						// 4. Slide Buttons
						$banner_url = esc_url('#main');                             
						if(get_theme_mod('front_banner_url') !='')
						{
							$banner_url = get_theme_mod('front_banner_url');
						}
						
						$banner_label = esc_html( 'Learn More');                             
						if(get_theme_mod('front_banner_label') !='')
						{
							$banner_label = get_theme_mod('front_banner_label'); 
						}

					?>

							<div class="<?php echo esc_attr(' banner-overlay-inner-texts '); ?>">
								
								<h1><?php printf(  /* translators: %s: Banner Title */ 	__( '%s', 'law-corporate'), $banner_title ) ;?></h1>

								<p class=" <?php echo  esc_attr('mt-2 mb-4 '); ?> " ><?php printf(  /* translators: %s: Banner Details */ 	__( '%s', 'law-corporate'),$banner_details ); ?></p>
																															
								<a class="<?php echo esc_attr(' btn btn-primary '); ?>" type="<?php echo esc_attr(' submit '); ?>" href="<?php echo esc_url($banner_url); ?>" ><?php printf(  /* translators: %s: Banner Label */ 	__( '%s', 'law-corporate'), $banner_label) ?><!--<i class="<?php echo esc_attr('fas fa-chevron-circle-right ms-2'); ?>"></i>--></a>
															
							</div>