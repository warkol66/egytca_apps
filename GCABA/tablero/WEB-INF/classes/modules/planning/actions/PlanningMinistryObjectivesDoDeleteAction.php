<?php
/**
 * PlanningMinistryObjectivesDoDeleteAction
 *
 * Elimina Objetivos Ministeriales (MinistryObjective) extendiendo BaseDoDeleteAction
 *
 * @package    planning
 * @subpackage    planningProjects
 */
require_once 'BaseDoDeleteAction.php';

class PlanningMinistryObjectivesDoDeleteAction extends BaseDoDeleteAction {
	
	function __construct() {
		parent::__construct('MinistryObjective');
	}
}
