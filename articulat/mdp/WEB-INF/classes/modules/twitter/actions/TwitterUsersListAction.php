<?php

class TwitterUsersListAction extends BaseListAction {
	
	function __construct() {
		parent::__construct('TwitterUser');
	}
	
	protected function preList() {
		parent::preList();

		$this->module = "Twitter";

		if(!empty($_GET['filters']['minDate'])){
            $this->filters['dateRange']['createdat']['min'] = $_GET['filters']['minDate'];
        }
        if(!empty($_GET['filters']['maxDate'])){
            $this->filters['dateRange']['createdat']['max'] = $_GET['filters']['maxDate'];
		}
		
		/*$asoc = TwitterUserQuery::getCandidateActor(1);
		echo"<pre>"; print_r($asoc); echo "</pre>";
		die();*/
		
		print_r($this->filters);
		

	}

	protected function postList() {
		parent::postList();

		$this->smarty->assign("module", $this->module);
		
		echo"<pre>"; print_r($this->results); echo "</pre>";
		die();
		
		$moduleConfig = Common::getModuleConfiguration($this->module);
		$this->smarty->assign('moduleConfig',$moduleConfig);
		
		$this->smarty->assign('campaigns',CampaignQuery::getMostRecent(15, true));
		$this->smarty->assign('levels',TwitterUser::getInfluenceLevels());
		
		if(!empty($_GET['filters']['dateRange']['createdat']['min']))
            $this->filters['minDate'] = $_GET['filters']['dateRange']['createdat']['min'];
        if(!empty($_GET['filters']['dateRange']['createdat']['max']))
            $this->filters['maxDate'] = $_GET['filters']['dateRange']['createdat']['max'];
	}

}
