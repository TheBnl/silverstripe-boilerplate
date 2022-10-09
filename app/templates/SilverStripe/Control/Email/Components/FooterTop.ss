<table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
    <tr>
        <th valign="top" width="50%" class="stack-column">
            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                <tr>
                    <td style="font-family: sans-serif; font-size: 16px; line-height: 24px; color: $Theme.White; padding: 0 20px 20px; text-align: left;">
                        <img src="$AbsoluteBaseURL/app/images/mail-logo-wit.png" width="142" height="36" alt="$SiteConfig.Title" border="0" style="max-width: 142px; height: auto; font-family: sans-serif; font-size: 16px; line-height: 15px; color: $Theme.White; display: block; border: 0px;">
                    </td>
                </tr>
            </table>
        </th>
        <th valign="top" width="50%" class="stack-column">
            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">	                                
                <tr>
                    <td style="font-family: sans-serif; font-size: 16px; line-height: 24px; color: $Theme.White; padding: 0 20px 20px; text-align: left;">

                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                            <tr>
                                <% loop $SiteConfig.SocialMedia %>
                                    <td style="font-family: sans-serif; font-size: 16px; line-height: 24px; color: $Theme.White; padding: 0 2px 2px; text-align: left;">
                                        <a href="$Link">
                                            <img src="$AbsoluteBaseURL/app/images/email/{$Title}@2x.png" width="44" height="44" alt="$Platform" border="0" style="max-width: 44px; height: auto; font-family: sans-serif; font-size: 16px; line-height: 15px; color: $Theme.White; display: block; border: 0px;">
                                        </a>
                                    </td>
                            <% end_loop %>
                            </tr>
                        </table>
                        
                    </td>
                </tr>
            </table>
        </th>
    </tr>
</table>