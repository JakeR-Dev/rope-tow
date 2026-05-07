<?php

rope_tow_add_setting($wp_customize, 'rope_tow_heading_font', array(
  'default'           => 'Poppins',
  'sanitize_callback' => 'sanitize_text_field',
  'transport'         => 'postMessage',
));

rope_tow_add_setting($wp_customize, 'rope_tow_heading_font_weight', array(
  'default'           => 'bold',
  'sanitize_callback' => 'sanitize_text_field',
  'transport'         => 'postMessage',
));

rope_tow_add_setting($wp_customize, 'rope_tow_body_font', array(
  'default'           => 'Poppins',
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
  'default'           => 70,
  'sanitize_callback' => 'absint',
  'transport'         => 'postMessage',
));

rope_tow_add_setting($wp_customize, 'rope_tow_h2_font_size', array(
  'default'           => 50,
  'sanitize_callback' => 'absint',
  'transport'         => 'postMessage',
));

rope_tow_add_setting($wp_customize, 'rope_tow_h3_font_size', array(
  'default'           => 40,
  'sanitize_callback' => 'absint',
  'transport'         => 'postMessage',
));

rope_tow_add_setting($wp_customize, 'rope_tow_h4_font_size', array(
  'default'           => 24,
  'sanitize_callback' => 'absint',
  'transport'         => 'postMessage',
));

rope_tow_add_setting($wp_customize, 'rope_tow_h5_font_size', array(
  'default'           => 18,
  'sanitize_callback' => 'absint',
  'transport'         => 'postMessage',
));

rope_tow_add_setting($wp_customize, 'rope_tow_h6_font_size', array(
  'default'           => 16,
  'sanitize_callback' => 'absint',
  'transport'         => 'postMessage',
));
