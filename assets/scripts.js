/* eslint-disable no-param-reassign, camelcase, no-undef, max-len */
const storeData = (key, expire) => localStorage.setItem(key, JSON.stringify({ time: new Date().getTime(), expire }));
const fetchData = (key) => JSON.parse(localStorage.getItem(key));

const a11yFocusTrap = (e, focusableElements) => {
  const firstFocusableElement = focusableElements[0];
  const lastFocusableElement = focusableElements[focusableElements.length - 1];
  // On key down on first element, if it's a Shift+Tab, redirect to last element
  if (firstFocusableElement === e.target && e.code === 'Tab' && e.shiftKey) {
    e.preventDefault();
    lastFocusableElement.focus();
  }
  // On key down on last element, if it's a Tab, redirect to first element
  if (lastFocusableElement === e.target && e.code === 'Tab' && !e.shiftKey) {
    e.preventDefault();
    firstFocusableElement.focus();
  }
};

const filterNonValidTabableItems = (items, filterHidden = false) => {
  let filteredItems;
  filteredItems = [...items].filter((el) => !el.hasAttribute('disabled'));
  if (filterHidden) {
    filteredItems = [...filteredItems].filter((el) => !!(el.offsetWidth || el.offsetHeight || el.getClientRects().length));
  }

  return filteredItems;
};

const popUps = document.querySelectorAll('.air-pop-up');
const allFocusableElements = filterNonValidTabableItems(document.querySelectorAll(
  '[tabindex]:not([tabindex="-1"]), a, button, input, textarea, select, details',
), true);

const firstFocusableElement = allFocusableElements[0];

popUps.forEach((popUp) => {
  const { popUpId } = popUp.dataset;
  const popUpData = pop_up_data[popUpId];
  const clickableElements = popUp.querySelectorAll('.pop-up-close');
  // popUp.querySelector('.pop-up-content').setAttribute('tabindex', 0);
  const focusableElements = filterNonValidTabableItems(popUp.querySelectorAll(
    '[tabindex]:not([tabindex="-1"]), a, button, input, textarea, select, details',
  ));

  setTimeout(() => {
    const currentFocusedElement = document.activeElement;

    // Focus trap
    focusableElements.forEach((focusableElement) => {
      focusableElement.addEventListener('keydown', (e) => {
        a11yFocusTrap(e, focusableElements);
      });
    });

    // Popup - session
    if (popUpData.show_again === 'session') {
      if (sessionStorage.getItem(popUpId) !== 'true') {
        popUp.classList.add('visible');
      }

      clickableElements.forEach((clickableElement) => {
        clickableElement.addEventListener('click', () => {
          sessionStorage.setItem(popUpId, true);
          popUp.classList.remove('visible');

          if (currentFocusedElement.matches('body')) {
            firstFocusableElement.focus();
          } else {
            currentFocusedElement.focus();
          }
        });
      });

      // Allow closing with esc
      popUp.addEventListener('keydown', (keydownMouseoverEvent) => {
        if (keydownMouseoverEvent.key === 'Escape') {
          sessionStorage.setItem(popUpId, true);
          popUp.classList.remove('visible');

          if (currentFocusedElement.matches('body')) {
            firstFocusableElement.focus();
          } else {
            currentFocusedElement.focus();
          }
        }
      });
    }

    // Popup - never
    if (popUpData.show_again === 'never') {
      if (localStorage.getItem(popUpId) !== 'true') {
        popUp.classList.add('visible');
      }

      clickableElements.forEach((clickableElement) => {
        clickableElement.addEventListener('click', () => {
          localStorage.setItem(popUpId, true);
          popUp.classList.remove('visible');

          if (currentFocusedElement.matches('body')) {
            firstFocusableElement.focus();
          } else {
            currentFocusedElement.focus();
          }
        });
      });

      // Allow closing with esc
      popUp.addEventListener('keydown', (keydownMouseoverEvent) => {
        if (keydownMouseoverEvent.key === 'Escape') {
          localStorage.setItem(popUpId, true);
          popUp.classList.remove('visible');

          if (currentFocusedElement.matches('body')) {
            firstFocusableElement.focus();
          } else {
            currentFocusedElement.focus();
          }
        }
      });
    }

    // Popup - timed
    if (popUpData.show_again === 'timed') {
    // Clear possible never item
      if (localStorage.getItem(popUpId) === 'true') {
        localStorage.removeItem(popUpId);
      }

      const storedItem = fetchData(popUpId);

      if (!storedItem) {
        popUp.classList.add('visible');
      }

      if (storedItem && new Date().getTime() - storedItem.time >= storedItem.expire) {
        popUp.classList.add('visible');
      }

      clickableElements.forEach((clickableElement) => {
        clickableElement.addEventListener('click', () => {
          storeData(popUpId, popUpData.timed_time * 1000);
          popUp.classList.remove('visible');

          if (currentFocusedElement.matches('body')) {
            firstFocusableElement.focus();
          } else {
            currentFocusedElement.focus();
          }
        });
      });

      // Allow closing with esc
      popUp.addEventListener('keydown', (keydownMouseoverEvent) => {
        if (keydownMouseoverEvent.key === 'Escape') {
          storeData(popUpId, popUpData.timed_time * 1000);
          popUp.classList.remove('visible');

          if (currentFocusedElement.matches('body')) {
            firstFocusableElement.focus();
          } else {
            currentFocusedElement.focus();
          }
        }
      });
    }

    focusableElements[0].focus();
  }, popUpData.delay * 1000);
});
