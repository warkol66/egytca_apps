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
}
