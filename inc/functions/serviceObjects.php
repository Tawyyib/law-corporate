<?php

    /**     SERVICE CARD      */
    if(! function_exists('lc_service_card')){

        function lc_service_card(){

            ?>

                <div class="service-card d-flex col-sm-12" > 
                
                    <a href="<?php echo the_permalink() ?>"  class="service-card__term d-flex" >
                        <span class="d-flex" >
                            <?php the_title(); ?>
                            <i class="fas fa-info-circle"></i>
                        </span>                        
                    </a>
                                        
                    <span class="service-card__excerpt px-3 py-2"  ><?php echo the_excerpt(); ?></span>
                                                                                              
                </div>

            <?php

        }

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

    /**
     *  Custom Taxonomy Terms Listing
     *  FrontPage Accordion
     */
    if(! function_exists('lc_tax_terms_accordion')){

        /**
         * Output taxonomy cards, excluding a specific term slug.
         *
         * @param string $taxonomy         The taxonomy name.
         * @param string $exclude_term_slug Term slug to exclude.
         */
        function lc_tax_terms_accordion ( $taxonomy, $exclude_term_slug, $default_index = 1 ) {

            $exclude_term = get_term_by( 'slug', $exclude_term_slug, $taxonomy );

            // Ensure taxonomy exists
            if ( ! taxonomy_exists( $taxonomy ) ) { 

                echo '<p class="no-content extra">' . esc_html__('Taxonomy not found .........', 'law-corporate') . '</p>';
                return; 

            }

            // Build exclude list
            $exclude = [];

            if ( $exclude_term && ! is_wp_error( $exclude_term ) ) {

                $exclude[] = $exclude_term->term_id;

            }

            // Get terms
            $terms = get_terms( [
                'taxonomy'   => $taxonomy,
                'exclude'    => $exclude,
                'orderby'    => 'id',
                'order'      => 'ASC',
                'hide_empty' => true,
            ] );

            // Check if empty or error
            if ( empty( $terms ) || is_wp_error( $terms ) ) {
                echo '<p class="no-content extra">' . esc_html__( 'Capability loading  ........', 'law-corporate' ) . '</p>';
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

            // Initialize count to '0' or '1' to set start point
            $counter = 1;

            // Fallback: use first panel if no queried term
             $first = true;

            foreach ( $terms as $term ) {

                $term_id = (int) $term->term_id;

                // Decide if this panel should be open
                $is_open = false;

                if ( $current_term_id && $term_id === $current_term_id ) {

                    $is_open = true;

                } elseif ( ! $current_term_id && $counter === $default_index ) {

                    $is_open  =  true; // Close
                    $first  =   false; // only first one

                }

                // Icon
                $icon_id  = get_term_meta( $term->term_id, 'icon', true );
                $icon_url = $icon_id ? wp_get_attachment_url( $icon_id ) : get_template_directory_uri() . '/assets/images/placeholder-icon.svg';

                // Excerpt
                $excerpt = get_term_meta( $term->term_id, 'excerpt', true );
                // With default text fallback
                $excerpt = !empty($excerpt) 
                    ? esc_html($excerpt) 
                    : ( !empty($term->description) 
                        ? wp_trim_words($term->description, 12, '...') 
                        : esc_html__('Experts with difference, top-notch services.', 'law-corporate') 
                    );

                // Term link
                $term_link = get_term_link( $term );

                if ( is_wp_error( $term_link ) ) {

                    $term_link = '#';

                }

                // Unique collapse ID
                $collapse_id = 'collapse-' . $term_id;
                $heading_id  = 'heading-' . $term_id;

                ?>

                <!-- Service Group <?php echo esc_html( $counter ); ?> -->
                 
                 <?php $counter++; ?>

                <div class="taxo-card accordion-item<?php echo $is_open ? ' active' : ''; ?>">
                                    
                    <!-- header  -->
                    <div class="taxo-card__header" id="<?php echo esc_attr( $heading_id ); ?>">                                                    

                        <div class="taxo-card__header-button accordion-button <?php echo $is_open ? '' : 'collapsed'; ?>" 
                                type="button" 
                                data-bs-toggle="collapse" 
                                data-bs-target="#<?php echo esc_attr( $collapse_id ); ?>" 
                                aria-expanded="<?php echo $is_open ? 'true' : 'false'; ?>" 
                                aria-controls="<?php echo esc_attr( $collapse_id ); ?>" 
                        >

                            <!-- icon  -->        
                            <figure class="taxo-card__header-icon">
                                <div class="svg-icon" style="
                                        -webkit-mask-image: url(<?php echo esc_url( $icon_url ); ?>);" 
                                        mask-image: url(<?php echo esc_url( $icon_url ); ?>); 
                                        role="img" aria-label="<?php echo esc_attr( $term->name ); ?>">
                                    </div>
                            </figure>  

                            <!-- title  -->            
                            <span class="taxo-card__header-title"><?php echo esc_html( $term->name ); ?></span>

                        </div>

                    </div>

                    <!-- content: collapsing  -->
                    <div id="<?php echo esc_attr( $collapse_id ); ?>" 
                        class="taxo-card__collapse accordion-collapse collapse<?php echo $is_open ? ' show' : ''; ?>" 
                        aria-labelledby="<?php echo esc_attr( $heading_id ); ?>" 
                        data-bs-parent="#taxAccordion" 
                    >

                        <div class="taxo-card__body accordion-body">
                                            
                            <div class="taxo-card__body-description">
                                
                                <?php echo esc_html($excerpt); ?>

                            </div> 
                                
                            <?php                                         
                                $text =  esc_html__( 'Learn More', 'law-corporate' );																		
                                $url = esc_url($term_link);																		
                                $classes =  ['btn-slim', 'learn-more-link' ];	
                                $type = '';
                                $target = '';
                                $rel = '';
                                $icon_class = 'fas fa-arrow-right';
        
                                echo lc_cta_button ($text, $url, $classes, $type,  $target, $rel, $icon_class );                            
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

            $related_services = lc_get_related_items_query ( 'services' );
            
            echo '<div  class="' . esc_attr('side-item d-flex col-md-12') . '" >';
                        
                echo  '<h4 class="' . esc_html('side-item__header') . '">' . esc_html('Related Services') . '</h4>';

                //echo  '<hr>';
                
                if ( $related_services->have_posts() ) {

                    // list all services related
                    $service_item = '<ul class="side-item__list">';

                    while ( $related_services->have_posts() ){
                                    
                        $related_services->the_post();
                                    
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
                        
                    
            echo '</div>';
        
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

            $taxonomy = lc_get_current_taxonomy ();
                    
            // get terms associated with the current post.
            $terms = get_the_terms( get_the_ID(), $taxonomy );

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
                            'taxonomy' => $taxonomy,
                            'field' => 'term_id',
                            'terms' => $term_ids,
                        ),
                    ),
                            
                );
                
                $tax_services = new WP_Query($args);

            }

            ?>
                        
                <!-- taxonomy's child posts -->
                <aside class="term-posts">

                    <h4 class="term-posts__header d-flex">
                        <span><?php echo __( 'What we\'ve delivered', 'law-corporate' ); ?></span>
                        <i class="fas fa-pen-nib"></i>
                    </h4>
                    <hr>
                                                                                                
                    <!-- list all posts related to the taxonomy term -->

                    <?php if ( $tax_services && $tax_services instanceof WP_Query && $tax_services->have_posts() ){ ?>

                        <div class="term-posts__list posts_list" >
                                        
                            <?php while ( $tax_services->have_posts() ){
                                    
                            $tax_services-> the_post(); ?>
                                            
                                <li class="term-posts__list-item" ><?php lc_service_card () ;?></li>                                                                                           
                        
                            <?php } 

                                wp_reset_postdata(); 
                                        
                            ?>

                        </div>     

                    <?php } else { 
                                    
                        echo '<p class="'. esc_attr('no-content px-3') .'"  >'. esc_html__('No services listed yet.', 'law-corporate') . '</p>';

                    } ?>    
                                
                    <?php // get_template_part('template-parts/content/aside-contact'); ?>

                </aside>
                
            <?php
            
            //get_template_part('template-parts/content/aside-contact');

        }

    }
    
    /** 
     * TAXONOMY TERM SERVICES SIDEBAR METADATA 
     * Displays Taxonomy Terms Services in a structured sidebar format
     */
    if ( ! function_exists( 'lc_tax_terms_rel' ) ) {

        function lc_tax_terms_rel ( $taxonomy = null, $limit = -1, $default_index = 0, $exclude_current = true ) {
            
            // Auto-detect taxonomy if not provided
            if (!$taxonomy) {
                $taxonomy = lc_get_current_taxonomy();
            }
            
            if (!$taxonomy) {
                echo '<p class="no-content extra">' . esc_html__('Taxonomy not found .........', 'law-corporate') . '</p>';
                return;
            }
            
            // Get current term ID (for exclusion if needed)
            $current_term_id = null;

            if ($exclude_current && is_tax()) {

                $current_term = get_queried_object();

                if (is_a($current_term, 'WP_Term')) {
                    $current_term_id = $current_term->term_id;
                }

            }
            
            // Build query arguments
            $args = [
                'taxonomy' => $taxonomy,
                'hide_empty' => true,
                'orderby' => 'id',
                'order' => 'ASC',
                'number' => $limit > 0 ? $limit : null,
            ];
            
            // Exclude current term if requested
            if ($current_term_id) {

                $args['exclude'] = [$current_term_id];

            }
            
            $terms = get_terms($args);            
            if (empty($terms) || is_wp_error($terms)) {
                echo '<p class="no-content extra">' . esc_html__( 'Capability loading  ........', 'law-corporate' ) . '</p>';
                return;                
            }

            // Get current queried term ID and calculate next term ID
            $queried_term_id = 0;
            $target_term_id = 0;

            if (is_tax() || is_category() || is_tag()) {

                $queried = get_queried_object();

                if ($queried && isset($queried->term_id)) {

                    $queried_term_id = (int) $queried->term_id;
                    
                    // Find next term from the current $terms list
                    if (!empty( $terms ) && !is_wp_error( $terms )) {

                        $term_ids = wp_list_pluck( $terms, 'term_id' );
                        $current_index = array_search( $queried_term_id, $term_ids );

                        $target_index = $current_index + $default_index; // goes from 1 -> 3 (0-based: 0 -> 2)

                        if ( $target_index !== false && isset( $term_ids[ $target_index ]) ) {

                            $target_term_id = $term_ids[ $target_index ];

                        }  else {

                            // Fallback: open first or last term
                            $target_term_id = $term_ids[0] ?? 0;

                        }

                    }

                }

            }

            // Initialize count to '0' or '1' to set start point
            $counter = 1;
            
            // Fallback: use first panel if no queried term
             $first = true;

            ?>
                
                <aside class="term-posts accordion" id="taxAccordion">

                    <h4 class="term-posts__header d-flex mb-4">
                        <?php echo esc_html__('Other Capabilities', 'law-corporate'); ?>
                    </h4>
                    <!--<hr>-->
                    
                    <div class="term-posts__list terms__list">

                        <?php foreach ($terms as $term) : 

                            $term_id = (int) $term->term_id;

                            // Decide if this panel should be open
                            $is_open = false;
                            
                            // Open the next term (not the current one)
                            if ( $target_term_id && $term_id === $target_term_id ) {

                                $is_open = true;

                            } 
                            // If no next term exists (e.g., current is last), open the first term
                            elseif (!$target_term_id && $counter === $default_index) {

                                $is_open = true;
                                
                            }

                            // Icon
                            $icon_id  = get_term_meta( $term->term_id, 'icon', true );
                            $icon_url = $icon_id ? wp_get_attachment_url( $icon_id ) : get_template_directory_uri() . '/assets/images/placeholder-icon.svg';

                            // Excerpt
                            $excerpt = get_term_meta( $term->term_id, 'excerpt', true );
                            
                            // With default text fallback
                            $excerpt = !empty($excerpt) 
                                ? esc_html($excerpt) 
                                : ( !empty($term->description) 
                                    ? wp_trim_words($term->description, 12, '...') 
                                    : esc_html__('Experts with difference, top-notch services.', 'law-corporate') 
                                );

                            // Term link
                            $term_link = get_term_link( $term );

                            if ( is_wp_error( $term_link ) ) {

                                $term_link = '#';

                            }

                            // Unique collapse ID
                            $collapse_id = 'collapse-' . $term_id;
                            $heading_id  = 'heading-' . $term_id;
                                                    
                        ?>

                            <!-- Service Group <?php echo esc_html( $counter ); ?> -->                        
                            <?php $counter++; ?>

                            <div class="side-term accordion-item<?php echo $is_open ? ' active' : ''; ?>" >
                                    
                                <!-- header  -->
                                <div id="<?php echo esc_attr( $heading_id ); ?>" class="side-term__header">

                                    <div class="side-term__header-button accordion-button <?php echo $is_open ? '' : 'collapsed'; ?>"
                                        type="button" 
                                        data-bs-toggle="collapse" 
                                        data-bs-target="#<?php echo esc_attr( $collapse_id ); ?>" 
                                        aria-expanded="<?php echo $is_open ? 'true' : 'false'; ?>" 
                                        aria-controls="<?php echo esc_attr( $collapse_id ); ?>"
                                    >
                                    
                                        <!-- icon  -->
                                        <figure class="side-term__icon">                            
                                            <div  class="svg-icon" style="
                                                -webkit-mask-image: url(<?php echo esc_url( $icon_url ); ?>);" 
                                                mask-image: url(<?php echo esc_url( $icon_url ); ?>); 
                                                role="img" aria-label="<?php echo esc_attr( $term->name ); ?>">                                                
                                            </div>                                                
                                        </figure>
                                    
                                        <!-- title  -->                                            
                                        <h5 class="side-term__title" ><?php echo esc_html($term->name); ?></h5>

                                    </div>

                                </div>
                                
                                <!-- content: collapsing  -->
                                <div id="<?php echo esc_attr( $collapse_id ); ?>" 
                                    class="side-term__collapse accordion-collapse collapse<?php echo $is_open ? ' show' : ''; ?>"
                                    aria-labelledby="<?php echo esc_attr( $heading_id ); ?>" 
                                    data-bs-parent="#taxAccordion" 
                                >                                

                                    <div class="side-term__body accordion-body">
                                        
                                        <div class="side-term__body-description">
                                            
                                            <?php if ($excerpt) : ?>
        
                                            <?php echo esc_html( $excerpt ); ?>
                                                        
                                            <?php endif; ?>

                                        </div>
                                                                                    
                                        <?php                                                     
                                            $text =  esc_html__( 'Learn More', 'law-corporate' );																		
                                            $url = esc_url($term_link);																		
                                            $classes =  ['btn-slim', 'learn-more-link' ];	
                                            $type = '';
                                            $target = '';
                                            $rel = '';
                                            $icon_class = 'fas fa-arrow-right';
                        
                                            echo lc_cta_button ($text, $url, $classes, $type,  $target, $rel, $icon_class );                            

                                        ?>
                                        
                                    </div>

                                </div>

                            </div>
                            
                        <?php endforeach; ?>

                    </div>

                </aside>
                
            <?php
        }

        // Usage:
        // lc_tax_term_rel(); // Auto-detect, show all
        // lc_tax_term_rel('expertise', 5); // Specific taxonomy, limit to 5
        // lc_tax_term_rel('expertise', -1, false); // Show including current term

    }