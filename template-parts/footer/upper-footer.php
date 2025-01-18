<!-- UPPER FOOTER -->

<section class="<?php echo esc_attr('upper-footer container-app col-md-12 pt-6 pb-4'); ?>">
    	
    <div class="<?php echo esc_attr('upper-footer-inner row d-flex py-3'); ?>" >				                    

        <?php if (is_active_sidebar('footer-1')) {
          
          dynamic_sidebar('footer-1'); 

        } ?>
                           
        <?php if (is_active_sidebar('footer-2')) {
        
          dynamic_sidebar('footer-2');                  

        } ?>
  
  
        <?php if (is_active_sidebar('footer-3')) {

          dynamic_sidebar('footer-3');

        } ?>          
  
        <?php if (is_active_sidebar('footer-4')) {

          dynamic_sidebar('footer-4');

        } ?>           

    </div>

</section>