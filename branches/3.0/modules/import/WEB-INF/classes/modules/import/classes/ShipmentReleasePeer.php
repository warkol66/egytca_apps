<?php



/**
 * Skeleton subclass for performing query and update operations on the 'import_shipmentRelease' table.
 *
 * Datos de nacionalizacion
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.import.classes
 */
class ShipmentReleasePeer extends BaseShipmentReleasePeer {

  	private $searchSupplierId = '';
  	private $searchStatus = '';
	
	private $statusNames = array(
								ShipmentRelease::STATUS_PENDING => 'Pending',
								ShipmentRelease::STATUS_COMPLETE => 'Complete',
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
   * Elimina un shipmentRelease a partir de los valores de la clave.
   *
   * @param int $id id del shipment
   * @return boolean true si se elimino correctamente el shipmentRelease, false sino
   */
  function delete($id) {
  	$shipmentReleaseObj = ShipmentReleasePeer::retrieveByPK($id);
    $shipmentReleaseObj->delete();
		return true;
  }
  
  /**
  * Obtiene la informacion de un shipmentRelease.
  *
  * @param int $id id del shipment
  * @return array Informacion del shipmentRelease
  */
  function get($id) {
		$shipmentReleaseObj = ShipmentReleasePeer::retrieveByPK($id);
    return $shipmentReleaseObj;
  }

  /**
  * Obtiene todos los shipmentReleases.
	*
	*	@return array Informacion sobre todos los shipmentReleases
  */
	function getAll() {
		$cond = new Criteria();
		$alls = ShipmentReleasePeer::doSelect($cond);
		return $alls;
  }

  /**
  * Obtiene todos los shipmentReleases paginados.
  *
  * @param int $page [optional] Numero de pagina actual
  * @param int $perPage [optional] Cantidad de filas por pagina
  *	@return array Informacion sobre todos los shipmentReleases
  */
  function getAllPaginated($page=1,$perPage=-1) {  
    if ($perPage == -1)
      $perPage = 	ShipmentReleasePeer::getRowsPerPage();
    if (empty($page))
      $page = 1;
    $cond = new Criteria();     
    $pager = new PropelPager($cond,"ShipmentReleasePeer", "doSelect",$page,$perPage);
    return $pager;
   }    	

  /**
   * Genera una criteria segun la informacion introducida para filtros
   * @return Criteria instancia de criteria
   */
  private function getFilterCriteria() {
	$criteria = new ShipmentReleaseQuery();

	if (!empty($this->searchSupplierId)) {
		$criteria->filterBySupplierId($this->searchSupplierId);
	}
	
	if (!empty($this->searchStatus)) {
		$criteria->filterByStatus($this->searchStatus);
	}

	return $criteria;
  }

  /**
  * Obtiene todos los shipmentReleases paginados aplicando los filtros.
  *
  * @param int $page [optional] Numero de pagina actual
  * @param int $perPage [optional] Cantidad de filas por pagina
  *	@return array Informacion sobre todos los shipmentReleases
  */
  public function getAllPaginatedFiltered($page=1,$perPage=-1) {  
    if ($perPage == -1)
      $perPage = 	ShipmentReleasePeer::getRowsPerPage();
    if (empty($page))
      $page = 1;
    $cond = $this->getFilterCriteria();   
    $pager = new PropelPager($cond,"ShipmentReleasePeer", "doSelect",$page,$perPage);
    return $pager;
  }
	
} // ShipmentReleasePeer
