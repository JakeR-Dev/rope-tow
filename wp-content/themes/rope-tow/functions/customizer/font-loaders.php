<?php

// *******
// Preload google fonts to help prevent FOUC
// *******

function rope_tow_preload_gfonts() {
  $body_font = get_theme_mod('rope_tow_body_font', rope_tow_get_default('rope_tow_body_font'));
  $heading_font = get_theme_mod('rope_tow_heading_font', rope_tow_get_default('rope_tow_heading_font'));

  if (!empty($body_font) || !empty($heading_font)) {
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">';
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>';
  }
}
add_action('wp_head', 'rope_tow_preload_gfonts', 0);

// *******
// Load custom fonts
// *******

function rope_tow_enqueue_selected_fonts() {
  $fonts = array_unique(array_filter(array(
    get_theme_mod('rope_tow_body_font', rope_tow_get_default('rope_tow_body_font')),
    get_theme_mod('rope_tow_heading_font', rope_tow_get_default('rope_tow_heading_font'))
  )));

  foreach ($fonts as $font) {
    $font_slug = strtolower(str_replace(' ', '-', $font));
    $font_query = str_replace(' ', '+', $font);
    wp_enqueue_style("rope-tow-font-{$font_slug}", "https://fonts.googleapis.com/css2?family={$font_query}:ital,wght@0,300;0,400;0,500;0,700;0,900&display=swap", false);
  }
}
add_action('wp_enqueue_scripts', 'rope_tow_enqueue_selected_fonts');