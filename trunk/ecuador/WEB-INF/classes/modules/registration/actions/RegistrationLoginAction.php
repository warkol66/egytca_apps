<?php

class RegistrationLoginAction extends BaseAction {

	function RegistrationLoginAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

			/**
			* Use a different template si no es usuario administrativo
			*/
			if (!isset($_SESSION["login_user"]))
				$this->template->template = "TemplatePublic.tpl";

		$module = "Registration";

			$smarty->assign("message",$_GET["message"]);

		return $mapping->findForwardConfig('success');
	}

}
