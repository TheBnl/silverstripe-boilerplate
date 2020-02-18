<?php

namespace XD\Blocks;

use Colymba\BulkUpload\BulkUploader;
use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldDataColumns;
use SilverStripe\Forms\GridField\GridFieldEditButton;
use SilverStripe\ORM\HasManyList;
use Symbiote\GridFieldExtensions\GridFieldEditableColumns;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;
use XD\Models\GalleryItem;

/**
 * Class GalleryBlock
 * @package PlanetBio\Blocks
 *
 * @property string Color
 *
 * @method HasManyList GalleryItems()
 */
class GalleryBlock extends BaseElement
{
    private static $table_name = 'Blocks_GalleryBlock';

    private static $singular_name = 'Gallery block';

    private static $plural_name = 'Gallery blocks';

    private static $icon = 'font-icon-block-carousel';

    private static $db = [
        'Color' => 'Varchar(9)'
    ];

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

    public function getCMSFields()
    {
        $this->beforeUpdateCMSFields(function (FieldList $fields) {
            /** @var GridField $gridField */
            $gridField = $fields->fieldByName('Root.GalleryItems.GalleryItems');
            if ($gridField && $this->exists()) {
                $fields->removeByName('GalleryItems');
                $fields->insertAfter('Color', $gridField);
                $config = $gridField->getConfig();
                $config->removeComponentsByType(new GridFieldDataColumns());
                $config->addComponent(new BulkUploader(null, null, true));
                $config->addComponent(new GridFieldEditableColumns(), new GridFieldEditButton());
                $config->addComponent(new GridFieldOrderableRows());
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

    public function getType()
    {
        return _t(__CLASS__ . '.BlockType', 'Gallery');
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
