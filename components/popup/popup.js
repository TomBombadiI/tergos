class Popup {
  static activePopup = null;

  constructor(element, options = {}) {
    this.dialog = element;
    if (!this.dialog) {
      console.warn(`Модальное окно не найдено`);
      return;
    };

    this.popupId = this.dialog.dataset.popup;

    this.options = {
      closeOnClickOutside: options.closeOnClickOutside ?? true,
      closeOnEscape: options.closeOnEscape ?? true,
      animationDuration: options.animationDuration ?? 200,
      selectorCloseButton: options.selectorCloseButton ?? "[data-popup-close]",
      lockScrollClass: options.lockScrollClass ?? "is-lock",
      onOpen: options.onOpen ?? (() => { }),
      onClose: options.onClose ?? (() => { }),
      autoOpen: options.autoOpen ?? this.dialog.hasAttribute("data-popup-auto-open") ?? false,
    };

    this.init();
  }

  init() {
    document.documentElement.style.setProperty("--modal-animation-duration", this.options.animationDuration + "ms");
    document.documentElement.style.setProperty("--scrollbar-width", Popup.getScrollBarWidth() + 'px');

    this.dialog.querySelector(this.options.selectorCloseButton)?.addEventListener("click", () => {
      this.close();
    });

    if (this.options.closeOnClickOutside) {
      this.dialog.addEventListener("mousedown", (event) => {
        if (event.button === 0 && event.target === this.dialog) {
          this.close();
        }
      });
    }

    if (this.options.closeOnEscape) {
      document.addEventListener("keydown", (event) => {
        if (event.key === "Escape" && this.dialog.open) {
          this.close();
        }
      });
    }

    document.querySelectorAll(`[data-popup-target="${this.popupId}"]`).forEach(button => {
      button.addEventListener("click", () => {
        this.open();
      });
    });

    if (this.options.autoOpen) {
      this.open();
    }
  }

  open() {
    this.dialog.showModal();
    this.dialog.classList.add("open");

    Popup.activePopup = this;

    document.documentElement.classList.add(this.options.lockScrollClass);

    this.options.onOpen();
  }

  close() {
    this.dialog.classList.remove("open");
    this.dialog.classList.add("closing");

    if (Popup.activePopup === this) {
      Popup.activePopup = null;
    }

    document.documentElement.classList.remove(this.options.lockScrollClass);

    setTimeout(() => {
      this.dialog.close();
      this.dialog.classList.remove("closing");
      this.options.onClose();

    }, this.options.animationDuration);
  }

  static alert(message, title = null) {
    return new Promise((resolve) => {
      const id = "modal-alert-" + Date.now();
      const dialog = document.createElement("dialog");
      dialog.classList.add('modal');
      dialog.classList.add('alert-modal');
      dialog.id = id;
      dialog.innerHTML = `
            <div class="modal-wrapper">
              <p class="modal-message">${message}</p>
              <button type="button" class="btn-ok button button--flat modal-closer">OK</button>
            </div>
          `;
      document.body.appendChild(dialog);

      const modal = new Popup(`#${id}`, {
        onClose: () => {
          resolve();
          dialog.remove()
        },
      });

      dialog.querySelector(".btn-ok").addEventListener(
        "click",
        () => {
          modal.close();
          resolve(true);
        },
        { once: true }
      );

      modal.open();
    });
  }

  static confirm(message, title = null) {
    return new Promise((resolve) => {
      const id = "modal-confirm-" + Date.now();
      const dialog = document.createElement("dialog");
      dialog.classList.add('modal');
      dialog.classList.add('alert-modal');
      dialog.classList.add('confirm-modal');
      dialog.id = id;
      dialog.innerHTML = `
            <div class="modal-wrapper">
              <p class="modal-message">${message}</p>
              <div class="modal-buttons">
                <button type="button" class="btn-ok btn-base btn-blue modal-closer">Да</button>
                <button type="button" class="btn-cancel btn-base btn-order modal-closer">Нет</button>
              </div>
            </div>
          `;
      document.body.appendChild(dialog);

      const modal = new Popup(`#${id}`, {
        onClose: () => {
          resolve(false);
          dialog.remove()
        },
      });

      dialog.querySelector(".btn-ok").addEventListener(
        "click",
        () => {
          modal.close();
          resolve(true);
        },
        { once: true }
      );

      dialog.querySelector(".btn-cancel").addEventListener(
        "click",
        () => {
          modal.close();
          resolve(false);
        },
        { once: true }
      );

      modal.open();
    });
  }

  static getScrollBarWidth() {
    return window.innerWidth - document.documentElement.clientWidth;
  }
}

const popups = document.querySelectorAll('[data-popup]');
popups.forEach(popup => {
  new Popup(popup);
})
