<?php
/**
 * RequirementsViewXAction
 *
 * Vista via AJAX de Requirement (Requirement)
 *
 * @package    requirement
 */

class RequirementsViewXAction extends BaseEditAction {

	function __construct() {
		parent::__construct('Requirement');
	}

	protected function postEdit() {
		parent::postEdit();
		if ($this->entity->isNew());
			$this->smarty->assign("notValidId", true);

		$this->smarty->assign("show", true);

	}
}
