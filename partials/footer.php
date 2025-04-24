<?php

$company_name = get_acf_option('company_name');
$inn = get_acf_option('inn');
$kpp = get_acf_option('kpp');

/** @var array{address: string, link: string} */
$address = get_acf_option('address');
$address_value = $address['address'];
$address_link = $address['link'];

$phone_number = get_acf_option('phone_number');
$tel = preg_replace('/\D+/', '', $phone_number);
$email = get_acf_option('email');

/** @var array{array{label: string, link: string}} */
$socials = get_acf_option('socials');

?>

<footer class="footer">
  <div class="footer__inner container">

    <div class="footer__top">

      <nav class="footer__top-nav">

        <div class="footer__top-group footer__top-group--width100-on-mobile">
          <div class="footer__top-group-title">
            <div class="footer__logo">
              <?= get_logo_svg_src() ?>
            </div>
          </div>
          <ul class="footer__top-group-list">
            <li class="footer__top-group-item footer__top-group-item--xl">
              <a href="tel:<?= $tel ?>" class="footer__top-group-link"><?= $phone_number ?></a>
            </li>
            <li class="footer__top-group-item footer__top-group-item--xl">
              <a href="mailto:<?= $email ?>" class="footer__top-group-link"><?= $email ?></a>
            </li>
          </ul>
        </div>

        <?php if ($socials): ?>

          <div class="footer__top-group">
            <div class="footer__top-group-title">
              СОЦИАЛЬНЫЕ СЕТИ
            </div>
            <ul class="footer__top-group-list">
              <?php foreach ($socials as $social): ?>
                <li class="footer__top-group-item">
                  <a href="<?= $social['link'] ?>" class="footer__top-group-link"><?= $social['label'] ?></a>
                </li>
              <?php endforeach ?>
            </ul>
          </div>

        <?php endif; ?>

        <div class="footer__top-group">
          <div class="footer__top-group-title">
            АДРЕС
          </div>
          <ul class="footer__top-group-list">
            <li class="footer__top-group-item footer__top-group-item--l">
              <?php if ($address_link): ?>

                <a href="<?= $address_link ?>" class="footer__top-group-link"><?= $address_value ?></a>

              <?php else: ?>

                <span class="footer__top-group-link"><?= $address_value ?></span>

              <?php endif ?>
            </li>
          </ul>
        </div>

      </nav>

      <div class="footer__top-extra">
        <div class="footer__top-extra-item">
          <div class="footer__top-extra-name"><?= $company_name ?></div>
        </div>
        <div class="footer__top-extra-item">
          <div class="footer__top-extra-inn"><?= $inn ? "ИНН: $inn" : '' ?></div>
          <div class="footer__top-extra-kpp"><?= $kpp ? "КПП: $kpp" : '' ?></div>
        </div>
        <div class="footer__top-extra-item footer__top-extra-item--order-2-on-mobile">
          <a class="footer__top-extra-policy" href="#">Политика конфиденциальности</a>
        </div>
      </div>

    </div>

    <div class="footer__middle">
      <p class="footer__title">ТЕРГОС ГРУПП</p>
    </div>

    <div class="footer__bottom">
      <div class="footer__copyright">
        © «Тегрос» 2009-2025 
      </div>
      <div class="footer__author">
        Разработка сайта
      </div>
    </div>

  </div>

</footer>

<?php wp_footer() ?>
</body>

</html>
