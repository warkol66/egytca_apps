<?php

require_once("EmailManagement.php");

class RegistrationDoEditAction extends BaseAction {

	function RegistrationDoEditAction() {
		;
	}

	/**
	 * Creacion y activacion de un usuario nuevo.
	 */
	private function createActiveUser($smarty) {

		$userByRegistrationPeer = new RegistrationUserPeer();
		$newUser = $userByRegistrationPeer->create($_POST["registrationUser"],$_POST["registrationUserInfo"]);
		$userByRegistrationPeer->activateUser($newUser);
		$smarty->assign("message","created");
	}

	/**
	 * Creacion de un usuario nuevo, el mismo no queda activado y debera ser activado por un moderador.
	 */
	private function createUser($smarty) {

		$userByRegistrationPeer = new RegistrationUserPeer();
		$newUser = $userByRegistrationPeer->create($_POST["registrationUser"],$_POST["registrationUserInfo"]);
		$smarty->assign("message","created-moderated");
	}

	/**
	 * Envia el correspondiente email de notificacionn de hash al usuario creado
	 */
	private function sendHashNotificationEmail($smarty,$newUser,$hash) {

		global $system;
		$systemUrl = $system["config"]["system"]["parameters"]["siteUrl"];
		//Envio de email de notificacion de creacion
		$smarty->assign("site",$systemUrl);
		$smarty->assign("hash",$hash);
		$smarty->assign("newUser",$newUser);

		//salvamos el external actual
		$actualExternal = $this->template->template;

		//utilizamos un external especifico para el email de verificacion
		$this->template->template = 'RegistrationHashVerificationMailExternal.tpl';

		$body = $smarty->fetch("RegistrationHashVerificationMail.tpl");

		//ponemos el anterior external para seguir el proceso.
		$this->template->template = $actualExternal;

		global $system;

		$mailFrom = $system["config"]["system"]["parameters"]["fromEmail"];
		$mailTo = $newUser->getUsername();

		$subject = 'Verificacion de Creacion de Cuenta';

		$manager = new EmailManagement();
		$message = $manager->createHTMLMessage($subject,$body);
		$result = $manager->sendMessage($mailTo,$mailFrom,$message);

		$smarty->assign("email",$mailTo);

	}

	/**
	 * Creacion de un usuario nuevo y le asocia un hash para su activacion.
	 * El usuario no queda activado
	 */
	private function createUserWithHash($smarty) {

		$userByRegistrationPeer = new RegistrationUserPeer();
		$newUser = $userByRegistrationPeer->create($_POST["registrationUser"],$_POST["registrationUserInfo"]);
		$hash = $userByRegistrationPeer->generateHash($newUser);
		$this->sendHashNotificationEmail($smarty,$newUser,$hash);

	}


	/**
	 * Actualizacion de un usuario nuevo
	 */
	private function updateUser($smarty) {
		$userByRegistrationPeer = new RegistrationUserPeer();
		$userByRegistrationPeer->update($_POST["registrationUser"],$_POST["registrationUserInfo"]);
		$smarty->assign("message","saved");
	}

	/**
	 * Opera con los distintos tipos de registracion
	 *
	 */
	private function performRegistration($mapping,$smarty) {

		$type = Common::getRegistrationMode();

		//caso de registracion de modo abierto
		if ($type == 'Open') {
			$this->createActiveUser($smarty);
			return $mapping->findForwardConfig('success-user-open');
		}

		if ($type == 'Email Verification' || $type == 'Moderated with Email Verification') {
			$this->createUserWithHash($smarty);
			return $mapping->findForwardConfig('success-user-hash');
		}

		if ($type == 'Moderated') {
			$this->createUser($smarty);
			$smarty->assign('moderated',true);
			return $mapping->findForwardConfig('success-user-moderated');
		}

	}


	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Registration";
		$smarty->assign("values",$_POST);
		$smarty->assign("action",$_POST['action']);

		//verifico la utilizacion de captcha para construir la opcion en la vista
		if ((!isset($_SESSION["login_user"])) && Common::getRegistrationCaptchaUse()) {
			$smarty->assign('useCaptcha',true);
		}

		if (isset($_POST['action'])) {

				//opciones para construccion de la vista
				$registrationUserInfoPeer = new RegistrationUserInfoPeer();
				$registrationUserPeer = new RegistrationUserPeer();
				$groups = $registrationUserInfoPeer->getGroups();
				$smarty->assign('groups',$groups);

				$countries = $registrationUserInfoPeer->getCountries();
				$smarty->assign('countries',$countries);


				//verifico que este activo el newsletter para que construir la vista.
				if (Common::systemHasNewsletter()) {
					$smarty->assign('newsletterActive',true);
				}

					/**
					* Use a different template si no es usuario administrativo
					*/
					if (!isset($_SESSION["login_user"]))
						$this->template->template = "TemplatePublic.tpl";

				//validaciones
				//campos no nulos
				if ($_POST['action'] == "new") {
					$resValidation = $registrationUserPeer->validateParamsUser($_POST['registrationUser']);
					$resValidation = $resValidation && $registrationUserPeer->validateParamsUserInfo($_POST['registrationUserInfo']);

				}
				else {

					$user = RegistrationUserPeer::get($_POST['registrationUser']['id']);
					$smarty->assign("userByRegistration",$result);

					$resValidation = $registrationUserPeer->validateParamsUserInfo($_POST['registrationUserInfo']);

				}

				if (!$resValidation) {
					//error de validacion de campos
					$smarty->assign("message","error_fields");
					$smarty->assign("failedRegistrationUserInfo",$_POST['registrationUserInfo']);
					$smarty->assign("failedRegistrationUser",$_POST['registrationUser']);
					return $mapping->findForwardConfig('failure');
				}


				//passwords iguales
				if ( $_POST['registrationUser']["password"] != $_POST['registrationUser']["check_password"] ) {
					//error de validacion de password
					$smarty->assign("message","error_passwd");
					$smarty->assign("failedRegistrationUserInfo",$_POST['registrationUserInfo']);
					$smarty->assign("failedRegistrationUser",$_POST['registrationUser']);
					return $mapping->findForwardConfig('failure');

				}

				//validacion de captcha
				if ((!isset($_SESSION["login_user"])) && Common::getRegistrationCaptchaUse()) {
					//validamos el captcha
					if ( (empty($_POST['securityCode'])) || !Common::validateCaptcha($_POST['securityCode'])) {
						$smarty->assign('captcha',true);
						$smarty->assign("message","error_captcha");
						$smarty->assign("failedRegistrationUserInfo",$_POST['registrationUserInfo']);
						$smarty->assign("failedRegistrationUser",$_POST['registrationUser']);
						return $mapping->findForwardConfig('failure');
					}
				}

				if ($_POST['action'] == "new") {
						$userVal = RegistrationUserPeer::usernameIsUsed($_POST['registrationUserInfo']['mailAddress']);
				}
				else {

						$user = RegistrationUserPeer::get($_POST['registrationUser']['id']);
						$userVal = !($user->canChangeToUsername($_POST['registrationUserInfo']['mailAddress']));

				}

				if ($userVal) {
					//error de validacion de nombre de usuario
					$smarty->assign("message","error_username_used");
					$smarty->assign("failedRegistrationUserInfo",$_POST['registrationUserInfo']);
					$smarty->assign("failedRegistrationUser",$_POST['registrationUser']);

					return $mapping->findForwardConfig('failure');
				}

				//se puede realizar la accion

				//es una creacion de un nuevo usuario registrado
				if ($_POST['action'] == "new") {

					if (isset($_SESSION["login_user"])) {
						//era un usuario administrativo
						$this->createActiveUser($smarty);
						return $mapping->findForwardConfig('success-admin');
					}
					//era un usuario registrado.
					return $this->performRegistration($mapping,$smarty);

				}
				if ($_POST['action'] == "update") {
					$this->updateUser($smarty);

					if (isset($_SESSION['login_user'])) {
						return $mapping->findForwardConfig('success-admin');
					}
					//era un usuario registrado.
					return $mapping->findForwardConfig('success-update-user');


				}


		}

		$smarty->assign("message","error_fields");
		return $mapping->findForwardConfig('failure');

	}



}