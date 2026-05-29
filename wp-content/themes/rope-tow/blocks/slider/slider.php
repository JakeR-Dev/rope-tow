<?php
/**
 * Slider block render template.
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
$slider_style = $attributes['sliderStyle'] ?? 'single';
$items = !empty( $attributes['items'] ) && is_array( $attributes['items'] ) ? $attributes['items'] : array();

// Gather shared attributes using helper functions
$ctas = rope_tow_block_cta_attributes( $attributes );
$basics = rope_tow_block_basics_attributes( $attributes );

// Define block wrapper classes and attributes
$wrapper_attributes = get_block_wrapper_attributes( [
  'class' => 'rt-slider rt-block section pt-' . esc_attr( $basics['padding_top'] ) . ' pb-' . esc_attr( $basics['padding_bottom'] ) . ' mt-' . esc_attr( $basics['margin_top'] ) . ' mb-' . esc_attr( $basics['margin_bottom'] ) . ' bg-' . esc_attr( $basics['background_color'] ) . ' text-' . esc_attr( $basics['text_color'] ),
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
    <!-- Pretitle -->
    <?php if ( $pretitle ) { ?>
      <p class="<?php echo ( $pretitle_tag ); ?> rt-content-grid__pretitle text-center mb-0"><?php echo wp_kses_post( $pretitle ); ?></p>
    <?php } ?>

    <!-- Title -->
    <?php if ( $title ) { ?>
      <<?php echo esc_attr( $title_tag ); ?> class="rt-content-grid__title text-center mb-3 mt-0"><?php echo wp_kses_post( $title ); ?></<?php echo esc_attr( $title_tag ); ?>>
    <?php } ?>

    <!-- Subtitle -->
    <?php if ( $subtitle ) { ?>
      <<?php echo esc_attr( $subtitle_tag ); ?> class="rt-content-grid__subtitle text-center mb-3"><?php echo wp_kses_post( $subtitle ); ?></<?php echo esc_attr( $subtitle_tag ); ?>>
    <?php } ?>

    <!-- Slider -->
    <?php if ( !empty( $items ) ) { ?>
      <div class="rt-slider__slider my-4" data-rt-slider data-rt-slider-style="<?php echo esc_attr( $slider_style ); ?>">
        <div class="rt-slider__embla">
          <div class="rt-slider__embla-container">
            <?php foreach ( $items as $index => $item ) {
              $item_title = $item['title'] ?? '';
              $item_description = $item['description'] ?? '';
              $item_bg_color = sanitize_html_class( $item['backgroundColor'] ?? 'white' );
              $item_text_color = sanitize_html_class( $item['textColor'] ?? 'dark' );
              $item_link_label = $item['linkLabel'] ?? '';
              $item_link_url = $item['linkUrl'] ?? '';
              $item_button_style = sanitize_html_class( $item['buttonStyle'] ?? 'primary' );
              $item_image_id = 0;
              $item_image_url = '';
              if ( !empty( $item['image'] ) && is_array( $item['image'] ) ) {
                $item_image_id = absint( $item['image']['id'] ?? 0 );
                $item_image_url = $item['image']['url'] ?? '';
              }
            ?>
              <article class="rt-slider__embla-slide rt-slider__embla-slide--<?php echo esc_attr( $slider_style ); ?>" data-slide-index="<?php echo esc_attr( $index ); ?>">
                <div class="rt-slider__embla-slide-card bg-<?php echo esc_attr( $item_bg_color ); ?> text-<?php echo esc_attr( $item_text_color ); ?>">
                  <!-- Image -->
                  <?php if ( $item_image_id ) { ?>
                    <?php echo wp_get_attachment_image( $item_image_id, 'large', false, array( 'class' => 'rt-slider__embla-slide-image', 'loading' => 'lazy', 'decoding' => 'async' ) ); ?>
                  <?php } elseif ( $item_image_url ) { ?>
                    <img src="<?php echo esc_url( $item_image_url ); ?>" alt="" class="rt-slider__embla-slide-image" loading="lazy" decoding="async">
                  <?php } ?>
                  <!-- Title -->
                  <?php if ( $item_title ) { ?>
                    <h3 class="rt-slider__embla-slide-title mb-2 mt-0"><?php echo esc_html( $item_title ); ?></h3>
                  <?php } ?>
                  <!-- Description -->
                  <?php if ( $item_description ) { ?>
                    <p class="rt-slider__embla-slide-description mb-3"><?php echo esc_html( $item_description ); ?></p>
                  <?php } ?>
                  <!-- Button -->
                  <?php if ( $item_link_label ) { ?>
                    <a href="<?php echo esc_url( $item_link_url ? $item_link_url : '#' ); ?>" class="btn btn-<?php echo esc_attr( $item_button_style ); ?>">
                      <?php echo esc_html( $item_link_label ); ?>
                    </a>
                  <?php } ?>
                </div>
              </article>
            <?php } ?>
          </div>
        </div>

        <!-- Slider arrows -->
        <div class="rt-slider__controls flex gap-2 mt-3 flex-center">
          <button type="button" class="btn btn-secondary" data-rt-slider-prev aria-label="Previous slide">Prev</button>
          <button type="button" class="btn btn-primary" data-rt-slider-next aria-label="Next slide">Next</button>
        </div>
      </div>
    <?php } ?>

    <!-- CTAs -->
    <?php if ( $ctas['cta1_url'] || $ctas['cta2_url'] ) { ?>
      <div class="rt-slider__ctas flex flex-center gap-3 mt-4">
        <?php if ( $ctas['cta1_url'] ) { ?>
          <a href="<?php echo esc_url( $ctas['cta1_url'] ); ?>" class="rt-slider__cta rt-slider__cta--primary btn btn-<?php echo esc_attr( $ctas['cta1_style'] ); ?>">
            <?php echo esc_html( $ctas['cta1_label'] ); ?>
          </a>
        <?php } ?>
        <?php if ( $ctas['cta2_url'] ) { ?>
          <a href="<?php echo esc_url( $ctas['cta2_url'] ); ?>" class="rt-slider__cta rt-slider__cta--secondary btn btn-<?php echo esc_attr( $ctas['cta2_style'] ); ?>">
            <?php echo esc_html( $ctas['cta2_label'] ); ?>
          </a>
        <?php } ?>
      </div>
    <?php } ?>
  </div>
</div>
