<?php
/**
 * PlanningIndicatorsDoDeleteAction
 *
 * Elimina Indicadores de Planeamiento (PlanningIndicator) extendiendo BaseDoDeleteAction
 *
 * @package    planning
 * @subpackage    planningIndicators
 */
require_once 'BaseDoDeleteAction.php';

class PlanningIndicatorsDoDeleteAction extends BaseDoDeleteAction {
	
	function __construct() {
		parent::__construct('PlanningIndicator');
	}
}


 