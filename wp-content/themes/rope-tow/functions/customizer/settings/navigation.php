<?php

// Nav hide toggle
nylon_add_setting($wp_customize, 'nylon_nav_hide', array(
  'default'           => false,
  'sanitize_callback' => 'wp_validate_boolean',
  'transport'         => 'postMessage',
));

// Nav style
nylon_add_setting($wp_customize, 'nylon_navigation_style', array(
  'default'           => 'transparent-full-width',
  'sanitize_callback' => 'sanitize_text_field',
  'transport'         => 'postMessage',
));

// Nav layout
nylon_add_setting($wp_customize, 'nylon_navigation_layout', array(
  'default'           => 'spaced-out',
  'sanitize_callback' => 'sanitize_text_field',
  'transport'         => 'postMessage',
));

// Mobile nav hamburger animation style
nylon_add_setting($wp_customize, 'nylon_hamburger_animation', array(
  'default'           => 'criss-cross',
  'sanitize_callback' => 'sanitize_text_field',
  'transport'         => 'postMessage',
));

// Nav cta toggle
nylon_add_setting($wp_customize, 'nylon_nav_cta_enabled', array(
  'default'           => true,
  'sanitize_callback' => 'wp_validate_boolean',
  'transport'         => 'postMessage',
));

// Nav cta button title
nylon_add_setting($wp_customize, 'nylon_nav_cta_button_title', array(
  'default'           => 'Get A Demo',
  'sanitize_callback' => 'sanitize_text_field',
  'transport'         => 'postMessage',
));

// Nav cta button url
nylon_add_setting($wp_customize, 'nylon_nav_cta_button_url', array(
  'default'           => '#',
  'sanitize_callback' => 'esc_url_raw',
  'transport'         => 'postMessage',
));

// Nav cta button style
nylon_add_setting($wp_customize, 'nylon_nav_cta_button_style', array(
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

// Nav cta button size
nylon_add_setting($wp_customize, 'nylon_nav_cta_button_size', array(
  'default'           => 'btn',
  'sanitize_callback' => function($val) {
    $valid = [
      'btn btn-sm',
      'btn',
      'btn btn-lg'
    ];
    return in_array($val, $valid, true) ? $val : 'btn';
  },
  'transport' => 'postMessage',
));
