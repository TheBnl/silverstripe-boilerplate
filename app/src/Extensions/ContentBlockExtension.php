<?php

namespace XD\Basic\Extensions;

use DNADesign\Elemental\Models\ElementContent;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\FieldList;
use SilverStripe\ORM\DataExtension;

/**
 * Class ContentBlockExtension
 * @package XD\Basic\Extensions
 *
 * @property ElementContent|ContentBlockExtension owner
 *
 * @property string ImagePosition
 *
 * @method Image Image()
 * @mixin HasLink
 */
class ContentBlockExtension extends DataExtension
{
    private static $db = [
        'ImagePosition' => 'Enum("Left,Right","Left")'
    ];

    private static $has_one = [
        'Image' => Image::class
    ];

    private static $owns = [
        'Image'
    ];

    private static $defaults = [
        'ShowTitle' => 1
    ];

    public function updateCMSFields(FieldList $fields)
    {
        $fields->insertAfter('Image', $fields->fieldByName('Root.Main.ImagePosition'));
    }

    public function updateBlockSchema(&$blockSchema)
    {
        if (($image = $this->owner->Image()) && $image->exists()) {
            $blockSchema['fileURL'] = $image->CMSThumbnail()->getURL();
            $blockSchema['fileTitle'] = $image->Title;
        }
    }

    /**
     * Get the Link
     *
     * @return string
     */
    public function getButtonLink()
    {
        if (($link = $this->owner->InternalLink()) && $link->exists()) {
            return $this->owner->LinkAnchor ?: $link->owner->Link();
        } else {
            return $this->owner->ExternalLink;
        }
    }
}