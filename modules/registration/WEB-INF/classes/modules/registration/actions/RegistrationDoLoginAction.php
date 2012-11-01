<?php

class RegistrationDoLoginAction extends BaseAction {

	function RegistrationDoLoginAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$success = 'success';
		$failure = 'failure';

		$smarty->assign("message",'logged');

			/**
			* Use a different template si no es usuario administrativo
			*/
			if (!isset($_SESSION["login_user"]))
				$this->template->template = "TemplatePublic.tpl";

			/**
			* Use a different template si es por ajax y cambio los forwards
			*/
			if (!empty($_REQUEST["ajax"])) {
			$this->template->template = "TemplateAjax.tpl";
			$success = 'successAjax';
			$failure = 'failureAjax';
		}


		$module = "Registration";
		if ( !empty($_POST["registrationUsername"]) && !empty($_POST["registrationPassword"]) ) {
			$user = RegistrationUserPeer::auth($_POST["registrationUsername"],$_POST["registrationPassword"]);
			if ( !empty($user) ) {
				$_SESSION["loginRegistrationUser"] = $user;
				$smarty->assign("loginRegisteredUser",$user);
				return $mapping->findForwardConfig($success);
			}
		}

		//caso si ya estaba registrado
		if (isset($_SESSION["loginRegistrationUser"])) {
			$smarty->assign("loginRegisteredUser",$_SESSION["loginRegistrationUser"]);
			return $mapping->findForwardConfig($success);

		}


			$smarty->assign("message","wrongUser");
		return $mapping->findForwardConfig($failure);
	}

}
