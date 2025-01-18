
<section 

<?php
    // 1. Slider . $i Image Set
    $banner_image = get_template_directory_uri() . '/public/images/items-judges.webp'; // 
    if (get_theme_mod('front_banner_image','') != '') 
    {
        $banner_image = wp_get_attachment_url(get_theme_mod('front_banner_image',''));
    } 

    
	// 4. Slide Buttons
	$banner_url =esc_url( '#main');                             
	if(get_theme_mod('front_banner_url','') !='')
	{
		$button_url = get_theme_mod('front_banner_url','');
	}
						
	$banner_label =esc_html( 'Scroll');                             
	if(get_theme_mod('front_banner_labels','') !='')
	{
		$button_label = get_theme_mod('front_banner_label',''); 
	}

?>

class="<?php 

                if(is_front_page()){ 
                
                    echo esc_attr(' banner__front bg-image-center '); 
                
                } elseif (is_singular('post')) {

                    echo esc_attr('banner__single_post bg-image-center');

                } elseif (is_singular('projects')) {

                    echo esc_attr('banner__single_project bg-image-center');

                } elseif (is_home()) {

                    echo esc_attr(' banner__taxes bg-image-center '); 

                } else if (is_archive() || is_singular('people') || is_page('contact') ){

                    echo esc_attr(' banner__taxes bg-image-center '); 

                } else {

                    echo esc_attr(' banner__pages bg-image-center '); 

                }                  
                   
                ?>" 

style="background-image: url('<?php 

                if (is_front_page()) { 

                        echo $banner_image;  //

                } elseif (is_home()) {

                    if (function_exists('header_image')) {

                        header_image();

                    }
                    
                }
                else{

                    if (has_post_thumbnail()) {
                        
                        the_post_thumbnail_url('post-thumbnail', array('class' => 'card-img', 'alt' => 'the_title', 'title' => single_cat_title(), ));

                    }
                        
                }?>')"

><!-- site-banner -->
    
<div class="<?php echo esc_attr(' banner-overlay d-flex flex-column'); ?>" >
                                
    <div class="<?php echo esc_attr(' banner-overlay-inner container-app '); ?>" >
                
        <?php 
                
            if(is_front_page()) { 

                get_template_part( 'template-parts/header/front-banner-texts' );

            } 
            else{ 

                get_template_part( 'template-parts/header/page-header' );
                
            } 
                
        ?>
        
    </div>

    <?php if (is_front_page()) { ?>
        								
        <!-- <a class="<?php echo esc_attr(' btn btn-primary btn-front '); ?>" type="<?php echo esc_attr(' submit '); ?>" href="<?php echo esc_url($banner_url); ?>" ><?php echo esc_html($banner_label) ?><i class="<?php echo esc_attr('fas fa-chevron-circle-down ms-2'); ?>"></i></a>-->

   <?php }?>

</div>

</section>