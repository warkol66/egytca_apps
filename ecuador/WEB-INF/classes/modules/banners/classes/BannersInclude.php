<?php
/**
 * BannersInclude
 *
 * @package banners
 */

class BannersInclude extends Banner {

	function getZonesDisplay($options) {

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
