<?php

$title = $block['label'] ?? get_field('label') ?? 'Заголовок';

$query = new WP_Query([
  'post_type' => 'partner',
  'posts_per_page' => -1,
  'fields' => 'ids',
]);

$ids = $query->posts;

?>

<div class="partners" data-partners>
  <div class="partners__header">
    <h2 class="partners__title h2"><?= $title ?></h2>
  </div>
  <div class="partners__slider swiper" data-partners-slider>
    <ul class="partners__slider-list swiper-wrapper">

      <?php foreach ($ids as $id): ?>

        <li class="partners__slider-item swiper-slide">

          <div class="partners__slider-item-content">
            <div class="partners__slider-item-header">
              <h3 class="partners__slider-item-title h3"><?= get_the_title($id) ?></h3>
              <h4 class="partners__slider-item-subtitle h4"><?= get_field('subtitle', $id) ?></h4>
            </div>
            <div class="partners__slider-item-description">
              <span class="h4">Описание:</span>
              <div class="partners__slider-item-description-content h5">
                <?= get_field('description', $id) ?>
              </div>
            </div>
            <div class="partners__slider-item-footer">
              <div class="partners__slider-item-buttons">
                <?= render_block([
                  'blockName' => 'tergos/button',
                  'attrs' => [
                    'icon' => 'arrow-left',
                    'className' => 'square',
                    'classes' => [
                      'partners__slider-item-button-prev',
                    ]
                  ]
                ]) ?>
                <?= render_block([
                  'blockName' => 'tergos/button',
                  'attrs' => [
                    'icon' => 'arrow-right',
                    'className' => 'square',
                    'classes' => [
                      'partners__slider-item-button-next',
                    ],
                  ]
                ]) ?>
              </div>
              <div class="partners__slider-item-pagination h6"></div>
            </div>

          </div>

          <div class="partners__slider-item-image">
            <?= wp_get_attachment_image(get_field('image', $id), [592, 420]) ?>
          </div>

        </li>

      <?php endforeach ?>
    </ul>
  </div>
</div>
