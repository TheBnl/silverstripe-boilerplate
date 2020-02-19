<header class="site-header">
    <div class="site-header__logo">
        <div class="grid-container">
            <div class="grid-x grid-padding-x">
                <div class="cell">
                    <h1><a href="$BaseHref">$SiteConfig.Title</a></h1>
                </div>
            </div>
        </div>
    </div>
    <div class="grid-container">
        <nav class="grid-x grid-padding-x">
            <ul class="cell site-nav">
                <% loop $Menu('1') %>
                    <li class="site-nav__item<% if $LinkOrSection == 'section' %> site-nav__item--current<% end_if %>">
                        <a href="$Link" title="$Title.XML">$MenuTitle</a>
                    </li>
                <% end_loop %>
            </ul>
        </nav>
    </div>
</header>
