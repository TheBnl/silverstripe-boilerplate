import PhotoSwipe from 'photoswipe';
import PhotoSwipeUI_Default from 'photoswipe/dist/photoswipe-ui-default';

export const initGallery = function () {
    injectGalleryTemplate();
    $(document).on('click', '[data-gallery-index]', function () {
        let gallery = $(this).closest('[data-gallery]');
        let index = parseInt(eval($(this).attr('data-gallery-index'))) - 1;
        if (gallery.length) {
            let items = JSON.parse($(gallery[0]).attr('data-gallery'));
            let photoSwipe = new PhotoSwipe($('.pswp')[0], PhotoSwipeUI_Default, items, {index: index});
            photoSwipe.init();
        }
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
}