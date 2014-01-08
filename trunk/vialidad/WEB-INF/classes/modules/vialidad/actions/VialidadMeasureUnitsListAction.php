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

	protected function preList() {
		parent::preList();
		// Esta debe ser una lista corta que no requiere paginacion, al no poder usar el notPaginated se setea un valor alto
		$this->perPage = 100;
	}

}
