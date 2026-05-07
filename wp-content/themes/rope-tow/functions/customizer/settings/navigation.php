<?php

// Nav hide toggle
rope_tow_add_setting($wp_customize, 'rope_tow_nav_hide', array(
  'default'           => false,
  'sanitize_callback' => 'wp_validate_boolean',
  'transport'         => 'postMessage',
));

// Nav style
rope_tow_add_setting($wp_customize, 'rope_tow_navigation_style', array(
  'default'           => 'solid-contained',
  'sanitize_callback' => 'sanitize_text_field',
  'transport'         => 'postMessage',
));

// Nav layout
rope_tow_add_setting($wp_customize, 'rope_tow_navigation_layout', array(
  'default'           => 'spaced-out',
  'sanitize_callback' => 'sanitize_text_field',
  'transport'         => 'postMessage',
));

// Mobile nav hamburger animation style
rope_tow_add_setting($wp_customize, 'rope_tow_hamburger_animation', array(
  'default'           => 'collapse',
  'sanitize_callback' => 'sanitize_text_field',
  'transport'         => 'postMessage',
));

// Nav cta toggle
rope_tow_add_setting($wp_customize, 'rope_tow_nav_cta_enabled', array(
  'default'           => true,
  'sanitize_callback' => 'wp_validate_boolean',
  'transport'         => 'postMessage',
));

// Nav cta button title
rope_tow_add_setting($wp_customize, 'rope_tow_nav_cta_button_title', array(
  'default'           => 'Get A Demo',
  'sanitize_callback' => 'sanitize_text_field',
  'transport'         => 'postMessage',
));

// Nav cta button url
rope_tow_add_setting($wp_customize, 'rope_tow_nav_cta_button_url', array(
  'default'           => '#',
  'sanitize_callback' => 'esc_url_raw',
  'transport'         => 'postMessage',
));

// Nav cta button style
rope_tow_add_setting($wp_customize, 'rope_tow_nav_cta_button_style', array(
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
rope_tow_add_setting($wp_customize, 'rope_tow_nav_cta_button_size', array(
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
