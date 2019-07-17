<?php

namespace XD\Basic\GridField;

use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;

/**
 * Class GridFieldConfig_Sortable
 */
class GridFieldConfig_Sortable extends GridFieldConfig_RecordEditor
{
    /**
     * GridFieldConfig_Sortable constructor.
     *
     * @param int $itemsPerPage
     * @param string $sortField
     * @param boolean $versioned
     */
    public function __construct($itemsPerPage = null, $sortField = 'Sort', $versioned = false)
    {
        parent::__construct($itemsPerPage);
        if ($versioned) {
            //$this->addComponent(new GridFieldVersionedOrderableRows($sortField));
        } else {
            $this->addComponent(new GridFieldOrderableRows($sortField));
        }
    }
}