<div class="container" data-gallery='$JSONGallery'>
    <% if $ShowTitle %>
        <div class="row">
            <div class="col">
                <h3 class="block__title">$Title</h3>
            </div>
        </div>
    <% end_if %>
    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4">
        <% loop $GalleryItems %>
            <div class="col">
                <figure class="gallery-block__item gallery-block__item--grid" data-gallery-index="$Pos">
                    $Image.FocusFill(400, 300)
                    <% if $Title %>
                        <figcaption class="gallery-block__item-caption">$Title</figcaption>
                    <% end_if %>
                </figure>
            </div>
        <% end_loop %>
    </div>
    <div class="row text-center">
        <div class="col gallery-block__actions">
            <button data-gallery-index="1" class="btn btn-primary"><%t XD\Blocks\GalleryBlock.ViewGallery 'View gallery' %></button>
        </div>
    </div>
</div>