<?php

class TwitterCampaignsReportViewAction extends BaseEditAction {
	
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
			
			$tweetsFilters['campaign'] = $this->entity->getId();
			// busco entre los limites de la campaign
			$tweetsFilters['from'] = Common::getDatetimeOnGMT(date('Y-m-d H:i:s',strtotime($this->entity->getStartdate())));
			$tweetsFilters['to'] = Common::getDatetimeOnGMT(date('Y-m-d H:i:s',strtotime($this->entity->getFinishdate())));

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
			
			// obtengo los usuarios que mas tweets crearon
			$topUsers = TwitterUserQuery::getTopUsers($tweetsFilters, 5);
			$influentialUsers = TwitterUserQuery::getInfluentialUsers($tweetsFilters);
			/*echo"<pre>"; print_r($relevantUsers); echo"</pre>";
			die();*/
			
			$tweetsAmount = TwitterTweetQuery::getCombinations($tweetsFilters);
			/*echo"<pre>"; print_r($tweetsAmount); echo"</pre>";
			die();*/
			$this->smarty->assign('byValue', $byValue);
			$this->smarty->assign('byValueTotal', $byValueTotal);
			$this->smarty->assign('byRelevance', $byRelevance);
			$this->smarty->assign('byRelevanceTotal', $byRelevanceTotal);
			$this->smarty->assign('topUsers', $topUsers);
			$this->smarty->assign('influentialUsers', $influentialUsers);
			$this->smarty->assign('tweetsAmount', $tweetsAmount);
			$this->smarty->assign('trendingTopics', TwitterTrendingTopic::getLatest(10));
			/*echo"<pre>"; print_r($byValue); echo"</pre>";
			die();*/
			
			/* Tendencias personalizadas */
			$personalTrends = TwitterTweetQuery::getPersonalTrends($tweetsFilters);
			$this->smarty->assign("personalTrends",$personalTrends);
			
			/*print_r($personalTrends);
			die();*/
			
			// posibles valores y relevancias para los filtros
			$this->smarty->assign("tweetValues",TwitterTweet::getValues());
			$this->smarty->assign("tweetRelevances",TwitterTweet::getRelevances());
			$this->smarty->assign("from",$tweetsFilters['from']);
			$this->smarty->assign("to",$tweetsFilters['to']);
		}
		
		$moduleConfig = Common::getModuleConfiguration($this->module);
		
	}

}
