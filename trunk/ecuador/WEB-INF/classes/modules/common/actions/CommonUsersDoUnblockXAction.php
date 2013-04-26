<?php
/** 
 * CommonUsersDoUnblock
 *
 * @package users 
 */
 
class CommonUsersDoUnblockXAction extends BaseDoEditAction {

	function __construct() {
		parent::__construct($_POST['params']['type']);
	}
	
	protected function preUpdate(){
		parent::preUpdate();
		
		$this->entityParams['blockedAt'] = null;
	}
	
	protected function postUpdate(){
		parent::postUpdate();
		
		$this->smarty->assign("divId", $_POST['params']['type']);
		$this->smarty->assign("userId", $this->entity->getId());
	}
	
}
