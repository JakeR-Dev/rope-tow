<?php

// 404 page text color
rope_tow_add_setting($wp_customize, 'rope_tow_404_text_style', array(
  'default'           => 'dark',
  'sanitize_callback' => function($val) {
    return in_array($val, ['default', 'dark', 'light'], true) ? $val : 'default';
  },
  'transport'         => 'postMessage',
));

// 404 page background image
rope_tow_add_setting($wp_customize, 'rope_tow_404_background_image', array(
  'default'           => '',
  'sanitize_callback' => 'esc_url_raw',
));

// 404 page image
rope_tow_add_setting($wp_customize, 'rope_tow_404_top_image', array(
  'default'           => '',
  'sanitize_callback' => 'esc_url_raw',
));

// 404 page heading
rope_tow_add_setting($wp_customize, 'rope_tow_404_heading_text', array(
  'default'           => 'Oops! Nothing here.',
  'transport'         => 'postMessage',
  'sanitize_callback' => 'sanitize_text_field',
));

// 404 page subtitle
rope_tow_add_setting($wp_customize, 'rope_tow_404_subtitle_text', array(
  'default'           => '',
  'transport'         => 'postMessage',
  'sanitize_callback' => 'sanitize_text_field',
));

// 404 page button text
rope_tow_add_setting($wp_customize, 'rope_tow_404_button_label', array(
  'default'           => 'Go Back',
  'transport'         => 'postMessage',
  'sanitize_callback' => 'sanitize_text_field',
));

// 404 page button url
rope_tow_add_setting($wp_customize, 'rope_tow_404_button_url', array(
  'default'           => home_url('/'),
  'sanitize_callback' => 'esc_url_raw',
));

// 404 page button style
rope_tow_add_setting($wp_customize, 'rope_tow_404_button_style', array(
  'default'           => 'btn-primary',
  'sanitize_callback' => function($val) {
    $valid = [
      'btn-primary',
      'btn-primary-outline',
      'btn-secondary',
      'btn-secondary-outline',
      'btn-white',
      'btn-white-outline',
    ];
    return in_array($val, $valid, true) ? $val : 'btn-primary';
  },
  'transport' => 'postMessage',
));

// 404 page secondary button
rope_tow_add_setting($wp_customize, 'rope_tow_404_button2_label', array(
  'default'           => '',
  'sanitize_callback' => 'sanitize_text_field',
  'transport'         => 'postMessage',
));

// 404 page secondary url
rope_tow_add_setting($wp_customize, 'rope_tow_404_button2_url', array(
  'default'           => '',
  'sanitize_callback' => 'esc_url_raw',
));

// 404 page secondary button style
rope_tow_add_setting($wp_customize, 'rope_tow_404_button2_style', array(
  'default'           => 'btn-primary-outline',
  'sanitize_callback' => function($val) {
    $valid = [
      'btn-primary',
      'btn-primary-outline',
      'btn-secondary',
      'btn-secondary-outline',
      'btn-white',
      'btn-white-outline',
    ];
    return in_array($val, $valid, true) ? $val : 'btn-secondary';
  },
  'transport' => 'postMessage',
));