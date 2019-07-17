<?php

namespace XD\Basic\Extensions;

use DNADesign\Elemental\Models\BaseElement;
use DNADesign\ElementalList\Model\ElementList;
use SilverStripe\Core\ClassInfo;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\LiteralField;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\DataExtension;
use XD\Basic\Util;

/**
 * Class BaseElementExtension
 * @package XD\Basic
 *
 * @property BaseElement|BaseElementExtension owner
 * @property boolean FullWidth
 * @property string BlockSize
 */
class BaseElementExtension extends DataExtension
{
    const BLOCK_SIZE_SMALL = 'SMALL';
    const BLOCK_SIZE_MEDIUM = 'MEDIUM';
    const BLOCK_SIZE_LARGE = 'LARGE';
    const BLOCK_SIZE_FULL = 'FULL';
    const BLOCK_SIZE_AUTO = 'AUTO';

    private static $db = [
        'FullWidth' => 'Boolean',
        'BlockSize' => 'Enum("SMALL,MEDIUM,LARGE,FULL,AUTO", "AUTO")'
    ];

    public function updateCMSFields(FieldList $fields)
    {
        $fields->removeByName('BlockSize');
        $page = $this->owner->getPage();
        if ($page && $page->ClassName === ElementList::class) {
            $fields->addFieldsToTab('Root.Settings', [
                DropdownField::create(
                    'BlockSize',
                    _t(__CLASS__ . '.BlockSize', 'Size of the block in this list'),
                    Util::friendlyEnum($this->owner, 'BlockSize')
                )
            ]);
        }
        
        $fields->addFieldsToTab('Root.Settings', [
            CheckboxField::create('FullWidth', _t(__CLASS__ . '.FullWidth', 'Span block full window width'))
        ]);
    }

    /**
     * @return string
     */
    public function getBemClassName()
    {
        return strtolower(preg_replace('/([a-zA-Z])(?=[A-Z])/', '$1-', ClassInfo::shortName($this->owner)));
    }

    /**
     * Only used in the context of a ElementList
     * @see ElementList
     *
     * @return string
     */
    public function getListSizeClass()
    {
        switch ($this->owner->BlockSize) {
            case self::BLOCK_SIZE_SMALL:
                return 'medium-4';
            case self::BLOCK_SIZE_MEDIUM:
                return 'medium-6';
            case self::BLOCK_SIZE_LARGE:
                return 'medium-8';
            case self::BLOCK_SIZE_FULL:
                return 'medium-12';
            default: case self::BLOCK_SIZE_AUTO:
                return 'auto';
        }
    }
}