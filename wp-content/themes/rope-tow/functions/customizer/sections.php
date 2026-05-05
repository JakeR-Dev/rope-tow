<?php

// Add "theme options" customizer panel
$wp_customize->add_panel('nylon_theme_options', array(
  'title'    => __('Theme Options', 'nylon'),
  'description' => __('Customize the content and appearance of your website.', 'nylon'),
  'priority' => 30,
));