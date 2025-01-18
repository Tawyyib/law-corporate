<?php
/**
 * This is the single-page template
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Law Corporate
 * @since Law Corporate 1.0.0
 * 
 */

get_header(); ?>

<?php

 if(is_singular('people')){

      get_template_part('template-parts/singles/profile');   
      
      wp_reset_postdata();

   }else if(is_singular('projects')){

      get_template_part('template-parts/singles/project');       

      wp_reset_postdata();

   }else if(is_singular('services')){

      get_template_part('template-parts/singles/expertise');   
      
      wp_reset_postdata();

   } else if(is_singular('post')) {

      get_template_part('template-parts/singles/insight');       
         
   } 

   wp_reset_postdata();

?>

<?php get_footer(); ?>