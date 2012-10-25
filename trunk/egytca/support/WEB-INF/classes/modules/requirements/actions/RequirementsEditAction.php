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
		
		//clientes, desarrollos y recursos
		$this->smarty->assign("affiliates", AffiliateQuery::create()->find());	
		$this->smarty->assign("developments", DevelopmentQuery::create()->orderByName()->findByDelivered(0));
		$this->smarty->assign("attendants",UserQuery::create()->orderByName()->findByActive(1));	
		
	}
	
}
