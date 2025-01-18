<?php
/**
 * Template Name: About
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

 // Ensure this code runs within the WordPress environment
if (!defined('ABSPATH')) {
    exit;
}
 get_header(); ?>

 <?php

    get_template_part('template-parts/full-width');

 ?>

<?php get_footer(); ?>