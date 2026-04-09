
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
																		
							<?php } elseif(is_singular('post')){  
								
								$post_category = wp_get_post_terms( get_the_ID(), 'category', array("fields" => "names"));
								
								?>

								<div class="post-meta d-flex flex-column">
											
									<?php the_category(); ?>
													
									<h1 class="post-meta__title" ><?php esc_html(single_post_title()); ?></h1> 

									<span class="post-meta__author d-flex" >By&nbsp;<?php if (function_exists('lc_post_authors')) {lc_post_authors();} ?></span>

									<span class="post-meta_time-stamp d-flex" ><?php the_time('F d, Y'); ?> &nbsp;&nbsp;|&nbsp;&nbsp; <?php echo esc_html(get_avg_read_time()); ?> Read</span>
													
								</div>
								
							<?php } elseif(is_singular('projects')) { ?>
										
								<div class="<?php echo esc_attr('project_label d-flex justify-content-between'); ?>">
													
									<h1 class="<?php echo esc_attr(' project_label_title col-lg-11 col-sm-12'); ?>" ><?php esc_html(single_post_title()); ?></h1>
													
								</div>

							<?php } elseif(is_singular('people') || is_singular('services') && !is_page()) { ?>
										
								<h1><?php esc_html(the_title()); ?></h1> 

							<?php	} else { ?>
										
								<h1><?php esc_html(the_title()); ?></h1> 
										
							<?php } ?>