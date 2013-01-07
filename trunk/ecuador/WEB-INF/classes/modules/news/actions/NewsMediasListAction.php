<?php

class NewsMediasListAction extends BaseListAction {
	
	function __construct() {
		parent::__construct('NewsComment');
	}
	
	protected function postList(){
		parent::postList();
		
		$this->smarty->assign("module","News");
		
		$user = Common::getAdminLogged();
		$categories = $user->getCategoriesByModule('news');
		$this->smarty->assign("categories",$categories);
		$this->smarty->assign("mediaTypes",NewsMediaPeer::getMediaTypes());
		
	}

}
