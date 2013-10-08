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
			//obtengo tweets positivos, neutros y negativos por fecha
			$positive = TwitterTweetQuery::getAcceptedByValue(null, null, TwitterTweet::POSITIVE);
			$negative = TwitterTweetQuery::getAcceptedByValue(null, null, TwitterTweet::NEUTRAL);
			$negative = TwitterTweetQuery::getAcceptedByValue(null, null, TwitterTweet::NEGATIVE);
			// obtengo los usuarios que mas tweets crearon
			$topUsers = TwitterTweetQuery::getTopUsers();
			
			
			// obtengo los actores mas mencionados
			
			$this->smarty->assign("positive", $positive);
			$this->smarty->assign("neutral", $neutral);
			$this->smarty->assign("negative", $negative);
			$this->smarty->assign("topUsers", $topUsers);
			/*echo"<pre>"; print_r($topUsers); echo"</pre>";
			die();*/
		}
		
		$moduleConfig = Common::getModuleConfiguration($this->module);
		
	}

}
