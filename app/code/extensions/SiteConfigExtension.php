<?php

use SilverStripe\Forms\EmailField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\DataExtension;

/**
 * class SiteConfigExtension
 * Extension to modify SiteConfig
 * @mixin \Symbiote\Addressable\Addressable
 * @mixin \Symbiote\Addressable\Geocodable
 *
 * @property string Phone
 * @property string Email
 * @method \SilverStripe\ORM\HasManyList SocialMediaPlatforms
 * @property SilverStripe\SiteConfig\SiteConfig|SiteConfigExtension owner
 */
class SiteConfigExtension extends DataExtension
{
    private static $db = array(
        'Phone' => 'Varchar(25)',
        'Email' => 'Varchar(255)'
    );

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
        $fields->addFieldsToTab('Root.Address', [
            TextField::create('Phone', 'TelephoneNumber'),
            EmailField::create('Email', 'Email')
        ]);

        if ($this->owner->exists()) {
            $editableGridFieldConfig = new GridFieldConfig_EditableNoDetail();
            $fields->addFieldToTab('Root.SocialMedia', GridField::create(
                'SocialMediaPlatforms',
                'Social Media Links',
                $this->owner->SocialMediaPlatforms(),
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
}
