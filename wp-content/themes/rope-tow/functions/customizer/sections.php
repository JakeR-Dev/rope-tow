<?php

// Add "theme options" customizer panel
$wp_customize->add_panel('rope_tow_theme_options', array(
  'title'    => __('Theme Options', 'rope-tow'),
  'description' => __('Customize the content and appearance of your website.', 'rope-tow'),
  'priority' => 30,
));