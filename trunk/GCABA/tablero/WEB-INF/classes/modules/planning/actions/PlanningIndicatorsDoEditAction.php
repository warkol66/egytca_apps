<?php
/**
 * PlanningIndicatorsDoEditAction
 *
 * Crea o guarda cambios de Indicadores de Planeamiento (PlanningIndicator)
 *
 * @package    planning
 * @subpackage    planningIndicators
 */
require_once 'BaseDoEditAction.php';

class PlanningIndicatorsDoEditAction extends BaseDoEditAction {
	
	function __construct() {
		parent::__construct('PlanningIndicator');
	}

}
