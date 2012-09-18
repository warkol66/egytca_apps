<?php
/**
 * RequirementsDoDeleteAction
 *
 * Elimina Objetivos Operativos (Requirement)
 *
 * @package    planning
 * @subpackage    planningOperativeObjectives
 */
require_once 'BaseDoDeleteAction.php';

class RequirementsDoDeleteAction extends BaseDoDeleteAction {
	
	function __construct() {
		parent::__construct('Requirement');
	}
}
