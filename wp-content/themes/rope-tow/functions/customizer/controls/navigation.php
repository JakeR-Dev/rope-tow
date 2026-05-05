<?php

// Navigation hide toggle
$wp_customize->add_control( new Nylon_Toggle_Control( $wp_customize, 'nylon_nav_hide', array(
  'label'    => __('Hide Navigation', 'nylon'),
  'section'  => 'nylon_navigation_section',
  'settings' => 'nylon_nav_hide',
)));

// Navigation style select
$wp_customize->add_control('nylon_navigation_style', array(
  'label'   => __('Navigation Style', 'nylon'),
  'section' => 'nylon_navigation_section',
  'type'    => 'select',
  'choices' => array(
    'transparent-full-width' => 'Transparent Full-Width',
    'solid-full-width'       => 'Solid Full-Width',
    'solid-rounded'          => 'Solid Rounded',
    'solid-contained'        => 'Solid Contained'
  ),
));

// Navigation layout select
$wp_customize->add_control('nylon_navigation_layout', array(
  'label'   => __('Navigation Layout', 'nylon'),
  'section' => 'nylon_navigation_section',
  'type'    => 'select',
  'choices' => array(
    'spaced-out'  => 'Spaced Out',
    'centered'    => 'Centered'
  ),
));

// Navigation hamburger animation select
$wp_customize->add_control('nylon_hamburger_animation', array(
  'label'   => __('Hamburger Button Animation', 'nylon'),
  'section' => 'nylon_navigation_section',
  'type'    => 'select',
  'choices' => array(
    'criss-cross' => 'Criss-Cross',
    'collapse'    => 'Collapse',
    'circle'      => 'Circle'
  ),
));

// Navigation cta toggle
$wp_customize->add_control( new Nylon_Toggle_Control( $wp_customize, 'nylon_nav_cta_enabled', array(
  'label'    => __('Enable Navigation CTA', 'nylon'),
  'section'  => 'nylon_navigation_section',
  'settings' => 'nylon_nav_cta_enabled',
)));

// Navigation cta button title
$wp_customize->add_control('nylon_nav_cta_button_title', array(
  'label'    => __('Navigation CTA Button Title', 'nylon'),
  'section'  => 'nylon_navigation_section',
  'type'     => 'text',
  'active_callback' => function() {
    return get_theme_mod('nylon_nav_cta_enabled', nylon_get_default('nylon_nav_cta_enabled'));
  },
));

// Navigation cta button url
$wp_customize->add_control('nylon_nav_cta_button_url', array(
  'label'    => __('Navigation CTA Button URL', 'nylon'),
  'section'  => 'nylon_navigation_section',
  'type'     => 'text',
  'active_callback' => function() {
    return get_theme_mod('nylon_nav_cta_enabled', nylon_get_default('nylon_nav_cta_enabled'));
  },
));

// Navigation cta button style
$wp_customize->add_control('nylon_nav_cta_button_style', array(
  'label'   => __('Navigation CTA Button Style', 'nylon'),
  'section' => 'nylon_navigation_section',
  'type'    => 'select',
  'choices' => array(
    'btn-primary'          => __('Primary (Solid)', 'nylon'),
    'btn-primary-outline'  => __('Primary (Outline)', 'nylon'),
    'btn-secondary'        => __('Secondary (Solid)', 'nylon'),
    'btn-secondary-outline'=> __('Secondary (Outline)', 'nylon'),
    'btn-white'            => __('White (Solid)', 'nylon'),
    'btn-white-outline'    => __('White (Outline)', 'nylon'),
  ),
  'active_callback' => function() {
    return get_theme_mod('nylon_nav_cta_enabled', nylon_get_default('nylon_nav_cta_enabled'));
  },
));

// Navigation cta button size
$wp_customize->add_control('nylon_nav_cta_button_size', array(
  'label'   => __('Navigation CTA Button Size', 'nylon'),
  'section' => 'nylon_navigation_section',
  'type'    => 'select',
  'choices' => array(
    'btn btn-sm'  => __('Small', 'nylon'),
    'btn'     => __('Default', 'nylon'),
    'btn btn-lg'  => __('Large', 'nylon'),
  ),
  'active_callback' => function() {
    return get_theme_mod('nylon_nav_cta_enabled', nylon_get_default('nylon_nav_cta_enabled'));
  },
));