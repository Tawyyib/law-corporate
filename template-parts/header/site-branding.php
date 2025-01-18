<section class=" <?php echo esc_attr(' nav-container '); ?> " ><!-- navbar -->

    <nav class="<?php echo esc_attr('nav navbar navbar-expand-lg bg-transparent'); ?> ">
        
        <div class=" <?php echo esc_attr(' nav-inner container-app '); ?> " >

			<div class="<?php echo esc_attr('app-brand'); ?>" >

            <?php if (function_exists('lc_site_brand')) { lc_site_brand(); } ?>

			</div>
            
            <?php get_template_part( 'template-parts/header/site-navi' ); ?><!-- site-bar -->

        </div>

    </nav>
    
</section>