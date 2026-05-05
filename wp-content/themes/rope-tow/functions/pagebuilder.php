<?php
//
// Set custom Padding to Pagebuilder sections
//
function padding() {
	if (get_sub_field("padding_top") == "custom") {
		$top = "padding-top: " . get_sub_field("padding_top_value") . "px; ";
	} else {
		$top = "";
	}
	if (get_sub_field("padding_bottom") == "custom") {
		$bottom =
			"padding-bottom: " . get_sub_field("padding_bottom_value") . "px; ";
	} else {
		$bottom = "";
	}
	return $top . $bottom;
}

function generatePictureElement($image, $lazyload) {
	$islazyload = $lazyload;

	if ($islazyload) {
		$element =
			"<picture>" .
			'<source data-srcset="' .
			$image["sizes"]["medium"] .
			'" media="--small" > ' .
			'<source data-srcset="' .
			$image["sizes"]["medium_large"] .
			'" media="--medium">' .
			'<source data-srcset="' .
			$image["sizes"]["medium_large"] .
			'" media="--large">' .
			'<img class="lazyload img-fluid" src="' .
			$image["url"] .
			'"' .
			"</picture>";
	} else {
		$element =
			"<picture>" .
			'<source srcset="' .
			$image["sizes"]["medium"] .
			'" media="(max-width: 320px)" > ' .
			'<source srcset="' .
			$image["sizes"]["medium_large"] .
			'" media="(min-width: 321px) and (max-width: 768px)">' .
			'<source srcset="' .
			$image["sizes"]["medium_large"] .
			'" media="(min-width: 769px) and (max-width: 1024px)">' .
			'<img class="img-fluid" src="' .
			$image["url"] .
			'"' .
			"</picture>";
	}

	return $element;
}
