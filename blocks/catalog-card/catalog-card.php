<?php

$thumbnail_id = $block['thumbnail'] ?? get_field('thumbnail') ?? '';
$thumbnail_src = $thumbnail_id
  ? wp_get_attachment_image_src($thumbnail_id, [390, 270])['0']
  : assets('/images/catalog-card.png');

$label = $block['label'] ?? get_field('label') ?? 'Заголовок';
$link = $block['link'] ?? get_field('link') ?? '#';
$title_level = $block['title_level'] ?? get_field('title_level') ?? 'h3';

?>

<div class="catalog-card">
  <div class="catalog-card__image">
    <img width="390" height="270" src="<?= $thumbnail_src ?>" alt="<?= $label ?>">
  </div>
  <<?= $title_level ?> class="catalog-card__title h3"><?= $label ?></<?= $title_level ?>>

  <?php if ($link): ?>
    <a href="<?= $link ?>" class="catalog-card__more-link">
      Подробнее+
    </a>
  <?php endif ?>
</div>
