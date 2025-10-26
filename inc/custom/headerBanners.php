<?php

/**
 * 
 *   * Header Banner
 * 
 * @package WordPress
 * @subpackage Law Corporate
 * @since Law Corporate 1.0.0
 *
 * */

 // Exit if accessed directly
if(!defined('ABSPATH')){ exit; }

  /** 1. **/

	  // A. Add section for Slide one customization
	  $wp_customize->add_section( 'front_banner' , // Slide section one
		array(
				'title' => __( 'FrontPage Banner Settings', 'law-corporate' ),
				'description' => __( 'Manage the Homepage banner and contents here, please', 'law-corporate' ),
		//		'panel' => 'ads_slides',
				'priority' => 60,
				'capability' => 'edit_theme_options',
			) 
	  );
		
	  // A.1.a. Add setting for Slide one toggler - activate/deactivate Slide  
	  $wp_customize->add_setting( 'front_banner_toggler', // 
		array(
				'type' => 'theme_mod', // or 'option'
				'capability' => 'edit_theme_options',
				'default' => '',
				'transport' => 'refresh',
				'sanitize_callback' => 'absint'
			)    
	  );       //add setting  
	  
	  // A.1.b. Add control for Slide one toggler - activate/deactivate Slide    
	  $wp_customize->add_control( 'front_banner_toggler' , // 
		array(
				'type' => 'checkbox', // or 'option'
				'label' => __( 'Banner Toggler', 'law-corporate' ),
				'priority' => 5, // Within the section.
				'description' => esc_html__( 'Check the box to turn-off the Banner' , 'law-corporate' ),
				'section' => 'front_banner', // Required, core or custom.
				'setting' => 'front_banner_toggler', // Required, core or custom.
			)
	  );       //add control

	  // A.2.a. Add setting for Banner background image customization
	  $wp_customize->add_setting( 'front_banner_image', // define setting for Slide one
		array( 
			  'type' => 'theme_mod', // or 'option'
			  'capability' => 'edit_theme_options',
			  'theme_supports' => '', // Rarely needed.
		//	  'default' => '',
			  'transport' => 'refresh', // or postMessage
			  'sanitize_callback' => 'absint',
			  'sanitize_js_callback' => 'absint', // Basically to_json.
			) 
	  );
	  
	  // A.2.b. Add control for Banner background image customization
	  $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'front_banner_image', 
		array(
			  'label'             =>  __( 'Banner Image', 'law-corporate' ),
			  'description'       =>  __( 'Upload images and videos contents here, please', 'law-corporate'),
			  'section'           => 'front_banner',
			  'setting'           => 'front_banner_image',
			  'type'              => 'media',
			  'media_mime_type'   => array(
											'png'           =>'image/png', 
											'jpg|jpeg|jpe'  =>'image/jpg', 
											'webp'          =>'image/webp', 
											'webm'          =>'video/webm', 
											'mp4|m4v'       =>'video/mp4', 
											'flv'           =>'video/x-flv', 
											'asf|asx'       =>'video/x-ms-asf', 
											'wmv'           =>'video/x-ms-wmv', 
											'avi'           =>'video/avi', 
										  ),
			  'priority'      => 10,
			  'button_labels' => array( // Optional
										'select'        => __( 'Select File', 'law-corporate' ),
										'change'        => __( 'Change File', 'law-corporate'  ),
										'default'       => __( 'Default', 'law-corporate'),
										'remove'        => __( 'Remove', 'law-corporate'),
										'placeholder'   => __( 'No file selected', 'law-corporate' ),
										'frame_title'   => __( 'Select File', 'law-corporate'),
										'frame_button'  => __( 'Choose File', 'law-corporate' ),
									  ),
			) 
		  ) 
		);

	  // A.3.a. Add setting for banner Video customization
	  $wp_customize->add_setting( 'front_banner_video', // define setting for Slide one
		array( 
			  'type' => 'theme_mod', // or 'option'
			  'capability' => 'edit_theme_options',
			  'theme_supports' => '', // Rarely needed.
			  'default' => '',
			  'transport' => 'refresh', // or postMessage
			  'sanitize_callback' => 'absint',
			  'sanitize_js_callback' => 'absint', // Basically to_json.
			) 
	  );
	  
	  // A.3.b. Add control for banner video customization
	  $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'front_banner_video', 
		array(
			  'label'             =>  __( 'Banner Video Background', 'law-corporate' ),
			  'description'       =>  __( 'Accepts images and videos contents here, please', 'law-corporate'  ),
			  'section'           => 'front_banner',
			  'setting'           => 'front_banner_video',
			  'type'              => 'media',
			  'media_mime_type'   => array(
											'png'           =>'image/png', 
											'jpg|jpeg|jpe'  =>'image/jpg', 
											'webp'          =>'image/webp', 
											'webm'          =>'video/webm', 
											'mp4|m4v'       =>'video/mp4', 
											'flv'           =>'video/x-flv', 
											'asf|asx'       =>'video/x-ms-asf', 
											'wmv'           =>'video/x-ms-wmv', 
											'avi'           =>'video/avi',  
										  ),
			  'priority'      => 12,
			  'button_labels' => array( // Optional
										'select'        => __( 'Select File', 'law-corporate' ),
										'change'        => __( 'Change File', 'law-corporate'  ),
										'default'       => __( 'Default', 'law-corporate'),
										'remove'        => __( 'Remove', 'law-corporate'),
										'placeholder'   => __( 'No file selected', 'law-corporate'),
										'frame_title'   => __( 'Select File', 'law-corporate'),
										'frame_button'  => __( 'Choose File', 'law-corporate' ),
									  ),
			) 
		  ) 
		);

	  // A.4.a. Add setting for banner caption title cstomization
	  $wp_customize->add_setting( 'front_banner_title', // define setting for Slide one
		  array( 
				  'type' => 'theme_mod', // or 'option'
				  'capability' => 'edit_theme_options',
				  'theme_supports' => '', // Rarely needed.
				  'default' => '',
				  'transport' => 'refresh', // or postMessage
				  'sanitize_callback' => 'sanitize_text_field',
				  'sanitize_js_callback' => 'sanitize_text_field', // Basically to_json.
			  ) 
	  );

	  // A.4.b. Add control for Slide one caption title customization
	  $wp_customize->add_control( 'front_banner_title', // define a control item for Slide one 
		  array(
				  'type' => 'text',
				  'label' => __( 'Banner Headline Texts', 'law-corporate' ),
				  'description' => __( 'Enter the headline information of the Banner here.', 'law-corporate'  ),
				  'section'     => 'front_banner',
				  'setting'     => 'front_banner_title',
				  'priority' => 25, // Within the section.
				  'input_attrs' => array(
										  'class' => 'my-custom-class-for-js',
										  'style' => 'border: 1px solid #900',
										  'placeholder' => '',
										),
				  'active_callback' => '',
			  ) 
	  );

	  // A.5.a. Add setting for Slide one caption details customization
	  $wp_customize->add_setting( 'front_banner_details', // define setting for Slide
		  array( 
				  'type' => 'theme_mod', // or 'option'
				  'capability' => 'edit_theme_options',
				  'theme_supports' => '', // Rarely needed.
				  'default' => '',
				  'transport' => 'refresh', // or postMessage
				  'sanitize_callback' => 'wp_filter_nohtml_kses',
				  'sanitize_js_callback' => 'wp_filter_nohtml_kses', // Basically to_json.
			  ) 
	  );

	  // A.5.b. Add control for Slide one caption details customization
	  $wp_customize->add_control( 'front_banner_details', // define a control item for Slide one 
		  array(
				'type' => 'textarea',
				'label' => __( 'Banner Descriptive Texts', 'law-corporate' ),
				'description' => __( 'Enter a brief description of the Banner here.', 'law-corporate'  ),
				'section' => 'front_banner', // Required, core or custom.
				'setting' => 'front_banner_details', // Required, core or custom.
				'priority' => 30, // Within the section.
				'input_attrs' => array(
										'class' => 'my-custom-class-for-js',
										'style' => 'border: 1px solid #900',
										'placeholder' => '',
									  ),
				'active_callback' => '',
			) 
	  );

	  // A.6.a. Add setting for Slide one CTA button one URL customization
	  $wp_customize->add_setting( 'front_banner_url', // define subtitle setting for Slide
		  array( 
				'type' => 'theme_mod', // or 'option'
				'capability' => 'edit_theme_options',
				'theme_supports' => '', // Rarely needed.
				'default' => '',
				'transport' => 'refresh', // or postMessage
				'sanitize_callback' => 'sanitize_text_field',
				'sanitize_js_callback' => 'sanitize_text_field', // Basically to_json.
			  ) 
	  );

	  // A.6.b. Add control for Slide one CTA button one URL/shortcode customization
	  $wp_customize->add_control( 'front_banner_url', // define subtitle control item for Slide
		  array(
				'type' => 'text',
				'label' => __( 'Banner CTA URL', 'law-corporate' ),
				'description' => __( 'Enter the url/shortcode the CTA button would link to.', 'law-corporate'  ),
				'section' => 'front_banner', // Required, core or custom.
				'setting' => 'front_banner_url', // Required, core or custom.
				'priority' => 35, // Within the section.
				'input_attrs' => array(
										'class' => 'my-custom-class-for-js',
										'style' => 'border: 1px solid #900',
										'placeholder' => '',
									  ),
				'active_callback' => '',
			) 
	  );

	  // A.7.a. Add setting for Slide one CTA button one customization
	  $wp_customize->add_setting( 'front_banner_label', // define subtitle setting for Slide
		  array( 
				'type' => 'theme_mod', // or 'option'
				'capability' => 'edit_theme_options',
				'theme_supports' => '', // Rarely needed.
				'default' => '',
				'transport' => 'refresh', // or postMessage
				'sanitize_callback' => 'sanitize_text_field',
				'sanitize_js_callback' => 'sanitize_text_field', // Basically to_json.
			  ) 
	  );

	  // A.7.b. Add control for Slide one CTA button one customization
	  $wp_customize->add_control( 'front_banner_label', // define subtitle control item for Slide
		  array(
				'type' => 'text',
				'label' => __( 'Banner URL Label', 'law-corporate' ),
				'description' => __( 'Enter the label text the CTA button identifies.', 'law-corporate'  ),
				'section' => 'front_banner', // Required, core or custom.
				'setting' => 'front_banner_label', // Required, core or custom.
				'priority' => 40, // Within the section.
				'input_attrs' => array(
										'class' => 'my-custom-class-for-js',
										'style' => 'border: 1px solid #900',
										'placeholder' => '',
									  ),
				'active_callback' => '',
			) 
	  );  