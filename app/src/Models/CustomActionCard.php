<?php

namespace XD\Basic\Models;

use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\Image;
use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Forms\HeaderField;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\TreeDropdownField;
use SilverStripe\ORM\DataObject;
use SilverStripe\View\ViewableData;
use XD\Basic\Extensions\HasLink;
use XD\Basic\Interfaces\ProvidesActionCard;
use XD\Basic\Util\Colors;
use XD\IconSelectField\Forms\IconSelectField;

/**
 * @property string Title
 * @property string Content
 * @property string Color
 * @property string Type
 */
class CustomActionCard extends DataObject implements ProvidesActionCard
{
    private static $table_name = 'CustomActionCard';

    private static $db = [
        'Label' => 'Varchar',
        'Title' => 'Varchar',
        'Content' => 'HTMLText',
        'Color' => 'Varchar',
        'Icon' => 'Icon',
        'Sort' => 'Int',
    ];

    private static $default_sort = 'Sort ASC';

    private static $summary_fields = [
        'Image.StripThumbnail' => 'Image',
        'SummaryTitle' => 'Title',
    ];

    private static $has_one = [
        'Parent' => DataObject::class,
        'ActionCardPage' => SiteTree::class,
        'Image' => Image::class,
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
        $fields->removeByName(['Sort']);
        // $fields->removeByName(['Sort', 'ParentID', 'Label', 'Title', 'Content', 'Color', 'Icon', 'ActionCardPageID', 'ImageID', 'Image',]);
        $fields->addFieldsToTab('Root.Main', [
            HeaderField::create('UsePage', 'Koppel aan pagina:'),
            TreeDropdownField::create('ActionCardPageID', _t(__CLASS__ . '.ActionCardPage', 'Pagina'), SiteTree::class),
            HeaderField::create('OrCustom', 'Of gebruik eigen inhoud:'),
        ], 'Label');

        $fields->addFieldsToTab('Root.Instellingen', [
            Colors::getField('Color'),
            IconSelectField::create('Icon'),
        ]);
        
        if ($contentField = $fields->fieldByName('Root.Main.Content')) {
            $contentField->setRows(6);
        }

        return $fields;
    }

    public function provideActionCard(): ViewableData
    {
        if (($page = $this->ActionCardPage()) && $page->exists() && $page->hasMethod('provideActionCard')) {
            return $page->provideActionCard();
        }

        $data = $this->data();
        $data->Color = $this->ParentID && $this->Parent()->CardColor ? $this->Parent()->CardColor : $this->Color;
        return $data;
    }

    public function getSummaryTitle()
    {
        if (($page = $this->ActionCardPage()) && $page->exists()) {
            return _t(__CLASS__ . '.LinkedTo', 'Gekoppeld aan {page}', null, [
                'page' => $page->Title
            ]);
        }

        return $this->Title;
    }
}
