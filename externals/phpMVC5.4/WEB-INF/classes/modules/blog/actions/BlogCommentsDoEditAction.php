<?php

class BlogCommentsDoEditAction extends BaseDoEditAction {
	
	function __construct() {
		parent::__construct('BlogComment');
	}

	protected function preUpdate(){
		parent::preUpdate();

		$this->entityParams['ip'] = Common::getIp();

		//informacion del usuario		
		if(isset($_SESSION['loginUser']) || isset($_SESSION['loginAffiliateUser']) || isset($_SESSION['loginClientUser'])){
			if(isset($_SESSION['loginUser']))
				$user = $_SESSION['loginUser'];
			elseif(isset($_SESSION['loginAffiliateUser']))
				$user = $_SESSION['loginAffiliateUser'];
			elseif(isset($_SESSION['loginClientUser']))
				$user = $_SESSION['loginClientUser'];

			$this->entityParams['userId'] = $user->getId();
			$this->entityParams['email'] = $user->getmailAddress();
			$this->entityParams['username'] = $user->getusername();
		}

	}

	protected function postUpdate() {
		parent::postUpdate();
		
		$this->smarty->assign("module","Blog");
		
		$entry = $this->entity->getBlogentry();
		if(!is_object($entry))
			$this->smarty->assign("noEntry",true);
		
	}

}
