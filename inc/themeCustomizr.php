<?php

/**
 * Plugin Name: Customizer Manager
 * Plugin URI: https://dubshop
 * Description: The Customizer Manager provides add_, get_, and remove_ methods for each Customizer object type; each works with an id. 
 *  The get_ methods allow for direct modification of parameters specified when adding a control.
 * Author: Toheeb Sobowale
 * Author URI: https://dubshop.com
 * 
 * 
 * @package WordPress
 * @subpackage Law Corporate
 * @since Law Corporate 1.0.0
 *  
 * 
 * ++++++++++++++++++++++++++++++++++++++++++
 * +    COLLECTION OF CUSTOM SETTINGS       +
 * ++++++++++++++++++++++++++++++++++++++++++
 * 
 * add_action( 'customize_register', function( $wp_customize )  // Adds custom sections to the wordpress customizer
  * {
  *    $wp_customize->add_panel();         //add panel
  *    $wp_customize->get_panel();         //get panel
  *    $wp_customize->remove_panel();      //remove panel
  * 
  *    $wp_customize->add_section();       //add section
  *    $wp_customize->get_section();       //get section
  *    $wp_customize->remove_section();    //remove section
  * 
  *    $wp_customize->add_setting();       //add setting
  *    $wp_customize->get_setting();       //get setting
  *    $wp_customize->remove_setting();    //remove setting
  * 
  *    $wp_customize->add_control();       //add control
  *    $wp_customize->get_control();       //get control
  *    $wp_customize->remove_control();    //remove control
  * }
 * );
 *
 * */
// Exit if accessed directly
if(!defined('ABSPATH')){
    exit;
}

add_action( 'customize_register', function( $wp_customize ){ // Open Customize Manager for contents
  
            
    /* ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    * 1.0. ADS SLIDER PANEL, SECTIONS, SETTINGS & CONTROLS      +
    * ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
    if ( file_exists( get_template_directory() . '/inc/custom/headerBanners.php' ) ) {
        include get_template_directory() . '/inc/custom/headerBanners.php';
      }        
              
    /* ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    * 2.0. CUSTOM ITEMS PANEL, SECTIONS, SETTINGS & CONTROLS      +
    * ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
    if ( file_exists( get_template_directory() . '/inc/custom/customItems.php' ) ) {
        include get_template_directory() . '/inc/custom/customItems.php';
      }
                      
    /* ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    * 2.0. ADS SLIDER PANEL, SECTIONS, SETTINGS & CONTROLS      +
    * ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
    if ( file_exists( get_template_directory() . '/inc/custom/brandInfo.php' ) ) {
        include get_template_directory() . '/inc/custom/brandInfo.php';
      }
        
  
}); // Close Customize Manager to Contents    