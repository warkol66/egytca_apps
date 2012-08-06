<?php
/**
 * CalendarEventTypesListAction
 *
 * Listado de Ejes de Gestion basado en BaseListAction
 */
require_once 'BaseListAction.php';

class CalendarEventTypesListAction extends BaseListAction {
	
	function __construct() {
		parent::__construct('EventType');
	}
	
	protected function postList() {
		parent::postList();
	}
}
