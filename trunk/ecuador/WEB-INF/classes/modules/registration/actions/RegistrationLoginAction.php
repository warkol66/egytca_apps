<?php
/**
 * Muestra formulario de login
 *
 * @package    registration
 */

class RegistrationLoginAction extends BaseDisplayAction {

	function __construct() {
		parent::__construct();
		$this->module = "Registration";
	}

	protected function preDisplay() {
		parent::preDisplay();
		// Use a different template si no es usuario administrativo
		if (!isset($_SESSION["login_user"]))
			$this->template->template = "TemplatePublic.tpl";
	}

	protected function postDisplay() {
		parent::postDisplay();
	}

}
