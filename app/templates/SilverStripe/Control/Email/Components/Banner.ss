<% if $Image %>
    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
        <tr>
            <td style="background-color: $Theme.White; width: 100%; max-width: 520px;">
                <img src="$Image.AbsoluteLink" width="$Image.Width" height="$Image.Height" alt="$EmailBanner.Title" border="0" style="width: 100%; max-width: 600px; height: auto; background: $Theme.White; font-family: sans-serif; font-size: 16px; line-height: 15px; color: $Theme.FontColor; margin: auto; display: block; border: 0;" class="g-img">
            </td>
        </tr>
    </table>
<% end_if %>