<?php
/**
 * Hero block render template.
 *
 * @package RopeTow
 */

if (!defined('ABSPATH')) {
	exit;
}

$attributes = isset($attributes) && is_array($attributes) ? $attributes : [];

$title = isset($attributes['title']) ? (string) $attributes['title'] : '';
$subtitle = isset($attributes['subtitle']) ? (string) $attributes['subtitle'] : '';
$primary_cta = isset($attributes['primaryCta']) && is_array($attributes['primaryCta']) ? $attributes['primaryCta'] : [];
$secondary_cta = isset($attributes['secondaryCta']) && is_array($attributes['secondaryCta']) ? $attributes['secondaryCta'] : [];
$background_image = isset($attributes['backgroundImage']) && is_array($attributes['backgroundImage']) ? $attributes['backgroundImage'] : [];
$background_url = !empty($background_image['url']) ? esc_url($background_image['url']) : '';
$background_alt = !empty($background_image['alt']) ? (string) $background_image['alt'] : '';
?>

<section class="block-hero"<?php echo $background_url ? ' style="background-image:url(' . $background_url . ');"' : ''; ?>>
	<div class="container">
		<div class="block-hero__content">
			<?php if ($title) : ?>
				<h1 class="block-hero__title"><?php echo esc_html($title); ?></h1>
			<?php endif; ?>

			<?php if ($subtitle) : ?>
				<p class="block-hero__subtitle"><?php echo esc_html($subtitle); ?></p>
			<?php endif; ?>

			<div class="block-hero__actions">
				<?php if (!empty($primary_cta['url'])) : ?>
					<a
						class="block-hero__button block-hero__button--primary"
						href="<?php echo esc_url($primary_cta['url']); ?>"
						<?php echo !empty($primary_cta['target']) ? ' target="' . esc_attr($primary_cta['target']) . '" rel="noopener"' : ''; ?>
					>
						<?php echo !empty($primary_cta['text']) ? esc_html($primary_cta['text']) : esc_html__('Primary CTA', 'rope-tow'); ?>
					</a>
				<?php endif; ?>

				<?php if (!empty($secondary_cta['url'])) : ?>
					<a
						class="block-hero__button block-hero__button--secondary"
						href="<?php echo esc_url($secondary_cta['url']); ?>"
						<?php echo !empty($secondary_cta['target']) ? ' target="' . esc_attr($secondary_cta['target']) . '" rel="noopener"' : ''; ?>
					>
						<?php echo !empty($secondary_cta['text']) ? esc_html($secondary_cta['text']) : esc_html__('Secondary CTA', 'rope-tow'); ?>
					</a>
				<?php endif; ?>
			</div>
		</div>
	</div>

	<?php if ($background_url && $background_alt) : ?>
		<span class="screen-reader-text"><?php echo esc_html($background_alt); ?></span>
	<?php endif; ?>
</section>
