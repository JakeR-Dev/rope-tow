<?php
// Register post types
function post_types()
{
	$resource_labels =  [
		"name" => __("Resources"),
		"singular_name" => __("Resource"),
		"menu_name" => __("Resources"),
		"name_admin_bar" => __("Resources"),
		"add_new" => __("Add New"),
		"add_new_item" => __("Add New Resource"),
		"new_item" => __("New Resource"),
		"edit_item" => __("Edit Resource"),
		"view_item" => __("View Resource"),
		"all_items" => __("All Resource"),
		"search_items" => __("Search Resource"),
		"parent_item_colon" => __("Parent Resource:"),
		"not_found" => __("No Resources found."),
		"not_found_in_trash" => __("No Resources found in Trash.")
	];
	register_post_type("resource", [
		"capability_type" => "page",
		"exclude_from_search" => false,
		"has_archive" => false,
		"hierarchical" => false,
		"labels" => $resource_labels,
		"menu_icon" => "dashicons-media-spreadsheet",
		"public" => true,
		"publicly_queryable" => true,
		"query_var" => "resource",
		"rewrite" => ["slug" => "resources", "with_front" => false],
		"show_in_rest" => false,
		"show_ui" => true,
		"supports" => ["title", "thumbnail", "editor"],
		"taxonomies" => ["resource_type","resource_topics"]
	]);
	register_taxonomy("resource_type", "resource", [
		"args" => ["orderby" => "term_order"],
		"capabilities" => ["manage_terms" => "edit_pages"],
		"hierarchical" => true,
		"labels" => [
			"name" => "Resource Types",
			"add_new_item" => "Add Type",
			"new_item_name" => "New Type"
		],
		"query_var" => false,
		"rewrite" => ["slug" => "resource-type", "with_front" => false],
		"show_in_rest" => true,
		"show_tagcloud" => false,
		"show_ui" => true,
	]);
}
add_action("init", "post_types");
