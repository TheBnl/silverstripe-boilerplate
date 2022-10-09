const hamburger = document.querySelector('.hamburger');

export const initNavigation = function() {
  hamburger.addEventListener('click', openNavigation);
};

function openNavigation() {
  hamburger.classList.add('is-active');
}

function closeNavigation() {
  hamburger.classList.remove('is-active');
}
