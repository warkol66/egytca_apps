<?php

class TwitterUsersListAction extends BaseListAction {
	
	function __construct() {
		parent::__construct('TwitterUser');
	}
	
	protected function preList() {
		parent::preList();

		$this->module = "Twitter";
		
		if(!empty($_GET['filters']['campaignid'])){
			$this->filters['getByCampaign'] = $_GET['filters']['campaignid'];
		}

		if(!empty($_GET['filters']['minDate'])){
            $this->filters['dateRange']['createdat']['min'] = $_GET['filters']['minDate'];
        }
        if(!empty($_GET['filters']['maxDate'])){
            $this->filters['dateRange']['createdat']['max'] = $_GET['filters']['maxDate'];
		}

	}

	protected function postList() {
		parent::postList();

		$this->smarty->assign("module", $this->module);
		
		$moduleConfig = Common::getModuleConfiguration($this->module);
		$this->smarty->assign('moduleConfig',$moduleConfig);
		
		$this->smarty->assign('campaigns',CampaignQuery::getTwitterActive(15, true));
		$this->smarty->assign('levels',TwitterUser::getInfluenceLevels());
		
		if(!empty($_GET['filters']['dateRange']['createdat']['min']))
            $this->filters['minDate'] = $_GET['filters']['dateRange']['createdat']['min'];
        if(!empty($_GET['filters']['dateRange']['createdat']['max']))
            $this->filters['maxDate'] = $_GET['filters']['dateRange']['createdat']['max'];
	}

}
