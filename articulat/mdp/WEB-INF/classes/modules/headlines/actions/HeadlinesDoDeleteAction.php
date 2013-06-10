<?php
/**
 * HeadlinesDoDeleteAction
 *
 * Elimina Proyectos (Headline) extendiendo BaseDoDeleteAction
 *
 * @package    planning
 * @subpackage    planningProjects
 */
require_once 'BaseDoDeleteAction.php';

class HeadlinesDoDeleteAction extends BaseDoDeleteAction {
	
	function __construct() {
		parent::__construct('Headline');
	}
}
