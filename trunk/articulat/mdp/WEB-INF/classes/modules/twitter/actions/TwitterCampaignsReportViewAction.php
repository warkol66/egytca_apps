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
			
			$campaignId = $this->entity->getId();
			// busco entre los limites de la campaign
			$from = Common::getDatetimeOnGMT(date('Y-m-d H:i:s',strtotime($this->entity->getStartdate())));
			$to = Common::getDatetimeOnGMT(date('Y-m-d H:i:s',strtotime($this->entity->getFinishdate())));
			
			/*echo "$from \n $to";
			die();*/

			$byValue = TwitterTweetQuery::getAllByValue($campaignId, $from, $to, null, null);
			// seteo los valores disponibles para usarlos luego en la creacion del grafico
			if(array_key_exists('positive',$byValue[0]))
				$this->smarty->assign('positive', true);
			if(array_key_exists('neutral',$byValue[0]))
				$this->smarty->assign('neutral', true);
			if(array_key_exists('negative',$byValue[0]))
				$this->smarty->assign('negative', true);
				
			$byRelevance = TwitterTweetQuery::getAllByRelevance($campaignId, $from, $to, null, null);
			// seteo los valores disponibles para usarlos luego en la creacion del grafico
			if(array_key_exists('positive',$byRelevance[0]))
				$this->smarty->assign('relevant', true);
			if(array_key_exists('neutral',$byRelevance[0]))
				$this->smarty->assign('neutrally_relevant', true);
			if(array_key_exists('negative',$byRelevance[0]))
				$this->smarty->assign('irrelevant', true);
			
			// obtengo los usuarios que mas tweets crearon
			$topUsers = TwitterUserQuery::getTopUsers($campaignId);
			
			
			// obtengo los actores mas mencionados
			
			$this->smarty->assign('byValue', $byValue);
			$this->smarty->assign('byRelevance', $byRelevance);
			$this->smarty->assign('topUsers', $topUsers);
			/*echo"<pre>"; print_r($byValue); echo"</pre>";
			die();*/
			
			// posibles valores y relevancias para los filtros
			$this->smarty->assign("tweetValues",TwitterTweet::getValues());
			$this->smarty->assign("tweetRelevances",TwitterTweet::getRelevances());
			$this->smarty->assign("from",$from);
			$this->smarty->assign("to",$to);
		}
		
		$moduleConfig = Common::getModuleConfiguration($this->module);
		
	}

}
