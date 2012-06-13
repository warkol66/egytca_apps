<?php
/**
 * CalendarAxisListAction
 *
 * Listado de Ejes de Gestion basado en BaseListAction
 */
require_once 'BaseListAction.php';

class CalendarAxisListAction extends BaseListAction {
	
	function __construct() {
		parent::__construct('CalendarAxis','Calendar');
	}
	
	protected function postList() {
		parent::postList();
	}
}
