<?php
/**
 * RegionsListAction
 *
 * Listado de Region extendiendo BaseListAction
 *
 * @package    region
 */

class RegionsListAction extends BaseListAction {
	
	function __construct() {
		parent::__construct('Region');
	}

	protected function preList() {
		parent::preList();
		$this->module = "Region";
	}

	protected function postList() {
		parent::postList();
		$this->smarty->assign("module", $this->module);

		$regionTypes = RegionPeer::getRegionTypesTranslated();
		$this->smarty->assign("regionTypes",$regionTypes);

	}
}
