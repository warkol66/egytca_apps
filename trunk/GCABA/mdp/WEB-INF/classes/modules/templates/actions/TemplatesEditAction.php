<?php

/**
* TemplatesEditAction
*
* Action que permite ver los datos correspondientes de un documento que pueden modificarse
*
* @package templates
*/

class TemplatesEditAction extends BaseEditAction {

	function __construct() {
		parent::__construct('Template');
	}

	function postEdit() {
		parent::postEdit();

		$this->smarty->assign("maxUploadSize", Common::maxUploadSize());
		$this->smarty->assign("date",date("d/m/y"));

	if ($_REQUEST["uploadeFailure"])
			$this->smarty->assign("uploadeFailure", true);

	}

}
