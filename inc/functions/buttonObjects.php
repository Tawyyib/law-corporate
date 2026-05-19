<?php 
    /** 
     * THEME BUTTON OBJECTS 
     * Displays project details in a structured sidebar format
     */

    // Call Button
    if(!function_exists('lc_call_button')){

        function lc_call_button (){ 
                
                // Get site's phone number
                $phone_no = get_theme_mod('phone', 0);

                if(!empty($phone_no)){

                    $call_button = '<a class="' .    esc_attr(' btn btn-call ') . '" ';
                    $call_button .= 'href="'    .   esc_attr(' tel:+234'. $phone_no) . '" alt="'   .   esc_attr(' tel:+234'. $phone_no)    .   '"';
                    $call_button .= 'title="'    .   esc_attr('+234'. $phone_no)   .   '"     type="' .   esc_attr(' button ')    .   '" >';
                    $call_button .= '<span class="'    .   esc_attr('fa-solid fa-phone')   .   '"></span>';
                    $call_button .= '</a>';

                    echo $call_button;

                }

            }
            //add_action('', 'lc_call_button');

    }

    // Search Button
    if ( ! function_exists ( 'lc_search_button' )) {

        function lc_search_button (){

                $search_button = '<span class="custom-btn-search" type="button"';
                $search_button .= 'alt="Search" title="Search" data-bs-toggle="modal"';
                $search_button .= 'data-bs-target=" #searchModal " ><span class="fa-solid fa-search"></span></span>';

                echo $search_button;

        }

    }
  
    // Call-to-Act Button
    if(!function_exists('lc_cta_button')){

        function lc_cta_button (
                $text,
                $url,
                $class = array(),
                $type = '',
                $target = '_self',
                $rel ='',
                $icon_class = array(),
            ){ 

            $classes      = implode( ' ', (array) $class );
            $href_url     = $url ? ' href="' . esc_url ( $url ) . '"' : '';
            $type_attr     = $type ? ' type="' . esc_attr ( $type ) . '"' : '';
            $target_attr     = $target ? ' target="' . esc_attr ( $target ) . '"' : '';
            $rel_attr     = $rel ? ' rel="' . esc_attr ( $rel ) . '"' : '';
            $icon_classes      = implode( ' ', (array) $icon_class );

            $button_cta = '<a'. $href_url .' class="btn '. esc_attr($classes) . ' btn-pressed"';
            $button_cta .= $type_attr . $target_attr . $rel_attr . '>';
            $button_cta .= esc_html__( $text, 'law-corporate');
            $button_cta .=  '<span class="'. esc_attr( $icon_classes ) .'"></span>';
             $button_cta .= '</a>';

            echo $button_cta;

        }   

    }

    // Scroll-To Button
    if(!function_exists('lc_scroll_to_icon')){

        function lc_scroll_to_icon (
            $text, 
            $link_id,
            $class = array(), 
            $data_target = '', 
            $icon_class = array(),
            ){ 

            $classes      = implode( ' ', (array) $class );
            $id_attr = $link_id ? ' id="' . esc_attr( $link_id ) . '"' : '';
            $icon_classes      = implode( ' ', (array) $icon_class );

            $scroll_to_icon = '<a '. $id_attr  .  '" class="' .  esc_attr($classes)  .  '"';
            $scroll_to_icon .= ' data-target="' . esc_attr( $data_target ) . '">';
            $scroll_to_icon .= '<span class="text scroll-texts">'. esc_html( $text ) .'</span>';
            $scroll_to_icon .= '<span class="' . esc_attr( $icon_classes ) .'"></span>';
            $scroll_to_icon .= '</a>';

            echo $scroll_to_icon;

        }   

        /** Usage */
        // lc_scroll_to_icon ( 'Scroll', 'scroll-icon', 'scroll-down-button', '#main', 'arrow fas fa-chevron-circle-down' );
        
    }
    
    /** Back Button */
    if(! function_exists('lc_back_button')){

        function lc_back_button(){

            if ( wp_get_referer() )
            {
                $back_text = __( '&laquo;&nbsp;&nbsp;Go Back','law-corporate' );
                $back_button    = "\n<button id='back-button' class='btn btn-back back-button' onclick='javascript:history.back()'>$back_text</button>";
                echo $back_button;
            }
        }
        add_action( '', 'lc_back_button' );

    }

    // Back to top
    if ( ! function_exists( 'lc_back_to_top' ) ) {
        
        function lc_back_to_top () {

            ?>
                <!-- Back to Top Button -->
                <button id="back-to-top" class="back-to-top" aria-label="Back to top">
                    <span class="fas fa-chevron-up"></span>
                </button>
            <?php

        }

    }

    // A. Get Page Permalink
    if(! function_exists('lc_get_page_link')){

        /**
         * Get page link by slug or post type archive link
         * 
         * @param string $slug Page slug or post type name
         * @param bool $echo Whether to echo or return the URL
         * @return string|void URL if $echo is false
         */
    
        function lc_get_page_link ( $slug = ''){ 

            $permalink = null;
            
            // First try: Get the permalink via page
            $get_permalink = get_permalink_by_slug( $slug);

            // If empty permalink  is returned
            if ( empty ( $get_permalink ) ) {
            
                // Second try: Get the permalink via post_type_archive
                $get_permalink = get_post_type_archive_link ( $slug);

            } else {
                
                $page = get_page_by_path($slug);
                if ($page) {
                    $get_permalink = get_permalink($page->ID);
                }

            }
            

            if ( $get_permalink && !is_wp_error($get_permalink)) {

               $permalink =  esc_url($get_permalink);

            } else {

                $permalink = esc_url ( '#' );

            }

            return $permalink;

        }

    }

    // posts navigation  - <--prev - next -->
    if(! function_exists('lc_post_navigation')){

        function lc_post_navigation() {

            $post_nav = '<nav class="navi d-flex justify-content-between" >';
                                                                            
                // Reusable helper for navigation link markup
                $prev_link = get_previous_post_link(
                    '%link',
                    '<span class="previ-arr">&laquo;</span> 
                    <span class="previ-mobile">Previous</span> 
                    <span class="previ-desktop">%title</span>'
                );

                $next_link = get_next_post_link(
                    '%link',
                    '<span class="next-desktop">%title</span> 
                    <span class="next-mobile">Next</span> 
                    <span class="next-arr">&raquo;</span>'
                );

                if ($prev_link || $next_link) {

                    $post_nav .= '<div class="navi__box previ">' . $prev_link . '</div>';
                    $post_nav .= '<div class="navi__box next">' . $next_link . '</div>';
                    
                }

            $post_nav .= '</nav>';

            echo $post_nav;

        }
        
    }
   
    /**     Theme Pagination      */
    if(! function_exists('lc_paginate')){

        function lc_paginate(){
                                
            $pag = get_the_posts_pagination(); 
            $pag = str_replace('div', 'ul', $pag);
            $pag = str_replace('nav-links', 'pagination', $pag);
            $pag = str_replace('<a', '<li class="page-item"><a', $pag);
            $pag = str_replace('</a>', '</a></li>', $pag);
            $pag = str_replace('<span', '<li class="page-item active"><a', $pag);
            $pag = str_replace('</span>', '</a></li>', $pag);
            $pag = str_replace('page-numbers', 'page-link', $pag);
            $pag = str_replace('Previous', '&laquo;', $pag);
            $pag = str_replace('Next', '&raquo;', $pag);

            echo $pag;

        }
        add_action('', 'lc_paginate');

    }