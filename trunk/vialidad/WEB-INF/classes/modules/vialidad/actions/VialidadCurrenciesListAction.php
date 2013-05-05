<?php
/**
 * VialidadCurrenciesUnitsListAction
 *
 * Listado de Monedas basado en BaseListAction
 */

class VialidadCurrenciesListAction extends BaseListAction {
	
	function __construct() {
		parent::__construct('Currency');
	}
	
	protected function postList() {
		parent::postList();
	}
}
