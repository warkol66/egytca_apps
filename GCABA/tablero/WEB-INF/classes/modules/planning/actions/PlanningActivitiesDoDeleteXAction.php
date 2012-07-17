<?php
/**
 * PlanningActivitiesDoDeleteXAction
 * Elimina actividades (PlanningActivity)
 *
 * @package    planning
 * @subpackage    planningBudgetRelation
 */

require_once 'BaseDoDeleteAction.php';

class PlanningActivitiesDoDeleteXAction extends BaseDoDeleteAction {
	
	function __construct() {
		parent::__construct('PlanningActivity');
	}

}