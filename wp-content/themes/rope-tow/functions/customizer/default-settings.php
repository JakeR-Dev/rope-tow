<?php

// Global base defaults registry
global $rope_tow_base_defaults;
$rope_tow_base_defaults = [];

/**
 * Collect all global defaults as they are registered
 */
add_action('rope_tow_register_customizer_default', function ($id, $default) {
  global $rope_tow_base_defaults;
  $rope_tow_base_defaults[$id] = $default;
}, 10, 2);

/**
 * Get the default value for a given customizer setting key,
 * merging in child theme-specific overrides if applicable.
 */
function rope_tow_get_default($setting_key) {
  global $rope_tow_base_defaults;

  $theme_slug = get_stylesheet();

  $theme_overrides = [
    // Rope Tow SAAS Theme
    'rope-tow-saas-theme' => [
      // typography
      'rope_tow_heading_font' => 'Poppins',
      'rope_tow_heading_font_weight' => 'bold',
      'rope_tow_body_font' => 'Poppins',
      'rope_tow_body_font_weight' => 'normal',
      'rope_tow_body_font_size' => 16,
      'rope_tow_h1_font_size' => 70,
      'rope_tow_h2_font_size' => 50,
      'rope_tow_h3_font_size' => 40,
      'rope_tow_h4_font_size' => 24,
      'rope_tow_h5_font_size' => 18,
      'rope_tow_h6_font_size' => 16,

      // colors
      'rope_tow_dark_mode' => 'light',
      'rope_tow_primary_color' => '#00FFA3',
      'rope_tow_secondary_color' => '#3F6DEE',
      'rope_tow_tertiary_color' => '#9F00EB',
      'rope_tow_tertiary_alt_color' => '#EBDE00',
      'rope_tow_brand_black' => '#1B1C1C',
      'rope_tow_brand_gray' => '#C9DBDB',
      'rope_tow_brand_light_gray' => '#F2F9F9',
      'rope_tow_brand_white' => '#FFFFFF',
      'rope_tow_brand_error' => '#E7391E',
      'rope_tow_nav_color' => '#FFFFFF',
      'rope_tow_nav_font_color' => '#1B1C1C',
      'rope_tow_body_color' => '#1B1C1C',
      'rope_tow_heading_color' => '#1B1C1C',
      'rope_tow_primary_button_color' => '#00FFA3',
      'rope_tow_secondary_button_color' => '#3F6DEE',
      'rope_tow_primary_button_font_color' => '#1B1C1C',
      'rope_tow_secondary_button_font_color' => '#ffffff',

      // navigation
      'rope_tow_nav_hide' => false,
      'rope_tow_navigation_style' => 'solid-contained',
      'rope_tow_navigation_layout' => 'spaced-out',
      'rope_tow_hamburger_animation' => 'collapse',
      'rope_tow_nav_cta_enabled' => true,
      'rope_tow_nav_cta_button_title' => 'Get A Demo',
      'rope_tow_nav_cta_button_url' => '#',
      'rope_tow_nav_cta_button_style' => 'btn-primary',
      'rope_tow_nav_cta_button_size' => 'btn',

      // buttons
      'rope_tow_button_radius' => 10,
      'rope_tow_button_padding_x' => 30,
      'rope_tow_button_padding_y' => 10,
      'rope_tow_button_font_size' => 14,
      'rope_tow_button_font_weight' => '--weight-semibold',
      'rope_tow_button_text_transform' => 'uppercase',

      // footer
      'rope_tow_footer_logo' => '',
      'rope_tow_footer_copyright_text' => 'Rope Tow © 2025',
      'rope_tow_footer_layout' => 'space-between',
      'rope_tow_footer_color' => '#5000EA',
      'rope_tow_footer_background_image' => '',
      'rope_tow_footer_social_color' => '#ffffff',
      'rope_tow_footer_cta_enabled' => false,
      'rope_tow_footer_cta_layout' => 'layout-stacked',
      'rope_tow_footer_cta_title' => 'Ready to get started?',
      'rope_tow_footer_cta_subtitle' => 'Contact our team or schedule a demo today.',
      'rope_tow_footer_cta_background_color' => '',
      'rope_tow_footer_cta_background_image' => '',
      'rope_tow_footer_cta_button_title' => 'Schedule a Demo',
      'rope_tow_footer_cta_button_url' => home_url('/contact'),
      'rope_tow_footer_cta_button_style' => 'btn-primary',
      'rope_tow_footer_cta_button_size' => 'btn',

      // 404 page
      'rope_tow_404_text_style' => 'dark',
      'rope_tow_404_background_image' => '',
      'rope_tow_404_top_image' => '',
      'rope_tow_404_heading_text' => 'Oops! Nothing here.',
      'rope_tow_404_subtitle_text' => '',
      'rope_tow_404_button_label' => 'Go Back',
      'rope_tow_404_button_url' => home_url('/'),
      'rope_tow_404_button_style' => 'btn-primary',
      'rope_tow_404_button2_label' => '',
      'rope_tow_404_button2_url' => '',
      'rope_tow_404_button2_style' => 'btn-primary-outline',

      // blog
      'rope_tow_post_post_image' => '',

      // resources
      'rope_tow_resource_post_image' => '',
      'rope_tow_resource_sidebar_content' => 'lorem ipsum here sidebar content',
      'rope_tow_resource_sidebar_cta_text' => 'Get a Demo',
      'rope_tow_resource_sidebar_cta_url' => home_url('/')
    ],

    // fallback for all other themes
    'default' => [],
  ];

  $defaults = $rope_tow_base_defaults ?? [];

  if (isset($theme_overrides[$theme_slug])) {
    $defaults = array_merge($defaults, $theme_overrides[$theme_slug]);
  }

  return $defaults[$setting_key] ?? '';
}