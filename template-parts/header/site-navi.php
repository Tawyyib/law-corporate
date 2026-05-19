
<div id="navbarOffcanvasLg" class="offcanvas offcanvas-start bg-canvas navCanvas" tabindex="-1" aria-labelledby="navbarOffcanvasLgLabely" >

    <div class="offcanvas-header navCanvas-header">

        <div class="mt-2" >

            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>

        </div>

        <div class="search-box mt-3" ><?php if (function_exists('lc_search_form')) { lc_search_form(); } ?></div><!-- Offcanvas-search-bar -->

    </div>

    <div class="offcanvas-body navCanvas-body">
    
        <?php if (function_exists('lc_main_menu')) { lc_main_menu(); } ?><!-- main-navigation-menu -->

    </div>
    
    <div class="offcanvas-footer navCanvas-footer">

        <div class="'offcanvas-title app-brand-offcanvas " id="offcanvasNavbarLabel"><?php lc_site_brand(); ?></div><!-- Offcanvas-logo -->

    </div>

</div>

<div class="top-button-container d-flex align-items-center align-content-center" >

    <?php if (function_exists('lc_search_button')) { lc_search_button(); } ?><!-- header-call-button -->

    <?php if (function_exists('lc_call_button')) { lc_call_button(); } ?><!-- header-call-button -->

    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbarOffcanvasLg" aria-controls="navbarOffcanvasLg" aria-label="Toggle navigation" >

        <span class="navbar-toggler-icon"></span>

    </button>

</div>