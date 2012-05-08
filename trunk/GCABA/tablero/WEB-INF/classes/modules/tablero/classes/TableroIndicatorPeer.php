<?php

/**
 * Skeleton subclass for performing query and update operations on the 'tablero_indicator' table.
 *
 * Indicator
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    tablero.classes
 */
class TableroIndicatorPeer extends BaseTableroIndicatorPeer {

	/** the default item name for this class */
	const ITEM_NAME = 'Indicators';

	private $searchString;

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
	* Crea un indicator nuevo.
	*
	* @param string $name name del indicator
	* @param Connection $con [optional] Conexion a la db
	* @return boolean true si se creo el indicator correctamente, false sino
	*/
	function create($indicatorParams)
	{
		$indicatorObj = new TableroIndicator();
		foreach ($indicatorParams as $key => $value) {
			$setMethod = "set".$key;
			if ( method_exists($indicatorObj,$setMethod) ) {
				if (!empty($value) || $value == "0")
					$indicatorObj->$setMethod($value);
				else
					$indicatorObj->$setMethod(null);
			}
		}
		try {
			$indicatorObj->save();
			return true;
		} catch (PropelException $exp) {
			return false;
		}
	}

	/**
	* Actualiza la informacion de un indicator.
	*
	* @param int $id id del indicator
	* @param string $name name del indicator
	* @return boolean true si se actualizo la informacion correctamente, false sino
	*/
	function update($id,$indicatorParams)
	{
		$indicatorObj = TableroIndicatorQuery::create()->findPk($id);
		foreach ($indicatorParams as $key => $value) {
			$setMethod = "set".$key;
			if ( method_exists($indicatorObj,$setMethod) ) {
				if (!empty($value) || $value == "0")
					$indicatorObj->$setMethod($value);
				else
					$indicatorObj->$setMethod(null);
			}
		}
		try {
			$indicatorObj->save();
			return true;
		} catch (PropelException $exp) {
			return false;
		}
	}

	/**
	* Elimina un indicator a partir de los valores de la clave.
	*
  * @param int $id id del indicator
	*	@return boolean true si se elimino correctamente el indicator, false sino
	*/
  function delete($id) {
  	$indicatorObj = TableroIndicatorPeer::retrieveByPK($id);
    $indicatorObj->delete();
		return true;
  }

  /**
  * Obtiene la informacion de un indicator.
  *
  * @param int $id id del indicator
  * @return array Informacion del indicator
  */
  function get($id) {
		$indicatorObj = TableroIndicatorPeer::retrieveByPK($id);
    return $indicatorObj;
  }

  /**
  * Obtiene todos los indicators.
	*
	*	@return array Informacion sobre todos los indicators
  */
	function getAll($affiliateId = null) {
		$cond = new Criteria();
		
		if ($affiliateId != null) {    
			require_once('TableroObjectivePeer.php');
			require_once('TableroProjectPeer.php');
			//obtenemos solo aquellos que correposponden a las dependencias de un cierto afiliado
			$cond->add(TableroObjectivePeer::AFFILIATEID,$affiliateId);
			$cond->addJoin(TableroObjectivePeer::ID,ProjectPeer::OBJECTIVEID, Criteria::INNER_JOIN);
			$cond->addJoin(TableroProjectPeer::ID,TableroIndicatorPeer::PROJECTID,Criteria::INNER_JOIN);
		} 

		
		$alls = TableroIndicatorPeer::doSelect($cond);
		return $alls;
  }
  
  /**
  * Obtiene todos los indicators paginados.
  *
  * @param int $page [optional] Numero de pagina actual
  * @param int $perPage [optional] Cantidad de filas por pagina
  *	@return array Informacion sobre todos los indicators
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
    	//obtenemos solo aquellos que correposponden a las dependencias de un cierto afiliado
    	$cond->add(TableroObjectivePeer::AFFILIATEID,$affiliateId);
    	$cond->addJoin(TableroObjectivePeer::ID,TableroProjectPeer::OBJECTIVEID, Criteria::INNER_JOIN);
    	$cond->addJoin(TableroProjectPeer::ID,TableroIndicatorPeer::PROJECTID,Criteria::INNER_JOIN);
    } 


    $pager = new PropelPager($cond,"TableroIndicatorPeer", "doSelect",$page,$perPage);
    return $pager;
   }
   
	/**
	* Obtiene todos los indicators de un cierto proyecto.
	*
	*	@return array Informacion sobre todos los indicators
	*/
	function getAllByProject($proyectId,$affiliateId = null) {
		$cond = new Criteria();
		
		if ($affiliateId != null) {    
			require_once('TableroObjectivePeer.php');
			require_once('TableroProjectPeer.php');
			//obtenemos solo aquellos que correposponden a las dependencias de un cierto afiliado
			$cond->add(TableroObjectivePeer::AFFILIATEID,$affiliateId);
			$cond->addJoin(TableroObjectivePeer::ID,TableroProjectPeer::OBJECTIVEID, Criteria::INNER_JOIN);
			$cond->addJoin(TableroProjectPeer::ID,TableroIndicatorPeer::PROJECTID,Criteria::INNER_JOIN);
		} 

		$cond->add(TableroIndicatorPeer::PROJECTID,$proyectId);
		
		$alls = TableroIndicatorPeer::doSelect($cond);

		return $alls;
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
	    $criteria->add(TableroIndicatorPeer::NAME,"%".$this->searchString."%",Criteria::LIKE);

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

		$pager = new PropelPager($cond,"TableroIndicatorPeer", "doSelect",$page,$perPage);
		return $pager;
	}

} // TableroIndicatorPeer
