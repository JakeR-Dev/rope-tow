<?php

rope_tow_add_setting($wp_customize, 'rope_tow_heading_font', array(
  'default'           => 'Inter',
  'sanitize_callback' => 'sanitize_text_field',
  'transport'         => 'postMessage',
));

rope_tow_add_setting($wp_customize, 'rope_tow_heading_font_weight', array(
  'default'           => 'semibold',
  'sanitize_callback' => 'sanitize_text_field',
  'transport'         => 'postMessage',
));

rope_tow_add_setting($wp_customize, 'rope_tow_body_font', array(
  'default'           => 'Inter',
  'sanitize_callback' => 'sanitize_text_field',
  'transport'         => 'postMessage',
));

rope_tow_add_setting($wp_customize, 'rope_tow_body_font_weight', array(
  'default'           => 'normal',
  'sanitize_callback' => 'sanitize_text_field',
  'transport'         => 'postMessage',
));

rope_tow_add_setting($wp_customize, 'rope_tow_body_font_size', array(
  'default'           => 16,
  'sanitize_callback' => 'absint',
  'transport'         => 'postMessage',
));

rope_tow_add_setting($wp_customize, 'rope_tow_h1_font_size', array(
  'default'           => 48,
  'sanitize_callback' => 'absint',
  'transport'         => 'postMessage',
));

rope_tow_add_setting($wp_customize, 'rope_tow_h2_font_size', array(
  'default'           => 36,
  'sanitize_callback' => 'absint',
  'transport'         => 'postMessage',
));

rope_tow_add_setting($wp_customize, 'rope_tow_h3_font_size', array(
  'default'           => 28,
  'sanitize_callback' => 'absint',
  'transport'         => 'postMessage',
));

rope_tow_add_setting($wp_customize, 'rope_tow_h4_font_size', array(
  'default'           => 22,
  'sanitize_callback' => 'absint',
  'transport'         => 'postMessage',
));

rope_tow_add_setting($wp_customize, 'rope_tow_h5_font_size', array(
  'default'           => 20,
  'sanitize_callback' => 'absint',
  'transport'         => 'postMessage',
));

rope_tow_add_setting($wp_customize, 'rope_tow_h6_font_size', array(
  'default'           => 16,
  'sanitize_callback' => 'absint',
  'transport'         => 'postMessage',
));
