<?php

namespace XD\Basic\Extensions;

use DNADesign\Elemental\Models\BaseElement;
use DNADesign\ElementalVirtual\Model\ElementVirtual;
use SilverStripe\Core\ClassInfo;
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
        $class = ClassInfo::shortName($this->owner);
        if ($this->owner instanceof ElementVirtual && $linkedElement = $this->owner->LinkedElement()) {
            $class = $class . ' ' . ClassInfo::shortName($linkedElement);
        }

        return Util::cssClassName($class);
    }

    public function getPageBemClassName()
    {
        if (($page = $this->owner->getPage()) && $page->exists()) {
            $pageBemClassName = $page->getBemClassName();
            return Util::cssClassName("{$pageBemClassName}-content-block");
        }

        return null;
    }

}
