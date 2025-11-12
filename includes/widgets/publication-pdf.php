<?php
/**
 * EC3 Toolkit Publication PDF Widget
 * Elementor widget for displaying publication PDF with viewer and download
 *
 * @package EC3_Toolkit
 * @since 1.1.6
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Class EC3_Toolkit_Widget_Publication_PDF
 *
 * @since 1.1.6
 */
class EC3_Toolkit_Widget_Publication_PDF extends \Elementor\Widget_Base {

    /**
     * Get widget name
     *
     * @return string Widget name
     */
    public function get_name() {
        return 'ec3_publication_pdf';
    }

    /**
     * Get widget title
     *
     * @return string Widget title
     */
    public function get_title() {
        return esc_html__('Publication PDF', 'ec3-toolkit');
    }

    /**
     * Get widget icon
     *
     * @return string Widget icon
     */
    public function get_icon() {
        return 'eicon-file-download';
    }

    /**
     * Get widget categories
     *
     * @return array Widget categories
     */
    public function get_categories() {
        return array('ec3-toolkit');
    }

    /**
     * Get widget keywords
     *
     * @return array Widget keywords
     */
    public function get_keywords() {
        return array('pdf', 'publication', 'ec3', 'document', 'download');
    }

    /**
     * Register widget controls
     *
     * @return void
     */
    protected function register_controls() {
        // Content Section
        $this->start_controls_section(
            'content_section',
            array(
                'label' => esc_html__('Content', 'ec3-toolkit'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'source_type',
            array(
                'label'   => esc_html__('Source', 'ec3-toolkit'),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => 'current',
                'options' => array(
                    'current' => esc_html__('Current Post', 'ec3-toolkit'),
                    'custom'  => esc_html__('Custom Post ID', 'ec3-toolkit'),
                ),
            )
        );

        $this->add_control(
            'post_id',
            array(
                'label'       => esc_html__('Post ID', 'ec3-toolkit'),
                'type'        => \Elementor\Controls_Manager::NUMBER,
                'default'     => '',
                'condition'   => array(
                    'source_type' => 'custom',
                ),
                'description' => esc_html__('Enter the post ID to display PDF from', 'ec3-toolkit'),
            )
        );

        $this->add_control(
            'show_download',
            array(
                'label'        => esc_html__('Show Download Button', 'ec3-toolkit'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Show', 'ec3-toolkit'),
                'label_off'    => esc_html__('Hide', 'ec3-toolkit'),
                'return_value' => 'yes',
                'default'      => 'yes',
            )
        );

        $this->add_control(
            'download_text',
            array(
                'label'     => esc_html__('Download Button Text', 'ec3-toolkit'),
                'type'      => \Elementor\Controls_Manager::TEXT,
                'default'   => esc_html__('Download PDF', 'ec3-toolkit'),
                'condition' => array(
                    'show_download' => 'yes',
                ),
            )
        );

        $this->end_controls_section();

        // PDF Viewer Section
        $this->start_controls_section(
            'viewer_section',
            array(
                'label' => esc_html__('PDF Viewer', 'ec3-toolkit'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_responsive_control(
            'pdf_height',
            array(
                'label'      => esc_html__('Height', 'ec3-toolkit'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => array('px', 'vh'),
                'range'      => array(
                    'px' => array(
                        'min' => 200,
                        'max' => 2000,
                    ),
                    'vh' => array(
                        'min' => 10,
                        'max' => 100,
                    ),
                ),
                'default'    => array(
                    'unit' => 'px',
                    'size' => 600,
                ),
                'selectors'  => array(
                    '{{WRAPPER}} .ec3-pdf-iframe' => 'height: {{SIZE}}{{UNIT}}',
                ),
            )
        );

        $this->end_controls_section();

        // Download Button Style
        $this->start_controls_section(
            'button_style_section',
            array(
                'label'     => esc_html__('Download Button', 'ec3-toolkit'),
                'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => array(
                    'show_download' => 'yes',
                ),
            )
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            array(
                'name'     => 'button_typography',
                'label'    => esc_html__('Typography', 'ec3-toolkit'),
                'selector' => '{{WRAPPER}} .ec3-pdf-download-link',
            )
        );

        $this->start_controls_tabs('button_style_tabs');

        // Normal State
        $this->start_controls_tab(
            'button_normal',
            array(
                'label' => esc_html__('Normal', 'ec3-toolkit'),
            )
        );

        $this->add_control(
            'button_text_color',
            array(
                'label'     => esc_html__('Text Color', 'ec3-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .ec3-pdf-download-link' => 'color: {{VALUE}}',
                ),
            )
        );

        $this->add_control(
            'button_background_color',
            array(
                'label'     => esc_html__('Background Color', 'ec3-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .ec3-pdf-download-link' => 'background-color: {{VALUE}}',
                ),
            )
        );

        $this->end_controls_tab();

        // Hover State
        $this->start_controls_tab(
            'button_hover',
            array(
                'label' => esc_html__('Hover', 'ec3-toolkit'),
            )
        );

        $this->add_control(
            'button_hover_text_color',
            array(
                'label'     => esc_html__('Text Color', 'ec3-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .ec3-pdf-download-link:hover' => 'color: {{VALUE}}',
                ),
            )
        );

        $this->add_control(
            'button_hover_background_color',
            array(
                'label'     => esc_html__('Background Color', 'ec3-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .ec3-pdf-download-link:hover' => 'background-color: {{VALUE}}',
                ),
            )
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            'button_padding',
            array(
                'label'      => esc_html__('Padding', 'ec3-toolkit'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => array('px', 'em', '%'),
                'selectors'  => array(
                    '{{WRAPPER}} .ec3-pdf-download-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ),
                'separator'  => 'before',
            )
        );

        $this->add_responsive_control(
            'button_margin',
            array(
                'label'      => esc_html__('Margin', 'ec3-toolkit'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => array('px', 'em', '%'),
                'selectors'  => array(
                    '{{WRAPPER}} .ec3-pdf-download' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ),
            )
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            array(
                'name'     => 'button_border',
                'label'    => esc_html__('Border', 'ec3-toolkit'),
                'selector' => '{{WRAPPER}} .ec3-pdf-download-link',
            )
        );

        $this->add_control(
            'button_border_radius',
            array(
                'label'      => esc_html__('Border Radius', 'ec3-toolkit'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => array('px', '%'),
                'selectors'  => array(
                    '{{WRAPPER}} .ec3-pdf-download-link' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ),
            )
        );

        $this->end_controls_section();

        // PDF Container Style
        $this->start_controls_section(
            'container_style_section',
            array(
                'label' => esc_html__('Container', 'ec3-toolkit'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            array(
                'name'     => 'container_border',
                'label'    => esc_html__('Border', 'ec3-toolkit'),
                'selector' => '{{WRAPPER}} .ec3-pdf-iframe',
            )
        );

        $this->add_control(
            'container_border_radius',
            array(
                'label'      => esc_html__('Border Radius', 'ec3-toolkit'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => array('px', '%'),
                'selectors'  => array(
                    '{{WRAPPER}} .ec3-pdf-iframe' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ),
            )
        );

        $this->end_controls_section();
    }

    /**
     * Render widget output on the frontend
     *
     * @return void
     */
    protected function render() {
        $settings = $this->get_settings_for_display();

        // Determine post ID
        $post_id = ($settings['source_type'] === 'custom' && !empty($settings['post_id']))
            ? absint($settings['post_id'])
            : get_the_ID();

        // Validate post ID
        if (!$post_id || get_post_status($post_id) === false) {
            if (\Elementor\Plugin::$instance->editor->is_edit_mode()) {
                echo '<div class="ec3-pdf-error">';
                echo esc_html__('No valid post found. Please check your settings.', 'ec3-toolkit');
                echo '</div>';
            }
            return;
        }

        // Get PDF URL
        $pdf_url = $this->get_pdf_url($post_id);

        if (!$pdf_url) {
            if (\Elementor\Plugin::$instance->editor->is_edit_mode()) {
                echo '<div class="ec3-pdf-error">';
                echo esc_html__('No PDF found for this post.', 'ec3-toolkit');
                echo '</div>';
            }
            return;
        }

        // Render PDF viewer
        $this->render_pdf_viewer($pdf_url, $settings);
    }

    /**
     * Get PDF URL from ACF field
     *
     * @param int $post_id Post ID
     * @return string|false PDF URL or false if not found
     */
    private function get_pdf_url($post_id) {
        // Check if ACF is active
        if (!function_exists('get_field')) {
            return false;
        }

        $pdf = get_field('pdf', $post_id);

        // Handle array (ACF file field)
        if (is_array($pdf) && isset($pdf['url'])) {
            return esc_url($pdf['url']);
        }

        // Handle string (URL field)
        if (is_string($pdf) && !empty($pdf)) {
            return esc_url($pdf);
        }

        return false;
    }

    /**
     * Render PDF viewer
     *
     * @param string $pdf_url PDF URL
     * @param array  $settings Widget settings
     * @return void
     */
    private function render_pdf_viewer($pdf_url, $settings) {
        ?>
        <div class="ec3-pdf-container">
            <?php if ($settings['show_download'] === 'yes'): ?>
                <div class="ec3-pdf-download">
                    <a href="<?php echo esc_url($pdf_url); ?>"
                       target="_blank"
                       class="ec3-pdf-download-link"
                       download>
                        <?php echo esc_html($settings['download_text']); ?>
                    </a>
                </div>
            <?php endif; ?>

            <div class="ec3-pdf-iframe-container">
                <iframe
                    src="<?php echo esc_url($pdf_url . '#navpanes=0&scrollbar=1'); ?>"
                    width="100%"
                    frameborder="0"
                    allowfullscreen
                    class="ec3-pdf-iframe">
                    <p>
                        <?php esc_html_e('Your browser does not support iframes.', 'ec3-toolkit'); ?>
                        <a href="<?php echo esc_url($pdf_url); ?>" target="_blank">
                            <?php esc_html_e('Click here to view the PDF', 'ec3-toolkit'); ?>
                        </a>
                    </p>
                </iframe>
            </div>
        </div>
        <?php
    }
}
