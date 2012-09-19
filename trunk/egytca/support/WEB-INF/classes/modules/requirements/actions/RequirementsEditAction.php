<?php
/**
 * RequirementsEditAction
 *
 * Muestra el formulario de edicion de un Requirement (Requirement)
 *
 * @package    requirement
 */

class RequirementsEditAction extends BaseEditAction {

	function __construct() {
		parent::__construct('Requirement');
	}

	protected function postEdit() {
		parent::postEdit();
	}
}
