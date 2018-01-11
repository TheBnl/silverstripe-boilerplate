<?php

use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\Image;
use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Control\Director;
use SilverStripe\Forms\FieldList;

/**
 * Class Page
 * @method Image OpenGraphImage()
 */
class Page extends SiteTree
{
    private static $db = [];

    private static $has_one = [
        'OpenGraphImage' => Image::class
    ];

    private static $has_many = [];
    private static $many_many = [];
    private static $defaults = [];
    private static $belongs_many_many = [];
    private static $searchable_fields = [];
    private static $summary_fields = [];

    private static $default_image = '/favicon-152.png';

    public function getCMSFields()
    {
        $self =& $this;
        $this->beforeUpdateCMSFields(function (FieldList $fields) use ($self) {
            $openGraphImage = UploadField::create('OpenGraphImage', 'Social media image');
            $openGraphImage->setDescription('Add an image to display on Facebook and Twitter');
            $fields->addFieldToTab('Root.Main.Metadata', $openGraphImage, 'MetaDescription');
        });

        $fields = parent::getCMSFields();
        $fields->removeByName(array('ExtraMeta'));
        return $fields;
    }

    /**
     * Override the default Open Graph Image
     *
     * @return mixed
     */
    function getOGImage()
    {
        $this->extend('updateOGImage', $image);
        if (isset($image)) {
            return $image;
        }
        if ($this->OpenGraphImage()->exists()) {
            return $this->OpenGraphImage();
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
