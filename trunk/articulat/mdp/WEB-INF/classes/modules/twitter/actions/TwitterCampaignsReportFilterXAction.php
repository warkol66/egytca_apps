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
			
			// armo el arreglo de filtros
			$tweetsFilters = array();
			
			$tweetsFilters['campaign'] = $this->entity->getId();
			
			// obtengo los graficos con los filtros indicados
			$tweetsFilters['type'] = $_POST['type'];
			$tweetsFilters['value'] = $_POST['value'];
			$tweetsFilters['relevance'] = $_POST['relevance'];
			$tweetsFilters['personalized'] = $_POST['tt'];
			
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
			// seteo los valores disponibles para usarlos luego en la creacion del grafico
			if(array_key_exists('positive',$byValue[0]))
				$this->smarty->assign('positive', true);
			if(array_key_exists('neutral',$byValue[0]))
				$this->smarty->assign('neutral', true);
			if(array_key_exists('negative',$byValue[0]))
				$this->smarty->assign('negative', true);
			$this->smarty->assign('byValue', $byValue);
			$this->smarty->assign('byValueTotal', $byValueTotal);
			
			/*print_r($byValue);
			die();*/

			$byRelevance = TwitterTweetQuery::getAllByRelevance($tweetsFilters);
			$byRelevanceTotal = 0;
			foreach($byRelevance as $date){
				$byRelevanceTotal += $date['relevant'] + $date['neutrally_relevant'] + $date['irrelevant'];
			}
			// seteo los valores disponibles para usarlos luego en la creacion del grafico
			if(array_key_exists('relevant',$byRelevance[0]))
				$this->smarty->assign('relevant', true);
			if(array_key_exists('neutrally_relevant',$byRelevance[0]))
				$this->smarty->assign('neutrally_relevant', true);
			if(array_key_exists('irrelevant',$byRelevance[0]))
				$this->smarty->assign('irrelevant', true);
			$this->smarty->assign('byRelevance', $byRelevance);
			$this->smarty->assign('byRelevanceTotal', $byRelevanceTotal);
			
			// obtengo los usuarios que mas tweets crearon
			$topUsers = TwitterUserQuery::getTopUsers($tweetsFilters, 5);
			$influentialUsers = TwitterUserQuery::getInfluentialUsers($tweetsFilters);
			$tweetsAmount = TwitterTweetQuery::getCombinations($tweetsFilters);
			/*echo"<pre>"; print_r($relevantUsers); echo"</pre>";
			die();*/
			$this->smarty->assign('topUsers', $topUsers);
			$this->smarty->assign('influentialUsers', $influentialUsers);
			$this->smarty->assign('tweetsAmount', $tweetsAmount);
			$this->smarty->assign('trendingTopics', TwitterTrendingTopic::getInRange($tweetsFilters['from'], $tweetsFilters['to'], 10));
			
			/* Tendencias personalizadas */
			$treemapInfo = array();
			$personalTrends = TwitterTweetQuery::getPersonalTrends($tweetsFilters, $treemapInfo);
			$this->smarty->assign("personalTrends",$personalTrends);
			$this->smarty->assign("treemapPersonalTrends",json_encode($treemapInfo));

		}
		
		$moduleConfig = Common::getModuleConfiguration($this->module);
		
	}

}
