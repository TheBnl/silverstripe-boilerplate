<div class="grid-container">
    <div class="grid-x grid-padding-x">
        <div class="cell">
            <% if $ShowTitle %>
                <h3 class="block__title">$Title</h3>
            <% end_if %>
            <div class="responsive-embed widescreen video-block__video" data-video="$EmbedCode.ATT">
                <div class="video-block__play-button">
                    <i class="fas fa-play"></i>
                </div>
                <img src="$VideoPreview.FocusFill(1600, 900).Link" alt="$Title">
            </div>
        </div>
    </div>
</div>