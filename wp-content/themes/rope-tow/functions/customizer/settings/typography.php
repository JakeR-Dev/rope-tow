<?php

nylon_add_setting($wp_customize, 'nylon_heading_font', array(
  'default'           => 'Inter',
  'sanitize_callback' => 'sanitize_text_field',
  'transport'         => 'postMessage',
));

nylon_add_setting($wp_customize, 'nylon_heading_font_weight', array(
  'default'           => 'semibold',
  'sanitize_callback' => 'sanitize_text_field',
  'transport'         => 'postMessage',
));

nylon_add_setting($wp_customize, 'nylon_body_font', array(
  'default'           => 'Inter',
  'sanitize_callback' => 'sanitize_text_field',
  'transport'         => 'postMessage',
));

nylon_add_setting($wp_customize, 'nylon_body_font_weight', array(
  'default'           => 'normal',
  'sanitize_callback' => 'sanitize_text_field',
  'transport'         => 'postMessage',
));

nylon_add_setting($wp_customize, 'nylon_body_font_size', array(
  'default'           => 16,
  'sanitize_callback' => 'absint',
  'transport'         => 'postMessage',
));

nylon_add_setting($wp_customize, 'nylon_h1_font_size', array(
  'default'           => 48,
  'sanitize_callback' => 'absint',
  'transport'         => 'postMessage',
));

nylon_add_setting($wp_customize, 'nylon_h2_font_size', array(
  'default'           => 36,
  'sanitize_callback' => 'absint',
  'transport'         => 'postMessage',
));

nylon_add_setting($wp_customize, 'nylon_h3_font_size', array(
  'default'           => 28,
  'sanitize_callback' => 'absint',
  'transport'         => 'postMessage',
));

nylon_add_setting($wp_customize, 'nylon_h4_font_size', array(
  'default'           => 22,
  'sanitize_callback' => 'absint',
  'transport'         => 'postMessage',
));

nylon_add_setting($wp_customize, 'nylon_h5_font_size', array(
  'default'           => 20,
  'sanitize_callback' => 'absint',
  'transport'         => 'postMessage',
));

nylon_add_setting($wp_customize, 'nylon_h6_font_size', array(
  'default'           => 16,
  'sanitize_callback' => 'absint',
  'transport'         => 'postMessage',
));
