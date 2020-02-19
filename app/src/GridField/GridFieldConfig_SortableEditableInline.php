<?php

namespace XD\Basic\GridField;

use SilverStripe\Forms\GridField\GridFieldAddNewButton;
use Symbiote\GridFieldExtensions\GridFieldAddNewInlineButton;

/**
 * Class GridFieldConfig_SortableEditableInline
 * @package XD\Basic\GridField
 */
class GridFieldConfig_SortableEditableInline extends GridFieldConfig_SortableEditable
{
    public function __construct($itemsPerPage = null, $sortField = 'Sort')
    {
        parent::__construct($itemsPerPage, $sortField);
        $this->removeComponentsByType(new GridFieldAddNewButton());
        $this->addComponent(new GridFieldAddNewInlineButton());
    }
}