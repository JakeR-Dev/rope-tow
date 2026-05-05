<?php
function nylon_customize_register($wp_customize) {
  // *******
  // Add "Theme Options" customizer section
  // *******

  require_once 'sections.php';

  // ******
  // Add collapsbile panels for specific setting groups
  // ******

  require_once 'panels.php';

  // *******
  // Add settings
  // *******

  require_once 'settings.php';

  // *******
  // Add controls
  // *******

  require_once 'controls.php';

}
add_action('customize_register', 'nylon_customize_register');

// *******
// Preload and load fonts
// *******

require_once 'font-loaders.php';

// *******
// Load helper for theme-specific defaults
// *******
require_once 'default-settings.php';

// *******
// Wrapper to register a setting and
// track its default value for default-settings.php
// *******

function nylon_add_setting($wp_customize, $id, $args) {
  // Use dynamic fallback from defaults.php
  $args['default'] = nylon_get_default($id);
  // Register default value
  do_action('nylon_register_customizer_default', $id, $args['default']);
  // Register setting
  $wp_customize->add_setting($id, $args);
}

// *******
// Set new values in css vars
// *******

function nylon_customize_css() {
  // typography
  $body_font = get_theme_mod('nylon_body_font', nylon_get_default('nylon_body_font'));
  $heading_font = get_theme_mod('nylon_heading_font', nylon_get_default('nylon_heading_font'));
  $body_weight = get_theme_mod('nylon_body_font_weight', nylon_get_default('nylon_body_font_weight'));
  $heading_weight = get_theme_mod('nylon_heading_font_weight', nylon_get_default('nylon_heading_font_weight'));
  $body_font_size = get_theme_mod('nylon_body_font_size', nylon_get_default('nylon_body_font_size'));
  $h1_font_size = get_theme_mod('nylon_h1_font_size', nylon_get_default('nylon_h1_font_size'));
  $h2_font_size = get_theme_mod('nylon_h2_font_size', nylon_get_default('nylon_h2_font_size'));
  $h3_font_size = get_theme_mod('nylon_h3_font_size', nylon_get_default('nylon_h3_font_size'));
  $h4_font_size = get_theme_mod('nylon_h4_font_size', nylon_get_default('nylon_h4_font_size'));
  $h5_font_size = get_theme_mod('nylon_h5_font_size', nylon_get_default('nylon_h5_font_size'));
  $h6_font_size = get_theme_mod('nylon_h6_font_size', nylon_get_default('nylon_h6_font_size'));
  // colors
  $primary_color = get_theme_mod('nylon_primary_color', nylon_get_default('nylon_primary_color'));
  $primary_color_darkened = nylon_mix_color($primary_color, '#000000', 30);
  $primary_color_lightened = nylon_mix_color($primary_color, '#ffffff', 30, .2);
  $secondary_color = get_theme_mod('nylon_secondary_color', nylon_get_default('nylon_secondary_color'));
  $secondary_color_darkened = nylon_mix_color($secondary_color, '#000000', 30);
  $secondary_color_lightened = nylon_mix_color($secondary_color, '#ffffff', 30, .2);
  $tertiary_color = get_theme_mod('nylon_tertiary_color', nylon_get_default('nylon_tertiary_color'));
  $tertiary_color_darkened = nylon_mix_color($tertiary_color, '#000000', 30);
  $tertiary_color_lightened = nylon_mix_color($tertiary_color, '#ffffff', 30, .2);
  $tertiary_alt_color = get_theme_mod('nylon_tertiary_alt_color', nylon_get_default('nylon_tertiary_alt_color'));
  $tertiary_alt_color_darkened = nylon_mix_color($tertiary_alt_color, '#000000', 30);
  $tertiary_alt_color_lightened = nylon_mix_color($tertiary_alt_color, '#ffffff', 30, .2);
  $brand_black = get_theme_mod('nylon_brand_black', nylon_get_default('nylon_brand_black'));
  $brand_gray = get_theme_mod('nylon_brand_gray', nylon_get_default('nylon_brand_gray'));
  $brand_light_gray = get_theme_mod('nylon_brand_light_gray', nylon_get_default('nylon_brand_light_gray'));
  $brand_white = get_theme_mod('nylon_brand_white', nylon_get_default('nylon_brand_white'));
  $brand_error = get_theme_mod('nylon_brand_error', nylon_get_default('nylon_brand_error'));
  $brand_error_lightened = nylon_mix_color($brand_error, '#ffffff', 30, .1);
  $nav_bg_color = get_theme_mod('nylon_nav_color', nylon_get_default('nylon_nav_color'));
  $nav_font_color = get_theme_mod('nylon_nav_font_color', nylon_get_default('nylon_nav_font_color'));
  $body_color = get_theme_mod('nylon_body_color', nylon_get_default('nylon_body_color'));
  $heading_color = get_theme_mod('nylon_heading_color', nylon_get_default('nylon_heading_color'));
  $primary_button_color = get_theme_mod('nylon_primary_button_color', nylon_get_default('nylon_primary_button_color'));
  $primary_button_color_darkened = nylon_mix_color($primary_button_color, '#000000', 15);
  $primary_button_font_color = get_theme_mod('nylon_primary_button_font_color', nylon_get_default('nylon_primary_button_font_color'));
  $secondary_button_color = get_theme_mod('nylon_secondary_button_color', nylon_get_default('nylon_secondary_button_color'));
  $secondary_button_color_darkened = nylon_mix_color($secondary_button_color, '#000000', 15);
  $secondary_button_font_color = get_theme_mod('nylon_secondary_button_font_color', nylon_get_default('nylon_secondary_button_font_color'));
  // buttons
  $button_radius = get_theme_mod('nylon_button_radius', nylon_get_default('nylon_button_radius'));
  $button_padding_x = get_theme_mod('nylon_button_padding_x', nylon_get_default('nylon_button_padding_x'));
  $button_padding_y = get_theme_mod('nylon_button_padding_y', nylon_get_default('nylon_button_padding_y'));
  $button_font_size = get_theme_mod('nylon_button_font_size', nylon_get_default('nylon_button_font_size'));
  $button_font_weight = get_theme_mod('nylon_button_font_weight', nylon_get_default('nylon_button_font_weight'));
  $button_text_transform = get_theme_mod('nylon_button_text_transform', nylon_get_default('nylon_button_text_transform'));
  // footer
  $footer_bg_color = get_theme_mod('nylon_footer_color', nylon_get_default('nylon_footer_color'));
  $footer_cta_bg_color = get_theme_mod('nylon_footer_cta_background_color', nylon_get_default('nylon_footer_cta_background_color'));
  $footer_social_link_color = get_theme_mod('nylon_footer_social_color', nylon_get_default('nylon_footer_social_color'));
  ?>
  
  <style id="nylon-customizer-vars" type="text/css">
    :root {
      /* typography */
      <?php echo (!empty($body_font)) ? '--font-family-body:"'. esc_attr($body_font) .'", sans-serif;' : ''; ?>
      <?php echo (!empty($heading_font)) ? '--font-family-headline:"'. esc_attr($heading_font) .'", sans-serif;' : ''; ?>
      <?php echo (!empty($body_weight)) ? '--font-weight-body: var(--weight-'. esc_attr($body_weight) .');' : ''; ?>
      <?php echo (!empty($heading_weight)) ? '--font-weight-heading: var(--weight-'. esc_attr($heading_weight) .');' : ''; ?>
      <?php echo (!empty($body_font_size)) ? '--font-size-body:'. esc_attr($body_font_size) .'px;' : ''; ?>
      <?php echo (!empty($h1_font_size)) ? '--h1-font-size-desktop:'. esc_attr($h1_font_size) .'px;' : ''; ?>
      <?php echo (!empty($h2_font_size)) ? '--h2-font-size-desktop:'. esc_attr($h2_font_size) .'px;' : ''; ?>
      <?php echo (!empty($h3_font_size)) ? '--h3-font-size-desktop:'. esc_attr($h3_font_size) .'px;' : ''; ?>
      <?php echo (!empty($h4_font_size)) ? '--h4-font-size-desktop:'. esc_attr($h4_font_size) .'px;' : ''; ?>
      <?php echo (!empty($h5_font_size)) ? '--h5-font-size-desktop:'. esc_attr($h5_font_size) .'px;' : ''; ?>
      <?php echo (!empty($h6_font_size)) ? '--h6-font-size-desktop:'. esc_attr($h6_font_size) .'px;' : ''; ?>
      /* colors */
      <?php echo (!empty($primary_color)) ? '--brand-primary:'. esc_attr($primary_color) .';' : ''; ?>
      <?php echo (!empty($primary_color_darkened)) ? '--brand-primary-darkened:'. esc_attr($primary_color_darkened) .';' : ''; ?>
      <?php echo (!empty($primary_color_lightened)) ? '--brand-primary-lightened:'. esc_attr($primary_color_lightened) .';' : ''; ?>
      <?php echo (!empty($secondary_color)) ? '--brand-secondary:'. esc_attr($secondary_color) .';' : ''; ?>
      <?php echo (!empty($secondary_color_darkened)) ? '--brand-secondary-darkened:'. esc_attr($secondary_color_darkened) .';' : ''; ?>
      <?php echo (!empty($secondary_color_lightened)) ? '--brand-secondary-lightened:'. esc_attr($secondary_color_lightened) .';' : ''; ?>
      <?php echo (!empty($tertiary_color)) ? '--brand-tertiary:'. esc_attr($tertiary_color) .';' : ''; ?>
      <?php echo (!empty($tertiary_color_darkened)) ? '--brand-tertiary-darkened:'. esc_attr($tertiary_color_darkened) .';' : ''; ?>
      <?php echo (!empty($tertiary_color_lightened)) ? '--brand-tertiary-lightened:'. esc_attr($tertiary_color_lightened) .';' : ''; ?>
      <?php echo (!empty($tertiary_alt_color)) ? '--brand-tertiary-alt:'. esc_attr($tertiary_alt_color) .';' : ''; ?>
      <?php echo (!empty($tertiary_alt_color_darkened)) ? '--brand-tertiary-alt-darkened:'. esc_attr($tertiary_alt_color_darkened) .';' : ''; ?>
      <?php echo (!empty($tertiary_alt_color_lightened)) ? '--brand-tertiary-alt-lightened:'. esc_attr($tertiary_alt_color_lightened) .';' : ''; ?>
      <?php echo (!empty($brand_black)) ? '--color-black:'. esc_attr($brand_black) .';' : ''; ?>
      <?php echo (!empty($brand_gray)) ? '--color-gray:'. esc_attr($brand_gray) .';' : ''; ?>
      <?php echo (!empty($brand_light_gray)) ? '--color-gray-light:'. esc_attr($brand_light_gray) .';' : ''; ?>
      <?php echo (!empty($brand_white)) ? '--color-white:'. esc_attr($brand_white) .';' : ''; ?>
      <?php echo (!empty($brand_error)) ? '--color-error:'. esc_attr($brand_error) .';' : ''; ?>
      <?php echo (!empty($brand_error_lightened)) ? '--color-error-lightened:'. esc_attr($brand_error_lightened) .';' : ''; ?>
      <?php echo (!empty($nav_bg_color)) ? '--nav-bg-color:'. esc_attr($nav_bg_color) .';' : ''; ?>
      <?php echo (!empty($nav_font_color)) ? '--nav-font-color:'. esc_attr($nav_font_color) .';' : ''; ?>
      <?php echo (!empty($body_color)) ? '--body-color:'. esc_attr($body_color) .';' : ''; ?>
      <?php echo (!empty($heading_color)) ? '--heading-color:'. esc_attr($heading_color) .';' : ''; ?>
      <?php echo (!empty($primary_button_color)) ? '--primary-button-color:'. esc_attr($primary_button_color) .';' : ''; ?>
      <?php echo (!empty($primary_button_color_darkened)) ? '--primary-button-color-darkened:'. esc_attr($primary_button_color_darkened) .';' : ''; ?>
      <?php echo (!empty($primary_button_font_color)) ? '--primary-button-font-color:'. esc_attr($primary_button_font_color) .';' : ''; ?>
      <?php echo (!empty($secondary_button_color)) ? '--secondary-button-color:'. esc_attr($secondary_button_color) .';' : ''; ?>
      <?php echo (!empty($secondary_button_color_darkened)) ? '--secondary-button-color-darkened:'. esc_attr($secondary_button_color_darkened) .';' : ''; ?>
      <?php echo (!empty($secondary_button_font_color)) ? '--secondary-button-font-color:'. esc_attr($secondary_button_font_color) .';' : ''; ?>
      /* buttons */
      <?php echo (!empty($button_radius)) ? '--button-radius:'. esc_attr($button_radius) .'px;' : ''; ?>
      <?php echo (!empty($button_padding_x)) ? '--button-padding-x:'. esc_attr($button_padding_x) .'px; --button-lg-padding-x: calc(var(--button-padding-x) + 10px); --button-sm-padding-x: calc(var(--button-padding-x) - 8px);' : ''; ?>
      <?php echo (!empty($button_padding_y)) ? '--button-padding-y:'. esc_attr($button_padding_y) .'px; --button-lg-padding-y: calc(var(--button-padding-y) + 4px); --button-sm-padding-y: calc(var(--button-padding-y) - 3px);' : ''; ?>
      <?php echo (!empty($button_font_size)) ? '--button-font-size:'. esc_attr($button_font_size) .'px; --button-lg-font-size: calc(var(--button-font-size) + 2px); --button-sm-font-size: var(--button-font-size);' : ''; ?>
      <?php echo (!empty($button_font_weight)) ? '--button-font-weight:var('. esc_attr($button_font_weight) .');' : ''; ?>
      <?php echo (!empty($button_text_transform)) ? '--button-text-transform:'. esc_attr($button_text_transform) .';' : ''; ?>
      /* footer */
      <?php echo (!empty($footer_bg_color)) ? '--footer-bg-color:'. esc_attr($footer_bg_color) .';' : ''; ?>
      <?php echo (!empty($footer_cta_bg_color)) ? '--footer-cta-bg-color:'. esc_attr($footer_cta_bg_color) .';' : ''; ?>
      <?php echo (!empty($footer_social_link_color)) ? '--footer-social-link-color:'. esc_attr($footer_social_link_color) .';' : ''; ?>
    }
  </style>
  <?php
}
// add later in page for precedent over other base stylesheet-defined vars
add_action('wp_footer', 'nylon_customize_css');

// *******
// Enable Select2 for customizer controls
// *******

function nylon_enqueue_customizer_select2() {
  wp_enqueue_script('select2', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js', ['jquery'], null, true);
  wp_enqueue_style('select2', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css');

  wp_add_inline_script('select2', "
    jQuery(document).ready(function($) {
      $('#customize-control-nylon_heading_font select').select2({ width: '100%' });
      $('#customize-control-nylon_body_font select').select2({ width: '100%' });
    });
  ");
}
add_action('customize_controls_enqueue_scripts', 'nylon_enqueue_customizer_select2');

// *******
// Live update customize preview JS
// *******

function nylon_customize_preview_js() {
  if (function_exists('nylon_vite') && nylon_vite()) {
    nylon_vite()->enqueue_entry('assets/js/utils/customizerPreview.js', array('customize-preview', 'jquery'));
  }
}
add_action('customize_preview_init', 'nylon_customize_preview_js');

// ******
// Modify the customizer when options change
// ******

function nylon_customize_controls_js() {
  wp_enqueue_media();
  wp_enqueue_script('nylon-customizer-controls', get_template_directory_uri() . '/assets/js/utils/customizerControls.js', array('customize-controls', 'jquery'), rand(), true);
}
add_action('customize_controls_enqueue_scripts', 'nylon_customize_controls_js');

// *******
// Customizer css
// *******

function nylon_customizer_styles() {
  if (function_exists('nylon_vite') && nylon_vite()) {
    nylon_vite()->enqueue_entry('assets/scss/admin.scss');
  }
}
add_action('customize_controls_print_styles', 'nylon_customizer_styles');
