<?php
/**
 * RequirementsEditAction
 *
 * Muestra el formulario de edicion de un Requirement (Requirement)
 *
 * @package    requirement
 */

class RequirementsEditAction extends BaseEditAction {

	function __construct() {
		parent::__construct('Requirement');
	}

	protected function postEdit() {
		parent::postEdit();
		 
		$module = "Requirements";
		$this->smarty->assign("module",$module);
		$section = "Requirements";
		$this->smarty->assign("section",$section);
		
		/*if($this->requirement->isNew()){
		
		//consultas para nuevo	
			
		}else{*/
			
		//caso edicion
		$developments = DevelopmentQuery::create()
			->orderByName()
			->findByDelivered(0);
					
		$this->smarty->assign("developments", $developments);
		
		$attendants = UserQuery::create()
			->orderByName()
			->findByActive(1);

		$this->smarty->assign("attendants",$attendants);	
		//}
		
	}
	
	/*
	function RequirementsEditAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Requirements";
		$smarty->assign("module",$module);
		$section = "Requirements";
		$smarty->assign("section",$section);

		$id = $request->getParameter("id");
		$smarty->assign("id",$id);
		
		//caso: editar requirement
		if (!empty($id)) {
			
			$requirement = RequirementQuery::create()->findOneById($id);
			
			//caso: no existe requirement con ese id
			if (empty($requirement)){
				
				$smarty->assign("notValidId","true");
				$smarty->assign("action","create");
			
			}
			//caso: existe el requirement
			else{
				
				$smarty->assign("action","edit");
				
				$attendants = UserQuery::create()
					->orderByName()
					->findByActive(1);
					
				$smarty->assign("attendants",$attendants);
				
				$developments = DevelopmentQuery::create()
					->orderByName()
					->findByDelivered(0);
					
				$smarty->assign("developments", $developments);
			}
		}
		//caso: crear nuevo requirement
		else{
			
			$requirement = new Requirement();
			$smarty->assign("action","create");
			
		}
		
		$attendants = UserQuery::create()
			->orderByName()
			->findByActive(1);

		$smarty->assign("requirement",$requirement);
		
		return $mapping->findForwardConfig('success');
	}*/
}
