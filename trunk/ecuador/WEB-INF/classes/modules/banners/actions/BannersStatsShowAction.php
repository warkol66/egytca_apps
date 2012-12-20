<?php
/**
 * BannersStatsShowAction
 *
 * Muestra las estadísticas de los banners
 * @package banners
 */
class BannersStatsShowAction extends BaseListAction {
	
	function __construct() {
		parent::__construct('Banner');
	}
	
	protected function postList(){
		parent::postList();
		
		$this->smarty->assign("module","Banners");
		$this->smarty->assign("section","Stats");
		
		$this->smarty->assign("zones", BannerZoneQuery::create()->find());
		$this->smarty->assign("banners", BannerQuery::create()->find());
		$this->smarty->assign("clients", BannerClientQuery::create()->find());
		
	}

	/*function BannersStatsShowAction() {
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

		$smarty->assign("zones", BannerZoneQuery::create()->find());
		$smarty->assign("banners", BannerQuery::create()->find());
		$smarty->assign("clients", BannerClientQuery::create()->find());


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
	}*/

}
