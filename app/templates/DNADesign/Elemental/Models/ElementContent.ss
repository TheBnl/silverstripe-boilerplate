<div class="container">
    <div class="row">
        <% if $Image %>
            <div class="col<% if $ImagePosition == Right %> order-md-2<% end_if %>">
                <figure>
                    $Image.ScaleWidth(600)
                </figure>
            </div>
        <% end_if %>    
        <div class="col-md-8<% if $ImagePosition == Right %> order-md-1<% end_if %>">
            <% if $ShowTitle %>
                <h3 class="block__title">$Title</h3>
            <% end_if %>
            $HTML
        </div>
    </div>
</div>
