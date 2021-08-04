<% if $ActiveBanners %>
    <div class="banners banners--{$Top.BannerSize.LowerCase} relative">
        <div class="banners__inner">
            <div class="swiper-container banners__container">
                <div class="swiper-wrapper banners__wrapper">
                    <% loop $ActiveBanners %>
                        <% include Banner BannerSize=$Top.BannerSize %>
                    <% end_loop %>
                </div>
            </div>
            <% if $ActiveBanners.Count > 1 %>
                <div class="banners__pagination absolute right-4 bottom-4 z-10"></div>
            <% end_if %>
        </div>

        <% if $Top.BannerSize=="FullScreen" %>
            <div class="banners__scroll-hint">
            </div>
        <% end_if %>

    </div>
<% else %>
    <div class="banners banners--empty"></div>
<% end_if %>

