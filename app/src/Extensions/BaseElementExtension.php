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
 */
class BaseElementExtension extends DataExtension
{
    /**
     * @return string
     */
    public function getBemClassName()
    {
        return strtolower(preg_replace('/([a-zA-Z])(?=[A-Z])/', '$1-', ClassInfo::shortName($this->owner)));
    }
}