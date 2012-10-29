<?php
/**
 * RequirementsDevelopmentsEditAction
 *
 * Muestra el formulario de edicion de un Desarrollo (Development)
 *
 * @package    requirements
 * @subpackage    development
 */

class RequirementsDevelopmentsEditAction extends BaseEditAction {
	
	function __construct() {
		parent::__construct('Development');
	}
	
	protected function postEdit() {
		parent::postEdit();
		
		$module = "Requirements";
		$this->smarty->assign("module",$module);
		$section = "Developments";
		$this->smarty->assign("section",$section);
		
		//clientes, desarrollos y recursos
		$this->smarty->assign("affiliates", AffiliateQuery::create()->find());
		$this->smarty->assign("attendants",UserQuery::create()->orderByName()->findByActive(1));	
	}

}
