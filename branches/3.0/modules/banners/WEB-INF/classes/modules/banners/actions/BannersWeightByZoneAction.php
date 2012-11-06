<?php
/**
 * BannersWeightByZoneAction
 *
 * Muestra un formulario para guardar el orden de los banners en la zona
 * @package banners
 */
class BannersWeightByZoneAction extends BaseAction {

	function BannersWeightByZoneAction() {
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

		if ( isset($_GET['zoneId']) ) {
			$zone = BannerZonePeer::get($_GET['zoneId']);
			$smarty->assign("zone", $zone);
			$smarty->assign("zoneId", $_GET['zoneId']);

			//$bannersObj = new BannerPeer();
			$banners = BannerPeer::getAllByZoneHydrated($_GET['zoneId'],"weight");
			$smarty->assign("banners", $banners);
			return $mapping->findForwardConfig('success');
		}
		else
			return $mapping->findForwardConfig('failure');
	}

}