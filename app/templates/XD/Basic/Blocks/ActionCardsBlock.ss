<div class="container">
    <% if $ShowTitle %>
        <div class="row">
            <div class="col">
                <h3 class="block__title">$Title</h3>
            </div>
        </div>
    <% end_if %>
    <div class="row">
        <% loop $ActionCards %>
            <div class="col-md-4 d-flex">
                <% include ActionCard %>  
            </div>
        <% end_loop %>
    </div>
</div>
