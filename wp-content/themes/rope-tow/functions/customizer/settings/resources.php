<?php

// Default Resources post featured image
rope_tow_add_setting($wp_customize, 'rope_tow_resource_post_image', array(
  'default'           => '',
  'section' => 'rope_tow_resources_section',
  'sanitize_callback' => 'esc_url_raw',
));

// Resources sidebar text
rope_tow_add_setting($wp_customize, 'rope_tow_resource_sidebar_content', array(
  'default'           => 'lorem ipsum here sidebar content',
  'transport'         => 'postMessage',
  'sanitize_callback' => 'sanitize_text_field',
));

// Resources sidebar button text
rope_tow_add_setting($wp_customize, 'rope_tow_resource_sidebar_cta_text', array(
  'default'           => 'Get a Demo',
  'transport'         => 'postMessage',
  'sanitize_callback' => 'sanitize_text_field',
));

// Resources sidebar button url
rope_tow_add_setting($wp_customize, 'rope_tow_resource_sidebar_cta_url', array(
  'default'           => home_url('/'),
  'sanitize_callback' => 'esc_url_raw',
));

