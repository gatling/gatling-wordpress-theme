<?php

function gatling_theme_styles() {
  $root = get_template_directory_uri();
  $directory = get_stylesheet_directory_uri();
  $parent_style = 'parent-style';

  wp_enqueue_style($parent_style, "$root/style.css");
  wp_enqueue_style('gatling', "$directory/style.css", array($parent_style));
}

add_action('wp_enqueue_scripts', 'gatling_theme_styles', 99);

$stylesheet = get_stylesheet();
$template = get_template();

if ($stylesheet !== $template) {
  add_filter("pre_update_option_theme_mods_$stylesheet", function ($value, $old_value) {
    $template = get_template();
    update_option("theme_mods_$template", $value);
    return $old_value; // prevent update to child theme mods
  }, 10, 2);
  add_filter("pre_option_theme_mods_$stylesheet", function ($default) {
    $template = get_template();
    return get_option("theme_mods_$template", $default);
  });
}
