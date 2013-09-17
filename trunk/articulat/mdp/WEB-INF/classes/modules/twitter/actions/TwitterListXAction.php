<?php

class TwitterListXAction extends BaseListAction {
	
	function __construct() {
		parent::__construct('TwitterTweet');
	}
	
	protected function preList() {
		parent::preList();

		$this->module = "Twitter";
		
		//si no selecciono campaña salgo
		if(!isset($_POST['campaignId'])){
			$this->smarty->assign('noCampaign',true);
			$this->forwardFailureName = 'success';
			return false;
		}
		
		$this->filters['campaignid'] = $_POST['campaignId'];
		$this->smarty->assign("campaignid",$_POST['campaignId']);
		//ver por que no anda sin esto
		if(!empty($_POST['filters']['dateRange']['createdat']['min']) && !empty($_POST['filters']['dateRange']['createdat']['max'])){
			$this->filters['dateRange']['createdat']['min'] = $_POST['filters']['dateRange']['createdat']['min'];
			$this->filters['dateRange']['createdat']['max'] = $_POST['filters']['dateRange']['createdat']['max'];
		}
		
		//filtro por estado
		//ver si se puede eliminar algun caso
		if(!empty($_POST['filters']['status'])){
			$this->filters['Status'] = TwitterTweet::PARSED;
		}elseif(!empty($_POST['filters']['discarded'])){
			$this->filters['Status'] = TwitterTweet::DISCARDED;
		}elseif(!empty($_POST['filters']['all'])){
			$this->filters['maxStatus'] = TwitterTweet::DISCARDED;
		}else{
			$this->filters['Status'] = TwitterTweet::ACCEPTED;
		}
		
		//si hay un filtro de procesados seteado lo aplico
		if(isset($_POST['filters']['processed'])){
			//si quiero ver todos
			if($_POST['filters']['processed'] == -1)
				$this->filters['maxStatus'] = TwitterTweet::ACCEPTED; //o discarded?
			else
				$this->filters['processed'] = $_POST['filters']['processed'];
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
		
		// informacion para el highlight
		$matchedUsers = array();
		$matchedHashtags = array();
		$matches = array();
		
		foreach($this->results as $tweet){
			preg_match_all('/(^|\s)@(\w+)/',$tweet->getText(), $matchedUsers[$tweet->getId()]);
			preg_match_all('/(^|\s)#(\w*[a-zA-Z_]+\w*)/',$tweet->getText(), $matchedHashtags[$tweet->getId()]);
			$matches[$tweet->getId()] = array_merge($matchedUsers[$tweet->getId()][0],$matchedHashtags[$tweet->getId()][0]);
		}
		
		$this->smarty->assign('matched', $matches);
		
		
	}

}
