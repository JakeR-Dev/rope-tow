<?php

// Footer logo
rope_tow_add_setting($wp_customize, 'rope_tow_footer_logo', array(
  'default'           => get_theme_mod('custom_logo'),
  'sanitize_callback' => 'esc_url_raw',
));

// Footer copyright text
rope_tow_add_setting($wp_customize, 'rope_tow_footer_copyright_text', array(
  'default'           => '',
  'sanitize_callback' => 'sanitize_text_field',
  'transport'         => 'postMessage',
));

// Footer layout setting
rope_tow_add_setting($wp_customize, 'rope_tow_footer_layout', array(
  'default'           => 'space-between',
  'sanitize_callback' => function( $value ) {
    return in_array( $value, array('space-between', 'centered')) ? $value : 'space-between';
  },
  'transport' => 'postMessage',
));

// Footer background color
rope_tow_add_setting($wp_customize, 'rope_tow_footer_color', array(
  'default'           => '#5000EA',
  'sanitize_callback' => 'sanitize_hex_color',
  'transport'         => 'postMessage',
));

// Footer background image
rope_tow_add_setting($wp_customize, 'rope_tow_footer_background_image', array(
  'default'           => '',
  'sanitize_callback' => 'esc_url_raw',
  'transport'         => 'postMessage',
));

// Footer socials
rope_tow_add_setting($wp_customize, 'rope_tow_footer_social_links', array(
  'default'           => '[]',
  'sanitize_callback' => 'rope_tow_sanitize_footer_social_links',
  'transport' => 'postMessage',
));

// Footer social link color
rope_tow_add_setting($wp_customize, 'rope_tow_footer_social_color', array(
  'default'           => '#ffffff',
  'sanitize_callback' => 'sanitize_hex_color',
  'transport'         => 'postMessage',
));

// Footer cta toggle
rope_tow_add_setting($wp_customize, 'rope_tow_footer_cta_enabled', array(
  'default'           => false,
  'sanitize_callback' => 'wp_validate_boolean',
  'transport'         => 'postMessage',
));

// Footer cta layout
rope_tow_add_setting($wp_customize, 'rope_tow_footer_cta_layout', array(
  'default'           => 'layout-stacked',
  'sanitize_callback' => function($val) {
    $valid = [
      'layout-stacked',
      'layout-split'
    ];
    return in_array($val, $valid, true) ? $val : '';
  },
  'transport' => 'postMessage',
));

// Footer cta title
rope_tow_add_setting($wp_customize, 'rope_tow_footer_cta_title', array(
  'default'           => '',
  'sanitize_callback' => 'sanitize_text_field',
  'transport'         => 'postMessage',
));

// Footer cta subtitle
rope_tow_add_setting($wp_customize, 'rope_tow_footer_cta_subtitle', array(
  'default'           => '',
  'sanitize_callback' => 'sanitize_text_field',
  'transport'         => 'postMessage',
));

// Footer cta background color
rope_tow_add_setting($wp_customize, 'rope_tow_footer_cta_background_color', array(
  'default'           => '',
  'sanitize_callback' => 'sanitize_hex_color',
  'transport'         => 'postMessage',
));

// Footer cta background image
rope_tow_add_setting($wp_customize, 'rope_tow_footer_cta_background_image', array(
  'default'           => '',
  'sanitize_callback' => 'esc_url_raw',
  'transport'         => 'postMessage',
));

// Footer cta button title
rope_tow_add_setting($wp_customize, 'rope_tow_footer_cta_button_title', array(
  'default'           => '',
  'sanitize_callback' => 'sanitize_text_field',
  'transport'         => 'postMessage',
));

// Footer cta button url
rope_tow_add_setting($wp_customize, 'rope_tow_footer_cta_button_url', array(
  'default'           => '',
  'sanitize_callback' => 'esc_url_raw',
  'transport'         => 'postMessage',
));

// Footer cta button style
rope_tow_add_setting($wp_customize, 'rope_tow_footer_cta_button_style', array(
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

// Footer cta button size
rope_tow_add_setting($wp_customize, 'rope_tow_footer_cta_button_size', array(
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

// Footer cta button 2 title
rope_tow_add_setting($wp_customize, 'rope_tow_footer_cta_secondary_button_title', array(
  'default'           => '',
  'sanitize_callback' => 'sanitize_text_field',
  'transport'         => 'postMessage',
));

// Footer cta button 2 url
rope_tow_add_setting($wp_customize, 'rope_tow_footer_cta_secondary_button_url', array(
  'default'           => '',
  'sanitize_callback' => 'esc_url_raw',
  'transport'         => 'postMessage',
));

// Footer cta button 2 style
rope_tow_add_setting($wp_customize, 'rope_tow_footer_cta_secondary_button_style', array(
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

// Footer cta button 2 size
rope_tow_add_setting($wp_customize, 'rope_tow_footer_cta_secondary_button_size', array(
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