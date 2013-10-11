<?php

require_once 'TwitterConnection.class.php';

class TwitterUsersViewXAction extends BaseEditAction {
	
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
				$this->entity->setDescription($searchRespone->description);
				$this->entity->setFollowers($searchRespone->followers_count);
				$this->entity->setFriends($searchRespone->friends_count);
				$this->entity->save();
			}
		}
		
	}
}
