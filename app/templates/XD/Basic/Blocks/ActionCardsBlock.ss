<div class="grid-container">
    <% if $ShowTitle %>
    <div class="grid-x grid-padding-x">
        <div class="large-8 cell">
            <h3 class="block__title">$Title</h3>
        </div>
    </div>
    <% end_if %>
    <% if $ActionCards %>
        <div class="grid-x grid-padding-x grid-margin-y">
            <% loop $ActionCards %>
                <div class="cell<% if $Last && $Up.ActiveActionCards.Count==3 %> large-4<% else %> medium-6 large-4<% end_if %>">
                    <% include ActionCard %>                    
                </div>
            <% end_loop %>
        </div>
    <% end_if %>
</div>