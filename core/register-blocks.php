<?php

function register_blocks()
{
  register_block_type(__DIR__ . '/../components/button');
  register_block_type(__DIR__ . '/../components/section');
  register_block_type(__DIR__ . '/../blocks/benefits');
  register_block_type(__DIR__ . '/../blocks/partners');
  register_block_type(__DIR__ . '/../blocks/catalog-card');
  register_block_type(__DIR__ . '/../blocks/grid');
  register_block_type(__DIR__ . '/../blocks/grid-item');
}

add_action('init', 'register_blocks');
