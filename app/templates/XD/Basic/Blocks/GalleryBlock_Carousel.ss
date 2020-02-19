<div class="grid-container gallery-block__carousel" data-gallery='$JSONGallery'>
    <div class="swiper-container gallery">
        <div class="swiper-wrapper gallery__wrapper grid-padding-x">
            <% loop $GalleryItems %>
                <figure class="cell swiper-slide gallery-block__item gallery-block__item--slide" data-gallery-index="$Pos">
                    <img src="$Image.FocusFill(400, 300).Link" alt="$Image.Title">
                    <% if $Title %>
                        <figcaption class="gallery-block__item-caption">$Title</figcaption>
                    <% end_if %>
                </figure>
            <% end_loop %>
        </div>
    </div>
    <div class="grid-x grid-padding-x">
        <div class="cell gallery-block__actions">
            <button data-gallery-index="1" class="button"><%t XD\Blocks\GalleryBlock.ViewGallery 'View gallery' %></button>
        </div>
    </div>
</div>