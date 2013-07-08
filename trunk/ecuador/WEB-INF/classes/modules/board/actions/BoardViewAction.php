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
		
		//si no me pasaron id muestro el challenge vigente
		if(!isset($_GET["url"]) && !isset($_GET["id"])){
			$current = BoardChallenge::getCurrent();
			if(is_object($current))
				$_POST['id'] = $current->getId();
			else
				$this->smarty->assign('current','false');
		}
		
	}

	protected function postEdit() {
		parent::postEdit();
		
		$module = "Board";
		$this->smarty->assign("module",$module);
		
		if (!$this->entity->isNew())
            $this->entity->increaseViews();
		
		$moduleConfig = Common::getModuleConfiguration("board");
		$this->smarty->assign("moduleConfig",$moduleConfig);
		
		if(isset($_GET['finished']))
			$this->smarty->assign('finished','true');
		
		//busco los compromisos posibles
		$this->smarty->assign("bonds",BoardBond::getTypes());
		//busco los compromisos existentes en este desafio
		$usersB = BoardBondQuery::create()->filterByChallengeId($this->entity->getId())->groupBy('BoardBond.Type')->find();
		/*print_r($usersB);
		die();*/
		$this->smarty->assign("usersBonds",BoardBondQuery::create()->filterByChallengeId($this->entity->getId())->groupBy('Type')->find());
		//armo un arreglo con usuarios por compromiso y otro con los compromisos (para contarlos)
		$usersBonds = array();
		$keys = array();
		
		foreach($usersB as $bond){
			$queryClass = $bond->getUserType() . 'Query';
			if(class_exists($queryClass)){
				$user = $queryClass::create()->findOneById($bond->getUserId());
				if(is_object($user)){
					$usersBonds[$bond->getType()][] = $user;
					$keys[] = $bond->getType();
				}	
			}
		}
		
		$this->smarty->assign("usersByBonds",$usersBonds);
		$this->smarty->assign("boardBonds",$keys);
		
		//busco los compromisos que hizo el usuario logueado
		$user = Common::getLoggedUser();
		$loggedBonds = BoardBondQuery::create()->select('Type')->filterByUserId($user->getId())->find();
		$this->smarty->assign("loggedBonds",$loggedBonds->getData());
		
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
