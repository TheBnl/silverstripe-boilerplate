<?php

namespace XD\Basic\Models;

use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\DataObject;
use SilverStripe\SiteConfig\SiteConfig;
use XD\Basic\Util;

/**
 * SocialMediaPlatform
 *
 * @author Bram de Leeuw
 * Date: 17/02/16
 *
 * @property int Sort
 * @property string Title
 * @property string Link
 * @method SiteConfig SiteConfig()
 */
class SocialMediaPlatform extends DataObject
{
    private static $table_name = 'SocialMediaPlatform';

    private static $db = [
        'Sort' => 'Int',
        'Title' => "Enum('Facebook, Twitter, Google+, Instagram, YouTube, LinkedIn, Pinterest, SoundCloud, Tumblr','Facebook')",
        'Link' => 'Varchar(255)'
    ];

    private static $default_sort = 'Sort DESC';

    private static $has_one = [
        'SiteConfig' => SiteConfig::class
    ];

    private static $summary_fields = [
        'Title' => 'Platform',
        'Link' => 'Link'
    ];

    private static $translate = [
        'Link'
    ];

    public function getCMSFields()
    {
        $socialMediaPlatforms = self::singleton()->dbObject('Title')->enumValues();
        $fields = FieldList::create([
            DropdownField::create('Title', _t(__CLASS__ . '.Platform', 'Platform'), $socialMediaPlatforms),
            TextField::create('Link', _t(__CLASS__ . '.Link', 'Link'))
        ]);

        $this->extend('updateCMSFields', $fields);
        return $fields;
    }

    /**
     * Get the fontawesome icon for the chosen platform
     *
     * @return string
     */
    public function Icon()
    {
        switch ($this->Title) {
            case 'Twitter':
                return 'fab fa-twitter-square';
                break;
            case 'Google+':
                return 'fab fa-google-plus-square';
                break;
            case 'Instagram':
                return 'fab fa-instagram';
                break;
            case 'YouTube':
                return 'fab fa-youtube-square';
                break;
            case 'LinkedIn':
                return 'fab fa-linkedin-square';
                break;
            case 'Pinterest':
                return 'fab fa-pinterest-square';
                break;
            case 'SoundCloud':
                return 'fab fa-soundcloud';
                break;
            case 'Tumblr':
                return 'fab fa-tumblr-square';
                break;
            default:
            case 'Facebook':
                return 'fab fa-facebook-square';
                break;
        }
    }

    /**
     * Return a CSS String from the selected title
     *
     * @return string
     */
    public function CSSClass()
    {
        return Util::cssClassName($this->getField('Title'));
    }
}
