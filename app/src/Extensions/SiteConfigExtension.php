<?php

namespace XD\Basic\Extensions;

use SilverStripe\Forms\EmailField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\DataExtension;
use SilverStripe\ORM\HasManyList;
use SilverStripe\SiteConfig\SiteConfig;
use Symbiote\Addressable\Addressable;
use Symbiote\Addressable\Geocodable;
use XD\Basic\GridField\GridFieldConfig_SortableEditable;
use XD\Basic\Models\SocialMediaPlatform;

/**
 * class SiteConfigExtension
 * Extension to modify SiteConfig
 * @mixin Addressable
 * @mixin Geocodable
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
        'Email' => 'Varchar'
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
}
