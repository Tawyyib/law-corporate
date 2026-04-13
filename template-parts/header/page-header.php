
							<?php if (is_home()){ ?>
											
								<!--  Blog Home Title -->
								<h1><?php 	esc_html(single_post_title());  ?></h1> 
									
							<?php }elseif( is_archive() && !is_tax() ){ ?>
										
								<!--  PostType Archive Title -->
								<h1><?php	esc_html(the_archive_title()); ?></h1> 							
	
							<?php } elseif( is_category() && !is_tag() ){  ?>
										
								<!--  Post Category Archive Title -->
								<h1><?php	esc_html(single_cat_title()); ?>
										
							<?php } elseif( is_tax() && !is_tag() ){  

								// Taxonomy  Based Title
								$term = get_queried_object();
                				$taxonomy = get_taxonomy( $term->taxonomy );
								
								?>
										
								<!--  Taxonomy Archive Title -->
								<h1><?php if ($taxonomy){ echo $taxonomy->labels->singular_name; }	?></h1> 
																				
							<?php } elseif( is_singular('people') ){  
								                
									$post_type = get_post_type();
									$post_type_object = get_post_type_object($post_type);
								
								?>								
								
								<!--  Single Page: Profile Title -->
								<h1><?php if ($post_type_object){ echo $post_type_object->labels->name; }	?></h1> 
																																				
							<?php } elseif(is_singular('post')){  
								
								$post_category = wp_get_post_terms( get_the_ID(), 'category', array("fields" => "names"));
								
								?>

								<div class="post-meta d-flex flex-column">
											
									<!--  Single Page: Post Title -->
									<?php the_category(); ?>
													
									<h1 class="post-meta__title" ><?php esc_html(single_post_title()); ?></h1> 

									<span class="post-meta__author d-flex" >By&nbsp;<?php if (function_exists('lc_post_authors')) {lc_post_authors();} ?></span>

									<span class="post-meta__timestamp d-flex" ><?php the_time('F d, Y'); ?>&nbsp;&nbsp;|&nbsp;&nbsp;<?php echo esc_html(get_avg_read_time()); ?> <span class="read-text">Read</span></span>
													
								</div>
								
							<?php } elseif(is_singular('projects')) { ?>
										
								<div class="project-label d-flex justify-content-between">
								
									<!--  Single Page: Project Title -->												
									<h1 class="project-label__title col-lg-11 col-sm-12" ><?php esc_html(single_post_title()); ?></h1>
									
									<!--  Timestamp  -->
									<span class="project-label__timestamp d-flex" ><em>Published:</em>&nbsp;&nbsp;<?php the_time('F d, Y'); ?></span>
									
									<!--  Metadata  -->
									<span class="project-label__meta" ><span class="">Read Time:</span>&nbsp;&nbsp;<?php echo esc_html(get_avg_read_time()); ?></span>
													
								</div>

							<?php } elseif( is_singular('services') && !is_page() ) { ?>
										
								<!--  Single Page:  Services Title -->
								<h1><?php esc_html(the_title()); ?></h1> 

							<?php } else { ?>
										
								<!--  Single Page:  Title -->
								<h1><?php esc_html(the_title()); ?></h1> 
										
							<?php } ?>