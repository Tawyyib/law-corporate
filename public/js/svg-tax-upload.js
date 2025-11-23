/*
            jQuery(document).ready(function($) {

                function updateIconPreview(iconUrl) {
                    $('#taxonomy-icon-preview').html('<img src="' + iconUrl + '" alt="" style="max-width:100%;"/>');
                }

                function clearIconPreview() {
                    $('#taxonomy-icon').val('');
                    $('#taxonomy-icon-preview').html('');
                }

                // Initial load: Check if there's already an image and show the preview
                var initialIconId = $('#taxonomy-icon').val();
                if (initialIconId) {
                    wp.media.attachment(initialIconId).fetch().then(function() {
                        updateIconPreview(this.get('url'));
                    });
                }

                $('#taxonomy-icon-button').click(function(e) {
                    e.preventDefault();

                    var iconFrame;

                    if (iconFrame) {
                        iconFrame.open();
                        return;
                    }
                    iconFrame = wp.media({
                        title: 'Select or Upload Thumbnail', 
                        button: {
                            text: 'Use this icon',
                        },
                        library: {
                            type: 'image/svg+xml'
                        },
                        multiple: false
                    });

                    iconFrame.on('select', function() {
                        var attachment = iconFrame.state().get('selection').first().toJSON();
                        $('#taxonomy-icon').val(attachment.id);
                        updateIconPreview(attachment.url);
                    });

                    iconFrame.open();
                });

                $('#taxonomy-remove-icon-button').click(function(e) {
                    e.preventDefault();
                    clearIconPreview();
                });

            });

            */

jQuery(document).ready(function($) {

    //
    // === ICON UPLOAD FIELD ===
    //
    function updateIconPreview(iconUrl) {
        $('#taxonomy-icon-preview').html('<img src="' + iconUrl + '" alt="" style="max-width:100%;"/>');
    }

    function clearIconPreview() {
        $('#taxonomy-icon').val('');
        $('#taxonomy-icon-preview').html('');
    }

    // Initial load: display saved icon if available
    var initialIconId = $('#taxonomy-icon').val();
    if (initialIconId) {
        wp.media.attachment(initialIconId).fetch().then(function() {
            updateIconPreview(this.get('url'));
        });
    }

    $('#taxonomy-icon-button').on('click', function(e) {
        e.preventDefault();

        let iconFrame = wp.media({
            title: 'Select or Upload Icon',
            button: { text: 'Use this icon' },
            library: { type: 'image/svg+xml' },
            multiple: false
        });

        iconFrame.on('select', function() {
            let attachment = iconFrame.state().get('selection').first().toJSON();
            $('#taxonomy-icon').val(attachment.id);
            updateIconPreview(attachment.url);
        });

        iconFrame.open();
    });

    $('#taxonomy-remove-icon-button').on('click', function(e) {
        e.preventDefault();
        clearIconPreview();
    });


    //
    // === FEATURED (BANNER) IMAGE FIELD ===
    //
    function updateFeaturedPreview(imgUrl) {
        $('#taxonomy-featured-preview').html('<img src="' + imgUrl + '" alt="" style="max-width:100%;"/>');
    }

    function clearFeaturedPreview() {
        $('#taxonomy-featured-image').val('');
        $('#taxonomy-featured-preview').html('');
    }

    // Initial load: display saved banner if available
    var initialFeaturedId = $('#taxonomy-featured-image').val();
    if (initialFeaturedId) {
        wp.media.attachment(initialFeaturedId).fetch().then(function() {
            updateFeaturedPreview(this.get('url'));
        });
    }

    $('#taxonomy-featured-button').on('click', function(e) {
        e.preventDefault();

        let featuredFrame = wp.media({
            title: 'Select or Upload Banner Image',
            button: { text: 'Use this image' },
            library: { type: 'image' },
            multiple: false
        });

        featuredFrame.on('select', function() {
            let attachment = featuredFrame.state().get('selection').first().toJSON();
            $('#taxonomy-featured-image').val(attachment.id);
            updateFeaturedPreview(attachment.url);
        });

        featuredFrame.open();
    });

    $('#taxonomy-remove-featured-button').on('click', function(e) {
        e.preventDefault();
        clearFeaturedPreview();
    });
});
