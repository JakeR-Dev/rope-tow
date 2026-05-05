<?php

// Global base defaults registry
global $nylon_base_defaults;
$nylon_base_defaults = [];

/**
 * Collect all global defaults as they are registered
 */
add_action('nylon_register_customizer_default', function ($id, $default) {
  global $nylon_base_defaults;
  $nylon_base_defaults[$id] = $default;
}, 10, 2);

/**
 * Get the default value for a given customizer setting key,
 * merging in child theme-specific overrides if applicable.
 */
function nylon_get_default($setting_key) {
  global $nylon_base_defaults;

  $theme_slug = get_stylesheet();

  $theme_overrides = [
    // Nylon SAAS Theme
    'nylon-saas-theme' => [
      // typography
      'nylon_heading_font' => 'Poppins',
      'nylon_heading_font_weight' => 'bold',
      'nylon_body_font' => 'Poppins',
      'nylon_body_font_weight' => 'normal',
      'nylon_body_font_size' => 16,
      'nylon_h1_font_size' => 70,
      'nylon_h2_font_size' => 50,
      'nylon_h3_font_size' => 40,
      'nylon_h4_font_size' => 24,
      'nylon_h5_font_size' => 18,
      'nylon_h6_font_size' => 16,

      // colors
      'nylon_dark_mode' => 'light',
      'nylon_primary_color' => '#00FFA3',
      'nylon_secondary_color' => '#3F6DEE',
      'nylon_tertiary_color' => '#9F00EB',
      'nylon_tertiary_alt_color' => '#EBDE00',
      'nylon_brand_black' => '#1B1C1C',
      'nylon_brand_gray' => '#C9DBDB',
      'nylon_brand_light_gray' => '#F2F9F9',
      'nylon_brand_white' => '#FFFFFF',
      'nylon_brand_error' => '#E7391E',
      'nylon_nav_color' => '#FFFFFF',
      'nylon_nav_font_color' => '#1B1C1C',
      'nylon_body_color' => '#1B1C1C',
      'nylon_heading_color' => '#1B1C1C',
      'nylon_primary_button_color' => '#00FFA3',
      'nylon_secondary_button_color' => '#3F6DEE',
      'nylon_primary_button_font_color' => '#1B1C1C',
      'nylon_secondary_button_font_color' => '#ffffff',

      // navigation
      'nylon_nav_hide' => false,
      'nylon_navigation_style' => 'solid-contained',
      'nylon_navigation_layout' => 'spaced-out',
      'nylon_hamburger_animation' => 'collapse',
      'nylon_nav_cta_enabled' => true,
      'nylon_nav_cta_button_title' => 'Get A Demo',
      'nylon_nav_cta_button_url' => '#',
      'nylon_nav_cta_button_style' => 'btn-primary',
      'nylon_nav_cta_button_size' => 'btn',

      // buttons
      'nylon_button_radius' => 10,
      'nylon_button_padding_x' => 30,
      'nylon_button_padding_y' => 10,
      'nylon_button_font_size' => 14,
      'nylon_button_font_weight' => '--weight-semibold',
      'nylon_button_text_transform' => 'uppercase',

      // footer
      'nylon_footer_logo' => '',
      'nylon_footer_copyright_text' => 'Nylon © 2025',
      'nylon_footer_layout' => 'space-between',
      'nylon_footer_color' => '#5000EA',
      'nylon_footer_background_image' => '',
      'nylon_footer_social_color' => '#ffffff',
      'nylon_footer_cta_enabled' => false,
      'nylon_footer_cta_layout' => 'layout-stacked',
      'nylon_footer_cta_title' => 'Ready to get started?',
      'nylon_footer_cta_subtitle' => 'Contact our team or schedule a demo today.',
      'nylon_footer_cta_background_color' => '',
      'nylon_footer_cta_background_image' => '',
      'nylon_footer_cta_button_title' => 'Schedule a Demo',
      'nylon_footer_cta_button_url' => home_url('/contact'),
      'nylon_footer_cta_button_style' => 'btn-primary',
      'nylon_footer_cta_button_size' => 'btn',

      // 404 page
      'nylon_404_text_style' => 'dark',
      'nylon_404_background_image' => '',
      'nylon_404_top_image' => '',
      'nylon_404_heading_text' => 'Oops! Nothing here.',
      'nylon_404_subtitle_text' => '',
      'nylon_404_button_label' => 'Go Back',
      'nylon_404_button_url' => home_url('/'),
      'nylon_404_button_style' => 'btn-primary',
      'nylon_404_button2_label' => '',
      'nylon_404_button2_url' => '',
      'nylon_404_button2_style' => 'btn-primary-outline',

      // blog
      'nylon_post_post_image' => '',

      // resources
      'nylon_resource_post_image' => '',
      'nylon_resource_sidebar_content' => 'lorem ipsum here sidebar content',
      'nylon_resource_sidebar_cta_text' => 'Get a Demo',
      'nylon_resource_sidebar_cta_url' => home_url('/')
    ],

    // fallback for all other themes
    'default' => [],
  ];

  $defaults = $nylon_base_defaults ?? [];

  if (isset($theme_overrides[$theme_slug])) {
    $defaults = array_merge($defaults, $theme_overrides[$theme_slug]);
  }

  return $defaults[$setting_key] ?? '';
}