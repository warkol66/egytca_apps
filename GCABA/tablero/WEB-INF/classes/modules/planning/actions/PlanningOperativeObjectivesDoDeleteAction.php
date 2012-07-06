<?php
/**
 * PlanningOperativeObjectivesDoDeleteAction
 *
 * Elimina Objetivos Operativos (OperativeObjective)
 *
 * @package    planning
 * @subpackage    planningOperativeObjectives
 */
require_once 'BaseDoDeleteAction.php';

class PlanningOperativeObjectivesDoDeleteAction extends BaseDoDeleteAction {
	
	function __construct() {
		parent::__construct('OperativeObjective');
	}
}
