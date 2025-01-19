<?php
/**
 * Register the required plugins for law-corporate theme.
 *
 * The variables passed to the `tgmpa()` function should be:
 * - an array of plugin arrays;
 * - optionally a configuration array.
 * If you are not changing anything in the configuration array, you can remove the array and remove the
 * variable from the function call: `tgmpa( $plugins );`.
 * In that case, the TGMPA default settings will be used.
 *
 * This function is hooked into `tgmpa_register`, which is fired on the WP `init` action on priority 10.
 */

function lc_register_required_theme_plugins() {
    /*
     * Array of plugin arrays. Required keys are name and slug.
     * If is_callable() is used, then the function should be present and return a boolean.
     */
    $plugins = array(

        array(
            'name'                  => 'Law Corporate Custom UI', // The plugin name
            'slug'                  => 'law-corporate-custom-ui', // The plugin slug (typically the folder name)
            'source'                => get_template_directory() . '/plugins/law-corporate-custom-ui.zip', // The plugin source (path to .zip or folder)
            'required'              => true, // If false, the plugin is only 'recommended'
            'version'             => '1.0.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is displayed.
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated.
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
            'is_callable'           => '', // If set, this callable will be be checked for availability to determine if the plugin is active.
        ),

        array(
            'name'                  => 'New Custom MIME Types and Uploads', // The plugin name
            'slug'                  => 'custom-mime-types-uploads', // The plugin slug (typically the folder name)
            'source'                => get_template_directory() . '/plugins/custom-mime-types-uploads.zip', // The plugin source (path to .zip or folder)
            'required'              => true, // If false, the plugin is only 'recommended'
            'version'             => '1.0.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is displayed.
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated.
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
            'is_callable'           => '', // If set, this callable will be be checked for availability to determine if the plugin is active.
        ),

    );

    /*
     * Array of configuration settings. Amend each line as needed.
     */
    $config = array(
        'id'                   => 'law-corporate',                 // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path'  => '',                      // Default absolute path to pre-packaged plugins (optional).
        'menu'             => 'tgmpa-install-plugins', // Menu slug.
        'has_notices'    => true,                    // Show admin notices or not.
        'dismissable'    => true,                    // Allow dismissing nag messages (optional).
        'dismiss_msg'  => '',                      // Custom dismiss message (optional).
        'is_automatic'  => false,                   // Automatically activate plugins (optional).
        'message'        => '',                      // Message before plugin table (optional).
        'strings'           => array(
                            'page_title'     =>     __( 'Install Required Plugins', 'law-corporate' ),
                            'menu_title'    =>     __( 'Install Plugins', 'law-corporate' ),
        ),
    );

    tgmpa( $plugins, $config ); // Call TGMPA to register and manage plugins
}

add_action( 'tgmpa_register', 'lc_register_required_theme_plugins' );
