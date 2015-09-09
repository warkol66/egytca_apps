<?php
/**
 * UsersLoginAction
 *
 * @package users
 */

class UsersLoginAction extends BaseDisplayAction {

	function __construct() {
		parent::__construct();
		$this->module = "Users";
	}

	protected function preDisplay() {
		parent::preDisplay();

		// si hay usuario logueado cambio forwardName
		if (!empty($_SESSION["loginUser"]) || !empty($_SESSION["loginAffiliateUser"]) )
			$this->forwardName = 'welcome';

		$this->template->template = "TemplateLogin.tpl";

		if (Common::hasUnifiedLogin()) {
			$this->smarty->assign("unifiedLogin",true);
			Common::setValueUnifiedLoginCookie($_POST['select']);
		}

		if (Common::hasUnifiedLogin()) {
			$this->smarty->assign("unifiedLogin",true);

			$value = Common::getValueUnifiedLoginCookie();

			if (!empty($value) || $value == "0") {
				$this->smarty->assign('cookieSelection',$value);
			}
		}

	}

}
