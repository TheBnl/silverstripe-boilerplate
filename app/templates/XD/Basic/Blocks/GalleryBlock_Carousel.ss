<div class="container">
    <% if $ShowTitle %>
        <div class="row">
            <div class="col">
                <h3 class="block__title">$Title</h3>
            </div>
        </div>
    <% end_if %>
    <div class="swiper-container gallery-block__carousel">
        <div class="swiper-wrapper gallery__wrapper grid-padding-x">
            <% loop $GalleryItems %>
                <figure class="swiper-slide gallery-block__item">
                    $Image.FocusFill(400, 300)
                    <% if $Title %>
                        <figcaption class="gallery-block__item-caption">$Title</figcaption>
                    <% end_if %>
                </figure>
            <% end_loop %>
        </div>
    </div>
</div>