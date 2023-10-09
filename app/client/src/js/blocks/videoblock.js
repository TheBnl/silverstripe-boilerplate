{
  const videos = document.querySelectorAll('[data-video]');
  videos.forEach(function(video) {
    video.addEventListener('click', (e) => {
      const message = video.getAttribute('data-consent-message');
      const consent = new CookieConsent();
      console.log('consent', consent);
      if (!consent.check('Analytics') && window.confirm(message) || consent.check('Analytics')) {
        video.innerHTML = video.getAttribute('data-video');
      }
    });
  });
}
