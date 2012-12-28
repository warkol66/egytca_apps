<?php
/**
 * BannersInclude
 *
 * @package banners
 */

require_once("Banner.php");

class BannersInclude extends Banner {

	function getZonesDisplay($options) {
		require_once("Banner.php");
		require_once("BannerZone.php");

		$zoneId = $options["id"];
		$zone = BannerZoneQuery::create()->findOneById($zoneId);
		if (!empty($zone))
			$arrengedBanners = $zone->getBannersInRowsAndCols();
		else
			$arrengedBanners = array();

		$module = "Banners";
		$moduleConfig = Common::getModuleConfiguration($module);

		if ($moduleConfig["saveClicks"]["value"] == "YES")
			return array("banners" => $arrengedBanners, "zone" => $zone, "saveClicks" => 1);
		else
			return array("banners" => $arrengedBanners, "zone" => $zone);

	}

} // end of class
