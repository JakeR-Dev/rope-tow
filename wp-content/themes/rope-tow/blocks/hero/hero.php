<?php
/**
 * Hero block render template.
 *
 * @package RopeTow
 */

if (!defined('ABSPATH')) {
	exit;
}

// Gather block-specific attributes with defaults
$title = $attributes['title'] ?? '';
$title_tag = rope_tow_block_sanitize_tag( $attributes['titleTag'] ?? 'h1', 'h1' );
$subtitle = $attributes['subtitle'] ?? '';
$subtitle_tag = rope_tow_block_sanitize_tag( $attributes['subtitleTag'] ?? 'p', 'p' );

// Gather shared attributes using helper functions
$ctas = rope_tow_block_cta_attributes( $attributes );
$basics = rope_tow_block_basics_attributes( $attributes );

// Define block wrapper classes and attributes
$wrapper_attributes = get_block_wrapper_attributes( [
	'class' => 'rt-hero rt-block section pt-' . esc_attr( $basics['padding_top'] ) . ' pb-' . esc_attr( $basics['padding_bottom'] ) . ' mt-' . esc_attr( $basics['margin_top'] ) . ' mb-' . esc_attr( $basics['margin_bottom'] ) . ' bg-' . esc_attr( $basics['background_color'] ) . ' text-' . esc_attr( $basics['text_color'] ),
] );
?>

<div <?php echo $wrapper_attributes; ?>>
	<!-- background image -->
	<?php if ( $basics['background_image_id'] ) { ?>
		<div class="rt-hero__bg <?php echo esc_attr( $basics['background_attachment_class'] ); ?>" aria-hidden="true">
			<?php echo wp_get_attachment_image( $basics['background_image_id'], 'full', false, [
        'class'   => 'rt-hero__bg-img',
        'loading' => 'eager',
        'decoding' => 'async',
      ] ); ?>
    </div>
  <?php } ?>

  <div class="rt-hero__content container">
		<div class="flex">
			<div class="flex-12 md:flex-10 xl:flex-8 mx-auto text-center">
				<!-- title -->
				<?php if ( $title ) { ?>
					<<?php echo esc_attr( $title_tag ); ?> class="rt-hero__title mb-3 mt-0"><?php echo wp_kses_post( $title ); ?></<?php echo esc_attr( $title_tag ); ?>>
				<?php } ?>

				<!-- subtitle -->
				<?php if ( $subtitle ) { ?>
					<<?php echo esc_attr( $subtitle_tag ); ?> class="rt-hero__subtitle mb-3"><?php echo wp_kses_post( $subtitle ); ?></<?php echo esc_attr( $subtitle_tag ); ?>>
				<?php } ?>

				<!-- ctas -->
				<?php if ( $ctas['cta1_url'] || $ctas['cta2_url'] ) { ?>
					<div class="rt-hero__ctas flex flex-center gap-3 my-4">
						<?php if ( $ctas['cta1_url'] ) { ?>
							<a href="<?php echo esc_url( $ctas['cta1_url'] ); ?>" class="rt-hero__cta rt-hero__cta--primary btn btn-<?php echo esc_attr( $ctas['cta1_style'] ); ?>">
								<?php echo esc_html( $ctas['cta1_label'] ); ?>
							</a>
						<?php } ?>
						<?php if ( $ctas['cta2_url'] ) { ?>
							<a href="<?php echo esc_url( $ctas['cta2_url'] ); ?>" class="rt-hero__cta rt-hero__cta--secondary btn btn-<?php echo esc_attr( $ctas['cta2_style'] ); ?>">
								<?php echo esc_html( $ctas['cta2_label'] ); ?>
							</a>
						<?php } ?>
					</div>
				<?php } ?>
			</div>
		</div>
  </div>
</div>