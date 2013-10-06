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
			//obtengo tweets positivos por fecha
			$positive = TwitterTweetQuery::getAcceptedByValue(null, null, TwitterTweet::POSITIVE);
			//obtengo tweets negativos por fecha
			$negative = TwitterTweetQuery::getAcceptedByValue(null, null, TwitterTweet::NEGATIVE);
			/*echo"<pre>"; print_r($positive); echo "</pre>";
			die();*/
			
			
			$this->smarty->assign("positive", $positive);
			$this->smarty->assign("negative", $negative);
			/*print_r($positive);
			die();*/
		}
		
		$moduleConfig = Common::getModuleConfiguration($this->module);
		
	}

}
