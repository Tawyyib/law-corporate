<?php

    /**     SERVICE CARD      */
    if(! function_exists('lc_service_card')){

        function lc_service_card(){

            ?>

                <div class="<?php echo esc_attr('service-card col-sm-12'); ?>" > 
                
                    <a href="<?php echo the_permalink() ?>"  class="<?php echo esc_attr('service-card__term d-flex align-items-center justify-content-between p-3'); ?>" ><span class="<?php echo esc_attr(''); ?>" ><?php the_title(); ?></span><i class="<?php echo esc_attr('fas fa-chevron-circle-right'); ?>"></i></a>
                                        
                    <span class="<?php echo esc_attr('service-card__excerpt px-3 py-2 bg-dar'); ?>"  ><?php echo the_excerpt(); ?></span>
                                                                                              
                </div>

            <?php

        }
        add_action('', 'lc_service_card');

    }
    
    /**     SERVICE CARD -2    */
    if(! function_exists('lc_service_card_2')){

        function lc_service_card_2(){

            ?>

                <div class="service-card col-sm-12 accordion-item" > 
                
                    <a href="<?php echo the_permalink() ?>"  class="<?php echo esc_attr('service-card__term d-flex align-items-center justify-content-between p-3'); ?>" ><span class="<?php echo esc_attr(''); ?>" ><?php the_title(); ?></span><i class="<?php echo esc_attr('fas fa-chevron-circle-right'); ?>"></i></a>
                                        
                    <span class="<?php echo esc_attr('service-card__excerpt px-3 py-2 bg-dar'); ?>"  ><?php echo the_excerpt(); ?></span>
                                                                                              
                </div>

            <?php

        }
        add_action('', 'lc_service_card_2');

    }

    /**   SERVICE-TAXONOMY CARD      */
    if(! function_exists('lc_expert_card')){

        /**
         * Output taxonomy cards, excluding a specific term slug.
         *
         * @param string $taxonomy         The taxonomy name.
         * @param string $exclude_term_slug Term slug to exclude.
         */

        function lc_expert_card( $taxonomy, $exclude_term_slug ) {

            $exclude_term = get_term_by( 'slug', $exclude_term_slug, $taxonomy );

            // Ensure taxonomy exists
            if ( ! taxonomy_exists( $taxonomy ) ) { return; }

            // Build exclude list
            $exclude = [];
            if ( $exclude_term && ! is_wp_error( $exclude_term ) ) {
                $exclude[] = $exclude_term->term_id;
            }

            // Get terms
            $terms = get_terms( [
                'taxonomy'   => $taxonomy,
                'exclude'    => $exclude,
                'orderby'    => 'name',
                'order'      => 'DESC',
                'hide_empty' => true,
            ] );

            // Check if there are any empty terms, and if there's any error.  
            if ( empty( $terms ) || is_wp_error( $terms ) ) {
                echo '<p class="no-content extra">' . esc_html__( 'Services related content not created yet, please check back later.', 'law-corporate' ) . '</p>';
                return;
            }

            echo '<div class="section-content-inner row align-items-stretch align-content-center justify-content-between">';

            foreach ( $terms as $term ) {

                // Icon
                $icon_id  = get_term_meta( $term->term_id, 'icon', true );
                $icon_url = $icon_id ? wp_get_attachment_url( $icon_id ) : get_template_directory_uri() . '/assets/images/placeholder-icon.svg';

                // Excerpt
                $excerpt = get_term_meta( $term->term_id, 'taxonomy-excerpt', true );
                $excerpt = $excerpt ? esc_html( $excerpt ) : esc_html__( 'Experts with difference, top-notch services.', 'law-corporate' );

                // Term link
                $term_link = get_term_link( $term );
                if ( is_wp_error( $term_link ) ) {
                    $term_link = '#';
                }

                ?>
                <a href="<?php echo esc_url( $term_link ); ?>" title="<?php echo esc_attr( $term->name ); ?>" class="tax-card col-mlg-4 my-0">
                    <div class="tax-card__header d-flex align-items-center align-content-center mb-4">
                        <figure class="tax-card__header-icon">
                            <img src="<?php echo esc_url( $icon_url ); ?>" class="svg-icon" alt="<?php echo esc_attr( $term->name ); ?>">
                        </figure>
                        <span class="tax-card__header-title"><?php echo esc_html( $term->name ); ?></span>
                    </div>
                    <div class="tax-card__content">
                        <p class="tax-card__content-body mb-4"><?php echo $excerpt; ?></p>
                        <i class="tax-card__content-button fas fa-chevron-circle-right"></i>
                    </div>
                </a>
                <?php
            }

            echo '</div>';

        }
        
    }

    if(! function_exists('lc_tax_cards')){

        /**
         * Output taxonomy cards, excluding a specific term slug.
         *
         * @param string $taxonomy         The taxonomy name.
         * @param string $exclude_term_slug Term slug to exclude.
         */

        function lc_tax_cards ( $taxonomy, $exclude_term_slug ) {

            $exclude_term = get_term_by( 'slug', $exclude_term_slug, $taxonomy );

            // Ensure taxonomy exists
            if ( ! taxonomy_exists( $taxonomy ) ) { return; }

            // Build exclude list
            $exclude = [];
            if ( $exclude_term && ! is_wp_error( $exclude_term ) ) {
                $exclude[] = $exclude_term->term_id;
            }

            // Get terms
            $terms = get_terms( [
                'taxonomy'   => $taxonomy,
                'exclude'    => $exclude,
                'orderby'    => 'ID',
                'order'      => 'ASC',
                'hide_empty' => true,
            ] );

            // Check if empty or error
            if ( empty( $terms ) || is_wp_error( $terms ) ) {
                echo '<p class="no-content extra">' . esc_html__( 'Services related content not created yet, please check back later.', 'law-corporate' ) . '</p>';
                return;
            }

            // If on a taxonomy archive, prefer opening the queried term's panel
            $current_term_id = 0;
            if ( is_tax() || is_category() || is_tag() ) {
                $queried = get_queried_object();
                if ( $queried && isset( $queried->term_id ) ) {
                    $current_term_id = (int) $queried->term_id;
                }
            }

            $i = 1;

            // Fallback: use first panel if no queried term
            $first = true;

            foreach ( $terms as $term ) {

                $term_id = (int) $term->term_id;

                // Decide if this panel should be open
                $is_open = false;
                if ( $current_term_id && $term_id === $current_term_id ) {

                    $is_open = true;

                } elseif ( $first && ! $current_term_id ) {

                    $is_open = true;
                    $first   = false; // only first one

                }

                // Icon
                $icon_id  = get_term_meta( $term->term_id, 'icon', true );
                $icon_url = $icon_id ? wp_get_attachment_url( $icon_id ) : get_template_directory_uri() . '/assets/images/placeholder-icon.svg';

                // Excerpt
                $excerpt = get_term_meta( $term->term_id, 'taxonomy-excerpt', true );
                $excerpt = $excerpt ? esc_html( $excerpt ) : esc_html__( 'Experts with difference, top-notch services.', 'law-corporate' );

                // Term link
                $term_link = get_term_link( $term );
                if ( is_wp_error( $term_link ) ) {
                    $term_link = '#';
                }

                // Unique collapse ID
                $collapse_id = 'collapse-' . $term_id;
                $heading_id  = 'heading-' . $term_id;

                ?>

                <!-- Service Group <?php echo esc_html( $i ); ?> -->
                 <?php $i++; ?>

                <div class="taxo-card accordion-item <?php echo $is_open ? 'active' : ''; ?>">
                    
                    <div class="taxo-card__header" id="<?php echo esc_attr( $heading_id ); ?>">                                                    

                        <div class="taxo-card__header-inner accordion-button <?php echo $is_open ? '' : 'collapsed'; ?>" 
                            type="button" 
                            data-bs-toggle="collapse" 
                            data-bs-target="#<?php echo esc_attr( $collapse_id ); ?>" 
                            aria-expanded="<?php echo $is_open ? 'true' : 'false'; ?>" 
                            aria-controls="<?php echo esc_attr( $collapse_id ); ?>">
                             
                            <figure class="taxo-card__header-icon">
                                <img src="<?php echo esc_url( $icon_url ); ?>" class="svg-icon" alt="<?php echo esc_attr( $term->name ); ?>">
                            </figure> 

                            <span class="taxo-card__header-title"><?php echo esc_html( $term->name ); ?></span>

                        </div>

                    </div>

                    <div id="<?php echo esc_attr( $collapse_id ); ?>" 
                        class="taxo-card__content accordion-collapse collapse <?php echo $is_open ? 'show' : ''; ?>" 
                        aria-labelledby="<?php echo esc_attr( $heading_id ); ?>" 
                        data-bs-parent="#taxAccordion">
                        
                        <div class="taxo-card__content-inner accordion-body">

                            <p class="taxo-card__content-body"><?php echo $excerpt; ?></p>
                            
                            <?php 
                                       
                                $text =  esc_html__( 'Learn More', 'law-corporate' );																		
                                $url = esc_url($term_link);																		
                                $classes =  ['btn-slim', ];	
                                $target = '';
                                $rel = '';
     
                                echo lc_cta_button ($text, $url, $classes, $target, $rel);                            

                            ?>
                            
                        </div> 

                    </div>

                </div>

            <?php
            }

        }
        
    }
        
    /** 
     * RELATED SERVICES SIDEBAR METADATA 
     * Displays RELATIVES sERVICES in a structured sidebar format
     */
    if (!function_exists('lc_services_rel')){
        
        function lc_services_rel(){

            /**
             * Logic to pull related 'services' based on the 'competency' taxonomy.
             * This ensures strict post-type separation and excludes the current post.
             */

            // 1. Initialize to prevent errors if logic is skipped or terms are missing
            $tax_services = null;
            $current_post_id = get_the_ID();

            // 2. Get terms associated with the current post within the 'competency' taxonomy
            $terms = get_the_terms( get_the_ID(), 'competency' );

            //
            if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {

                $term_ids = array_map( function( $term ) {

                    return $term->term_id;

                }, $terms );
                
                // Query for related posts
                $args = array(
                    'post_type' => 'services',
                    'post_status' => 'publish',
                    'posts_per_page' => -1,
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'competency',
                            'field' => 'term_id',
                            'terms' => $term_ids,
                            'operator' => 'IN',               // Pulls posts that have ANY of the matching term IDs
                        ),
                    ),
                    'orderby'        => 'title',              // Sort alphabetically for a "collation" feel
                    'order'          => 'ASC',
                );

                // Only exclude if we are on a single post page
                if ( is_singular() ) {

                    $args['post__not_in'] = [ $current_post_id ];
                    $args['posts_per_page'] = 4;

                }
                
                $tax_services = new WP_Query( $args );

                echo '<aside  class="' . esc_attr('service-aside col-md-12') . '" >';
                    
                if ( is_singular() ) {

                echo  '<h4 class="' . esc_html('side-item__header d-flex pe-3 mb-2') . '"><span>' . esc_html('Related Services') . '</span><i class="'  .  esc_attr('fas fa-folder-tree ms-4') .  '"></i></h4>';

                } else {

                echo  '<h4 class="' . esc_html('side-item__header d-flex pe-3 mb-2') . '"><span>' . esc_html('How We Can Help') . '</span><i class="'  .  esc_attr('fas fa-pen-nib ms-4') .  '"></i></h4>';
                
                }
                echo  '<hr>';
                
                    if ( $tax_services && $tax_services instanceof WP_Query && $tax_services->have_posts() ) {

                        // list all services related
                        $service_item = '<ul class="side-item__list">';

                        while ( $tax_services->have_posts() ){
                                    
                            $tax_services->the_post();
                                    
                            $service_item .=  '<li><a href="' ;
                            $service_item .=    get_the_permalink();
                            $service_item .=   '" class="d-flex align-items-center justify-content-between bg-light">';
                            $service_item .=   '<span class="' . esc_attr('term_title') . '" >';
                            $service_item .=   get_the_title() . '</span>';
                            $service_item .=   '<span class="' . esc_attr('arrow') . '"><i class="'  .  esc_attr('fas fa-chevron-circle-right') .  '"></i></span></a></li>';

                        }

                        $service_item .=   '</ul>';

                        echo $service_item;

                        wp_reset_postdata();

                    } else {

                        echo '<p class="' . esc_attr('  ') . '">' . esc_html__('No services listed yet..', "law-corporate") . '.</p>';
                        
                    }
                        
            }

            echo '</aside>';
        
        }

    }

    /** 
     * TAXONOMY TERM SERVICES SIDEBAR METADATA 
     * Displays Taxonomy Terms Services in a structured sidebar format
     */
    if ( ! function_exists ( 'lc_tax_services' )) {

        function lc_tax_services (){

            // Initialize the variable at the top of your file or before line 75
            $tax_services = null;
                    
            // get terms associated with the current post.
            $terms = get_the_terms( get_the_ID(), 'competency' );

            // checks if terms (services) are not empty
            if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
                        
                $term_ids = array_map( function( $term ) {

                    return $term->term_id;

                }, $terms );
                                            
                // Query for related posts
                $args = array(
                    'post_type' => 'services',
                    'post_status' => 'publish',
                    //'posts_per_page' => 4,
                    'tax_query' => array (
                        array(
                            'taxonomy' => 'competency',
                            'field' => 'term_id',
                            'terms' => $term_ids,
                        ),
                    ),
                            
                    //'post__not_in' => array( $post->ID ),
                );
                
                $tax_services = new WP_Query($args);

            }

            ?>
                        
                <!-- taxonomy's child posts -->
                <div class="term-posts">

                    <h4 class="term-posts__header d-flex"><span><?php echo __( 'Core Services listing', 'law-corporate' ); ?></span><i class="fas fa-pen-nib"></i></h4>
                    <hr>
                                                                                                
                    <!-- list all posts related to the taxonomy term -->

                    <?php if ( $tax_services && $tax_services instanceof WP_Query && $tax_services->have_posts() ){ ?>

                        <ul class="term-posts__list" >
                                        
                            <?php while ( $tax_services->have_posts() ){
                                    
                            $tax_services-> the_post(); ?>
                                            
                                <li class="term-posts__list-item bg-light" ><?php lc_service_card() ;?></li>                                                                                           
                        
                            <?php } 

                                wp_reset_postdata(); 
                                        
                            ?>

                        </ul>     

                    <?php } else { 
                                    
                        echo '<p class="'. esc_attr('no-content px-3') .'"  >'. esc_html__('No services listed yet.', 'law-corporate') . '</p>';

                    } ?>    
                                
                </div>
                
            <?php         

        }

    }