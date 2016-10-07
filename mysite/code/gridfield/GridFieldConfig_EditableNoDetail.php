<?php
/**
 * GridFieldConfig_Versioned.php
 *
 * @author Bram de Leeuw
 * Date: 03/10/16
 */

/**
 * Class GridFieldConfig_EditableNoDetail
 */
class GridFieldConfig_EditableNoDetail extends GridFieldConfig
{

    /**
     * GridFieldConfig_EditableNoDetail constructor.
     *
     * @param int $itemsPerPage
     * @param string $sortField
     */
    public function __construct($itemsPerPage = 999, $sortField = 'Sort')
    {
        parent::__construct();

        $this->addComponent(new GridFieldToolbarHeader());
        $this->addComponent(new GridFieldTitleHeader());
        $this->addComponent(new GridFieldEditableColumns());
        $this->addComponent(new GridFieldAddNewInlineButton("toolbar-header-right"));
        $this->addComponent(new GridFieldDeleteAction());
        $this->addComponent(new GridFieldOrderableRows($sortField));
        $this->addComponent($pagination = new GridFieldPaginator($itemsPerPage));

        $pagination->setThrowExceptionOnBadDataType(false);
    }
}