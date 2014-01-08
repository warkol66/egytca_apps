<?php
/**
 * VialidadDepartmentsListAction
 *
 * Listado de Departamentos basado en BaseListAction
 */

class VialidadDepartmentsListAction extends BaseListAction {

	function __construct() {
		parent::__construct('Department');
	}

	protected function preList() {
		parent::preList();
		// Esta debe ser una lista corta que no requiere paginacion, al no poder usar el notPaginated se setea un valor alto
		$this->perPage = 100;
	}

}
