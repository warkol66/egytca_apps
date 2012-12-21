<?php
/**
 * BannersZonesDisplayAction
 *
 * Muestra una zona del módulo de banners con sus banners correspondientes
 * @package banners
 */
class BannersZonesDisplayAction extends BaseAction {
	
	function __construct() {
		parent::__construct('BannerZone');
	}
	
	protected function postEdit(){
		parent::postEdit();
		
		$this->smarty->assign("module","Banners");
		$this->smarty->assign("section","Zones");
		
		$moduleConfig = Common::getModuleConfiguration($module);

		if ($moduleConfig["saveClicks"]["value"] == "YES")
			$this->smarty->assign("saveClicks",$saveClicks);
			
		if (is_object($this->entity)) {
			$this->entity->setMode($_GET['mode']); //save?
			$arrengedBanners = $this->entity->getBannersInRowsAndCols();

			$this->smarty->assign("banners", $arrengedBanners);
			$this->smarty->assign("zoneId", $_GET['id']); //zoneId
			$this->smarty->assign("mode", $_GET['mode']);
			$this->smarty->assign("request_uri", $_SERVER['REQUEST_URI']);
		}
		
	}

	/*function BannersZonesDisplayAction() {
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

		$this->template->template = "TemplatePlain.tpl";

		$module = "Banners";
		$section = "Zones";
		$smarty->assign("module",$module);
		$smarty->assign("section",$section);

		$moduleConfig = Common::getModuleConfiguration($module);

		if ($moduleConfig["saveClicks"]["value"] == "YES")
			$smarty->assign("saveClicks",$saveClicks);

		$zoneId = $_GET['zoneId'];
		$zone = BannerZonePeer::get($zoneId);
		if (!empty($zone)) {
			$zone->setMode($_GET['mode']);
			$arrengedBanners = $zone->getBannersInRowsAndCols();

			$smarty->assign("banners", $arrengedBanners);
			$smarty->assign("zoneId", $zoneId);
			$smarty->assign("mode", $_GET['mode']);
			$smarty->assign("request_uri", $_SERVER['REQUEST_URI']);
			return $mapping->findForwardConfig('success');

		}
		else
			return $mapping->findForwardConfig('failure');

	}*/

}
