<?php

// Footer logo
$wp_customize->add_control(new WP_Customize_Image_Control(
  $wp_customize, 'nylon_footer_logo', array(
    'label'    => __('Footer Logo', 'nylon'),
    'section'  => 'nylon_footer_section',
    'settings' => 'nylon_footer_logo',
  )
));

// Footer copyright text
$wp_customize->add_control('nylon_footer_copyright', array(
  'label'    => __('Footer Copyright Text', 'nylon'),
  'section'  => 'nylon_footer_section',
  'settings' => 'nylon_footer_copyright_text',
  'type'     => 'text',
));

// Footer layout
$wp_customize->add_control('nylon_footer_layout_control', array(
  'label'    => __('Footer Layout', 'nylon'),
  'section'  => 'nylon_footer_section',
  'settings' => 'nylon_footer_layout',
  'type'     => 'select',
  'choices'  => array(
    'space-between'  => __('Space Between', 'nylon'),
    'centered'       => __('Centered', 'nylon'),
  ),
));

// Footer background color picker
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'nylon_footer_color_control', array(
  'label'    => __('Footer Background Color', 'nylon'),
  'section'  => 'nylon_footer_section',
  'settings' => 'nylon_footer_color',
)));

// Footer background image
$wp_customize->add_control(new WP_Customize_Image_Control(
  $wp_customize, 'nylon_footer_background_image', array(
    'label'    => __('Footer Background Image', 'nylon'),
    'section'  => 'nylon_footer_section',
    'settings' => 'nylon_footer_background_image',
  )
));

// Footer socials
$wp_customize->add_control(new Nylon_Repeater_Control($wp_customize, 'nylon_footer_social_links', array(
  'label'       => __( 'Footer Social Links', 'nylon' ),
  'description' => sprintf(
    __( 'Add, remove, and reorder social links. Need icons? See the %1$sFont Awesome 6 Brands library%2$s.', 'nylon' ),
    '<a href="' . esc_url( 'https://fontawesome.com/search?ip=brands&ic=brands&o=r' ) . '" target="_blank" rel="noopener noreferrer">',
    '</a>'
  ),
  'section'     => 'nylon_footer_section',
  'settings'    => 'nylon_footer_social_links',
)));

// Footer social link color
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'nylon_footer_social_color', array(
  'label'    => __('Footer Social Link Color', 'nylon'),
  'section'  => 'nylon_footer_section',
  'settings' => 'nylon_footer_social_color',
)));

// Footer cta toggle
$wp_customize->add_control( new Nylon_Toggle_Control( $wp_customize, 'nylon_footer_cta_enabled', array(
  'label'    => __('Enable Footer CTA', 'nylon'),
  'section'  => 'nylon_footer_section',
  'settings' => 'nylon_footer_cta_enabled',
)));

// Footer cta layout
$wp_customize->add_control('nylon_footer_cta_layout', array(
  'label'   => __('Footer CTA Layout', 'nylon'),
  'section' => 'nylon_footer_section',
  'type'    => 'select',
  'choices' => array(
    'layout-stacked'  => __('Default (stacked)', 'nylon'),
    'layout-split'     => __('Split', 'nylon'),
  ),
  'active_callback' => function() {
    return get_theme_mod('nylon_footer_cta_enabled', nylon_get_default('nylon_footer_cta_enabled'));
  },
));

// Footer cta title
$wp_customize->add_control('nylon_footer_cta_title', array(
  'label'    => __('Footer CTA Title', 'nylon'),
  'section'  => 'nylon_footer_section',
  'type'     => 'text',
  'active_callback' => function() {
    return get_theme_mod('nylon_footer_cta_enabled', nylon_get_default('nylon_footer_cta_enabled'));
  },
));

// Footer cta subtitle
$wp_customize->add_control('nylon_footer_cta_subtitle', array(
  'label'    => __('Footer CTA Subtitle', 'nylon'),
  'section'  => 'nylon_footer_section',
  'type'     => 'text',
  'active_callback' => function() {
    return get_theme_mod('nylon_footer_cta_enabled', nylon_get_default('nylon_footer_cta_enabled'));
  },
));

// Footer cta background color
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'nylon_footer_cta_background_color_control', array(
  'label'    => __('Footer CTA Background Color', 'nylon'),
  'section'  => 'nylon_footer_section',
  'settings' => 'nylon_footer_cta_background_color',
  'active_callback' => function() {
    return get_theme_mod('nylon_footer_cta_enabled', nylon_get_default('nylon_footer_cta_enabled'));
  },
)));

// Footer cta background image
$wp_customize->add_control(new WP_Customize_Image_Control(
  $wp_customize, 'nylon_footer_cta_background_image', array(
    'label'    => __('Footer CTA Background Image', 'nylon'),
    'section'  => 'nylon_footer_section',
    'settings' => 'nylon_footer_cta_background_image',
    'active_callback' => function() {
      return get_theme_mod('nylon_footer_cta_enabled', nylon_get_default('nylon_footer_cta_enabled'));
    },
  )
));

// Footer cta button title
$wp_customize->add_control('nylon_footer_cta_button_title', array(
  'label'    => __('Footer CTA Button Title', 'nylon'),
  'section'  => 'nylon_footer_section',
  'type'     => 'text',
  'active_callback' => function() {
    return get_theme_mod('nylon_footer_cta_enabled', nylon_get_default('nylon_footer_cta_enabled'));
  },
));

// Footer cta button url
$wp_customize->add_control('nylon_footer_cta_button_url', array(
  'label'    => __('Footer CTA Button URL', 'nylon'),
  'section'  => 'nylon_footer_section',
  'type'     => 'text',
  'active_callback' => function() {
    return get_theme_mod('nylon_footer_cta_enabled', nylon_get_default('nylon_footer_cta_enabled'));
  },
));

// Footer cta button style
$wp_customize->add_control('nylon_footer_cta_button_style', array(
  'label'   => __('Footer CTA Button Style', 'nylon'),
  'section' => 'nylon_footer_section',
  'type'    => 'select',
  'choices' => array(
    'btn-primary'          => __('Primary (Solid)', 'nylon'),
    'btn-primary-outline'  => __('Primary (Outline)', 'nylon'),
    'btn-secondary'        => __('Secondary (Solid)', 'nylon'),
    'btn-secondary-outline'=> __('Secondary (Outline)', 'nylon'),
    'btn-white'            => __('White (Solid)', 'nylon'),
    'btn-white-outline'    => __('White (Outline)', 'nylon'),
  ),
  'active_callback' => function() {
    return get_theme_mod('nylon_footer_cta_enabled', nylon_get_default('nylon_footer_cta_enabled'));
  },
));

// Footer cta button size
$wp_customize->add_control('nylon_footer_cta_button_size', array(
  'label'   => __('Footer CTA Button Size', 'nylon'),
  'section' => 'nylon_footer_section',
  'type'    => 'select',
  'choices' => array(
    'btn btn-sm'  => __('Small', 'nylon'),
    'btn'     => __('Default', 'nylon'),
    'btn btn-lg'  => __('Large', 'nylon'),
  ),
  'active_callback' => function() {
    return get_theme_mod('nylon_footer_cta_enabled', nylon_get_default('nylon_footer_cta_enabled'));
  },
));

// Footer cta button 2 title
$wp_customize->add_control('nylon_footer_cta_secondary_button_title', array(
  'label'    => __('Footer CTA Secondary Button Title', 'nylon'),
  'section'  => 'nylon_footer_section',
  'type'     => 'text',
  'active_callback' => function() {
    return get_theme_mod('nylon_footer_cta_enabled', nylon_get_default('nylon_footer_cta_enabled'));
  },
));

// Footer cta button 2 url
$wp_customize->add_control('nylon_footer_cta_secondary_button_url', array(
  'label'    => __('Footer CTA Secondary Button URL', 'nylon'),
  'section'  => 'nylon_footer_section',
  'type'     => 'text',
  'active_callback' => function() {
    return get_theme_mod('nylon_footer_cta_enabled', nylon_get_default('nylon_footer_cta_enabled'));
  },
));

// Footer cta button 2 style
$wp_customize->add_control('nylon_footer_cta_secondary_button_style', array(
  'label'   => __('Footer CTA Secondary Button Style', 'nylon'),
  'section' => 'nylon_footer_section',
  'type'    => 'select',
  'choices' => array(
    'btn-primary'          => __('Primary (Solid)', 'nylon'),
    'btn-primary-outline'  => __('Primary (Outline)', 'nylon'),
    'btn-secondary'        => __('Secondary (Solid)', 'nylon'),
    'btn-secondary-outline'=> __('Secondary (Outline)', 'nylon'),
    'btn-white'            => __('White (Solid)', 'nylon'),
    'btn-white-outline'    => __('White (Outline)', 'nylon'),
  ),
  'active_callback' => function() {
    return get_theme_mod('nylon_footer_cta_enabled', nylon_get_default('nylon_footer_cta_enabled'));
  },
));

// Footer cta button 2 size
$wp_customize->add_control('nylon_footer_cta_secondary_button_size', array(
  'label'   => __('Footer CTA Secondary Button Size', 'nylon'),
  'section' => 'nylon_footer_section',
  'type'    => 'select',
  'choices' => array(
    'btn btn-sm'  => __('Small', 'nylon'),
    'btn'     => __('Default', 'nylon'),
    'btn btn-lg'  => __('Large', 'nylon'),
  ),
  'active_callback' => function() {
    return get_theme_mod('nylon_footer_cta_enabled', nylon_get_default('nylon_footer_cta_enabled'));
  },
));