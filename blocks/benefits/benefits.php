<?php

$title = $block['label'] ?? get_field('label') ?? 'Заголовок';
/** @var array{array{description: string}} */
$items = $block['items'] ?? get_field('items') ?? [
  ['description' => 'Элемент 1'],
  ['description' => 'Элемент 2'],
  ['description' => 'Элемент 3'],
  ['description' => 'Элемент 4']
];

?>

<div class="benefits">
  <h2 class="benefits__title h2"><?= $title ?></h2>
  <ul class="benefits__list">

    <?php foreach ($items as $index => $item): ?>
      <li class="benefits__item">
        <div class="benefits__item-dots">

          <?php for ($i = 0; $i < count($items); $i++): ?>
            <span class="benefits__item-dot<?= $index === $i ? ' is-active' : '' ?>"></span>
          <?php endfor ?>
        </div>
        <div class="benefits__item-label h3"><?= $item['description'] ?></div>
      </li>
    <?php endforeach ?>

  </ul>
</div>
