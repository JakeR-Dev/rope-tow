<?php

add_filter('block_categories_all', 'rope_tow_category_block');

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

/**
 * Only allow HUSL custom blocks for "Pages" post type
 */
function rope_tow_allow_only_acf_blocks_on_pages($allowed_blocks, $block_editor_context)
{
	if (isset($block_editor_context->post) && $block_editor_context->post->post_type === 'page') {
		$acf_blocks = [];

		// Get all registered blocks
		$registered_blocks = WP_Block_Type_Registry::get_instance()->get_all_registered();

		// Loop through and collect only ACF blocks
		foreach ($registered_blocks as $block_name => $block) {
			if (strpos($block_name, 'acf/') === 0) {
				$acf_blocks[] = $block_name;
			}
		}
		return $acf_blocks;
	}

	return $allowed_blocks;
}
// add_filter('allowed_block_types_all', 'rope_tow_allow_only_acf_blocks_on_pages', 10, 2);

/**
 * Gutenberg Blocks
 *
 * @package rope-tow Block
 */
if (function_exists("acf_register_block_type")) {
	function register_acf_block_types()
	{
		$blocks = [
			[
				"name" => "columns-with-header",
				"title" => __("Columns with Header"),
				"description" => __("This block allows to add column content with a header"),
			],
			[
				"name" => "cta-section",
				"title" => __("CTA Section"),
				"description" => __("This block adds a CTA Section to display content relevant"),
			],
			[
				"name" => "flexible-content",
				"title" => __("Flexible Content Block"),
				"description" => __("This block has all the primitive elements on it, allows to create landing pages pretty fast"),
			],
			[
				"name" => "hero",
				"title" => __("Hero"),
				"description" => __("Hero block, perfect as the header for most pages."),
			],
			[
				"name" => "side-by-side",
				"title" => __("Side by Side Block"),
				"description" => __("This block allows to create a 2 column layout with content sided by each other"),
			],
			[
				"name" => "subscribe",
				"title" => __("Subscribe Block"),
				"description" => __("This block allows to create a subscribe cta"),
			],
			[
				"name" => "styleguide",
				"title" => __("Styleguide Block"),
				"description" => __("Block used to display the styleguide of the site"),
			],
			[
				"name" => "testimonials",
				"title" => __("Testimonials"),
				"description" => __("This block adds an slider for testimonials, you can select 2 different options of styling"),
			],
			[
				"name" => "post-archive",
				"title" => __("Post Archive"),
				"description" => __("This block is a grid of any custom post type or blog posts with the ability to filter and search"),
			],
			[
				"name" => "tabs",
				"title" => __("Tabs"),
				"description" => __("This block is used to display a series of interactive tabs."),
			],
			[
				"name" => "carousel",
				"title" => __("Carousel"),
				"description" => __("This block is used to display a rotating carousel."),
			],
			[
				"name" => "sticky-scroller",
				"title" => __("Sticky Scroller"),
				"description" => __("This block is used to display a fixed image next to a scrolling series of content."),
			],
			[
				"name" => "cards",
				"title" => __("Cards"),
				"description" => __("This block is used to display a series of content cards.")
			],
			[
				"name" => "stats",
				"title" => __("Stats"),
				"description" => __("This block is used to display a series of statistics."),
			],
			[
				"name" => "timeline",
				"title" => __("Timeline"),
				"description" => __("This block is used to display a timeline of events."),
			],
			[
				"name" => "content-collage",
				"title" => __("Content Collage"),
				"description" => __("This block is used to display a collage of various content types."),
			],
		];

		foreach ($blocks as $block) {
			$args = [
				"name" => $block["name"],
				"title" => __($block["title"]),
				"description" => __($block["description"]),
				"render_template" => "blocks/{$block["name"]}/{$block["name"]}.php",
				"category" => "rope-tow-blocks",
				"icon" => ROPE_TOW_ICON,
				"mode" => "auto",
				"keywords" => ["rope-tow", $block["name"]],
				"example" => [
					"attributes" => [
						"mode" => "preview",
						"data" => [
							"preview_image_{$block["name"]}" => "blocks/{$block["name"]}/preview.png",
						],
					],
				],
			];
			if (isset($block["enqueue_assets"])) {
				$args["enqueue_assets"] = $block["enqueue_assets"];
			}
			acf_register_block_type($args);
		}
	}
	add_action("acf/init", "register_acf_block_types");
}
