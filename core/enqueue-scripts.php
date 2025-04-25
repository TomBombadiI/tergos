<?php

add_action('wp_enqueue_scripts', 'theme_add_scripts');
add_action('enqueue_block_editor_assets', 'theme_add_scripts');

function theme_add_scripts()
{
  wp_enqueue_style('swiper', assets('/libs/swiper/swiper.css'), ver: VERSION);
  wp_enqueue_style('main', assets('/styles/main.css'), ver: VERSION);
  wp_enqueue_style('benefits', get_template_directory_uri() . '/blocks/benefits/benefits.css', ver: VERSION);
  wp_enqueue_style('partners', get_template_directory_uri() . '/blocks/partners/partners.css', ver: VERSION);
  wp_enqueue_style('catalog-card', get_template_directory_uri() . '/blocks/catalog-card/catalog-card.css', ver: VERSION);

  wp_enqueue_script('swiper', assets('/libs/swiper/swiper.js'), ver: VERSION);
  wp_enqueue_script_module('partners', get_template_directory_uri() . '/blocks/partners/partners.js', ['wp-data', 'wp-editor', 'wp-edit-post'], version: VERSION);
  wp_enqueue_script_module('main', assets('/scripts/main.js'), version: VERSION);
}
