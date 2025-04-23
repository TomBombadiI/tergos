import Modal from './Modal.js';

class OverlayMenu {
    constructor(overlayContainer, options = {}) {
        this.headerElement = document.querySelector(overlayContainer);
        if (!this.headerElement) {
            console.error(`Элемент ${overlayContainer} не найден!`);
            return;
        }

        this.overlayElement = this.headerElement.querySelector(options.overlaySelector ?? '[data-js-overlay]');
        this.burgerButtonElement = this.headerElement.querySelector(options.burgetButtonSelector ?? '[data-js-overlay-burger-button]');
        this.links = this.headerElement.querySelectorAll('a[href]');

        this.animationDuration = options.animationDuration ?? 200;

        this.bindEvents();
    }

    onBurgerButtonClick = () => {
        this.toggleOverlay();
    }

    bindEvents() {
        this.burgerButtonElement.addEventListener('click', this.onBurgerButtonClick);
        this.links.forEach(link => link.addEventListener('click', () => this.closeOverlay()));
    }

    toggleOverlay() {
        this.burgerButtonElement.classList.toggle('is-active');
        document.documentElement.classList.toggle('is-lock');

        if (this.overlayElement.open) {
            this.overlayElement.classList.toggle('is-active');
            setTimeout(() => {
                this.overlayElement.open = !this.overlayElement.open;
            }, this.animationDuration);
        } else {
            this.overlayElement.open = !this.overlayElement.open;
            setTimeout(() => {
                this.overlayElement.classList.toggle('is-active');
            }, 0);
        }
    }

    closeOverlay() {
        this.burgerButtonElement.classList.remove('is-active');
        document.documentElement.classList.remove('is-lock');

        this.overlayElement.classList.remove('is-active');
        setTimeout(() => {
            this.overlayElement.open = false;
        }, this.animationDuration);
    }

    openOverlay() {
        this.burgerButtonElement.classList.add('is-active');
        document.documentElement.classList.add('is-lock');

        this.overlayElement.open = true;
        setTimeout(() => {
            this.overlayElement.classList.add('is-active');
        }, 0);
    }
}
new OverlayMenu('[data-js-overlay-container]');

const headerElement = document.querySelector('header');
const toggleHeader = () => {
    if (window.scrollY > 10) {
        headerElement.classList.add('has-scroll');
    } else {
        headerElement.classList.remove('has-scroll');
    }
}

toggleHeader();
document.addEventListener('scroll', () => {
    toggleHeader();
});

const knowledgeModal = new Modal('#knowledge-modal', {
    animationDuration: 400,
});

new Modal('#policy-modal', {
    animationDuration: 400,
});

const animationElements = document.querySelectorAll('.animation');
const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('animation-end');
            observer.unobserve(entry.target);
        }
    });
}, {
    threshold: 0.1,
});

animationElements.forEach(element => {
    observer.observe(element);

    const animationDelay = element.dataset.animationDelay ?? 0;
    element.style.transitionDelay = animationDelay + 'ms';
})

const sections = document.querySelectorAll('footer[id],section[id]');
const menuLinks = document.querySelectorAll('.header__menu-link');

const observerMenu = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            const id = entry.target.id;

            menuLinks.forEach(link => link.classList.remove('is-active'));

            const activeLink = document.querySelector(`.header__menu-link[href="#${id}"]`);
            if (activeLink) activeLink.classList.add('is-active');
        }
    });
}, {
    rootMargin: '-50% 0px -50% 0px', // срабатывание, когда секция в середине экрана
    threshold: 0
});

sections.forEach(section => observerMenu.observe(section));

/**
 * Получает пост по id из кастомного типа
 *
 * @param {number} id - ID поста
 * @param {string} type - Тип поста (например, 'product')
 * @returns {Promise<{title: string, content: string, thumbnail: string|null}>}
 */
async function getPostById(id, type = 'product') {
    const apiUrl = `/wp-json/wp/v2/${type}/${id}?_embed`;

    const response = await fetch(apiUrl);

    if (!response.ok) {
        throw new Error('Пост не найден');
    }

    const post = await response.json();

    return {
        title: post.title.rendered,
        content: post.content.rendered,
        thumbnail: post._embedded?.['wp:featuredmedia']?.[0]?.source_url || null,
    };
}

const knowledgeImageElement = document.getElementById('knowledge-image');
const knowledgeTitleElement = document.getElementById('knowledge-title');
const knowledgeTextElement = document.getElementById('knowledge-text');

const productElements = document.querySelectorAll('[data-product-id]');
productElements.forEach((element) => {
    element.addEventListener('click', async () => {
        element.querySelector('.knowledge__item-image').classList.add('loading');

        const productId = element.dataset.productId;

        const product = await getPostById(productId);

        console.log(product.thumbnail);

        knowledgeImageElement.src = product.thumbnail;
        knowledgeTitleElement.innerText = product.title;
        knowledgeTextElement.innerHTML = product.content;

        knowledgeModal.open();

        element.querySelector('.knowledge__item-image').classList.remove('loading');
    });
});
