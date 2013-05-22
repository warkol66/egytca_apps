<?php

class BoardViewAction extends BaseEditAction {
	
	function __construct() {
		parent::__construct('BoardChallenge');
	}
	
	protected function preEdit() {
		parent::preEdit();
		
		if(isset($_GET["url"])){
			$entry = BoardChallengeQuery::create()->findOneByUrl($_GET["url"]);
			if(is_object($entry))
				$_POST['id'] = $entry->getId();
			else
				$_POST['id'] = -1;
		}
	}

	protected function postEdit() {
		parent::postEdit();
		
		$module = "Board";
		$this->smarty->assign("module",$module);
		
		$this->entity->increaseViews();
		
		$moduleConfig = Common::getModuleConfiguration("board");
		$this->smarty->assign("moduleConfig",$moduleConfig);
		
		//busco los compromisos posibles
		$this->smarty->assign("bonds",BoardBond::getTypes());
		//busco los compromisos existentes en este desafio
		$usersB = BoardBondQuery::create()->select('Type')->filterByChallengeId($this->entity->getId())->find();
		$this->smarty->assign("usersBonds",$usersB->getData());
		
		//busco los compromisos que hizo el usuario logueado
		$user = Common::getLoggedUser();
		$loggedBonds = BoardBondQuery::create()->select('Type')->filterByUserId($user->getId())->find();
		$this->smarty->assign("loggedBonds",$loggedBonds->getData());
		/*echo($loggedBonds->getData());
		die();*/
		
		if ($moduleConfig['comments']['useComments']['value'] == "YES") {

			//si se la configuracion pide que se muestren los comentarios de forma directa
			if ($moduleConfig['comments']['displayComments']['value'] == 'YES') {
				$comments = BoardCommentQuery::create()->filterByParentId(NULL, Criteria::EQUAL)->findByChallengeIdAndStatus($this->entity->getId(),BoardComment::APPROVED);
				$this->smarty->assign("comments",$comments);
			}
		}
		
		$this->smarty->assign("challengeDeleted", $this->entity->getDeletedAt('Y-m-d H:i:s')); 
		
		$this->template->template = "TemplateBlogPublic.tpl";
		
	}

}
