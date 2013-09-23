<?php

class TwitterUsersEditXAction extends BaseEditAction {
	
	function __construct() {
		parent::__construct('TwitterUser');
	}
	
	protected function preEdit() {
		parent::preEdit();

		$this->module = "Twitter";

	}

	protected function postEdit() {
		parent::postEdit();

		$this->smarty->assign("module", $this->module);
		
		$moduleConfig = Common::getModuleConfiguration($this->module);
		
	}

}
