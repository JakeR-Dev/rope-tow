<?php

// Navigation hide toggle
$wp_customize->add_control( new Rope Tow_Toggle_Control( $wp_customize, 'rope_tow_nav_hide', array(
  'label'    => __('Hide Navigation', 'rope-tow'),
  'section'  => 'rope_tow_navigation_section',
  'settings' => 'rope_tow_nav_hide',
)));

// Navigation style select
$wp_customize->add_control('rope_tow_navigation_style', array(
  'label'   => __('Navigation Style', 'rope-tow'),
  'section' => 'rope_tow_navigation_section',
  'type'    => 'select',
  'choices' => array(
    'transparent-full-width' => 'Transparent Full-Width',
    'solid-full-width'       => 'Solid Full-Width',
    'solid-rounded'          => 'Solid Rounded',
    'solid-contained'        => 'Solid Contained'
  ),
));

// Navigation layout select
$wp_customize->add_control('rope_tow_navigation_layout', array(
  'label'   => __('Navigation Layout', 'rope-tow'),
  'section' => 'rope_tow_navigation_section',
  'type'    => 'select',
  'choices' => array(
    'spaced-out'  => 'Spaced Out',
    'centered'    => 'Centered'
  ),
));

// Navigation hamburger animation select
$wp_customize->add_control('rope_tow_hamburger_animation', array(
  'label'   => __('Hamburger Button Animation', 'rope-tow'),
  'section' => 'rope_tow_navigation_section',
  'type'    => 'select',
  'choices' => array(
    'criss-cross' => 'Criss-Cross',
    'collapse'    => 'Collapse',
    'circle'      => 'Circle'
  ),
));

// Navigation cta toggle
$wp_customize->add_control( new Rope Tow_Toggle_Control( $wp_customize, 'rope_tow_nav_cta_enabled', array(
  'label'    => __('Enable Navigation CTA', 'rope-tow'),
  'section'  => 'rope_tow_navigation_section',
  'settings' => 'rope_tow_nav_cta_enabled',
)));

// Navigation cta button title
$wp_customize->add_control('rope_tow_nav_cta_button_title', array(
  'label'    => __('Navigation CTA Button Title', 'rope-tow'),
  'section'  => 'rope_tow_navigation_section',
  'type'     => 'text',
  'active_callback' => function() {
    return get_theme_mod('rope_tow_nav_cta_enabled', rope_tow_get_default('rope_tow_nav_cta_enabled'));
  },
));

// Navigation cta button url
$wp_customize->add_control('rope_tow_nav_cta_button_url', array(
  'label'    => __('Navigation CTA Button URL', 'rope-tow'),
  'section'  => 'rope_tow_navigation_section',
  'type'     => 'text',
  'active_callback' => function() {
    return get_theme_mod('rope_tow_nav_cta_enabled', rope_tow_get_default('rope_tow_nav_cta_enabled'));
  },
));

// Navigation cta button style
$wp_customize->add_control('rope_tow_nav_cta_button_style', array(
  'label'   => __('Navigation CTA Button Style', 'rope-tow'),
  'section' => 'rope_tow_navigation_section',
  'type'    => 'select',
  'choices' => array(
    'btn-primary'          => __('Primary (Solid)', 'rope-tow'),
    'btn-primary-outline'  => __('Primary (Outline)', 'rope-tow'),
    'btn-secondary'        => __('Secondary (Solid)', 'rope-tow'),
    'btn-secondary-outline'=> __('Secondary (Outline)', 'rope-tow'),
    'btn-white'            => __('White (Solid)', 'rope-tow'),
    'btn-white-outline'    => __('White (Outline)', 'rope-tow'),
  ),
  'active_callback' => function() {
    return get_theme_mod('rope_tow_nav_cta_enabled', rope_tow_get_default('rope_tow_nav_cta_enabled'));
  },
));

// Navigation cta button size
$wp_customize->add_control('rope_tow_nav_cta_button_size', array(
  'label'   => __('Navigation CTA Button Size', 'rope-tow'),
  'section' => 'rope_tow_navigation_section',
  'type'    => 'select',
  'choices' => array(
    'btn btn-sm'  => __('Small', 'rope-tow'),
    'btn'     => __('Default', 'rope-tow'),
    'btn btn-lg'  => __('Large', 'rope-tow'),
  ),
  'active_callback' => function() {
    return get_theme_mod('rope_tow_nav_cta_enabled', rope_tow_get_default('rope_tow_nav_cta_enabled'));
  },
));