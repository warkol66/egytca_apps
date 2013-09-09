<?php

class TwitterDoEditXAction extends BaseDoEditAction {
	
	function __construct() {
		parent::__construct('TwitterTweet');
	}
	
	protected function preSave() {
		parent::preSave();

		$this->module = "Twitter";

	}

	protected function postSave() {
		parent::postSave();

		$this->smarty->assign("module", $this->module);
		
		$moduleConfig = Common::getModuleConfiguration($this->module);
		
	}

}
