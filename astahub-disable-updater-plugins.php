<?php
/*
Plugin Name: Astahub - Disable updater, plugin, themes, and tools
Plugin URI: https://github.com/astahub/astahub-disable-updater-plugins
Description: Disable WordPress updater, plugin, themes, and tools on the admin page.
Author: harisrozak
Author URI: https://github.com/harisrozak
Version: 0.1
Text Domain: astahub-disable-updater-plugins
License: GPL version 2 or later - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
*/

add_action('init', 'astahub_disable_updater_plugins', 11);
function astahub_disable_updater_plugins() {
    # Disable the Plugin and Theme Editor
    define( 'DISALLOW_FILE_EDIT', true );

    # Disable Plugin and Theme Update and Installation
    define( 'DISALLOW_FILE_MODS', true );
    
    # Disable WordPress Auto Updates
    define( 'AUTOMATIC_UPDATER_DISABLED', true );

    # Enable Core Updates For Minor Releases
    define( 'WP_AUTO_UPDATE_CORE', 'minor' );
}

// Remove plugins and tools in menu
add_action('admin_menu', 'astahub_disable_updater_plugins_admin_menu');
function astahub_disable_updater_plugins_admin_menu() {
    remove_menu_page('tools.php');
    remove_menu_page('plugins.php');
    remove_submenu_page('themes.php', 'themes.php');
    remove_submenu_page('themes.php', 'theme-editor.php');
}

// Redirect any user trying to access disabled page
add_action('admin_init', 'astahub_disable_updater_plugins_admin_menu_redirect');
function astahub_disable_updater_plugins_admin_menu_redirect() {
    global $pagenow;
    
    // redirect tools.php
    if ($pagenow === 'tools.php') {
        wp_redirect(admin_url()); exit;
    }

    // redirect themes.php
    if ($pagenow === 'themes.php') {
        wp_redirect(admin_url()); exit;
    }

    // redirect theme-editor.php
    if ($pagenow === 'theme-editor.php') {
        wp_redirect(admin_url()); exit;
    }
}