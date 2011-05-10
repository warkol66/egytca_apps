<?php



/**
 * Skeleton subclass for representing a row from the 'import_shipment' table.
 *
 * Datos de envio
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.import.classes
 */
class Shipment extends BaseShipment {
	
	const STATUS_WAITING_FOR_TRANSPORT = 1;
	const STATUS_ON_ROUTE = 2;
	const STATUS_ARRIVED = 3;
	
	//nombre de los estados para los clientes
	private $statusNames = array(
		Shipment::STATUS_WAITING_FOR_TRANSPORT => 'Waiting for Transport',
		Shipment::STATUS_ON_ROUTE => 'On Route',
		Shipment::STATUS_ARRIVED => 'Arrived'
	);
	
    /**
     * Code to be run before persisting the object
     * @param PropelPDO $con 
     * @return bloolean 
     */
    public function preSave(PropelPDO $con = null) {
    	$ret = parent::preSave($con);
    	if ($ret) {
    		//Mantenemos la concistencia del status (campo calculable).
    		$this->setStatus($this->calculateStatus());
    	}
        return $ret;
    }
    
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
	
	public function isArrived() {
		$arrivalTimestamp = $this->getArrivalDate('U');
		$currentTimestamp = time();
		if (!empty($arrivalTimestamp))
			return $arrivalTimestamp <= $currentTimestamp;
		return false;		
	}
	
	public function isOnRoute() {
		$shipmentTimestamp = $this->getShipmentDate('U');
		$currentTimestamp = time();
		if (!empty($shipmentTimestamp))
			return $shipmentTimestamp <= $currentTimestamp;
		return false;
	}
	
	/**
	 * Calcula el estado actual en base a los campos correspondientes.
	 * Usar esta función en lugar de getStatus() siempre que se tenga
	 * un objeto modificado que aún no fue guardado para garantizar la
	 * consistencia de la información.
	 */
	public function calculateStatus() {
		if ($this->isArrived())
			return Shipment::STATUS_ARRIVED;
			
		if ($this->isOnRoute())
			return Shipment::STATUS_ON_ROUTE;
			
		return Shipment::STATUS_WAITING_FOR_TRANSPORT;
	}
	
	public function getStatusName() {		
		return $this->statusNames[$this->calculateStatus()];
	}
	
	/**
	 * Obtiene la información del cliente
	 * @return AffiliateInfo
	 */
	public function getClientInfo() {
		return AffiliateInfoQuery::create()->join('Affiliate')
										   ->join('Affiliate.ClientQuote')
										   ->join('ClientQuote.SupplierPurchaseOrder')
										   ->join('SupplierPurchaseOrder.Shipment')
										   ->useQuery('Shipment')
												->filterById($this->getId())
										   ->endUse()
										   ->findOne();
	}
	
	public function hasShipmentRelease() {
		return $this->countShipmentReleases() > 0;
	}
} // Shipment
