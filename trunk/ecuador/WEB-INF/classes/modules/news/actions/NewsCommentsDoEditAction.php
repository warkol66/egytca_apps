<?php

class NewsCommentsDoEditAction extends BaseDoEditAction {
	
	function __construct() {
		parent::__construct('NewsComment');
	}
	
	protected function preUpdate() {
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

		$this->entity->setCreationdate(date('Y-m-d H:m:s'));
		
		//regla de negocio, si se indica un usuario de sistema el mensaje directamente se encuentra aprobado
		//TODO: Cuando se incorpore usuarios por registracion, agregar verificacion de usuario existente.
		if ($params['newscomment']['userId'])
			$this->entity->setStatus(NewsComment::APPROVED);
		else
			$this->entity->setStatus(NewsComment::PENDING);
		
	}
	
	protected function postUpdate() {
		parent::postUpdate();
		
		$this->smarty->assign("module","News");
		
	}

}
