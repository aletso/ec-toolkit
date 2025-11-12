<?php
/**
 * EC3 Toolkit Publication Authors Widget
 * Elementor widget for displaying publication authors with institutions
 *
 * @package EC3_Toolkit
 * @since 1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Class EC3_Toolkit_Widget_Publication_Authors
 *
 * @since 1.0.0
 */
class EC3_Toolkit_Widget_Publication_Authors extends \Elementor\Widget_Base {

    /**
     * Get widget name
     *
     * @return string Widget name
     */
    public function get_name() {
        return 'ec3_publication_authors';
    }

    /**
     * Get widget title
     *
     * @return string Widget title
     */
    public function get_title() {
        return esc_html__('Publication Authors', 'ec3-toolkit');
    }

    /**
     * Get widget icon
     *
     * @return string Widget icon
     */
    public function get_icon() {
        return 'eicon-person';
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
        return array('authors', 'publication', 'ec3', 'institutions');
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
                'description' => esc_html__('Enter the post ID to display authors from', 'ec3-toolkit'),
            )
        );

        $this->end_controls_section();

        // Authors Style Section
        $this->start_controls_section(
            'authors_style_section',
            array(
                'label' => esc_html__('Authors', 'ec3-toolkit'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            array(
                'name'     => 'authors_typography',
                'label'    => esc_html__('Typography', 'ec3-toolkit'),
                'selector' => '{{WRAPPER}} .ec3-authors-names',
            )
        );

        $this->add_control(
            'authors_color',
            array(
                'label'     => esc_html__('Color', 'ec3-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .ec3-authors-names' => 'color: {{VALUE}}',
                ),
            )
        );

        $this->add_responsive_control(
            'authors_spacing',
            array(
                'label'      => esc_html__('Spacing', 'ec3-toolkit'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => array('px', 'em'),
                'range'      => array(
                    'px' => array(
                        'min' => 0,
                        'max' => 100,
                    ),
                    'em' => array(
                        'min' => 0,
                        'max' => 10,
                    ),
                ),
                'default'    => array(
                    'unit' => 'px',
                    'size' => 10,
                ),
                'selectors'  => array(
                    '{{WRAPPER}} .ec3-authors-names' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                ),
            )
        );

        $this->end_controls_section();

        // Institutions Style Section
        $this->start_controls_section(
            'institutions_style_section',
            array(
                'label' => esc_html__('Institutions', 'ec3-toolkit'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            array(
                'name'     => 'institutions_typography',
                'label'    => esc_html__('Typography', 'ec3-toolkit'),
                'selector' => '{{WRAPPER}} .ec3-institutions-list',
            )
        );

        $this->add_control(
            'institutions_color',
            array(
                'label'     => esc_html__('Color', 'ec3-toolkit'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .ec3-institutions-list' => 'color: {{VALUE}}',
                ),
            )
        );

        $this->add_responsive_control(
            'institutions_spacing',
            array(
                'label'      => esc_html__('Spacing', 'ec3-toolkit'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => array('px', 'em'),
                'range'      => array(
                    'px' => array(
                        'min' => 0,
                        'max' => 100,
                    ),
                    'em' => array(
                        'min' => 0,
                        'max' => 10,
                    ),
                ),
                'default'    => array(
                    'unit' => 'px',
                    'size' => 10,
                ),
                'selectors'  => array(
                    '{{WRAPPER}} .ec3-institutions-list' => 'margin-top: {{SIZE}}{{UNIT}}',
                ),
            )
        );

        $this->add_responsive_control(
            'institution_item_spacing',
            array(
                'label'      => esc_html__('Item Spacing', 'ec3-toolkit'),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => array('px', 'em'),
                'range'      => array(
                    'px' => array(
                        'min' => 0,
                        'max' => 50,
                    ),
                    'em' => array(
                        'min' => 0,
                        'max' => 5,
                    ),
                ),
                'default'    => array(
                    'unit' => 'px',
                    'size' => 5,
                ),
                'selectors'  => array(
                    '{{WRAPPER}} .ec3-institution-item' => 'margin-bottom: {{SIZE}}{{UNIT}}',
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
                echo '<div class="ec3-authors-error">';
                echo esc_html__('No valid post found. Please check your settings.', 'ec3-toolkit');
                echo '</div>';
            }
            return;
        }

        // Get authors
        $authors = $this->get_authors($post_id);

        if (empty($authors)) {
            if (\Elementor\Plugin::$instance->editor->is_edit_mode()) {
                echo '<div class="ec3-authors-error">';
                echo esc_html__('No authors found for this post.', 'ec3-toolkit');
                echo '</div>';
            }
            return;
        }

        // Render authors
        $this->render_authors($authors);
    }

    /**
     * Get authors from ACF field
     *
     * @param int $post_id Post ID
     * @return array Array of author data
     */
    private function get_authors($post_id) {
        // Check if ACF is active
        if (!function_exists('get_field')) {
            return array();
        }

        $authors = get_field('author', $post_id);

        if (!is_array($authors)) {
            return array();
        }

        return $authors;
    }

    /**
     * Extract clean author name
     *
     * @param string|object|array $author Author data
     * @return string Clean author name
     */
    private function get_author_name($author) {
        // Get author title based on data type
        if (is_object($author)) {
            $author_title = isset($author->post_title) ? $author->post_title : '';
        } elseif (is_array($author)) {
            $author_title = isset($author['post_title']) ? $author['post_title'] : '';
        } else {
            $author_title = (string) $author;
        }

        // Remove institution suffix (text in parentheses)
        if (strpos($author_title, ' (') !== false) {
            $author_title = substr($author_title, 0, strpos($author_title, ' ('));
        }

        return trim($author_title);
    }

    /**
     * Get author ID
     *
     * @param object|array $author Author data
     * @return int Author ID
     */
    private function get_author_id($author) {
        if (is_object($author)) {
            return isset($author->ID) ? absint($author->ID) : 0;
        } elseif (is_array($author)) {
            return isset($author['ID']) ? absint($author['ID']) : 0;
        }
        return 0;
    }

    /**
     * Get author institutions
     *
     * @param int $author_id Author post ID
     * @return array Array of institution names
     */
    private function get_author_institutions($author_id) {
        if (!$author_id) {
            return array();
        }

        $institutions = get_the_terms($author_id, 'institution');

        if (!$institutions || is_wp_error($institutions)) {
            return array();
        }

        $institution_names = array();
        foreach ($institutions as $institution) {
            if (isset($institution->name)) {
                $institution_names[] = sanitize_text_field($institution->name);
            }
        }

        return $institution_names;
    }

    /**
     * Render authors with institutions
     *
     * @param array $authors Array of authors
     * @return void
     */
    private function render_authors($authors) {
        $author_institution_map = array();
        $institution_list = array();

        // Build author-institution mapping
        foreach ($authors as $author) {
            $author_name = $this->get_author_name($author);
            $author_id = $this->get_author_id($author);

            if (empty($author_name)) {
                continue;
            }

            $institutions = $this->get_author_institutions($author_id);

            // Add institutions to global list
            foreach ($institutions as $institution) {
                if (!in_array($institution, $institution_list, true)) {
                    $institution_list[] = $institution;
                }
            }

            $author_institution_map[$author_name] = $institutions;
        }

        echo '<div class="ec3-authors-section">';

        // Render authors with superscript numbers
        echo '<div class="ec3-authors-names">';
        $author_names = array();

        foreach ($author_institution_map as $author_name => $institutions) {
            $escaped_name = esc_html($author_name);

            if (!empty($institutions)) {
                // Map institutions to numbers
                $numbers = array();
                foreach ($institutions as $institution) {
                    $number = array_search($institution, $institution_list, true);
                    if ($number !== false) {
                        $numbers[] = $number + 1;
                    }
                }

                // Sort numbers for consistency
                sort($numbers, SORT_NUMERIC);

                if (!empty($numbers)) {
                    $escaped_name .= '<sup>' . esc_html(implode(',', $numbers)) . '</sup>';
                }
            }

            $author_names[] = $escaped_name;
        }

        echo implode(', ', $author_names);
        echo '</div>';

        // Render institution list
        if (!empty($institution_list)) {
            echo '<div class="ec3-institutions-list">';
            foreach ($institution_list as $index => $institution) {
                $number = $index + 1;
                echo '<div class="ec3-institution-item">';
                echo '<sup>' . esc_html($number) . '</sup> ' . esc_html($institution);
                echo '</div>';
            }
            echo '</div>';
        }

        echo '</div>';
    }
}
