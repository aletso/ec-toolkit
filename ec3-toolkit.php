<?php
/**
 * Plugin Name: EC3 Toolkit
 * Plugin URI: https://aletso.com
 * Description: Professional WordPress toolkit for EC3 with Elementor widgets
 * Version: 1.1.4
 * Author: Aletso
 * Author URI: https://aletso.com
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: ec3-toolkit
 * Domain Path: /languages
 * Requires at least: 5.9
 * Requires PHP: 7.4
 * GitHub Plugin URI: https://github.com/aletso/ec3-toolkit
 * Primary Branch: main
 *
 * @package EC3_Toolkit
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Define plugin constants
define('EC3_TOOLKIT_VERSION', '1.1.4');
define('EC3_TOOLKIT_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('EC3_TOOLKIT_PLUGIN_URL', plugin_dir_url(__FILE__));
define('EC3_TOOLKIT_PLUGIN_BASENAME', plugin_basename(__FILE__));

/**
 * Main EC3 Toolkit Class
 *
 * @since 1.0.0
 */
final class EC3_Toolkit {

    /**
     * Single instance of the class
     *
     * @var EC3_Toolkit|null
     */
    private static $instance = null;

    /**
     * Elementor widgets handler instance
     *
     * @var EC3_Toolkit_Elementor_Widgets|null
     */
    private $elementor_widgets = null;

    /**
     * Get single instance
     *
     * @return EC3_Toolkit
     */
    public static function get_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Constructor - Private to prevent direct instantiation
     */
    private function __construct() {
        $this->init();
    }

    /**
     * Prevent cloning
     */
    private function __clone() {}

    /**
     * Prevent unserialization
     */
    public function __wakeup() {
        throw new Exception('Cannot unserialize singleton');
    }

    /**
     * Initialize the plugin
     *
     * @return void
     */
    private function init() {
        // Load plugin text domain
        add_action('plugins_loaded', array($this, 'load_textdomain'));

        // Load dependencies
        add_action('plugins_loaded', array($this, 'load_dependencies'), 5);

        // Initialize components
        add_action('plugins_loaded', array($this, 'init_components'), 10);

        // Register activation and deactivation hooks
        register_activation_hook(__FILE__, array($this, 'activate'));
        register_deactivation_hook(__FILE__, array($this, 'deactivate'));
    }

    /**
     * Load plugin text domain for translations
     *
     * @return void
     */
    public function load_textdomain() {
        load_plugin_textdomain(
            'ec3-toolkit',
            false,
            dirname(EC3_TOOLKIT_PLUGIN_BASENAME) . '/languages'
        );
    }

    /**
     * Load plugin dependencies
     *
     * @return void
     */
    public function load_dependencies() {
        // Load Elementor widgets handler
        require_once EC3_TOOLKIT_PLUGIN_DIR . 'includes/class-elementor-widgets.php';
    }

    /**
     * Initialize plugin components
     *
     * @return void
     */
    public function init_components() {
        // Initialize Elementor widgets
        $this->elementor_widgets = new EC3_Toolkit_Elementor_Widgets();
    }

    /**
     * Plugin activation hook
     *
     * @return void
     */
    public function activate() {
        // Check PHP version
        if (version_compare(PHP_VERSION, '7.4', '<')) {
            deactivate_plugins(EC3_TOOLKIT_PLUGIN_BASENAME);
            wp_die(
                esc_html__('EC3 Toolkit requires PHP 7.4 or higher.', 'ec3-toolkit'),
                esc_html__('Plugin Activation Error', 'ec3-toolkit'),
                array('back_link' => true)
            );
        }

        // Check WordPress version
        if (version_compare(get_bloginfo('version'), '5.9', '<')) {
            deactivate_plugins(EC3_TOOLKIT_PLUGIN_BASENAME);
            wp_die(
                esc_html__('EC3 Toolkit requires WordPress 5.9 or higher.', 'ec3-toolkit'),
                esc_html__('Plugin Activation Error', 'ec3-toolkit'),
                array('back_link' => true)
            );
        }

        // Set activation flag for any setup needed on first load
        set_transient('ec3_toolkit_activated', true, 30);

        // Flush rewrite rules
        flush_rewrite_rules();
    }

    /**
     * Plugin deactivation hook
     *
     * @return void
     */
    public function deactivate() {
        // Flush rewrite rules
        flush_rewrite_rules();

        // Clean up transients
        delete_transient('ec3_toolkit_activated');
    }

    /**
     * Get Elementor widgets handler instance
     *
     * @return EC3_Toolkit_Elementor_Widgets|null
     */
    public function get_elementor_widgets() {
        return $this->elementor_widgets;
    }
}

/**
 * Get the main instance of EC3 Toolkit
 *
 * @return EC3_Toolkit
 */
function ec3_toolkit() {
    return EC3_Toolkit::get_instance();
}

// Initialize the plugin
ec3_toolkit();
