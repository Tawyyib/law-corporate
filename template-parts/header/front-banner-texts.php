					<?php

						// Ensure this code runs within the WordPress environment
						if (!defined('ABSPATH')) { exit; }            
    							
						// 1. Banner Title and Texts
						$default_title = 'Best in Class Advisory Services';
						$banner_title = get_theme_mod('front_banner_title');
						$banner_title =! empty ( $banner_title ) ? esc_html( $banner_title ) : esc_html__( $default_title, 'law-corporate' ); 
							
						$default_details = 'Some representative placeholder content for the slide. Some more representative placeholder content for the slide';
						$banner_details = get_theme_mod ( 'front_banner_details' );
						$banner_details = ! empty ( get_theme_mod ( $banner_details) )  ? esc_html ( $banner_details ) : esc_html__( $default_details, 'law-corporate' );

						// 2. Slide Buttons
						$url_1_default = get_permalink(get_page_by_path('projects'));
						$button_1_url = get_theme_mod( 'front_banner_url' );
						$button_1_url = ! empty ( $button_1_url ) ? esc_url ( $button_1_url ) : esc_url( $url_1_default ); 

						$label_1_default =  'Explore'; 							
						$button_1_label = get_theme_mod('front_banner_label'); 							
						$button_1_label = ! empty ( $button_1_label ) ? esc_html ( $button_1_label ) : esc_html__( $label_1_default, 'law-corporate' );

						$button_1_classes = 'btn-primary';
						$button_1_type = ' ';
						$button_1_target = '_self';
						$button_1_rel = ' ';
						$icon_1_classes = 'fas fa-arrow-right';
						
						// 3. SButton_2_Properties
						$url_2_default = get_permalink(get_page_by_path('contact'));
						$button_2_url = get_theme_mod('front_banner_url_2');
						$button_2_url = ! empty ( $button_2_url ) ? esc_url ( $button_2_url ) : esc_url( $url_2_default ); 

						$label_2_default =  'Contact Us'; 							
						$button_2_label = get_theme_mod('front_banner_label_2' ); 							
						$button_2_label = ! empty ( $button_2_label ) ? esc_html ( $button_2_label ) : esc_html__( $label_2_default, 'law-corporate' );

						$button_2_classes = 'btn-outline flex-row-reverse';
						$button_2_type = ' ';
						$button_2_target = '_self';
						$button_2_rel = ' ';
						$icon_2_classes = 'fas fa-phone-alt';

					?>

							<div class="<?php echo esc_attr(' banner-overlay-inner-texts '); ?>">
								
								<h1><?php printf(  /* translators: %s: Banner Title */ 	__( '%s', 'law-corporate'), $banner_title ) ;?></h1>

								<p class=" <?php echo  esc_attr('mt-2 mb-4 '); ?> " ><?php printf(  /* translators: %s: Banner Details */ 	__( '%s', 'law-corporate'),$banner_details ); ?></p>
																												
           
								<div class="banner-overlay__buttons animate-onScroll">
									
									<!-- button -->
									<?php 
										
										/**		button-1		**/									
										lc_cta_button ( $button_1_label, $button_1_url, $button_1_classes, $button_1_type, $button_1_target, $button_1_rel, $icon_1_classes );
									
										/**		button-2		**/
										lc_cta_button ( $button_2_label, $button_2_url, $button_2_classes, $button_2_type, $button_2_target, $button_2_rel, $icon_2_classes );
										
									?>

								</div>
															
							</div>