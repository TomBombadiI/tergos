<?php

$href = $block['href'] ?? get_field('href');
$label = $block['label'] ?? get_field('label');
$icon = $block['icon'] ?? get_field('icon');
$icon_src = assets_path("/icons/{$icon}.svg");

$tag_name = $href ? 'a' : 'button';

$classes = [
  add_class_modificator('_button', $block['className'] ?? ''),
];

if (!empty($block['backgroundColor'])) {
  $classes[] = 'has-background';
  $classes[] = 'has-' . $block['backgroundColor'] . '-background-color';
}

if (!empty($block['textColor'])) {
  $classes[] = 'has-text-color';
  $classes[] = 'has-' . $block['textColor'] . '-color';
}

$classes = array_merge($classes, $block['classes'] ?? []);

$class_names = implode(' ', array_filter($classes));

?>

<<?= $tag_name ?>
  <?= $href ? "href=$href" : 'type="button"' ?>
  class="<?= $class_names ?>"

  >

  <?= $label ?>

  <?php if (file_exists($icon_src)): ?>
    <span class="icon">
      <?= file_get_contents($icon_src) ?>
    </span>
  <?php endif; ?>

</<?= $tag_name ?>>
