<div class="swiper-slide banner relative">
    <% if $BannerSize=="Small" %>
         $Image.SrcSet(320, 2600, "FocusFill", 0.3)
    <% else_if $BannerSize=="Medium" %>
        $Image.SrcSet(320, 2600, "FocusFill", 0.4)
    <% else %>
        $Image.SrcSet(320, 2600, "ScaleWidth", 0.75)
    <% end_if %>
    <% if $Title %>
        <div class="banner__info absolute bottom-4 left-4 z-10 bg-white p-4">
            <% if $Title%> <h3>$Title</h3><% end_if %>
            <% if $Subtitle%> <h4>$Subtitle</h4><% end_if %>
        </div>
    <% end_if %>
</div>