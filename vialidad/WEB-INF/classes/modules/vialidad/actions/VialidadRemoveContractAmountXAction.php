<?php
/**
 * VialidadRemoveContractAmountXAction
 * Elimina relaciones de partidas presupuestarias (ContractAmount)
 *
 * @package    vialidad
 * @subpackage    vialidadContractAmount
 */

require_once 'BaseDoDeleteAction.php';

class VialidadRemoveContractAmountXAction extends BaseDoDeleteAction {
	
	function __construct() {
		parent::__construct('ContractAmount');
	}

}
