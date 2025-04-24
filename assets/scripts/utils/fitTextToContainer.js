/**
 * Подбирает максимально возможный размер шрифта, чтобы текст влез в контейнер по ширине.
 * 
 * @param {HTMLElement} element - Элемент с текстом
 * @param {Object} [options] - Настройки
 * @param {number} [options.maxSize=100] - Максимальный размер шрифта в px
 * @param {number} [options.minSize=10] - Минимальный размер шрифта в px
 */
const fitTextToContainer = (element, { maxSize = 100, minSize = 10 } = {}) => {
  const parent = element.parentElement;
  if (!parent) return;

  const resize = () => {
    let fontSize = maxSize;
    element.style.fontSize = fontSize + 'px';

    // Уменьшаем шрифт, пока не влезает
    while (fontSize > minSize && element.scrollWidth > parent.clientWidth) {
      fontSize -= 1;
      element.style.fontSize = fontSize + 'px';
    }
  };

  // Наблюдаем за изменениями размеров родителя
  const observer = new ResizeObserver(resize);
  observer.observe(parent);

  resize();

  return () => observer.disconnect();
}

export default fitTextToContainer;
