<?php
/**
 * PlanningIndicatorsDoDeleteAction
 *
 * Elimina Proyectos (PlanningProject) extendiendo BaseDoDeleteAction
 *
 * @package    planning
 * @subpackage    planningProjects
 */
require_once 'BaseDoDeleteAction.php';

class PlanningProjectsDoDeleteAction extends BaseDoDeleteAction {
	
	function __construct() {
		parent::__construct('PlanningProject');
	}
	
	function postDelete(){
		parent::postDelete();

		//elimino actividades y obras asociadas
		//el delete hace un archive antes de eliminar el objeto
		PlanningActivityQuery::create()->filterByObjectType('Project')->filterByObjectid($_POST['id'])->delete();
		$constructions = PlanningConstructionQuery::create()->filterByPlanningProjectId($_POST['id'])->find();
		foreach($constructions as $construction){
			PlanningActivityQuery::create()->filterByObjectType('Construction')->filterByObjectid($construction->getId())->delete();
			$construction->delete();
		}
    }
}
