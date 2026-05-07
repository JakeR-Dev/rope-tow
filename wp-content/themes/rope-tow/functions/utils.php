<?php
/**
 *  A collection of utility functions
 *
 *  @since 1.0.0
 *  @package rope-tow
 */

/**
 * Add page slug to body_class() classes if it doesn't exist
 *
 * @param array $classes The body class array
 * @return array The modified body class array
 */
function theme_body_class($classes)
{
	// Add post/page slug
	if (is_single() || (is_page() && !is_front_page())) {
		if (!in_array(basename(get_permalink()), $classes)) {
			$classes[] = basename(get_permalink());
		}
	}
	return $classes;
}
add_filter("body_class", "theme_body_class");


/**
 * Print External Scripts
 *
 * @global type $external_scripts
 * @param type $location
 */
function print_external_scripts($location)
{
	global $external_scripts;
	if ($external_scripts == null) {
		$external_scripts["header"] = "";
		$external_scripts["body"] = "";
		$external_scripts["footer"] = "";
		$scripts = [];

		if (class_exists("ACF")) {
			$scripts = get_field("scripts", "options") ?: [];
		}

		if (is_array($scripts) && !empty($scripts)) {
			foreach ($scripts as $script) {
				if ($script["script_enabled"]) {
					$external_scripts[$script["script_location"]] .=
						"\r\n<!-- External Script : " .
						$script["script_name"] .
						" -->\r\n" .
						$script["script_code"] .
						"\r\n";
				}
			}
		}
	}
	if (array_key_exists($location, $external_scripts)) {
		echo $external_scripts[$location];
	}
}

/**
 * Retrieves site main favicon
 * 
 * @return string The site favicon URL
 */

function get_site_favicon()
{
	if (function_exists('has_site_icon') && has_site_icon()) {
		return get_site_icon_url();
	} else {
		return get_template_directory_uri() . '/assets/img/favicon.png';
	}
}

/**
 * Update the excerpt length
 * 
 * @return int The new excerpt length
 */
function custom_excerpt_length()
{
	return 22;
}
add_filter('excerpt_length', 'custom_excerpt_length');

/**
 *  Update the excerpt more
 * 
 * @return string The new excerpt end string
 */
function custom_excerpt_more()
{
	return '...';
}
add_filter('excerpt_more', 'custom_excerpt_more');

/**
 * Create a mixed version of a user-chosen color
 * ex: rope_tow_mix_color($primary_color, '#000000', 15, .5);
 * 		 rope_tow_mix_color([color to be mixed], [color to mix with], [weight of mix], [transparency]);
 */
function rope_tow_mix_color($color1, $color2, $weight_percent = 50, $alpha = null)
{
	$color1 = ltrim($color1, '#');
	$color2 = ltrim($color2, '#');

	if (strlen($color1) === 3) {
		$color1 = $color1[0] . $color1[0] . $color1[1] . $color1[1] . $color1[2] . $color1[2];
	}
	if (strlen($color2) === 3) {
		$color2 = $color2[0] . $color2[0] . $color2[1] . $color2[1] . $color2[2] . $color2[2];
	}

	$weight = $weight_percent / 100;

	$r = round(hexdec(substr($color1, 0, 2)) * (1 - $weight) + hexdec(substr($color2, 0, 2)) * $weight);
	$g = round(hexdec(substr($color1, 2, 2)) * (1 - $weight) + hexdec(substr($color2, 2, 2)) * $weight);
	$b = round(hexdec(substr($color1, 4, 2)) * (1 - $weight) + hexdec(substr($color2, 4, 2)) * $weight);

	if ($alpha !== null) {
		$alpha = max(0, min(1, floatval($alpha))); // clamp to 0–1
		return "rgba($r, $g, $b, $alpha)";
	}

	return sprintf("#%02x%02x%02x", $r, $g, $b);
}

/**
 * Render the footer social links
 * 
*/
function rope_tow_render_footer_social_links() {
	$json  = get_theme_mod( 'rope_tow_footer_social_links', '[]' );
	$items = json_decode( $json, true );
	if ( ! is_array( $items ) || ! $items ) return;

	foreach ( $items as $row ) {
		$label     = isset( $row['label'] ) ? esc_html( $row['label'] ) : '';
		$url       = isset( $row['url'] ) ? esc_url( $row['url'] ) : '#';
		$icon_type = ( isset( $row['icon_type'] ) && in_array( $row['icon_type'], [ 'icon', 'image' ], true ) ) ? $row['icon_type'] : 'icon';
		$icon      = isset( $row['icon'] ) ? esc_attr( $row['icon'] ) : '';
		$image_url = isset( $row['image_url'] ) ? esc_url( $row['image_url'] ) : '';
		$target    = ! empty( $row['target'] ) ? ' target="_blank"' : '';
		$rel       = ! empty( $row['rel'] ) ? ' rel="' . esc_attr( $row['rel'] ) . '"' : '';

		echo '<li class="type-'. $icon_type .'"><a href="' . $url . '"' . $target . $rel . '>';

		if ( 'image' === $icon_type && $image_url ) {
			echo '<img src="' . $image_url . '" alt="' . $label . '">';
		} elseif ( $icon ) {
			echo '<i class="' . $icon . '"></i>';
		}

		echo '<span class="sr-only">' . $label . '</span></a></li>';
	}
}
