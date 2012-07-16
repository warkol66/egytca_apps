<?php
/**
 * PlanningRemoveBudgetItemRelationXAction
 * Elimina relaciones de partidas presupuestarias (BudgetRelation)
 *
 * @package    planning
 * @subpackage    planningBudgetRelation
 */

require_once 'BaseDoDeleteAction.php';

class PlanningRemoveBudgetItemRelationXAction extends BaseDoDeleteAction {
	
	function __construct() {
		parent::__construct('BudgetRelation');
	}

}