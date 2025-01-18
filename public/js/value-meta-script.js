jQuery(document).ready(function($) {    

    var frame;

    $('#upload_image_button').on('click', function(e) {

        e.preventDefault();

        if (frame) {
            frame.open();
            return;
        }

        frame = wp.media({
            title: 'Select or Upload Background Image',
            button: {
                text: 'Use this image'
            },
            multiple: false
        });

        frame.on('select', function() {
            var attachment = frame.state().get('selection').first().toJSON();
            console.log('Image selected:', attachment.url); // Debugging
            $('#background_image').val(attachment.url);

            if ($('#background_image_preview').length === 0) {
                $('#upload_image_button').before('<div id="background_image_preview" style="margin-bottom: 10px; width: 720px;"><img src="" style="max-width: 100%; height: auto;" /><br /></div>');
            }

            $('#background_image_preview img').attr('src', attachment.url);
            $('#background_image_preview').show();

            if ($('#remove_background_image').length === 0) {
                $('#upload_image_button').before('<button type="button" class="button" id="remove_background_image">Remove Image</button>');
            }
        });

        frame.open();
    });

    $(document).on('click', '#remove_background_image', function(e) {
        e.preventDefault();
        console.log('Image removed'); // Debugging
        $('#background_image').val('');
        $('#background_image_preview').hide();
        $(this).remove(); // Remove the remove button
    });

    // Initial load: Check if there's already an image and show the preview
    var initialImage = $('#background_image').val();
    if (initialImage) {
        console.log('Initial image:', initialImage); // Debugging
        if ($('#background_image_preview').length === 0) {
            $('#upload_image_button').before('<div id="background_image_preview" style="margin-bottom: 10px; width: 720px;"><img src="" style="max-width: 100%; height: auto;" /><br /></div>');
        }
        $('#background_image_preview img').attr('src', initialImage);
        $('#background_image_preview').show();

        if ($('#remove_background_image').length === 0) {
            $('#upload_image_button').before('<button type="button" class="button" id="remove_background_image">Remove Image</button>');
        }
    } else {
        $('#background_image_preview').hide();
    }
});

/** 

jQuery(document).ready(function($) {

    var frame;

    $('#upload_image_button').on('click', function(e) {

        e.preventDefault();

        if (frame) {
            frame.open();
            return;
        }

        frame = wp.media({
            title: 'Select or Upload Background Image',
            button: {
                text: 'Use this image'
            },
            multiple: false
        });

        frame.on('select', function() {
            var attachment = frame.state().get('selection').first().toJSON();
            $('#background_image').val(attachment.url);
            $('#background_image_preview img').attr('src', attachment.url);
            $('#background_image_preview').show();
        });

        frame.open();
    });

    $('#remove_background_image').on('click', function(e) {
        e.preventDefault();
        $('#background_image').val('');
        $('#background_image_preview').hide();
    });
});

	
/** 
function enqueue_value_props_meta_box_scripts($hook) {
    global $post;
    if ($hook == 'post-new.php' || $hook == 'post.php') {
        if ($post && get_post_meta($post->ID, '_wp_page_template', true) == 'page-about.php') {
            wp_enqueue_media();
            wp_enqueue_script('value-props-meta-box', get_template_directory_uri() . '/public/js/value-meta-script.js', array('jquery'), null, true);
        }
    }
}
add_action('admin_enqueue_scripts', 'enqueue_value_props_meta_box_scripts');
*/