<?php
/**
 * PlanningActivitiesDoDeleteAction
 * Elimina actividades (PlanningActivity)
 *
 * @package    planning
 * @subpackage    planningBudgetRelation
 */

class PlanningActivitiesDoDeleteAction extends BaseDoDeleteAction {
	
	function __construct() {
		parent::__construct('PlanningActivity');
	}

}