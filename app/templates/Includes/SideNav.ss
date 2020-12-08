<nav class="side-nav">
    <ul class="menu vertical side-nav__menu">
        <% loop $Menu('1') %>
            <li class="side-nav__item<% if $LinkOrSection == 'section' %> is-active side-nav__item--current<% end_if %>">
                <a href="$Link" title="$Title.XML">$MenuTitle</a>
            </li>
        <% end_loop %>
    </ul>
</nav>
