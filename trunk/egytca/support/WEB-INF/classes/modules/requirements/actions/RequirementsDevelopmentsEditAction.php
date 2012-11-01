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
		
		//clientes, recursos y recursos asociados
		$this->smarty->assign("affiliates", AffiliateQuery::create()->find());
		
		$arrayAsocIds = AttendantQuery::create()->filterByEntitytype('development')->filterByEntityid($this->entity->getId())->select('AttendantId')->find();
		$this->smarty->assign("attendants",UserQuery::create()->filterById($arrayAsocIds, Criteria::NOT_IN)->orderByName()->findByActive(1));
	
		$this->smarty->assign("asocAttendants",AttendantQuery::create()->filterByEntitytype('development')->filterByEntityid($this->entity->getId())->find());
		
	}

}
