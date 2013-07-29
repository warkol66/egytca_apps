<?php

class BlogDoEditAction extends BaseDoEditAction {

	function __construct() {
		parent::__construct('BlogEntry');
	}
	
	protected function preUpdate(){
		parent::preUpdate();

		$this->forwardName = "success-edit";

		//informacion del usuario		
		if(isset($_SESSION['loginUser']) || isset($_SESSION['loginAffiliateUser']) || isset($_SESSION['loginClientUser'])){
			if(isset($_SESSION['loginUser']))
				$user = $_SESSION['loginUser'];
			elseif(isset($_SESSION['loginAffiliateUser']))
				$user = $_SESSION['loginAffiliateUser'];
			elseif(isset($_SESSION['loginClientUser']))
				$user = $_SESSION['loginClientUser'];

			$this->entityParams['userId'] = $user->getId();
		}

	}
	
	protected function postUpdate(){
		parent::postUpdate();
		
		if(!empty($_GET['filters'])){
			$filtersUrl = http_build_query(array('filters' => $_GET['filters']));
			$this->smarty->assign("filtersUrl", $filtersUrl);
		}
	}
	
}
