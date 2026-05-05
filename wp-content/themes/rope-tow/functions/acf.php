<?php
// Save JSON to Rope Tow theme folder
add_filter('acf/settings/save_json', function () {
    return get_template_directory() . '/acf-json';
});

// Load only Rope Tow theme fields
add_filter('acf/settings/load_json', function ($paths) {
    return [ get_template_directory() . '/acf-json' ];
});