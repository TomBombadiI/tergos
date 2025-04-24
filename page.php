<?php

get_template_part('partials/header');

while (have_posts()):
  the_post();
  the_content();
endwhile;

get_template_part('partials/footer');
