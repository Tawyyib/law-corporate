
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
                        title: 'Select or Upload SVG Icon', 
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