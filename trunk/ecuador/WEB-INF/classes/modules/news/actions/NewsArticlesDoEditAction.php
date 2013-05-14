<?php

class NewsArticlesDoEditAction extends BaseDoEditAction {
	
	function __construct() {
		parent::__construct('NewsArticle');
		
	}
	
	protected function preUpdate(){
		parent::preUpdate();

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
		
		$module = "News";
		$this->smarty->assign("module",$module);
		
	}

}
