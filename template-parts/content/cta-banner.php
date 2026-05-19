<?php
    $term = get_queried_object();
    $slug = $term->slug; // For taxonomy terms, use 'slug'
    $term_title = single_term_title('', false); // Store in variable (returns string, doesn't echo)
    
    $act_nudge = __( 'Our experts are available for confidential consultations.', 'law-corporate' );

    $trust_title = null;
    $trust_message = null;

    if ( is_singular ( 'services' ) ) {

        //$trust_title = 'Ready to discuss your '. esc_html( get_the_title () ) .' requirements?';
        $trust_title = 'Need a '. esc_html( get_the_title () ) . ' specialist on your project?';

    } else if (  $slug !== 'general' ) {

        $trust_title = 'Ready to discuss your  '. esc_html($term_title) .' requirements?';

    } else {

        $trust_title = 'Ready to discuss  how our  '. esc_html($term_title) .' can support your mission??';

    }

    if ( is_singular ( 'services' ) ) {

        $trust_message = esc_html__( 'We\'ve done it before, and our capability proven with unblemished track records .',
                                    'law-corporate' );

    } elseif ( $slug == 'business-development' ) {

        $trust_message = esc_html__( 'Whether you\'re structuring a PPP, negotiating a concession, or entering a new market, we\'ve done it before.',
                                    'law-corporate' );

    } else if ( $slug == 'regulatory-compliance' ) {

        $trust_message = esc_html__( 'Whether you\'re building a new regulator from scratch or navigating existing compliance obligations, we\'ve been where you are.',
                                    'law-corporate' );

    } else if ( $slug == 'publc-sector-reform' ) {   

        $trust_message = esc_html__( 'Whether you\'re restructuring a utility or drafting new sector legislation, we\'ve done it before.',
                                    'law-corporate' );    

    } else { 

        $trust_message = esc_html__( 'Whether you need a policy drafted, a donor project managed, or consensus built across competing interests, we have the expertise to deliver. ',
                                    'law-corporate' );  

    }

    $cta_button_label = 'Contact Our Team';
    $cta_button_url = '';

?>

<section class="term-cta-glass bg-light py-6">

    <div class="container-app">

        <div class="glass-card cta-glass-card d-flex">

            <div class="cta-icon-wrapper">
                <span class="fas fa-handshake"></span>
            </div>

              <h3 class="cta-glass-title"><?php echo esc_html__( $trust_title, 'law-corporate' ); ?></h3>      

            <div class="cta-glass-text d-flex"> 
                <p class="cta-glass-text__message"><?php echo esc_html($trust_message);  ?></p>
                <p class="cta-glass-text__nudge"><?php echo esc_html( $act_nudge ); ?></p>
            </div>

            <div class="cta-glass-actions">
								
                <?php lc_cta_button ( $cta_button_label, $cta_button_url, 'btn-primary', '', '_blank',  '', 'fas fa-arrow-right' ) ?>

                <a href="#" class="btn btn-outline">
                    <i class="fas fa-phone-alt"></i>
                    <span>Schedule a Call</span>
                </a>

            </div>

        </div>

    </div>

</section>