<?php
/**
 * RequirementsDoEditAction
 *
 * Crea o guarda cambios de actores (Actor)
 *
 * @package    actors
 */
require_once 'BaseDoEditAction.php';

class RequirementsDoEditAction extends BaseDoEditAction {
	
	function __construct() {
		parent::__construct('Requirement');
	}

}
