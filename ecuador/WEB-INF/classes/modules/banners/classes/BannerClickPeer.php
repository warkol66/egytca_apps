<?php

/**
 * Skeleton subclass for performing query and update operations on the 'banners_click' table.
 *
 * Donde se registran los clic a los banners
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    banners.classes
 */
class BannerClickPeer extends BaseBannerClickPeer {

 /**
	* Registra un ClickThru.
	*
	* @param Banner $banner Banner sobre el que se hizo click
	* @param int $zoneId Id de la zona donde fue clicado el banner
	* @param string $url Url de destino del linck clicado
	* @return boolean true si se registro el clic, false si no
	*/
	function create($banner, $zoneId)
	{
		try {
			$click = new BannerClick();
			$click->setBanner($banner);
			$click->setTime(time());
			$click->setZoneid($zoneId);
			$click->setUrl($banner->getTargetUrl());
			$click->save();
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

} // BannerClickPeer
