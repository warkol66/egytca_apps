<?php
/** 
 * UsersDoAddToGroupXAction
 *
 * @package users 
 * @subpackage groups 
 */

class RequirementsDoAddToDevelopmentXAction extends BaseDoEditAction {
		
	public function __construct() {
		parent::__construct('Requirement');
	}
	
	protected function preUpdate() {
		parent::preUpdate();
		
	}
	
	protected function postUpdate() {
		parent::postUpdate();
		
		//$requirement = RequirementQuery::create()->findOneById($_POST["id"]);
		$development = DevelopmentQuery::create()->findOneById($_POST["developmentId"]);
		
		if(!empty($_POST["developmentId"]) && !empty($_POST["id"])){
			$this->entity->setDevelopment($development)->save();
		}
		
		//$this->smarty->assign("requirement", $requirement);
		$this->smarty->assign("development", $development);
	}
}
