<?php

$allowed_blocks = ['tergos/grid-item'];
$template = [
  [
    'tergos/grid-item',
    [],
    [
      ['core/paragraph', ['content' => 'Колонка 1']]
    ]
  ],
  [
    'tergos/grid-item',
    [],
    [
      ['core/paragraph', ['content' => 'Колонка 2']]
    ]
  ],
  [
    'tergos/grid-item',
    [],
    [
      ['core/paragraph', ['content' => 'Колонка 3']]
    ]
  ],
];

?>

<div class="grid" data-grid>

  <div class="grid__controls">
    <button type="button" class="grid__control" data-grid-toggle="2">
      <?= get_svg_source('grid2') ?>
    </button>
    <button type="button" class="grid__control is-active" data-grid-toggle>
      <?= get_svg_source('grid3') ?>
    </button>
  </div>

  <ul class="grid__list" data-grid-list>

    <InnerBlocks allowedBlocks="<?= esc_attr(wp_json_encode($allowed_blocks)) ?>"
                 template="<?= esc_attr(wp_json_encode($template)) ?>" />

  </ul>
</div>
