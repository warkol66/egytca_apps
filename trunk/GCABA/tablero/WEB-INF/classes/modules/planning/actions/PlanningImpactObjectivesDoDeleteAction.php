<?php
/**
 * PlanningImpactObjectivesDoDeleteAction
 *
 * Elimina Objetivos de Impacto (ImpactObjective) extendiendo BaseDoDeleteAction
 *
 * @package    planning
 * @subpackage    planningProjects
 */
require_once 'BaseDoDeleteAction.php';

class PlanningImpactObjectivesDoDeleteAction extends BaseDoDeleteAction {
	
	function __construct() {
		parent::__construct('ImpactObjective');
	}
}
