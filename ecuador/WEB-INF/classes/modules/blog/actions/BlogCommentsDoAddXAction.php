<?php

class BlogCommentsDoAddXAction extends BaseDoEditAction {
	
	public function __construct() {
		parent::__construct('BlogComment');
	}
	
	protected function preUpdate() {
		parent::preUpdate();
		
		//Si no hay usuario logueado hago chequeo de security code
		if(!isset($_SESSION['loginUser']) && !isset($_SESSION['loginAffiliateUser']) && !isset($_SESSION['loginClientUser'])){
			if ( (empty($_POST['securityCode'])) || !Common::validateCaptcha($_POST['securityCode'])) {
				$this->smarty->assign('captcha',true);
				$this->smarty->assign('entry',BlogEntryQuery::create()->findOneById($_POST["params"]['entryId']));
				$this->forwardFailureName = 'success';
				return false;
			}else{
				
				$this->entity->setCreationdate(date('Y-m-d H:m:s'));
				$this->entity->setIp($_SERVER['REMOTE_ADDR']);
				
				$moduleConfig = Common::getModuleConfiguration($module);
				
				if ($moduleConfig["comments"]["moderated"] == "YES") {
					if ($params['params']['userId'])
						$this->entity->setStatus(BlogComment::APPROVED);
					else
						$this->entity->setStatus(BlogComment::PENDING);
				}
				else
					$this->entity->setStatus(BlogComment::APPROVED);
			}
		}
			
	}
	
	protected function postUpdate() {
		parent::postUpdate();
		
		$module = "Blog";
		$this->smarty->assign("module",$module);

		$this->smarty->assign("entry", BlogEntryQuery::create()->findOneById($this->entity->getEntryid()));
		$this->smarty->assign('comment',$this->entity);
	}
}
