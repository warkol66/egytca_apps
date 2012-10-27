<?php
/**
 * requirementsDoDeleteDevelopmentXAction
 *
 * Desasocia el desarrollo del requerimiento
 *
 */
require_once 'BaseDoDeleteAction.php';

class requirementsDoDeleteDevelopmentXAction extends BaseDoEditAction {
	
	function __construct() {
		parent::__construct('Requirement');
	}
	
	function postEdit(){
		parent::postEdit();
	
		/*$requirement = RequirementQuery::create()->findOneById($_POST["requirementId"]);
		$requirement->setDevelopmentid("NULL")->save();
		
		$this->smarty->assign("requirement",$requirement);*/
	}
}
