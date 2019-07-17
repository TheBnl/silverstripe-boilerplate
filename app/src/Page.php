<?php

use DNADesign\Elemental\Extensions\ElementalPageExtension;
use DNADesign\Elemental\Models\ElementalArea;
use JonoM\FocusPoint\Extensions\FocusPointImageExtension;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\File;
use SilverStripe\Assets\Image;
use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Control\Director;
use SilverStripe\ElementalBannerBlock\Block\BannerBlock;
use SilverStripe\Forms\FieldList;

/**
 * Class Page
 * @mixin ElementalPageExtension
 * @method FocusPointImageExtension|Image OpenGraphImage()
 * @method ElementalArea ElementalArea()
 */
class Page extends SiteTree
{
    private static $db = [];

    private static $has_one = [
        'OpenGraphImage' => Image::class
    ];

    private static $owns = [
        'OpenGraphImage'
    ];

    private static $default_image = '/favicon-152.png';

    public function getCMSFields()
    {
        $self =& $this;
        $this->beforeUpdateCMSFields(function (FieldList $fields) use ($self) {
            $openGraphImage = UploadField::create('OpenGraphImage', _t(__CLASS__ . '.MetaImage', 'Meta image'));
            $fields->insertBefore('MetaDescription', $openGraphImage);
        });

        $fields = parent::getCMSFields();
        return $fields;
    }

    /**
     * Override the default Open Graph Image
     * @see \TractorCow\OpenGraph\Extensions\OpenGraphObjectExtension::getOGImage()
     *
     * @return string
     */
    public function getOGImage()
    {
        $image = $this->OpenGraphImage();
        $this->extend('updateOGImage', $image);
        if ($image->exists()) {
            return $image->FocusFill(1200, 630)->getAbsoluteURL();
        } elseif (
            // Search for set BannerBlocks
            ($area = $this->ElementalArea()) && $area->exists() &&
            ($banner = $area->Elements()->filter(['ClassName' => BannerBlock::class])->first()) && $banner->exists() &&
            ($image = $banner->File()) && $image->exists()
        ) {
            return $image->FocusFill(1200, 630)->getAbsoluteURL();
        } else {
            return Director::absoluteURL(self::config()->get('default_image'));
        }
    }

    /**
     * Make sure a meta description tag is set even if no description is given
     *
     * @param bool $includeTitle
     *
     * @return string
     */
    public function MetaTags($includeTitle = true)
    {
        if (!$this->MetaDescription) {
            $this->MetaDescription = $this->dbObject('Content')->Summary(25);
        }

        return parent::MetaTags($includeTitle);
    }
}
