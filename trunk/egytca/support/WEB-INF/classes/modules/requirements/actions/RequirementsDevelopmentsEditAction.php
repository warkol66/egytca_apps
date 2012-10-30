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
		
		$id = $this->entity->getId();
		$this->smarty->assign("asocAttendants",AttendantQuery::create()->filterByEntitytype('development')->filterByEntityid($id)->find());
		
		/*$arrayIds = AttendantQuery::create()->filterByEntitytype('development')->filterByEntityid($id)->select('Attendantid')->find();
		$this->smarty->assign("arrayIds", $arrayIds);
		
		$asocAttendants2 = UserQuery::create()->filterById($arrayIds, Criteria::IN);
		$this->smarty->assign("asocAttendants2", $asocAttendants2);*/
		
		$asocAttendants = AttendantQuery::create()
			->addJoin('requirements_attendant.entityid','users_user.id')
			->filterByEntitytype('development')
			->filterByEntityid($id)
			->find();
			
		$this->smarty->assign("asocAttendants",$asocAttendants);
		
	}

}
