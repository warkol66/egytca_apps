<?php



require_once 'BaseListAction.php';
/**
 * Listado de Usuarios Registrados
 * @package registration
 */
class RegistrationValidationUsernameX extends BaseAction {

	function __construct() {

	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);


		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if ($smarty == NULL) {
			echo 'No PlugIn found matching key: ' . $plugInKey . "<br>\n";
		}

		$module = "Registration";
		$smarty->assign('module', $module);

		$username = $_POST["params"]["username"];
		if ($username != "") {

		}
		return $mapping->findForwardConfig('success');
	}

}