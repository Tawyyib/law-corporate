<!-- LOWER FOOTER -->

<section class="<?php echo esc_attr(' lower-footer container-app'); ?>">

    <div class="<?php echo esc_attr('lower-footer-bottom col-md-12 d-flex py-4 flex-row flex-wrap'); ?> ">				                    
        
        <div class="<?php echo esc_attr('copyright'); ?>"><?php echo esc_html('&copy;'); ?><?php echo esc_html('2003'); ?><?php echo esc_html('&nbsp;'); ?><?php echo esc_html('-'); ?><?php echo esc_html('&nbsp;'); ?><?php echo date('Y'); ?><?php echo esc_html('&nbsp;'); ?><a href=" <?php echo esc_url(home_url()); ?> " target="<?php echo esc_html('_blank'); ?>"><?php bloginfo('name'); ?></a><?php echo esc_html('.&nbsp;'); ?><?php // echo esc_html_e('All Rights Reserved.', 'law-corporate'); ?></div>
        
        <?php echo lc_footer_menu(); ?>

        <!--<div class="<?php // echo esc_attr('creditlink'); ?>"><a href="<?php // echo esc_url_raw('https://dubshop.com.ng'); ?>" target="<?php // echo esc_html('_blank'); ?>" ><?php // echo esc_html('DUBSHOP'); ?></a></div>-->

    </div>

</section>