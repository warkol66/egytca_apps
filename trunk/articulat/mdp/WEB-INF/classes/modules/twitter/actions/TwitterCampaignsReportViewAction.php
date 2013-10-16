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

			$byValue = TwitterTweetQuery::getAllByValue(null, null, null);
			// seteo los valores disponibles para usarlos luego en la creacion del grafico
			if(array_key_exists('positive',$byValue[0]))
				$this->smarty->assign('positive', true);
			if(array_key_exists('neutral',$byValue[0]))
				$this->smarty->assign('neutral', true);
			if(array_key_exists('negative',$byValue[0]))
				$this->smarty->assign('negative', true);
				
			$byRelevance = TwitterTweetQuery::getAllByRelevance(null, null, null);
			// seteo los valores disponibles para usarlos luego en la creacion del grafico
			if(array_key_exists('positive',$byRelevance[0]))
				$this->smarty->assign('relevant', true);
			if(array_key_exists('neutral',$byRelevance[0]))
				$this->smarty->assign('neutrally_relevant', true);
			if(array_key_exists('negative',$byRelevance[0]))
				$this->smarty->assign('irrelevant', true);
			
			// obtengo los usuarios que mas tweets crearon
			$topUsers = TwitterTweetQuery::getTopUsers();
			
			
			// obtengo los actores mas mencionados
			
			$this->smarty->assign('byValue', $byValue);
			$this->smarty->assign('byRelevance', $byRelevance);
			$this->smarty->assign('topUsers', $topUsers);
			/*echo"<pre>"; print_r($byValue); echo"</pre>";
			die();*/
			
			// posibles valores y relevancias para los filtros
			$this->smarty->assign("tweetValues",TwitterTweet::getValues());
			$this->smarty->assign("tweetRelevances",TwitterTweet::getRelevances());
		}
		
		$moduleConfig = Common::getModuleConfiguration($this->module);
		
	}

}
