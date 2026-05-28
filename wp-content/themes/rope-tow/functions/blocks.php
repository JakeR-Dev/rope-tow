<?php

/**
 * Custom category for Rope Tow Blocks (The Goods)
 */
function rope_tow_category_block($cats)
{
	$new = array(
		'category' => array(
			'slug'  => 'the-goods',
			'title' => 'The Goods',
		)
	);
	$position = 0;
	$cats = array_slice($cats, 0, $position, true) + $new + array_slice($cats, $position, null, true);
	$cats = array_values($cats);
	return $cats;
}
add_filter('block_categories_all', 'rope_tow_category_block');

/**
 * Shared attributes injected into every rope-tow block at registration time.
 * Add new common attributes here rather than copying them into each block.json.
 */
function rope_tow_shared_block_attributes( $metadata ) {
	// Only apply to our own blocks.
	if ( empty( $metadata['name'] ) || ! str_starts_with( $metadata['name'], 'rope-tow/' ) ) {
		return $metadata;
	}

	$shared = [
		'paddingTop'    				=> [ 'type' => 'string', 'default' => 'medium' ],
		'paddingBottom' 				=> [ 'type' => 'string', 'default' => 'medium' ],
		'marginTop'     				=> [ 'type' => 'string', 'default' => 'none' ],
		'marginBottom'  				=> [ 'type' => 'string', 'default' => 'none' ],
		'backgroundImage' 			=> [ 'type' => 'object', 'default' => (object)[] ],
    'textColor' 						=> [ 'type' => 'string', 'default' => 'light' ],
		'backgroundColor' 			=> [ 'type' => 'string', 'default' => 'brand-primary' ],
		'backgroundAttachment' 	=> [ 'type' => 'string', 'default' => 'scroll' ]
	];

	// Merge: existing block.json values take priority so per-block overrides still work.
	$metadata['attributes'] = array_merge( $shared, $metadata['attributes'] ?? [] );

	return $metadata;
}
add_filter( 'block_type_metadata', 'rope_tow_shared_block_attributes' );

/**
 * Shared HTML tags supported by block heading/tag controls.
 */
function rope_tow_block_allowed_tags() {
	return [ 'p', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'ul', 'ol' ];
}

/**
 * Normalize a requested HTML tag against the shared allowlist.
 */
function rope_tow_block_sanitize_tag( $tag, $default = 'p' ) {
	$tag = strtolower( (string) $tag );

	return in_array( $tag, rope_tow_block_allowed_tags(), true ) ? $tag : $default;
}

/**
 * Extract an attachment ID from a background image attribute, regardless of whether
 * WordPress hands it to us as an array or a stdClass object.
 */
function rope_tow_block_background_image_id( $background_image ) {
	if ( is_array( $background_image ) ) {
		return $background_image['id'] ?? null;
	}

	if ( is_object( $background_image ) ) {
		return $background_image->id ?? null;
	}

	return null;
}

/**
 * Get the shared spacing and background-related attributes for a block in one call.
 */
function rope_tow_block_basics_attributes( $attributes ) {
	$background_image = $attributes['backgroundImage'] ?? [];
	return [
		'padding_top'    					 		=> $attributes['paddingTop'] ?? 'medium',
		'padding_bottom' 					 		=> $attributes['paddingBottom'] ?? 'medium',
		'margin_top'     					 		=> $attributes['marginTop'] ?? 'none',
		'margin_bottom'  					 		=> $attributes['marginBottom'] ?? 'none',
		'background_image'         		=> $background_image,
		'background_image_id'      		=> rope_tow_block_background_image_id( $background_image ),
		'background_color'         		=> $attributes['backgroundColor'] ?? 'brand-primary',
		'background_attachment'    		=> $attributes['backgroundAttachment'] ?? 'scroll',
		'background_attachment_class' => ( $attributes['backgroundAttachment'] ?? 'scroll' ) === 'fixed' ? 'bg-attachment-image-fixed' : '',
		'text_color'               		=> $attributes['textColor'] ?? 'light',
	];
}

/**
 * Get the shared CTA attributes for a block in one call.
 */
function rope_tow_block_cta_attributes( $attributes ) {
	return [
		'cta1_label' => $attributes['cta1Label'] ?? '',
		'cta1_url'   => $attributes['cta1Url'] ?? '',
		'cta1_style' => $attributes['cta1Style'] ?? 'primary',
		'cta2_label' => $attributes['cta2Label'] ?? '',
		'cta2_url'   => $attributes['cta2Url'] ?? '',
		'cta2_style' => $attributes['cta2Style'] ?? 'secondary',
	];
}

/**
 * Register custom Gutenberg blocks.
 */
function rope_tow_register_blocks()
{
	$block_json_files = glob(get_template_directory() . '/blocks/*/block.json');

	if (empty($block_json_files)) {
		return;
	}

	foreach ($block_json_files as $block_json_file) {
		$block_dir = dirname($block_json_file);
		register_block_type($block_dir);
	}
}
add_action('init', 'rope_tow_register_blocks');
