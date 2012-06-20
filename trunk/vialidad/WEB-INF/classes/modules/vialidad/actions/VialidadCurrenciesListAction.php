<?php
/**
 * VialidadCurrenciesUnitsListAction
 *
 * Listado de Monedas basado en BaseListAction
 */
require_once 'BaseListAction.php';

class VialidadCurrenciesListAction extends BaseListAction {
	
	function __construct() {
		parent::__construct('Currency','Vialidad');
	}
	
	protected function postList() {
		parent::postList();
	}
}
