<?php

function register_blocks()
{
  register_block_type(__DIR__ . '/../components/button');
}

add_action('init', 'register_blocks');
