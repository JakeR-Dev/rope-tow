<?php
/**
 * Add Menus
 */
function nylon_nav_menus() {
	// Register wp_nav_menu() menus
	// http://codex.wordpress.org/Function_Reference/register_nav_menus
	register_nav_menus([
		"primary_navigation" => __("Primary Navigation", "nylon"),
		"mobile_navigation" => __("Mobile Navigation", "nylon"),
		"footer_navigation" => __("Footer Navigation", "nylon"),
		"legal_navigation" => __("Legal Navigation", "nylon")
	]);
}

add_action("after_setup_theme", "nylon_nav_menus");
