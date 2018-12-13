<!doctype html>
<!--[if lt IE 9]>
<html class="no-js lt-ie9" lang="$ContentLocale" $OGNS> <![endif]-->
<!--[if gt IE 8]>
<html class="no-js ie9" lang="$ContentLocale" $OGNS> <![endif]-->
<!--[if !IE]><!-->
<html class="no-js no-ie" lang="$ContentLocale" $OGNS> <!--<![endif]-->
<head>
    <% if $IsDev %><meta name="robots" content="noindex, nofollow"><% end_if %>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title>$Title | $SiteConfig.Title</title>
    <% base_tag %>
    <meta name="viewport" content="width=device-width"/>
    $MetaTags('false')
    <%-- favicon.ico should contain size 16,24,32,48 and 64px, see https://github.com/audreyr/favicon-cheat-sheet/ --%>
    <%-- online converter tool from png to ico with multiple sizes: http://converticon.com/ --%>
    <link rel="shortcut icon" href="{$BaseURL}favicon.ico"/>
    <link rel="apple-touch-icon-precomposed" href="{$BaseURL}favicon-152.png">
    <meta name="msapplication-TileImage" content="{$BaseURL}favicon-144.png">
    <meta name="msapplication-TileColor" content="#132136">
</head>
<body>
    $GTMFallback
    <% include Header %>
    <div class="layout" role="main">
        $Layout
    </div>
    <% include Footer %>
    <% include CookieConsent %>
    <% if not $IsDev %>$BetterNavigator<% end_if %>
</body>
</html>
