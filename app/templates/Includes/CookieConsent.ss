<% if $PromptCookieConsent %>
    <style>
        body {
            overflow: hidden;
        }
    </style>
    <div class="cookie-consent-background">
        <div class="cookie-consent" id="cookie-consent">
            <h3>$SiteConfig.CookieConsentTitle</h3>
            $CookieConsentForm
        </div>
    </div>
<% end_if %>
