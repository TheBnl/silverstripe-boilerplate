<nav class="nav nav-pills flex-column">
    <% loop $Menu('1') %>
        <a class="nav-link<% if $LinkOrSection == 'section' %> active<% end_if %>" 
            href="$Link">
            $MenuTitle
        </a>
        <% if $Children %>
            <nav class="nav nav-pills flex-column">
                <% loop $Children %>
                    <a class="nav-link ms-3 my-1<% if $LinkOrSection == 'section' %> active<% end_if %>" 
                        href="$Link">
                        $MenuTitle
                    </a>
                <% end_loop %>
            </nav>
        <% end_if %>
    <% end_loop %>
</nav>
