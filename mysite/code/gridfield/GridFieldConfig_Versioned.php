<?php
/**
 * GridFieldConfig_Versioned.php
 *
 * @author Bram de Leeuw
 * Date: 03/10/16
 */

/**
 * Class GridFieldConfig_Versioned
 */
class GridFieldConfig_Versioned extends GridFieldConfig
{

    /**
     * GridFieldConfig_MyBase constructor.
     *
     * @param int $itemsPerPage
     */
    public function __construct($itemsPerPage = 999)
    {
        parent::__construct();

        $this->addComponent(new GridFieldToolbarHeader());
        $this->addComponent(new GridFieldTitleHeader());
        $this->addComponent(new GridFieldAddNewButton('toolbar-header-right'));
        $this->addComponent(new GridFieldDataColumns());
        $this->addComponent(new VersionedDataObjectDetailsForm());
        $this->addComponent(new VersionedGridFieldDeleteAction());
        $this->addComponent(new GridFieldEditButton());
        $this->addComponent($pagination = new GridFieldPaginator($itemsPerPage));

        $pagination->setThrowExceptionOnBadDataType(false);
    }
}