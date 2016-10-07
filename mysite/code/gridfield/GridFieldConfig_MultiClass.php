<?php
/**
 * GridFieldConfig_Versioned.php
 *
 * @author Bram de Leeuw
 * Date: 03/10/16
 */

/**
 * Class GridFieldConfig_SortableVersionedMultiClass
 */
class GridFieldConfig_SortableVersionedMultiClass extends GridFieldConfig
{

    /**
     * GridFieldConfig_SortableVersionedMultiClass constructor.
     *
     * @param array $availableClasses
     * @param int $itemsPerPage
     * @param string $sortField
     */
    public function __construct($availableClasses = array(), $itemsPerPage = 999, $sortField = 'Sort')
    {
        parent::__construct();

        $this->addComponent(new GridFieldToolbarHeader());
        $this->addComponent(new GridFieldTitleHeader());
        $this->addComponent(new GridFieldDataColumns());
        $this->addComponent(new VersionedDataObjectDetailsForm());
        $this->addComponent(new VersionedGridFieldDeleteAction());
        $this->addComponent(new VersionedGridFieldOrderableRows($sortField));
        $this->addComponent(new GridFieldEditButton());
        $this->addComponent($multiClassComponent = new GridFieldAddNewMultiClass());
        $this->addComponent($pagination = new GridFieldPaginator($itemsPerPage));

        $multiClassComponent->setClasses($availableClasses);
        $pagination->setThrowExceptionOnBadDataType(false);
    }
}