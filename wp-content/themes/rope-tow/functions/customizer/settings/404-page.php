<?php

// 404 page text color
nylon_add_setting($wp_customize, 'nylon_404_text_style', array(
  'default'           => 'default',
  'sanitize_callback' => function($val) {
    return in_array($val, ['default', 'dark', 'light'], true) ? $val : 'default';
  },
  'transport'         => 'postMessage',
));

// 404 page background image
nylon_add_setting($wp_customize, 'nylon_404_background_image', array(
  'default'           => '',
  'sanitize_callback' => 'esc_url_raw',
));

// 404 page image
nylon_add_setting($wp_customize, 'nylon_404_top_image', array(
  'default'           => '',
  'sanitize_callback' => 'esc_url_raw',
));

// 404 page heading
nylon_add_setting($wp_customize, 'nylon_404_heading_text', array(
  'default'           => '404. Page not found',
  'transport'         => 'postMessage',
  'sanitize_callback' => 'sanitize_text_field',
));

// 404 page subtitle
nylon_add_setting($wp_customize, 'nylon_404_subtitle_text', array(
  'default'           => '',
  'transport'         => 'postMessage',
  'sanitize_callback' => 'sanitize_text_field',
));

// 404 page button text
nylon_add_setting($wp_customize, 'nylon_404_button_label', array(
  'default'           => 'Back to Homepage',
  'transport'         => 'postMessage',
  'sanitize_callback' => 'sanitize_text_field',
));

// 404 page button url
nylon_add_setting($wp_customize, 'nylon_404_button_url', array(
  'default'           => home_url('/'),
  'sanitize_callback' => 'esc_url_raw',
));

// 404 page button style
nylon_add_setting($wp_customize, 'nylon_404_button_style', array(
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
nylon_add_setting($wp_customize, 'nylon_404_button2_label', array(
  'default'           => '',
  'sanitize_callback' => 'sanitize_text_field',
  'transport'         => 'postMessage',
));

// 404 page secondary url
nylon_add_setting($wp_customize, 'nylon_404_button2_url', array(
  'default'           => '',
  'sanitize_callback' => 'esc_url_raw',
));

// 404 page secondary button style
nylon_add_setting($wp_customize, 'nylon_404_button2_style', array(
  'default'           => 'btn-secondary',
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