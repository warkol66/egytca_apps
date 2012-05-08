<?php


// The object class
include_once 'tablero/classes/TableroMeasure.php';


/**
 * Skeleton subclass for performing query and update operations on the 'tablero_measure' table.
 *
 * Measure
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    tablero.classes
 */
class TableroMeasurePeer extends BaseTableroMeasurePeer {

	/** the default item name for this class */
	const ITEM_NAME = 'Measures';

	/**
	 * Especifica una cadena de busqueda.
	 * @param searchString cadena de busqueda.
	 */
	function setSearchString($searchString) {
		$this->searchString = $searchString;
	}

	//mapea las condiciones del filtro en el formulario al nombre del set de la condicion en el modelo
	var $filterConditions = array(
					"searchString"=>"setSearchString"
				);

  /**
  * Crea un measure nuevo.
  *
  * @param int $indicatorId indicatorId del measure
  * @param string $measureDate measureDate del measure
  * @param int $measureNumber measureNumber del measure
  * @param int $measureExpectedNumber measureExpectedNumber del measure
  * @param string $notes notes del measure
  * @return boolean true si se creo el measure correctamente, false sino
	*/
	function create($indicatorId,$measureDate,$measureNumber,$measureExpectedNumber,$notes) {
    $measureObj = new TableroMeasure();
    $measureObj->setindicatorId($indicatorId);
		$measureObj->setmeasureDate($measureDate);
		$measureObj->setmeasureNumber($measureNumber);
		$measureObj->setmeasureExpectedNumber($measureExpectedNumber);
		$measureObj->setnotes($notes);
		$measureObj->save();
		return true;
	}

  /**
  * Actualiza la informacion de un measure.
  *
  * @param int $id id del measure
  * @param int $indicatorId indicatorId del measure
  * @param string $measureDate measureDate del measure
  * @param int $measureNumber measureNumber del measure
  * @param int $measureExpectedNumber measureExpectedNumber del measure
  * @param string $notes notes del measure
  * @return boolean true si se actualizo la informacion correctamente, false sino
	*/
  function update($id,$indicatorId,$measureDate,$measureNumber,$measureExpectedNumber,$notes) {
  	$measureObj = TableroMeasurePeer::retrieveByPK($id);
    $measureObj->setindicatorId($indicatorId);
    $measureObj->setmeasureDate($measureDate);
    $measureObj->setmeasureNumber($measureNumber);
    $measureObj->setmeasureExpectedNumber($measureExpectedNumber);
    $measureObj->setnotes($notes);
    $measureObj->save();
		return true;
  }

	/**
	* Elimina un measure a partir de los valores de la clave.
	*
  * @param int $id id del measure
	*	@return boolean true si se elimino correctamente el measure, false sino
	*/
  function delete($id) {
  	$measureObj = TableroMeasurePeer::retrieveByPK($id);
    $measureObj->delete();
		return true;
  }

  /**
  * Obtiene la informacion de un measure.
  *
  * @param int $id id del measure
  * @return array Informacion del measure
  */
  function get($id) {
		$measureObj = TableroMeasurePeer::retrieveByPK($id);
    return $measureObj;
  }

  /**
  * Obtiene todos los measures.
	*
	*	@return array Informacion sobre todos los measures
  */
	function getAll() {
		$cond = new Criteria();
		$alls = TableroMeasurePeer::doSelect($cond);
		return $alls;
  }
  
  /**
  * Obtiene todos los measures paginados.
  *
  * @param int $page [optional] Numero de pagina actual
  * @param int $perPage [optional] Cantidad de filas por pagina
  *	@return array Informacion sobre todos los measures
  */
  function getAllPaginated($page=1,$perPage=-1,$affiliateId = null) {  
    if ($perPage == -1)
      $perPage = 	Common::getRowsPerPage();
    if (empty($page))
      $page = 1;
    require_once("propel/util/PropelPager.php");
    $cond = new Criteria();     

    if ($affiliateId != null) {    
    	require_once('TableroObjectivePeer.php');
    	require_once('TableroProjectPeer.php');
    	require_once('TableroIndicatorPeer.php');
    	//obtenemos solo aquellos que correposponden a las dependencias de un cierto afiliado
    	$cond->add(TableroObjectivePeer::AFFILIATEID,$affiliateId);
    	$cond->addJoin(TableroObjectivePeer::ID,TableroProjectPeer::OBJECTIVEID, Criteria::INNER_JOIN);
    	$cond->addJoin(TableroProjectPeer::ID,TableroIndicatorPeer::PROJECTID,Criteria::INNER_JOIN);
    	$cond->addJoin(TableroIndicatorPeer::ID,TableroMeasurePeer::INDICATORID,Criteria::INNER_JOIN);
    } 


    $pager = new PropelPager($cond,"TableroMeasurePeer", "doSelect",$page,$perPage);
    return $pager;
   }    

	/**
	* Obtiene todos los parametros de busqueda
	*
	* @return criteria
	*
	*/
	private function getSearchCriteria() {

		$criteria = new Criteria();

		if ($this->searchString)
	    $criteria->add(TableroMeasurePeer::NAME,"%".$this->searchString."%",Criteria::LIKE);

		return $criteria;

	}

	/**
	* Obtiene todos los projects paginados segun la condicion de busqueda ingresada.
	*
	* @param int $page [optional] Numero de pagina actual
	* @param int $perPage [optional] Cantidad de filas por pagina
	* @return array Informacion sobre todos los projects
	*
	*/
	function getSearchPaginated($page=1,$perPage=-1) {
		if ($perPage == -1)
			$perPage = 	Common::getRowsPerPage();
		if (empty($page))
			$page = 1;

		require_once("propel/util/PropelPager.php");
		$cond = $this->getSearchCriteria();

		$pager = new PropelPager($cond,"TableroMeasurePeer", "doSelect",$page,$perPage);
		return $pager;
	}

} // TableroMeasurePeer
