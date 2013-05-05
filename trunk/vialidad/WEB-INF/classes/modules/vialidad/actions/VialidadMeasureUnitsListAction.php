<?php
/**
 * VialidadMeasureUnitsListAction
 *
 * Listado de Unidades de Medida basado en BaseListAction
 */

class VialidadMeasureUnitsListAction extends BaseListAction {
	
	function __construct() {
		parent::__construct('MeasureUnit');
	}
	
	protected function postList() {
		parent::postList();
	}
}
