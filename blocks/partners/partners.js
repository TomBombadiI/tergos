import whenIsReady from "../../assets/scripts/utils/whenIsReady.js";
import Swiper from '../../assets/libs/swiper/swiper.min.mjs';
import effectFade from '../../assets/libs/swiper/modules/effect-fade.min.mjs';
import Navigation from '../../assets/libs/swiper/modules/navigation.min.mjs';
import Pagination from '../../assets/libs/swiper/modules/pagination.min.mjs';

await whenIsReady();

/** @type {HTMLElement[]} */
const partners = document.querySelectorAll('[data-partners]');
partners.forEach(partner => {
  new Swiper(partner.querySelector('[data-partners-slider]'), {
    effect: 'fade',
    loop: true,
    modules: [effectFade, Navigation, Pagination],
    navigation: {
      nextEl: ".partners__slider-item-button-next",
      prevEl: ".partners__slider-item-button-prev",
    },
    pagination: {
      el: ".partners__slider-item-pagination",
      type: "fraction",
    },
    on: {
      paginationRender(swiper) {
        const current = String(swiper.realIndex + 1).padStart(2, '0');
        const realSlides = [...swiper.slidesEl.children].filter(
          el => !el.classList.contains('swiper-slide-duplicate')
        );

        const total = String(realSlides.length).padStart(2, '0');

        const html = `
          <span class="swiper-pagination-current">${current}</span> /
          <span class="swiper-pagination-total">${total}</span>
        `;

        const allPaginations = partner.querySelectorAll('.partners__slider-item-pagination');
        allPaginations.forEach(el => {
          el.innerHTML = html;
        });
      }
    },
    breakpoints: {
      1023: {
        allowTouchMove: false,
      }
    }
  });
});
