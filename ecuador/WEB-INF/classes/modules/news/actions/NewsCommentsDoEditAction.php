<?php

class NewsCommentsDoEditAction extends BaseDoEditAction {
	
	function __construct() {
		parent::__construct('NewsComment');
	}
	
	protected function preUpdate() {
		parent::preUpdate();
		
		$this->entity->setCreationdate(date('Y-m-d H:m:s'));
		
		//regla de negocio, si se indica un usuario de sistema el mensaje directamente se encuentra aprobado
		//TODO: Cuando se incorpore usuarios por registracion, agregar verificacion de usuario existente.
		if ($params['newscomment']['userId'])
			$this->entity->setStatus(NewsComment::NEWSCOMMENT_APPROVED);
		else
			$this->entity->setStatus(NewsComment::NEWSCOMMENT_PENDING);
		
	}
	
	protected function postUpdate() {
		parent::postUpdate();
		
		$this->smarty->assign("module","News");
		
	}

}
