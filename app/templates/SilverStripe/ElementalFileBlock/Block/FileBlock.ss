<% if $ShowTitle %>
    <header class="grid-x grid-padding-x">
        <div class="cell">
            <h2>$Title</h2>
        </div>
    </header>
<% end_if %>
<div class="grid-x grid-padding-x">
    <div class="cell">
        <img src="$File.ScaleWidth(1200).Link" srcset="$File.ScrSet(600, 1200, 200, 'ScaleWidth')" alt="$File.Title">
    </div>
</div>