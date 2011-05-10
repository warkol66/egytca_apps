<?php
/**
 * BannersClientsDoEditAction
 *
 * Guarda los cambios a un cliente existente cliente del módulo de Banners, o crea uno nuevo
 * @package banners
 */

/**
 * Requires de Clases base del modelo y del módulo banners
 */
require_once("BaseAction.php");
require_once("BannerClientPeer.php");

/**
 * Class BannersClientsDoEditAction
 *
 * Guarda los cambios a un cliente existente cliente del módulo de Banners, o crea uno nuevo
 * @package banners
 */
class BannersClientsDoEditAction extends BaseAction {

	function BannersClientsDoEditAction() {
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

		if (empty($_POST['clientId']))
			$ok = $client = BannerClientPeer::create($_POST['name'], $_POST['contactName'], $_POST['phone'], $_POST['eMail'], $_POST['webSiteUrl'], $_POST['comments']);
		else 
			$ok = $client = BannerClientPeer::update($_POST['clientId'], $_POST['name'], $_POST['contactName'], $_POST['phone'], $_POST['eMail'], $_POST['webSiteUrl'], $_POST['comments']);

		$fwdName = $ok ? 'success' : 'failure';
		return $mapping->findForwardConfig($fwdName);
	}

}
