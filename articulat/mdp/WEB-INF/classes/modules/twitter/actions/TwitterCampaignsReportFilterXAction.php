<?php

class TwitterCampaignsReportFilterXAction extends BaseEditAction {
	
	function __construct() {
		parent::__construct('Campaign');
	}
	
	protected function preEdit() {
		parent::preEdit();

		$this->module = "Twitter";

	}

	protected function postEdit() {
		parent::postEdit();

		$this->smarty->assign("module", $this->module);
		
		if(is_object($this->entity)){
			
			$campaignId = $this->entity->getId();
			// obtengo los graficos con los filtros indicados
			$type = $_POST['type'];
			
			// si no es un rango de fechas custom
			if($_POST['time'] == 'custom' && isset($_POST['from']) && isset($_POST['to'])){
				$from = Common::getDatetimeOnGMT(date('Y-m-d H:i:s',strtotime($_POST['from']. ':00')));
				$to = Common::getDatetimeOnGMT(date('Y-m-d H:i:s',strtotime($_POST['to']. ':00')));
				
			}else{
				if(!empty($_POST['time']))
					$from = Common::getDatetimeOnGMT(date('Y-m-d H:i:s',strtotime($_POST['time'])));
				else
					$from = Common::getDatetimeOnGMT(date('Y-m-d H:i:s',strtotime($this->entity->getStartdate())));
				$to = Common::getDatetimeOnGMT(date('Y-m-d H:i:s'));
			}
			
			$value = $_POST['value'];
			$relevance = $_POST['relevance'];
			
			$this->smarty->assign('from',$from);
			$this->smarty->assign('to',$to);

			$byValue = TwitterTweetQuery::getAllByValue($campaignId, $from, $to, $value, $relevance, $type);
			// seteo los valores disponibles para usarlos luego en la creacion del grafico
			if(array_key_exists('positive',$byValue[0]))
				$this->smarty->assign('positive', true);
			if(array_key_exists('neutral',$byValue[0]))
				$this->smarty->assign('neutral', true);
			if(array_key_exists('negative',$byValue[0]))
				$this->smarty->assign('negative', true);
			$this->smarty->assign('byValue', $byValue);

			$byRelevance = TwitterTweetQuery::getAllByRelevance($campaignId, $from, $to, $value, $relevance, $type);
			// seteo los valores disponibles para usarlos luego en la creacion del grafico
			if(array_key_exists('relevant',$byRelevance[0]))
				$this->smarty->assign('relevant', true);
			if(array_key_exists('neutrally_relevant',$byRelevance[0]))
				$this->smarty->assign('neutrally_relevant', true);
			if(array_key_exists('irrelevant',$byRelevance[0]))
				$this->smarty->assign('irrelevant', true);
			$this->smarty->assign('byRelevance', $byRelevance);
			
			// obtengo los usuarios que mas tweets crearon
			$topUsers = TwitterUserQuery::getTopUsers($from, $to, $campaignId, $value, $relevance, $type, 5);
			$influentialUsers = TwitterUserQuery::getInfluentialUsers($from, $to, $campaignId, $value, $relevance, $type);
			$tweetsAmount = TwitterTweetQuery::getCombinations($campaignId, $from, $to, $value, $relevance);
			/*echo"<pre>"; print_r($relevantUsers); echo"</pre>";
			die();*/
			$this->smarty->assign('topUsers', $topUsers);
			$this->smarty->assign('influentialUsers', $influentialUsers);
			$this->smarty->assign('tweetsAmount', $tweetsAmount);
			$this->smarty->assign('trendingTopics', TwitterTrendingTopic::getInRange($from, $to, 10));
			
			$totalTweets = TwitterTweetQuery::getTotalTweets($campaignId,$from,$to);
			$this->smarty->assign('totalTweets',$totalTweets);

		}
		
		$moduleConfig = Common::getModuleConfiguration($this->module);
		
	}

}