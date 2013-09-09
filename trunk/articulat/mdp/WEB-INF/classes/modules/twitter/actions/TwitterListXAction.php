<?php

class TwitterListXAction extends BaseListAction {
	
	function __construct() {
		parent::__construct('TwitterTweet');
	}
	
	protected function preList() {
		parent::preList();

		$this->module = "Twitter";
		
		if($_POST['campaignId'])
			$this->filters['campaignid'] = $_POST['campaignId'];
		
		//TODO: ver como manejar esto con seleccion de campaign
		if(!empty($_GET['filters']['unprocessed'])){
			$this->filters['Status'] = TwitterTweet::PARSED;
		}elseif(!empty($_GET['filters']['discarded'])){
			$this->filters['Status'] = TwitterTweet::DISCARDED;
		}elseif(!empty($_GET['filters']['all'])){
			$this->filters['maxStatus'] = TwitterTweet::DISCARDED;
		}else{
			$this->filters['Status'] = TwitterTweet::ACCEPTED;
		}

	}

	protected function postList() {
		parent::postList();

		$this->smarty->assign("module", $this->module);
		
		$moduleConfig = Common::getModuleConfiguration($this->module);
		$this->smarty->assign("tweetValues",TwitterTweet::getValues());
		$this->smarty->assign("tweetRelevances",TwitterTweet::getRelevances());
		$this->smarty->assign("tweetStatuses",TwitterTweet::getStatuses());
		$this->smarty->assign("moduleConfig",$moduleConfig);
		
		
	}

}
