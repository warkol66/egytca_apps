<?php

class BoardBondsGetUsersXAction extends BaseListAction {
	
	function __construct() {
		parent::__construct('BoardBond');
		
	}
	
	protected function preList(){
		parent::preList();
		
		$this->filters['type'] = $_REQUEST['type'];
		$this->filters['chalengeId'] = $_REQUEST['chalengeId'];
		
	}
	
	protected function postList(){
		parent::postList();
		
		//con la lista de bonds busco los usuarios correspondientes
		$users = array();
		
		foreach($this->results as $bond){
			$queryClass = $bond->getUserType() . 'Query';
			if(class_exists($queryClass)){
				$user = $queryClass::create()->findOneById($bond->getUserId());
				if(is_object($user)){
					$users[] = $user;
				}	
			}
		}
		
		$this->smarty->assign("bonds",BoardBond::getTypes());
		$this->smarty->assign("users",$users);
		$this->smarty->assign("host",$_SERVER['HTTP_HOST']);
	}

}
