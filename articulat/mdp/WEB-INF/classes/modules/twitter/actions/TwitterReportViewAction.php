<?php

class TwitterReportViewAction extends BaseListAction {
	
	function __construct() {
		parent::__construct('TwitterTweet');
	}
	
	protected function preList() {
		parent::preList();

		$this->module = "Twitter";
		
		$campaign = CampaignQuery::create()->findOneById($_POST['filters']['campaignid']);
		
		if(!is_object($campaign))
			return false;
			
		$this->notPaginated = true;
			
		if(empty($_POST['value'])) 
			$this->filters['value'] = array(0,TwitterTweet::POSITIVE,TwitterTweet::NEUTRAL,TwitterTweet::NEGATIVE);
		else
			$this->filters['value'] = $_POST['value'];
		if(empty($_POST['relevance'])) 
			$this->filters['relevance'] = array(0,TwitterTweet::RELEVANT,TwitterTweet::NEUTRALLY_RELEVANT,TwitterTweet::IRRELEVANT);
		else
			$this->filters['relevance'] = $_POST['relevance'];
		if(empty($_POST['type']))
			$this->filters['type'] = 0;
		else
			$this->filters['type'] = $_POST['type'];

		$this->filters['status'] = TwitterTweet::ACCEPTED;
		$this->filters['orderByCreatedat'] = "desc";

		
		//if(!isset($_POST['from']) && !isset($_POST['to'])){
			if(!empty($_POST['time']))
				$this->filters['dateRange']['createdat']['min'] = Common::getDatetimeOnGMT(date('Y-m-d H:i:s',strtotime($_POST['time'])));
			else
				$this->filters['dateRange']['createdat']['min'] = Common::getDatetimeOnGMT(date('Y-m-d H:i:s',strtotime($campaign->getStartdate())));
			$this->filters['dateRange']['createdAt']['max'] = Common::getDatetimeOnGMT(date('Y-m-d H:i:s'));
		//}

	}

	protected function postList() {
		parent::postList();

		$this->smarty->assign("module", $this->module);
			
		$this->smarty->assign("values", TwitterTweet::getValues());
		$this->smarty->assign("relevances", TwitterTweet::getRelevances());

		$this->template->template = "TemplatePrint.tpl";
		
		$moduleConfig = Common::getModuleConfiguration($this->module);
		
	}

}

