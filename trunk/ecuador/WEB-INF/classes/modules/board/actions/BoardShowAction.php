<?php

class BoardShowAction extends BaseListAction {

	function __construct() {
		parent::__construct('BoardChallenge');
	}
	
	protected function preList() {
		parent::preList();
		
		$this->filters['status'] = BoardChallenge::PUBLISHED; //Solo las consignas publicadas
		if(isset($_GET['finished']))
			$this->filters['dateRange']['enddate']['max'] = date("Y-m-d H:i:s"); //Solo las que ya terminaron
		else
			$this->filters['dateRange']['enddate']['min'] = date("Y-m-d H:i:s"); //Solo las que todavia no terminaron
		
	}
	
	protected function postList() {
		parent::postList();
		
		//$this->template->template = "TemplatePublic.tpl";

		$module = "Board";
		$this->smarty->assign("module",$module);
		 
		$moduleConfig = Common::getModuleConfiguration($module);
		$this->smarty->assign('moduleConfig',$moduleConfig);
		
		if(isset($_GET['finished']))
			$this->smarty->assign('finished','true');
		if(isset($_GET['view']))
			$this->smarty->assign('view','true');
		
		//me fijo si hay algun challenge vigente
		foreach($this->results as $challenge){
			if( (strtotime($challenge->getStartDate()) <= time()) && (strtotime($challenge->getEndDate()) > time()) ){
				$current = $challenge;
				break;
			}
		}
		
		//asignaciones necesarias para mostrar el challenge vigente
		if(isset($current)){
			//busco los compromisos posibles
			$this->smarty->assign("bonds",BoardBond::getTypes());
			//busco los compromisos existentes en este desafio
			$usersB = BoardBondQuery::create()->filterByChallengeId($current->getId())->groupBy('BoardBond.Type')->find();

			//$usersB = BoardBondQuery::create()->filterByChallengeId($current->getId())->find();
			$this->smarty->assign("usersBonds",BoardBondQuery::create()->filterByChallengeId($current->getId())->groupBy('Type')->find());
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

				//si la configuracion pide que se muestren los comentarios de forma directa
				if ($moduleConfig['comments']['displayComments']['value'] == 'YES') {
					$comments = BoardCommentQuery::create()->filterByParentId(NULL, Criteria::EQUAL)->findByChallengeIdAndStatus($current->getId(),BoardComment::APPROVED);
					$this->smarty->assign("comments",$comments);
				}
			}
		}
		//fin asignaciones para mostrar el challenge vigente
		
		if (isset($_REQUEST["rss"])) {
			$this->template->template = "TemplatePlain.tpl";
			header("content-Type:application/rss+xml; charset=utf-8"); 
			//return $mapping->findForwardConfig('rss');
		}

	}

}
