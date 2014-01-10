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
		$this->filters['textLike'] = $_POST['tt'];
		
		$this->filters['orderByCreatedat'] = "desc";

		
		//if(!isset($_POST['from']) && !isset($_POST['to'])){
		if($_POST['time'] == 'custom' && isset($_POST['from']) && isset($_POST['to'])){
			$this->filters['dateRange']['createdat']['min'] = Common::getDatetimeOnGMT(date('Y-m-d H:i:s',strtotime($_POST['from']. ':00')));
			$this->filters['dateRange']['createdat']['max'] = Common::getDatetimeOnGMT(date('Y-m-d H:i:s',strtotime($_POST['to']. ':00')));
				
		}else{
			if(!empty($_POST['time']))
				$this->filters['dateRange']['createdat']['min'] = Common::getDatetimeOnGMT(date('Y-m-d H:i:s',strtotime($_POST['time'])));
			else
				$this->filters['dateRange']['createdat']['min'] = Common::getDatetimeOnGMT(date('Y-m-d H:i:s',strtotime($campaign->getStartdate())));
			
			$this->filters['dateRange']['createdat']['max'] = Common::getDatetimeOnGMT(date('Y-m-d H:i:s'));
		}


	}

	protected function postList() {
		parent::postList();

			// armo el arreglo de filtros
			$tweetsFilters = array();
			
			$campaign = CampaignQuery::create()->findOneById($_REQUEST['filters']['campaignid']);
			$tweetsFilters['campaign'] = $campaign->getId();
			
			// obtengo los graficos con los filtros indicados
			$tweetsFilters['type'] = $_POST['type'];
			$tweetsFilters['value'] = $_POST['value'];
			$tweetsFilters['relevance'] = $_POST['relevance'];
			$tweetsFilters['personalized'] = $_POST['tt'];
			if(!empty($_POST['gender'])){
				/*echo $_POST['gender'];
				die();*/
				$tweetsFilters['gender'] = $_POST['gender'];
			}
			
			$this->smarty->assign('personalSelected', $_POST['tt']);
			$this->smarty->assign('selectedTTFilter', $_POST['ttFilter']);
			
			// si no es un rango de fechas custom
			if($_POST['time'] == 'custom' && isset($_POST['from']) && isset($_POST['to'])){
				$tweetsFilters['from'] = Common::getDatetimeOnGMT(date('Y-m-d H:i:s',strtotime($_POST['from']. ':00')));
				$tweetsFilters['to'] = Common::getDatetimeOnGMT(date('Y-m-d H:i:s',strtotime($_POST['to']. ':00')));
				
			}else{
				if(!empty($_POST['time']))
					$tweetsFilters['from'] = Common::getDatetimeOnGMT(date('Y-m-d H:i:s',strtotime($_POST['time'])));
				else
					$tweetsFilters['from'] = Common::getDatetimeOnGMT(date('Y-m-d H:i:s',strtotime($campaign->getStartdate())));
				$tweetsFilters['to'] = Common::getDatetimeOnGMT(date('Y-m-d H:i:s'));
			}

		$tweetsAmount = TwitterTweetQuery::getCombinations($tweetsFilters);
		$this->smarty->assign('tweetsAmount', $tweetsAmount);

		$this->smarty->assign("module", $this->module);
			
		$this->smarty->assign("values", TwitterTweet::getValues());
		$this->smarty->assign("relevances", TwitterTweet::getRelevances());

		$this->template->template = "TemplatePrint.tpl";
		
		$moduleConfig = Common::getModuleConfiguration($this->module);
		
	}

}

