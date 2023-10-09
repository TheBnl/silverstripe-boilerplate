<?php

namespace XD\Basic\Extensions;

use SilverStripe\Core\Extension;
use SilverStripe\Forms\Form;

/**
 * @property Form owner
 */
class FormExtension extends Extension
{
    public function updateAttributes(&$attributes)
    {
        // TODO: check front end ?
        // hook into bs validation
        // $attributes['novalidate'] = 'novalidate';
    }
}

