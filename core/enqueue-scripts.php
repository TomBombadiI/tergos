<?php

// правильный способ подключить стили и скрипты темы
add_action('wp_enqueue_scripts', 'theme_add_scripts');

function theme_add_scripts()
{
  // подключаем файл стилей темы
  wp_enqueue_style('main', assets('/styles/main.css'), ver: VERSION);

  // подключаем js файл темы
  wp_enqueue_script_module('main', assets('/scripts/main.js'), version: VERSION);
}
