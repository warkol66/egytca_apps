<?php

class BoardCommentsEditAction extends BaseSelectAction {

	function __construct() {
		parent::__construct('BoardComment');
	}

	protected function postSelect() {
		parent::postSelect();
		
		$module = "Board";
		$this->smarty->assign("module",$module);

		$this->smarty->assign("statusOptions",BoardComment::getStatusOptions());
		//Arreglar para que busque solo el actual y proximos
		$this->smarty->assign("challengeIdValues",BoardChallengeQuery::create()->find());
		$this->smarty->assign("bonds",BoardBondQuery::create()->find());
		$this->smarty->assign("userIdValues",UserQuery::create()->find());
		
		if(isset($_REQUEST['id']))
			$this->smarty->assign("children",BoardComment::selectChildren($this->entity->getId()));
		
	}

}
