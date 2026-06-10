<?php
/**
 * Contact Form block render template.
 *
 * @package RopeTow
 */

if (!defined('ABSPATH')) {
  exit;
}

// Gather block-specific attributes with defaults
$title = $attributes['title'] ?? '';
$title_tag = rope_tow_block_sanitize_tag( $attributes['titleTag'] ?? 'h1', 'h1' );
$pretitle = $attributes['pretitle'] ?? '';
$pretitle_tag = rope_tow_block_sanitize_tag( $attributes['pretitleTag'] ?? 'h6', 'h6');
$subtitle = $attributes['subtitle'] ?? '';
$subtitle_tag = rope_tow_block_sanitize_tag( $attributes['subtitleTag'] ?? 'p', 'p' );
$layout = $attributes['layout'] ?? 'span-6';
$formType = $attributes['formType'] ?? 'embed';
$formEmbedCode = $attributes['formEmbedCode'] ?? '';
$formShortcode = $attributes['formShortcode'] ?? '';

// Gather shared attributes using helper functions
$ctas = rope_tow_block_cta_attributes( $attributes );
$basics = rope_tow_block_basics_attributes( $attributes );

// Define block wrapper classes and attributes
$wrapper_attributes = get_block_wrapper_attributes( [
  'class' => 'rt-contact-form rt-block section pt-' . esc_attr( $basics['padding_top'] ) . ' pb-' . esc_attr( $basics['padding_bottom'] ) . ' mt-' . esc_attr( $basics['margin_top'] ) . ' mb-' . esc_attr( $basics['margin_bottom'] ) . ' bg-' . esc_attr( $basics['background_color'] ) . ' text-' . esc_attr( $basics['text_color'] ),
] );
?>

<div <?php echo $wrapper_attributes; ?>>
  <!-- Background image -->
  <?php if ( $basics['background_image_id'] ) { ?>
    <div class="rt-block__bg <?php echo esc_attr( $basics['background_attachment_class'] ); ?>" aria-hidden="true">
      <?php echo wp_get_attachment_image( $basics['background_image_id'], 'full', false, [
        'class'   => 'rt-block__bg-img',
        'loading' => 'lazy',
        'decoding' => 'async',
      ] ); ?>
    </div>
  <?php } ?>

  <!-- Content area -->
  <div class="rt-block__content container">
    <div class="rt-block__contact-layout grid gap-3">
      <!-- Content side -->
      <div class="rt-block__contact-side span-12 md:<?php echo ( $layout ); ?>">
        <!-- Pretitle -->
        <?php if ( $pretitle ) { ?>
          <p class="<?php echo ( $pretitle_tag ); ?> rt-contact-form__pretitle mb-2"><?php echo wp_kses_post( $pretitle ); ?></p>
        <?php } ?>
    
        <!-- Title -->
        <?php if ( $title ) { ?>
          <<?php echo esc_attr( $title_tag ); ?> class="rt-contact-form__title mb-3 mt-0"><?php echo wp_kses_post( $title ); ?></<?php echo esc_attr( $title_tag ); ?>>
        <?php } ?>
    
        <!-- Subtitle -->
        <?php if ( $subtitle ) { ?>
          <<?php echo esc_attr( $subtitle_tag ); ?> class="rt-contact-form__subtitle mb-3"><?php echo wp_kses_post( $subtitle ); ?></<?php echo esc_attr( $subtitle_tag ); ?>>
        <?php } ?>
    
        <!-- CTAs -->
        <?php if ( $ctas['cta1_url'] || $ctas['cta2_url'] ) { ?>
          <div class="rt-contact-form__ctas flex gap-3 mt-4">
            <?php if ( $ctas['cta1_url'] ) { ?>
              <a href="<?php echo esc_url( $ctas['cta1_url'] ); ?>" class="rt-contact-form__cta rt-contact-form__cta--primary btn btn-<?php echo esc_attr( $ctas['cta1_style'] ); ?>">
                <?php echo esc_html( $ctas['cta1_label'] ); ?>
              </a>
            <?php } ?>
            <?php if ( $ctas['cta2_url'] ) { ?>
              <a href="<?php echo esc_url( $ctas['cta2_url'] ); ?>" class="rt-contact-form__cta rt-contact-form__cta--secondary btn btn-<?php echo esc_attr( $ctas['cta2_style'] ); ?>">
                <?php echo esc_html( $ctas['cta2_label'] ); ?>
              </a>
            <?php } ?>
          </div>
        <?php } ?>
      </div>

      <!-- Form side -->
      <div class="rt-block__contact-side span-12 md:<?php echo ( $layout ); ?>">
        <?php if ( $formType === 'shortcode' && $formShortcode ) { ?>
          <?php echo do_shortcode( $formShortcode ); ?>
        <?php } elseif ( $formType === 'embed' && $formEmbedCode ) { ?>
          <?php echo $formEmbedCode; ?>
        <?php } ?>
      </div>
    </div>
  </div>
</div>
