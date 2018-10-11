<?php
/**
 * GridFieldConfig_Versioned.php
 *
 * @author Bram de Leeuw
 * Date: 03/10/16
 */

use Heyday\VersionedDataObjects\VersionedDataObjectDetailsForm;
use Heyday\VersionedDataObjects\VersionedGridFieldOrderableRows;
use SilverStripe\Forms\GridField\GridFieldConfig;
use SilverStripe\Forms\GridField\GridFieldDataColumns;
use SilverStripe\Forms\GridField\GridFieldEditButton;
use SilverStripe\Forms\GridField\GridFieldPaginator;
use SilverStripe\Forms\GridField\GridFieldToolbarHeader;
use Symbiote\GridFieldExtensions\GridFieldAddNewMultiClass;
use Symbiote\GridFieldExtensions\GridFieldTitleHeader;

/**
 * Class GridFieldConfig_SortableVersionedMultiClass
 */
class GridFieldConfig_MultiClass extends GridFieldConfig
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