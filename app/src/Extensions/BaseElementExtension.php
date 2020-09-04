<?php

namespace XD\Basic\Extensions;

use DNADesign\Elemental\Models\BaseElement;
use DNADesign\ElementalVirtual\Model\ElementVirtual;
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
        $class = ClassInfo::shortName($this->owner);
        if( get_class($this->owner)==ElementVirtual::class ){
            if( $linkedElement = $this->owner->LinkedElement() ){
                $class = $class . ' ' . ClassInfo::shortName($linkedElement);
            }
        }
        return strtolower(preg_replace('/([a-zA-Z])(?=[A-Z])/', '$1-', $class));
    }
}
