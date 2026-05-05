<?php

// Dark mode toggle
$wp_customize->add_control('nylon_dark_mode', array(
  'label'    => __('Dark Mode', 'nylon'),
  'section'  => 'nylon_colors_section',
  'settings' => 'nylon_dark_mode',
  'type'     => 'radio',
  'choices'  => array(
    'light' => 'Off',
    'dark'  => 'On',
  ),
  'class' => 'customizer-toggle-control',
));

// Primary color picker
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'nylon_primary_color_control', array(
  'label'    => __('Primary Brand Color', 'nylon'),
  'section'  => 'nylon_colors_section',
  'settings' => 'nylon_primary_color',
)));

// Secondary color picker
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'nylon_secondary_color_control', array(
  'label'    => __('Secondary Brand Color', 'nylon'),
  'section'  => 'nylon_colors_section',
  'settings' => 'nylon_secondary_color',
)));

// Tertiary color picker
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'nylon_tertiary_color_control', array(
  'label'    => __('Tertiary Brand Color', 'nylon'),
  'section'  => 'nylon_colors_section',
  'settings' => 'nylon_tertiary_color',
)));

// Tertiary Alt color picker
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'nylon_tertiary_alt_color_control', array(
  'label'    => __('Tertiary Alt Brand Color', 'nylon'),
  'section'  => 'nylon_colors_section',
  'settings' => 'nylon_tertiary_alt_color',
)));

// Brand black color picker
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'nylon_brand_black_control', array(
  'label'    => __('Brand Black', 'nylon'),
  'section'  => 'nylon_colors_section',
  'settings' => 'nylon_brand_black',
)));

// Brand gray color picker
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'nylon_brand_gray_control', array(
  'label'    => __('Brand Gray', 'nylon'),
  'section'  => 'nylon_colors_section',
  'settings' => 'nylon_brand_gray',
)));

// Brand light gray color picker
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'nylon_brand_light_gray_control', array(
  'label'    => __('Brand Light Gray', 'nylon'),
  'section'  => 'nylon_colors_section',
  'settings' => 'nylon_brand_light_gray',
)));

// Brand white color picker
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'nylon_brand_white_control', array(
  'label'    => __('Brand White', 'nylon'),
  'section'  => 'nylon_colors_section',
  'settings' => 'nylon_brand_white',
)));

// Brand error color picker
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'nylon_brand_error_control', array(
  'label'    => __('Brand Error Color', 'nylon'),
  'section'  => 'nylon_colors_section',
  'settings' => 'nylon_brand_error',
)));

// Nav background color picker
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'nylon_nav_color_control', array(
  'label'    => __('Navigation Background Color', 'nylon'),
  'section'  => 'nylon_colors_section',
  'settings' => 'nylon_nav_color',
)));

// Nav font color picker
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'nylon_nav_font_color_control', array(
  'label'    => __('Navigation Font Color', 'nylon'),
  'section'  => 'nylon_colors_section',
  'settings' => 'nylon_nav_font_color',
)));

// Body font color picker
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'nylon_body_color_control', array(
  'label'    => __('Body Text Color', 'nylon'),
  'section'  => 'nylon_colors_section',
  'settings' => 'nylon_body_color',
)));

// Heading font color picker
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'nylon_heading_color_control', array(
  'label'    => __('Heading Text Color', 'nylon'),
  'section'  => 'nylon_colors_section',
  'settings' => 'nylon_heading_color',
)));

// Primary button color picker
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'nylon_primary_button_color_control', array(
  'label'    => __('Primary Button Color', 'nylon'),
  'section'  => 'nylon_colors_section',
  'settings' => 'nylon_primary_button_color',
)));

// Primary button font color picker
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'nylon_primary_button_font_color_control', array(
  'label'    => __('Primary Button Font Color', 'nylon'),
  'section'  => 'nylon_colors_section',
  'settings' => 'nylon_primary_button_font_color',
)));

// Secondary button color picker
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'nylon_secondary_button_color_control', array(
  'label'    => __('Secondary Button Color', 'nylon'),
  'section'  => 'nylon_colors_section',
  'settings' => 'nylon_secondary_button_color',
)));

// Secondary button font color picker
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'nylon_secondary_button_font_color_control', array(
  'label'    => __('Secondary Button Font Color', 'nylon'),
  'section'  => 'nylon_colors_section',
  'settings' => 'nylon_secondary_button_font_color',
)));