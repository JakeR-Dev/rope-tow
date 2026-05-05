<?php
//
// filter the Gravity Forms button type
//
function form_submit_button($button, $form) {
	$dom = new DOMDocument();
	$dom->loadHTML($button);
	$input = $dom->getElementsByTagName("input")->item(0);
	$id = $input->getAttribute("id");
	$onclick = $input->getAttribute("onclick");
	$onkeypress = $input->getAttribute("onkeypress");
	$text = !empty($form["button"]["text"])
		? $form["button"]["text"]
		: __("Submit", "nylon");
	return "<button class='btn btn-primary btn-lg gform_button button' id='" .
		$id .
		"' onclick='" .
		$onclick .
		"' onkeypress='" .
		$onkeypress .
		"'>{$text}</button>";
}
add_filter("gform_submit_button", "form_submit_button", 10, 2);
