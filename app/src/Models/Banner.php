<?php

namespace XD\Basic\Models;

use XD\Basic\Extensions\HasLink;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\DataObject;
use Page;

/**
 * Class Banner
 *
 * @property string Caption
 * @property string Subtitle
 * @property string Color
 *
 * @method DataObject Parent()
 * @method Image Image()
 */
class Banner extends DataObject
{
    private static $table_name = 'Banner';

    private static $db = [
        'Title' => 'Varchar',
        'Subtitle' => 'Varchar',
        'Sort' => 'Int'
    ];

    private static $summary_fields = [
        'Image.CMSThumbnail' => 'Image',
        'Title' => 'Caption'
    ];

    private static $has_one = [
        'Parent' => DataObject::class,
        'Image' => Image::class
    ];

    private static $owns = [
        'Image'
    ];

    private static $extensions = [
        HasLink::class
    ];

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->addFieldsToTab('Root.Main', [
            TextField::create('Title', _t(__CLASS__ . '.Title', 'Title')),
            TextField::create('Subtitle', _t(__CLASS__ . '.Subtitle', 'Subtitle'))
        ]);

        $fields->removeByName(['Sort', 'ParentID']);
        return $fields;
    }
}
