<?php

/**
 * Rope Tow functions and definitions
 *
 * @package RopeTow
 */

if (!defined("ROPE_TOW_VERSION")) {
	// Replace the version number of the theme on each release.
	define("ROPE_TOW_VERSION", "1.0");
}

if (!defined('ROPE_TOW_ICON')) {
	define('ROPE_TOW_ICON', '<svg width="500" height="500" viewBox="0 0 500 500" fill="none" xmlns="http://www.w3.org/2000/svg">
	<rect width="500" height="500" fill="#00E0BF"/>
	<path fill-rule="evenodd" clip-rule="evenodd" d="M156.254 172.395L400 172.395L400 156.325L156.254 156.325L156.254 172.395Z" fill="white"/>
	<path fill-rule="evenodd" clip-rule="evenodd" d="M232.986 124.585L400 124.585L400 108.516L232.986 108.516L232.986 124.585Z" fill="white"/>
	<path fill-rule="evenodd" clip-rule="evenodd" d="M232.795 391.484L399.805 391.484L399.805 375.414L232.795 375.414L232.795 391.484Z" fill="white"/>
	<path fill-rule="evenodd" clip-rule="evenodd" d="M155.996 343.62L399.742 343.62L399.742 327.55L155.996 327.55L155.996 343.62Z" fill="white"/>
	<path fill-rule="evenodd" clip-rule="evenodd" d="M263.639 295.373L263.639 204.852L399.931 204.848L399.931 233.777L289.675 233.777L289.675 266.444L399.688 266.444L399.688 295.373L263.639 295.373Z" fill="white"/>
	<path fill-rule="evenodd" clip-rule="evenodd" d="M100.15 233.781L210.162 233.781L210.162 266.448L100 266.444L100 295.373L236.199 295.377L236.199 204.856L100.15 204.852L100.15 233.781Z" fill="white"/>
	</svg>');
}

/**
 * Includes
 *
 * The $rope_tow_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed.
 * Supports child theme overrides.
 * Please note that missing files will produce a fatal error.
 *
 * @package RopeTow
 */
function rope_tow_include()
{
	$includes = [
		// "classes/class-vite.php",
		// "classes/class-rope-tow-block.php", // Rope Tow Block Class
		// "classes/class-rope-tow-primitive.php", // Rope Tow Primitive Class
		"functions/utils.php", // Utility functions
		"functions/init.php", // Initial theme setup and constants
		"functions/assets.php", // Asset enqueueing (Vite dev / prod)
		"functions/menus.php", // Removing unneeded WP defaults
		"functions/config.php", // Configuration
		"functions/security.php", // Security focused settings
		"functions/cpt.php", // Custom Post Types
		"functions/options.php", // ACF Theme Options
		"functions/shortcodes.php", // Custom Wordpress Shortcodes for WYSIWYGs
		"functions/blocks.php", // Declare Custom Blocks
		"functions/acf.php", // Custom ACF field types (for the post archive module)
		"functions/customizer/customizations.php" // Appearance > Customize
	];
	foreach ($includes as $file) {
		if (!($filepath = locate_template($file))) {
			trigger_error(sprintf(__("Error locating %s for inclusion", "rope-tow"), $file), E_USER_ERROR);
		}
		require_once $filepath;
	}
}
rope_tow_include();
