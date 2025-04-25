<?php

$template = [
  ['core/paragraph', ['content' => 'Колонка 2']]
];

?>

<li class="grid__item">
  <InnerBlocks template="<?= esc_attr(wp_json_encode($template)) ?>" />
</li>
