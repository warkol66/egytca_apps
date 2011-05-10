<?php
/**
 * BannersClientsDoDeleteAction
 *
 * Elimina un cliente del módulo de Banners
 * @package banners
 */

/**
 * Requires de Clases base del modelo y del módulo banners
 */
require_once("BaseAction.php");
require_once("BannerClientPeer.php");

/**
 * Class BannersClientsDoDeleteAction
 *
 * Elimina un cliente del módulo de Banners
 * @package banners
 */
class BannersClientsDoDeleteAction  extends BaseAction {

	function BannersClientsDoDeleteAction() {
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

		$ok = BannerClientPeer::delete($_GET['clientId']);

		$fwdName = $ok ? 'success' : 'failure';
		return $mapping->findForwardConfig($fwdName);
	}

}
