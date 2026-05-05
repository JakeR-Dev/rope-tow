<?php

// Default Resources post featured image
$wp_customize->add_control(new WP_Customize_Image_Control(
  $wp_customize, 'rope_tow_resource_post_image', array(
    'label'    => __('Resource Post Default Featured Image', 'rope-tow'),
    'section'  => 'rope_tow_resources_section',
    'settings' => 'rope_tow_resource_post_image',
  )
));

// Resources sidebar content
$wp_customize->add_control('rope_tow_resource_sidebar_content', array(
  'label'   => __('Resource Post Sidebar Content', 'rope-tow'),
  'section' => 'rope_tow_resources_section',
  'type'    => 'text',
));

// Resources sidebar button text
$wp_customize->add_control('rope_tow_resource_sidebar_cta_text', array(
  'label'   => __('Resource Post Sidebar Button Text', 'rope-tow'),
  'section' => 'rope_tow_resources_section',
  'type'    => 'text',
));

// Resources sidebar button url
$wp_customize->add_control('rope_tow_resource_sidebar_cta_url', array(
  'label'   => __('Resource Post Sidebar Button Link', 'rope-tow'),
  'section' => 'rope_tow_resources_section',
  'type'    => 'url',
));