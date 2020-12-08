<header class="site-header">
    <div class="grid-container">
        <div class="grid-x grid-padding-x">
            <div class="cell small-9 large-3">
                <a class="logo" href="$BaseHref">$SiteConfig.Title</a>
            </div>
            <div class="cell small-3 large-9">
                <nav class="site-nav">
                    <ul class="menu align-right site-nav__menu">
                        <% loop $Menu('1') %>
                            <li class="site-nav__item<% if $LinkOrSection == 'section' %> is-active site-nav__item--current<% end_if %>">
                                <a href="$Link" title="$Title.XML">$MenuTitle</a>
                            </li>
                        <% end_loop %>
                        <li class="site-nav__item site-nav__item--hamburger">
                            <a class="hamburger hamburger--squeeze" aria-label="Menu" aria-controls="navigation" data-open="side-nav">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>
