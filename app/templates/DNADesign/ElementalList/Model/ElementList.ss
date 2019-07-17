<% if $ShowTitle %>
    <header class="grid-x grid-padding-x">
        <div class="cell">
            <h2>$Title</h2>
        </div>
    </header>
<% end_if %>
<section class="grid-x grid-padding-x element-list__list">
    <% loop $Elements.Elements %>
        <div class="cell $ListSizeClass element-list__item">
            $Me
        </div>
    <% end_loop %>
</section>