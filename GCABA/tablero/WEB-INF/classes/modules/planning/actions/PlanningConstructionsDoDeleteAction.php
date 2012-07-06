<?php
/**
 * PlanningConstructionsDoDeleteAction
 *
 * Elimina Obras (PlanningConstruction) extendiendo BaseDoDeleteAction
 *
 * @package    planning
 * @subpackage    planningProjects
 */
require_once 'BaseDoDeleteAction.php';

class PlanningConstructionsDoDeleteAction extends BaseDoDeleteAction {
	
	function __construct() {
		parent::__construct('PlanningConstruction');
	}
}
