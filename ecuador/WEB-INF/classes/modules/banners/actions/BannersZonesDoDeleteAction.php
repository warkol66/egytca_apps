<?php
/**
 * BannersZonesDoDeleteAction
 *
 * Elimina una zona del módulo de Banners
 * @package banners
 */
class BannersZonesDoDeleteAction  extends BaseAction {

	function BannersZonesDoDeleteAction() {
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
		$section = "Zones";
		$smarty->assign("section",$section);

		$result = BannerZonePeer::delete($_GET['zoneId']);

		if ($result)
			return $mapping->findForwardConfig('success');
		else
			return $mapping->findForwardConfig('failure');
	}

}
