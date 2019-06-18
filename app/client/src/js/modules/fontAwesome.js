import {library, dom} from '@fortawesome/fontawesome-svg-core';
import {faTumblrSquare} from '@fortawesome/free-brands-svg-icons/faTumblrSquare'
import {faLinkedin} from '@fortawesome/free-brands-svg-icons/faLinkedin'
import {faSoundcloud} from '@fortawesome/free-brands-svg-icons/faSoundcloud'
import {faYoutubeSquare} from '@fortawesome/free-brands-svg-icons/faYoutubeSquare'
import {faFacebookSquare} from '@fortawesome/free-brands-svg-icons/faFacebookSquare'
import {faTwitterSquare} from '@fortawesome/free-brands-svg-icons/faTwitterSquare'
import {faTwitter} from '@fortawesome/free-brands-svg-icons/faTwitter'
import {faInstagram} from '@fortawesome/free-brands-svg-icons/faInstagram'
import {faPinterestSquare} from '@fortawesome/free-brands-svg-icons/faPinterestSquare'
import {faGooglePlusSquare} from '@fortawesome/free-brands-svg-icons/faGooglePlusSquare'
import {faEnvelopeSquare} from '@fortawesome/free-solid-svg-icons/faEnvelopeSquare';
import {faEnvelope} from '@fortawesome/free-regular-svg-icons/faEnvelope';

/**
 * Add all the fontawesome icons
 */
export const initFontAwesome = function () {
  library.add([
    faTwitter,
    faTwitterSquare,
    faGooglePlusSquare,
    faInstagram,
    faYoutubeSquare,
    faLinkedin,
    faPinterestSquare,
    faSoundcloud,
    faTumblrSquare,
    faFacebookSquare,
    faEnvelopeSquare,
    faEnvelope
  ]);

  dom.watch();
};