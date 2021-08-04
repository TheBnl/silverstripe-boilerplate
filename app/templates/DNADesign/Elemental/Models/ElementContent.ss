<div class="container mx-auto py-12">
    <div class="grid grid-cols-12 gap-4">
        <% if $Image %>
            <div class="col-span-4 <% if $ImagePosition=="Right" %>order-last<% end_if %>">
                <figure>
                    <img src="$Image.ScaleWidth(600).Link" alt="$Image.Title">
                </figure>
            </div>
            <div class="col-span-8 <% if $ImagePosition=="Right" %>order-first<% end_if %>">
                <% if $ShowTitle %>
                    <h2>$Title</h2>
                <% end_if %>
                $HTML
            </div>
        <% else %>
            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-full lg:col-start-3 lg:col-span-8">
                    <h2>$Title</h2>
                    $Content
                    $Form
                </div>
            </div>
        <% end_if %>

    </div>
</div>