<?php

class TwitterListXAction extends BaseListAction {
	
	function __construct() {
		parent::__construct('TwitterTweet');
	}
	
	protected function preList() {
		parent::preList();

		$this->module = "Twitter";
		
		//si selecciono campaña seteo el
		if(!isset($_GET['campaignId'])){
			$campaigns = CampaignQuery::create()->getMostRecentIds(15, 1);
			$this->filters['getMostRecent'] = $campaigns;
		}else
			$this->smarty->assign("campaignid",$_GET['campaignId']);
		
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
		
	}

}
