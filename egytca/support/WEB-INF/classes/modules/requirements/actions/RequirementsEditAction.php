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
		
		$arrayAsocIds = AttendantQuery::create()->filterByEntitytype('requirement')->filterByEntityid($this->entity->getId())->select('AttendantId')->find();
		$developmentId = $this->entity->getDevelopmentid();
		if(empty($developmentId)){
			$this->smarty->assign("attendants",UserQuery::create()->filterById($arrayAsocIds, Criteria::NOT_IN)->orderByName()->findByActive(1));	
		}else{
			$arrayIds = AttendantQuery::create()->filterByEntitytype('development')->filterByEntityid($this->entity->getDevelopmentid())->select('Attendantid')->find();
			$this->smarty->assign("attendants",UserQuery::create()->filterById($arrayIds, Criteria::IN)->filterById($arrayAsocIds, Criteria::NOT_IN)->find());
		}
		$this->smarty->assign("asocAttendants",AttendantQuery::create()->filterByEntitytype('requirement')->filterByEntityid($this->entity->getId())->find());
	}
	
}
