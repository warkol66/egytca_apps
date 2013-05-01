<?php

class BoardBondsDoEditXAction extends BaseDoEditAction {
	
	function __construct() {
		parent::__construct('BoardBond');
	}
	
	protected function postUpdate() {
		parent::postUpdate();
		
		$this->smarty->assign('boardBond', $this->entity);
	}

}
