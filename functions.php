<?php

const VERSION = "1.0.0";

require __DIR__ . '/core/editor-settings.php';
require __DIR__ . '/core/register-blocks.php';
require __DIR__ . '/core/enqueue-scripts.php';

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
