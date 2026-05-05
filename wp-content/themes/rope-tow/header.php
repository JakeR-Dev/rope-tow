<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" href="<?php echo get_site_favicon(); ?>">
  <?php
  print_external_scripts("header");
  wp_head();
  ?>
</head>

<body <?php body_class(get_theme_mod('nylon_dark_mode', nylon_get_default('nylon_dark_mode')) . '-mode'); ?>>
  <?php print_external_scripts("body"); ?>
  <?php get_template_part("partials/global", "navigation"); ?>