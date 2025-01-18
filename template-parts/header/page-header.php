
							<?php 

								if (is_home()){ ?>
											
								<h1><?php 	esc_html(single_post_title());  ?></h1> 
									
							<?php }elseif(is_archive() && !is_tax()){ ?>
										
								<h1><?php	esc_html(the_archive_title()); ?></h1> 							
	
							<?php } elseif(is_category() && !is_tag()){  ?>
										
								<h1><?php	esc_html(single_cat_title()); ?>
										
							<?php } elseif(is_tax() || is_singular('people') && !is_category() && !is_tag()){  
								                
									$post_type = get_post_type();
									$post_type_object = get_post_type_object($post_type);
								
								?>
										
								<h1><?php if ($post_type_object){ echo $post_type_object->labels->name; }	?></h1> 
																		
							<?php } elseif(is_singular('post')){  ?>

								<div class="<?php echo esc_attr('post-label d-flex flex-column justify-content-between bg-dar '); ?>">
											
									<span class="<?php echo esc_attr(' post-label__time-stamp d-flex mb-2 '); ?>" ><?php the_category(); ?>&nbsp;&nbsp;&diams;&nbsp;&nbsp;<?php the_time('F d, Y'); ?> </span>
													
									<h1 class="<?php echo esc_attr(' post-label__title mb-2 '); ?>" ><?php esc_html(single_post_title()); ?></h1> 

									<span class="<?php echo esc_attr('post-label__author d-flex mb-0 '); ?>" ><?php echo esc_html('By'); ?>&nbsp;&nbsp;<?php if (function_exists('lc_post_author_data')) {lc_post_author_data();} ?>&nbsp;<?php // the_time('F d, Y'); ?> </span>
													
								</div>
								
							<?php } elseif(is_singular('projects')) { ?>
										
								<div class="<?php echo esc_attr('project_label d-flex justify-content-between'); ?>">
													
									<h1 class="<?php echo esc_attr(' project_label_title mb-4 col-sxxl-8 col-sxl-7x col-slg-6  col-md-5x col-sm-12'); ?>" ><?php esc_html(single_post_title()); ?></h1> 																			

									<span class="<?php echo esc_attr(' project_label_meta'); ?>" ><?php echo lc_project_metadata(); ?></span>
													
								</div>

							<?php } elseif(is_singular('people') || is_singular('services') && !is_page()) { ?>
										
								<h1><?php esc_html(the_title()); ?></h1> 

							<?php	} else { ?>
										
								<h1><?php esc_html(the_title()); ?></h1> 
										
							<?php } ?>