{
    const GallerySwiper = new Swiper('.action-cards-block__carousel', {
        autoplay: {
            delay: 5000,
        },
        slidesPerView: 2,
        spaceBetween: 0,
        breakpointsInverse: true,
        breakpoints: {
            640: {
                slidesPerView: 3
            }
        }
    });
}