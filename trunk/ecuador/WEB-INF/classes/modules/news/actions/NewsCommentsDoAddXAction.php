<?php

class NewsCommentsDoAddXAction extends BaseDoEditAction {
	
	public function __construct() {
		parent::__construct('NewsComment');
	}
	
	protected function preUpdate() {
		parent::preUpdate();
		
		if(empty(Common::getLoggedUser())){
			if ( (empty($_POST['formId'])) || !Common::validateCaptcha($_POST['formId'])) {
				$this->smarty->assign('captcha',true);
				$this->smarty->assign('article',NewsArticleQuery::create()->findOneById($_POST["params"]['entryId']));
				$this->forwardFailureName = 'success';
				return false;
			}else{
				$module = "News";
				$this->entity->setCreationdate(date('Y-m-d H:m:s'));
				$this->entity->setIp($_SERVER['REMOTE_ADDR']);
				
				$moduleConfig = Common::getModuleConfiguration($module);
				
				if ($moduleConfig["comments"]["moderated"] == "YES") {
					if ($params['params']['userId'])
						$this->entity->setStatus(NewsComment::APPROVED);
					else
						$this->entity->setStatus(NewsComment::PENDING);
				}
				else
					$this->entity->setStatus(NewsComment::APPROVED);
			}
		}

	}
	
	protected function postUpdate() {
		parent::postUpdate();
		
		$module = "News";
		$this->smarty->assign("module",$module);

		$this->smarty->assign("article", NewsArticleQuery::create()->findOneById($this->entity->getEntryid()));
		$this->smarty->assign('comment',$this->entity);
	}

}
