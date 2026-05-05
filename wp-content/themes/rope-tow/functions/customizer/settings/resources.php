<?php

// Default Resources post featured image
nylon_add_setting($wp_customize, 'nylon_resource_post_image', array(
  'default'           => '',
  'section' => 'nylon_resources_section',
  'sanitize_callback' => 'esc_url_raw',
));

// Resources sidebar text
nylon_add_setting($wp_customize, 'nylon_resource_sidebar_content', array(
  'default'           => 'lorem ipsum here sidebar content',
  'transport'         => 'postMessage',
  'sanitize_callback' => 'sanitize_text_field',
));

// Resources sidebar button text
nylon_add_setting($wp_customize, 'nylon_resource_sidebar_cta_text', array(
  'default'           => 'Get a Demo',
  'transport'         => 'postMessage',
  'sanitize_callback' => 'sanitize_text_field',
));

// Resources sidebar button url
nylon_add_setting($wp_customize, 'nylon_resource_sidebar_cta_url', array(
  'default'           => home_url('/'),
  'sanitize_callback' => 'esc_url_raw',
));

