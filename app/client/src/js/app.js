import $ from 'jquery';
import { initForms } from './modules/forms';
import { initNavigation } from './modules/navigation';
import { initFontAwesome } from './modules/fontAwesome';


(($) => {
  'use strict';

  // If Foundation modules are installed uncomment this line
  //$(document).foundation();

  $(document).ready(() => {
    initForms();
    initNavigation();
    initFontAwesome();
  });

})(jQuery);
