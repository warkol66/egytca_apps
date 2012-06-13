<?php
/**
 * CalendarAxisEditAction
 *
 * Editar Ejes de Gestion basado en BaseEditAction
 */
require_once 'BaseEditAction.php';

class CalendarAxisEditAction extends BaseEditAction {
	
	function __construct() {
		parent::__construct('CalendarAxis','Calendar');
	}
	
	protected function postEdit() {
		parent::postEdit();
	}
}

