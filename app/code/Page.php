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
    private static $has_one = [];
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
        $this->beforeUpdateCMSFields(function (FieldList $fields) use ($self) {});
        $fields = parent::getCMSFields();
        return $fields;
    }

    /**
     * Override the default Open Graph Image
     * This is set by extension OpenGraphMeta
     * @see OpenGraphMeta::getOGImageURL()
     *
     * @return Image
     */
    function OGImage()
    {
        return parent::OGImage();
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
