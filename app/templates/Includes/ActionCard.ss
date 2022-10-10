<a class="action-card action-card--$Color<% if $Image %> action-card--image<% end_if %> <% if not $Link %>action-card--no-link<% end_if %>"
    <% if $Link %> href="$Link"<% end_if %>
    <% if $ExternalLink %> target="_blank"<% end_if %>
    <% if $Image %> style="background-image: url('$Image.FocusFill(800,600).Link');"<% end_if %>>
    <div class="action-card__content">
        <% if $Label %><label class="action-card__label">$Label</label><% end_if %>
        <header class="action-card__header">
            <% if $Icon %>
                $Icon
            <% else %>
                <i class="fas fa-arrow-right"></i>
            <% end_if %>
            <h3>$Title</h3>
        </header>
        <div class="action-card__description">
            $Content
        </div>
        <footer class="action-card__footer">
            <strong>$LinkLabel</strong>
        </footer>
    </div>
</a>