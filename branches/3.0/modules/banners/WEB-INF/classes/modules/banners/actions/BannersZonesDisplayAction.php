<?php
/**
 * BannersZonesDisplayAction
 *
 * Muestra una zona del m�dulo de banners con sus banners correspondientes
 * @package banners
 */
class BannersZonesDisplayAction extends BaseAction {

	function BannersZonesDisplayAction() {
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

	}

}