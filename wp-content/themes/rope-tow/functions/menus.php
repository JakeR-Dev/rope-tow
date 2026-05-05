<?php
/**
 * Add Menus
 */
function rope_tow_nav_menus() {
	// Register wp_nav_menu() menus
	// http://codex.wordpress.org/Function_Reference/register_nav_menus
	register_nav_menus([
		"primary_navigation" => __("Primary Navigation", "rope-tow"),
		"mobile_navigation" => __("Mobile Navigation", "rope-tow"),
		"footer_navigation" => __("Footer Navigation", "rope-tow"),
		"legal_navigation" => __("Legal Navigation", "rope-tow")
	]);
}

add_action("after_setup_theme", "rope_tow_nav_menus");
