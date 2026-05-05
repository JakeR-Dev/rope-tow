<?php

// Default Resources post featured image
$wp_customize->add_control(new WP_Customize_Image_Control(
  $wp_customize, 'nylon_resource_post_image', array(
    'label'    => __('Resource Post Default Featured Image', 'nylon'),
    'section'  => 'nylon_resources_section',
    'settings' => 'nylon_resource_post_image',
  )
));

// Resources sidebar content
$wp_customize->add_control('nylon_resource_sidebar_content', array(
  'label'   => __('Resource Post Sidebar Content', 'nylon'),
  'section' => 'nylon_resources_section',
  'type'    => 'text',
));

// Resources sidebar button text
$wp_customize->add_control('nylon_resource_sidebar_cta_text', array(
  'label'   => __('Resource Post Sidebar Button Text', 'nylon'),
  'section' => 'nylon_resources_section',
  'type'    => 'text',
));

// Resources sidebar button url
$wp_customize->add_control('nylon_resource_sidebar_cta_url', array(
  'label'   => __('Resource Post Sidebar Button Link', 'nylon'),
  'section' => 'nylon_resources_section',
  'type'    => 'url',
));