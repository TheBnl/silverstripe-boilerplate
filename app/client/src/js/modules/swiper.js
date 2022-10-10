import Swiper from 'swiper/dist/js/swiper.js';
import imagesLoaded from 'imagesloaded';

export const initGallerySwiper = function() {
  if (!document.querySelector('.gallery')) {
    return;
  }

  imagesLoaded('.gallery', function () {
    const GallerySwiper = new Swiper('.gallery', {
      autoplay: {
        delay: 5000,
      },
      slidesPerView: 2,
      breakpointsInverse: true,
      breakpoints: {
        640: {
          slidesPerView: 3
        }
      }
    });
  });
};

export const initActionCardsSwiper = function() {
  if (!document.querySelector('.action-cards-swiper')) {
    return;
  }

  imagesLoaded('.action-cards-swiper', function () {
    const ActionCardsSwiper = new Swiper('.action-cards-swiper', {
      slidesPerView: 1,
      spaceBetween: 18,
      breakpointsInverse: true,
      breakpoints: {
        640: {
          spaceBetween: 24,
          slidesPerView: 2
        },
        1024: {
          spaceBetween: 36,
          slidesPerView: 3
        }
      },
      autoplay: {
        delay: 5000
      },
      navigation: {
        prevEl: '.action-cards-swiper__nav-button--prev',
        nextEl: '.action-cards-swiper__nav-button--next'
      },
      pagination: {
        el: '.action-cards-swiper__pagination',
        type: 'bullets',
        clickable: true
      }
    });
  });
};