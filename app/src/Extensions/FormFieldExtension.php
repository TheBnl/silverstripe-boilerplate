<?php

namespace XD\Basic\Extensions;

use SilverStripe\Core\Extension;
use SilverStripe\Forms\FormField;
use SilverStripe\ORM\FieldType\DBHTMLText;

/**
 * @property FormField owner
 */
class FormFieldExtension extends Extension
{
    public function onBeforeRenderHolder(FormField &$context, $properties)
    {
        if ($context->Required() && $title = $context->Title()) {
            $title .= ' <span class="required-star">*</span>';
            $context->setTitle(DBHTMLText::create()->setValue($title));            
        }
    }
}
