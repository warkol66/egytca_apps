<?php

class NewsCommentsDoAddXAction extends BaseDoEditAction {
	
	public function __construct() {
		parent::__construct('NewsComment');
	}
	
	protected function preUpdate() {
		parent::preUpdate();
		
		if(!isset($_SESSION['loginUser']) && !isset($_SESSION['loginAffiliateUser']) && !isset($_SESSION['loginClientUser'])){
			if ( (empty($_POST['securityCode'])) || !Common::validateCaptcha($_POST['securityCode'])) {
				$this->smarty->assign('captcha',true);
				$this->smarty->assign('article',NewsArticleQuery::create()->findOneById($_POST["params"]['entryId']));
				$this->forwardFailureName = 'success';
				return false;
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
