<?php

namespace XD\Basic\Extensions;

use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Core\ClassInfo;
use SilverStripe\ORM\DataExtension;

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
        $class = strtolower(preg_replace('/([a-zA-Z])(?=[A-Z])/', '$1-', ClassInfo::shortName($this->owner)));
        if( $class=='element-virtual' && $this->owner->LinkedElementID ){
            $class .= ' ' . strtolower(preg_replace('/([a-zA-Z])(?=[A-Z])/', '$1-', ClassInfo::shortName($this->owner->LinkedElement())));
        }
        return $class;
    }
}
