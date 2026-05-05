<?php
// Track post view count for "most popular" filter
function nylon_prevent_view_spam($post_id) {
  $key = 'nylon_viewed_' . $post_id;
  if (!isset($_COOKIE[$key])) {
    setcookie($key, '1', time() + 3600, '/');
    return true;
  }
  return false;
}
function nylon_track_post_views() {
  if (is_singular()) {
    global $post;
    $post_id = $post->ID;
    if (current_user_can('edit_posts') || get_post_type($post_id) === 'page') {
      return;
    }
    if (nylon_prevent_view_spam($post_id)) {
      $views = (int) get_post_meta($post_id, 'nylon_post_views', true);
      $views++;
      update_post_meta($post_id, 'nylon_post_views', $views);
    }
  }
}
add_action('wp_head', 'nylon_track_post_views');
function nylon_set_default_post_views($post_id, $post, $update) {
    if ($update) return;
    $all_post_types = get_post_types(['public' => true], 'names');
    $excluded = ['page', 'attachment'];
    $allowed_post_types = array_diff($all_post_types, $excluded);
    if (!in_array($post->post_type, $allowed_post_types)) return;
    if (!metadata_exists('post', $post_id, 'nylon_post_views')) {
        update_post_meta($post_id, 'nylon_post_views', 0);
    }
}
add_action('save_post', 'nylon_set_default_post_views', 10, 3);


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
	register_taxonomy("resource_topic", "resource", [
		"args" => ["orderby" => "term_order"],
		"capabilities" => ["manage_terms" => "edit_pages"],
		"hierarchical" => true,
		"labels" => [
			"name" => "Resource Topics",
			"add_new_item" => "Add Topic",
			"new_item_name" => "New Topic"
		],
		"query_var" => false,
		"rewrite" => ["slug" => "resource-topic", "with_front" => false],
		"show_in_rest" => true,
		"show_tagcloud" => false,
		"show_ui" => true,
	]);
	$popup_labels =  [
		"name" => __("Popups"),
		"singular_name" => __("Popup"),
		"menu_name" => __("Popups"),
		"name_admin_bar" => __("Popups"),
		"add_new" => __("Add New"),
		"add_new_item" => __("Add New Popup"),
		"new_item" => __("New Popup"),
		"edit_item" => __("Edit Popup"),
		"view_item" => __("View Popup"),
		"all_items" => __("All Popups"),
		"search_items" => __("Search Popups"),
		"parent_item_colon" => __("Parent Popup:"),
		"not_found" => __("No Popups found."),
		"not_found_in_trash" => __("No Popups found in Trash.")
	];
	register_post_type("popup", [
		"capability_type" => "page",
		"exclude_from_search" => true,
		"has_archive" => false,
		"hierarchical" => false,
		"labels" => $popup_labels,
		"menu_icon" => "dashicons-editor-expand",
		"public" => true,
		"publicly_queryable" => true,
		"query_var" => "popup",
		"rewrite" => ["slug" => "popups", "with_front" => false],
		"show_in_rest" => false,
		"show_ui" => true,
		"supports" => ["title", "thumbnail", "editor"]
	]);
}
add_action("init", "post_types");
