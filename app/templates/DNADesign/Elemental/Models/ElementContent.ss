<div class="grid-container">
    <div class="grid-x">
        <div class="cell medium-3 element-content__image element-content__image--image-pos-{$ImagePosition.Lowercase}">
            <% if $Image %>
                <figure>
                    <img src="$Image.ScaleWidth(600).Link" alt="$Image.Title">
                </figure>
            <% end_if %>
        </div>
        <div class="cell medium-9 element-content__content element-content__content--image-pos-{$ImagePosition.Lowercase}">
            <% if $ShowTitle %>
                <h3>$Title</h3>
            <% end_if %>
            $HTML
        </div>
    </div>
</div>