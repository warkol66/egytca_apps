<?php

class BoardCommentsDoDeleteAction extends BaseDoDeleteAction {
	
	function __construct() {
		parent::__construct('BoardComment');
	}

	protected function postDelete(){
		parent::postDelete();
		
		if(!empty($_GET['filters'])){
			$filtersUrl = urldecode(http_build_query(array('filters' => $_GET['filters'])));
			$this->filters = $_GET['filters'];
			$this->smarty->assign("filtersUrl", $filtersUrl);
		}
	}

}
