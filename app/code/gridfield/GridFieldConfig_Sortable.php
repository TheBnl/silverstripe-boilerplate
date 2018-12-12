<?php

namespace XD\Basic;

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
     */
    public function __construct($itemsPerPage = null, $sortField = 'Sort')
    {
        parent::__construct($itemsPerPage);
        $this->addComponent(new GridFieldOrderableRows($sortField));
    }
}