<?php
/**
 * BannersClientsEditAction
 *
 * Muestra el formulario de edición de clientes de banners
 * @package banners
 */

/**
 * Requires de Clases base del modelo y del módulo banners
 */
require_once("BaseAction.php");
require_once("BannerClientPeer.php");
require_once("BannerClient.php");

/**
 * Class BannersClientsEditAction
 *
 * Muestra el formulario de edición de clientes de banners
 * @package banners
 */
class BannersClientsEditAction extends BaseAction {

	function BannersClientsEditAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL)
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";

		$module = "Banners";
		$smarty->assign("module",$module);
		$section = "Clients";
		$smarty->assign("section",$section);

		if (isset($_GET['clientId'])) {
			try {
				$client = BannerClientPeer::get($_GET['clientId']);
				$smarty->assign("client", $client);
				$smarty->assign("accion","edicion");
				$ok = true;
			}
			catch (PropelException $e) {
				$ok = false;
			}
		}
		else {
			try {
				$client = new BannerClient;
				$smarty->assign("client", $client);
				$ok = true;
			}
			catch (PropelException $e) {
				$ok = false;
			}
		}

		$fwdName = $ok ? 'success' : 'failure';
		return $mapping->findForwardConfig($fwdName);
	}

}
