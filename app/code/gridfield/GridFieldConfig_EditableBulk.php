<?php
/**
 * GridFieldConfig_Versioned.php
 *
 * @author Bram de Leeuw
 * Date: 03/10/16
 */

use SilverStripe\Forms\GridField\GridFieldConfig;
use SilverStripe\Forms\GridField\GridFieldDeleteAction;
use SilverStripe\Forms\GridField\GridFieldDetailForm;
use SilverStripe\Forms\GridField\GridFieldEditButton;
use SilverStripe\Forms\GridField\GridFieldPaginator;
use SilverStripe\Forms\GridField\GridFieldToolbarHeader;
use Symbiote\GridFieldExtensions\GridFieldAddNewInlineButton;
use Symbiote\GridFieldExtensions\GridFieldEditableColumns;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;
use Symbiote\GridFieldExtensions\GridFieldTitleHeader;

/**
 * Class GridFieldConfig_EditableBulk
 */
class GridFieldConfig_EditableBulk extends GridFieldConfig
{

    /**
     * GridFieldConfig_EditableBulk constructor.
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
        $this->addComponent(new GridFieldDetailForm());
        // todo bulkupload compatible with ss4
        //$this->addComponent(new GridFieldBulkUpload());
        //$this->addComponent(new GridFieldBulkManager());
        $this->addComponent(new GridFieldEditButton());
        $this->addComponent(new GridFieldDeleteAction());
        $this->addComponent(new GridFieldOrderableRows($sortField));
        $this->addComponent($pagination = new GridFieldPaginator($itemsPerPage));

        $pagination->setThrowExceptionOnBadDataType(false);
    }
}