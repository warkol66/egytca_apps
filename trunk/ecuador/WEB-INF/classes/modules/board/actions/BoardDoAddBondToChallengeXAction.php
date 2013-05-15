<?php

class BoardDoAddBondToChallengeXAction extends BaseDoEditAction {
	
	function __construct() {
		parent::__construct('BoardBond');
	}
	
	protected function preUpdate(){
		parent::preUpdate();
		
		if(isset($_POST['bondId']) && isset($_POST['challengeId'])){
			
			if(isset($_SESSION['loginUser']))
				$user = $_SESSION['loginUser'];
			elseif(isset($_SESSION['loginAffiliateUser']))
				$user = $_SESSION['loginAffiliateUser'];
			elseif(isset($_SESSION['loginClientUser']))
				$user = $_SESSION['loginClientUser'];
			
			$this->entityParams['userId'] = $user->getId();
			$this->entityParams['userType'] = get_class($user);
			$this->entityParams['type'] = $_POST['bondId'];
			$this->entityParams['challengeId'] = $_POST['challengeId'];
			
			//me fijo que no exista otro bond con estos datos
			$existent = BoardBondQuery::create()
			->filterByChallengeId($_POST['challengeId'])
			->filterByType($_POST['bondId'])
			->filterByUserId($user->getId())
			->filterByUserType(get_class($user))
			->findOne();
		
			if(is_object($existent)){
				//busco los compromisos posibles
				$this->smarty->assign("bonds",BoardBond::getTypes());
				//busco los compromisos existentes en este desafio
				$usersB = BoardBondQuery::create()->filterByChallengeId($_POST['challengeId'])->find();
				$usersBonds = array();
				foreach($usersB as $usersBond){
					$usersBonds[] = $usersBond->getType();
				}
				
				$this->smarty->assign("usersBonds",$usersBonds);
				
				$this->smarty->assign("existent",true);
				$this->forwardFailureName = 'success';
				return false;
			}
		}
		
	}
	
	protected function postSave(){
		parent::postSave();
		
		//busco los compromisos posibles
		$this->smarty->assign("bonds",BoardBond::getTypes());
		//busco los compromisos existentes en este desafio
		$usersB = BoardBondQuery::create()->filterByChallengeId($this->entity->getChallengeId())->find();
		$usersBonds = array();
		foreach($usersB as $usersBond){
			$usersBonds[] = $usersBond->getType();
		}
		
		$this->smarty->assign("usersBonds",$usersBonds);
		
	}

}
