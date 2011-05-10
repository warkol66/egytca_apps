<?php

/**
 * Skeleton subclass for representing a row from the 'lausi_address' table.
 *
 * Base de Direcciones
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lausi
 */
class Address extends BaseAddress {

	public function save(PropelPDO $con = null) {
		try {
			if ($this->validate()) { 
				parent::save($con);
				return true;
			} else {
				return false;
			}
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}
		
	function __toString() {
		$nickname = $this->getNickname();
		if (!empty($nickname)) {
			return $nickname;
		}
								
		if ($this->getNumber() != 0)
           	return $this->getStreet()." ".$this->getNumber();
		else
           	return $this->getStreet()." y ".$this->getIntersection();
	}
	
	/**
	 * Deprecated, usar __toString()
	 */
	function getName() {
		return $this->__toString();
	}

	/**
	 * Devuelve el pr�ximo n�mero de cartelera en la direcci�n
	 *
	 * @return integer pr�ximo n�mero de cartelera en la direcci�n
	 */
    function getNextBillboardNumber() {
		$billboard = BillboardQuery::create()
			->filterByAddress($this)
			->orderByNumber()
			->findOne();
			
		if (empty($billboard))
			return 1;
		return $billboard->getNumber()+1;
    }
        
	/**
	 * Devuelve la cantidad de carteleras por tipo en cada direcci�n
     * @param integer $type tipe de cartelera
	 * @return integer cantidad de carteleras por tipo
	 */
    function getBillboardCountByType($type) {
		$billboardsCount = BillboardQuery::create()
			->filterByAddress($this)
			->filterByType($type)
			->count();
    	return $billboardsCount;
    }
		
	function getBillboardCount() {
		return $this->countBillboards();
	}		

	public function getToBePublished($date,$themeId) {
		$adverts = AdvertisementQuery::create()
			->filterToBePublished($date, $themeId)
			->filterByAddress($this)
			->find();
			
		return $adverts;
	}
		
	public function getToBePublishedCount($date,$themeId) {
		$theme = ThemePeer::get($themeId);
		$duplicator = 1;
		
		if ($theme->getType() == ThemePeer::TYPE_DOBLE)
			$duplicator = 2;
		
		$count = AdvertisementQuery::create()
			->filterToBePublished($date, $themeId)
			->filterByAddress($this)
			->count();
			
		return $count * $duplicator;
	}
	
	public function getPreviousThemes($date,$themeId) {
		$lastThemes = array();
		
		$toBePublished = $this->getToBePublished($date,$themeId);
		
		foreach ($toBePublished as $advertisement) {
			$billboard = $advertisement->getBillboard();
			$lastTheme = $billboard->getPreviousTheme($date);
			if (($lastTheme != false) && !isset($lastThemes[$lastTheme->getId()])) {
				$lastThemes[$lastTheme->getId()]['theme'] = $lastTheme;
				$lastThemes[$lastTheme->getId()]['counter'] = 1;
			} else {
				if (($lastTheme != false) && isset($lastThemes[$lastTheme->getId()]))
					$lastThemes[$lastTheme->getId()]['counter']++;
			}
		}
			
		return $lastThemes;
	}

	public function getPreviousThemesText($date,$themeId) {
		$text = '';
		$lastThemes = $this->getPreviousThemes($date,$themeId);
		foreach ($lastThemes as $theme) {
			$text .= $theme->getName();
		}
		return $text;
	}
	
	function createBillboards($totalBillboardsDobles,$totalBillboardsSextuples) {
		$quantity = 0;
		
		$params = array(
			'number'=>$this->getNextBillboardNumber(), 
			'type'=>BillboardPeer::TYPE_DOBLE, 
			'height'=>0, 
			'row'=>1, 
			'column'=>0, 
			'addressId'=>$this->getId()
		);
		
		while ($quantity < $totalBillboardsDobles) {
			$params['column']++;
			$address = new Address;
			Common::setObjectFromParams($address, $params);	
			$address->save();
			$quantity++;
			$params['number']++;
		} 	

		$quantity = 0;
		$params['column'] = 0;
		$params['type'] = BillboardPeer::TYPE_SEXTUPLE;

		while ($quantity < $totalBillboardsSextuples) {
			$params['column']++;
			$address = new Address;
			Common::setObjectFromParams($address, $params);	
			$address->save();
			$quantity++;
			$params['number']++;
		} 	        
	}   
		
	/**
	 * Devuelve la cantidad de afiches distribuidos de un cierto motivo en esta direccion.
	 *
	 * @return integer cantidad de afiches
	 */
	public function getSheetsDistributed($themeId) {
		//duplicador
		$duplicator = 1;
		$theme = ThemePeer::get($themeId);
		$type = $theme->getType();
		//regla de negocio, las motivos dobles tienen dos afiches, los sextuples 1.
		if ($type == ThemePeer::TYPE_DOBLE)
			$duplicator = 2;
		$count = AdvertisementPeer::getAllByThemeCount($this->getId());
		
		return $count * $duplicator;
	}
		
	/**
	 * Obtiene los themes actuales que hay en esa direccion
	 * @return array de instancias de Theme
	 */
	public function getCurrentThemes()	{
		return ThemeQuery::create()
			->filterByAddress($this)
			->filterByCurrent()
			->find();	
	}
		
	public function getAvailableBillboards($fromDate, $duration) {
		return BillboardQuery::create()
			->filterByAvailable($fromDate, $duration)
			->filterByAddress($this)
			->find();
	}
		
	public function getDistanceTo($otherAddress) {
		//cada grado de longitud equivale a 110900 metros
		//cada grado de latitud equivale a 90000
		return sqrt(pow(($this->getLatitude() - $otherAddress->getLatitude()) * 90000,2)+ pow(($this->getLongitude() - $otherAddress->getLongitude()) * 110900,2));
	}
} // Address
