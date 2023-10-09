<div class="card w-100 flex-grow mb-3 bg-{$Color} text-bg-{$Color} action-card">
    <% if $Image %>
        <img src="$Image.FocusFill(400,300).Link" class="card-img" alt="$Image.Title">
    <% end_if %>
    <div class="<% if $Image %>card-img-overlay text-white<% else %>card-body<% end_if %>">
        <h5 class="card-title">$Title</h5>
        <p class="card-text">$Content</p>
        <% if $Image %>
            <a href="$Link" class="btn btn-primary"<% if $ExternalLink %> target="_blank"<% end_if %>>
                $LinkLabel
            </a>
        <% end_if %>
    </div>
    <% if not $Image %>
        <div class="card-footer text-body-secondary">
            <% if $Link %>
                <a href="$Link" class="btn btn-primary"<% if $ExternalLink %> target="_blank"<% end_if %>>
                    $LinkLabel
                </a>
            <% end_if %>
        </div>
    <% end_if %>
</div>