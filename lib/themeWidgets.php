<?php 

/**
 * Plugin Name: Theme Widgets Plugin
 * Plugin URI: https://dubshop
 * Description: Display Theme's Widgtes
 * Author: Toheeb Sobowale
 * Author URI: https://dubshop.com
 * 
 * 
 * @package WordPress
 * @subpackage Law Corporate
 * @since Law Corporate 1.0.0
 * 
 * */

    /**************************************************
    *   1.0. THEME WIDGET AREAS HOOK                  *
    ***************************************************/
    if ( file_exists( get_template_directory() . '/lib/widgetsAreas.php' ) ){

        require_once get_template_directory() . '/lib/widgetsAreas.php';

    }
       
    /**************************************************
    *   2.0. THEME CUSTOM WIDGETS HOOK                *
    ***************************************************/
    if ( file_exists( get_template_directory() . '/lib/customWidgets.php' ) ){

        require_once get_template_directory() . '/lib/customWidgets.php';

    }

    //** 7.2. */
    //require_once get_template_directory() . '/lib/class-custom-map-widget.php';

    //** 7.3. */
    //require_once get_template_directory() . '/lib/class-custom-newsletter-widget.php';

    //** 7.4. */
    //require_once get_template_directory() . '/lib/class-custom-socials-widget.php';	

    //** 7.5. */
    //require_once get_template_directory() . '/lib/custom-shortcodes.php';	

