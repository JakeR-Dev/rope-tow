<?php
/**
 * Enable theme features
 */

// Limit revisions
function rope_tow_revision_limit($num, $post) {
	return 5;
}
add_filter("wp_revisions_to_keep", "rope_tow_revision_limit", 10, 2);

// Add Support for SVGs
function rope_tow_mime_types($mimes) {
	if (current_user_can('administrator')) {
    $mimes['svg'] = 'image/svg+xml';
  }
  return $mimes;
}
add_filter("upload_mimes", "rope_tow_mime_types");
