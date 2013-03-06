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
       
        $activities = PlanningActivityQuery::create()->filterByObjectType('Project')->filterByObjectid($_POST['id'])->delete();
    }
}
