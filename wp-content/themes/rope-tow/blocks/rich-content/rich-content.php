<?php
/**
 * Rich Content block render template.
 *
 * @package RopeTow
 */

if (!defined('ABSPATH')) {
	exit;
}

// Gather block-specific attributes with defaults


// Gather shared attributes using helper functions
$ctas = rope_tow_block_cta_attributes( $attributes );
$basics = rope_tow_block_basics_attributes( $attributes );

// Define block wrapper classes and attributes
$wrapper_attributes = get_block_wrapper_attributes( [
	'class' => 'rt-rich-content rt-block section pt-' . esc_attr( $basics['padding_top'] ) . ' pb-' . esc_attr( $basics['padding_bottom'] ) . ' mt-' . esc_attr( $basics['margin_top'] ) . ' mb-' . esc_attr( $basics['margin_bottom'] ) . ' bg-' . esc_attr( $basics['background_color'] ) . ' text-' . esc_attr( $basics['text_color'] ),
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
  </div>
</div>