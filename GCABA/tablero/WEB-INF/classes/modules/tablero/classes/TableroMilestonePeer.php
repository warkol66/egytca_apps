<?php


// The object class
include_once 'tablero/classes/TableroMilestone.php';

/**
 * Skeleton subclass for performing query and update operations on the 'tablero_milestone' table.
 *
 * Milestone
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    tablero.classes
 */
class TableroMilestonePeer extends BaseTableroMilestonePeer {

	/** the default item name for this class */
	const ITEM_NAME = 'Milestones';

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
  * Crea un milestone nuevo.
  *
  * @param int $projectId projectId del milestone
  * @param string $name name del milestone
  * @param string $expirationDate expirationDate del milestone
  * @param int $completed completed del milestone
  * @param string $notes notes del milestone
  * @return boolean true si se creo el milestone correctamente, false sino
	*/
	function create($projectId,$name,$expirationDate,$completed,$notes,$con = null) {
    $milestoneObj = new TableroMilestone();
    $milestoneObj->setprojectId($projectId);
		$milestoneObj->setname($name);
    $milestoneObj->setdate(time());
    try {
		  $milestoneObj->setexpirationDate($expirationDate);
    } catch (PropelException $exp) { }
		$milestoneObj->setcompleted($completed);
		$milestoneObj->setnotes($notes);
    try {
		  $milestoneObj->save($con);
		  return true;
    } catch (PropelException $exp) {
      return false;
    }
	}

  /**
  * Actualiza la informacion de un milestone.
  *
  * @param int $id id del milestone
  * @param int $projectId projectId del milestone
  * @param string $name name del milestone
  * @param string $expirationDate expirationDate del milestone
  * @param int $completed completed del milestone
  * @param string $notes notes del milestone
  * @return boolean true si se actualizo la informacion correctamente, false sino
	*/
  function update($id,$projectId,$name,$expirationDate,$completed,$notes) {
  	$milestoneObj = TableroMilestonePeer::retrieveByPK($id);
    $milestoneObj->setprojectId($projectId);
    $milestoneObj->setname($name);
    try {
      $milestoneObj->setexpirationDate($expirationDate);
    } catch (PropelException $exp) { }
    $milestoneObj->setcompleted($completed);
    $milestoneObj->setnotes($notes);
    try {
      $milestoneObj->save($con);
      return true;
    } catch (PropelException $exp) {
      return false;
    }
  }

	/**
	* Elimina un milestone a partir de los valores de la clave.
	*
  * @param int $id id del milestone
	*	@return boolean true si se elimino correctamente el milestone, false sino
	*/
  function delete($id) {
  	$milestoneObj = TableroMilestonePeer::retrieveByPK($id);
    $milestoneObj->delete();
		return true;
  }

  /**
  * Obtiene la informacion de un milestone.
  *
  * @param int $id id del milestone
  * @return array Informacion del milestone
  */
  function get($id) {
		$milestoneObj = TableroMilestonePeer::retrieveByPK($id);
    return $milestoneObj;
  }

  /**
  * Obtiene todos los milestones.
	*
	*	@return array Informacion sobre todos los milestones
  */
	function getAll($affiliateId = null) {
		$cond = new Criteria();

		if ($affiliateId != null) {
			require_once('TableroObjectivePeer.php');
			require_once('TableroProjectPeer.php');
			//obtenemos solo aquellos que correposponden a las dependencias de un cierto afiliado
			$cond->add(TableroObjectivePeer::AFFILIATEID,$affiliateId);
			$cond->addJoin(TableroObjectivePeer::ID,TableroProjectPeer::OBJECTIVEID,Criteria::INNER_JOIN);
			$cond->addJoin(TableroProjectPeer::ID,TableroMilestonePeer::PROJECTID,Criteria::INNER_JOIN);
		}

		$alls = TableroMilestonePeer::doSelect($cond);
		return $alls;
  }

  /**
  * Obtiene todos los milestones paginados.
  *
  * @param int $page [optional] Numero de pagina actual
  * @param int $perPage [optional] Cantidad de filas por pagina
  * @param int $affiliateId [optional] Id de dependencia a la que pertenecen esos milestones
  *	@return array Informacion sobre todos los milestones
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
    	$cond->addJoin(TableroProjectPeer::ID,TableroMilestonePeer::PROJECTID,Criteria::INNER_JOIN);
    }

    $pager = new PropelPager($cond,"TableroMilestonePeer", "doSelect",$page,$perPage);
    return $pager;
   }

	/**
	* Obtiene todos los milestones de un proyecto.
	*
	*	@return array Informacion sobre todos los milestones
	*/
	function getAllByProject($projectId,$affiliateId = null) {
		$cond = new Criteria();

		if ($affiliateId != null) {
			require_once('TableroObjectivePeer.php');
			require_once('TableroProjectPeer.php');
			//obtenemos solo aquellos que correposponden a las dependencias de un cierto afiliado
			$cond->add(TableroObjectivePeer::AFFILIATEID,$affiliateId);
			$cond->addJoin(TableroObjectivePeer::ID,TableroProjectPeer::OBJECTIVEID,Criteria::INNER_JOIN);
			$cond->addJoin(TableroProjectPeer::ID,TableroMilestonePeer::PROJECTID,Criteria::INNER_JOIN);
		}

		$cond->add(TableroMilestonePeer::PROJECTID,$projectId);

		$alls = TableroMilestonePeer::doSelect($cond);
		return $alls;
	}

  /**
  * Obtiene todos los milestones de una dependencia.
  *
  *	@return array Informacion sobre todos los milestones
  */
  function getAllByAffiliate($affiliateId) {
    $cond = new Criteria();
    require_once('TableroObjectivePeer.php');
    require_once('TableroProjectPeer.php');
    //obtenemos solo aquellos que correposponden a las dependencias de un cierto afiliado
    $cond->add(TableroObjectivePeer::AFFILIATEID,$affiliateId);
    $cond->addJoin(TableroObjectivePeer::ID,TableroProjectPeer::OBJECTIVEID,Criteria::INNER_JOIN);
    $cond->addJoin(TableroProjectPeer::ID,TableroMilestonePeer::PROJECTID,Criteria::INNER_JOIN);

    $alls = MilestonePeer::doSelect($cond);
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
	    $criteria->add(TableroMilestonePeer::NAME,"%".$this->searchString."%",Criteria::LIKE);
	
		if ($this->affiliateId) {
	    $criteria->add(TableroObjectivePeer::AFFILIATEID,$this->affiliateId);
	    $criteria->addJoin(TableroObjectivePeer::ID,TableroProjectPeer::OBJECTIVEID,Criteria::INNER_JOIN);
	    $criteria->addJoin(TableroProjectPeer::ID,TableroMilestonePeer::PROJECTID,Criteria::INNER_JOIN);
	  }
		return $criteria;
	
  }

  /**
  * Obtiene todos los milestones paginados con las opciones de filtro asignadas al peer.
  *
  * @param int $page [optional] Numero de pagina actual
  * @param int $perPage [optional] Cantidad de filas por pagina
  *	@return array Informacion sobre todos los milestones
  */
  function getAllPaginatedFiltered($page=1,$perPage=-1) {  
    if ($perPage == -1)
      $perPage = Common::getRowsPerPage();
    if (empty($page))
      $page = 1;
    require_once("propel/util/PropelPager.php");
    $cond = $this->getCriteria();     
    $pager = new PropelPager($cond,"TableroMilestonePeer", "doSelect",$page,$perPage);
    return $pager;
   }

  /**
  * Crea un Milestone nuevo.
  *
  * @param array $paramsMilestone datos del Milestone
  * @return boolean true si se creo el Activity correctamente, false sino
	*/
	function createMigration($paramsMilestone,$con = null)
	{
    $milestoneObj = new TableroMilestone();
		foreach ($paramsMilestone as $key => $value) {
			$setMethod = "set".$key;
			if ( method_exists($milestoneObj,$setMethod) ) {          
				if (!empty($value) || $value == "0")
					$milestoneObj->$setMethod($value);
				else
					$milestoneObj->$setMethod(null);
			}
		}
    try {
		  $milestoneObj->save($con);
		  return true;
    } catch (PropelException $exp) {
      return false;
    }
	}

} // TableroMilestonePeer
