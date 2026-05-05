<?php

// Dark mode toggle
nylon_add_setting($wp_customize, 'nylon_dark_mode', array(
  'default'           => 'light',
  'sanitize_callback' => function($input) {
    return in_array($input, ['light', 'dark']) ? $input : 'light';
  },
  'transport' => 'postMessage',
));

// Primary color
nylon_add_setting($wp_customize, 'nylon_primary_color', array(
  'default'           => '#5000EA',
  'sanitize_callback' => 'sanitize_hex_color',
  'transport'         => 'postMessage',
));

// Secondary color
nylon_add_setting($wp_customize, 'nylon_secondary_color', array(
  'default'           => '#00E0BF',
  'sanitize_callback' => 'sanitize_hex_color',
  'transport'         => 'postMessage',
));

// Tertiary color
nylon_add_setting($wp_customize, 'nylon_tertiary_color', array(
  'default'           => '#5000EA',
  'sanitize_callback' => 'sanitize_hex_color',
  'transport'         => 'postMessage',
));

// Tertiary Alt color
nylon_add_setting($wp_customize, 'nylon_tertiary_alt_color', array(
  'default'           => '#EBDE00',
  'sanitize_callback' => 'sanitize_hex_color',
  'transport'         => 'postMessage',
));

// Brand black
nylon_add_setting($wp_customize, 'nylon_brand_black', array(
  'default'           => '#0D0521',
  'sanitize_callback' => 'sanitize_hex_color',
  'transport'         => 'postMessage',
));

// Brand gray
nylon_add_setting($wp_customize, 'nylon_brand_gray', array(
  'default'           => '#666666',
  'sanitize_callback' => 'sanitize_hex_color',
  'transport'         => 'postMessage',
));

// Brand light gray
nylon_add_setting($wp_customize, 'nylon_brand_light_gray', array(
  'default'           => '#9a9a9a',
  'sanitize_callback' => 'sanitize_hex_color',
  'transport'         => 'postMessage',
));

// Brand white
nylon_add_setting($wp_customize, 'nylon_brand_white', array(
  'default'           => '#ffffff',
  'sanitize_callback' => 'sanitize_hex_color',
  'transport'         => 'postMessage',
));

// Brand error color
nylon_add_setting($wp_customize, 'nylon_brand_error', array(
  'default'           => '#E7391E',
  'sanitize_callback' => 'sanitize_hex_color',
  'transport'         => 'postMessage',
));

// Nav background color
nylon_add_setting($wp_customize, 'nylon_nav_color', array(
  'default'           => '#5000EA',
  'sanitize_callback' => 'sanitize_hex_color',
  'transport'         => 'postMessage',
));

// Nav font color
nylon_add_setting($wp_customize, 'nylon_nav_font_color', array(
  'default'           => '#ffffff',
  'sanitize_callback' => 'sanitize_hex_color',
  'transport'         => 'postMessage',
));

// Body font color
nylon_add_setting($wp_customize, 'nylon_body_color', array(
  'default'           => '#29262e',
  'sanitize_callback' => 'sanitize_hex_color',
  'transport'         => 'postMessage',
));

// Heading font color
nylon_add_setting($wp_customize, 'nylon_heading_color', array(
  'default'           => '#29262e',
  'sanitize_callback' => 'sanitize_hex_color',
  'transport'         => 'postMessage',
));

// Primary button color
nylon_add_setting($wp_customize, 'nylon_primary_button_color', array(
  'default'           => '#5000EA',
  'sanitize_callback' => 'sanitize_hex_color',
  'transport'         => 'postMessage',
));

// Primary button font color
nylon_add_setting($wp_customize, 'nylon_primary_button_font_color', array(
  'default'           => '#ffffff',
  'sanitize_callback' => 'sanitize_hex_color',
  'transport'         => 'postMessage',
));

// Secondary button color
nylon_add_setting($wp_customize, 'nylon_secondary_button_color', array(
  'default'           => '#FF595E',
  'sanitize_callback' => 'sanitize_hex_color',
  'transport'         => 'postMessage',
));

// Secondary button font color
nylon_add_setting($wp_customize, 'nylon_secondary_button_font_color', array(
  'default'           => '#ffffff',
  'sanitize_callback' => 'sanitize_hex_color',
  'transport'         => 'postMessage',
));