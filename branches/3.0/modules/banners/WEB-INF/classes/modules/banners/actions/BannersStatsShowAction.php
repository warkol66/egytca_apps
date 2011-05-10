<?php
/**
 * BannersStatsShowAction
 *
 * Muestra las estadísticas de los banners
 * @package banners
 */
class BannersStatsShowAction extends BaseAction {

	function BannersStatsShowAction() {
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
		$section = "Stats";
		$smarty->assign("section",$section);

		$zones = BannerZonePeer::getAll();
		$smarty->assign("zones", $zones);
		$banners = BannerPeer::getAll();
		$smarty->assign("banners", $banners);
		$clients = BannerClientPeer::getAll();
		$smarty->assign("clients", $clients);


		//Llamada con parámetros
		if (isset($_GET['zoneId'])) {
			$zoneId = $_GET['zoneId'];
			$banners = BannerPeer::getAllByZone($zoneId);
			$smarty->assign("banners", $banners);
		}
		if (isset($_GET['bannerId']))		
			$bannerId = $_GET['bannerId'];

		if (isset($_GET['clientId'])) {
			$clientId = $_GET['clientId'];
			$banners = BannerPeer::getAllByClient($clientId);
			$smarty->assign("banners", $banners);
		}

		$stats = BannerPeer::getStats($clientId, $zoneId);

		
		$smarty->assign("zoneId", $zoneId);
		$smarty->assign("bannerId", $bannerId);
		$smarty->assign("clientId", $clientId);


		$stats = BannerPeer::getStats($clientId, $zoneId);
		$smarty->assign("stats", $stats);

		return $mapping->findForwardConfig('success');
	}

}
