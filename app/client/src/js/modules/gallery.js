import PhotoSwipe from 'photoswipe';
import PhotoSwipeUI_Default from 'photoswipe/dist/photoswipe-ui-default';

export const initGallery = function () {
    const template = injectGalleryTemplate();
    const slides = document.querySelectorAll('[data-gallery-index]');
    slides.forEach(el => {
        el.addEventListener('click', function () {
            const gallery = this.closest('[data-gallery]');
            if (gallery) {
                const index = parseInt(eval(this.getAttribute('data-gallery-index'))) - 1;
                const items = JSON.parse(gallery.getAttribute('data-gallery'));
                const pswp = document.querySelector('.pswp');
                const photoSwipe = new PhotoSwipe(pswp, PhotoSwipeUI_Default, items, {index: index});
                console.log('pswp', pswp);
                console.log('photoSwipe', photoSwipe);
                console.log('items', items);
                photoSwipe.init();
            }
        });
    });
};

function injectGalleryTemplate() {
    const template = '<div class="pswp__bg"></div><div class="pswp__scroll-wrap"> <div class="pswp__container"> <div class="pswp__item"></div><div class="pswp__item"></div><div class="pswp__item"></div></div><div class="pswp__ui pswp__ui--hidden"> <div class="pswp__top-bar"> <div class="pswp__counter"></div><span class="pswp__button pswp__button--close" title="Close (Esc)"></span> <span class="pswp__button pswp__button--share" title="Share"></span> <span class="pswp__button pswp__button--fs" title="Toggle fullscreen"></span> <span class="pswp__button pswp__button--zoom" title="Zoom in/out"></span> <div class="pswp__preloader"> <div class="pswp__preloader__icn"> <div class="pswp__preloader__cut"> <div class="pswp__preloader__donut"></div></div></div></div></div><div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap"> <div class="pswp__share-tooltip"></div></div><span class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)"></span> <span class="pswp__button pswp__button--arrow--right" title="Next (arrow right)"></span> <div class="pswp__caption"> <div class="pswp__caption__center"></div></div></div></div>';
    const body = document.getElementsByTagName('BODY')[0];
    let pswp = document.createElement('div');
    pswp.setAttribute('class', 'pswp');
    pswp.setAttribute('tabindex', '-1');
    pswp.setAttribute('role', 'dialog');
    pswp.setAttribute('aria-hidden', 'true');
    pswp.innerHTML = template.trim();
    body.appendChild(pswp);
    return pswp;
}