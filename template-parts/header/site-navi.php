
<div class="<?php echo esc_attr(' offcanvas offcanvas-start bg-dark '); ?>" tabindex="<?php echo esc_attr('-1'); ?>" id="<?php echo esc_attr('navbarOffcanvasLg'); ?>" aria-labelledby="<?php echo esc_attr(' navbarOffcanvasLgLabel '); ?>" >

    <div class=" <?php echo esc_attr(' offcanvas-header flex-column '); ?> ">

        <div class="<?php echo esc_attr(' mt-2'); ?>" >

            <button type="<?php echo esc_attr(' button '); ?>" class="<?php echo esc_attr(' btn-close '); ?>" data-bs-dismiss="<?php echo esc_attr('offcanvas'); ?>" aria-label="<?php echo esc_attr(' Close '); ?>"></button>

        </div>

        <div class="<?php echo esc_attr(' search-box mt-3'); ?>" ><?php if (function_exists('lc_search_form')) { lc_search_form(); } ?></div><!-- Offcanvas-search-bar -->

    </div>

    <div class="<?php echo esc_attr(' offcanvas-body flex-row-reverse '); ?>">
    
        <?php if (function_exists('lc_main_menu')) { lc_main_menu(); } ?><!-- main-navigation-menu -->

    </div>
    
    <div class=" <?php echo esc_attr(' offcanvas-footer '); ?> ">

        <div class=" <?php echo esc_attr('offcanvas-title app-brand-offcanvas '); ?> " id="offcanvasNavbarLabel"><?php lc_site_brand(); ?></div><!-- Offcanvas-logo -->

    </div>

</div>

<div class="<?php echo esc_attr('top-button-container d-flex align-items-center align-content-center'); ?>" >

    <span class="<?php echo esc_attr('custom-btn-search '); ?>" type="<?php echo esc_attr(' button'); ?>" alt="<?php echo esc_attr('Search'); ?>" title="<?php echo esc_attr(' Search'); ?>" data-bs-toggle="<?php echo esc_attr('modal'); ?>" data-bs-target=" #exampleModal " ><i class="<?php echo esc_attr('fa-solid fa-search'); ?>"></i></span>

    <?php if (function_exists('lc_call_button')) { lc_call_button(); } ?><!-- header-call-button -->

    <button class="<?php echo esc_attr(' navbar-toggler '); ?>" type="<?php echo esc_attr('button'); ?>" data-bs-toggle="<?php echo esc_attr('offcanvas'); ?>" data-bs-target="<?php echo esc_attr(' #navbarOffcanvasLg '); ?>" aria-controls="<?php echo esc_attr(' navbarOffcanvasLg '); ?>" aria-label="<?php echo esc_attr(' Toggle navigation '); ?>" >

        <span class="<?php echo esc_attr(' navbar-toggler-icon '); ?>"></span>

    </button>

</div>