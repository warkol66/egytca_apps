<?php

require_once("EmailManagement.php");

class RegistrationDoEditAction extends BaseDoEditAction {

	/**
	 * @var RegistrationUser
	 */
	protected $entity;

	function __construct() {
		parent::__construct('RegistrationUser');
	}


	/**
	 * Envia el correspondiente email de notificacionn de hash al usuario creado
	 */
	private function sendHashNotificationEmail($hash) {

		global $system;
		$systemUrl = $system["config"]["system"]["parameters"]["siteUrl"];
		//Envio de email de notificacion de creacion
		$this->smarty->assign("site", $systemUrl);
		$this->smarty->assign("hash", $hash);

		//salvamos el external actual
		$actualExternal = $this->template->template;

		//utilizamos un external especifico para el email de verificacion
		$this->template->template = 'RegistrationHashVerificationMailExternal.tpl';

		$body = $this->smarty->fetch("RegistrationHashVerificationMail.tpl");

		//ponemos el anterior external para seguir el proceso.
		$this->template->template = $actualExternal;

		$mailFrom = $system["config"]["system"]["parameters"]["fromEmail"];
		$mailTo = $this->entity->getMailaddress();

		$subject = 'Verificacion de Creacion de Cuenta';

		$manager = new EmailManagement();
		$message = $manager->createHTMLMessage($subject, $body);
		$result = $manager->sendMessage($mailTo, $mailFrom, $message);

		$this->smarty->assign("email", $mailTo);

	}


	/**
	 * Creacion de un usuario nuevo y le asocia un hash para su activacion.
	 * El usuario no queda activado
	 */
	private function createUserWithHash() {
		$hash = RegistrationUserQuery::generateHash($this->entity);
		$this->sendHashNotificationEmail($hash);
	}

	/**
	 * Opera con los distintos tipos de registracion
	 *
	 */
	private function performRegistration() {

		$this->smarty->assign("registrationUser", $this->entity);

		$type = Common::getRegistrationMode();

		//caso de registracion de modo abierto
		if ($type == 'Open') {
			$this->entity->setActive(1);
			$this->entity->setVerified(1);
			$this->entity->save();
			$this->forwardName = 'success-user-open';
		}

		if ($type == 'Email Verification' || $type == 'Moderated with Email Verification') {
			$this->createUserWithHash();
			$this->forwardName = 'success-user-hash';
		}

		if ($type == 'Moderated') {
			$this->entity->setActive(1);
			$this->entity->save();
			$this->smarty->assign('moderated', true);
			$this->forwardName = 'success-user-moderated';
		}

	}


	protected function preUpdate() {
		parent::preUpdate();
		$this->template->template = 'TemplateJQuery.tpl';
		// Quitandole la informacion del usuario que hizo lo cambios que no es necesaria en este modulo.
		unset($this->entityParams["userObjectType"], $this->entityParams["userObjectId"], $this->entityParams["userId"]);

		$loggedUser = Common::getLoggedUser();

		if ($loggedUser && get_class($loggedUser) == "RegistrationUser") {
			$this->template->template = "TemplatePublic.tpl";

			// Esto se hace para asegurar que un usuario maliciocioso que no puede modificar estos valores.
			unset($this->entityParams["username"]);
			unset($this->entityParams["active"]);
		}
	}

	/**
	 * Antes de salvar el usuario registrado en este metodo se haran todas las operaciones necesarias.
	 */
	protected function preSave() {
		parent::preSave();

		$loggedUser = Common::getLoggedUser();

		/**
		 * Esete es el caso de un usuario registrado en el sitio publico editando Mi Perfil
		 */
		if ($loggedUser && get_class($loggedUser) == "RegistrationUser") {
			$entity = RegistrationUserQuery::create()->findPk($loggedUser->getId());
			if ($entity) $this->entity = $entity;
		}

		/**
		 * Chequeando que los password coinciden
		 */
		if ($this->entityParams["password"] != $this->entityParams["check_password"]) {
			throw new Exception("error_passwd", 1);
		}

		/**
		 * Chequeando el codigo del captcha
		 */
		if (!$loggedUser && Common::getRegistrationCaptchaUse()) {
			if ((empty($_POST['securityCode'])) || !Common::validateCaptcha($_POST['securityCode'])) {
				$this->smarty->assign('captcha', true);
				$this->smarty->assign("message", "error");
				throw new Exception("error_captcha", 1);
			}
		}

		/**
		 * Chequeando los posibles errores de validacionde propel.
		 */
		if (!$this->entity->validate()) {
			throw new Exception("error_fields", 1);
		}

		if ($this->entity->isNew()) {
			$this->entity->setIp($_SERVER['REMOTE_ADDR']);
		}

		/**
		 * Aplicando el hash al password
		 */
		if ($this->entity->isNew() || $this->entityParams["password"] != "") {
			$this->entity->setPassword(RegistrationUser::encryptPassword($this->entityParams["password"]));
			$this->entity->setPasswordupdated(mktime());
		}

		if (!$loggedUser) {
			$this->entity->setActive(0);
			$this->entity->setVerified(0);
		}
	}

	/**
	 * Para comprobar si paso las reglas de validacion
	 */
	protected function postUpdate() {
		parent::postUpdate();
		$loggedUser = Common::getLoggedUser();
		if ($loggedUser) {
			if (get_class($loggedUser) == "User")
				$this->forwardName = "success";
			else
				$this->forwardName = "success-edit";
		} else $this->performRegistration();
	}

	/**
	 * En caso de Fallo
	 * @param Exception $e
	 */
	protected function onFailure(Exception $e) {
		$this->entity->fromArray($this->entityParams, BasePeer::TYPE_FIELDNAME);
		$this->smarty->assign("failures", $this->entity->getValidationFailures());
		$this->smarty->assign("registrationUser", $this->entity);
		$this->smarty->assign("error", $e->getMessage());
		$this->smarty->assign("countries", RegistrationUserQuery::getCountries());

		$loggedUser = Common::getLoggedUser();

		if ($loggedUser && get_class($loggedUser) == "User") {
			$this->smarty->assign('admin', true);
		}

		$this->smarty->assign("loggedUser",$loggedUser);

		//verifico que este activo el newsletter para que construir la vista.
		if (Common::systemHasNewsletter()) {
			$this->smarty->assign('newsletterActive', true);
		}

		//verifico la utilizacion de captcha para construir la opcion en la vista
		if (!$loggedUser && Common::getRegistrationCaptchaUse()) {
			$this->smarty->assign('useCaptcha', true);
		}
	}

}