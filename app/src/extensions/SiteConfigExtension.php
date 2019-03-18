<?php

namespace XD\Basic;

use SilverStripe\Forms\EmailField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\DataExtension;
use SilverStripe\ORM\HasManyList;
use SilverStripe\SiteConfig\SiteConfig;

/**
 * class SiteConfigExtension
 * Extension to modify SiteConfig
 * @mixin \Symbiote\Addressable\Addressable
 * @mixin \Symbiote\Addressable\Geocodable
 *
 * @property string Phone
 * @property string Email
 * @method HasManyList SocialMedia()
 * @property SiteConfig|SiteConfigExtension owner
 */
class SiteConfigExtension extends DataExtension
{
    private static $db = [
        'Phone' => 'Varchar(25)',
        'Email' => 'Varchar(255)'
    ];

    private static $has_many = [
        'SocialMedia' => SocialMediaPlatform::class
    ];

    public function updateCMSFields(FieldList $fields)
    {
        $fields->removeByName('Theme');
        $fields->addFieldsToTab('Root.Address', [
            TextField::create('Phone', _t(__CLASS__ . '.TelephoneNumber', 'TelephoneNumber')),
            EmailField::create('Email', _t(__CLASS__ . '.Email', 'Email'))
        ]);

        if ($this->owner->exists()) {
            $editableGridFieldConfig = new GridFieldConfig_SortableEditable();
            $fields->addFieldToTab('Root.SocialMedia', GridField::create(
                'SocialMediaPlatforms',
                _t(__CLASS__ . '.SocialMediaLinks', 'Social Media Links'),
                $this->owner->SocialMedia(),
                $editableGridFieldConfig
            ));
        }

        return $fields;
    }

    /**
     * Return a formatted address
     *
     * @return string
     */
    public function getFormattedAddress()
    {
        return implode(', ', array(
            $this->owner->getField('Address'),
            $this->owner->getField('Postcode'),
            $this->owner->getField('Suburb')
        ));
    }

    /**
     * Return a directional link to Google Maps
     *
     * @return string
     */
    public function getGoogleMapsLink()
    {
        $address = urlencode($this->owner->getFullAddress());
        $latitude = $this->owner->getField("Lat");
        $longitude = $this->owner->getField("Lng");
        $title = $this->owner->Title;

        return "https://www.google.nl/maps/dir//$title+$address/@$latitude,$longitude,16z/?hl=nl";
    }
}
