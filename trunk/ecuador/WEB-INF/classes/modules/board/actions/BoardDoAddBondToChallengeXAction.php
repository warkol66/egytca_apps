<?php

class BoardDoAddBondToChallengeXAction extends BaseDoEditAction {
	
	function __construct() {
		parent::__construct('BoardBond');
	}
	
	protected function preUpdate(){
		parent::preUpdate();
		
		if(isset($_POST['bondId']) && isset($_POST['challengeId'])){
			
			if(isset($_SESSION['loginUser'])){
				$user = $_SESSION['loginUser'];
				$this->entityParams['userId'] = $user->getId();
				$this->entityParams['userType'] = get_class($user);
			}
			elseif(isset($_SESSION['loginAffiliateUser'])){
				$user = $_SESSION['loginAffiliateUser'];
				$this->entityParams['userId'] = $user->getId();
				$this->entityParams['userType'] = get_class($user);
			}
			elseif(isset($_SESSION['loginClientUser'])){
				$user = $_SESSION['loginClientUser'];
				$this->entityParams['userId'] = $user->getId();
				$this->entityParams['userType'] = get_class($user);
			}
			
			$this->entityParams['type'] = $_POST['bondId'];
			$this->entityParams['challengeId'] = $_POST['challengeId'];
		}
	}

	
	protected function postUpdate(){
		parent::postUpdate();
		
	}

}
