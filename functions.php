<?php

const VERSION = "1.0.0";

function assets(string $path): string
{
  return get_template_directory_uri() . '/assets' . $path;
}

add_theme_support('editor-styles');
add_editor_style('assets/styles/main.css');

add_filter('block_editor_settings_all', function ($editor_settings) {
  $css = '.edit-post-visual-editor__post-title-wrapper {
      display: none;
  }';

  $editor_settings['styles'][] = ['css' => $css];
  return $editor_settings;
});
