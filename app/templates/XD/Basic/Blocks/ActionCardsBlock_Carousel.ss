<div class="grid-container">
    <% if $ShowTitle %>
        <div class="grid-x grid-padding-x">
            <div class="large-8 cell">
                <h3 class="block__title">$Title</h3>
            </div>
        </div>
    <% end_if %>

    <div class="grid-x grid-padding-x">
        <div class="cell">
            <div class="action-cards-swiper__holder">
                <div class="swiper-container action-cards-swiper">
                    <div class="swiper-wrapper">
                        <% loop $ActionCards %>
                            <div class="swiper-slide">
                                <% include ActionCard %>
                            </div>
                        <% end_loop %>
                    </div>
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
    </div>
</div>