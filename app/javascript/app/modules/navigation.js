/**
 * Toggle the active class on the hamburger
 * Set navigation and navigationActive strings to your used classes
 */
export const initNavigation = function() {
  let hamburger = $('.c-hamburger');
  let navigation = $('.your-nav-class');
  let navigationActive = 'your-nav-class--active';

  hamburger.on('click', () => {
    hamburger.toggleClass('is-active');
    navigation.toggleClass(navigationActive);
  });
};