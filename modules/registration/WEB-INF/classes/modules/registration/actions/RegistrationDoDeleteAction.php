<?php

class RegistrationDoDeleteAction extends BaseAction {

	function RegistrationDoDeleteAction() {
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

				$registrationUserPeer = new RegistrationUserPeer();
		//verificamos que este fijado el id a borrar
		if (isset($_GET['id_registered_user'])) {

			if ( $registrationUserPeer->delete($_GET["id_registered_user"])) {
				return $mapping->findForwardConfig('success');
			}
		}

		//o bien no se llamo se paso via get el id de usuario o no se pudo borrar.
		return $mapping->findForwardConfig('failure');

	}

}
