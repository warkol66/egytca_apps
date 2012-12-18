<?php
/**
 * BannersDoDeleteAction
 *
 * Elimina un banner
 * @package banners
 */

/**
 * Requires de Clases base del modelo y del módulo banners
 */
require_once("BaseAction.php");
require_once("BannerPeer.php");

/**
 * Class BannersDoDeleteAction
 *
 * Elimina un banner
 * @package banners
 */
class BannersDoDeleteAction  extends BaseAction {

	function BannersDoDeleteAction() {
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

		$ok = BannerPeer::delete($_GET['bannerId']);

		$fwdName = $ok ? 'success' : 'failure';
		return $mapping->findForwardConfig($fwdName);
	}

}
