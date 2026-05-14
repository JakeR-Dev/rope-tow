<?php
/**
 * Asset enqueueing — Vite dev (HMR - Hot Module Reload) and production (manifest).
 *
 * @package RopeTow
 */

/**
 * Determine if Vite dev server mode is enabled.
 *
 * @return bool
 */
function rope_tow_is_vite_dev_server() {
	return defined( 'VITE_DEV_SERVER' ) && VITE_DEV_SERVER;
}

/**
 * Mark a script handle so WordPress prints type="module".
 *
 * @param string $handle Script handle.
 */
function rope_tow_mark_script_as_module( $handle ) {
	if ( empty( $GLOBALS['rope_tow_module_script_handles'] ) || ! is_array( $GLOBALS['rope_tow_module_script_handles'] ) ) {
		$GLOBALS['rope_tow_module_script_handles'] = array();
	}

	$GLOBALS['rope_tow_module_script_handles'][ $handle ] = true;

	static $module_filter_added = false;
	if ( $module_filter_added ) {
		return;
	}

	add_filter( 'script_loader_tag', function ( $tag, $current_handle ) {
		$module_handles = isset( $GLOBALS['rope_tow_module_script_handles'] ) && is_array( $GLOBALS['rope_tow_module_script_handles'] )
			? $GLOBALS['rope_tow_module_script_handles']
			: array();

		if ( empty( $module_handles[ $current_handle ] ) ) {
			return $tag;
		}

		return str_replace( '<script ', '<script type="module" ', $tag );
	}, 10, 2 );

	$module_filter_added = true;
}

/**
 * Enqueue a script and force module type.
 *
 * @param string $handle    Script handle.
 * @param string $src       Script URL.
 * @param array  $deps      Script dependencies.
 * @param bool   $in_footer Load in footer.
 */
function rope_tow_enqueue_module_script( $handle, $src, $deps = array(), $in_footer = true ) {
	wp_enqueue_script( $handle, $src, $deps, ROPE_TOW_VERSION, $in_footer );
	rope_tow_mark_script_as_module( $handle );
}

/**
 * Fetch a single entry from Vite manifest.
 *
 * @param string $entry_key Manifest key.
 * @return array|null
 */
function rope_tow_get_vite_manifest_entry( $entry_key ) {
	static $manifest = null;

	if ( null === $manifest ) {
		$manifest_path = get_template_directory() . '/dist/manifest.json';

		if ( ! file_exists( $manifest_path ) ) {
			$manifest = array();
		} else {
			$decoded = json_decode( file_get_contents( $manifest_path ), true );
			$manifest = is_array( $decoded ) ? $decoded : array();
		}
	}

	if ( empty( $manifest[ $entry_key ] ) || ! is_array( $manifest[ $entry_key ] ) ) {
		return null;
	}

	return $manifest[ $entry_key ];
}

/**
 * Enqueue script + css from one Vite manifest entry.
 *
 * @param string $entry_key           Manifest key.
 * @param string $script_handle       Script handle.
 * @param string $style_handle_prefix Style handle prefix.
 * @param array  $script_deps         Script dependencies.
 */
function rope_tow_enqueue_vite_manifest_entry( $entry_key, $script_handle, $style_handle_prefix, $script_deps = array() ) {
	$entry = rope_tow_get_vite_manifest_entry( $entry_key );

	if ( ! $entry ) {
		return;
	}

	if ( ! empty( $entry['file'] ) ) {
		rope_tow_enqueue_module_script(
			$script_handle,
			get_template_directory_uri() . '/dist/' . ltrim( $entry['file'], '/' ),
			$script_deps
		);
	}

	if ( ! empty( $entry['css'] ) && is_array( $entry['css'] ) ) {
		foreach ( $entry['css'] as $index => $css_file ) {
			wp_enqueue_style( $style_handle_prefix . '-' . $index, get_template_directory_uri() . '/dist/' . ltrim( $css_file, '/' ), array(), ROPE_TOW_VERSION );
		}
	}
}

/**
 * Core Gutenberg dependencies required by custom editor scripts.
 *
 * @return array
 */
function rope_tow_get_editor_script_deps() {
	return array( 'wp-blocks', 'wp-block-editor', 'wp-components', 'wp-element', 'wp-i18n' );
}

function rope_tow_enqueue_theme_assets() {
	// Font awesome for social icons in footer
	wp_enqueue_style( 'font-awesome', 'https://use.fontawesome.com/releases/v6.7.2/css/all.css', array(), '6.7.2' );

	// Dev assets vs Prod assets
	if ( rope_tow_is_vite_dev_server() ) {
		rope_tow_enqueue_vite_dev();
	} else {
		rope_tow_enqueue_vite_manifest();
	}
}
add_action( 'wp_enqueue_scripts', 'rope_tow_enqueue_theme_assets' );

/**
 * Enqueue block editor assets from Vite.
 */
function rope_tow_enqueue_editor_assets() {
	if ( rope_tow_is_vite_dev_server() ) {
		rope_tow_enqueue_vite_editor_dev();
	} else {
		rope_tow_enqueue_vite_editor_manifest();
	}
}
// Loads assets for the editor UI shell (inspector, inserter, top toolbar).
add_action( 'enqueue_block_editor_assets', 'rope_tow_enqueue_editor_assets' );

/**
 * Enqueue editor assets for the block canvas iframe so block styles match frontend styling.
 */
function rope_tow_enqueue_block_canvas_assets() {
	if ( ! is_admin() ) {
		return;
	}

	rope_tow_enqueue_editor_assets();
}
// Loads assets in the block content canvas iframe so blocks match frontend styling.
add_action( 'enqueue_block_assets', 'rope_tow_enqueue_block_canvas_assets' );

/**
 * Inject Vite dev-server client + entry point for HMR.
 */
function rope_tow_enqueue_vite_dev() {
	$server = rtrim( VITE_DEV_SERVER, '/' );

	add_action( 'wp_head', function () use ( $server ) {
		echo '<script type="module" src="' . esc_url( $server . '/@vite/client' ) . '"></script>' . "\n";
		echo '<script type="module" src="' . esc_url( $server . '/assets/js/main.ts' ) . '"></script>' . "\n";
	} );
}

/**
 * Enqueue block editor assets from Vite dev server.
 */
function rope_tow_enqueue_vite_editor_dev() {
	$server = rtrim( VITE_DEV_SERVER, '/' );
	$editor_deps = rope_tow_get_editor_script_deps();

	rope_tow_enqueue_module_script( 'rope-tow-vite-client-editor', esc_url( $server . '/@vite/client' ), $editor_deps );
	rope_tow_enqueue_module_script( 'rope-tow-editor', esc_url( $server . '/assets/js/editor.js' ), $editor_deps );
}

/**
 * Enqueue hashed files from the Vite production manifest.
 */
function rope_tow_enqueue_vite_manifest() {
	rope_tow_enqueue_vite_manifest_entry( 'assets/js/main.ts', 'rope-tow-main', 'rope-tow-main' );
}

/**
 * Enqueue block editor assets from the Vite production manifest.
 */
function rope_tow_enqueue_vite_editor_manifest() {
	rope_tow_enqueue_vite_manifest_entry( 'assets/js/editor.js', 'rope-tow-editor', 'rope-tow-editor', rope_tow_get_editor_script_deps() );
}



