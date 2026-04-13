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
        
        // 4. Slide Buttons
        $button_url =esc_url( '#main');                             
                            
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

            $post_type = get_post_type();
            $post_type_object = get_post_type_object( $post_type );
            $page_slug = $post_type_object->name;

            // Find a page with the same slug as the post type
             $page = get_page_by_path($page_slug);
            $banner_url = ($page && has_post_thumbnail( $page->ID ) ) ? get_the_post_thumbnail_url( $page->ID, 'post-thumbnail' ) :  '';

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

            <?php if ( is_front_page() ) { ?>

                <a id=" " class="scroll-down-button" data-target="<?php echo esc_url($button_url); ?>">

                    <span class="text scroll-texts"><?php echo esc_html($banner_label); ?></span>
                    <span class="arrow fas fa-chevron-circle-down"></span>

                </a>

            <?php } ?>

        </div>

    </section>