<?php
/**
 * Content Grid block render template.
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
$items = $attributes['items'] ?? [];
$grid_columns = $attributes['gridColumns'] ?? 'span-4';
$grid_item_border_radius = $attributes['gridItemBorderRadius'] ?? 8;
// Standardize grid $items as an array
if ( ! is_array( $items ) ) {
	$items = [];
}

// Gather shared attributes using helper functions
$ctas = rope_tow_block_cta_attributes( $attributes );
$basics = rope_tow_block_basics_attributes( $attributes );

// Define block wrapper classes and attributes
$wrapper_attributes = get_block_wrapper_attributes( [
	'class' => 'rt-content-grid rt-block section pt-' . esc_attr( $basics['padding_top'] ) . ' pb-' . esc_attr( $basics['padding_bottom'] ) . ' mt-' . esc_attr( $basics['margin_top'] ) . ' mb-' . esc_attr( $basics['margin_bottom'] ) . ' bg-' . esc_attr( $basics['background_color'] ) . ' text-' . esc_attr( $basics['text_color'] ),
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
		<div class="flex">
			<div class="flex-12 md:flex-10 xl:flex-8 mx-auto text-center">
				<!-- Pretitle -->
				<?php if ( $pretitle ) { ?>
					<p class="<?php echo ( $pretitle_tag ); ?> rt-content-grid__pretitle mb-2"><?php echo wp_kses_post( $pretitle ); ?></p>
				<?php } ?>

				<!-- Title -->
				<?php if ( $title ) { ?>
					<<?php echo esc_attr( $title_tag ); ?> class="rt-content-grid__title mb-3 mt-0"><?php echo wp_kses_post( $title ); ?></<?php echo esc_attr( $title_tag ); ?>>
				<?php } ?>

				<!-- Subtitle -->
				<?php if ( $subtitle ) { ?>
					<<?php echo esc_attr( $subtitle_tag ); ?> class="rt-content-grid__subtitle mb-3"><?php echo wp_kses_post( $subtitle ); ?></<?php echo esc_attr( $subtitle_tag ); ?>>
				<?php } ?>

				<!-- CTAs -->
				<?php if ( $ctas['cta1_url'] || $ctas['cta2_url'] ) { ?>
					<div class="rt-content-grid__ctas flex flex-center gap-3 my-4">
						<?php if ( $ctas['cta1_url'] ) { ?>
							<a href="<?php echo esc_url( $ctas['cta1_url'] ); ?>" class="rt-content-grid__cta rt-content-grid__cta--primary btn btn-<?php echo esc_attr( $ctas['cta1_style'] ); ?>">
								<?php echo esc_html( $ctas['cta1_label'] ); ?>
							</a>
						<?php } ?>
						<?php if ( $ctas['cta2_url'] ) { ?>
							<a href="<?php echo esc_url( $ctas['cta2_url'] ); ?>" class="rt-content-grid__cta rt-content-grid__cta--secondary btn btn-<?php echo esc_attr( $ctas['cta2_style'] ); ?>">
								<?php echo esc_html( $ctas['cta2_label'] ); ?>
							</a>
						<?php } ?>
					</div>
				<?php } ?>

				<!-- Grid items -->
				<?php if ( !empty( $items ) ) { ?>
					<div class="rt-content-grid__items grid gap-3 mt-4">
						<?php foreach ( $items as $item ) {
							if ( is_object( $item ) ) {
								$item = get_object_vars( $item );
							}
							$item_title = isset( $item['title'] ) ? (string) $item['title'] : '';
							$item_title_tag = isset( $item['titleTag'] ) ? rope_tow_block_sanitize_tag( $item['titleTag'], 'h5' ) : 'h5';
							$item_description = isset( $item['description'] ) ? (string) $item['description'] : '';
							$item_link_label = isset( $item['linkLabel'] ) ? (string) $item['linkLabel'] : '';
							$item_link_url = isset( $item['linkUrl'] ) ? (string) $item['linkUrl'] : '';
							$item_button_style = isset( $item['buttonStyle'] ) ? (string) $item['buttonStyle'] : 'primary';
							$item_icon = isset( $item['icon'] ) ? (string) $item['icon'] : '';
							$item_icon_classes = array_filter( array_map( 'sanitize_html_class', preg_split( '/\s+/', trim( $item_icon ) ) ) );
							$item_icon_class = implode( ' ', $item_icon_classes );
							$item_bg_color = isset( $item['backgroundColor'] ) ? (string) $item['backgroundColor'] : 'white';
							$item_text_color = isset ( $item['textColor'] ) ? (string) $item['textColor'] : 'dark'; ?>

							<!-- Grid items -->
							<div class="rt-content-grid__item span-12 sm:span-6 lg:<?php echo $grid_columns; ?> p-3 lg:p-4 bg-<?php echo esc_attr( $item_bg_color ); ?> text-<?php echo esc_attr( $item_text_color ); ?>" style="border-radius: <?php echo $grid_item_border_radius; ?>px">
								<!-- Icon -->
								<?php if ( '' !== $item_icon_class ) { ?>
									<i class="<?php echo esc_attr( $item_icon_class ); ?>" aria-hidden="true"></i>
								<?php } ?>
								<!-- Title -->
								<?php if ( '' !== $item_title ) { ?>
									<<?php echo esc_attr( $item_title_tag ); ?> class="rt-content-grid__item-title mb-2"><?php echo esc_html( $item_title ); ?></<?php echo esc_attr( $item_title_tag ); ?>>
								<?php } ?>
								<!-- Description -->
								<?php if ( '' !== $item_description ) { ?>
									<p class="rt-content-grid__item-description"><?php echo esc_html( $item_description ); ?></p>
								<?php } ?>
								<!-- Link -->
								<?php if ( '' !== $item_link_url ) { ?>
									<a class="rt-content-grid__item-link btn btn-<?php echo esc_attr( sanitize_html_class( $item_button_style ) ); ?>" href="<?php echo esc_url( $item_link_url ); ?>">
										<?php echo esc_html( '' !== $item_link_label ? $item_link_label : __( 'Learn more', 'rope-tow' ) ); ?>
									</a>
								<?php } ?>
							</div>
						<?php } ?>
					</div>
				<?php } ?>
			</div>
		</div>
  </div>
</div>