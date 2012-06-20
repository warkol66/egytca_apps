<?php
/**
 * VialidadMeasureUnitsListAction
 *
 * Listado de Unidades de Medida basado en BaseListAction
 */
require_once 'BaseListAction.php';

class VialidadMeasureUnitsListAction extends BaseListAction {
	
	function __construct() {
		parent::__construct('MeasureUnit','Vialidad');
	}
	
	protected function postList() {
		parent::postList();
	}
}
