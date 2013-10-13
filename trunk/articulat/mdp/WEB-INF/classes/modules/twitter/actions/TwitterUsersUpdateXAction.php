<?php

require_once 'TwitterConnection.class.php';

class TwitterUsersUpdateXAction extends BaseEditAction {
	
	function __construct() {
		parent::__construct('TwitterUser');
	}
	
	protected function preEdit() {
		parent::preEdit();

		$this->module = "Twitter";

	}

	protected function postEdit() {
		parent::postEdit();
		
		$this->smarty->assign("module", $this->module);
		$moduleConfig = Common::getModuleConfiguration($this->module);
		
		if(is_object($this->entity)){
			$config = json_decode(file_get_contents(__DIR__.'/../config.json'), true);
			$twitterConnection = new TwitterConnection($config);
			
			$screenn = $this->entity->getScreenname();
			if(!empty($screenn))
				$query = array('screen_name' => $screenn, 'user_id' => $this->entity->getId());
			else
				$query = array('user_id' => $this->entity->getId());

			if (!empty($query)) {
				
				$searchRespone = $twitterConnection->search($query,0,'users');
				/*echo"<pre>"; print_r($searchRespone); echo"</pre>";
				die();*/
				$this->entity->updateFromTwitter($searchRespone);
				$this->smarty->assign('twitterUser', $this->entity);
			}
		}
		
	}
}
