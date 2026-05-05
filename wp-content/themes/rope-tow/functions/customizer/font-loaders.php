<?php

// *******
// Preload google fonts to help prevent FOUC
// *******

function nylon_preload_gfonts() {
  $body_font = get_theme_mod('nylon_body_font', nylon_get_default('nylon_body_font'));
  $heading_font = get_theme_mod('nylon_heading_font', nylon_get_default('nylon_heading_font'));

  if (!empty($body_font) || !empty($heading_font)) {
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">';
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>';
  }
}
add_action('wp_head', 'nylon_preload_gfonts', 0);

// *******
// Load custom fonts
// *******

function nylon_enqueue_selected_fonts() {
  $fonts = array_unique(array_filter(array(
    get_theme_mod('nylon_body_font', nylon_get_default('nylon_body_font')),
    get_theme_mod('nylon_heading_font', nylon_get_default('nylon_heading_font'))
  )));

  foreach ($fonts as $font) {
    $font_slug = strtolower(str_replace(' ', '-', $font));
    $font_query = str_replace(' ', '+', $font);
    wp_enqueue_style("nylon-font-{$font_slug}", "https://fonts.googleapis.com/css2?family={$font_query}:ital,wght@0,300;0,400;0,500;0,700;0,900&display=swap", false);
  }
}
add_action('wp_enqueue_scripts', 'nylon_enqueue_selected_fonts');

// *******
// Fetch all google fonts
// NOTE: only run this once when you want to pull a fresh list of google fonts
// *******

function nylon_fetch_and_save_google_fonts() {
  $api_key = 'AIzaSyD7DlLKOnNPIYXgK9-asFWEdn-kmpGZ1Bw';
  $api_url = 'https://www.googleapis.com/webfonts/v1/webfonts?sort=alpha&key=' . $api_key;
  $response = wp_remote_get($api_url);

  if (is_wp_error($response)) return;

  $body = wp_remote_retrieve_body($response);
  $file_path = get_template_directory() . '/assets/fonts/google-fonts.json';

  file_put_contents($file_path, $body);
}
// nylon_fetch_and_save_google_fonts();