<?php

// The object class
include_once 'tablero/classes/TableroActivity.php';

/**
 * Skeleton subclass for performing query and update operations on the 'tablero_Activity' table.
 *
 * Activity
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    tablero.classes
 */
class TableroActivityPeer extends BaseTableroActivityPeer {

	/** the default item name for this class */
	const ITEM_NAME = 'Activities';

	private $searchString;
	private $affiliateId;

	//mapea las condiciones del filtro
	var $filterConditions = array(
					"searchString"=>"setSearchString",
					"dependency"=>"setSearchDependency",
					"commune"=>"setSearchCommune",
					"region"=>"setSearchRegion",
					"delayed"=>"setSearchDelayed",
					"ended"=>"setSearchEnded",
					"working"=>"setSearchWorking"
				);

	/**
	 * Especifica una cadena de busqueda.
	 * @param string cadena de busqueda.
	 */
	public function setSearchString($string) {
		$this->searchString = $string;
	}

	/**
	 * Especifica el Id del afiliado.
	 * @param int Id del afiliado.
	 */
	public function setAffiliateId($affiliateId) {
		$this->affiliateId = $affiliateId;
	}

  /**
  * Crea un Activity nuevo.
  *
  * @param int $projectId projectId del Activity
  * @param string $name name del Activity
  * @param string $expirationDate expirationDate del Activity
  * @param int $completed completed del Activity
  * @param string $notes notes del Activity
  * @return boolean true si se creo el Activity correctamente, false sino
	*/
	function create($projectId,$name,$expirationDate,$completed,$notes,$con = null) {
    $ActivityObj = new TableroActivity();
    $ActivityObj->setprojectId($projectId);
		$ActivityObj->setname($name);
    $ActivityObj->setdate(time());
    try {
		  $ActivityObj->setexpirationDate($expirationDate);
    } catch (PropelException $exp) { }
		$ActivityObj->setcompleted($completed);
		$ActivityObj->setnotes($notes);
    try {
		  $ActivityObj->save($con);
		  return true;
    } catch (PropelException $exp) {
      return false;
    }
	}

  /**
  * Actualiza la informacion de un Activity.
  *
  * @param int $id id del Activity
  * @param int $projectId projectId del Activity
  * @param string $name name del Activity
  * @param string $expirationDate expirationDate del Activity
  * @param int $completed completed del Activity
  * @param string $notes notes del Activity
  * @return boolean true si se actualizo la informacion correctamente, false sino
	*/
  function update($id,$projectId,$name,$expirationDate,$completed,$notes) {
  	$ActivityObj = TableroActivityPeer::retrieveByPK($id);
    $ActivityObj->setprojectId($projectId);
    $ActivityObj->setname($name);
    try {
      $ActivityObj->setexpirationDate($expirationDate);
    } catch (PropelException $exp) { }
    $ActivityObj->setcompleted($completed);
    $ActivityObj->setnotes($notes);
    try {
      $ActivityObj->save($con);
      return true;
    } catch (PropelException $exp) {
      return false;
    }
  }

	/**
	* Elimina un Activity a partir de los valores de la clave.
	*
  * @param int $id id del Activity
	*	@return boolean true si se elimino correctamente el Activity, false sino
	*/
  function delete($id) {
  	$ActivityObj = TableroActivityPeer::retrieveByPK($id);
    $ActivityObj->delete();
		return true;
  }

  /**
  * Obtiene la informacion de un Activity.
  *
  * @param int $id id del Activity
  * @return array Informacion del Activity
  */
  function get($id) {
		$ActivityObj = TableroActivityPeer::retrieveByPK($id);
    return $ActivityObj;
  }

  /**
  * Obtiene todos los Activities.
	*
	*	@return array Informacion sobre todos los Activities
  */
	function getAll($affiliateId = null) {
		$cond = new Criteria();

		if ($affiliateId != null) {
			require_once('TableroObjectivePeer.php');
			require_once('TableroProjectPeer.php');
			//obtenemos solo aquellos que correposponden a las dependencias de un cierto afiliado
			$cond->add(TableroObjectivePeer::AFFILIATEID,$affiliateId);
			$cond->addJoin(TableroObjectivePeer::ID,TableroProjectPeer::OBJECTIVEID,Criteria::INNER_JOIN);
			$cond->addJoin(TableroProjectPeer::ID,TableroActivityPeer::PROJECTID,Criteria::INNER_JOIN);
		}

		$alls = TableroActivityPeer::doSelect($cond);
		return $alls;
  }

  /**
  * Obtiene todos los Activities paginados.
  *
  * @param int $page [optional] Numero de pagina actual
  * @param int $perPage [optional] Cantidad de filas por pagina
  * @param int $affiliateId [optional] Id de dependencia a la que pertenecen esos Activities
  *	@return array Informacion sobre todos los Activities
  */
  function getAllPaginated($page=1,$perPage=-1,$affiliateId = null) {
    if ($perPage == -1)
      $perPage = Common::getRowsPerPage();
    if (empty($page))
      $page = 1;

    require_once("propel/util/PropelPager.php");
    $cond = new Criteria();

    if ($affiliateId != null) {

    	require_once('TableroObjectivePeer.php');
    	require_once('TableroProjectPeer.php');
    	//obtenemos solo aquellos que correposponden a las dependencias de un cierto afiliado
    	$cond->add(TableroObjectivePeer::AFFILIATEID,$affiliateId);
    	$cond->addJoin(TableroObjectivePeer::ID,TableroProjectPeer::OBJECTIVEID,Criteria::INNER_JOIN);
    	$cond->addJoin(TableroProjectPeer::ID,TableroActivityPeer::PROJECTID,Criteria::INNER_JOIN);
    }

    $pager = new PropelPager($cond,"TableroActivityPeer", "doSelect",$page,$perPage);
    return $pager;
   }

	/**
	* Obtiene todos los Activities de un proyecto.
	*
	*	@return array Informacion sobre todos los Activities
	*/
	function getAllByProject($projectId,$affiliateId = null) {
		$cond = new Criteria();

		if ($affiliateId != null) {
			require_once('TableroObjectivePeer.php');
			require_once('TableroProjectPeer.php');
			//obtenemos solo aquellos que correposponden a las dependencias de un cierto afiliado
			$cond->add(TableroObjectivePeer::AFFILIATEID,$affiliateId);
			$cond->addJoin(TableroObjectivePeer::ID,TableroProjectPeer::OBJECTIVEID,Criteria::INNER_JOIN);
			$cond->addJoin(TableroProjectPeer::ID,TableroActivityPeer::PROJECTID,Criteria::INNER_JOIN);
		}

		$cond->add(TableroActivityPeer::PROJECTID,$projectId);

		$alls = TableroActivityPeer::doSelect($cond);
		return $alls;
	}

  /**
  * Obtiene todos los Activities de una dependencia.
  *
  *	@return array Informacion sobre todos los Activities
  */
  function getAllByAffiliate($affiliateId) {
    $cond = new Criteria();
    require_once('TableroObjectivePeer.php');
    require_once('TableroProjectPeer.php');
    //obtenemos solo aquellos que correposponden a las dependencias de un cierto afiliado
    $cond->add(TableroObjectivePeer::AFFILIATEID,$affiliateId);
    $cond->addJoin(TableroObjectivePeer::ID,TableroProjectPeer::OBJECTIVEID,Criteria::INNER_JOIN);
    $cond->addJoin(TableroProjectPeer::ID,TableroActivityPeer::PROJECTID,Criteria::INNER_JOIN);

    $alls = ActivityPeer::doSelect($cond);
    return $alls;
  }

  /**
   * Crea una Criteria a partir de las condiciones de filtro ingresadas al peer.
   * @return Criteria instancia de criteria
   */
  private function getCriteria() {
		require_once('TableroObjectivePeer.php');
		require_once('TableroProjectPeer.php');
		$criteria = new Criteria();
		$criteria->setIgnoreCase(true);
	
		if ($this->searchString)
	    $criteria->add(TableroActivityPeer::NAME,"%".$this->searchString."%",Criteria::LIKE);
	
		if ($this->affiliateId) {
	    $criteria->add(TableroObjectivePeer::AFFILIATEID,$this->affiliateId);
	    $criteria->addJoin(TableroObjectivePeer::ID,TableroProjectPeer::OBJECTIVEID,Criteria::INNER_JOIN);
	    $criteria->addJoin(TableroProjectPeer::ID,TableroActivityPeer::PROJECTID,Criteria::INNER_JOIN);
	  }
		return $criteria;
	
  }


  /**
  * Obtiene todas las activities paginados con las opciones de filtro asignadas al peer.
  *
  * @param int $page [optional] Numero de pagina actual
  * @param int $perPage [optional] Cantidad de filas por pagina
  *	@return array Informacion sobre todos los activities
  */
  function getAllPaginatedFiltered($page=1,$perPage=-1) {  
    if ($perPage == -1)
      $perPage = Common::getRowsPerPage();
    if (empty($page))
      $page = 1;
    require_once("propel/util/PropelPager.php");
    $cond = $this->getCriteria();     
    $pager = new PropelPager($cond,"TableroActivityPeer", "doSelect",$page,$perPage);
    return $pager;
   }


  /**
  * Crea un Activity nuevo.
  *
  * @param array $paramsActivity datos del Milestone
  * @return boolean true si se creo el Milestone correctamente, false sino
	*/
	function createMigration($paramsActivity,$con = null)
	{
    $activityObj = new TableroActivity();
		foreach ($paramsActivity as $key => $value) {
			$setMethod = "set".$key;
			if ( method_exists($activityObj,$setMethod) ) {          
				if (!empty($value) || $value == "0")
					$activityObj->$setMethod($value);
				else
					$activityObj->$setMethod(null);
			}
		}
    try {
		  $activityObj->save($con);
		  return true;
    } catch (PropelException $exp) {
      return false;
    }
	}

} // TableroActivityPeer
