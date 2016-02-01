<?php
/**
 * myGridFieldConfigExtension.php
 *
 * @author Bram de Leeuw
 * Date: 11/01/16
 */


class GridFieldConfig_Editable extends GridFieldConfig {

	/**
	 * @param int $itemsPerPage - How many items per page should show up
	 */
	public function __construct($itemsPerPage=null) {

		$this->addComponent(new GridFieldToolbarHeader());
		$this->addComponent(new GridFieldTitleHeader());
		$this->addComponent(new GridFieldEditableColumns());
		$this->addComponent(new GridFieldEditButton());
		$this->addComponent(new GridFieldDeleteAction());
		$this->addComponent(new GridFieldOrderableRows("SortOrder"));
		$this->addComponent(new GridFieldAddNewButton("toolbar-header-right"));
		$this->addComponent(new GridFieldDetailForm());
		$this->addComponent($pagination = new GridFieldPaginator($itemsPerPage));
		$this->getComponentByType('GridFieldAddNewButton')->setButtonName("Add New");

		$pagination->setThrowExceptionOnBadDataType(false);
	}
}

class GridFieldConfig_Sortable extends GridFieldConfig {

	/**
	 * @param int $itemsPerPage - How many items per page should show up
	 */
	public function __construct($itemsPerPage=null) {

		$this->addComponent(new GridFieldToolbarHeader());
		$this->addComponent(new GridFieldTitleHeader());
		$this->addComponent(new GridFieldAddNewButton("toolbar-header-right"));
		$this->addComponent(new GridFieldDataColumns());
		$this->addComponent(new GridFieldEditButton());
		$this->addComponent(new GridFieldDeleteAction());
		$this->addComponent(new GridFieldDetailForm());
		$this->addComponent(new GridFieldOrderableRows("SortOrder"));
		$this->addComponent($pagination = new GridFieldPaginator($itemsPerPage));
		$this->getComponentByType('GridFieldAddNewButton')->setButtonName("Add New");

		$pagination->setThrowExceptionOnBadDataType(false);
	}
}

class GridFieldConfig_SortableGallery extends GridFieldConfig {

	/**
	 * @param int $itemsPerPage - How many items per page should show up
	 */
	public function __construct($itemsPerPage=null) {

		$this->addComponent(new GridFieldToolbarHeader());
		$this->addComponent(new GridFieldTitleHeader());
		$this->addComponent(new GridFieldAddNewButton("toolbar-header-right"));
		$this->addComponent(new GridFieldEditableColumns());
		//$this->addComponent(new GridFieldDataColumns());
		$this->addComponent(new GridFieldDeleteAction());
		$this->addComponent(new GridFieldOrderableRows("SortOrder"));
		$this->addComponent(new GridFieldBulkUpload());
		$this->addComponent(new GridFieldBulkManager());
		$this->addComponent($pagination = new GridFieldPaginator($itemsPerPage));
		$this->getComponentByType('GridFieldAddNewButton')->setButtonName("Add New");

		$pagination->setThrowExceptionOnBadDataType(false);
	}
}