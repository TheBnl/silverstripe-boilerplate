<?php
/**
 * GridFieldConfig_Versioned.php
 *
 * @author Bram de Leeuw
 * Date: 03/10/16
 */

/**
 * Class GridFieldConfig_VersionedSortable
 */
class GridFieldConfig_VersionedSortable extends GridFieldConfig
{

    /**
     * GridFieldConfig_SortableVersioned constructor.
     *
     * @param int $itemsPerPage
     * @param string $sortField
     */
    public function __construct($itemsPerPage = 999, $sortField = 'Sort')
    {
        parent::__construct();
        $this->addComponent(new GridFieldToolbarHeader());
        $this->addComponent(new GridFieldTitleHeader());
        $this->addComponent(new GridFieldAddNewButton('toolbar-header-right'));
        $this->addComponent(new GridFieldDataColumns());
        $this->addComponent(new VersionedDataObjectDetailsForm());
        $this->addComponent(new VersionedGridFieldDeleteAction());
        $this->addComponent(new VersionedGridFieldOrderableRows($sortField));
        $this->addComponent(new GridFieldEditButton());
        $this->addComponent($pagination = new GridFieldPaginator($itemsPerPage));

        $pagination->setThrowExceptionOnBadDataType(false);
    }
}