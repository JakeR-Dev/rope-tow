<?php

// Button border radius slider
$wp_customize->add_control('nylon_button_radius', array(
  'label'       => __( 'Button Border Radius', 'nylon' ),
  'section'     => 'nylon_buttons_section',
  'type'        => 'range',
  'input_attrs' => array(
    'min'  => 0,
    'max'  => 30,
    'step' => 1,
  ),
  'description' => '<span id="button-radius-value"></span>',
));

// Button padding X slider
$wp_customize->add_control('nylon_button_padding_x', array(
  'label'       => __( 'Button Padding X', 'nylon' ),
  'section'     => 'nylon_buttons_section',
  'type'        => 'range',
  'input_attrs' => array(
    'min'  => 4,
    'max'  => 42,
    'step' => 1,
  ),
  'description' => '<span id="button-padding-x-value"></span>',
));

// Button padding Y slider
$wp_customize->add_control('nylon_button_padding_y', array(
  'label'       => __( 'Button Padding Y', 'nylon' ),
  'section'     => 'nylon_buttons_section',
  'type'        => 'range',
  'input_attrs' => array(
    'min'  => 4,
    'max'  => 32,
    'step' => 1,
  ),
  'description' => '<span id="button-padding-y-value"></span>',
));

// Button font size slider
$wp_customize->add_control('nylon_button_font_size', array(
  'label'       => __( 'Button Font Size', 'nylon' ),
  'section'     => 'nylon_buttons_section',
  'type'        => 'range',
  'input_attrs' => array(
    'min'  => 8,
    'max'  => 32,
    'step' => 1,
  ),
  'description' => '<span id="button-font-size-value"></span>',
));

// Button font weight
$wp_customize->add_control('nylon_button_font_weight', array(
  'label'       => __('Button Font Weight', 'nylon'),
  'section'     => 'nylon_buttons_section',
  'type'        => 'select',
  'choices'     => array(
    '--weight-black'    => 'Black',
    '--weight-bold'     => 'Bold',
    '--weight-semibold' => 'Semibold',
    '--weight-normal'   => 'Normal',
    '--weight-light'    => 'Light',
  ),
));

// Button text transform
$wp_customize->add_control('nylon_button_text_transform', array(
  'label'   => __('Button Text Transform', 'nylon'),
  'section' => 'nylon_buttons_section',
  'type'    => 'select',
  'choices' => array(
    'none'       => 'None',
    'uppercase'  => 'Uppercase',
    'lowercase'  => 'Lowercase',
    'capitalize' => 'Capitalize',
  ),
));