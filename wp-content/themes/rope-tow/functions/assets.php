<?php
/**
 * Asset enqueueing — Vite dev (HMR - Hot Module Reload) and production (manifest).
 *
 * @package RopeTow
 */

function rope_tow_enqueue_theme_assets() {
	// Font awesome for social icons in footer
	wp_enqueue_style( 'font-awesome', 'https://use.fontawesome.com/releases/v6.7.2/css/all.css', array(), '6.7.2');

	// Dev assets vs Prod assets
	if ( defined( 'VITE_DEV_SERVER' ) && VITE_DEV_SERVER ) {
		rope_tow_enqueue_vite_dev();
	} else {
		rope_tow_enqueue_vite_manifest();
	}
}
add_action( 'wp_enqueue_scripts', 'rope_tow_enqueue_theme_assets' );

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
 * Enqueue hashed files from the Vite production manifest.
 */
function rope_tow_enqueue_vite_manifest() {
	$manifest_path = get_template_directory() . '/dist/manifest.json';

	if ( ! file_exists( $manifest_path ) ) {
		return;
	}

	$manifest = json_decode( file_get_contents( $manifest_path ), true );
	if ( ! is_array( $manifest ) || empty( $manifest['assets/js/main.ts'] ) ) {
		return;
	}

	$entry = $manifest['assets/js/main.ts'];

	if ( ! empty( $entry['file'] ) ) {
		wp_enqueue_script( 'rope-tow-main', get_template_directory_uri() . '/dist/' . ltrim( $entry['file'], '/' ), array(), ROPE_TOW_VERSION, true );

		// Vite output is ES modules — add type="module" to the script tag.
		add_filter( 'script_loader_tag', function ( $tag, $handle ) {
			if ( 'rope-tow-main' !== $handle ) {
				return $tag;
			}
			return str_replace( '<script ', '<script type="module" ', $tag );
		}, 10, 2 );
	}

	if ( ! empty( $entry['css'] ) && is_array( $entry['css'] ) ) {
		foreach ( $entry['css'] as $index => $css_file ) {
			wp_enqueue_style( 'rope-tow-main-' . $index, get_template_directory_uri() . '/dist/' . ltrim( $css_file, '/' ), array(), ROPE_TOW_VERSION );
		}
	}
}

