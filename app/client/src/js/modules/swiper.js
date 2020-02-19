import Swiper from 'swiper';
import imagesLoaded from 'imagesloaded';

export const initGallerySwiper = function() {
  imagesLoaded('.gallery', function () {
    const GallerySwiper = new Swiper('.gallery', {
      autoplay: {
        delay: 3000,
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

