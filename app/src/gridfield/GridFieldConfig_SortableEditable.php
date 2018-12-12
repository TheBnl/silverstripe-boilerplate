<?php

namespace XD\Basic;

use Symbiote\GridFieldExtensions\GridFieldEditableColumns;

/**
 * Class GridFieldConfig_SortableEditable
 */
class GridFieldConfig_SortableEditable extends GridFieldConfig_Sortable
{
    /**
     * GridFieldConfig_SortableEditable constructor.
     *
     * @param int $itemsPerPage
     * @param string $sortField
     */
    public function __construct($itemsPerPage = null, $sortField = 'Sort')
    {
        parent::__construct($itemsPerPage, $sortField);
        $this->addComponent(new GridFieldEditableColumns());
    }
}