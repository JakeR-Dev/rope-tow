<?php

// Default Blog post featured image
rope_tow_add_setting($wp_customize, 'rope_tow_post_post_image', array(
  'default'           => '',
  'sanitize_callback' => 'esc_url_raw',
));