<?php

class BoardCommentsListAction extends BaseListAction {
	
	function __construct() {
		parent::__construct('BoardComment');
	}
	
	protected function preList(){
		parent::preList();
		
		$this->filters['selectParents'] = true;
		
	}
	
	protected function postList(){
		parent::postList();
		
		$this->smarty->assign("module","Board");
		$this->smarty->assign("section","Comments");
		
		$this->smarty->assign("challenges", BoardChallengeQuery::create()->find());
	}

}
