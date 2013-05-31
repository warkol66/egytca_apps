<?php
/**
 * VialidadInvoicesEditAction
 *
 * Formulario de modificacion de Facturas (Invoice) extendiendo BaseEditAction
 *
 * @package    vialidad
 * @subpackage    invoices
 */

class VialidadInvoicesEditAction extends BaseEditAction {
	
	function __construct() {
		parent::__construct('Invoice');
	}
}
