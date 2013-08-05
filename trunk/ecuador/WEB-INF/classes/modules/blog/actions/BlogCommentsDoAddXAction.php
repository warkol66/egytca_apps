<?php

class BlogCommentsDoAddXAction extends BaseDoEditAction {
	
	public function __construct() {
		parent::__construct('BlogComment');
	}
	
	protected function preUpdate() {
		parent::preUpdate();
		
		$module = "Blog";
		$loggedUser = Common::getLoggedUser();
		//Si no hay usuario logueado verifico sec dode
		if(empty($loggedUser)) {
			if ( empty($_POST['formId']) || !Common::validateCaptcha($_POST['formId'])) {
				$this->smarty->assign('captcha',true);
				$this->smarty->assign('entry',BlogEntryQuery::create()->findOneById($_POST["params"]['entryId']));
				$this->forwardFailureName = 'success';
				return false;
			}
			else {
			}
		}
		$this->entityParams["creationDate"] = date('Y-m-d H:m:s');
		$this->entityParams["ip"] = $_SERVER['REMOTE_ADDR'];
		
		$moduleConfig = Common::getModuleConfiguration($module);
		if ($moduleConfig["comments"]["moderated"]["value"] == "YES") {
			if ($this->entityParams['userId'])
				$this->entityParams["status"] = BlogComment::APPROVED;
			else
				$this->entityParams["status"] = BlogComment::PENDING;
		}
		else
			$this->entityParams["status"] = BlogComment::APPROVED;


	}
	
	protected function postUpdate() {
		parent::postUpdate();
		
		$module = "Blog";
		$this->smarty->assign("module",$module);

		$this->smarty->assign("entry", BlogEntryQuery::create()->findOneById($this->entity->getEntryid()));
		$this->smarty->assign('comment',$this->entity);
	}
}
