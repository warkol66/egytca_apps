<?php

class BoardBondsListAction extends BaseListAction {
	
	function __construct() {
		parent::__construct('BoardBond');
	}

	protected function postList() {
		parent::postList();
		
		$module = "Board";
		$this->smarty->assign("module", $module);

	}

}
