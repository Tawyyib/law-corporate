        <?php 

        // Usage in your term template
        $term = get_queried_object();
        $page_data = get_pagepost_data ($term, 'tax-image-thumbnail' );
        $term_thumbnail_id = ( get_term_meta( $term->term_id, 'banner' , true ) );
        $term_thumbnail = wp_get_attachment_image( $term_thumbnail_id, 'full' , true );

        ?>

        <div id="post-<?php the_ID(); ?>" <?php post_class('content-outlay container-app py-7'); ?> >

            <div class="expert-tax container-inner dual-body">

                <!-- taxonomy's description -->
                <div class="tax-description" >            

                    <div class="tax-description__inner d-flex">
                        
                        <?php if ($page_data) { ?>

                            <!-- Display the page content -->
                            
                            <!-- page titel -->
                            <h2 class="tax-description__title" ><?php echo esc_html( $page_data[ 'title' ] ) ?></h2>

                            <!-- page thumbnail or placeholder -->
                            <?php if ($page_data['thumbnail_html']) : ?>

                                <figure class="expert-tax__image"><?php echo $page_data['thumbnail_html']; ?></figure>

                            <?php endif; ?>     
                        
                        <?php

                            // display the page content
                            echo $page_data [ 'content' ];      
 
                        } else { ?>                        

                        <!-- Display the taxonomy term's content -->
                        
                        <!--term title -->
                        <h2 class="tax-description__title" ><?php echo esc_html(single_term_title()) ?></h2>

                            <!-- page thumbnail or placeholder -->
                            <?php if ( ! empty ( $term_thumbnail_id ) ) : ?>

                                <figure class="expert-tax__image"><?php echo $term_thumbnail ?></figure>

                            <?php endif; ?>   

                            <?php  
                            
                            // taxonomy term description
                            echo term_description();

                        }?>   

                    </div>
        

                </div> 
                    
                <!-- terms posts -->
        
                <?php lc_tax_services ();  ?>

            </div>    

            <?php // get_sidebar(); ?>

        </div>