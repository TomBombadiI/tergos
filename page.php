<?php get_template_part('partials/header'); ?>

<main class="content">

  <?php

  while (have_posts()):
    the_post();
    the_content();
  endwhile;

  ?>

</main>

<?php get_template_part('partials/footer');
