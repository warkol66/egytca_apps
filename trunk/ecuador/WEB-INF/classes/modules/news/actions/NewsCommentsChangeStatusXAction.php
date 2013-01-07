<?php

class NewsCommentsChangeStatusXAction extends BaseDoEditAction {
	
	function __construct() {
		parent::__construct('NewsComment');
	}
	
	protected function postUpdate(){
		parent::postUpdate();
		
		$module = "News";
		$this->smarty->assign("module",$module);
	}

}
