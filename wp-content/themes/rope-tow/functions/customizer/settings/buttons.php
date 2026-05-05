<?php

// Button border radius
nylon_add_setting($wp_customize, 'nylon_button_radius', array(
  'default'           => '50',
  'sanitize_callback' => 'absint',
  'transport'         => 'postMessage',
));

// Button padding X
nylon_add_setting($wp_customize, 'nylon_button_padding_x', array(
  'default'           => '24',
  'sanitize_callback' => 'absint',
  'transport'         => 'postMessage',
));

// Button padding Y
nylon_add_setting($wp_customize, 'nylon_button_padding_y', array(
  'default'           => '12',
  'sanitize_callback' => 'absint',
  'transport'         => 'postMessage',
));

// Button font size
nylon_add_setting($wp_customize, 'nylon_button_font_size', array(
  'default'           => '16',
  'sanitize_callback' => 'absint',
  'transport'         => 'postMessage',
));

// Button font weight
nylon_add_setting($wp_customize, 'nylon_button_font_weight', array(
  'default'           => '--weight-bold',
  'transport'         => 'postMessage',
  'sanitize_callback' => function($input) {
    $valid = array(
      '--weight-black',
      '--weight-bold',
      '--weight-semibold',
      '--weight-normal',
      '--weight-light',
    );
    return in_array($input, $valid, true) ? $input : '--weight-bold';
  }
));

// Button text transform
nylon_add_setting($wp_customize, 'nylon_button_text_transform', array(
  'default'           => 'none',
  'transport'         => 'postMessage',
  'sanitize_callback' => function($input) {
    $valid = array(
      'none',
      'uppercase',
      'lowercase',
      'capitalize',
    );
    return in_array($input, $valid, true) ? $input : 'none';
  }
));