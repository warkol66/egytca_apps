<?php

class BoardCommentsEditAction extends BaseEditAction {

	function __construct() {
		parent::__construct('BoardComment');
	}

	protected function postEdit() {
		parent::postEdit();
		
		$module = "Board";
		$this->smarty->assign("module",$module);

		$this->smarty->assign("statusOptions",BoardComment::getStatusOptions());
		$this->smarty->assign("challengeIdValues",BoardChallengeQuery::create()->find());
		$this->smarty->assign("userIdValues",UserQuery::create()->find());
		
	}

}
