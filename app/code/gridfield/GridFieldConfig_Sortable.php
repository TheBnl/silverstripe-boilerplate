<?php
/**
 * GridFieldConfig_Versioned.php
 *
 * @author Bram de Leeuw
 * Date: 03/10/16
 */

use SilverStripe\Forms\GridField\GridFieldAddNewButton;
use SilverStripe\Forms\GridField\GridFieldConfig;
use SilverStripe\Forms\GridField\GridFieldDataColumns;
use SilverStripe\Forms\GridField\GridFieldDeleteAction;
use SilverStripe\Forms\GridField\GridFieldDetailForm;
use SilverStripe\Forms\GridField\GridFieldEditButton;
use SilverStripe\Forms\GridField\GridFieldPaginator;
use SilverStripe\Forms\GridField\GridFieldToolbarHeader;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;
use Symbiote\GridFieldExtensions\GridFieldTitleHeader;

/**
 * Class GridFieldConfig_Sortable
 */
class GridFieldConfig_Sortable extends GridFieldConfig
{

    /**
     * GridFieldConfig_Sortable constructor.
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
        $this->addComponent(new GridFieldDetailForm());
        $this->addComponent(new GridFieldEditButton());
        $this->addComponent(new GridFieldDeleteAction());
        $this->addComponent(new GridFieldOrderableRows($sortField));
        $this->addComponent($pagination = new GridFieldPaginator($itemsPerPage));

        $pagination->setThrowExceptionOnBadDataType(false);
    }
}