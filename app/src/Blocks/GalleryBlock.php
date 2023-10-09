<?php

namespace XD\Basic\Blocks;

use Colymba\BulkUpload\BulkUploader;
use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldDataColumns;
use SilverStripe\Forms\GridField\GridFieldEditButton;
use SilverStripe\ORM\HasManyList;
use SilverStripe\View\Requirements;
use Symbiote\GridFieldExtensions\GridFieldEditableColumns;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;
use XD\Basic\Models\GalleryItem;

/**
 * Class GalleryBlock
 * Enable this block by editing Page.disallowed_elements in elemental.yml
 *
 * @package PlanetBio\Blocks
 *
 * @method HasManyList GalleryItems()
 */
class GalleryBlock extends BaseElement
{
    private static $table_name = 'Blocks_GalleryBlock';

    private static $singular_name = 'Gallery block';

    private static $plural_name = 'Gallery blocks';

    private static $icon = 'font-icon-block-carousel';

    private static $db = [];

    private static $has_many = [
        'GalleryItems' => GalleryItem::class . '.Parent'
    ];

    private static $owns = [
        'GalleryItems'
    ];

    private static $styles = [
        'Grid' => 'Grid',
        'Carousel' => 'Carousel',
    ];

    public function getType()
    {
        return _t(__CLASS__ . '.BlockType', 'Gallery');
    }

    public function init()
    {
        Requirements::css(project() . '/client/dist/styles/blocks/galleryblock.css');
        if ($this->Style === 'Carousel') {
            Requirements::css('https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css');
            Requirements::javascript('https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js', ['defer' => true]);
            Requirements::javascript(project() . '/client/dist/js/blocks/galleryblockcarousel.js', ['defer' => true]);
        } else {
            Requirements::javascript(project() . '/client/dist/js/blocks/galleryblockgrid.js', ['defer' => true]);
        }
    }

    public function getCMSFields()
    {
        $this->beforeUpdateCMSFields(function (FieldList $fields) {
            /** @var GridField $gridField */
            $gridField = $fields->fieldByName('Root.GalleryItems.GalleryItems');
            if ($gridField && $this->exists()) {
                $fields->removeByName('GalleryItems');
                $fields->insertAfter('Title', $gridField);
                $config = $gridField->getConfig();
                $config->removeComponentsByType(new GridFieldDataColumns());
                $config->addComponent($bulkUploader = new BulkUploader(null, null, true));
                $config->addComponent(new GridFieldEditableColumns(), new GridFieldEditButton());
                $config->addComponent(new GridFieldOrderableRows());
                $bulkUploader->setUfSetup('setFolderName', "Gallery/{$this->Link()}");
            }
        });

        return parent::getCMSFields();
    }

    public function getJSONGallery()
    {
        return json_encode(array_map(function (GalleryItem $item) {
            return $item->getJSON();
        }, $this->GalleryItems()->toArray()));
    }

    public function inlineEditable()
    {
        return false;
    }

    /**
     * Return file title and thumbnail for summary section of ElementEditor
     *
     * @return array
     */
    protected function provideBlockSchema()
    {
        $blockSchema = parent::provideBlockSchema();
        /** @var Image $image */
        if (
            ($gallery = $this->GalleryItems()->first()) && $gallery->exists() &&
            ($image = $gallery->Image()) && $image->exists()
        ) {
            $blockSchema['fileURL'] = $image->CMSThumbnail()->getURL();
            $blockSchema['fileTitle'] = $image->Title;
            $blockSchema['content'] = $gallery->Title;
            if (($count = $this->GalleryItems()->count()) > 1) {
                $blockSchema['content'] .= ', ' .  _t(__CLASS__ . '.AndMore', 'and {count} more...', null, [
                    'count' => $count - 1
                ]);
            }
        }

        return $blockSchema;
    }
}
