<?php

// Default Blog post featured image
nylon_add_setting($wp_customize, 'nylon_post_post_image', array(
  'default'           => '',
  'sanitize_callback' => 'esc_url_raw',
));