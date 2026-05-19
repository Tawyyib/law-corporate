    <!--    Page Banners    -->
        
    <?php
    
        // 1. Slider / Banner Image Setup
        $banner_image = get_template_directory_uri() . '/public/images/items-judges.webp'; // default fallback

        $custom_banner_id = get_theme_mod('front_banner_image', '');
        if ( ! empty($custom_banner_id) ) {

            $custom_banner_url = wp_get_attachment_url($custom_banner_id);
            if ( $custom_banner_url ) {

                $banner_image = esc_url($custom_banner_url);
                
            }

        }
        
        // 4. Banner Buttons
        $button_url = esc_url( '#main');                             
                            
        $banner_label =esc_html( 'Scroll');                             
        if(get_theme_mod('front_banner_label','') !=''){

            $button_label = get_theme_mod('front_banner_label',''); 

        }

        
        // Define Banner Classes
        if ( is_front_page() ){ 

            $banner_class = 'banner__front bg-image-center'; // FrontPage Banner Class

        } elseif ( is_home() ||  is_archive() || is_singular('services') || is_singular('people') ) {

            $banner_class = 'banner__normal'; // home/blog page banner class          

        } elseif (is_singular() && ! is_page()) {

            $banner_class = 'banner__stretch'; // Single Post Type Banner Class

        } else {

            $banner_class = 'banner__normal'; // Other Banner Classess
        
        }
                
        
        // Declare Null Url
        $banner_url= '';

        // Define Banner URL
        if (is_front_page()) { 

            $banner_url = $banner_image;

        } elseif (is_home()) {

            $posts_page_id = get_option( 'page_for_posts' );
            $post_image_id = get_post_thumbnail_id( $posts_page_id );
            $banner_url = wp_get_attachment_url( $post_image_id ) ?? '';

        } elseif ( is_category() && ! is_tag() ) {
                                
            $category_object = get_queried_object();
            $category_image_id = get_term_meta( $category_object->term_id, 'banner', true );

            if ($category_image_id) {

                $banner_url = wp_get_attachment_url($category_image_id);

            } else {

                $banner_url = get_the_post_thumbnail_url(null, 'post-thumbnail');

            }            
                    
        } elseif ( is_tax() && ! is_tag() ) {

            // 1. Get the term
            $term = get_queried_object();
            $banner_url = ''; // default empty

            if ($term && is_a($term, 'WP_Term')) {
                
                // Candidate slugs in order of priority
                $candidates = [];
                
                // Candidate 1: term slug
                $candidates[] = $term->slug;
                
                // Candidate 2: taxonomy name (if available)
                $taxonomy = get_taxonomy($term->taxonomy);
                if ($taxonomy && !empty($taxonomy->name)) {
                    $candidates[] = $taxonomy->name;
                }
                
                // Candidate 3: first associated post type (if available)
                if ($taxonomy && !empty($taxonomy->object_type)) {
                    $candidates[] = $taxonomy->object_type[0];
                }
                
                // Try each candidate until we find a page with a thumbnail
                foreach ($candidates as $slug) {
                    $page = get_page_by_path($slug);
                    if ($page && has_post_thumbnail($page->ID)) {
                        $banner_url = get_the_post_thumbnail_url($page->ID, 'post-thumbnail');
                        break; // stop at first valid page with thumbnail
                    }
                }
            }
            
        } elseif ( is_singular('people') || is_post_type_archive() || is_tax() ) {
                                
            $post_type_object = get_queried_object();
    
            // Get the post type name differently based on context
            if (is_singular('people')) {

                $post_type = 'people'; // You already know it's 'people'

            }             
            else {

                $post_type = get_queried_object()->name; // Archive: returns post type object

            }

            // Find a page with the same slug as the post type
            $page = get_page_by_path($post_type);
            $banner_url = ($page && has_post_thumbnail( $page->ID ) ) ? get_the_post_thumbnail_url( $page->ID, 'post-thumbnail' ) :  '';
                    
        } elseif ( has_post_thumbnail() ) {

            $banner_url = get_the_post_thumbnail_url(null, 'post-thumbnail'); 
            
        } 
    
    ?>

    <section class="<?php echo esc_attr( $banner_class ); ?> bg-image-center" style="<?php echo $banner_url ? 'background-image: url(' . esc_url( $banner_url ) . ');' : ''; ?>" >

        <!-- Overlay -->
        <div class="banner-overlay d-flex flex-column">
            
            <div class="banner-overlay-inner container-app">

                <?php  if( is_front_page() ) { 

                    get_template_part('template-parts/header/front-banner-texts');

                } else { 

                    get_template_part('template-parts/header/page-header');

                } ?>

            </div>

            <?php if ( is_front_page() ) { 

                $icon_label = __( 'Scroll', 'law-corporate' );
                $icon_id = esc_attr ( 'scroll-button' );
                $object_class = esc_attr ( 'scroll-down-button' );
                $data_target = esc_attr ( 'main' );
                $icon_class = esc_attr ( 'arrow fas fa-chevron-circle-down' );

                lc_scroll_to_icon( $icon_label, $icon_id, $object_class, $data_target, $icon_class );

            } ?>

        </div>

    </section>