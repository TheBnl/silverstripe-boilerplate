const hamburger = $('.hamburger');

export const initNavigation = function() {
  hamburger.on('click', openNavigation);
  $(window).on('opened.zf.offCanvas', openNavigation);
  $(window).on('close.zf.offCanvas', closeNavigation);
};

function openNavigation() {
  hamburger.addClass('is-active');
}

function closeNavigation() {
  hamburger.removeClass('is-active');
}
