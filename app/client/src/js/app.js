// import jquery from 'jquery';
// window.jQuery = jquery;
// window.$ = jquery;
// window.jquery = jquery;
// import 'jquery-validation';
import { initForms } from './modules/forms';
import { initNavigation } from './modules/navigation';
// import { initFontAwesome } from './modules/fontAwesome';
import { initScrollTo, scrollTo } from './modules/scrollTo';
import { initBannerSwiper } from './modules/swiper';
// import { initGallery } from './modules/gallery';
// import { initVideo } from './modules/video';

{
  'use strict';

  initForms();
  initNavigation();
  // initFontAwesome();
  initScrollTo();
  initBannerSwiper();
  // initVideo();
  // initGallery();
  // initGallerySwiper();
}
