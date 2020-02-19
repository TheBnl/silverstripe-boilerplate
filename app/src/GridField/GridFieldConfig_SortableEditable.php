<?php

namespace XD\Basic\GridField;

use SilverStripe\Forms\GridField\GridFieldDataColumns;
use SilverStripe\Forms\GridField\GridFieldEditButton;
use Symbiote\GridFieldExtensions\GridFieldEditableColumns;

/**
 * Class GridFieldConfig_SortableEditable
 * @package XD\Basic\GridField
 */
class GridFieldConfig_SortableEditable extends GridFieldConfig_Sortable
{
    public function __construct($itemsPerPage = null, $sortField = 'Sort')
    {
        parent::__construct($itemsPerPage, $sortField);
        $this->removeComponentsByType(new GridFieldDataColumns());
        $this->addComponent(new GridFieldEditableColumns(), new GridFieldEditButton());
    }
}