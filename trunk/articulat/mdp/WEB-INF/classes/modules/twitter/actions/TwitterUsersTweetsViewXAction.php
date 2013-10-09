<?php

//class TwitterUsersTweetsViewXAction extends BaseEditAction {

class TwitterUsersTweetsViewXAction extends BaseAction {
	
	public function execute($mapping, $form, &$request, &$response) {
		
		parent::execute($mapping, $form, $request, $response);
		
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}
		
		$user = TwitterUserQuery::create()->findOneByInternalid($_POST['id']);
		
		// actualizo los datos del usuario
		if(is_object($user)){
			$campaign = $_POST['campaign'];
			$userTweets = TwitterTweetQuery::create()->filterByCampaignid($campaign)->filterByUserId($user->getInternalid())->filterByStatus(2)->limit(5)->find();
			
			$smarty->assign('userTweets',$userTweets);
			$smarty->assign('user',$user);
			return $mapping->findForwardConfig('success');
		}

	}



	
	/*function __construct() {
		parent::__construct('TwitterUser');
	}
	
	protected function preEdit() {
		parent::preEdit();

		$this->module = "Twitter";

	}

	protected function postEdit() {
		parent::postEdit();
		$campaign = $_POST['campaign'];
		$userTweets = TwitterTweetQuery::create()->filterByCampaignId($campaign)->filterByUserId($this->entity->getId())->limit(5)->find();
		
		print_r($userTweets);
		die();
		
		$this->smarty->assign("module", $this->module);
		$moduleConfig = Common::getModuleConfiguration($this->module);
		
	}*/
}
