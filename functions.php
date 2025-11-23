<?php 

/**
 * This the themes functions file
 *
 * This is the frontpage template file of the WordPress theme
 *
 *
 * @package WordPress
 * @subpackage Law Corporate
 * @since Law Corporate 1.0.0
 *
 * 
 * +++++++++++++++++++++++++++++++++++++++++++++++++++
 * +	 	   THEME FUNCTIONS & WIDGETS	         +
 * +++++++++++++++++++++++++++++++++++++++++++++++++++
 * 
 * */

 // Exit if accessed directly
if(!defined('ABSPATH')){ exit; }

	/********************************************************************************************
	 * 1.0. THEME CONSTANTS	                    												*
	*********************************************************************************************/
	
    //    define('LC_VERSION', '1.0.1');
    //    define('LC_ROOT', str_replace(ABSPATH, '/', __DIR__));
    //    define('LC_PATH', __DIR__);
    //    define('LC_URI', home_url(LC_ROOT));
    //    define('LC_HMR_HOST', 'http://localhost:5173');
    //    define('LC_ASSETS_PATH', LC_PATH . '/dist');
    //    define('LC_ASSETS_URI', LC_URI . '/dist');
    //    define('LC_RESOURCES_PATH', LC_PATH . '/resources');
    //    define('LC_RESOURCES_URI', LC_URI . '/resources');

	function get_theme_version() {

		// Get theme data
		$theme = wp_get_theme();
	
		// Get the version
		$theme_version = $theme->get( 'Version' );
	
		// Return the version. If nothing is found return null
		return $theme_version;

	}

	if ( ! function_exists( 'lc_translate_setup' ) ) {	// Check if the function exists to prevent fatal errors in child themes
			
		function lc_translate_setup() {

			/*
			* Make theme available for translation.
			* Translations can be filed in the /languages/ directory.
			* If you're building a theme based on Law Corporate, use a find and replace
			* to change 'law-corporate' to the name of your theme in all the template files.
			*/

			load_theme_textdomain( 'law-corporate', get_template_directory() . '/languages' );
		
			// This is important for themes that also support RTL languages
			load_child_theme_textdomain( 'law-corporate', get_stylesheet_directory() . '/languages' );
			
		}

	}
	add_action( 'after_setup_theme', 'lc_translate_setup' );;
		

	/********************************************************************************************
	 * 2.0. REGISTER STYLESHEETS AND SCRIPTS													*
	*********************************************************************************************/
	
	// 2.1. register and enqueue theme stylesheets
	function lc_enqueue_theme_styles(){

		$version = get_theme_version();

		if(!is_admin()){

			wp_register_style('lc-stylesheet', get_template_directory_uri() . '/style.css', array(), $version, 'all');
			wp_enqueue_style('lc-stylesheet');
			wp_register_style('lc-app-style', get_template_directory_uri() . '/public/css/app.css', array(), $version, 'all');
			wp_enqueue_style('lc-app-style'); 

 			wp_register_style('lc-fontawesome', get_template_directory_uri() . '/public/css/fonteawesome-6.5.2-all.min.css', array(), "6.5.2", 'all');
			wp_enqueue_style('lc-fontawesome'); 
 
 			wp_register_style('lc-custom-fonts',  '//fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');
			wp_enqueue_style('lc-custom-fonts'); 
 
			wp_register_style('lc-swiper-style', get_template_directory_uri() . '/public/css/swiper.bundle.css', array(), '11.2.10', 'all');
			wp_enqueue_style('lc-swiper-style'); 

		}

	}
	add_action('wp_enqueue_scripts', 'lc_enqueue_theme_styles');


	// 2.2. register and enqueue theme's external javascripts
 	function lc_enqueue_theme_javascript(){
	
		$version = get_theme_version();
	
		if(!is_admin()){
				
			wp_enqueue_script('jquery');						
			wp_register_script('lc-custom-scripts', get_template_directory_uri() . '/public/js/app.js', array('jquery', ), $version, true);
			wp_enqueue_script('lc-custom-scripts');;

			wp_register_script('lc-form-validate', get_template_directory_uri() . '/public/js/jquery.validate.min.js', array('jquery', ), null, true);
			wp_enqueue_script('lc-form-validate');	

			wp_register_script('lc-counter-up-init', get_template_directory_uri() . '/public/js/counterUp.js', array('jquery', ), $version, true);
			wp_enqueue_script('lc-counter-up-init');

			wp_register_script('lc-swiper-js', get_template_directory_uri() . '/public/js/swiper.min.js', array('jquery', ), '11.2.10', true);
			wp_enqueue_script('lc-swiper-js');

		}

	}
	add_action('wp_enqueue_scripts', 'lc_enqueue_theme_javascript');
		
	// Enqueue admin items CSS styles
	function lc_enqueue_admin_cssextra() {
			
		$version = get_theme_version();

		wp_register_style('lc-admin-extra', get_stylesheet_directory_uri() . '/public/css/admin-styles.css', array(), $version, false);
		wp_enqueue_style('lc-admin-extra'); 

		wp_register_style('lc-fontawesome', get_stylesheet_directory_uri() . '/public/css/fonteawesome-6.5.2-all.min.css', array(), '6.5.2', 'all');
		wp_enqueue_style('lc-fontawesome'); 


	}
	add_action('admin_enqueue_scripts', 'lc_enqueue_admin_cssextra');


	// Enqueue admin item scripts
	function lc_enqueue_admin_jsextra($hook) {

		global $post;
			
		$version = get_theme_version();
		
		wp_enqueue_media(); // Loads the default WordPress media uploader scripts
		
		wp_enqueue_script('suc-toggle-switch', get_template_directory_uri() . '/public/js/admin-scripts.js', array('jquery'), $version, true);

			
	}
	add_action('admin_enqueue_scripts', 'lc_enqueue_admin_jsextra');
	


	//	function enqueue_value_props_meta_box_scripts($hook) {

	//	global $post;


	//	}
	//	add_action('admin_enqueue_scripts', 'enqueue_value_props_meta_box_scripts');

	//	function enqueue_taxonomy_media_library() {


	//	}
	//	add_action('admin_enqueue_scripts', 'enqueue_taxonomy_media_library');
		
	
	
	
	/********************************************************************************************
	 * 3.0. THEME'S SITE AND CUSTOMISATIONS														*
	*********************************************************************************************/
	
	//3.1. Activates Support for Theme's Custom Logo Setup
	if ( ! function_exists( 'lc_custom_logo' ) ) {
		
		function lc_custom_logo() {

			// Custom image size created somewhere in your code.
			add_image_size( 'custom-image-size' , '' , '' , true );
				
			$defaults = array(
				'height' => 'custom-image-size',
				'width' => 'custom-image-size',
				'flex-height' => true,
				'flex-width' => true,
				'class' => 'logo',
				'header-text' => array( 'site-title', 'site-description' ),
				'unlink-homepage-logo' => false,
			);
			add_theme_support( 'custom-logo', $defaults );

		}
		add_action( 'after_setup_theme' , 'lc_custom_logo' );
		
	}

	//3.2. Activate Support for Theme's Site Logo and Name Customization Setup
	if ( ! function_exists( 'lc_site_brand' ) ) {

		function lc_site_brand(){

			if ( has_custom_logo() ) {

				$logo = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' , 0) , 'full' );
				echo '<a class="'. esc_attr('app-brand-logo') .'" href="' . esc_url(get_home_url()) . '" >';
				echo '<img class="'. esc_attr('img-fluid app-brand-logo-img') .'" src="'. esc_url( $logo[0] ) .'" width="' . $logo[1] . '" height="' . $logo[2] . '" alt="' . get_bloginfo( 'name' ) . '">';
				echo "</a>"; 
			} 

			else {
				
				echo '<a href="' . esc_url(get_home_url() ). '" class="'. esc_attr('app-brand-name') .'" >';
				echo '<h2>' . esc_html(get_bloginfo( 'name' )) . '</h2>';
				echo '</a>';
				echo '<span class="'. esc_attr('app-brand-tagline') .'" >' . esc_html(get_bloginfo( 'description' )) . '</span>';			
			}

		}

	}
	
	//3.3. Activates Support for Theme's Header Background Image
	if ( ! function_exists( 'lc_blogpage_header' ) ) {
		
		function lc_blogpage_header() {
				
			$defaults = array(
				'default-image' => get_template_directory_uri() . '/public/images/industrial-concept.webp',
				'height' => 'custom-image-size',
				'width' => 'custom-image-size',
				'flex-height' => true,
				'flex-width' => true,
				'header-text' => true,
			//	'default-text-color' => '#fff',
				'uploads' => false,
				'wp-head-callback' => '',
				'admin-head-callback' => '',
				'admin-preview-callback' => '',
			);
			add_theme_support( 'custom-header', $defaults );

		}
		add_action( 'after_setup_theme' , 'lc_blogpage_header' );
		
	}
	
	//3.4. Activates Support for Theme's Header Background Image
	if ( ! function_exists( 'lc_frontpage_header' ) ) {
		
		function theme_frontpage_banner() {
											
				// Render the Slider Image and Content 							

				// 1. Slider . $i Image Set
				$banner_image = esc_url(get_template_directory_uri() . '/public/images/industrial-concept.webp'); // 
				if (get_theme_mod('front_banner_image','') != '') 
				{
					$banner_image = wp_get_attachment_url(get_theme_mod('front_banner_image', 0));
				} 

				$banner_video = ''; // 
				if (get_theme_mod('front_banner_video','') != '') 
				{
					$banner_video = wp_get_attachment_url(get_theme_mod('front_banner_video', 0));
				} 

				// 3. Banner Title and Texts
				$banner_title = __('Best in Class Advisory Services', 'law-corporate'); 
				if(get_theme_mod('front_banner_title', 0) !='')
				{
					$banner_title = get_theme_mod('front_banner_title', 0);
				}

				$banner_details = __('Some representative placeholder content for the slide. Some more representative placeholder content for the slide.', 'law-corporate');                             
				if(get_theme_mod('front_banner_details', 0) !='')
				{
					$banner_details = get_theme_mod('front_banner_details', 0);
				}

				// 4. Slide Buttons
				$button_url = get_theme_mod('front_banner_url', 0); 
				$button_label = get_theme_mod('front_banner_label', 0); 
				
		}
		add_action('', 'theme_frontpage_banner');
		
	}

	/********************************************************************************************
	* 4.0. ACTIVATES THEME'S WORDPRESS SUPPORT FEATURES MORE									*
	*********************************************************************************************/
	if (!function_exists('law_corporate_features_support')) {

		function law_corporate_features_support(){
			// 4.1. Activates Supports for Custom Menu

			// 4.1.1. Register's Location for 4 Navigation Menus
				$locations = array(
					'primary'  => __( 'Primary Menu', 'law-corporate' ),
					'expanded' => __( 'Expanded Menu', 'law-corporate' ),
					'mobile'   => __( 'Mobile Menu', 'law-corporate' ),
					'footer'   => __( 'Footer Menu', 'law-corporate' ),
					'social'   => __( 'Social Menu', 'law-corporate' ),
				);
			// 4.1.2. Register's Location for 4 Navigation Menus
			register_nav_menus( $locations );

			// 4.2. HTML5 Search: activate Theme's search form 
			add_theme_support('html5', array('search-form'));

			// 4.3. HTML5 Search: activate Theme's search form 
			add_theme_support('post-thumbnails');

			add_theme_support( "wp-block-styles" );

			// 4.4.  add <title> tag support
			add_theme_support( "title-tag" ) ;

			add_theme_support( 'automatic-feed-links' );

			add_theme_support( "responsive-embeds" );

		//	add_theme_support( "custom-background", /**$args*/ );

			add_theme_support( "align-wide" );
			
			// 4.4. Custom Header Activate Theme's search form 
			//add_theme_support('post-formats', array('aside', 'gallery', 'link' ));

		}
		add_action('init', 'law_corporate_features_support');
	
	}
		
	/********************************************************************************************
	* 5.0. LOAD THEME'S CUSTOM FUNCTIONS AND MORE												*
	*********************************************************************************************/
	//** 5.1. Activate theme's support for Walker Class */
	//	require get_template_directory() . '/inc/walkerNav.php';	
	if ( file_exists( get_template_directory() . '/inc/walkerNav.php' ) ){
		require get_template_directory() . '/inc/walkerNav.php';	
	}

	//** 5.2. Activate theme's support for added functionalities */	
	if ( file_exists( get_template_directory() . '/inc/themeCustomizr.php' ) ){
		require get_template_directory() . '/inc/themeCustomizr.php';	
	}

	//** 5.3. Activate theme's support for added functionalities */	
	if ( file_exists( get_template_directory() . '/inc/themeUtils.php' ) ){
		require get_template_directory() . '/inc/themeUtils.php';	
	}

	/********************************************************************************************
	 * 6.0. LOAD THEME'S WIDGETS AND MORE														*
	*********************************************************************************************/
	//** 5.1. Activates Theme's widgets*/
	if ( ! file_exists( get_template_directory() . '/lib/themeWidgets.php' ) ){
		
		error_log( 'Theme\'s widget library is missing in theme: ' . get_template_directory()); 

	}else{

		require_once get_template_directory() . '/lib/themeWidgets.php';

	}


	/********************************************************************************************
	 * 7.0. LOAD THEME'S WIDGETS AND MORE														*
	*********************************************************************************************/
	// ** 7.1. Activates Theme's plugin activation library */
	if ( ! file_exists( get_template_directory() . '/inc/tgm-activation/class-tgm-plugin-activation.php' ) ) {

		error_log( 'Critical Error: TGM Plugin Activation library is missing in theme: ' . get_template_directory()); // Or use wp_die()

	} else {

		require_once get_template_directory() . '/inc/tgm-activation/class-tgm-plugin-activation.php';

	}

	// 7.2. Activates Theme's custom plugin registrar (if needed) */
	if ( ! file_exists( get_template_directory() . '/inc/tgm-activation/class-tgm-plugin-registrar.php' ) ) {

		error_log( 'Critical Error: TGM Plugin Registration library is missing in theme: ' . get_template_directory()); // Or use wp_die()

	} else {

		require_once get_template_directory() . '/inc/tgm-activation/class-tgm-plugin-registrar.php';

	}