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
		
		$zoneId = $_GET['filters']['zoneId'];
		$bannerId = $_GET['filters']['id'];
		$clientId = $_GET['filters']['clientId'];
		$stats = BannerPeer::getStats($clientId, $zoneId); //migrar de peer
		$this->smarty->assign("stats", $stats);
		
		//filtra solo por cliente y zona, pero no por bannerId (para stats se necesitan cliente y zona)
		
	}

}
