<aside  class="sidebar-aside d-flex" >
    
    <?php 
        
        if (is_singular('projects')) { 

            lc_project_metadata(); 

        } 
        
        if (is_singular('services')) {
                    
            lc_services_rel ();
            
            lc_tax_terms_rel ( );      
                        
        }
        
        if (is_singular('post')) {

            lc_post_metadata ();

        }
        
        if (is_tax ()) {

            lc_tax_terms_rel ( );      

        }
            

        if ( is_singular ('services') || is_singular ('projects')  ) {
          
            get_template_part( 'template-parts/content/cta-project-side' );
        
        }

        if ( is_singular ('post') || is_tax() ) {
        
            get_template_part( 'template-parts/content/newsletter-side' ); 
        
        }

    ?>  

</aside>