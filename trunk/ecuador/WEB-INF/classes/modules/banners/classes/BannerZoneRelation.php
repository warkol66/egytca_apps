<?php


/**
 * Skeleton subclass for representing a row from the 'banners_bannerZone' table.
 *
 * Tabla de cross reference que indica los banners por zona
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.banners.classes
 */
class BannerZoneRelation extends BaseBannerZoneRelation {
	
	/**
	* Actualiza los pesos de los banner de una zona
	*
	* @param int $id ID de la zona
	* @param array $banners Información de los pesos por banner
	* @return boolean true si pudo actualizar sino false
	*/
	function updateRel($zoneId, $banners)
	{
		try {
			foreach($banners as $banner){
				//$bannerZone = BannerZoneRelationPeer::retrieveByPK($banner['id'], $zoneId);
				$bannerZone = BannerZoneRelationQuery::create()->filterByBannerid($banner['id'])->filterByZoneid($zoneId);
				if ($banner['weight'] != '')
					$bannerZone->setWeight($banner['weight']);
				if ($banner['order'] != '')
					$bannerZone->setOrder($banner['order']);

				$bannerZone->save();
			}
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}
	
	/**
	* Actualiza los pesos de los banner de una zona
	*
	* @param int $id ID de la zona
	* @param array $banners Información de los pesos por banner
	* @return boolean true si pudo actualizar sino false
	*/
	function updateOrder($zoneId, $bannerId, $order)
	{
		try {
			$bannerZone = BannerZoneRelationQuery::filterByBanneridAndZoneid($bannerId, $zoneId);
			$bannerZone->setOrder($order);
			$bannerZone->save();
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

} // BannerZoneRelation
