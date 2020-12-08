import jquery from 'jquery';
window.jQuery = jquery;
window.$ = jquery;
window.jquery = jquery;
import 'jquery-validation';
import { initForms } from './modules/forms';
import { initNavigation } from './modules/navigation';
import { initFontAwesome } from './modules/fontAwesome';
import { initScrollTo, scrollTo } from './modules/scrollTo';
// import { initGallerySwiper } from './modules/swiper';
// import { initGallery } from './modules/gallery';
// import { initVideo } from './modules/video';
import { OffCanvas } from 'foundation-sites';

{
  'use strict';

  // If Foundation modules are installed uncomment this line
  $(document).foundation();
  initForms();
  initNavigation();
  initFontAwesome();
  initScrollTo();
  // initVideo();
  // initGallery();
  // initGallerySwiper();
}
