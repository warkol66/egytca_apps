<?php

class BlogDoEditAction extends BaseDoEditAction {

	function __construct() {
		parent::__construct('BlogEntry');
	}
	
	protected function postUpdate(){
		parent::postUpdate();
		
		if(!empty($_GET['filters'])){
			$filtersUrl = http_build_query(array('filters' => $_GET['filters']));
			$this->smarty->assign("filtersUrl", $filtersUrl);
		}
	}
	
}
