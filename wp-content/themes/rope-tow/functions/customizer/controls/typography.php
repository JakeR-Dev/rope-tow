<?php

// function to retrieve all fonts
function rope_tow_get_google_fonts() {
  $json_file = get_template_directory() . '/assets/fonts/google-fonts.json';
  if (!file_exists($json_file)) return [];

  $json = file_get_contents($json_file);
  $data = json_decode($json, true);
  $fonts = [];

  foreach ($data['items'] as $item) {
    $fonts[$item['family']] = $item['family'];
  }

  return $fonts;
}
$fonts = rope_tow_get_google_fonts();

// Heading font select
$wp_customize->add_control('rope_tow_heading_font', array(
  'label'   => __('Heading Font', 'rope-tow'),
  'section' => 'rope_tow_typography_section',
  'type'    => 'select',
  'choices'  => $fonts,
  'input_attrs' => [
    'class' => 'rope-tow-font-select'
  ]
));

// Heading font weight select
$wp_customize->add_control('rope_tow_heading_font_weight', array(
  'label'   => __('Heading Font Weight', 'rope-tow'),
  'section' => 'rope_tow_typography_section',
  'type'    => 'select',
  'choices' => array(
    'lightest' => 'Lightest',
    'light'    => 'Light',
    'normal'   => 'Normal',
    'semibold' => 'Semibold',
    'bold'     => 'Bold',
    'black'    => 'Black',
  ),
));

// Body font select
$wp_customize->add_control('rope_tow_body_font', array(
  'label'   => __('Body Font', 'rope-tow'),
  'section' => 'rope_tow_typography_section',
  'type'    => 'select',
  'choices'  => $fonts,
  'input_attrs' => [
    'class' => 'rope-tow-font-select'
  ]
));

// Body font weight select
$wp_customize->add_control('rope_tow_body_font_weight', array(
  'label'   => __('Body Font Weight', 'rope-tow'),
  'section' => 'rope_tow_typography_section',
  'type'    => 'select',
  'choices' => array(
    'lightest' => 'Lightest',
    'light'    => 'Light',
    'normal'   => 'Normal',
    'semibold' => 'Semibold',
    'bold'     => 'Bold',
    'black'    => 'Black',
  ),
));

// Body font size slider
$wp_customize->add_control('rope_tow_body_font_size', array(
  'label'       => __( 'Body Font Size', 'rope-tow' ),
  'section'     => 'rope_tow_typography_section',
  'type'        => 'range',
  'input_attrs' => array(
    'min'  => 12,
    'max'  => 22,
    'step' => 1,
  ),
  'description' => '<span id="body-font-size-value"></span>',
));

// H1 font size slider
$wp_customize->add_control('rope_tow_h1_font_size', array(
  'label'       => __( 'H1 Font Size', 'rope-tow' ),
  'section'     => 'rope_tow_typography_section',
  'type'        => 'range',
  'input_attrs' => array(
    'min'  => 16,
    'max'  => 100,
    'step' => 1,
  ),
  'description' => '<span id="h1-font-size-value"></span>',
));

// H2 font size slider
$wp_customize->add_control('rope_tow_h2_font_size', array(
  'label'       => __( 'H2 Font Size', 'rope-tow' ),
  'section'     => 'rope_tow_typography_section',
  'type'        => 'range',
  'input_attrs' => array(
    'min'  => 16,
    'max'  => 80,
    'step' => 1,
  ),
  'description' => '<span id="h2-font-size-value"></span>',
));

// H3 font size slider
$wp_customize->add_control('rope_tow_h3_font_size', array(
  'label'       => __( 'H3 Font Size', 'rope-tow' ),
  'section'     => 'rope_tow_typography_section',
  'type'        => 'range',
  'input_attrs' => array(
    'min'  => 16,
    'max'  => 60,
    'step' => 1,
  ),
  'description' => '<span id="h3-font-size-value"></span>',
));

// H4 font size slider
$wp_customize->add_control('rope_tow_h4_font_size', array(
  'label'       => __( 'H4 Font Size', 'rope-tow' ),
  'section'     => 'rope_tow_typography_section',
  'type'        => 'range',
  'input_attrs' => array(
    'min'  => 16,
    'max'  => 50,
    'step' => 1,
  ),
  'description' => '<span id="h4-font-size-value"></span>',
));

// H5 font size slider
$wp_customize->add_control('rope_tow_h5_font_size', array(
  'label'       => __( 'H5 Font Size', 'rope-tow' ),
  'section'     => 'rope_tow_typography_section',
  'type'        => 'range',
  'input_attrs' => array(
    'min'  => 16,
    'max'  => 40,
    'step' => 1,
  ),
  'description' => '<span id="h5-font-size-value"></span>',
));

// H6 font size slider
$wp_customize->add_control('rope_tow_h6_font_size', array(
  'label'       => __( 'H6 Font Size', 'rope-tow' ),
  'section'     => 'rope_tow_typography_section',
  'type'        => 'range',
  'input_attrs' => array(
    'min'  => 12,
    'max'  => 30,
    'step' => 1,
  ),
  'description' => '<span id="h6-font-size-value"></span>',
));