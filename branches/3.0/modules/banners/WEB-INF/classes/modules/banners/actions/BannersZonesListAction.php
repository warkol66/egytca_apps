<?php
/**
 * BannersZonesListAction
 *
 * Muestra el listado de Zonas de Banners disponibles en el sistema
 * @package banners
 */
class BannersZonesListAction extends BaseAction {

	function BannersZonesListAction() {
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

		$zones = BannerZonePeer::getAll();
		$smarty->assign("zones", $zones);
		$smarty->assign("message", $_GET['message']);

		return $mapping->findForwardConfig('success');
	}

}
