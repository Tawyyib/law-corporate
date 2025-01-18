<!DOCTYPE html>

<html <?php language_attributes() ?> >
	
	<head>
		
		<meta charset="<?php bloginfo('charset') ?>">
		<meta name="description" content="<?php bloginfo('description') ?>">
		<meta name="viewport" content="width=device-width" >

		<?php wp_head(); ?>
	
	</head>
	
	<body <?php body_class(array()); ?> >

	    <?php wp_body_open() ?>
        
        <div id="<?php echo esc_attr('app'); ?>" class="<?php echo esc_attr('app'); ?>"><!-- open-site-content-wrap -->

            <header class="<?php echo esc_attr('header fixed-top'); ?>" ><!-- site-header -->

				<?php get_template_part( 'template-parts/header/site-branding' ); ?><!-- site-bar -->

            </header>

			<?php get_template_part('template-parts/header/site-banner'); ?>

			<div >

			</div>
                    
            <?php if ( !is_front_page() && !is_page('Contact') && !is_page('Contact Us') && !is_home() ) : ?>   

            <div class="<?php echo esc_attr('breadcrumb bg-light'); ?>" ><!-- breadcrumb -->

				<div class="<?php echo esc_attr('breadcrumb__inner container-app d-flex align-items-center justify-content-between'); ?>">

					<?php if (function_exists('lc_breadcrumb')) { lc_breadcrumb(); } ?>
					
					<?php if (function_exists('lc_back_button')) { lc_back_button(); } ?>
										
				</div>

            </div>          

			<?php endif; ?>

            <?php if (! is_front_page()) : ?>   
			
			<main id=" <?php echo esc_attr('main'); ?>" class="<?php echo esc_attr(' main '); ?> " ><!-- main content section -->
				
				<div class=" <?php echo esc_attr('main-inner '); ?><?php if(! is_page('Contact')){ echo esc_attr('py-0 my-0 '); } ?> " >
				     					
			<?php endif; ?>