<?php
/**
 * Side-By-Side block render template.
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
$pretitle_tag = rope_tow_block_sanitize_tag( $attributes['pretitleTag'] ?? 'h6', 'h6' );
$subtitle = $attributes['subtitle'] ?? '';
$subtitle_tag = rope_tow_block_sanitize_tag( $attributes['subtitleTag'] ?? 'p', 'p' );
$image = $attributes['image'] ?? [];
$image_id = is_array($image) ? $image['id'] : '';
$vert_align = $attributes['verticalAlignment'] ?? 'center';

// Gather shared attributes using helper functions
$ctas = rope_tow_block_cta_attributes( $attributes );
$basics = rope_tow_block_basics_attributes( $attributes );

// Define block wrapper classes and attributes
$wrapper_attributes = get_block_wrapper_attributes( [
	'class' => 'rt-side-by-side rt-block section pt-' . esc_attr( $basics['padding_top'] ) . ' pb-' . esc_attr( $basics['padding_bottom'] ) . ' mt-' . esc_attr( $basics['margin_top'] ) . ' mb-' . esc_attr( $basics['margin_bottom'] ) . ' bg-' . esc_attr( $basics['background_color'] ) . ' text-' . esc_attr( $basics['text_color'] ),
] );
?>

<div <?php echo $wrapper_attributes; ?>>
	<!-- background image -->
	<?php if ( $basics['background_image_id'] ) { ?>
		<div class="rt-block__bg <?php echo esc_attr( $basics['background_attachment_class'] ); ?>" aria-hidden="true">
			<?php echo wp_get_attachment_image( $basics['background_image_id'], 'full', false, [
        'class'   => 'rt-block__bg-img',
        'loading' => 'lazy',
        'decoding' => 'async',
      ] ); ?>
    </div>
  <?php } ?>

  <div class="rt-block__content container">
		<div class="flex align-<?php echo $vert_align; ?>">
			<!-- Content side -->
			<div class="flex-12 md:flex-6">
				<!-- Pretitle -->
				<?php if ( $pretitle ) { ?>
					<p class="<?php echo $pretitle_tag; ?> rt-side-by-side__pretitle mb-2"><?php echo wp_kses_post( $pretitle ); ?></p>
				<?php } ?>

				<!-- Title -->
				<?php if ( $title ) { ?>
					<<?php echo esc_attr( $title_tag ); ?> class="rt-side-by-side__title mt-0 mb-3"><?php echo wp_kses_post( $title ); ?></<?php echo esc_attr( $title_tag ); ?>>
				<?php } ?>

				<!-- Subtitle -->
				<?php if ( $subtitle ) { ?>
					<<?php echo esc_attr( $subtitle_tag ); ?> class="rt-side-by-side__subtitle mb-4"><?php echo wp_kses_post( $subtitle ); ?></<?php echo esc_attr( $subtitle_tag ); ?>>
				<?php } ?>

				<!-- CTAs -->
				<?php if ( $ctas['cta1_url'] || $ctas['cta2_url'] ) { ?>
					<div class="rt-side-by-side__ctas flex gap-3 my-4">
						<?php if ( $ctas['cta1_url'] ) { ?>
							<a href="<?php echo esc_url( $ctas['cta1_url'] ); ?>" class="rt-side-by-side__cta rt-side-by-side__cta--primary btn btn-<?php echo esc_attr( $ctas['cta1_style'] ); ?>">
								<?php echo esc_html( $ctas['cta1_label'] ); ?>
							</a>
						<?php } ?>
						<?php if ( $ctas['cta2_url'] ) { ?>
							<a href="<?php echo esc_url( $ctas['cta2_url'] ); ?>" class="rt-side-by-side__cta rt-side-by-side__cta--secondary btn btn-<?php echo esc_attr( $ctas['cta2_style'] ); ?>">
								<?php echo esc_html( $ctas['cta2_label'] ); ?>
							</a>
						<?php } ?>
					</div>
				<?php } ?>
			</div>

			<!-- Image side -->
			<div class="flex-12 md:flex-6">
				<?php if ($image_id) { ?>
					<div class="rt-side-by-side__img-wrapper">
						<?php echo wp_get_attachment_image( $image_id, 'full', false, [
							'class'   => 'rt-side-by-side__img',
							'loading' => 'lazy',
							'decoding' => 'async',
						] ); ?>
					</div>
				<?php } ?>
			</div>
		</div>
  </div>
</div>