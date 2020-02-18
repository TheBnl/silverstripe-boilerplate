<?php

namespace XD\Models;

use SilverStripe\Assets\Image;
use SilverStripe\ORM\DataObject;
use SilverStripe\Versioned\Versioned;

/**
 * Class GalleryItem
 * @package PlanetBio\Models
 *
 * @property string Title
 * @property int Sort
 *
 * @method DataObject Parent()
 * @method Image Image()
 */
class GalleryItem extends DataObject
{
    private static $table_name = 'PlanetBio_GalleryItem';

    private static $db = [
        'Title' => 'Varchar',
        'Sort' => 'Int'
    ];

    private static $default_sort = 'Sort ASC';

    private static $has_one = [
        'Parent' => DataObject::class,
        'Image' => Image::class
    ];

    private static $owns = [
        'Image'
    ];

    private static $extensions = [
        Versioned::class
    ];

    private static $summary_fields = [
        'Image.CMSThumbnail' => 'Image',
        'Title' => 'Caption'
    ];

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->removeByName(['Sort', 'ParentID']);
        return $fields;
    }

    public function getJSON()
    {
        return array(
            'src' => $this->Image()->Link(),
            'w' => $this->Image()->getWidth(),
            'h' => $this->Image()->getHeight(),
            'title' => htmlentities($this->Title, ENT_QUOTES)
        );
    }
}