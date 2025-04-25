<?php

add_action('init', 'register_post_types');

function register_post_types()
{

  register_post_type('partner', [
    'labels' => [
      'name' => 'Партнеры',
      'singular_name' => 'Партнер', // название для одной записи этого типа
      'add_new' => 'Добавить партнера', // для добавления новой записи
      'add_new_item' => 'Добавление партнера', // заголовка у вновь создаваемой записи в админ-панели.
      'edit_item' => 'Редактирование партнера', // для редактирования типа записи
      'new_item' => 'Новый партнер', // текст новой записи
      'view_item' => 'Смотреть партнера', // для просмотра записи этого типа.
      'search_items' => 'Искать партнеров', // для поиска по этим типам записи
      'not_found' => 'Не найдено партнеров', // если в результате поиска ничего не было найдено
    ],
    'public' => true,
    'menu_icon' => 'dashicons-groups',
    'supports' => ['title'], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
    'rewrite' => true,
    'query_var' => true,
  ]);

}
