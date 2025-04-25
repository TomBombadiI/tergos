<?php

$popup_id = $block['popup_id'] ?? get_field('popup_id');
$title = $block['label'] ?? get_field('label') ?? 'Заголовок';

?>

<dialog class="popup<?= $is_preview ? ' is-preview' : '' ?>" data-popup="<?= $popup_id ?>">
  <div class="popup__wrapper">

    <div class="popup__header">
      <div class="popup__title">
        <?= $title ?>
      </div>

      <button type="button" class="popup__close-button" data-popup-close>
        <svg xmlns="http://www.w3.org/2000/svg" height="44px" viewBox="0 -960 960 960" width="44px" fill="currentColor">
          <path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z" />
        </svg>
      </button>
    </div>

    <InnerBlocks />

  </div>
</dialog>
