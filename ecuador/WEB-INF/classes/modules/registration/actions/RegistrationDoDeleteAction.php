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

		$filters=$_REQUEST["filters"];
				$registrationUserPeer = new RegistrationUserPeer();
		//verificamos que este fijado el id a borrar
		if (isset($_GET['id'])) {
			$user=RegistrationUserQuery::create()->findPk($_GET['id']);

			if($user){
				$user->logicDelete();
				return $this->addFiltersToForwards($filters,$mapping,"success");
			}
		}

		//o bien no se llamo se paso via get el id de usuario o no se pudo borrar.
		return $this->addFiltersToForwards($filters,$mapping,"failure");

	}

}
