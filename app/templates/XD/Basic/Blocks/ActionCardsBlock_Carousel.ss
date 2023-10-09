<div class="container">
    <% if $ShowTitle %>
        <div class="row">
            <div class="col">
                <h3 class="block__title">$Title</h3>
            </div>
        </div>
    <% end_if %>
    <div class="swiper-container action-cards-block__carousel">
        <div class="swiper-wrapper">
            <% loop $ActionCards %>
                <div class="swiper-slide d-flex">
                    <% include ActionCard %>
                </div>
            <% end_loop %>
        </div>

        <% if $ActionCards.Count > 1 %>
            <div class="action-cards-swiper__nav">
                <span class="action-cards-swiper__nav-button action-cards-swiper__nav-button--prev">
                    <i class="fas fa-arrow-left"></i>
                </span>
                <span class="action-cards-swiper__nav-button action-cards-swiper__nav-button--next">
                    <i class="fas fa-arrow-right"></i>
                </span>
            </div>
            <div class="action-cards-swiper__pagination"></div>
        <% end_if %>
    </div>
</div>