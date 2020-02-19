import CookieConsent from '../../../../../resources/bramdeleeuw/cookieconsent/javascript/src/cookieconsent';

export function initVideo() {
  // todo make message translatable
  const message = 'Deze video komt van een externe partij, u heeft aangegeven geen tracking cookies te willen ontvangen. Door deze video in te laden worden er mogelijk cookies geplaatst door deze externe partij';
  const videos = document.querySelectorAll('[data-video]');
  videos.forEach(function(video) {
    video.addEventListener('click', (e) => {
      const consent = new CookieConsent();
      if (!consent.check('Analytics') && window.confirm(message) || consent.check('Analytics')) {
        video.innerHTML = video.getAttribute('data-video');
      }
    });
  });
}
