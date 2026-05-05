<?php

// Default Blog post featured image
$wp_customize->add_control(new WP_Customize_Image_Control(
  $wp_customize, 'rope_tow_post_post_image', array(
    'label'    => __('Blog Post Default Featured Image', 'rope-tow'),
    'section'  => 'rope_tow_blog_section',
    'settings' => 'rope_tow_post_post_image',
  )
));