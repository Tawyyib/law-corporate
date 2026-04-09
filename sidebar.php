<aside  class="page-aside d-flex" >
    
    <?php if (is_singular('projects')) { 

        lc_projects_rel();

        lc_posts_rel();

    } ?>

    <?php if (is_singular('services')) {
                
        lc_projects_rel();

        lc_posts_rel();
                    
    }?> 

    <?php if (is_singular('post')) {

        lc_posts_rel();
        
        lc_projects_rel();

    }?>    

</aside>