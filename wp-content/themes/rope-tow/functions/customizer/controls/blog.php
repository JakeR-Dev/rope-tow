<?php

// Default Blog post featured image
$wp_customize->add_control(new WP_Customize_Image_Control(
  $wp_customize, 'nylon_post_post_image', array(
    'label'    => __('Blog Post Default Featured Image', 'nylon'),
    'section'  => 'nylon_blog_section',
    'settings' => 'nylon_post_post_image',
  )
));