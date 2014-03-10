<?php

class BoardCommentsShowAction extends BaseSelectAction {

	function __construct() {
		parent::__construct('BoardChallenge');
	}
	
	protected function postSelect() {
		parent::postSelect();
		
		$module = "Board";
		$this->smarty->assign("module",$module);
		
		$this->smarty->assign($comments, $this->entity->getBoardComments());
	}

}
