class Grid {
  selectors = {
    toggleButtonSelector: '[data-grid-toggle]',
    listSelector: '[data-grid-list]',
  }

  /**
   * @param {HTMLElement} gridElement 
   */
  constructor(gridElement) {
    this.rootElement = gridElement;
    /** @type {HTMLElement[]} */
    this.toggleButtons = this.rootElement.querySelectorAll(this.selectors.toggleButtonSelector);
    /** @type {HTMLElement} */
    this.listElement = this.rootElement.querySelector(this.selectors.listSelector);

    this.bindEvents();
  }

  /**
   * 
   * @param {Event} 
   */
  toggleLayoutHandler = ({ target }) => {
    this.toggleButtons.forEach((button) => {
      button.classList.remove('is-active');
    });

    if (!(target instanceof HTMLElement)) {
      return;
    }

    target.classList.add('is-active');

    const columnCount = target.dataset.gridToggle;
    if (!columnCount) {
      this.listElement.className = 'grid__list';
      return;
    }

    this.listElement.className = `grid__list grid__list--${columnCount}`;
  }

  bindEvents() {
    this.toggleButtons.forEach((button) => {
      button.addEventListener('click', this.toggleLayoutHandler);
    });
  }
}

const initGrids = () => {
  const grids = document.querySelectorAll('[data-grid]');
  grids.forEach(grid => {
    if (!grid.dataset.gridReady) {
      new Grid(grid);
      grid.dataset.gridReady = 'true';
    }
  });
};

window.addEventListener('DOMContentLoaded', initGrids);

function waitForBodyAndObserve() {
  if (!document.body) {
    requestAnimationFrame(waitForBodyAndObserve);
    return;
  }

  const observer = new MutationObserver(() => initGrids());
  observer.observe(document.body, { childList: true, subtree: true });
}

waitForBodyAndObserve();
