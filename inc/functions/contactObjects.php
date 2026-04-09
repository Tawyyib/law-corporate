<?php 
    /** 
     * CONTACT PAGE OBJECTS
     * Displays project details in a structured sidebar format
     */
  
    // A. Contact Information Layout
    if(!function_exists('lc_contact_map')){

        function lc_contact_map(){ 
        
            $map_url = get_theme_mod('map_url', 'law-cprporate');

            $map_canvas = '<div class="' . esc_attr(' map-canvas container-fluid ') . '" >';
                $map_canvas .= '<iframe  class="' . esc_attr('map-iframe') . '"';
                    $map_canvas .= 'src="' . esc_url($map_url) . '" frameborder="' . esc_attr(0) . '" allowfullscreen="' . esc_attr('') . '"';
                    $map_canvas .= 'loading="' . esc_attr('lazy') . '"';
                    $map_canvas .= 'referrerpolicy="' . esc_attr('no-referrer-when-downgrade') . '">';
                $map_canvas .= '</iframe>';
            $map_canvas .= '</div>';
    
            echo $map_canvas;
        
        }
        add_action('', 'lc_contact_map');

    }

    // A. Contact Information Layout
    if(!function_exists('lc_contact_info')){

        function lc_contact_info(){ 
        
            ?>

            <div class="<?php echo esc_attr('contact-details d-flex'); ?>">

                <!-- Contact Address Section -->
                <div class="<?php echo esc_attr('contact-address'); ?>" >

                    <span class="<?php echo esc_attr('contact-header'); ?>" ><i class="<?php echo esc_attr('fa-solid fa-location-dot'); ?>" ></i></span>
                
                    <?php lc_contact_address(); ?>               

                </div>
                
                <!-- Phone Number Section -->                
                <div class="<?php echo esc_attr('contact-phone'); ?>">

                    <span class="<?php echo esc_attr('contact-header'); ?>" ><i class="<?php echo esc_attr('fa-solid fa-phone'); ?>" ></i></span>
                    
                    <?php lc_contact_phone(); ?>               

                </div>          

                <!-- Email Address Section -->                
                <div class="<?php echo esc_attr('contact-mail'); ?>">
                    
                    <span class="<?php echo esc_attr('contact-header'); ?>" ><i class="<?php echo esc_attr('fa-solid fa-envelope'); ?>" ></i></span>
                    
                    <?php lc_contact_email(); ?>               
                    
                </div>             

            </div>          
        
        <?php
        
        }
        add_action('', 'lc_contact_info');

    }

    // B. Contact Address Object        
    if(!function_exists('lc_contact_address')){

        function lc_contact_address(){ 

            // Get site's address information
            $address_line_1 = get_theme_mod('address_line_1', 0);
            $address_line_2 = get_theme_mod('address_line_2', 0);
            $address_line_3 = get_theme_mod('address_line_3', 0);
            $address_line_4 = get_theme_mod('address_line_4', 0);
                      
            // Out site's address 
            $address = '<div class="' . esc_attr('contact-address-in') .'">';

                $address .= '<p class="' . esc_attr('address-lines') . '">';

                if(!empty($address_line_1)){

                    $address .= '<span>' . esc_html($address_line_1) . '</span>';

                }
                if(!empty($address_line_2)){

                    $address .= '<span>' . esc_html($address_line_2) . '</span>';

                }
                if(!empty($address_line_3)){

                    $address .= '<span>' . esc_html($address_line_3) . '</span>';

                }
                if(!empty($address_line_4)){

                    $address .= '<span>' . esc_html($address_line_4) . '</span>';
                    
                }

                $address .= '</p>';

            $address .= '</div>';

            echo $address;

        } 
        add_action('', 'lc_contact_address'); 

    }

              
    /**
     * A. Sanitize phone number (digits + leading + only)
     */
    if ( ! function_exists( 'lc_sanitize_phone' ) ) {

        function lc_sanitize_phone( $value ) {

            if ( empty( $value ) ) {
                return '';
            }

            $value = trim( $value );
            $value = preg_replace( '/[^0-9+]/', '', $value );

            // Prevent invalid numbers
            return strlen( $value ) < 7 ? '' : $value;
        }

    }
        
    /**
     * B. Fetch and sanitize multiple contact numbers
     */
    if ( ! function_exists( 'lc_get_contact_phones' ) ) {

        function lc_get_contact_phones() {

            // Default phone number (used when Customizer value is empty)
            $default_no = '802 345 6789';

            // Get site's phone number from Customizer
            $phone_no = get_theme_mod('phone');

            // Use default if empty
            $raw_phone = ! empty( $phone_no ) ? $phone_no : $default_no;

            $numbers = array_map( 'trim', explode( ',', $raw_phone ) );

            return array_filter(
                array_map( 'lc_sanitize_phone', $numbers )
            );

        }

    }

    /**
     * C. Normalize phone numbers (auto country detection)
     */
    if ( ! function_exists( 'lc_normalize_phone' ) ) {

        function lc_normalize_phone( $phone ) {

            if ( strpos( $phone, '+' ) === 0 ) {
                return [
                    'tel'     => $phone,
                    'display' => $phone,
                ];
            }

            // Default Nigeria (+234)
            $digits = ltrim( $phone, '0' );

            return [
                'tel'     => '+234' . $digits,
                'display' => '0' . $digits,
            ];
        }
    }

    /**
     * D. Render phone contacts with schema.org markup
     */
    if ( ! function_exists( 'lc_contact_phone' ) ) {

        function lc_contact_phone() {

            $phones = lc_get_contact_phones();

            if ( empty( $phones ) ) {
                return;
            }

            echo '<div class="contact-phones" itemscope itemtype="https://schema.org/Organization">';

            foreach ( $phones as $phone ) {

                $normalized = lc_normalize_phone( $phone );

                echo '<div itemprop="contactPoint" itemscope itemtype="https://schema.org/ContactPoint">';
                echo '<meta itemprop="contactType" content="customer support">';
                echo '<meta itemprop="telephone" content="' . esc_attr( $normalized['tel'] ) . '">';

                echo '<p class="contact-phone">';
                echo '<a href="' . esc_url( 'tel:' . $normalized['tel'] ) . '">';
                echo esc_html( $normalized['display'] );
                echo '</a>';
                echo '</p>';

                echo '</div>';
            }

            echo '</div>';
        }

        //add_action( 'wp_footer', 'lc_contact_phone' );
        add_action( 'lc_contact_phone', 'lc_contact_phone' );

    }

    /**
     * A. Sanitize email value
     */
    if ( ! function_exists( 'lc_sanitize_email' ) ) {

        function lc_sanitize_email( $value ) {

            $value = trim( $value );

            if ( empty( $value ) ) {
                return '';
            }

            return is_email( $value ) ? $value : '';
        }
    }

    /**
     * B. Fetch and sanitize multiple contact emails
     */
    if ( ! function_exists( 'lc_get_contact_emails' ) ) {

        function lc_get_contact_emails() {

            $default_mail = 'mail@website.com';

            $email_addr  = get_theme_mod( 'email' );

            $raw_email = ! empty( $email_addr ) ? $email_addr : $default_mail;

            // Support multiple emails (comma-separated)
            $emails = array_map( 'trim', explode( ',', $raw_email ) );

            return array_filter(
                array_map( 'lc_sanitize_email', $emails )
            );
        }
    }

    /**
     * C. Render email contacts with schema.org markup
     */
    if ( ! function_exists( 'lc_contact_email' ) ) {

        function lc_contact_email() {

            $emails = lc_get_contact_emails();

            if ( empty( $emails ) ) {
                return;
            }

            echo '<div class="contact-emails" itemscope itemtype="https://schema.org/Organization">';

            foreach ( $emails as $email ) {

                echo '<div itemprop="contactPoint" itemscope itemtype="https://schema.org/ContactPoint">';
                echo '<meta itemprop="contactType" content="customer support">';
                echo '<meta itemprop="email" content="' . esc_attr( $email ) . '">';

                echo '<p class="contact-email">';
                echo '<a href="' . esc_url( 'mailto:' . $email ) . '">';
                echo esc_html( $email );
                echo '</a>';
                echo '</p>';

                echo '</div>';
            }

            echo '</div>';

        }

        // Allow both automatic and manual rendering
        //add_action( 'wp_footer', 'lc_contact_email' );
        add_action( 'lc_contact_email', 'lc_contact_email' );

    }


    /** FORM SECTION */

    // F. Contact Form  
    if(!function_exists('lc_contact_form')){

        function lc_contact_form(){ 
            
            ?>
            <div class="<?php echo esc_attr('contact-form col-md-11 col-ms'); ?>" >
                                                                                            
                <p class="<?php echo esc_attr('form-note'); ?>"><?php echo esc_html__('Fields marked with "*" are required, and must be filled.', "law-corporate"); ?></p>

                <?php the_content(); ?>

                <div class="<?php echo esc_attr('clear'); ?>"></div> 
                        
            </div>
            
            <?php

        } 

    }    