<section class="nav-container" ><!-- navbar -->

    <nav class="nav navbar navbar-expand-lg bg-transparent">
        
        <div class="nav-inner container-app" >

			<div class="app-brand" >

                <?php if (function_exists('lc_site_brand')) { lc_site_brand(); } ?>

			</div>
            
            <?php get_template_part( 'template-parts/header/site-navi' ); ?><!-- site-bar -->

        </div>

    </nav>
    
</section>