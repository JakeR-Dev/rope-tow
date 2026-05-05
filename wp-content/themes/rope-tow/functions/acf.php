<?php

// Custom ACF field types

add_action('acf/include_field_types', 'my_acf_include_post_type_checkboxes');

function my_acf_include_post_type_checkboxes($version) {
    class acf_field_post_type_checkboxes extends acf_field {

        public function __construct() {
            $this->name = 'post_type_checkboxes';
            $this->label = __('Post Type Checkboxes', 'acf');
            $this->category = 'choice';
            $this->defaults = array();
            parent::__construct();
        }

        public function render_field($field) {
            $value = is_array($field['value']) ? $field['value'] : array();

            // Get all public post types and exclude 'page' and 'attachment'
            $post_types = get_post_types(array('public' => true), 'objects');
            unset($post_types['page'], $post_types['attachment']);

            foreach ($post_types as $post_type) {
                $checked = in_array($post_type->name, $value) ? 'checked' : '';
                echo '<label style="display:block; margin-bottom:4px;">';
                echo "<input type='checkbox' name='{$field['name']}[]' value='{$post_type->name}' {$checked} />";
                echo ' ' . esc_html($post_type->labels->singular_name);
                echo '</label>';
            }
        }

        public function render_field_settings($field) {
            // No custom settings needed
        }

        public function load_value($value, $post_id, $field) {
            return is_array($value) ? $value : array();
        }

        public function update_value($value, $post_id, $field) {
            return is_array($value) ? array_map('sanitize_text_field', $value) : array();
        }

        public function format_value($value, $post_id, $field) {
            return $value;
        }
    }

    new acf_field_post_type_checkboxes();
}

add_action('acf/include_field_types', 'my_acf_include_taxonomy_checkboxes');

function my_acf_include_taxonomy_checkboxes($version) {
    class acf_field_taxonomy_checkboxes extends acf_field {

        public function __construct() {
            $this->name = 'taxonomy_checkboxes';
            $this->label = __('Included Filters', 'acf');
            $this->category = 'choice';
            $this->defaults = array();
            parent::__construct();
        }

        public function render_field($field) {
            $value = is_array($field['value']) ? $field['value'] : array();

            // Get all public taxonomies and exclude 'post_format'
            $taxonomies = get_taxonomies(array('public' => true), 'objects');
            unset($taxonomies['post_format']);

            foreach ($taxonomies as $taxonomy) {
                $checked = in_array($taxonomy->name, $value) ? 'checked' : '';
                echo '<label style="display:block; margin-bottom:4px;">';
                echo "<input type='checkbox' name='{$field['name']}[]' value='{$taxonomy->name}' {$checked} />";
                echo ' ' . esc_html($taxonomy->labels->singular_name);
                echo '</label>';
            }
        }

        public function render_field_settings($field) {
            // No custom settings needed
        }

        public function load_value($value, $post_id, $field) {
            return is_array($value) ? $value : array();
        }

        public function update_value($value, $post_id, $field) {
            return is_array($value) ? array_map('sanitize_text_field', $value) : array();
        }

        public function format_value($value, $post_id, $field) {
            return $value;
        }
    }

    new acf_field_taxonomy_checkboxes();
}

add_action('acf/include_field_types', 'my_acf_include_term_checkboxes');

function my_acf_include_term_checkboxes($version) {
    class acf_field_term_checkboxes extends acf_field {

        public function __construct() {
            $this->name = 'prefiltered_terms';
            $this->label = __('Prefiltered Terms', 'acf');
            $this->category = 'choice';
            $this->defaults = array();
            parent::__construct();
        }

        public function render_field($field) {
            $value = is_array($field['value']) ? $field['value'] : array();

            // Get all public taxonomies and exclude 'post_format'
            $taxonomies = get_taxonomies(array('public' => true), 'objects');
            unset($taxonomies['post_format']);

            foreach ($taxonomies as $taxonomy) {
                $terms = get_terms(array(
                    'taxonomy' => $taxonomy->name,
                    'hide_empty' => false,
                ));

                if (!empty($terms) && !is_wp_error($terms)) {
                    echo '<strong>' . esc_html($taxonomy->labels->singular_name) . '</strong><br>';
                    foreach ($terms as $term) {
                        $checked = (
                            isset($value[$taxonomy->name]) &&
                            in_array($term->name, $value[$taxonomy->name])
                        ) ? 'checked' : '';

                        echo '<label style="display:block; margin-left: 12px;">';
                        echo "<input type='checkbox' name='{$field['name']}[]' value='{$taxonomy->name}|{$term->slug}' {$checked} />";
                        echo ' ' . esc_html($term->name);
                        echo '</label>';
                    }
                    echo '<br>';
                }
            }
        }

        public function render_field_settings($field) {
            // No settings for now
        }

        public function load_value($value, $post_id, $field) {
            return is_array($value) ? $value : array();
        }

        public function update_value($value, $post_id, $field) {
            $organized = array();

            if (is_array($value)) {
                foreach ($value as $item) {
                    // Expect format "taxonomy|term-slug"
                    if (strpos($item, '|') !== false) {
                        list($taxonomy, $term_slug) = explode('|', $item, 2);
                        $term_obj = get_term_by('slug', $term_slug, $taxonomy);

                        if ($term_obj && !is_wp_error($term_obj)) {
                            $taxonomy = sanitize_text_field($taxonomy);
                            $term_name = sanitize_text_field($term_obj->name);

                            if (!isset($organized[$taxonomy])) {
                                $organized[$taxonomy] = array();
                            }

                            $organized[$taxonomy][] = $term_name;
                        }
                    }
                }
            }

            return $organized;
        }

        public function format_value($value, $post_id, $field) {
            return $value;
        }
    }

    new acf_field_term_checkboxes();
}

// Save JSON to Rope Tow (parent) theme folder
add_filter('acf/settings/save_json', function () {
    return get_template_directory() . '/acf-json';
});

// Load only Rope Tow (parent) theme fields
add_filter('acf/settings/load_json', function ($paths) {
    return [ get_template_directory() . '/acf-json' ];
});