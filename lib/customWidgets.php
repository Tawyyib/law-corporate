<?php 

/**
 * Plugin Name: Custom Widgets Plugin
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
    * 2.1. Footer Branding Widget                              *
    ************************************************************/  

    class FooterBrandingWidget extends WP_Widget {

        // Widget constructor function
        function __construct() {

            parent::__construct(

                // Base ID
                'footer_branding', 
                
                // Widget name
                __( 'Footer Branding', 'law-corporate' ), 
                
                // Widget description
                array( 'description' => __( 'Display the footer brand logo, and statement of purpose.', 'law-corporate' ) ) 
           
            );
       
        }
    
        // Widget frontend display function
        function widget( $args, $instance ) {

            // Display widget TItle
            $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base ); // Get widget title (optional)
    
            // Display widget opening tag
            echo $args['before_widget'];
    
            if ( ! empty( $title ) ) {

                // Display widget title if set
                echo $args['before_title'] . esc_html( $title ) . $args['after_title'];

            }
    
            // Call your function to generate brand info (ensure function exists)
            if ( function_exists( 'lc_footer_branding' ) ) {

                lc_footer_branding();

            } else {

                echo '<p>' . esc_html__( 'Branding function not available.', 'law-corporate' ) . '</p>';

            }
    
            // Display widget closing tag
            echo $args['after_widget'];
        }
    
        // Widget backend form function (optional)
        function form( $instance ) {

            $title = !empty( $instance['title'] ) ? $instance['title'] : ''; // Default title

            ?>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html__( 'Title:', 'law-corporate' ); ?></label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
            </p>
            <?php
            
        }
    
        // Widget settings update function (optional)
        function update( $new_instance, $old_instance ) {
            $instance = $old_instance;
            $instance['title'] = sanitize_text_field( $new_instance['title'] );
            return $instance;
        }
    
    }
    
    // Register the widget
    function register_FooterBrandingWidget() {
        register_widget( 'FooterBrandingWidget' );
    }
    add_action( 'widgets_init', 'register_FooterBrandingWidget' );
    
    
    /***********************************************************
    * 2.2. Social Media Items Widget                           *
    ************************************************************/ 

    class SocialMediaItemsWidget extends WP_Widget {

        // Widget constructor function
        function __construct() {

            parent::__construct(

                // Base ID
                'social_media_widget',  

                    // Widget name
                __( 'Social Media Items', 'law-corporate' ),  

                // Widget description
                array( 'description' => __( 'Display social media icons and links.', 'law-corporate' ) )  

            );

        }
    
        // Widget frontend display function
        function widget( $args, $instance ) {

            // Get widget title (optional)
            $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'] );
    
            // Display Widget Opening Tag - Safe access to widget structure
            echo $args['before_widget']; 
    
            if ( ! empty( $title ) ) {

                // Display widget title if set
                echo $args['before_title'] . esc_html( $title ) . $args['after_title'];

            }
    
            // Ensure this function exists - Check if the widget function exists
            if ( function_exists( 'lc_SocialMediaItems' ) ) {

                // Display widget content if function exists
                lc_SocialMediaItems();

            } else {

                // Display alternate content
                echo __( 'Social media items function not found.', 'law-corporate' );

            }
    
            // Display Widget Closing Tag
            echo $args['after_widget'];

        }
    
        // Widget backend form function (optional)
        function form( $instance ) {

            $title = isset( $instance['title'] ) ? $instance['title'] : '';

            ?>
            <p>
                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'law-corporate' ); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
            </p>
            <?php
        }
    
        // Widget settings update function (optional)
        function update( $new_instance, $old_instance ) {
            $instance = $old_instance;
            $instance['title'] = sanitize_text_field( $new_instance['title'] );
            return $instance;
        }
    }
    
    function register_SocialMediaItemsWidget() {
        register_widget( 'SocialMediaItemsWidget' );
    }
    add_action( 'widgets_init', 'register_SocialMediaItemsWidget' );
    

        
    /***********************************************************
    * 2.3. Contact Address Widget                              *
    ************************************************************/         
    class ContactAddressWidget extends WP_Widget{

        // 1. Construct and declare Widget Function
        function __construct(){

            parent::__construct(
                
                // a. Base ID
                'contact_address', 
                
                // b. the widget's name
                __( 'Contact Address', 'law-corporate' ), 

                // c. widget's description
                array('description' => __('The widget display\'s the business address information', 'law-corporate') )
            );

        }

        // 2. Create Widget's Frontend Display/UI function
        function widget($args, $instance){

            // a. extract widget's argument
            extract( $args );

            // Get the title (Optional)
            $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base);

            // displays the widget opening tag
            echo $before_widget;
            
            // display's widget title if set
            if(! empty( $title )){

                echo $before_title . $title . $after_title;

            }

            // Call the function or Output The Main Widget Instance Here
            lc_contact_address();

            // display widget closing tag
            echo $after_widget;
        }

        // 3. Create Widget's Backend Forms and Input
        function form($instance){

            // instantiate widget form title
            $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
            if ( isset( $instance[ 'title' ] ) ) {
                $title = strip_tags($instance[ 'title' ]);
                }
                else {
                $title = __( '', 'law-corporate' );
                }

                // widget admin form
                ?>
                <p>
                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'law-corporate' ); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
                </p>
                <?php
        }

        // 4. Updating Widget, replacing old instances with new
        function update( $new_instance, $old_instance ) {
            $instance = $old_instance;
            $instance['title'] = sanitize_text_field( $new_instance['title'] );
            return $instance;
        }

    }
        
    // Register the widget
    function register_ContactAaddressWidget() {

        register_widget( 'ContactAddressWidget' );

    }
    add_action( 'widgets_init', 'register_ContactAaddressWidget' );