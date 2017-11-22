<?php

use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\CMS\Model\SiteTree;

/**
 * Class Page
 * @method SilverStripe\Assets\Image OpenGraphImage()
 */
class Page extends SiteTree
{
    private static $db = [];

    private static $has_one = [
        'OpenGraphImage' => 'SilverStripe\\Assets\\Image'
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

        $this->beforeUpdateCMSFields(function ($fields) use ($self) {});

        $fields = parent::getCMSFields();

        $openGraphImage = UploadField::create('OpenGraphImage', 'Social media image');
        $openGraphImage->setDescription('Add an image to display on Facebook and Twitter');
        //$fields->addFieldToTab('Root.SEO', $openGraphImage, 'MetaDescription');
        $fields->addFieldToTab('Root.Main.Metadata', $openGraphImage, 'MetaDescription');

        //if ($metaDescription = $fields->fieldByName('Root.SEO.MetaDescription')) {
        //    $metaDescription->setTargetLength(150, 130, 160);
        //}

        $fields->removeByName(array('ExtraMeta'));
        return $fields;
    }

    /**
     * Override the default Open Graph Image
     * @return mixed
     */
    function getOGImage()
    {
        $this->extend('updateOGImage', $image);
        if (isset($image)) {
            return $image;
        } if ($this->OpenGraphImage()->exists()) {
        return $this->OpenGraphImage();
    } else {
        return Director::absoluteURL(self::config()->get('default_image'));
    }
    }

    /**
     * Make sure a meta description tag is set even if no description is given
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
