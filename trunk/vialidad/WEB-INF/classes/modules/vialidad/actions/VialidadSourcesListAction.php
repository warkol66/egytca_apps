<?php
/**
 * VialidadSourcesListAction
 *
 * Listado de Fuentes de Finaciamiento basado en BaseListAction
 */

class VialidadSourcesListAction extends BaseListAction {
	
	function __construct() {
		parent::__construct('Source');
	}

	protected function preList() {
		parent::preList();
		// Esta debe ser una lista corta que no requiere paginacion, al no poder usar el notPaginated se setea un valor alto
		$this->perPage = 100;
	}

}
