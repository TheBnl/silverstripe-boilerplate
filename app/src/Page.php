<?php

use DNADesign\Elemental\Extensions\ElementalPageExtension;
use DNADesign\Elemental\Models\ElementalArea;
use JonoM\FocusPoint\Extensions\FocusPointImageExtension;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\Image;
use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Control\Director;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\ORM\HasManyList;
use XD\Basic\GridField\GridFieldConfig_Sortable;
use XD\Basic\Models\Banner;

/**
 * Class Page
 * @mixin ElementalPageExtension
 * @method FocusPointImageExtension|Image OpenGraphImage()
 * @method ElementalArea ElementalArea()
 * @method HasManyList Banners()
 */
class Page extends SiteTree
{
    private static $db = [];

    private static $has_one = [
        'OpenGraphImage' => Image::class
    ];

    private static $has_many = [
        'Banners' => Banner::class . '.Parent'
    ];

    private static $owns = [
        'OpenGraphImage'
    ];

    private static $default_image = '/favicon-152.png';

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->addFieldsToTab('Root.Banners', [
            GridField::create('Banners', _t(__CLASS__ . '.Banners', 'Banners'), $this->Banners(), GridFieldConfig_Sortable::create())
        ]);

        $openGraphImage = UploadField::create('OpenGraphImage', _t(__CLASS__ . '.MetaImage', 'Meta image'));
        $fields->insertBefore('MetaDescription', $openGraphImage);
        if ($metaDescriptionField = $fields->fieldByName('Root.SEO.MetaDescription')) {
            $metaDescriptionField->setTargetLength(125);
        }

        $fields->removeByName('ExtraMeta');
        return $fields;
    }

    public function getActiveBanners()
    {
        $banners = $this->Banners()->Sort('Sort ASC');

        // if (!$banners->exists()) {
        //     // use featured
        //     if ($this->FeaturedImageID) {
        //         $banner = Banner::create();
        //         $banner->Image = $this->FeaturedImage();
        //         return ArrayList::create([$banner]);
        //     }

        //     // bubble up
        //     if ($this->Parent) {
        //         $parent = $this->Parent;
        //         $limit = 0;
        //         while (!is_null($parent) && $parent->Banners()->Count() <= 0 && ++$limit < 10) {
        //             $parent = $parent->Parent;
        //         }
        //         if (!is_null($parent)) {
        //             $banners = $parent->Banners();
        //         }
        //     }
        // }

        $this->extend('updateBanners', $banners);
        return $banners;
    }

    /**
     * Override the default Open Graph Image
     * @see \TractorCow\OpenGraph\Extensions\OpenGraphObjectExtension::getOGImage()
     *
     * @return string
     */
    public function getOGImage()
    {
        /** @var Image|FocusPointImageExtension $image */
        $image = $this->OpenGraphImage();
        $this->extend('updateOGImage', $image);
        if ($image->exists()) {
            return $image->FocusFill(1200, 630)->getAbsoluteURL();
        } elseif (
            // Search for set Banners
            ($banners = $this->Banners()) && $banners->exists() &&
            ($image = $banners->first()->Image()) && $image->exists()
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
