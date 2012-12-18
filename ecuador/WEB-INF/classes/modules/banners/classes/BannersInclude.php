<?php
/**
 * BannersInclude
 *
 * @package banners
 */

require_once("Banner.php");

class BannersInclude extends Banner {

	function getZonesDisplay($options) {
		require_once("BannerPeer.php");
		require_once("BannerZonePeer.php");

		$zoneId = $options["id"];
		$zone = BannerZonePeer::get($zoneId);
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