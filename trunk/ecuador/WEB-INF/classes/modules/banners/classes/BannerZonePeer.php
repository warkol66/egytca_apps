<?php

/**
 * Skeleton subclass for performing query and update operations on the 'banners_zone' table.
 *
 * Zonas donde se muestran los banners
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    banners
 */
class BannerZonePeer extends BaseBannerZonePeer {

 /**
	* Obtiene todos las zonas.
	*
	*    @return array Informacion sobre todos las zonas
	*/
	function getAll()
	{
		$criteria = new Criteria();
		$criteria->addAscendingOrderByColumn(BannerZonePeer::ID);
		$allObj = BannerZonePeer::doSelect($criteria);
		return $allObj;
	}

 /**
	* Obtiene la informacion de una zona.
	*
	* @param int $id Id de la zona
	* @return array Informacion de la zona
	*/
	function get($id)
	{
		$object = BannerZonePeer::retrieveByPK($id);
		return $object;
	}

 /**
	* Crea una zona nueva.
	*
	* @param array $params Array asociativo con los atributos del objeto
	* @return boolean true si pudo crear la zona sino false
	*/
	function create($params)
	{
		try {
			$zoneObj = new BannerZone();
			foreach ($params as $key => $value) {
				$setMethod = "set".ucfirst($key);
				if ( method_exists($zoneObj,$setMethod) ) {
					if (!empty($value) || $value == "0")
						$zoneObj->$setMethod($value);
					else
						$zoneObj->$setMethod(null);
				}
			}
			$zoneObj->save();
			return true;
		}
		catch (Exception $exp) {
			return false;
		}
	}

 /**
	* Actualiza una zona.
	*
	* @param array $params Array asociativo con los atributos del objeto
	* @return boolean true si se actualizo la informacion correctamente, false sino
	*/
	function update($params) {
		try {
			$zoneObj = BannerZonePeer::retrieveByPK($params["zoneId"]);
			if (empty($zoneObj))
				throw new Exception();
			foreach ($params as $key => $value) {
				$setMethod = "set".ucfirst($key);
				if ( method_exists($zoneObj,$setMethod) ) {
					if (!empty($value) || $value == "0")
						$zoneObj->$setMethod($value);
					else
						$zoneObj->$setMethod(null);
				}
			}
			$zoneObj->save();
			return true;
		}
		catch (Exception $exp) {
			return false;
		}
	}

 /**
	* Elimina una zona.
	*
	* @param int $id ID de la zona
	* @return boolean true si pudo actualizar la zona sino false
	*/
	function delete($id) {

		try {
			$c = new Criteria();
			$c->add(BannerZoneRelationPeer::ZONEID, $id);
			BannerZoneRelationPeer::doDelete($c);
			return BannerZonePeer::doDelete($id);
		}
		catch (PropelException $e) {
			return false;
		}
	}

} // ZonePeer
