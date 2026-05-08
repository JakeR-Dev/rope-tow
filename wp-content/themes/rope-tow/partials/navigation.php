<?php
  $nav_toggle = get_theme_mod('rope_tow_nav_hide', rope_tow_get_default('rope_tow_navigation_style'));
  $nav_style = get_theme_mod("rope_tow_navigation_style", rope_tow_get_default("rope_tow_navigation_style"));
  $nav_layout = get_theme_mod('rope_tow_navigation_layout', rope_tow_get_default('rope_tow_navigation_layout'));
  $hamburger_animation = get_theme_mod("rope_tow_hamburger_animation", rope_tow_get_default("rope_tow_hamburger_animation"));
  $nav_cta_enabled = get_theme_mod('rope_tow_nav_cta_enabled', rope_tow_get_default('rope_tow_nav_cta_enabled'));
  $nav_cta_button_title = get_theme_mod('rope_tow_nav_cta_button_title', rope_tow_get_default('rope_tow_nav_cta_button_title'));
  $nav_cta_button_url = get_theme_mod('rope_tow_nav_cta_button_url', rope_tow_get_default('rope_tow_nav_cta_button_url'));
  $nav_cta_button_style = get_theme_mod('rope_tow_nav_cta_button_style', rope_tow_get_default('rope_tow_nav_cta_button_style'));
  $nav_cta_button_size = get_theme_mod('rope_tow_nav_cta_button_size', rope_tow_get_default('rope_tow_nav_cta_button_size'));
  if ($nav_toggle === true) {
    $nav_inline_style = 'display: none;';
  } else {
    $nav_inline_style = 'display: flex;';
  }
  if ($nav_cta_enabled) {
    $nav_cta_toggle_class = 'd-inline-flex show-nav-cta';
  } else {
    $nav_cta_toggle_class = 'hidden hide-nav-cta';
  }
?>

<nav class="navbar" id="navbar" role="navigation" data-style="<?= $nav_style ?>" data-layout="<?= $nav_layout ?>" style="<?= $nav_inline_style ?>">
  <div class="container-fluid navbar-container">
    <!-- site logo -->
    <div class="navbar-brand">
      <a class="menu-item" href="<?php echo home_url(); ?>">
        <?php
        $custom_logo_id = get_theme_mod("custom_logo");
        $custom_logo_url = wp_get_attachment_image_url($custom_logo_id, "full");
        if ($custom_logo_url) {
          echo '<img src="'.esc_url($custom_logo_url).'" alt="'.get_bloginfo("name").' - Header Logo">';
        } else {
          echo '<img src="'.esc_url(get_template_directory_uri() . '/assets/img/logos/rope-tow-lettermark.webp').'" alt="'.get_bloginfo("name").' - Header Logo">';
        }
        ?>
      </a>
    </div>

    <!-- desktop nav -->
    <?php if (has_nav_menu('primary_navigation')) {
      wp_nav_menu([
        "theme_location" => "primary_navigation",
        "container" => "div",
        "container_class" => "navbar-menu hidden lg:flex",
        "menu_class" => "menu-primary",
      ]);
    } ?>
    <div class="inline-flex items-center">
      <!-- hamburger -->
      <button id="menu-toggle" class="hamburger hamburger__<?php echo $hamburger_animation ?> lg:hidden" type="button" aria-label="Toggle menu">
        <span class="line" aria-hidden></span>
        <span class="line" aria-hidden></span>
        <span class="line" aria-hidden></span>
      </button>
      <!-- optional nav cta -->
      <div class="<?= $nav_cta_toggle_class ?> items-center navbar-cta_desktop navbar-cta">
        <?php if ($nav_cta_button_url) { ?>
          <!-- primary button -->
          <?php if ($nav_cta_button_url) { ?>
            <a class="navbar-cta__button <?= ($nav_cta_button_size) ? $nav_cta_button_size : 'btn'; ?> <?= $nav_cta_button_style ?>" href="<?= esc_url($nav_cta_button_url); ?>"><?= esc_html($nav_cta_button_title); ?></a>
          <?php } ?>
        <?php } ?>
      </div>
    </div>
  </div>
</nav>

<!-- mobile nav -->
<div class="navbar-menu-mobile block md:hidden">
  <?php if (has_nav_menu('mobile_navigation')) {
    wp_nav_menu([
      "theme_location" => "mobile_navigation",
      "container" => "div",
      "container_class" => "navbar-menu-mobile_inner",
      "menu_class" => "menu-primary-mobile",
    ]);
  } ?>
  <!-- optional nav cta -->
  <div class="<?= $nav_cta_toggle_class ?> items-center navbar-cta_mobile navbar-cta">
    <?php if ($nav_cta_button_url) { ?>
      <!-- primary button -->
      <?php if ($nav_cta_button_url) { ?>
        <a class="navbar-cta__button <?= ($nav_cta_button_size) ? $nav_cta_button_size : 'btn'; ?> <?= $nav_cta_button_style ?>" href="<?= esc_url($nav_cta_button_url); ?>"><?= esc_html($nav_cta_button_title); ?></a>
      <?php } ?>
    <?php } ?>
  </div>
</div>