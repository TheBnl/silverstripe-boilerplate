
import PhotoSwipeLightbox from 'photoswipe';
import 'photoswipe/style.css';

{
    const slides = document.querySelectorAll('[data-gallery-index]');
    slides.forEach(el => el.addEventListener('click', function () {
        const gallery = this.closest('[data-gallery]');
        if (gallery) {
            const index = parseInt(eval(this.getAttribute('data-gallery-index'))) - 1;
            const dataSource = JSON.parse(gallery.getAttribute('data-gallery'));
            
            const pswp = new PhotoSwipeLightbox({index, dataSource});
            pswp.init();
        }
    }));
};
