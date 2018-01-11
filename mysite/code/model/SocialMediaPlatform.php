<?php

use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\DataObject;
use SilverStripe\SiteConfig\SiteConfig;

/**
 * SocialMediaPlatform
 *
 * @author Bram de Leeuw
 * Date: 17/02/16
 *
 * @property int    Sort
 * @property string Title
 * @property string URL
 * @method SiteConfig SiteConfig()
 */
class SocialMediaPlatform extends DataObject
{
    private static $db = array(
        'Sort' => 'Int',
        'Title' => "Enum('Facebook, Twitter, Google+, Instagram, YouTube, LinkedIn, Pinterest, SoundCloud, Tumblr','Facebook')",
        'URL' => 'Varchar(255)'
    );

    private static $default_sort = 'Sort DESC';

    private static $has_one = array(
        'SiteConfig' => SiteConfig::class
    );

    private static $summary_fields = array(
        'Title' => 'Platform',
        'URL' => 'URL'
    );

    private static $translate = array(
        'URL'
    );

    public function getCMSFields()
    {
        $socialMediaPlatforms = singleton('SocialMediaPlatform')->dbObject('Title')->enumValues();
        $fields = FieldList::create(array(
            DropdownField::create('Title', 'Platform', $socialMediaPlatforms),
            TextField::create('URL', 'URL')
        ));

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
                return 'fa fa-twitter-square';
                break;
            case 'Google+':
                return 'fa fa-google-plus-square';
                break;
            case 'Instagram':
                return 'fa fa-instagram';
                break;
            case 'YouTube':
                return 'fa fa-youtube-square';
                break;
            case 'LinkedIn':
                return 'fa fa-linkedin-square';
                break;
            case 'Pinterest':
                return 'fa fa-pinterest-square';
                break;
            case 'SoundCloud':
                return 'fa fa-soundcloud';
                break;
            case 'Tumblr':
                return 'fa fa-tumblr-square';
                break;
            default:
            case 'Facebook':
                return 'fa fa-facebook-square';
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
        return strtolower(preg_replace('/([a-zA-Z])(?=[A-Z])/', '$1-', $this->getField('Title')));
    }

    public function canView($member = null)
    {
        return $this->SiteConfig()->canView($member);
    }

    public function canEdit($member = null)
    {
        return $this->SiteConfig()->canEdit($member);
    }

    public function canDelete($member = null)
    {
        return $this->SiteConfig()->canDelete($member);
    }

    public function canCreate($member = null, $context = [])
    {
        return $this->SiteConfig()->canCreate($member, $context);
    }
}
