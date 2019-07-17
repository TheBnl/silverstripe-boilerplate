<% if $File || $ShowTitle || $Content || $CallToActionLink.Page.Link %>
    <figure class="banner-block__figure">
        <% if $File %>
            <img src="$File.ScaleWidth(1200).Link" srcset="$File.ScrSet(600, 1200, 200, 'ScaleWidth')" alt="$File.Title">
        <% end_if %>
        <% if $ShowTitle || $Content || $CallToActionLink.Page.Link %>
            <figcaption class="banner-block__caption">
                <div class="<% if $FullWidth %>grid-container <% end_if %> banner-block__content-holder">
                    <div class="grid-x grid-padding-x">
                        <div class="cell">
                            <% if $ShowTitle %>
                                <header class="banner-block__header">
                                    <h3 class="banner-block__title">$Title</h3>
                                </header>
                            <% end_if %>
                            <% if $Content %>
                                <div class="banner-block__content">
                                    $Content
                                </div>
                            <% end_if %>
                            <% if $CallToActionLink.Page.Link %>
                                <footer class="banner-block__footer">
                                    <% with $CallToActionLink %>
                                        <a href="{$Page.Link}" class="button large banner-block__call-to-action"
                                           <% if $TargetBlank %>target="_blank"<% end_if %>
                                            <% if $Description %>title="{$Description.ATT}"<% end_if %>>
                                            {$Text.XML}
                                        </a>
                                    <% end_with %>
                                </footer>
                            <% end_if %>
                        </div>
                    </div>
                </div>
            </figcaption>
        <% end_if %>
    </figure>
<% end_if %>