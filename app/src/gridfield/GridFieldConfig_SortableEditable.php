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
     * @param boolean $versioned
     */
    public function __construct($itemsPerPage = null, $sortField = 'Sort', $versioned = false)
    {
        parent::__construct($itemsPerPage, $sortField, $versioned);
        $this->addComponent(new GridFieldEditableColumns());
    }
}