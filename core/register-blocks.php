<?php

function register_blocks()
{
  register_block_type(__DIR__ . '/../components/button');
  register_block_type(__DIR__ . '/../components/section');
  register_block_type(__DIR__ . '/../blocks/grid');
  register_block_type(__DIR__ . '/../blocks/grid-item');
  register_block_type(__DIR__ . '/../blocks/catalog-card');
}

add_action('init', 'register_blocks');
