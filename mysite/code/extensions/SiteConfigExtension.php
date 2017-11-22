<?php

use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\LiteralField;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\DataExtension;


/**
 * Extension to modify SiteConfig
 * @property SilverStripe\SiteConfig\SiteConfig owner
 */
class SiteConfigExtension extends DataExtension
{

    private static $db = array(
        'Phone' => 'Varchar(25)',
        'Email' => 'Varchar(255)'
    );

    private static $has_one = array();

    private static $has_many = array(
        'SocialMediaPlatforms' => 'SocialMediaPlatform'
    );

    private static $many_many = array();
    private static $defaults = array();
    private static $belongs_many_many = array();
    private static $searchable_fields = array();
    private static $summary_fields = array();

    public function updateCMSFields(FieldList $fields)
    {
        $fields->removeByName('Theme');

        $telephoneField = new TextField('Phone', 'TelephoneNumber');
        $emailField = new TextField('Email', 'Email');
        $fields->addFieldsToTab("Root.Address", array($telephoneField, $emailField));

        if ($this->owner->exists()) {
            $editableGridFieldConfig = new GridFieldConfig_EditableNoDetail();
            $socialMediaPlatformsGridField = new GridField("SocialMediaPlatforms", "Social Media Links", $this->owner->SocialMediaPlatforms(), $editableGridFieldConfig);

            $fields->addFieldsToTab("Root.SocialMedia", array(
                $socialMediaPlatformsGridField
            ));
        } else {
            $saveNeeded = _t('SiteConfig.SAVE_NEEDED', 'You need to save the Config before Social Media links can be added');
            $fields->addFieldToTab('Root.SocialMediaLinks', new LiteralField('SaveNeeden', "<p class='message notice'>$saveNeeded</p>"));
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
        $latitude = $this->owner->getField("Latitude");
        $longitude = $this->owner->getField("Longitude");
        return "https://www.google.nl/maps/dir//$address/@$latitude,$longitude,16z/?hl=nl";
    }
}
