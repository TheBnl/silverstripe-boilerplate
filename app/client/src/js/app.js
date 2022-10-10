"use strict";

import { initForms } from "./modules/forms";
import { initNavigation } from "./modules/navigation";
import { initScrollTo, scrollTo } from "./modules/scrollTo";
import { initGallerySwiper, initActionCardsSwiper } from './modules/swiper';
// import { initGallery } from './modules/gallery';
// import { initVideo } from "./modules/video";

{
  initForms();
  initNavigation();
  initScrollTo();
  initActionCardsSwiper();
  // initVideo();
  // initGallery();
  // initGallerySwiper();
}
