<?php



/**
 * Skeleton subclass for representing a row from the 'import_shipmentRelease' table.
 *
 * Datos de nacionalizacion
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.import.classes
 */
class ShipmentRelease extends BaseShipmentRelease {
	const STATUS_PENDING = 1;
	const STATUS_COMPLETE = 2;
	
	//nombre de los estados para los clientes
	private $statusNames = array(
		ShipmentRelease::STATUS_PENDING => 'Pending',
		ShipmentRelease::STATUS_COMPLETE => 'Complete',
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
	
	public function isComplete() {
		$arrivalToStorehouseTimestamp = $this->getArrivalToStorehouseTimestamp('U');
		$currentTimestamp = time();
		if (!empty($arrivalToStorehouseTimestamp))
			return $arrivalToStorehouseTimestamp <= $currentTimestamp;
		return false;
	}
	
	/**
	 * Calcula el estado actual en base a los campos correspondientes.
	 * Usar esta función en lugar de getStatus() siempre que se tenga
	 * un objeto modificado que aún no fue guardado para garantizar la
	 * consistencia de la información.
	 */
	public function calculateStatus() {
		if ($this->isComplete())
			return ShipmentRelease::STATUS_COMPLETE;
		
		return ShipmentRelease::STATUS_PENDING;
	}
		
	public function getStatusName() {		
		return $this->statusNames[$this->calculateStatus()];
	}
	
	/**
	 * Obtiene la información del cliente
	 * @return AffiliateInfo
	 */
	public function getClientInfo() {
		return $this->getShipment()->getClientInfo();
	}
} // ShipmentRelease
