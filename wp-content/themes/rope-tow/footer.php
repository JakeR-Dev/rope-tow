<?php
  $footer_copyright_text = get_theme_mod('rope_tow_footer_copyright_text', rope_tow_get_default('rope_tow_footer_copyright_text'));
  $footer_layout = get_theme_mod('rope_tow_footer_layout', rope_tow_get_default('rope_tow_footer_layout'));
  $footer_logo_url = get_theme_mod('rope_tow_footer_logo', rope_tow_get_default('rope_tow_footer_logo'));
  if (!$footer_logo_url) {
    $footer_logo_id = get_theme_mod('custom_logo');
    $footer_logo_url = wp_get_attachment_image_url($footer_logo_id, 'full');
  }
  $footer_background = esc_url(get_theme_mod('rope_tow_footer_background_image', rope_tow_get_default('rope_tow_footer_background_image')));
  $footer_cta_enabled = get_theme_mod('rope_tow_footer_cta_enabled', rope_tow_get_default('rope_tow_footer_cta_enabled'));
  if ($footer_cta_enabled) {
    $footer_cta_toggle_class = 'block';
  } else {
    $footer_cta_toggle_class = 'hidden';
  }
  $footer_cta_layout = get_theme_mod('rope_tow_footer_cta_layout', rope_tow_get_default('rope_tow_footer_cta_layout')) ?? '';
  $footer_cta_title = get_theme_mod('rope_tow_footer_cta_title', rope_tow_get_default('rope_tow_footer_cta_title'));
  $footer_cta_subtitle = get_theme_mod('rope_tow_footer_cta_subtitle', rope_tow_get_default('rope_tow_footer_cta_subtitle'));
  $footer_cta_background = esc_url(get_theme_mod('rope_tow_footer_cta_background_image', rope_tow_get_default('rope_tow_footer_cta_background_image')));
  $footer_cta_button_title = get_theme_mod('rope_tow_footer_cta_button_title', rope_tow_get_default('rope_tow_footer_cta_button_title'));
  $footer_cta_button_url = get_theme_mod('rope_tow_footer_cta_button_url', rope_tow_get_default('rope_tow_footer_cta_button_url'));
  $footer_cta_button_size = get_theme_mod('rope_tow_footer_cta_button_size', rope_tow_get_default('rope_tow_footer_cta_button_size'));
  $footer_cta_button_style = get_theme_mod('rope_tow_footer_cta_button_style', rope_tow_get_default('rope_tow_footer_cta_button_style'));
  $footer_cta_secondary_button_title = get_theme_mod('rope_tow_footer_cta_secondary_button_title', rope_tow_get_default('rope_tow_footer_cta_secondary_button_title'));
  $footer_cta_secondary_button_url = get_theme_mod('rope_tow_footer_cta_secondary_button_url', rope_tow_get_default('rope_tow_footer_cta_secondary_button_url'));
  $footer_cta_secondary_button_size = get_theme_mod('rope_tow_footer_cta_secondary_button_size', rope_tow_get_default('rope_tow_footer_cta_secondary_button_size'));
  $footer_cta_secondary_button_style = get_theme_mod('rope_tow_footer_cta_secondary_button_style', rope_tow_get_default('rope_tow_footer_cta_secondary_button_style'));
?>

    <footer class="global-footer block relative pb-16 footer-<?= esc_attr($footer_layout); ?>" style="background-image:url(<?= $footer_background ?>)">
      <!-- optional footer cta -->
      <section class="global-footer__cta <?= $footer_cta_layout ?> pt-20 pb-20 <?= $footer_cta_toggle_class; ?>" style="background-image:url(<?= $footer_cta_background ?>)">
        <div class="container">
          <div class="row center-xs">
            <div class="col-xs-12 col-sm-10">
              <div class="footer-cta-titles">
                <!-- footer cta title -->
                <?php if ($footer_cta_title) { ?>
                  <h2 class="footer-cta-title mb-4"><?= esc_html($footer_cta_title); ?></h2>
                <?php } ?>
                <!-- footer cta subtitle -->
                <?php if ($footer_cta_subtitle) { ?>
                  <p class="footer-cta-subtitle mb-8"><?= esc_html($footer_cta_subtitle); ?></p>
                <?php } ?>
              </div>
              <div class="footer-cta-buttons">
                <!-- primary button -->
                <?php if ($footer_cta_button_url) { ?>
                  <a class="footer-cta-button <?= ($footer_cta_button_size) ? $footer_cta_button_size : 'btn'; ?> <?= $footer_cta_button_style ?>" href="<?= esc_url($footer_cta_button_url); ?>"><?= esc_html($footer_cta_button_title); ?></a>
                <?php } ?>
                <!-- secondary button -->
                <?php if ($footer_cta_secondary_button_url) { ?>
                  <a class="footer-cta-secondary-button <?= ($footer_cta_secondary_button_size) ? $footer_cta_secondary_button_size : 'btn'; ?> <?= $footer_cta_secondary_button_style ?>" href="<?= esc_url($footer_cta_secondary_button_url); ?>"><?= esc_html($footer_cta_secondary_button_title); ?></a>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- main footer -->
      <div class="container pt-20">
        <div class="row">
          <!-- logo -->
          <div class="col-xs-12 col-sm-2 footer-col footer-col-logo">
            <a class="block pb-8 lg:pb-0 text-center md:text-left footer-logo" href="<?= home_url() ?>">
              <?php if ($footer_logo_url) {
                echo '<img loading="lazy" fetchpriority="low" src="'.esc_url($footer_logo_url).'" alt="'.get_bloginfo("name").' - Footer Logo" />';
              } else {
                echo "<h1>" . get_bloginfo("name") . "</h1>";
              }
              ?>
            </a>
          </div>
          <!-- footer menu -->
          <div class="col-xs-12 col-sm-10 footer-col footer-col-menu">
            <?php if (has_nav_menu('footer_navigation')) {
              wp_nav_menu([
                "theme_location" => "footer_navigation",
                "container" => false,
                "menu_class" => "global-footer__menu"
              ]);
            } ?>
          </div>
          <!-- copyright text -->
          <div class="col-xs-12 col-sm-8 text-center md:text-left mt-12 md:mt-16 footer-col footer-col-legal">
            <?php if (has_nav_menu('legal_navigation')) {
              wp_nav_menu([
                "theme_location" => "legal_navigation",
                "container" => false,
                "menu_class" => "global-footer__legal-menu"
              ]);
            } ?>
            <p class="small" id="footer-copyright-text"><?= ($footer_copyright_text) ? esc_html($footer_copyright_text) : ''; ?></p>
          </div>
          <!-- socials -->
          <div class="col-xs-12 col-sm-4 mt-12 md:mt-16 footer-col footer-col-socials">
            <ul class="footer-social justify-center md:justify-end" data-rope-tow-footer-social>
              <?php rope_tow_render_footer_social_links(); ?>
            </ul>
            <link rel='stylesheet' id='font-awesome-css' href='https://use.fontawesome.com/releases/v6.7.2/css/all.css' type='text/css' media='all' />
          </div>
        </div>
      </div>
    </footer>
    
    <?php wp_footer(); ?>
    <?php print_external_scripts("footer"); ?>
  </body>
</html>