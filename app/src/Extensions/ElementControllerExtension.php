<?php

namespace XD\Basic\Extensions;

use SilverStripe\Core\Extension;

class ElementControllerExtension extends Extension
{
    public function onAfterInit()
    {
        $element = $this->owner->getElement();
        if ($element->hasMethod('init')) {
            $element->init();
        }
    }
}