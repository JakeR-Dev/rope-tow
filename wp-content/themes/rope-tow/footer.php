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

    <footer class="global-footer footer-<?= esc_attr($footer_layout); ?> pb-6" style="background-image:url(<?= $footer_background ?>)">
      
      <!-- optional footer cta -->
      <section class="global-footer__cta pt-6 pb-6 <?= $footer_cta_layout ?> <?= $footer_cta_toggle_class; ?>" style="background-image:url(<?= $footer_cta_background ?>)">
        <div class="container">
          <div class="global-footer__cta-inner">
            <div class="footer-cta-titles <?= ($footer_cta_layout === 'layout-stacked') ? 'text-center' : ''; ?>">
              <!-- footer cta title -->
              <?php if ($footer_cta_title) { ?>
                <h2 class="footer-cta-title mb-2"><?= esc_html($footer_cta_title); ?></h2>
              <?php } ?>
              <!-- footer cta subtitle -->
              <?php if ($footer_cta_subtitle) { ?>
                <p class="footer-cta-subtitle"><?= esc_html($footer_cta_subtitle); ?></p>
              <?php } ?>
            </div>
            <?php if ($footer_cta_button_url || $footer_cta_secondary_button_url) { ?>
              <div class="footer-cta-buttons flex flex-center gap-3">
                <!-- primary button -->
                <?php if ($footer_cta_button_url) { ?>
                  <a class="footer-cta-button <?= ($footer_cta_button_size) ? $footer_cta_button_size : 'btn'; ?> <?= $footer_cta_button_style ?>" href="<?= esc_url($footer_cta_button_url); ?>"><?= esc_html($footer_cta_button_title); ?></a>
                <?php } ?>
                <!-- secondary button -->
                <?php if ($footer_cta_secondary_button_url) { ?>
                  <a class="footer-cta-secondary-button <?= ($footer_cta_secondary_button_size) ? $footer_cta_secondary_button_size : 'btn'; ?> <?= $footer_cta_secondary_button_style ?>" href="<?= esc_url($footer_cta_secondary_button_url); ?>"><?= esc_html($footer_cta_secondary_button_title); ?></a>
                <?php } ?>
              </div>
            <?php } ?>
          </div>
        </div>
      </section>

      <!-- main footer -->
      <div class="container pt-6">
        <div class="grid items-center">
          <!-- logo -->
          <div class="footer-col footer-col_logo span-12 text-center <?= ($footer_layout === 'space-between') ? 'md:span-3 lg:span-2 md:text-left pb-4 lg:pb-0' : ''; ?>">
            <a class="footer-logo block" href="<?= home_url() ?>">
              <?php if ($footer_logo_url) {
                echo '<img loading="lazy" fetchpriority="low" src="'.esc_url($footer_logo_url).'" alt="'.get_bloginfo("name").' - Footer Logo" />';
              } else {
                echo '<img src="'.esc_url(get_template_directory_uri() . '/assets/img/logos/rope-tow-logo-horiz.webp').'" alt="'.get_bloginfo("name").' - Header Logo">';
              }
              ?>
            </a>
          </div>

          <!-- footer menu -->
          <div class="footer-col footer-col_menu span-12 <?= ($footer_layout === 'space-between') ? 'md:span-9 lg:span-10' : ''; ?>">
            <?php if (has_nav_menu('footer_navigation')) {
              wp_nav_menu([
                "theme_location" => "footer_navigation",
                "container" => false,
                "menu_class" => "global-footer__menu",
                "depth" => 1
              ]);
            } ?>
          </div>

          <!-- copyright text -->
          <div class="footer-col footer-col_legal mt-2 md:mt-4 text-center span-12 <?= ($footer_layout === 'space-between') ? 'md:span-8 md:text-left' : ''; ?>">
            <?php if (has_nav_menu('legal_navigation')) {
              wp_nav_menu([
                "theme_location" => "legal_navigation",
                "container" => false,
                "menu_class" => "global-footer__legal-menu",
                "depth" => 1
              ]);
            } ?>
            <p class="small" id="footer-copyright-text"><?= ($footer_copyright_text) ? esc_html($footer_copyright_text) : ''; ?></p>
          </div>

          <!-- socials -->
          <div class="footer-col footer-col_socials mt-2 md:mt-4 span-12 <?= ($footer_layout === 'space-between') ? 'md:span-4' : ''; ?>">
            <ul class="footer-social_socials__list text-center <?= ($footer_layout === 'space-between') ? 'md:text-right' : ''; ?>" data-rope-tow-footer-social>
              <?php rope_tow_render_footer_social_links(); ?>
            </ul>
          </div>
        </div>
      </div>
    </footer>
    
    <?php wp_footer(); ?>
    <?php print_external_scripts("footer"); ?>
  </body>
</html>