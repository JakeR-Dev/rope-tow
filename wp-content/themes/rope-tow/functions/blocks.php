<?php

/**
 * Custom category for Rope Tow Blocks
 */
function rope_tow_category_block($cats)
{
	$new = array(
		'category' => array(
			'slug'  => 'rope-tow-blocks',
			'title' => 'Rope Tow Blocks',
		)
	);
	$position = 0;
	$cats = array_slice($cats, 0, $position, true) + $new + array_slice($cats, $position, null, true);
	$cats = array_values($cats);
	return $cats;
}
add_filter('block_categories_all', 'rope_tow_category_block');

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
