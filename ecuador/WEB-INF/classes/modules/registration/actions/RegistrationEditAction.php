<?php

require_once 'BaseEditAction.php';

/**
 * @property Smarty $smarty
 *
 */
class RegistrationEditAction extends BaseEditAction {


	/**
	 * Esto para el intellisense del editor
	 * @var RegistrationUser
	 */
	protected $entity;


	function __construct() {
		parent::__construct('RegistrationUser');

	}

	protected function preEdit(){
		$this->template->template = 'TemplateJQuery.tpl';
	}

	protected function postEdit() {
		parent::postEdit();

		$this->smarty->assign("countries", RegistrationUserQuery::getCountries());

		$loggedUser=Common::getLoggedUser();

		if ($loggedUser && get_class($loggedUser)=="User") {
			$this->smarty->assign('admin',true);
		}

		$this->smarty->assign("loggedUser",$loggedUser);

		//verifico que este activo el newsletter para que construir la vista.
		if (Common::systemHasNewsletter()) {
			$this->smarty->assign('newsletterActive',true);
		}

		//verifico la utilizacion de captcha para construir la opcion en la vista
		if (!$loggedUser && Common::getRegistrationCaptchaUse()) {
			$this->smarty->assign('useCaptcha',true);
		}

		/**
		 * Use a different template si no es usuario administrativo
		 */
		if (!$loggedUser || get_class($loggedUser)!="User") {
			$this->template->template = "TemplatePublic.tpl";
		}

		//verifico si el usuario registrado quiere efectuar cambios sobre los datos de su cuenta.
		if ($loggedUser && get_class($loggedUser)=="RegistrationUser") {
			$entity=RegistrationUserQuery::create()->findPk($loggedUser->getId());
			if($entity) $this->entity=$entity;
		}


	}

}
