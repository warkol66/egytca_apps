<?php

class BoardCommentsDoAddXAction extends BaseDoEditAction {
	
	public function __construct() {
		parent::__construct('BoardComment');
	}
	
	protected function preUpdate() {
		parent::preUpdate();
		
		$module = "Board";
		
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
						$this->entity->setStatus(BoardComment::APPROVED);
					else
						$this->entity->setStatus(BoardComment::PENDING);
				}
				else
					$this->entity->setStatus(BoardComment::APPROVED);
			}
		}
			
	}
	
	protected function postUpdate() {
		parent::postUpdate();
		
		$module = "Board";
		$this->smarty->assign("module",$module);

		$this->smarty->assign("challenge", BoardChallengeQuery::create()->findOneById($this->entity->getChallengeid()));
		$this->smarty->assign('comment',$this->entity);
	}
}
