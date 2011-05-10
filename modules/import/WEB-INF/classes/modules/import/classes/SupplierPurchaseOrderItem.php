<?php

require_once 'import/classes/SupplierPurchaseOrderItemPeer.php';
require 'import/classes/om/BaseSupplierPurchaseOrderItem.php';


/**
 * Skeleton subclass for representing a row from the 'import_supplierPurchaseOrderItem' table.
 *
 * Elemento de Orden de Pedido a Proveedor
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    import.classes
 */
class SupplierPurchaseOrderItem extends BaseSupplierPurchaseOrderItem {

	private $containers;
	
	const PACKAGE_BY_UNIT = 1;
	const PACKAGE_BY_CARTON = 2;
	
	function __construct() {
		parent::__construct();
		global $system;
		$this->containers = $system["config"]["import"]["containers"];
	}
	
	/**
	 * Calcula el volumen en m3 segun la informacion ingresada en la cotizacion sobre la unidad
	 * @return float
	 */
	public function getUnitVolume() {
		return ($this->getUnitWidth() * $this->getUnitHeight() * $this->getUnitLength() / 1000000);
	}

	/**
	 * Calcula el volumen en m3 segun la informacion ingresada en la cotizacion sobre el bulto
	 * @return float
	 */	
	public function getCartonVolume() {
		return ($this->getCartonWidth() * $this->getCartonHeight() * $this->getCartonLength() / 1000000);		
	}
	
	/**
	 * Calcula la densidad segun la informacion ingresada en la cotizacion sobre la unidad
	 */
	function getUnitDensity() {
		
		if ($this->getUnitVolume() == 0)
			return 0;
		
		return ($this->getUnitGrossWeigth() / $this->getUnitVolume());
	}
	
	/**
	 * Calcula la densidad segun la informacion ingresada en la cotizacion sobre la unidad
	 */
	function getCartonDensity() {

		if ($this->getCartonVolume() == 0)
			return 0;
		
		return ($this->getCartonGrossWeigth() / $this->getCartonVolume());

	}
	
	/**
	 * Calcula el volumen segun la informacion ingresada en la cotizacion sobre el bulto
	 * @return float
	 */	
	public function getTotalVolume() {
		return ($this->getUnitVolume() * $this->getQuantity());		
	}

	/**
	 * Calcula el volumen segun la informacion ingresada en la cotizacion sobre el bulto
	 * @return float
	 */	
	public function getTotalWeigth() {
		return ($this->getUnitGrossWeigth() * $this->getQuantity());		
	}
	
	/**
	 * Devuelve la densidad unitaria si no es 0, en caso contrario devuelve
	 * la densidad por bulto.
	 */
	public function getDensity() {
		$density = $this->getUnitDensity();
		if ($density != 0)
			return $density;
		return $this->getCartonDensity();
	}
	
	/**
	 * Devuelve un array asociativo teniendo type, weightCap y volumeCap.
	 */
	public function getRecommendedContainer() {
		$density = $this->getDensity();
		if ($density > $this->containers['densityThreshold'])
			return $this->containers['container1'];
		return $this->containers['container2'];
	}
	
	public function getRecommendedContainersQuantityByWeight() {
		$container = $this->getRecommendedContainer();
		$weigthCap = $container['weightCap'];
		$totalWeigth = $this->getTotalWeigth();
		return $totalWeigth / $weigthCap;
	}
	
	public function getRecommendedContainersQuantityByVolume() {
		$container = $this->getRecommendedContainer();
		$volumeCap = $container['volumeCap'];
		$totalVolume = $this->getTotalVolume();
		return $totalVolume / $volumeCap;
	}
	
	public function getRecommendedContainersQuantity() {
		return max($this->getRecommendedContainersQuantityByWeight(), $this->getRecommendedContainersQuantityByVolume());
	}

} // SupplierPurchaseOrderItem
