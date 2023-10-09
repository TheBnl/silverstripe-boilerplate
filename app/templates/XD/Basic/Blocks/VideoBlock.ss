<div class="container">
    <div class="row">
        <div class="col">
            <% if $ShowTitle %>
                <h3 class="block__title">$Title</h3>
            <% end_if %>
            <div class="ratio ratio-16x9 video-block__video" data-video="$EmbedCode.ATT" data-consent-message="<%t XD\Basic\Blocks\VideoBlock.Consent.Message 'Deze video komt van een externe partij, u heeft aangegeven geen tracking cookies te willen ontvangen. Door deze video in te laden worden er mogelijk cookies geplaatst door deze externe partij' %>">
                <div class="video-block__play-button">
                    <i class="fas fa-play"></i>
                </div>
                $VideoPreview.FocusFill(1600, 900)
            </div>
        </div>
    </div>
</div>