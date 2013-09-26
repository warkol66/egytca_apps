<?php

class TwitterParsedViewXAction extends BaseEditAction {
	
	function __construct() {
		parent::__construct('TwitterTweet');
	}
	
	protected function preEdit() {
		parent::preEdit();

		$this->module = "Twitter";

	}

	protected function postEdit() {
		parent::postEdit();
		
		$this->smarty->assign("twitterTweet", $this->entity);
		
		$this->smarty->assign("module", $this->module);
		$moduleConfig = Common::getModuleConfiguration($this->module);
		
	}

}
