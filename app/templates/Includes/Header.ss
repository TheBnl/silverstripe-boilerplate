<nav class="navbar navbar-expand-lg bg-body-tertiary mb-3">
    <div class="container-fluid">
        <a class="navbar-brand" href="$BaseHref">$SiteConfig.Title</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvas" aria-controls="offcanvas">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse">
            <ul class="navbar-nav">
                <% loop $Menu('1') %>
                <li class="nav-item">
                    <a href="$Link" <% if $LinkOrSection == 'section' %>class="nav-link active" aria-current="page"<% else %>class="nav-link"<% end_if %>>
                        <% if $MenuTitle %>$MenuTitle<% else %>$Title<% end_if %>
                    </a>
                </li>
                <% end_loop %>
            </ul>
        </div>
    </div>
</nav>
