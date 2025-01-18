<?php

/**
 *  * @package Law Corporate  - Contact Data and Footer Branding Customizr
 *
 * */

 // Exit if accessed directly
 if(! defined('ABSPATH')){ exit; }

    // A. Add Panel Container for Ads Slider customization
    $wp_customize->add_panel( 'contact_data', // Adds custom sections to the wordpress customizer
        array(
                'title' => __( 'Contact and Footer ', 'law-corporate' ),
                'description' => __( 'Manage site\'s contact outlook here', 'law-corporate' ),
                'priority' => 130,
                'capability' => 'edit_theme_options',
            ) 
    );

    // B. Add section for address customization
    $wp_customize->add_section( 'contact_map', // Slide section one
        array(
			    'title' => __( 'Contact Map', 'law-corporate' ),
			    'description' => __( 'Manage contact address information here', 'law-corporate' ),
			    'panel' => 'contact_data',
			    'priority' => 10,
			    'capability' => 'edit_theme_options',
		    ) 
	  );
		
	  // B.1.a. Add setting for address line one  
	  $wp_customize->add_setting( 'map_url', // 
      array(
          'type' => 'theme_mod', // or 'option'
          'capability' => 'edit_theme_options',
          'default' => '',
          'transport' => 'refresh',
          'sanitize_callback' => 'esc_url_raw'
        )    
    );       //add setting  
      
	// B.1.b. Add control for address line one    
	$wp_customize->add_control( 'map_url' , // 
		array(
				'type' => 'text', // or 'option'
				'label' => __( 'Map iFrame URL',  'law-corporate' ),
				'priority' => 5, // Within the section.
				'description' => esc_html__( 'Enter apartment No, building details and or street name here e.g. Apartment 2, House 40.', 'law-corporate'),
				'section' => 'contact_map', // Required, core or custom.
				'setting' => 'map_url', // Required, core or custom.
			)
	);

 // B. Add section for address customization
$wp_customize->add_section( 'contact_address', // Slide section one
  array(
          'title' => __( 'Contact Address', 'law-corporate' ),
			    'description' => __( 'Manage contact address information here', 'law-corporate' ),
			    'panel' => 'contact_data',
			    'priority' => 20,
			    'capability' => 'edit_theme_options',
	) 
);
		
// B.1.a. Add setting for address line one  
$wp_customize->add_setting( 'address_line_1', // 
		array(
				'type' => 'theme_mod', // or 'option'
				'capability' => 'edit_theme_options',
				'default' => '',
				'transport' => 'refresh',
				'sanitize_callback' => 'sanitize_text_field'
	  )    
);       //add setting  
	  
	  // B.1.b. Add control for address line one    
	  $wp_customize->add_control( 'address_line_1' , // 
		array(
				'type' => 'text', // or 'option'
				'label' => __( 'Address Line 1',  'law-corporate'),
				'priority' => 5, // Within the section.
				'description' => esc_html__( 'Enter apartment No, building details and or street name here e.g. Apartment 2, House 40.',  'law-corporate'),
				'section' => 'contact_address', // Required, core or custom.
				'setting' => 'address_line_1', // Required, core or custom.
			)
	  );       
		
	  // B.2.a. Add setting for address line two  
	  $wp_customize->add_setting( 'address_line_2', // 
		array(
				'type' => 'theme_mod', // or 'option'
				'capability' => 'edit_theme_options',
				'default' => '',
				'transport' => 'refresh',
				'sanitize_callback' => 'sanitize_text_field'
			)    
	    );       //add setting  
	  
	  // B.2.b. Add control for address line two one    
	  $wp_customize->add_control( 'address_line_2' , // 
		array(
				'type' => 'text', // or 'option'
				'label' => __( 'Address Line 2', 'law-corporate' ),
				'priority' => 5, // Within the section.
				'description' => esc_html__( 'Enter street name, nearest landmark or stop here e.g. Bale Street, CMD Boulevard.',  'law-corporate'),
				'section' => 'contact_address', // Required, core or custom.
				'setting' => 'address_line_2', // Required, core or custom.
			)
	  );                   
		
	  // B.3.a. Add setting for address line two  
	  $wp_customize->add_setting( 'address_line_3', // 
		array(
				'type' => 'theme_mod', // or 'option'
				'capability' => 'edit_theme_options',
				'default' => '',
				'transport' => 'refresh',
				'sanitize_callback' => 'sanitize_text_field'
			)    
	    );       //add setting  
	  
	  // B.3.b. Add control for address line two one    
	  $wp_customize->add_control( 'address_line_3' , // 
		array(
				'type' => 'text', // or 'option'
				'label' => __( 'Locality, Area or Neighbourhood',  'law-corporate'),
				'priority' => 5, // Within the section.
				'description' => esc_html__( 'Enter neighbourhood or locality here e.g. Central Business District, Alausa.',  'law-corporate'),
				'section' => 'contact_address', // Required, core or custom.
				'setting' => 'address_line_3', // Required, core or custom.
			)
	  );                   
		
	  // B.4.a. Add setting for address line two  
	  $wp_customize->add_setting( 'address_line_4', // 
		array(
				'type' => 'theme_mod', // or 'option'
				'capability' => 'edit_theme_options',
				'default' => '',
				'transport' => 'refresh',
				'sanitize_callback' => 'sanitize_text_field'
			)    
	    );       //add setting  
	  
	  // B.4.b. Add control for address line two one    
	  $wp_customize->add_control( 'address_line_4' , // 
		array(
				'type' => 'text', // or 'option'
				'label' => __( 'City/Town, State',  'law-corporate'),
				'priority' => 5, // Within the section.
				'description' => esc_html__( 'Enter City, Town, State or region here e.g. Mushin, Lagos, Alabama.',  'law-corporate'),
				'section' => 'contact_address', // Required, core or custom.
				'setting' => 'address_line_4', // Required, core or custom.
			)
	  );             

    // C. Add section for phone and email customization
    $wp_customize->add_section( 'phone_email', // Slide section one
    array(
            'title' => __( 'Phone/Email',  'law-corporate'),
            'description' => __( 'Manage phone and email information here', 'law-corporate' ),
            'panel' => 'contact_data',
            'priority' => 30,
            'capability' => 'edit_theme_options',
        ) 
    );
          
    // $sanitize_phone = preg_replace('/[^0-9]/', '', '') ;    
    // C.1.a. Add setting for address line one  
    $wp_customize->add_setting( 'phone', // 
        array(
                'type' => 'theme_mod', // or 'option'
                'capability' => 'edit_theme_options',
                'default' => '',
                'transport' => 'refresh',
                'sanitize_callback' => 'absint'
            )    
        );       //add setting  


    // C.1.b. Add control for address line one    
    $wp_customize->add_control( 'phone' , // 
        array(
                'type' => 'text', // or 'option'
                'label' => __( 'Phone No.',  'law-corporate'),
                'priority' => 5, // Within the section.
                'description' => esc_html__( 'Enter contact phone number here e.g. 8023456789',  'law-corporate'),
                'section' => 'phone_email', // Required, core or custom.
                'setting' => 'phone', // Required, core or custom.
            )
    );       
    
    // C.2.a. Add setting for address line two  
    $wp_customize->add_setting( 'email', // 
        array(
                'type' => 'theme_mod', // or 'option'
                'capability' => 'edit_theme_options',
                'default' => '',
                'transport' => 'refresh',
                'sanitize_callback' => 'sanitize_email'
            )    
    );        
  
    // C.2.b. Add control for address line two one    
    $wp_customize->add_control( 'email' , // 
        array(
                'type' => 'text', // or 'option'
                'label' => __( 'Email',  'law-corporate'),
                'priority' => 5, // Within the section.
                'description' => esc_html__( 'Enter contact email address here e.g. mail@example.com.', 'law-corporate'),
                'section' => 'phone_email', // Required, core or custom.
                'setting' => 'email', // Required, core or custom.
            )
    );  
  
    // D. Add section for Footer Branding Customization
    $wp_customize->add_section('brand_section', array(
        'title' => __('Footer Branding', 'law-corporate' ),
        'panel' => 'contact_data',
        'description' => __('Manage footer branding entries here', 'law-corporate'),
        'priority' => 40,
    ));

    // D.1.a Add setting for footer logo image 
    $wp_customize->add_setting('brand_image', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    // D.1.b Add control for footer logo image 
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'brand_image_control', array(
        'label' => __('Large Screen Footer logo', 'law-corporate'),
        'section' => 'brand_section',
        'settings' => 'brand_image',
    )));

    // D.2.a. Add setting for footer logo image 
    $wp_customize->add_setting('brand_image_mobile', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    // D.2.b Add control for footer logo image 
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'brand_image_mobile_control', array(
        'label' => __('Mobile Screen Footer logo', 'law-corporate'),
        'section' => 'brand_section',
        'settings' => 'brand_image_mobile',
    )));

    // D.2.a Add setting for statement of purpose 
    $wp_customize->add_setting('statement_of_purpose', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));

    // D.2.b Add control for statement of purpose 
    $wp_customize->add_control('statement_of_purpose_control', array(
        'label' => __('Statement of Purpose', 'law-corporate'),
        'section' => 'brand_section',
        'settings' => 'statement_of_purpose',
        'type' => 'textarea',
    ));

    // E. Add section for social media profile items
    $wp_customize->add_section('social_media', array(
        'title' => __('Social Media Profiles', 'law-corporate' ),
        'panel' => 'contact_data',
        'description' => __('Manage social media item entries here', 'law-corporate' ),
        'priority' => 50,
    ));

    // // E.1.a Add setting and control for social media items link
    $social_media_platforms = array('behance', 'facebook', 'github', 'instagram', 'linkedin', 'pinterest', 'tiktok', 'x-twitter', 'youtube'); // Add more platforms if needed

    foreach ($social_media_platforms as $platform) {

        // items setting
        $wp_customize->add_setting($platform . '_link', array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        ));

        // items control
        $wp_customize->add_control($platform . '_link_control', array(
            'label' => ucfirst($platform) . __('Link', 'law-corporate'),
            'section' => 'social_media',
            'settings' => $platform . '_link',
            'type' => 'text',
        ));

    }