<?php
/**
 * EC3 Toolkit Elementor Widgets Handler
 * Handles Elementor widget registration and initialization
 *
 * @package EC3_Toolkit
 * @since 1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Class EC3_Toolkit_Elementor_Widgets
 *
 * @since 1.0.0
 */
class EC3_Toolkit_Elementor_Widgets {

    /**
     * Constructor
     */
    public function __construct() {
        $this->init_hooks();
    }

    /**
     * Initialize hooks
     *
     * @return void
     */
    private function init_hooks() {
        // Check if Elementor is installed and activated
        add_action('plugins_loaded', array($this, 'check_elementor'));

        // Register widgets
        add_action('elementor/widgets/register', array($this, 'register_widgets'));

        // Register widget categories
        add_action('elementor/elements/categories_registered', array($this, 'register_widget_categories'));
    }

    /**
     * Check if Elementor is installed and activated
     *
     * @return void
     */
    public function check_elementor() {
        if (!did_action('elementor/loaded')) {
            add_action('admin_notices', array($this, 'missing_elementor_notice'));
            return;
        }

        // Check for required Elementor version
        if (!version_compare(ELEMENTOR_VERSION, '3.0.0', '>=')) {
            add_action('admin_notices', array($this, 'minimum_elementor_version_notice'));
            return;
        }
    }

    /**
     * Admin notice for missing Elementor
     *
     * @return void
     */
    public function missing_elementor_notice() {
        $message = sprintf(
            /* translators: 1: Plugin name 2: Elementor */
            esc_html__('"%1$s" requires "%2$s" to be installed and activated.', 'ec3-toolkit'),
            '<strong>' . esc_html__('EC3 Toolkit', 'ec3-toolkit') . '</strong>',
            '<strong>' . esc_html__('Elementor', 'ec3-toolkit') . '</strong>'
        );

        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', wp_kses_post($message));
    }

    /**
     * Admin notice for minimum Elementor version
     *
     * @return void
     */
    public function minimum_elementor_version_notice() {
        $message = sprintf(
            /* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
            esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'ec3-toolkit'),
            '<strong>' . esc_html__('EC3 Toolkit', 'ec3-toolkit') . '</strong>',
            '<strong>' . esc_html__('Elementor', 'ec3-toolkit') . '</strong>',
            '3.0.0'
        );

        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', wp_kses_post($message));
    }

    /**
     * Register widget categories
     *
     * @param \Elementor\Elements_Manager $elements_manager Elementor elements manager
     * @return void
     */
    public function register_widget_categories($elements_manager) {
        $elements_manager->add_category(
            'ec3-toolkit',
            array(
                'title' => esc_html__('EC3 Toolkit', 'ec3-toolkit'),
                'icon'  => 'fa fa-plug',
            )
        );
    }

    /**
     * Register widgets
     *
     * @param \Elementor\Widgets_Manager $widgets_manager Elementor widgets manager
     * @return void
     */
    public function register_widgets($widgets_manager) {
        // Include widget files
        require_once EC3_TOOLKIT_PLUGIN_DIR . 'includes/widgets/publication-authors.php';
        require_once EC3_TOOLKIT_PLUGIN_DIR . 'includes/widgets/publication-pdf.php';

        // Register widgets
        $widgets_manager->register(new \EC3_Toolkit_Widget_Publication_Authors());
        $widgets_manager->register(new \EC3_Toolkit_Widget_Publication_PDF());
    }
}
