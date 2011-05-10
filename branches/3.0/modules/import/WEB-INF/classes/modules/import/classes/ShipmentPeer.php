<?php



/**
 * Skeleton subclass for performing query and update operations on the 'import_shipment' table.
 *
 * Datos de envio
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.import.classes
 */
class ShipmentPeer extends BaseShipmentPeer {
	
  	private $searchSupplierId = '';
  	private $searchStatus = '';
	
	private $statusNames = array(
								Shipment::STATUS_WAITING_FOR_TRANSPORT => 'Waiting for Transport',
								Shipment::STATUS_ON_ROUTE => 'On Route',
								Shipment::STATUS_ARRIVED => 'Arrived'																											
							);
							
  /**
   * Fija un filtro por supplier
   * @param Integer $supplierId id de supplier
   */
  public function setSearchSupplierId($supplierId) {
	$this->searchSupplierId = $supplierId;
  }

  /**
   * Fija un filtro por estado
   * @param string estado.
   */
  public function setSearchStatus($status) {
	$this->searchStatus = $status;
  }	
  
  /**
   * Devuelve los nombres de los estados del cleinte
   */					
  public function getStatusNames() {
		return $this->statusNames;
  }
  
  /**
  * Obtiene la cantidad de filas por pagina por defecto en los listado paginados.
  *
  * @return int Cantidad de filas por pagina
  */
  function getRowsPerPage() {
    global $system;
    return $system["config"]["system"]["rowsPerPage"];
  }
  
  /**
   * Elimina un shipment a partir de los valores de la clave.
   *
   * @param int $id id del shipment
   * @return boolean true si se elimino correctamente el shipment, false sino
   */
  function delete($id) {
  	$shipmentObj = ShipmentPeer::retrieveByPK($id);
    $shipmentObj->delete();
		return true;
  }
  
  /**
  * Obtiene la informacion de un shipment.
  *
  * @param int $id id del shipment
  * @return array Informacion del shipment
  */
  function get($id) {
		$shipmentObj = ShipmentPeer::retrieveByPK($id);
    return $shipmentObj;
  }

  /**
  * Obtiene todos los shipments.
	*
	*	@return array Informacion sobre todos los shipments
  */
	function getAll() {
		$cond = new Criteria();
		$alls = ShipmentPeer::doSelect($cond);
		return $alls;
  }

  /**
  * Obtiene todos los shipments paginados.
  *
  * @param int $page [optional] Numero de pagina actual
  * @param int $perPage [optional] Cantidad de filas por pagina
  *	@return array Informacion sobre todos los shipments
  */
  function getAllPaginated($page=1,$perPage=-1) {  
    if ($perPage == -1)
      $perPage = 	ShipmentPeer::getRowsPerPage();
    if (empty($page))
      $page = 1;
    $cond = new Criteria();     
    $pager = new PropelPager($cond,"ShipmentPeer", "doSelect",$page,$perPage);
    return $pager;
   }    	

  /**
   * Genera una criteria segun la informacion introducida para filtros
   * @return Criteria instancia de criteria
   */
  private function getFilterCriteria() {
	$criteria = new ShipmentQuery();

	if (!empty($this->searchSupplierId)) {
		$criteria->filterBySupplierId($this->searchSupplierId);
	}
	
	if (!empty($this->searchStatus)) {
		$criteria->filterByStatus($this->searchStatus);
	}

	return $criteria;
  }

  /**
  * Obtiene todos los shipments paginados aplicando los filtros.
  *
  * @param int $page [optional] Numero de pagina actual
  * @param int $perPage [optional] Cantidad de filas por pagina
  *	@return array Informacion sobre todos los shipments
  */
  public function getAllPaginatedFiltered($page=1,$perPage=-1) {  
    if ($perPage == -1)
      $perPage = 	ShipmentPeer::getRowsPerPage();
    if (empty($page))
      $page = 1;
    $cond = $this->getFilterCriteria();   
    $pager = new PropelPager($cond,"ShipmentPeer", "doSelect",$page,$perPage);
    return $pager;
   }
} // ShipmentPeer
