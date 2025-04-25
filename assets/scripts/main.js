import fitTextToContainer from './utils/fitTextToContainer.js';

/** @type {HTMLElement} */
const footerTitleElement = document.querySelector('.footer__title');

if (footerTitleElement) {
  fitTextToContainer(footerTitleElement, { maxSize: 168, minSize: 44 });
}
