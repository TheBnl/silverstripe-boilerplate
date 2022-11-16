

<table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
    <tr>
        <th width="50%" class="stack-column">
            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                <tr>
                    <td style="font-family: sans-serif; font-size: 16px; line-height: 24px; color: $Theme.HeaderFontColor; padding: 0 20px 20px; text-align: left;">
                        <img src="{$AbsoluteBaseURL}{$Theme.MailLogo}" width="$Theme.MailLogoWidth" alt="$SiteConfig.Title" border="0" style="max-width: $Theme.MailLogoWidth; height: auto; font-family: sans-serif; font-size: 16px; line-height: 15px; color: $Theme.HeaderFontColor; display: block; border: 0px;">
                    </td>
                </tr>
            </table>
        </th>
        <% if $RightTitle %>
        <th width="50%" class="stack-column" style="text-align: right;">
            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">	                                
                <tr>
                    <td style="font-family: sans-serif; font-size: 16px; line-height: 24px; color: $Theme.HeaderFontColor; padding: 0 20px 20px;">
                        <h3 style="margin: 0; font-size: 18px; line-height: 25px; color: $Theme.HeaderFontColor; font-weight: bold;">$RightTitle</h3>
                    </td>
                </tr>
            </table>
        </th>
        <% end_if %>
    </tr>
</table>