<?php

class BoardCommentsDoEditAction extends BaseDoEditAction {
	
	function __construct() {
		parent::__construct('BoardComment');
	}
	
	protected function preUpdate(){
		parent::preUpdate();

		$this->entityParams['ip'] = Common::getIp();

		//informacion del usuario
		$loggedUser = Common::getLoggedUser();
		if(!empty($loggedUser)) {		
			$this->entityParams['userId'] = $loggedUser->getId();
			$this->entityParams['email'] = $loggedUser->getmailAddress();
			$this->entityParams['username'] = $loggedUser->getusername();
			$this->entityParams['objectType'] = get_class($loggedUser);
			$this->entityParams['objectId'] = $loggedUser->getId();
		}

	}
	
	protected function postUpdate() {
		parent::postUpdate();
		
		$this->smarty->assign("module","Board");
		
		$challenge = $this->entity->getBoardchallenge();
		if(!is_object($challenge))
			$this->smarty->assign("noChallenge",true);
		
	}

}
