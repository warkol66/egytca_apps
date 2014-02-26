<?php
/**
 * UsersListAction
 *
 * @package users
 */

class UsersDoEditAction extends BaseDoEditAction {

	function __construct() {
		parent::__construct('User');
	}
	
	protected function preUpdate(){
		parent::preUpdate();
	}
	
	protected function postUpdate(){
		parent::postUpdate();
		$this->forwardName = "success-edit";
		
		if(!empty($_GET['filters'])){
			$filtersUrl = http_build_query(array('filters' => $_GET['filters']));
			$this->smarty->assign("filtersUrl", $filtersUrl);
		}
	}
	
}
