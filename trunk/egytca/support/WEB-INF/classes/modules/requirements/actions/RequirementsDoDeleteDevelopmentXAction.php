<?php
/**
 * requirementsDoDeleteDevelopmentXAction
 *
 * Desasocia el desarrollo del requerimiento
 *
 */
require_once 'BaseDoDeleteAction.php';

class requirementsDoDeleteDevelopmentXAction extends BaseDoDeleteAction {
	
	function __construct() {
		parent::__construct('Requirement');
	}
	
	function postDelete(){
		parent::postDelete();
		
		}
	}
}
