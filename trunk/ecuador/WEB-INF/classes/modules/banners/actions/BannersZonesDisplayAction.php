<?php
/**
 * BannersZonesDisplayAction
 *
 * Muestra una zona del m�dulo de banners con sus banners correspondientes
 * @package banners
 */
class BannersZonesDisplayAction extends BaseSelectAction {
	
	function __construct() {
		parent::__construct('BannerZone');
	}
	
	protected function postSelect(){
		parent::postSelect();
		
		$this->smarty->assign("module","Banners");
		$this->smarty->assign("section","Zones");
		
		$moduleConfig = Common::getModuleConfiguration($module);

		if ($moduleConfig["saveClicks"]["value"] == "YES")
			$this->smarty->assign("saveClicks",$saveClicks);
			
		if (is_object($this->entity)) {
			$this->entity->setMode($_GET['mode']); //save?
			$arrangedBanners = $this->entity->getBannersInRowsAndCols();

			$this->smarty->assign("banners", $arrangedBanners);
			$this->smarty->assign("zoneId", $_GET['id']); //zoneId
			$this->smarty->assign("mode", $_GET['mode']);
			$this->smarty->assign("display", true);
			$this->smarty->assign("request_uri", $_SERVER['REQUEST_URI']);
		}
		
	}

}
