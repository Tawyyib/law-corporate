<aside  class="<?php echo esc_attr('page-side-bar col-sm-12 col-slg-4 bg-image-center'); ?>" >
    
    <?php if (is_singular('projects')) { 

        lc_projects_rel();

        lc_posts_rel();

    } ?>

    <?php if (is_singular('services')) {
        	
        lc_services_rel();
                
        lc_projects_rel();
                    
    }?> 

    <?php if (is_singular('post')) {

        lc_posts_rel();
        
        lc_projects_rel();

    }?>    

</aside>