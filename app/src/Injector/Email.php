<?php

namespace XD\Basic\Injector;

use SilverStripe\Control\Email\Email as SilverStripeEmail;
use SilverStripe\View\ArrayData;

class Email extends SilverStripeEmail
{
    private static $theme = [
        'PrimaryColor' => '#1779ba',
        'SecondaryColor' => '#767676',
        'FontColor' => '#0a0a0a',
        'BodyBackgroundColor' => '#ffffff',
        'BackgroundColor' => '#e6e6e6',
        'HeaderBackgroundColor' => '#ffffff',
        'HeaderFontColor' => '#0a0a0a',
        'LightGray' => '#e6e6e6',
        'MediumGray' => '#cacaca',
        'DarkGray' => '#8a8a8a',
        'Black' => '#0a0a0a',
        'White' => '#ffffff',
    ];

    public function getTheme()
    {
        return new ArrayData(self::config()->get('theme'));
    }
}
