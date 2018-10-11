import fontawesome from '@fortawesome/fontawesome/index';
import faTumblrSquare from '@fortawesome/fontawesome-free-brands/faTumblrSquare';
import faLinkedin from '@fortawesome/fontawesome-free-brands/faLinkedin';
import faSoundcloud from '@fortawesome/fontawesome-free-brands/faSoundcloud';
import faYoutubeSquare from '@fortawesome/fontawesome-free-brands/faYoutubeSquare';
import faFacebookSquare from '@fortawesome/fontawesome-free-brands/faFacebookSquare';
import faTwitterSquare from '@fortawesome/fontawesome-free-brands/faTwitterSquare';
import faEnvelopeSquare from '@fortawesome/fontawesome-free-solid/faEnvelopeSquare';
import faInstagram from '@fortawesome/fontawesome-free-brands/faInstagram';
import faPinterestSquare from '@fortawesome/fontawesome-free-brands/faPinterestSquare';
import faGooglePlusSquare from '@fortawesome/fontawesome-free-brands/faGooglePlusSquare';

/**
 * Add all the fontawesome icons
 */
export const initFontAwesome = function () {
  fontawesome.library.add([
    faTwitterSquare,
    faGooglePlusSquare,
    faInstagram,
    faYoutubeSquare,
    faLinkedin,
    faPinterestSquare,
    faSoundcloud,
    faTumblrSquare,
    faFacebookSquare,
    faEnvelopeSquare
  ]);
};