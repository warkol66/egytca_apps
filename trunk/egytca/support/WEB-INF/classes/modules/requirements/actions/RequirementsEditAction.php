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
		
		//clientes, desarrollos, recursos y recursos asociados
		$this->smarty->assign("affiliates", AffiliateQuery::create()->find());	
		$this->smarty->assign("developments", DevelopmentQuery::create()->orderByName()->findByDelivered(0));
		
		if(!empty($this->entity->getDevelopmentid)){
			$this->smarty->assign("attendants",UserQuery::create()->orderByName()->findByActive(1));	
		}else{
			$arrayIds = AttendantQuery::create()->filterByEntitytype('development')->filterByEntityid($this->entity->getDevelopmentid())->select('Attendantid')->find();
			$this->smarty->assign("attendants",UserQuery::create()->filterById($arrayIds, Criteria::IN)->find());
		}
		$this->smarty->assign("asocAttendants",AttendantQuery::create()->filterByEntitytype('requirement')->filterByEntityid($this->entity->getId())->find());
	}
	
}
