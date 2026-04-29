<!-- LOWER FOOTER -->

<section class="lower-footer container-app">

    <div class="lower-footer-inner d-flex py-2">				                    
        
        <div class="copyright"><?php echo esc_html('&copy;'); ?><?php echo esc_html('2005&nbsp;-&nbsp;'); ?><?php echo date('Y'); ?>&nbsp;<a href=" <?php echo esc_url(home_url()); ?> " target="<?php echo esc_html('_blank'); ?>"><?php bloginfo('name'); ?></a>.&nbsp;<?php // echo __('All Rights Reserved.', 'law-corporate'); ?></div>
        
        <?php echo lc_footer_menu(); ?>

    </div>

</section>