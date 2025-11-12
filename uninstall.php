<?php
/**
 * EC3 Toolkit Uninstall Handler
 * Fired when the plugin is uninstalled
 *
 * @package EC3_Toolkit
 * @since 1.1.6
 */

// If uninstall not called from WordPress, exit
if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}

/**
 * Clean up plugin data
 */
function ec3_toolkit_uninstall() {
    // Delete plugin transients
    delete_transient('ec3_toolkit_activated');

    // Delete plugin options (if any are added in future)
    // delete_option('ec3_toolkit_option_name');

    // Note: We don't delete custom post types or taxonomies data
    // as this may be valuable content for the user
    // If you need to delete CPT/taxonomy data, uncomment and modify:
    /*
    global $wpdb;
    $wpdb->query("DELETE FROM {$wpdb->posts} WHERE post_type = 'your_post_type'");
    $wpdb->query("DELETE FROM {$wpdb->term_taxonomy} WHERE taxonomy = 'your_taxonomy'");
    */

    // Clear any cached data
    wp_cache_flush();
}

// Run uninstall
ec3_toolkit_uninstall();
