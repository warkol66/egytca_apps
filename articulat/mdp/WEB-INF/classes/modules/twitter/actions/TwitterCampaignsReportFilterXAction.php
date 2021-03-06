<?php

class TwitterCampaignsReportFilterXAction extends BaseEditAction {
	
	function __construct() {
		parent::__construct('Campaign');
		
		$this->ajaxTemplate = 'TwitterCampaignReport.tpl';
	}
	
	protected function preEdit() {
		parent::preEdit();

		$this->module = "Twitter";

	}

	protected function postEdit() {
		parent::postEdit();

		$this->smarty->assign("module", $this->module);
		
		if(is_object($this->entity)){
			
			// armo el arreglo de filtros
			$tweetsFilters = array();
			
			$tweetsFilters['campaign'] = $this->entity->getId();
			
			// obtengo los graficos con los filtros indicados
			$tweetsFilters['type'] = $_POST['type'];
			$tweetsFilters['value'] = $_POST['value'];
			$tweetsFilters['relevance'] = $_POST['relevance'];
			$tweetsFilters['personalized'] = $_POST['tt'];
			$tweetsFilters['gender'] = $_POST['gender'];
			
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
					$tweetsFilters['from'] = Common::getDatetimeOnGMT(date('Y-m-d H:i:s',strtotime($this->entity->getStartdate())));
				$tweetsFilters['to'] = Common::getDatetimeOnGMT(date('Y-m-d H:i:s'));
			}
			
			$this->smarty->assign('from',$tweetsFilters['from']);
			$this->smarty->assign('to',$tweetsFilters['to']);

			$byValue = TwitterTweetQuery::getAllByValue($tweetsFilters);
			$byValueTotal = 0;
			foreach($byValue as $date){
				$byValueTotal += $date['positive'] + $date['neutral'] + $date['negative'];
			}
			$this->smarty->assign('byValue', $byValue);
			$this->smarty->assign('byValueTotal', $byValueTotal);
			
			/*print_r($byValue);
			die();*/

			$byRelevance = TwitterTweetQuery::getAllByRelevance($tweetsFilters);
			$byRelevanceTotal = 0;
			foreach($byRelevance as $date){
				$byRelevanceTotal += $date['relevant'] + $date['neutrally_relevant'] + $date['irrelevant'];
			}
			$this->smarty->assign('byRelevance', $byRelevance);
			$this->smarty->assign('byRelevanceTotal', $byRelevanceTotal);
			
			$this->smarty->assign('trendingTopics', TwitterTrendingTopicQuery::getMostTrending($tweetsFilters['from'], $tweetsFilters['to'], 10));
			
			if($byValueTotal > 0 || $byRelevanceTotal > 0){
				
				$byGender = TwitterTweetQuery::getAllByGender($tweetsFilters);
				$this->smarty->assign('byGender', $byGender);
				
				// obtengo los usuarios que mas tweets crearon
				$topUsers = TwitterUserQuery::getTopUsers($tweetsFilters, 5);
				$influentialUsers = TwitterUserQuery::getInfluentialUsers($tweetsFilters);
				$vennData = TwitterTweetQuery::getVennData($tweetsFilters);
				$tweetsAmount = TwitterTweetQuery::getCombinations($tweetsFilters);
				/*echo"<pre>"; print_r($relevantUsers); echo"</pre>";
				die();*/
				$this->smarty->assign('topUsers', $topUsers);
				$this->smarty->assign('influentialUsers', $influentialUsers);
				$this->smarty->assign('vennData', $vennData);
				$this->smarty->assign('tweetsAmount', $tweetsAmount);
				
				/* Tendencias personalizadas */
			
				$treemapInfo = array();
				$personalTrends = TwitterTweetQuery::getPersonalTrends($tweetsFilters, $treemapInfo);
				$this->smarty->assign("personalTrends",$personalTrends);
				$this->smarty->assign("treemapPersonalTrends",json_encode($treemapInfo));
				$dailyPersonalTrends = TwitterTweetQuery::dailyPersonalTrends($tweetsFilters, $personalTrends);
				$this->smarty->assign('dailyPersonalTrends',json_encode($dailyPersonalTrends));
				$dailyTweets = TwitterTweetQuery::dailyTweets($tweetsFilters);
				$this->smarty->assign('dailyTweets',json_encode($dailyTweets));
				
				$usersAmount = TwitterTweetQuery::getUsersAmount($tweetsFilters);
				$this->smarty->assign('usersAmount',$usersAmount);
			}
			
		}
		
		$moduleConfig = Common::getModuleConfiguration($this->module);
		
	}

}
