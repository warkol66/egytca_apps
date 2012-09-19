<?php
/**
 * RequirementsDevelopmentsViewXAction
 *
 * Vista via AJAX de Desarrollos (Development)
 *
 * @package    requirements
 * @subpackage    development
 */

class RequirementsDevelopmentsViewXAction extends BaseEditAction {

	function __construct() {
		parent::__construct('Development');
	}

	protected function postEdit() {
		parent::postEdit();
		if ($this->entity->isNew());
			$this->smarty->assign("notValidId", true);

		$this->smarty->assign("show", true);

	}
}
