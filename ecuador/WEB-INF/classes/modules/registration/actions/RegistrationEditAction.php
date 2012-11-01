<?php

class RegistrationEditAction extends BaseAction {


	function RegistrationEditAction() {
		;
	}


	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Registration";
		$smarty->assign("module",$module);

		//opciones para construccion de la vista
		$registrationUserInfoPeer = new RegistrationUserInfoPeer();
		$groups = $registrationUserInfoPeer->getGroups();
		$smarty->assign('groups',$groups);

		$countries = $registrationUserInfoPeer->getCountries();
		$smarty->assign('countries',$countries);

		//indicador de que es usuario administrativo para opciones especiales de edicion
		if (isset($_SESSION["login_user"])) {
			$smarty->assign('admin',true);
		}


		//verifico que este activo el newsletter para que construir la vista.
		if (Common::systemHasNewsletter()) {
			$smarty->assign('newsletterActive',true);
		}

		//verifico la utilizacion de captcha para construir la opcion en la vista
		if ((!isset($_SESSION["login_user"])) && Common::getRegistrationCaptchaUse()) {
			$smarty->assign('useCaptcha',true);
		}


		//verifico si un User de Administracion quiere hacer una modificacion sobre un usuario por registracion
		//TODO posible agregado de verificacion de permisos de los usuarios.
		if (isset($_GET['id_registered_user']) && isset($_SESSION["login_user"])) {

			$userByRegistrationPeer = new RegistrationUserPeer();
			$result = $userByRegistrationPeer->get($_GET['id_registered_user']);
			//devolvemos los datos del usuario creado.
			$smarty->assign("userByRegistration",$result);
			$smarty->assign("action","update");
			return $mapping->findForwardConfig('success');

		}

			/**
			* Use a different template si no es usuario administrativo
			*/
			if (!isset($_SESSION["login_user"])) {
			$this->template->template = "TemplatePublic.tpl";
		}

		//verifico si el usuario registrado quiere efectuar cambios sobre los datos de su cuenta.
		if (isset($_SESSION['loginRegistrationUser'])) {
			$user = $_SESSION['loginRegistrationUser'];
			$smarty->assign("userByRegistration",$user);
			$smarty->assign("action","update");
			return $mapping->findForwardConfig('success');
		}

		//sera entonces un usuario nuevo.

		$smarty->assign("action","new");
		return $mapping->findForwardConfig('success');
	}

}
