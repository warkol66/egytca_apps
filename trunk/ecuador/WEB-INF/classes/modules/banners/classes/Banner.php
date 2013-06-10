<?php

/**
 * Skeleton subclass for representing a row from the 'banners_banner' table.
 *
 * Tabla de banners
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    banners
 */
class Banner extends BaseBanner {

	//Frecuencia de reseteo de impresiones
	const FREQUENCY_ONCE = 0;
	const FREQUENCY_DAILY = 1;
	const FREQUENCY_WEEKLY = 2;
	const FREQUENCY_TWICE_A_MONTH = 3;
	const FREQUENCY_PERMANENT = 4;
	const FREQUENCY_MONTHLY = 5;
	const FREQUENCY_QUARTERLY = 6;
	const FREQUENCY_TWICE_A_YEAR = 7;
	const FREQUENCY_YEARLY = 8;

	//Tipo de apertura del link
	const TARGET_SAME_WINDOW = 0;
	const TARGET_NEW_WINDOW = 1;

	//nombre de los tipos de frecuencia
	private $frecuencies = array(
		Banner::FREQUENCY_ONCE => 'Única vez',
		Banner::FREQUENCY_DAILY => 'Diaria',
		Banner::FREQUENCY_WEEKLY => 'Semanal',
		Banner::FREQUENCY_TWICE_A_MONTH => 'Quincenal',
		Banner::FREQUENCY_PERMANENT => 'Permanente',
		Banner::FREQUENCY_MONTHLY => 'Mensual',
		Banner::FREQUENCY_QUARTERLY => 'Trimestral',
		Banner::FREQUENCY_TWICE_A_YEAR => 'Semestral',
		Banner::FREQUENCY_YEARLY => 'Anual'
	);

 /**
	* Obtiene los tipos de frecuencia válidos
	*
	* @return arry Frecuencias
	*/
	public function getFrecuencies()
	{
		return $this->frecuencies;
	}

 /**
	* Obtiene los tipos de target válidos (misma ventana / ventana nueva)
	*
	* @return arry Targets
	*/
	function getLinkTargets()
	{
		return array(0 => "Misma Ventana", 1 => "Ventana Nueva");
	}

 /**
	* Informa si el target del link es en ventana nueva
	*
	* @return boolean true si abre en ventana nueva false si no.
	*/
	function openItInNewWindow()
	{
		return $this->getLinktarget() == 1 ? true : false ;
	}

 /**
	* Obtiene los tipos de condición válidos (activo / inactivo)
	*
	* @return arry Condiciones
	*/
	function getConditions()
	{
		return array(true => "Activo");
	}

 /**
	* Agrega una zona a un banner
	*
	* @param int $zoneId Id de la zona a agregar
	* @return boolean true si pudo agregar la zona sino false
	*/
	function addToZone($zoneId, $bannerId = null)
	{
		try {
			if ($bannerId == null)
					$bannerId = self::getId();
			$bannerZone = new BannerZoneRelation();
			$bannerZone->setBannerId(self::getId());
			$bannerZone->setZoneId($zoneId);
			$bannerZone->save();
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

 /**
	* Quita el banner de una zona
	*
	* @param int $zoneId Id de la zona
	* @return boolean true si pudo quitar la zona, sino false
	*/
	function removeFromZone($zoneId, $bannerId = null)
	{
		try {
			if ($bannerId == null)
					$bannerId = self::getId();
			$criteria = new Criteria();
			$criteria->add(BannerZoneRelationPeer::BANNERID, $bannerId);
			$criteria->add(BannerZoneRelationPeer::ZONEID, $zoneId);
			BannerZoneRelationPeer::doDelete($criteria);
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

 /**
	* Quita el banner de todas la zonas
	*
	* @return boolean true si pudo quitar la zona, sino false
	*/
	function removeFromAllZones($bannerId = null)
	{
		try {
			if ($bannerId == null)
					$bannerId = self::getId();
			$criteria = new Criteria();
			$criteria->add(BannerZoneRelationPeer::BANNERID, $bannerId);
			BannerZoneRelationPeer::doDelete($criteria);
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

 /**
	* Decrementa en uno el contador de impresiones restantes
	*
	* @return bollean true
	*/
	function decresePrintsLeft()
	{
		if ( $this->getFrequency()<>4 and $this->getPrintsleft()>0 ) {
			$left = $this->getPrintsLeft();
			$left--;
			$this->setPrintsLeft($left);
		}
	}

	public function isImage()
	{
		$is = preg_match("/(jpg|jpeg|png|gif)/i", $this->getExtension());
		return $is;
	}

	public function isFlash()
	{
		$is = preg_match("/swf/i", $this->getExtension());
		return $is;
	}

	public function isHtml()
	{
		$is = preg_match("/(html|htm)/i", $this->getContentType());
		return $is;
	}
	
	public function getLogData(){
		return substr($this->getName(),0,50);
	}

} // Banner
