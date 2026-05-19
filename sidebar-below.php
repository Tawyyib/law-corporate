<aside  class="sidebar-below d-flex" >
    
    <?php 
        
        if (is_singular('projects')) { 
            
            lc_get_related_projects ();

            lc_get_related_posts();

        } 
        
        if (is_singular('services')) {
                    
            lc_get_related_projects();

            lc_get_related_posts ();

        }
        
        if (is_singular('post')) {

            lc_get_related_posts ();
            
            lc_get_related_projects ();

        }
        
        if (is_tax ()) {

            lc_tax_services ();
                        
            lc_get_related_projects ();

        }
        
    ?>   

</aside>