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
	
	/*

	function RequirementsDoAddToDevelopmentXAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		//por ser una action ajax.		
		$this->template->template = "TemplateAjax.tpl";

		$module = "Requirements";
		
		$requirement = RequirementQuery::create()->findOneById($_POST["requirementId"]);
		
		$smarty->assign('requirement',$requirement);


		if ( !empty($_POST["developmentId"]) && !empty($_POST["requirementId"]) ) {
			if ( $requirement->setDevelopmentid($_POST["developmentId"]) ) {
				$smarty->assign('algo',$algo);
				return $mapping->findForwardConfig('success');
			}
		}
		
		$smarty->assign('errorTagId','attendantsMsgField');
		//return $mapping->findForwardConfig('success');
		return $mapping->findForwardConfig('failure');

	}

}
