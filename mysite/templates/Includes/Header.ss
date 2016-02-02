<% cached "siteheader", $SiteConfig.LastEdited, $ID, $ContentLocale %>
<header class="site-header">
    <div class="row">
        <div class="large-12 columns">
            <h1>$SiteConfig.Title</h1>
            <% cached "mainnavigation", $List("SiteTree").max("LastEdited"), $List("SiteTree").count(), $ID, $ContentLocale %>
            <nav>
                <ul>
                    <% loop $Menu('1') %>
                        <li <% if $LinkOrSection == 'section' %>class="current"<% end_if %>>
                            <a href="$Link" title="$Title.XML">$MenuTitle</a>
                        </li>
                    <% end_loop %>
                </ul>
            </nav>
            <% end_cached %>
        </div>
    </div>
</header>
<% end_cached %>