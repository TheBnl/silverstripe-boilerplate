<?php

namespace XD\Basic\GridField;

use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;

/**
 * Class GridFieldConfig_Sortable
 * @package XD\Basic\GridField
 */
class GridFieldConfig_Sortable extends GridFieldConfig_RecordEditor
{
    public function __construct($itemsPerPage = null, $sortField = 'Sort')
    {
        parent::__construct($itemsPerPage);
        $this->addComponent(new GridFieldOrderableRows($sortField));
    }
}