<?php

// 404 page text color
$wp_customize->add_control('rope_tow_404_text_style', array(
  'label'   => __('Text Color', 'rope-tow'),
  'section' => 'rope_tow_404_section',
  'type'    => 'select',
  'choices' => array(
    'default' => __('Default', 'rope-tow'),
    'dark'    => __('Dark', 'rope-tow'),
    'light'   => __('Light', 'rope-tow'),
  ),
));

// 404 page background image
$wp_customize->add_control(new WP_Customize_Image_Control(
  $wp_customize, 'rope_tow_404_background_image', array(
    'label'    => __('Background Image', 'rope-tow'),
    'section'  => 'rope_tow_404_section',
    'settings' => 'rope_tow_404_background_image',
  )
));

// 404 page image
$wp_customize->add_control(new WP_Customize_Image_Control(
  $wp_customize, 'rope_tow_404_top_image', array(
    'label'    => __('Image (above title)', 'rope-tow'),
    'section'  => 'rope_tow_404_section',
    'settings' => 'rope_tow_404_top_image',
  )
));

// 404 page heading text
$wp_customize->add_control('rope_tow_404_heading_text', array(
  'label'   => __('Page Heading', 'rope-tow'),
  'section' => 'rope_tow_404_section',
  'type'    => 'text',
));

// 404 page subtitle text
$wp_customize->add_control('rope_tow_404_subtitle_text', array(
  'label'   => __('Page Subtitle', 'rope-tow'),
  'section' => 'rope_tow_404_section',
  'type'    => 'text',
));

// 404 page button text
$wp_customize->add_control('rope_tow_404_button_label', array(
  'label'   => __('Button Text', 'rope-tow'),
  'section' => 'rope_tow_404_section',
  'type'    => 'text',
));

// 404 page button url
$wp_customize->add_control('rope_tow_404_button_url', array(
  'label'   => __('Button Link', 'rope-tow'),
  'section' => 'rope_tow_404_section',
  'type'    => 'url',
));

// 404 page button style
$wp_customize->add_control('rope_tow_404_button_style', array(
  'label'   => __('Button Style', 'rope-tow'),
  'section' => 'rope_tow_404_section',
  'type'    => 'select',
  'choices' => array(
    'btn-primary'          => __('Primary (Solid)', 'rope-tow'),
    'btn-primary-outline'  => __('Primary (Outline)', 'rope-tow'),
    'btn-secondary'        => __('Secondary (Solid)', 'rope-tow'),
    'btn-secondary-outline'=> __('Secondary (Outline)', 'rope-tow'),
    'btn-white'            => __('White (Solid)', 'rope-tow'),
    'btn-white-outline'    => __('White (Outline)', 'rope-tow'),
  ),
));

// 404 page secondary button text
$wp_customize->add_control('rope_tow_404_button2_label', array(
  'label'   => __('Second Button Text', 'rope-tow'),
  'section' => 'rope_tow_404_section',
  'type'    => 'text',
));

// 404 page secondary button link
$wp_customize->add_control('rope_tow_404_button2_url', array(
  'label'   => __('Second Button Link', 'rope-tow'),
  'section' => 'rope_tow_404_section',
  'type'    => 'url',
));

// 404 page secondary button style
$wp_customize->add_control('rope_tow_404_button2_style', array(
  'label'   => __('Second Button Style', 'rope-tow'),
  'section' => 'rope_tow_404_section',
  'type'    => 'select',
  'choices' => array(
    'btn-primary'          => __('Primary (Solid)', 'rope-tow'),
    'btn-primary-outline'  => __('Primary (Outline)', 'rope-tow'),
    'btn-secondary'        => __('Secondary (Solid)', 'rope-tow'),
    'btn-secondary-outline'=> __('Secondary (Outline)', 'rope-tow'),
    'btn-white'            => __('White (Solid)', 'rope-tow'),
    'btn-white-outline'    => __('White (Outline)', 'rope-tow'),
  ),
));