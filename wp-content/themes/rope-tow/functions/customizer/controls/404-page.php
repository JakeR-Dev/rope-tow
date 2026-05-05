<?php

// 404 page text color
$wp_customize->add_control('nylon_404_text_style', array(
  'label'   => __('Text Color', 'nylon'),
  'section' => 'nylon_404_section',
  'type'    => 'select',
  'choices' => array(
    'default' => __('Default', 'nylon'),
    'dark'    => __('Dark', 'nylon'),
    'light'   => __('Light', 'nylon'),
  ),
));

// 404 page background image
$wp_customize->add_control(new WP_Customize_Image_Control(
  $wp_customize, 'nylon_404_background_image', array(
    'label'    => __('Background Image', 'nylon'),
    'section'  => 'nylon_404_section',
    'settings' => 'nylon_404_background_image',
  )
));

// 404 page image
$wp_customize->add_control(new WP_Customize_Image_Control(
  $wp_customize, 'nylon_404_top_image', array(
    'label'    => __('Image (above title)', 'nylon'),
    'section'  => 'nylon_404_section',
    'settings' => 'nylon_404_top_image',
  )
));

// 404 page heading text
$wp_customize->add_control('nylon_404_heading_text', array(
  'label'   => __('Page Heading', 'nylon'),
  'section' => 'nylon_404_section',
  'type'    => 'text',
));

// 404 page subtitle text
$wp_customize->add_control('nylon_404_subtitle_text', array(
  'label'   => __('Page Subtitle', 'nylon'),
  'section' => 'nylon_404_section',
  'type'    => 'text',
));

// 404 page button text
$wp_customize->add_control('nylon_404_button_label', array(
  'label'   => __('Button Text', 'nylon'),
  'section' => 'nylon_404_section',
  'type'    => 'text',
));

// 404 page button url
$wp_customize->add_control('nylon_404_button_url', array(
  'label'   => __('Button Link', 'nylon'),
  'section' => 'nylon_404_section',
  'type'    => 'url',
));

// 404 page button style
$wp_customize->add_control('nylon_404_button_style', array(
  'label'   => __('Button Style', 'nylon'),
  'section' => 'nylon_404_section',
  'type'    => 'select',
  'choices' => array(
    'btn-primary'          => __('Primary (Solid)', 'nylon'),
    'btn-primary-outline'  => __('Primary (Outline)', 'nylon'),
    'btn-secondary'        => __('Secondary (Solid)', 'nylon'),
    'btn-secondary-outline'=> __('Secondary (Outline)', 'nylon'),
    'btn-white'            => __('White (Solid)', 'nylon'),
    'btn-white-outline'    => __('White (Outline)', 'nylon'),
  ),
));

// 404 page secondary button text
$wp_customize->add_control('nylon_404_button2_label', array(
  'label'   => __('Second Button Text', 'nylon'),
  'section' => 'nylon_404_section',
  'type'    => 'text',
));

// 404 page secondary button link
$wp_customize->add_control('nylon_404_button2_url', array(
  'label'   => __('Second Button Link', 'nylon'),
  'section' => 'nylon_404_section',
  'type'    => 'url',
));

// 404 page secondary button style
$wp_customize->add_control('nylon_404_button2_style', array(
  'label'   => __('Second Button Style', 'nylon'),
  'section' => 'nylon_404_section',
  'type'    => 'select',
  'choices' => array(
    'btn-primary'          => __('Primary (Solid)', 'nylon'),
    'btn-primary-outline'  => __('Primary (Outline)', 'nylon'),
    'btn-secondary'        => __('Secondary (Solid)', 'nylon'),
    'btn-secondary-outline'=> __('Secondary (Outline)', 'nylon'),
    'btn-white'            => __('White (Solid)', 'nylon'),
    'btn-white-outline'    => __('White (Outline)', 'nylon'),
  ),
));