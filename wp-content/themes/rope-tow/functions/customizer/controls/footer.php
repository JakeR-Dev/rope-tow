<?php

// Footer logo
$wp_customize->add_control(new WP_Customize_Image_Control(
  $wp_customize, 'rope_tow_footer_logo', array(
    'label'    => __('Footer Logo', 'rope-tow'),
    'section'  => 'rope_tow_footer_section',
    'settings' => 'rope_tow_footer_logo',
  )
));

// Footer copyright text
$wp_customize->add_control('rope_tow_footer_copyright', array(
  'label'    => __('Footer Copyright Text', 'rope-tow'),
  'section'  => 'rope_tow_footer_section',
  'settings' => 'rope_tow_footer_copyright_text',
  'type'     => 'text',
));

// Footer layout
$wp_customize->add_control('rope_tow_footer_layout_control', array(
  'label'    => __('Footer Layout', 'rope-tow'),
  'section'  => 'rope_tow_footer_section',
  'settings' => 'rope_tow_footer_layout',
  'type'     => 'select',
  'choices'  => array(
    'space-between'  => __('Space Between', 'rope-tow'),
    'centered'       => __('Centered', 'rope-tow'),
  ),
));

// Footer background color picker
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'rope_tow_footer_color_control', array(
  'label'    => __('Footer Background Color', 'rope-tow'),
  'section'  => 'rope_tow_footer_section',
  'settings' => 'rope_tow_footer_color',
)));

// Footer background image
$wp_customize->add_control(new WP_Customize_Image_Control(
  $wp_customize, 'rope_tow_footer_background_image', array(
    'label'    => __('Footer Background Image', 'rope-tow'),
    'section'  => 'rope_tow_footer_section',
    'settings' => 'rope_tow_footer_background_image',
  )
));

// Footer socials
$wp_customize->add_control(new Rope Tow_Repeater_Control($wp_customize, 'rope_tow_footer_social_links', array(
  'label'       => __( 'Footer Social Links', 'rope-tow' ),
  'description' => sprintf(
    __( 'Add, remove, and reorder social links. Need icons? See the %1$sFont Awesome 6 Brands library%2$s.', 'rope-tow' ),
    '<a href="' . esc_url( 'https://fontawesome.com/search?ip=brands&ic=brands&o=r' ) . '" target="_blank" rel="noopener noreferrer">',
    '</a>'
  ),
  'section'     => 'rope_tow_footer_section',
  'settings'    => 'rope_tow_footer_social_links',
)));

// Footer social link color
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'rope_tow_footer_social_color', array(
  'label'    => __('Footer Social Link Color', 'rope-tow'),
  'section'  => 'rope_tow_footer_section',
  'settings' => 'rope_tow_footer_social_color',
)));

// Footer cta toggle
$wp_customize->add_control( new Rope Tow_Toggle_Control( $wp_customize, 'rope_tow_footer_cta_enabled', array(
  'label'    => __('Enable Footer CTA', 'rope-tow'),
  'section'  => 'rope_tow_footer_section',
  'settings' => 'rope_tow_footer_cta_enabled',
)));

// Footer cta layout
$wp_customize->add_control('rope_tow_footer_cta_layout', array(
  'label'   => __('Footer CTA Layout', 'rope-tow'),
  'section' => 'rope_tow_footer_section',
  'type'    => 'select',
  'choices' => array(
    'layout-stacked'  => __('Default (stacked)', 'rope-tow'),
    'layout-split'     => __('Split', 'rope-tow'),
  ),
  'active_callback' => function() {
    return get_theme_mod('rope_tow_footer_cta_enabled', rope_tow_get_default('rope_tow_footer_cta_enabled'));
  },
));

// Footer cta title
$wp_customize->add_control('rope_tow_footer_cta_title', array(
  'label'    => __('Footer CTA Title', 'rope-tow'),
  'section'  => 'rope_tow_footer_section',
  'type'     => 'text',
  'active_callback' => function() {
    return get_theme_mod('rope_tow_footer_cta_enabled', rope_tow_get_default('rope_tow_footer_cta_enabled'));
  },
));

// Footer cta subtitle
$wp_customize->add_control('rope_tow_footer_cta_subtitle', array(
  'label'    => __('Footer CTA Subtitle', 'rope-tow'),
  'section'  => 'rope_tow_footer_section',
  'type'     => 'text',
  'active_callback' => function() {
    return get_theme_mod('rope_tow_footer_cta_enabled', rope_tow_get_default('rope_tow_footer_cta_enabled'));
  },
));

// Footer cta background color
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'rope_tow_footer_cta_background_color_control', array(
  'label'    => __('Footer CTA Background Color', 'rope-tow'),
  'section'  => 'rope_tow_footer_section',
  'settings' => 'rope_tow_footer_cta_background_color',
  'active_callback' => function() {
    return get_theme_mod('rope_tow_footer_cta_enabled', rope_tow_get_default('rope_tow_footer_cta_enabled'));
  },
)));

// Footer cta background image
$wp_customize->add_control(new WP_Customize_Image_Control(
  $wp_customize, 'rope_tow_footer_cta_background_image', array(
    'label'    => __('Footer CTA Background Image', 'rope-tow'),
    'section'  => 'rope_tow_footer_section',
    'settings' => 'rope_tow_footer_cta_background_image',
    'active_callback' => function() {
      return get_theme_mod('rope_tow_footer_cta_enabled', rope_tow_get_default('rope_tow_footer_cta_enabled'));
    },
  )
));

// Footer cta button title
$wp_customize->add_control('rope_tow_footer_cta_button_title', array(
  'label'    => __('Footer CTA Button Title', 'rope-tow'),
  'section'  => 'rope_tow_footer_section',
  'type'     => 'text',
  'active_callback' => function() {
    return get_theme_mod('rope_tow_footer_cta_enabled', rope_tow_get_default('rope_tow_footer_cta_enabled'));
  },
));

// Footer cta button url
$wp_customize->add_control('rope_tow_footer_cta_button_url', array(
  'label'    => __('Footer CTA Button URL', 'rope-tow'),
  'section'  => 'rope_tow_footer_section',
  'type'     => 'text',
  'active_callback' => function() {
    return get_theme_mod('rope_tow_footer_cta_enabled', rope_tow_get_default('rope_tow_footer_cta_enabled'));
  },
));

// Footer cta button style
$wp_customize->add_control('rope_tow_footer_cta_button_style', array(
  'label'   => __('Footer CTA Button Style', 'rope-tow'),
  'section' => 'rope_tow_footer_section',
  'type'    => 'select',
  'choices' => array(
    'btn-primary'          => __('Primary (Solid)', 'rope-tow'),
    'btn-primary-outline'  => __('Primary (Outline)', 'rope-tow'),
    'btn-secondary'        => __('Secondary (Solid)', 'rope-tow'),
    'btn-secondary-outline'=> __('Secondary (Outline)', 'rope-tow'),
    'btn-white'            => __('White (Solid)', 'rope-tow'),
    'btn-white-outline'    => __('White (Outline)', 'rope-tow'),
  ),
  'active_callback' => function() {
    return get_theme_mod('rope_tow_footer_cta_enabled', rope_tow_get_default('rope_tow_footer_cta_enabled'));
  },
));

// Footer cta button size
$wp_customize->add_control('rope_tow_footer_cta_button_size', array(
  'label'   => __('Footer CTA Button Size', 'rope-tow'),
  'section' => 'rope_tow_footer_section',
  'type'    => 'select',
  'choices' => array(
    'btn btn-sm'  => __('Small', 'rope-tow'),
    'btn'     => __('Default', 'rope-tow'),
    'btn btn-lg'  => __('Large', 'rope-tow'),
  ),
  'active_callback' => function() {
    return get_theme_mod('rope_tow_footer_cta_enabled', rope_tow_get_default('rope_tow_footer_cta_enabled'));
  },
));

// Footer cta button 2 title
$wp_customize->add_control('rope_tow_footer_cta_secondary_button_title', array(
  'label'    => __('Footer CTA Secondary Button Title', 'rope-tow'),
  'section'  => 'rope_tow_footer_section',
  'type'     => 'text',
  'active_callback' => function() {
    return get_theme_mod('rope_tow_footer_cta_enabled', rope_tow_get_default('rope_tow_footer_cta_enabled'));
  },
));

// Footer cta button 2 url
$wp_customize->add_control('rope_tow_footer_cta_secondary_button_url', array(
  'label'    => __('Footer CTA Secondary Button URL', 'rope-tow'),
  'section'  => 'rope_tow_footer_section',
  'type'     => 'text',
  'active_callback' => function() {
    return get_theme_mod('rope_tow_footer_cta_enabled', rope_tow_get_default('rope_tow_footer_cta_enabled'));
  },
));

// Footer cta button 2 style
$wp_customize->add_control('rope_tow_footer_cta_secondary_button_style', array(
  'label'   => __('Footer CTA Secondary Button Style', 'rope-tow'),
  'section' => 'rope_tow_footer_section',
  'type'    => 'select',
  'choices' => array(
    'btn-primary'          => __('Primary (Solid)', 'rope-tow'),
    'btn-primary-outline'  => __('Primary (Outline)', 'rope-tow'),
    'btn-secondary'        => __('Secondary (Solid)', 'rope-tow'),
    'btn-secondary-outline'=> __('Secondary (Outline)', 'rope-tow'),
    'btn-white'            => __('White (Solid)', 'rope-tow'),
    'btn-white-outline'    => __('White (Outline)', 'rope-tow'),
  ),
  'active_callback' => function() {
    return get_theme_mod('rope_tow_footer_cta_enabled', rope_tow_get_default('rope_tow_footer_cta_enabled'));
  },
));

// Footer cta button 2 size
$wp_customize->add_control('rope_tow_footer_cta_secondary_button_size', array(
  'label'   => __('Footer CTA Secondary Button Size', 'rope-tow'),
  'section' => 'rope_tow_footer_section',
  'type'    => 'select',
  'choices' => array(
    'btn btn-sm'  => __('Small', 'rope-tow'),
    'btn'     => __('Default', 'rope-tow'),
    'btn btn-lg'  => __('Large', 'rope-tow'),
  ),
  'active_callback' => function() {
    return get_theme_mod('rope_tow_footer_cta_enabled', rope_tow_get_default('rope_tow_footer_cta_enabled'));
  },
));