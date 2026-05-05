<?php
/**
 * Initial setup and constants
 */
function rope_tow_theme_setup() {
	// Enable plugins to manage the document title
	// http://codex.wordpress.org/Function_Reference/add_theme_support#Title_Tag
	add_theme_support("title-tag");

	// Add post thumbnails
	// http://codex.wordpress.org/Post_Thumbnails
	// http://codex.wordpress.org/Function_Reference/set_post_thumbnail_size
	// http://codex.wordpress.org/Function_Reference/add_image_size
	add_theme_support("post-thumbnails");

	// Add HTML5 markup for captions
	// http://codex.wordpress.org/Function_Reference/add_theme_support#HTML5
	add_theme_support("html5", ["caption", "comment-form", "comment-list"]);
}
add_action("after_setup_theme", "rope_tow_theme_setup");

/*
 * Removing WP Cruft for security and aesthetics
 */

add_action("wp_head", "rope_tow_remove_actions", 1);

add_action("wp_print_styles", "wps_deregister_styles", 100);
function wps_deregister_styles() {
	wp_dequeue_style("wp-block-library");
}

function rope_tow_remove_actions() {
	// REMOVE WP EMOJI
	remove_action("wp_head", "print_emoji_detection_script", 7);
	remove_action("wp_print_styles", "print_emoji_styles");

	remove_action("admin_print_scripts", "print_emoji_detection_script");
	remove_action("admin_print_styles", "print_emoji_styles");

	// Extra links
	remove_action("wp_head", "rsd_link"); // Weblog Client
	remove_action("wp_head", "wlwmanifest_link"); // Windows Livewriter
	remove_action("wp_head", "wp_shortlink_wp_head"); // Auto shortlink
	remove_action("wp_head", "wp_generator"); // WordPress Meta Generator
	remove_action("wp_head", "rest_output_link_wp_head", 10); // REST url
	remove_action("wp_head", "wp_oembed_add_discovery_links", 10); // Oembed URLs

	remove_action("wp_head", "feed_links_extra", 3); // Display the links to the extra feeds such as category feeds
	remove_action("wp_head", "feed_links", 2); // Display the links to the general feeds: Post and Comment Feed
	remove_action("wp_head", "index_rel_link"); // index link
	remove_action("wp_head", "parent_post_rel_link", 10, 0); // prev link
	remove_action("wp_head", "start_post_rel_link", 10, 0); // start link
	remove_action("wp_head", "adjacent_posts_rel_link", 10, 0); // Display relational links for the posts adjacent to the current post.
}

// Remove Admin Menus
function rope_tow_remove_menus() {
	remove_menu_page("edit-comments.php"); //Comments
}
add_action("admin_menu", "rope_tow_remove_menus");

// Remove <link rel='dns-prefetch' href='//s.w.org' />
add_filter("emoji_svg_url", "__return_false");

// Remove Recent Comments style
add_action("widgets_init", "rope_tow_remove_recent_comments_style");
function rope_tow_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action("wp_head", [
		$wp_widget_factory->widgets["WP_Widget_Recent_Comments"],
		"recent_comments_style"
	]);
}

// Remove Yoast comments
if (defined("WPSEO_VERSION")) {
	add_action(
		"wp_head",
		function () {
			ob_start(function ($o) {
				return preg_replace('/^\n?<!--.*?[Y]oast.*?-->\n?$/mi', "", $o);
			});
		},
		~PHP_INT_MAX
	);
}

// Register Custom Navigation Walker
require_once get_template_directory() . "/classes/class-wp-bootstrap-navwalker.php";

// Adding Theme Support
add_theme_support("custom-logo");