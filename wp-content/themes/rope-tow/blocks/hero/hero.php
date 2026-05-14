<?php
/**
 * Hero block render template.
 *
 * @package RopeTow
 */

if (!defined('ABSPATH')) {
	exit;
}

$title = $attributes['title'] ?? '';
$subtitle = $attributes['subtitle'] ?? '';
$cta1_label = $attributes['cta1Label'] ?? '';
$cta1_url = $attributes['cta1Url'] ?? '';
$cta2_label = $attributes['cta2Label'] ?? '';
$cta2_url = $attributes['cta2Url'] ?? '';
$bg_image = $attributes['backgroundImage'] ?? [];
$bg_id = $bg_image['id'] ?? null;
$p_top = $attributes['paddingTop'] ?? 'medium';
$p_bottom = $attributes['paddingBottom'] ?? 'medium';
$title_tag = strtolower( $attributes['titleTag'] ?? 'h1' );
$subtitle_tag = strtolower( $attributes['subtitleTag'] ?? 'p' );
$textColor = $attributes['textColor'] ?? 'light';
$bg_color = $attributes['backgroundColor'] ?? 'brand-primary';
$bg_attachment = $attributes['backgroundAttachment'] ?? 'scroll';
$bg_attachment_class = $bg_attachment === 'fixed' ? 'bg-attachment-image-fixed' : '';

$allowed_tags = [ 'p', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6' ];
$title_tag = in_array( $title_tag, $allowed_tags, true ) ? $title_tag : 'h1';
$subtitle_tag = in_array( $subtitle_tag, $allowed_tags, true ) ? $subtitle_tag : 'p';

$wrapper_attributes = get_block_wrapper_attributes( [
  'class' => 'rt-hero rt-block section pt-' . esc_attr( $p_top ) . ' pb-' . esc_attr( $p_bottom ) . ' bg-' . esc_attr( $bg_color ) . ' text-' . esc_attr( $textColor ),
] );
?>

<div <?php echo $wrapper_attributes; ?>>
	<!-- background image -->
  <?php if ( $bg_id ) { ?>
    <div class="rt-hero__bg <?php echo esc_attr( $bg_attachment_class ); ?>" aria-hidden="true">
      <?php echo wp_get_attachment_image( $bg_id, 'full', false, [
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
					<<?php echo esc_attr( $title_tag ); ?> class="rt-hero__title"><?php echo wp_kses_post( $title ); ?></<?php echo esc_attr( $title_tag ); ?>>
				<?php } ?>

				<!-- subtitle -->
				<?php if ( $subtitle ) { ?>
					<<?php echo esc_attr( $subtitle_tag ); ?> class="rt-hero__subtitle"><?php echo wp_kses_post( $subtitle ); ?></<?php echo esc_attr( $subtitle_tag ); ?>>
				<?php } ?>

				<!-- ctas -->
				<?php if ( $cta1_url || $cta2_url ) { ?>
					<div class="rt-hero__ctas">
						<?php if ( $cta1_url ) { ?>
							<a href="<?php echo esc_url( $cta1_url ); ?>" class="rt-hero__cta rt-hero__cta--primary btn btn-primary">
								<?php echo esc_html( $cta1_label ); ?>
							</a>
						<?php } ?>
						<?php if ( $cta2_url ) { ?>
							<a href="<?php echo esc_url( $cta2_url ); ?>" class="rt-hero__cta rt-hero__cta--secondary btn btn-secondary">
								<?php echo esc_html( $cta2_label ); ?>
							</a>
						<?php } ?>
					</div>
				<?php } ?>
			</div>
		</div>
  </div>
</div>