<?php

// Disable XML-RPC Pingback methods
add_filter("xmlrpc_methods", "rope_tow_block_xmlrpc");
function rope_tow_block_xmlrpc($methods) {
	unset($methods["pingback.ping"]);
	unset($methods["pingback.extensions.getPingbacks"]);
	unset($methods["wp.getUsersBlogs"]); // New method used by attackers to perform brute force discovery of existing users
	return $methods;
}

// Hide WordPress Version Info
function rope_tow_hide_wordpress_version() {
	return "";
}
add_filter("the_generator", "rope_tow_hide_wordpress_version");

// Remove WordPress Version Number In URL Parameters From JS/CSS
function rope_tow_hide_wordpress_version_in_script($src, $handle) {
	$src = remove_query_arg("ver", $src);
	return $src;
}
add_filter("style_loader_src", "rope_tow_hide_wordpress_version_in_script", 10, 2);
add_filter("script_loader_src", "rope_tow_hide_wordpress_version_in_script", 10, 2);