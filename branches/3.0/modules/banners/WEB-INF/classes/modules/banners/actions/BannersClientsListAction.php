<?php
/** 
 * BannersClientsListAction
 *
 * Muestra el listado de clientes de Banners
 * @package banners 
 */

/**
 * Requires de Clases base del modelo y del módulo banners
 */
require_once("BaseAction.php");
require_once("BannerClientPeer.php");

/** 
 * Class BannersClientsListAction
 *
 * Muestra el listado de clientes de Banners
 * @package banners 
 */
class BannersClientsListAction extends BaseAction {

	function BannersClientsListAction() {
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

		$clients = BannerClientPeer::getAll();
		$smarty->assign("clients", $clients);
		$smarty->assign("message", $_GET['message']);

		return $mapping->findForwardConfig('success');
	}

}
