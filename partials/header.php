<!DOCTYPE html>
<html lang="ru">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= wp_title() ?></title>
    <?php wp_head() ?>
  </head>

  <body>

    <header class="header">
      <div class="header__inner container">
        <div class="header__logo">
          <?= get_logo_svg_src() ?>
        </div>
        <div class="header__button">
          <?= render_block([
            'blockName' => 'tergos/button',
            'attrs' => [
              'label' => 'Связаться с нами',
              'className' => 'transparent',
              'popup' => 'feedback-popup'
            ]
          ]) ?>
        </div>
      </div>
    </header>
