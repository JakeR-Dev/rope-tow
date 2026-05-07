<?php

// Dark mode toggle
rope_tow_add_setting($wp_customize, 'rope_tow_dark_mode', array(
  'default'           => 'light',
  'sanitize_callback' => function($input) {
    return in_array($input, ['light', 'dark']) ? $input : 'light';
  },
  'transport' => 'postMessage',
));

// Primary color
rope_tow_add_setting($wp_customize, 'rope_tow_primary_color', array(
  'default'           => rope_tow_get_default('rope_tow_primary_color'),
  'sanitize_callback' => 'sanitize_hex_color',
  'transport'         => 'postMessage',
));

// Secondary color
rope_tow_add_setting($wp_customize, 'rope_tow_secondary_color', array(
  'default'           => rope_tow_get_default('rope_tow_secondary_color'),
  'sanitize_callback' => 'sanitize_hex_color',
  'transport'         => 'postMessage',
));

// Tertiary color
rope_tow_add_setting($wp_customize, 'rope_tow_tertiary_color', array(
  'default'           => rope_tow_get_default('rope_tow_tertiary_color'),
  'sanitize_callback' => 'sanitize_hex_color',
  'transport'         => 'postMessage',
));

// Tertiary Alt color
rope_tow_add_setting($wp_customize, 'rope_tow_tertiary_alt_color', array(
  'default'           => rope_tow_get_default('rope_tow_tertiary_alt_color'),
  'sanitize_callback' => 'sanitize_hex_color',
  'transport'         => 'postMessage',
));

// Brand black
rope_tow_add_setting($wp_customize, 'rope_tow_brand_black', array(
  'default'           => rope_tow_get_default('rope_tow_brand_black'),
  'sanitize_callback' => 'sanitize_hex_color',
  'transport'         => 'postMessage',
));

// Brand gray
rope_tow_add_setting($wp_customize, 'rope_tow_brand_gray', array(
  'default'           => rope_tow_get_default('rope_tow_brand_gray'),
  'sanitize_callback' => 'sanitize_hex_color',
  'transport'         => 'postMessage',
));

// Brand light gray
rope_tow_add_setting($wp_customize, 'rope_tow_brand_light_gray', array(
  'default'           => rope_tow_get_default('rope_tow_brand_light_gray'),
  'sanitize_callback' => 'sanitize_hex_color',
  'transport'         => 'postMessage',
));

// Brand white
rope_tow_add_setting($wp_customize, 'rope_tow_brand_white', array(
  'default'           => rope_tow_get_default('rope_tow_brand_white'),
  'sanitize_callback' => 'sanitize_hex_color',
  'transport'         => 'postMessage',
));

// Brand error color
rope_tow_add_setting($wp_customize, 'rope_tow_brand_error', array(
  'default'           => rope_tow_get_default('rope_tow_brand_error'),
  'sanitize_callback' => 'sanitize_hex_color',
  'transport'         => 'postMessage',
));

// Nav background color
rope_tow_add_setting($wp_customize, 'rope_tow_nav_color', array(
  'default'           => rope_tow_get_default('rope_tow_nav_color'),
  'sanitize_callback' => 'sanitize_hex_color',
  'transport'         => 'postMessage',
));

// Nav font color
rope_tow_add_setting($wp_customize, 'rope_tow_nav_font_color', array(
  'default'           => rope_tow_get_default('rope_tow_nav_font_color'),
  'sanitize_callback' => 'sanitize_hex_color',
  'transport'         => 'postMessage',
));

// Body font color
rope_tow_add_setting($wp_customize, 'rope_tow_body_color', array(
  'default'           => rope_tow_get_default('rope_tow_body_color'),
  'sanitize_callback' => 'sanitize_hex_color',
  'transport'         => 'postMessage',
));

// Heading font color
rope_tow_add_setting($wp_customize, 'rope_tow_heading_color', array(
  'default'           => rope_tow_get_default('rope_tow_heading_color'),
  'sanitize_callback' => 'sanitize_hex_color',
  'transport'         => 'postMessage',
));

// Primary button color
rope_tow_add_setting($wp_customize, 'rope_tow_primary_button_color', array(
  'default'           => rope_tow_get_default('rope_tow_primary_button_color'),
  'sanitize_callback' => 'sanitize_hex_color',
  'transport'         => 'postMessage',
));

// Primary button font color
rope_tow_add_setting($wp_customize, 'rope_tow_primary_button_font_color', array(
  'default'           => rope_tow_get_default('rope_tow_primary_button_font_color'),
  'sanitize_callback' => 'sanitize_hex_color',
  'transport'         => 'postMessage',
));

// Secondary button color
rope_tow_add_setting($wp_customize, 'rope_tow_secondary_button_color', array(
  'default'           => rope_tow_get_default('rope_tow_secondary_button_color'),
  'sanitize_callback' => 'sanitize_hex_color',
  'transport'         => 'postMessage',
));

// Secondary button font color
rope_tow_add_setting($wp_customize, 'rope_tow_secondary_button_font_color', array(
  'default'           => rope_tow_get_default('rope_tow_secondary_button_font_color'),
  'sanitize_callback' => 'sanitize_hex_color',
  'transport'         => 'postMessage',
));