<?php

const VERSION = "1.0.0";

require __DIR__ . '/core/enqueue-scripts.php';
require __DIR__ . '/core/editor-settings.php';
require __DIR__ . '/core/register-post-types.php';
require __DIR__ . '/core/register-blocks.php';

function assets(string $path): string
{
  return get_template_directory_uri() . '/assets' . $path;
}

function assets_path(string $path): string
{
  return get_template_directory() . '/assets' . $path;
}

function add_class_modificator(string $class_name, string $modificator): string
{
  $modificator = str_replace('is-style-', '', $modificator);

  return $class_name . ($modificator ? " {$class_name}--" . $modificator : '');
}

function get_logo_svg_src(): string
{
  $logo_src = get_field('logo', 'option');
  return file_get_contents($logo_src);
}

function get_svg_source(string $icon_name): string
{
  $icon_path = assets_path("/icons/$icon_name.svg");
  return file_get_contents($icon_path);
}

function get_acf_option(string $key): mixed
{
  return get_field($key, 'option');
}
