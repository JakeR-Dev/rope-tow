<?php

/**
 * Parse color variables from _colors.scss.
 *
 * @return array<string, string>
 */
function rope_tow_get_scss_color_vars() {
  static $vars = null;

  if (null !== $vars) {
    return $vars;
  }

  $vars = [];
  $file = get_template_directory() . '/assets/scss/variables/_colors.scss';

  if (!file_exists($file)) {
    return $vars;
  }

  $contents = file_get_contents($file);
  if (false === $contents) {
    return $vars;
  }

  if (preg_match_all('/--([a-z0-9-]+)\s*:\s*([^;]+);/i', $contents, $matches, PREG_SET_ORDER)) {
    foreach ($matches as $match) {
      $vars['--' . $match[1]] = trim($match[2]);
    }
  }

  return $vars;
}

/**
 * Resolve a CSS variable (including chained var() references) to a concrete value.
 */
function rope_tow_resolve_css_var($value, $vars, $depth = 0) {
  if ($depth > 10) {
    return '';
  }

  $value = trim($value);

  if (preg_match('/^var\((--[a-z0-9-]+)\)$/i', $value, $match)) {
    $ref = $match[1];
    if (!isset($vars[$ref])) {
      return '';
    }

    return rope_tow_resolve_css_var($vars[$ref], $vars, $depth + 1);
  }

  return $value;
}

/**
 * Get a resolved CSS variable value from _colors.scss.
 */
function rope_tow_get_css_var_value($var_name, $fallback = '') {
  $vars = rope_tow_get_scss_color_vars();

  if (!isset($vars[$var_name])) {
    return $fallback;
  }

  $resolved = rope_tow_resolve_css_var($vars[$var_name], $vars);
  return '' !== $resolved ? $resolved : $fallback;
}

/**
 * Get the default value for a given customizer setting key.
 */
function rope_tow_get_default($setting_key) {
  $defaults = [
    // typography
    'rope_tow_heading_font'                      => 'Inter',
    'rope_tow_heading_font_weight'               => 'bold',
    'rope_tow_body_font'                         => 'Inter',
    'rope_tow_body_font_weight'                  => 'normal',
    'rope_tow_body_font_size'                    => 16,
    'rope_tow_h1_font_size'                      => 70,
    'rope_tow_h2_font_size'                      => 50,
    'rope_tow_h3_font_size'                      => 40,
    'rope_tow_h4_font_size'                      => 24,
    'rope_tow_h5_font_size'                      => 18,
    'rope_tow_h6_font_size'                      => 16,

    // colors
    'rope_tow_dark_mode'                         => 'light',
    'rope_tow_primary_color'                     => '--brand-primary',
    'rope_tow_secondary_color'                   => '--brand-secondary',
    'rope_tow_tertiary_color'                    => '--brand-tertiary',
    'rope_tow_tertiary_alt_color'                => '--brand-tertiary-alt',
    'rope_tow_brand_black'                       => '--color-black',
    'rope_tow_brand_gray'                        => '--color-gray',
    'rope_tow_brand_light_gray'                  => '--color-gray-light',
    'rope_tow_brand_white'                       => '--color-white',
    'rope_tow_brand_error'                       => '--color-error',
    'rope_tow_nav_color'                         => '--nav-bg-color',
    'rope_tow_nav_font_color'                    => '--nav-font-color',
    'rope_tow_body_color'                        => '--body-color',
    'rope_tow_heading_color'                     => '--heading-color',
    'rope_tow_primary_button_color'              => '--primary-button-color',
    'rope_tow_secondary_button_color'            => '--secondary-button-color',
    'rope_tow_primary_button_font_color'         => '--primary-button-font-color',
    'rope_tow_secondary_button_font_color'       => '--secondary-button-font-color',

    // navigation
    'rope_tow_nav_hide'                          => false,
    'rope_tow_navigation_style'                  => 'solid-rounded',
    'rope_tow_navigation_layout'                 => 'centered',
    'rope_tow_hamburger_animation'               => 'collapse',
    'rope_tow_nav_cta_enabled'                   => true,
    'rope_tow_nav_cta_button_title'              => 'Get A Demo',
    'rope_tow_nav_cta_button_url'                => '#',
    'rope_tow_nav_cta_button_style'              => 'btn-primary',
    'rope_tow_nav_cta_button_size'               => 'btn',

    // buttons
    'rope_tow_button_radius'                     => 10,
    'rope_tow_button_padding_x'                  => 30,
    'rope_tow_button_padding_y'                  => 10,
    'rope_tow_button_font_size'                  => 14,
    'rope_tow_button_font_weight'                => '--weight-semibold',
    'rope_tow_button_text_transform'             => 'uppercase',

    // footer
    'rope_tow_footer_logo'                       => '',
    'rope_tow_footer_copyright_text'             => 'Rope Tow © 2025',
    'rope_tow_footer_layout'                     => 'space-between',
    'rope_tow_footer_color'                      => '--footer-bg-color',
    'rope_tow_footer_background_image'           => '',
    'rope_tow_footer_social_color'               => '--footer-social-link-color',
    'rope_tow_footer_cta_enabled'                => false,
    'rope_tow_footer_cta_layout'                 => 'layout-stacked',
    'rope_tow_footer_cta_title'                  => 'Ready to get started?',
    'rope_tow_footer_cta_subtitle'               => 'Contact our team or schedule a demo today.',
    'rope_tow_footer_cta_background_color'       => '--color-brand-tertiary',
    'rope_tow_footer_cta_background_image'       => '',
    'rope_tow_footer_cta_button_title'           => 'Schedule a Demo',
    'rope_tow_footer_cta_button_url'             => home_url('/contact'),
    'rope_tow_footer_cta_button_style'           => 'btn-primary',
    'rope_tow_footer_cta_button_size'            => 'btn',
    'rope_tow_footer_cta_secondary_button_title' => '',
    'rope_tow_footer_cta_secondary_button_url'   => '',
    'rope_tow_footer_cta_secondary_button_style' => 'btn-primary',
    'rope_tow_footer_cta_secondary_button_size'  => 'btn',

    // 404 page
    'rope_tow_404_text_style'                    => 'dark',
    'rope_tow_404_background_image'              => '',
    'rope_tow_404_top_image'                     => '',
    'rope_tow_404_heading_text'                  => 'Oops! Nothing here.',
    'rope_tow_404_subtitle_text'                 => '',
    'rope_tow_404_button_label'                  => 'Go Back',
    'rope_tow_404_button_url'                    => home_url('/'),
    'rope_tow_404_button_style'                  => 'btn-primary',
    'rope_tow_404_button2_label'                 => '',
    'rope_tow_404_button2_url'                   => '',
    'rope_tow_404_button2_style'                 => 'btn-primary-outline',

    // blog
    'rope_tow_post_post_image'                   => '',

    // resources
    'rope_tow_resource_post_image'               => '',
    'rope_tow_resource_sidebar_content'          => 'lorem ipsum here sidebar content',
    'rope_tow_resource_sidebar_cta_text'         => 'Get a Demo',
    'rope_tow_resource_sidebar_cta_url'          => home_url('/'),
  ];

  $value = $defaults[$setting_key] ?? '';

  if (is_string($value) && 0 === strpos($value, '--')) {
    return rope_tow_get_css_var_value($value, '');
  }

  return $value;
}