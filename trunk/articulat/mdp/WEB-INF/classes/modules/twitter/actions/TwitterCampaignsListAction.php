<?php

class TwitterCampaignsListAction extends BaseListAction {
	
	function __construct() {
		parent::__construct('Campaign');
	}
	
	protected function preList() {
		parent::preList();

		$this->module = "Twitter";
		
		$this->filters['Twittercampaign'] = true;

	}

	protected function postList() {
		parent::postList();

		$this->smarty->assign("module", $this->module);
		
		$moduleConfig = Common::getModuleConfiguration($this->module);
		$this->smarty->assign("moduleConfig",$moduleConfig);		
		
	}

}
