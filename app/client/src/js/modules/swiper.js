import Swiper from 'swiper/dist/js/swiper.js';
import imagesLoaded from 'imagesloaded';

export const initBannerSwiper = function() {

  if( $('.banners__container .banner').length <= 1 ) return;

  imagesLoaded('.banners__container', function () {
    const BannersSwiper = new Swiper('.banners__container', {
      breakpointsInverse: true,
      breakpoints: {
        640: {}
      },
      autoplay: {
        delay: 4500
      },
      loop: true,
      effect: 'slide',
      fadeEffect: {
        crossFade: true
      },
      speed: 1000,
      pagination: {
        el: '.banners__pagination',
        type: 'bullets',
        clickable: true
      }
    });
  });
};

