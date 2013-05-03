<?php

class BoardCommentsShowAction extends BaseEditAction {

	function __construct() {
		parent::__construct('BoardChallenge');
	}
	
	protected function postEdit() {
		parent::postEdit();
		
		$module = "Board";
		$this->smarty->assign("module",$module);
		
		$this->smarty->assign($comments, $this->entity->getBoardComments());
	}

}
