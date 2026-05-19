<!-- UPPER FOOTER -->

<section class="footer-main py-6">
  
  <div class="container-app">

      <div class="footer-main-inner d-flex" >		                    

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

  </div>

</section>