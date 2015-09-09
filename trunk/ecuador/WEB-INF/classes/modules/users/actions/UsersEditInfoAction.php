<?php
/**
 * Edicion de datos del usuario por el mismo usuario
 *
 * @package users
 */
class UsersEditInfoAction extends BaseDisplayAction {
	
	function __construct() {
		parent::__construct();
	}

	protected function preDisplay() {
		parent::preDisplay();

		$this->smarty->assign("user", Common::getLoggedUser());

		$this->template->template = "TemplatePublic.tpl";
		$module = "Users";
		$section = "Users";
		$this->smarty->assign("module", $module);
		$this->smarty->assign("section", $section);

		$this->smarty->assign("editInfo", true);
		
		//Timezones
		$timezonePeer = new TimezonePeer();
		$this->smarty->assign("timezones", $timezonePeer->getAll());

	}

}
