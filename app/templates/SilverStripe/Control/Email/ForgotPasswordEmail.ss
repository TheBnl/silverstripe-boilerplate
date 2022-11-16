<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<% include SilverStripe\Control\Email\Components\Head %>

<body width="100%" style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color: $Theme.BackgroundColor;">
  <center role="article" aria-roledescription="email" lang="en" style="width: 100%; background-color: $Theme.BackgroundColor;">
    <!--[if mso | IE]>
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: $Theme.BackgroundColor;">
    <tr>
    <td>
    <![endif]-->

        <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="600" style="margin: auto;" class="email-container">
	        <tr>
                <td style="padding: 40px 20px 20px; background-color: $Theme.HeaderBackgroundColor;">
                    <% include SilverStripe\Control\Email\Components\Header RightTitle=$EmailHeaderTitle %>
                </td>
            </tr>
            
            <% if $EmailBanner %>
            <tr>
                <td style="background-color: $Theme.BodyBackgroundColor;">
                    <% include SilverStripe\Control\Email\Components\Banner Image=$EmailBanner.FocusFill(1200,600)  %>
                </td>
            </tr>
            <% end_if %>
            
            <tr>
                <td style="background-color: $Theme.BodyBackgroundColor;">
                    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                        <tr>
                            <td style="padding: 24px 40px 0; font-family: sans-serif; font-size: 16px; line-height: 24px; color: $Theme.FontColor;">
                                <p><%t SilverStripe\\Control\\Email\\ForgotPasswordEmail_ss.HELLO 'Hi' %> $FirstName,</p>
                                <p><%t SilverStripe\\Control\\Email\\ForgotPasswordEmail_ss.TEXT1 'Here is your' %> <a href="$PasswordResetLink"><%t SilverStripe\\Control\\Email\\ForgotPasswordEmail_ss.TEXT2 'password reset link' %></a> <%t SilverStripe\\Control\\Email\\ForgotPasswordEmail_ss.TEXT3 'for' %> $AbsoluteBaseURL.</p>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 0 40px 24px; font-family: sans-serif; font-size: 16px; line-height: 24px; color: $Theme.FontColor;">
                                <% include SilverStripe\Control\Email\Components\Button ButtonLink=$PasswordResetLink, ButtonLabel="Verander mijn wachtwoord" %>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 0 40px 24px; font-family: sans-serif; font-size: 16px; line-height: 24px; color: $Theme.FontColor;">
                                <% include SilverStripe\Control\Email\Components\Payoff %>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

	        <tr>
	            <td style="padding: 40px 20px 20px; background-color: $Theme.PrimaryColor;">
	                <% include SilverStripe\Control\Email\Components\FooterTop %>
	            </td>
	        </tr>

            <tr>
	            <td style="padding: 0px 20px 20px; background-color: $Theme.PrimaryColor;">
	                <% include SilverStripe\Control\Email\Components\FooterContent %>
	            </td>
	        </tr>

            <tr>
                <td style="background-color: $Theme.DarkGray;">
                    <% include SilverStripe\Control\Email\Components\Copy %>
                </td>
            </tr>

	    </table>

    <!--[if mso | IE]>
    </td>
    </tr>
    </table>
    <![endif]-->
    </center>
</body>
</html>
