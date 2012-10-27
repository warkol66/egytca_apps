<?php
/** 
 * UsersDoAddToGroupXAction
 *
 * @package users 
 * @subpackage groups 
 */

class RequirementsDoAddToDevelopmentXAction extends BaseAction {
	
	public function __construct() {
		parent::__construct('Requirement');
	}
	
	protected function preEdit() {
		parent::preEdit();
		
		$this->module = "Requirements";
	}
	
	protected function postEdit() {
		parent::postEdit();
		
		if ( !empty($_POST["developmentId"]) && !empty($_POST["requirementId"]) ) {
			
			$assoc_dev = DevelopmentQuery::create()->findOneById($_POST["developmentId"]);
			
			if(!empty($assoc_dev)){
				
				if($this->entity->setDevelopmentid($_POST["developmentId"])->save() ){
				
					$this->smarty->assign('development',$assoc_dev);
				}	
			}	
		}
		
		$this->smarty->assign("module", $this->module);
	}
	
}
