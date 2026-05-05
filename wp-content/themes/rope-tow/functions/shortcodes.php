<?php
// [button text="text" size="large" url="url" target="target"]
function button_func($atts) {
	$a = shortcode_atts(
		[
			"text" => "Button Text",
			"url" => "/",
			"target" => "_self",
			"size" => "large",
			"style" => "primary"
		],
		$atts
	);

	$s = "<a class='btn btn-{$a["style"]} btn-{$a["size"]}' href='{$a["url"]}' target='{$a["target"]}'>{$a["text"]}</a>";

	return $s;
}
add_shortcode("button", "button_func");
