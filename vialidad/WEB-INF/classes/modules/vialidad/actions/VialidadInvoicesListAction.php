<?php
/**
 * VialidadInvoicesListAction
 *
 * Listado de Facturas basado en BaseListAction
 */

class VialidadInvoicesListAction extends BaseListAction {
	
	function __construct() {
		parent::__construct('Invoice');
	}
}