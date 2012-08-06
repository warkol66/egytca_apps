<?php
/**
 * CalendarEventTypesEditAction
 *
 * Editar Ejes de Gestion basado en BaseEditAction
 */
require_once 'BaseEditAction.php';

class CalendarEventTypesEditAction extends BaseEditAction {
	
	function __construct() {
		parent::__construct('EventType','Calendar');
	}
	
	protected function postEdit() {
		parent::postEdit();
	}
}

