<?php
/**
 * VialidadConstructionTypesListAction
 *
 * Listado de Tipos de Obra basado en BaseListAction
 */

class VialidadConstructionTypesListAction extends BaseListAction {
	
	function __construct() {
		parent::__construct('ConstructionType');
	}

	protected function preList() {
		parent::preList();
		// Esta debe ser una lista corta que no requiere paginacion, al no poder usar el notPaginated se setea un valor alto
		$this->perPage = 100;
	}

}
