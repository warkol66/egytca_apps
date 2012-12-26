<?php
/**
 * BannersOrderByZoneAction
 *
 * Muestra un formulario para guardar los pesos relativos de los banners en la zona
 * @package banners
 */
class BannersOrderByZoneAction extends BaseAction {

	function BannersOrderByZoneAction() {
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
			$zone = BannerZoneQuery::create()->findOneById($_GET['zoneId']);
			$smarty->assign("zone", $zone);
			$smarty->assign("zoneId", $_GET['zoneId']);

			//$bannersObj = new BannerPeer();
			$banners = BannerQuery::getAllByZoneHydrated($_GET['zoneId'],"order");
			$smarty->assign("banners", $banners);
			return $mapping->findForwardConfig('success');
		}
		else
			return $mapping->findForwardConfig('failure');

	}

}
