<?php

class BlogCommentsDoEditAction extends BaseDoEditAction {
	
	function __construct() {
		parent::__construct('BlogComment');
	}

	protected function preUpdate(){
		parent::preUpdate();
		
		$this->smarty->assign("statusOptions",BlogComment::getStatusOptions());
		$this->smarty->assign("entryIdValues",BlogEntryQuery::create()->find());

		$this->entityParams['ip'] = Common::getIp();

		//informacion del usuario
		$loggedUser = Common::getLoggedUser();
		//Si no hay usuario logueado verifico sec dode
		if(!empty($loggedUser)) {
			$this->entityParams['userId'] = $loggedUser->getId();
			$this->entityParams['email'] = $loggedUser->getmailAddress();
			$this->entityParams['username'] = $loggedUser->getusername();
			$this->entityParams['objectType'] = get_class($loggedUser);
			$this->entityParams['objectId'] = $loggedUser->getId();
		}
		
		/*print_r($this->entityParams);
		die();*/

	}

	protected function postUpdate() {
		parent::postUpdate();
		
		$this->smarty->assign("module","Blog");
		
		$entry = $this->entity->getBlogentry();
		if(!is_object($entry))
			$this->smarty->assign("noEntry",true);
		
	}

}

