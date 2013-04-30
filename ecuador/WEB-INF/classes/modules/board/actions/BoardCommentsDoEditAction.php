<?php

class BoardCommentsDoEditAction extends BaseDoEditAction {
	
	function __construct() {
		parent::__construct('BoardComment');
	}
	
	protected function postUpdate() {
		parent::postUpdate();
		
		$this->smarty->assign("module","Board");
		
		$challenge = $this->entity->getBoardchallenge();
		if(!is_object($challenge))
			$this->smarty->assign("noChallenge",true);
		
	}

}
