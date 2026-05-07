<?php
function rope_tow_customize_register($wp_customize) {
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
add_action('customize_register', 'rope_tow_customize_register');

// *******
// Preload and load fonts
// *******

require_once 'font-loaders.php';

// *******
// Default values for all customizer settings
// *******
require_once 'default-settings.php';

// *******
// Wrapper to register a customizer setting
// *******

function rope_tow_add_setting($wp_customize, $id, $args) {
  $wp_customize->add_setting($id, $args);
}

// *******
// Set new values in css vars
// *******

function rope_tow_customize_css() {
  // *****
  // typography
  // *****

  // body
  $body_font = get_theme_mod('rope_tow_body_font', rope_tow_get_default('rope_tow_body_font'));
  $body_weight = get_theme_mod('rope_tow_body_font_weight', rope_tow_get_default('rope_tow_body_font_weight'));
  $body_font_size = get_theme_mod('rope_tow_body_font_size', rope_tow_get_default('rope_tow_body_font_size'));
  // headings
  $heading_font = get_theme_mod('rope_tow_heading_font', rope_tow_get_default('rope_tow_heading_font'));
  $heading_weight = get_theme_mod('rope_tow_heading_font_weight', rope_tow_get_default('rope_tow_heading_font_weight'));
  $h1_font_size = get_theme_mod('rope_tow_h1_font_size', rope_tow_get_default('rope_tow_h1_font_size'));
  $h2_font_size = get_theme_mod('rope_tow_h2_font_size', rope_tow_get_default('rope_tow_h2_font_size'));
  $h3_font_size = get_theme_mod('rope_tow_h3_font_size', rope_tow_get_default('rope_tow_h3_font_size'));
  $h4_font_size = get_theme_mod('rope_tow_h4_font_size', rope_tow_get_default('rope_tow_h4_font_size'));
  $h5_font_size = get_theme_mod('rope_tow_h5_font_size', rope_tow_get_default('rope_tow_h5_font_size'));
  $h6_font_size = get_theme_mod('rope_tow_h6_font_size', rope_tow_get_default('rope_tow_h6_font_size'));
  
  // *****
  // colors
  // *****
  
  // primary
  $primary_color = get_theme_mod('rope_tow_primary_color', rope_tow_get_default('rope_tow_primary_color'));
  $primary_color_darkened = rope_tow_mix_color($primary_color, '#000000', 30);
  $primary_color_lightened = rope_tow_mix_color($primary_color, '#ffffff', 30, .2);
  // secondary
  $secondary_color = get_theme_mod('rope_tow_secondary_color', rope_tow_get_default('rope_tow_secondary_color'));
  $secondary_color_darkened = rope_tow_mix_color($secondary_color, '#000000', 30);
  $secondary_color_lightened = rope_tow_mix_color($secondary_color, '#ffffff', 30, .2);
  // tertiary
  $tertiary_color = get_theme_mod('rope_tow_tertiary_color', rope_tow_get_default('rope_tow_tertiary_color'));
  $tertiary_color_darkened = rope_tow_mix_color($tertiary_color, '#000000', 30);
  $tertiary_color_lightened = rope_tow_mix_color($tertiary_color, '#ffffff', 30, .2);
  // tertiary alt
  $tertiary_alt_color = get_theme_mod('rope_tow_tertiary_alt_color', rope_tow_get_default('rope_tow_tertiary_alt_color'));
  $tertiary_alt_color_darkened = rope_tow_mix_color($tertiary_alt_color, '#000000', 30);
  $tertiary_alt_color_lightened = rope_tow_mix_color($tertiary_alt_color, '#ffffff', 30, .2);
  // neutrals
  $brand_black = get_theme_mod('rope_tow_brand_black', rope_tow_get_default('rope_tow_brand_black'));
  $brand_gray = get_theme_mod('rope_tow_brand_gray', rope_tow_get_default('rope_tow_brand_gray'));
  $brand_light_gray = get_theme_mod('rope_tow_brand_light_gray', rope_tow_get_default('rope_tow_brand_light_gray'));
  $brand_white = get_theme_mod('rope_tow_brand_white', rope_tow_get_default('rope_tow_brand_white'));
  // elements
  $brand_error = get_theme_mod('rope_tow_brand_error', rope_tow_get_default('rope_tow_brand_error'));
  $brand_error_lightened = rope_tow_mix_color($brand_error, '#ffffff', 30, .1);
  $nav_bg_color = get_theme_mod('rope_tow_nav_color', rope_tow_get_default('rope_tow_nav_color'));
  $nav_font_color = get_theme_mod('rope_tow_nav_font_color', rope_tow_get_default('rope_tow_nav_font_color'));
  $body_color = get_theme_mod('rope_tow_body_color', rope_tow_get_default('rope_tow_body_color'));
  $heading_color = get_theme_mod('rope_tow_heading_color', rope_tow_get_default('rope_tow_heading_color'));
  $primary_button_color = get_theme_mod('rope_tow_primary_button_color', rope_tow_get_default('rope_tow_primary_button_color'));
  $primary_button_color_darkened = rope_tow_mix_color($primary_button_color, '#000000', 15);
  $primary_button_font_color = get_theme_mod('rope_tow_primary_button_font_color', rope_tow_get_default('rope_tow_primary_button_font_color'));
  $secondary_button_color = get_theme_mod('rope_tow_secondary_button_color', rope_tow_get_default('rope_tow_secondary_button_color'));
  $secondary_button_color_darkened = rope_tow_mix_color($secondary_button_color, '#000000', 15);
  $secondary_button_font_color = get_theme_mod('rope_tow_secondary_button_font_color', rope_tow_get_default('rope_tow_secondary_button_font_color'));
  
  // *****
  // buttons
  // *****

  $button_radius = get_theme_mod('rope_tow_button_radius', rope_tow_get_default('rope_tow_button_radius'));
  $button_padding_x = get_theme_mod('rope_tow_button_padding_x', rope_tow_get_default('rope_tow_button_padding_x'));
  $button_padding_y = get_theme_mod('rope_tow_button_padding_y', rope_tow_get_default('rope_tow_button_padding_y'));
  $button_font_size = get_theme_mod('rope_tow_button_font_size', rope_tow_get_default('rope_tow_button_font_size'));
  $button_font_weight = get_theme_mod('rope_tow_button_font_weight', rope_tow_get_default('rope_tow_button_font_weight'));
  $button_text_transform = get_theme_mod('rope_tow_button_text_transform', rope_tow_get_default('rope_tow_button_text_transform'));
  
  // *****
  // footer
  // *****

  $footer_bg_color = get_theme_mod('rope_tow_footer_color', rope_tow_get_default('rope_tow_footer_color'));
  $footer_cta_bg_color = get_theme_mod('rope_tow_footer_cta_background_color', rope_tow_get_default('rope_tow_footer_cta_background_color'));
  $footer_social_link_color = get_theme_mod('rope_tow_footer_social_color', rope_tow_get_default('rope_tow_footer_social_color'));
  ?>
  
  <style id="rope-tow-customizer-vars" type="text/css">
    :root {
      /**************/
      /* typography */
      /**************/

      /* body */
      <?php echo (!empty($body_font)) ? '--font-family-body:"'. esc_attr($body_font) .'", sans-serif;' : ''; ?>
      <?php echo (!empty($body_weight)) ? '--font-weight-body: var(--weight-'. esc_attr($body_weight) .');' : ''; ?>
      <?php echo (!empty($body_font_size)) ? '--font-size-body:'. esc_attr($body_font_size) .'px;' : ''; ?>
      /* headings */
      <?php echo (!empty($heading_font)) ? '--font-family-headline:"'. esc_attr($heading_font) .'", sans-serif;' : ''; ?>
      <?php echo (!empty($heading_weight)) ? '--font-weight-heading: var(--weight-'. esc_attr($heading_weight) .');' : ''; ?>
      <?php echo (!empty($h1_font_size)) ? '--h1-font-size-desktop:'. esc_attr($h1_font_size) .'px;' : ''; ?>
      <?php echo (!empty($h2_font_size)) ? '--h2-font-size-desktop:'. esc_attr($h2_font_size) .'px;' : ''; ?>
      <?php echo (!empty($h3_font_size)) ? '--h3-font-size-desktop:'. esc_attr($h3_font_size) .'px;' : ''; ?>
      <?php echo (!empty($h4_font_size)) ? '--h4-font-size-desktop:'. esc_attr($h4_font_size) .'px;' : ''; ?>
      <?php echo (!empty($h5_font_size)) ? '--h5-font-size-desktop:'. esc_attr($h5_font_size) .'px;' : ''; ?>
      <?php echo (!empty($h6_font_size)) ? '--h6-font-size-desktop:'. esc_attr($h6_font_size) .'px;' : ''; ?>
      
      /**********/
      /* colors */
      /**********/

      /* primary */
      <?php echo (!empty($primary_color)) ? '--brand-primary:'. esc_attr($primary_color) .';' : ''; ?>
      <?php echo (!empty($primary_color_darkened)) ? '--brand-primary-darkened:'. esc_attr($primary_color_darkened) .';' : ''; ?>
      <?php echo (!empty($primary_color_lightened)) ? '--brand-primary-lightened:'. esc_attr($primary_color_lightened) .';' : ''; ?>
      /* secondary */
      <?php echo (!empty($secondary_color)) ? '--brand-secondary:'. esc_attr($secondary_color) .';' : ''; ?>
      <?php echo (!empty($secondary_color_darkened)) ? '--brand-secondary-darkened:'. esc_attr($secondary_color_darkened) .';' : ''; ?>
      <?php echo (!empty($secondary_color_lightened)) ? '--brand-secondary-lightened:'. esc_attr($secondary_color_lightened) .';' : ''; ?>
      /* tertiary */
      <?php echo (!empty($tertiary_color)) ? '--brand-tertiary:'. esc_attr($tertiary_color) .';' : ''; ?>
      <?php echo (!empty($tertiary_color_darkened)) ? '--brand-tertiary-darkened:'. esc_attr($tertiary_color_darkened) .';' : ''; ?>
      <?php echo (!empty($tertiary_color_lightened)) ? '--brand-tertiary-lightened:'. esc_attr($tertiary_color_lightened) .';' : ''; ?>
      /* tertiary alt */
      <?php echo (!empty($tertiary_alt_color)) ? '--brand-tertiary-alt:'. esc_attr($tertiary_alt_color) .';' : ''; ?>
      <?php echo (!empty($tertiary_alt_color_darkened)) ? '--brand-tertiary-alt-darkened:'. esc_attr($tertiary_alt_color_darkened) .';' : ''; ?>
      <?php echo (!empty($tertiary_alt_color_lightened)) ? '--brand-tertiary-alt-lightened:'. esc_attr($tertiary_alt_color_lightened) .';' : ''; ?>
      /* neutrals */
      <?php echo (!empty($brand_black)) ? '--color-black:'. esc_attr($brand_black) .';' : ''; ?>
      <?php echo (!empty($brand_gray)) ? '--color-gray:'. esc_attr($brand_gray) .';' : ''; ?>
      <?php echo (!empty($brand_light_gray)) ? '--color-gray-light:'. esc_attr($brand_light_gray) .';' : ''; ?>
      <?php echo (!empty($brand_white)) ? '--color-white:'. esc_attr($brand_white) .';' : ''; ?>
      /* elements */
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
      
      /***********/
      /* buttons */
      /***********/
      
      <?php echo (!empty($button_radius)) ? '--button-radius:'. esc_attr($button_radius) .'px;' : ''; ?>
      <?php echo (!empty($button_padding_x)) ? '--button-padding-x:'. esc_attr($button_padding_x) .'px; --button-lg-padding-x: calc(var(--button-padding-x) + 10px); --button-sm-padding-x: calc(var(--button-padding-x) - 8px);' : ''; ?>
      <?php echo (!empty($button_padding_y)) ? '--button-padding-y:'. esc_attr($button_padding_y) .'px; --button-lg-padding-y: calc(var(--button-padding-y) + 4px); --button-sm-padding-y: calc(var(--button-padding-y) - 3px);' : ''; ?>
      <?php echo (!empty($button_font_size)) ? '--button-font-size:'. esc_attr($button_font_size) .'px; --button-lg-font-size: calc(var(--button-font-size) + 2px); --button-sm-font-size: var(--button-font-size);' : ''; ?>
      <?php echo (!empty($button_font_weight)) ? '--button-font-weight:var('. esc_attr($button_font_weight) .');' : ''; ?>
      <?php echo (!empty($button_text_transform)) ? '--button-text-transform:'. esc_attr($button_text_transform) .';' : ''; ?>
      
      /**********/
      /* footer */
      /***********/

      <?php echo (!empty($footer_bg_color)) ? '--footer-bg-color:'. esc_attr($footer_bg_color) .';' : ''; ?>
      <?php echo (!empty($footer_cta_bg_color)) ? '--footer-cta-bg-color:'. esc_attr($footer_cta_bg_color) .';' : ''; ?>
      <?php echo (!empty($footer_social_link_color)) ? '--footer-social-link-color:'. esc_attr($footer_social_link_color) .';' : ''; ?>
    }
  </style>
  <?php
}
// add later in page for precedent over other base stylesheet-defined vars
add_action('wp_footer', 'rope_tow_customize_css');

// *******
// Enable tom select for customizer controls
// *******

function rope_tow_enqueue_customizer_tom_select() {
  wp_enqueue_script('tom-select', 'https://cdn.jsdelivr.net/npm/tom-select@2/dist/js/tom-select.complete.min.js', [], '2', true);
  wp_enqueue_style('tom-select', 'https://cdn.jsdelivr.net/npm/tom-select@2/dist/css/tom-select.default.min.css');

  wp_add_inline_script('tom-select', "
    document.addEventListener('DOMContentLoaded', function() {
      var headingSelect = document.querySelector('#customize-control-rope_tow_heading_font select');
      var bodySelect = document.querySelector('#customize-control-rope_tow_body_font select');
      if (headingSelect) new TomSelect(headingSelect, { width: '100%' });
      if (bodySelect) new TomSelect(bodySelect, { width: '100%' });
    });
  ");
}
add_action('customize_controls_enqueue_scripts', 'rope_tow_enqueue_customizer_tom_select');

// *******
// Live update customize preview JS
// Enqueue all customizer preview scripts
// *******

function rope_tow_customize_preview_js() {
  wp_enqueue_script('rope-tow-customizer-preview-colors', get_template_directory_uri() . '/assets/admin/js/customizerPreview/colors.js', array('customize-preview'), ROPE_TOW_VERSION, true);
  wp_enqueue_script('rope-tow-customizer-preview-typography', get_template_directory_uri() . '/assets/admin/js/customizerPreview/typography.js', array('customize-preview'), ROPE_TOW_VERSION, true);
  wp_enqueue_script('rope-tow-customizer-preview-navigation', get_template_directory_uri() . '/assets/admin/js/customizerPreview/navigation.js', array('customize-preview'), ROPE_TOW_VERSION, true);
  wp_enqueue_script('rope-tow-customizer-preview-buttons', get_template_directory_uri() . '/assets/admin/js/customizerPreview/buttons.js', array('customize-preview'), ROPE_TOW_VERSION, true);
  wp_enqueue_script('rope-tow-customizer-preview-footer', get_template_directory_uri() . '/assets/admin/js/customizerPreview/footer.js', array('customize-preview'), ROPE_TOW_VERSION, true);
  wp_enqueue_script('rope-tow-customizer-preview-404', get_template_directory_uri() . '/assets/admin/js/customizerPreview/404Page.js', array('customize-preview'), ROPE_TOW_VERSION, true);
  wp_enqueue_script('rope-tow-customizer-preview-resources', get_template_directory_uri() . '/assets/admin/js/customizerPreview/resources.js', array('customize-preview'), ROPE_TOW_VERSION, true);
  wp_enqueue_script('rope-tow-customizer-preview', get_template_directory_uri() . '/assets/admin/js/customizerPreview.js', array('customize-preview'), ROPE_TOW_VERSION, true);
}
add_action('customize_preview_init', 'rope_tow_customize_preview_js');

// ******
// Modify the customizer when options change
// ******

function rope_tow_customize_controls_js() {
  wp_enqueue_media();
  wp_enqueue_script('rope-tow-customizer-controls', get_template_directory_uri() . '/assets/admin/js/customizerControls.js', array('customize-controls'), ROPE_TOW_VERSION, true);
}
add_action('customize_controls_enqueue_scripts', 'rope_tow_customize_controls_js');

// *******
// Customizer css
// *******

function rope_tow_customizer_styles() {
  wp_enqueue_style('rope-tow-customizer-styles', get_template_directory_uri() . '/assets/admin/css/admin.css', array(), ROPE_TOW_VERSION);
}
add_action('customize_controls_print_styles', 'rope_tow_customizer_styles');
