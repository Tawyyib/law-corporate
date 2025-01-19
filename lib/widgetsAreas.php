<?php 

/**
 * Plugin Name: Widget Areas Plugin
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

    /***********************************************************
    * 1.1. Sidebar Widgets Areas                               *
    ************************************************************/
    function lc_sidebar_widgets() 
    {
        // Register Widgets
        register_sidebar(
            array(
                    'name'  		=>__( 'Side Bar One', 'law-corporate'),
                    'id'    		=>	'sidebar-one',
                    'description' 	=>__( 'This is the first sidebar and will appear on all pages describing the website or business', 'law-corporate' ),
                    'before_widget' => '<aside  id="%1$s" class="widget mb-5 %2$s" >',
                    'after_widget' 	=> '</aside>',
                    'before_title' 	=> '<h4 class="widget-title" >',
                    'after_title' 	=> '</h4>',
                    'before_sidebar'=> '<div id="%1$s" class=" widget-content %2$s" >',
                    'after_sidebar'	=> '</div>',
            )
        );
        
    register_sidebar( 
            array(
                    'name' 			=> __( 'Side Bar Two', 'law-corporate'),
                    'id' 			=> 'sidebar-two',
                    'description' 	=> __( 'This is the second sidebar and will appear on pages stating the legal information of the website', 'law-corporate' ),
                    'before_widget' => '<aside id="%1$s" class="widget mb-5 %2$s">',
                    'after_widget' 	=> '</aside>',
                    'before_title' 	=> '<h4 class="widget-title">',
                    'after_title' 	=> '</h4>',
                    'before_sidebar'=> '<div id="%1$s" class="widget-content %2$s" >',
                    'after_sidebar'	=> '</div>',
            )   
        );
    
        register_sidebar( 
            array(
                    'name' 			=>__( 'Side Bar Three', 'law-corporate'),
                    'id'			=> 'sidebar-three',
                    'description'	=> __( 'This is the third sidebar and will appear on only the single post pages of the website', 'law-corporate' ),
                    'before_widget' => '<aside id="%1$s" class="widget mb-5 %2$s">',
                    'after_widget' 	=> '</aside>',
                    'before_title' 	=> '<h4 class="widget-title">',
                    'after_title' 	=> '</h4>',
                    'before_sidebar'=> '<div id="%1$s" class="widget-content %2$s" >',
                    'after_sidebar'	=> '</div>',
            ) 
        );
    
        register_sidebar( 
            array(
                    'name' 			=>__( 'Side Bar Four', 'law-corporate'),
                    'id'			=> 'sidebar-four',
                    'description'	=> __( 'This is the fourth sidebar and will appear on archive, post listing and single post pages of the website', 'law-corporate' ),
                    'before_widget' => '<aside id="%1$s" class="widget mb-5 %2$s">',
                    'after_widget' 	=> '</aside>',
                    'before_title' 	=> '<h4 class="widget-title">',
                    'after_title' 	=> '</h4>',
                    'before_sidebar'=> '<div id="%1$s" class="widget-content %2$s" >',
                    'after_sidebar'	=> '</div>',
            ) 
        );
    
        register_sidebar( 
            array(
                    'name' 			=>__( 'Side Bar Five', 'law-corporate'),
                    'id'			=> 'sidebar-five',
                    'description'	=> __( 'This is the fifth sidebar and will appear on all pages of the website with sidebars', 'law-corporate' ),
                    'before_widget' => '<aside id="%1$s" class="widget mb-5 %2$s">',
                    'after_widget' 	=> '</aside>',
                    'before_title' 	=> '<h4 class="widget-title">',
                    'after_title' 	=> '</h4>',
                    'before_sidebar'=> '<div id="%1$s" class="widget-content %2$s" >',
                    'after_sidebar'	=> '</div>',
            ) 
        );
    }
    add_action('widgets_init','lc_sidebar_widgets');

    
    /***********************************************************
    * 1.2. Footer Widgets Areas                                *
    ************************************************************/
    function lc_footer_widgets() 
    {
        //** 1.2.1. Register Widgets */ 
        register_sidebar(
            array(
                    'name'  		=>__( 'Footer One', 'law-corporate' ),
                    'id'    		=>	'footer-1',
                    'class'         =>  'footer-one footer-widget',
                    'description' 	=> __( ' The 1st footer item on the footer of the page ', 'law-corporate' ),
                    'before_sidebar'=> '<div id="%1$s" class="%2$s" >',
                    'after_sidebar'	=> '</div>',                    
                    'before_widget' => '<div id="%1$s" class="widget %2$s" >',
                    'after_widget' 	=> '</div>',
                    'before_title' 	=> '<h4 class="widget-title mb-2" >',
                    'after_title' 	=> '</h4>',                    
            )
        );
        
        //** 1.2.2. */
        register_sidebar( 
        array(
                    'name' 			=> __( 'Footer Two', 'law-corporate' ),
                    'id' 			=> 'footer-2',
                    'class'         => 'footer-two footer-widget',
                    'description' 	=> __( 'The 2nd footer item on the footer of the page ', 'law-corporate' ),
                    'before_sidebar'=> '<div id="%1$s" class="%2$s" >',
                    'after_sidebar'	=> '</div>',
                    'before_widget' => '<div id="%1$s" class="widget %2$s" >',
                    'after_widget' 	=> '</div>',
                    'before_title' 	=> '<h4 class="widget-title mb-2" >',
                    'after_title' 	=> '</h4>',
            ) 
        );

        //** 1.2.3. */
        register_sidebar( 
            array(
                    'name' 			=>__( 'Footer Three', 'law-corporate'),
                    'id' 			=> 'footer-3',
                    'class'         => 'footer-three footer-widget',
                    'description' 	=> __( ' The 3rd footer item on the footer of the page ', 'law-corporate' ),
                    'before_sidebar'=> '<div id="%1$s" class="%2$s" >',
                    'after_sidebar'	=> '</div>',
                    'before_widget' => '<div id="%1$s" class="widget %2$s">',
                    'after_widget' 	=> '</div>',
                    'before_title' 	=> '<h4 class="widget-title mb-2">',
                    'after_title'	=> '</h4>',
            ) 
        );

        //** 1.2.4. */
        register_sidebar( 
            array(
                    'name' 			=>__( 'Footer Four', 'law-corporate'),
                    'id' 			=> 'footer-4',
                    'class'         => 'footer-four footer-widget',
                    'description' 	=> __( ' The 4th footer item on the footer of the page ', 'law-corporate' ),
                    'before_sidebar'=> '<div id="%1$s" class="widget-item %2$s" >',
                    'after_sidebar'	=> '</div>',
                    'before_widget' => '<div id="%1$s" class="widget %2$s">',
                    'after_widget' 	=> '</div>',
                    'before_title' 	=> '<h4 class="widget-title mb-2">',
                    'after_title'	=> '</h4>',
            )
        );

        //** 1.2.5. */
        register_sidebar( 
            array(
                    'name' 			=>__( 'Footer Five', 'law-corporate'),
                    'id' 			=> 'footer-5',
                    'class'         => 'footer-five footer-widget',
                    'description' 	=> __( ' The 5th footer item on the footer of the page ', 'law-corporate' ),
                    'before_sidebar'=> '<div id="%1$s" class="widget-item %2$s" >',
                    'after_sidebar'	=> '</div>',
                    'before_widget' => '<div id="%1$s" class="widget %2$s">',
                    'after_widget' 	=> '</div>',
                    'before_title' 	=> '<h4 class="widget-title mb-2">',
                    'after_title'	=> '</h4>',
            )
        );
    }
    add_action('widgets_init','lc_footer_widgets');
