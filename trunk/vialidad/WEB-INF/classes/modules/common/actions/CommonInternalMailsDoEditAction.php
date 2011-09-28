<?php

class CommonInternalMailsDoEditAction extends BaseAction {

	function CommonInternalMailsDoEditAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}
		
		$params = $_POST["internalMail"];
		
		//Asociamos al usuario actual como remitente del mensaje.
		if (!$this->bindCurrentUserToParams($params)) {
			global $loginPath;
			$phpSelf = $_SERVER["PHP_SELF"];
			return new ForwardConfig('/Main.php?do='.$loginPath, True);
		}
		
		$smarty->assign("filters", $_POST["filters"]);
		$smarty->assign("page", $_POST["page"]);
		$smarty->assign("message", $_POST["message"]);
		
		if (empty($_POST["id"])) {
			$internalMail = new InternalMail;
			Common::setObjectFromParams($internalMail, $params);
			$internalMail->send();
		}
		else
			//No hay edición de mensajes.
			return $mapping->findForwardConfig('failure');
		
		return $mapping->findForwardConfig('success');
	}

	/**
	 * Asocia el usuario actualmente logueado con el remitente del
	 * mensaje.
	 * 
	 * @param array $params, arreglo asociativo de parametros.
	 * @return true si se realizó con exito, false sino.
	 */
	protected function bindCurrentUserToParams(&$params) {

		$user = Common::getLoggedUser();

		if (is_object($user) && get_class($user) == 'User')
			$params = array_merge_recursive($params, array("fromType" => "user", "fromId" => $user->getId()));
		else if (is_object($user) && get_class($user) == 'AffiliateUser')
			$params = array_merge_recursive($params, array("fromType" => "affiliateUser", "fromId" => $user->getId()));
		else if (is_object($user) && get_class($user) == 'ClientUser')
			$params = array_merge_recursive($params, array("fromType" => "clientUser", "fromId" => $user->getId()));
		else
			return false;
		
		return true;
	}
}
