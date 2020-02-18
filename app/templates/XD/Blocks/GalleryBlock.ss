<div class="grid-container" data-gallery='$JSONGallery'>
    <div class="grid-x grid-padding-x small-up-2 medium-up-3 gallery-block__gallery">
        <% loop $GalleryItems.Limit(4) %>
            <div class="cell<% if $Pos == 4 %> hide-for-medium<% end_if %>">
                <figure class="gallery-item" data-gallery-index="$Pos">
                    <img src="$Image.FocusFill(400, 300).Link" alt="$Image.Title">
                    <% if $Title %>
                        <figcaption class="gallery-item__caption">$Title</figcaption>
                    <% end_if %>
                </figure>
            </div>
        <% end_loop %>
    </div>
    <div class="grid-x grid-padding-x">
        <div class="cell gallery-block__actions">
            <button data-gallery-index="1" class="button"><%t XD\Blocks\GalleryBlock.ViewGallery 'View gallery' %></button>
        </div>
    </div>
</div>