'use strict';

let js_dir = 'javascript',
    third_party_dir = 'javascript/thirdparty',
    foundation_dir = 'node_modules/foundation-sites/js',
    userforms_third_party_dir = '../userforms/thirdparty';

module.exports = {
    BUNDLE: [
        third_party_dir + '/jquery/dist/jquery.min.js',
        third_party_dir + '/lazyloadxt/dist/jquery.lazyloadxt.min.js',
        third_party_dir + '/Swiper/dist/js/swiper.jquery.min.js',
        userforms_third_party_dir + '/jquery-validate/jquery.validate.min.js',
        js_dir + '/app/**/*.js'
    ]
};
