

            <?php if (  !is_front_page()) : ?>   
          
                </div>  
                
            </main>        
                                            
            <?php endif; ?>      
        
        <footer class="<?php echo esc_attr('app-footer'); ?>" >

            <?php 
                get_template_part( 'template-parts/footer/footer-main' );
                get_template_part( 'template-parts/footer/footer-bottom' );
                lc_back_to_top();
            ?>

        </footer>

    </div><!-- close-site-content-wrap  -->

    <?php if (function_exists('lc_search_modal')) { lc_search_modal(); } ?>
    
    <?php if (function_exists('lc_data_refresh')) {lc_data_refresh(); } ?>
		        
<?php wp_footer(); ?>

</body>

</html>