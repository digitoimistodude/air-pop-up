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

  const popUpLink = popUp.querySelector('.air-pop-up-link');
  const popUpYes = popUp.querySelector('.air-pop-up-yes');
  const popUpNo = popUp.querySelector('.air-pop-up-no');

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
        airPopUpShow(popUp);
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

      if (popUpLink) {
        popUpLink.addEventListener('click', () => {
          sessionStorage.setItem(popUpId, true);
          airPopUpClick(popUp);
        });
      }

      if (popUpYes) {
        popUpYes.addEventListener('click', () => {
          sessionStorage.setItem(popUpId, true);
          airPopUpYes(popUp);
          popUp.classList.remove('visible');
        });
      }

      if (popUpNo) {
        popUpNo.addEventListener('click', () => {
          sessionStorage.setItem(popUpId, true);
          airPopUpNo(popUp);
          popUp.classList.remove('visible');
        });
      }
    }

    // Popup - never
    if (popUpData.show_again === 'never') {
      if (localStorage.getItem(popUpId) !== 'true') {
        popUp.classList.add('visible');
        airPopUpShow(popUp);
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

      if (popUpLink) {
        popUpLink.addEventListener('click', () => {
          localStorage.setItem(popUpId, true);
          airPopUpClick(popUp);
        });
      }

      if (popUpYes) {
        popUpYes.addEventListener('click', () => {
          localStorage.setItem(popUpId, true);
          airPopUpYes(popUp);
          popUp.classList.remove('visible');
        });
      }

      if (popUpNo) {
        popUpNo.addEventListener('click', () => {
          localStorage.setItem(popUpId, true);
          airPopUpNo(popUp);
          popUp.classList.remove('visible');
        });
      }
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
        airPopUpShow(popUp);
      }

      if (storedItem && new Date().getTime() - storedItem.time >= storedItem.expire) {
        popUp.classList.add('visible');
        airPopUpShow(popUp);
      }

      clickableElements.forEach((clickableElement) => {
        clickableElement.addEventListener('click', (e) => {
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

      if (popUpLink) {
        popUpLink.addEventListener('click', () => {
          storeData(popUpId, popUpData.timed_time * 1000);
          airPopUpClick(popUp);
        });
      }

      if (popUpYes) {
        popUpYes.addEventListener('click', () => {
          storeData(popUpId, popUpData.timed_time * 1000);
          airPopUpYes(popUp);
          popUp.classList.remove('visible');
        });
      }

      if (popUpNo) {
        popUpNo.addEventListener('click', () => {
          storeData(popUpId, popUpData.timed_time * 1000);
          airPopUpNo(popUp);
          popUp.classList.remove('visible');
        });
      }
    }

    focusableElements[0].focus();
  }, popUpData.delay * 1000);
});

function airPopUpShow(element) {
  airPopUpAjax({
    action: 'air_pop_up_show',
    id: element.dataset.popUpId,
  });
}

function airPopUpClick(element) {
  airPopUpAjax({
    action: 'air_pop_up_click',
    id: element.dataset.popUpId,
  });
}

function airPopUpYes(element) {
  airPopUpAjax({
    action: 'air_pop_up_yes',
    id: element.dataset.popUpId,
  });
}

function airPopUpNo(element) {
  airPopUpAjax({
    action: 'air_pop_up_no',
    id: element.dataset.popUpId,
  });
}

function airPopUpAjax(data) {
  const creationTimestamp = pop_up_data[data.id].timestamp;
  const ajaxUrl = pop_up_data[data.id].ajaxUrl;

  data.nonce = pop_up_data[data.id].nonce;
  data.timestamp = creationTimestamp;

  var xhr = new XMLHttpRequest();
  xhr.open('POST', ajaxUrl, true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.send(new URLSearchParams(data).toString());
}