<?php

class TwitterDoEditXAction extends BaseDoEditAction {
	
	function __construct() {
		parent::__construct('TwitterTweet');
	}
	
	protected function preUpdate() {
		parent::preUpdate();
		unset($this->entityParams["userId"]);
		$this->module = "Twitter";
	}

	protected function postSave() {
		parent::postSave();

		$this->smarty->assign("module", $this->module);
		$this->smarty->assign("tweet", $this->entity);
		
		if(isset($_POST['parsed']))
			$this->smarty->assign('parsed', true);
		
		$moduleConfig = Common::getModuleConfiguration($this->module);
		
	}

}
