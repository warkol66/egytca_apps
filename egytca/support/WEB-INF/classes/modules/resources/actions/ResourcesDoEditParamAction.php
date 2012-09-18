<?php

require_once 'BaseDoEditAction.php';

class ResourcesDoEditParamAction extends BaseDoEditAction {
	
	public function __construct() {
		parent::__construct('Resource');
	}
	
	protected function preUpdate() {
		parent::preUpdate();
		
		if (!empty($_POST['id']) && !empty($_POST['paramName'])) {
			$this->entityParams[$_POST['paramName']] = $_POST['paramValue'];
		} else {
			throw new Exception('invalid params');
		}
	}
	
	protected function postUpdate() {
		parent::postUpdate();
		
		$this->smarty->assign('paramName', $_POST['paramName']);
		$this->smarty->assign('paramValue', $this->entity->getByName(ucfirst($_POST['paramName']), BasePeer::TYPE_PHPNAME));
	}
}