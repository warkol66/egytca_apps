<?php
/**
 * ActorsDoEditAction
 *
 * Crea o guarda cambios de actores (Actor)
 *
 * @package    actors
 */
require_once 'BaseDoEditAction.php';

class ActorsDoEditAction extends BaseDoEditAction {
	
	function __construct() {
		parent::__construct('Actor');
	}

}
