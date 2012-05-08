<?php


// The object class
include_once('tablero/classes/TableroObjective.php');
require_once('tablero/classes/TableroIndicatorPeer.php');
require_once('tablero/classes/TableroMilestonePeer.php');
require_once('tablero/classes/TableroProjectPeer.php');


/**
 * Skeleton subclass for performing query and update operations on the 'tablero_objective' table.
 *
 * Objective
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    tablero.classes
 */
class TableroObjectivePeer extends BaseTableroObjectivePeer {

	/** the default item name for this class */
	const ITEM_NAME = 'Objectives';

	private  $dependencyId;
	private  $objectives = false;
	private  $projects = false;
	private  $projectsEnded = false;
	private  $projectsDelayed = false;
	private  $projectsWorking = false;
	private  $indicators = false;
	private  $milestones = false;
	//opciones de filtrado
	private  $dateFrom;
	private  $dateTo;
	private  $searchString;
	private  $strategicObjectiveId;

	//mapea las condiciones del filtro
	var $filterConditions = array(
					"strategicObjectiveId"=>"setStrategicObjectiveId",
					"searchString"=>"setSearchString",
					"dependency"=>"setSearchDependency",
					"commune"=>"setSearchCommune",
					"region"=>"setSearchRegion",
					"dateFrom"=>"setDateFrom",
					"dateTo"=>"setDateTo"
				);

	//mapea un status a la llamada del metodo que indica que estado tiene
	 private $projectStatus = array(
	 				'delayed'=>'isDelayed',
	 				'ended'=>'isEnded',
	 				'working'=>'isOnWork',
					'OnTime'=>'isOnTime',
					'Delayed'=>'isDelayed2',
					'Late'=>'isLate'
	 				);

	/**
	 * Especifica una cadena de busqueda.
	 * @param searchString cadena de busqueda.
	 */
	public function setSearchString($searchString) {
		$this->searchString = $searchString;
	}

	/**
	 * Especifica el Id del afiliado.
	 * @param int Id del afiliado.
	 */
	public function setAffiliateId($affiliateId) {
		$this->affiliateId = $affiliateId;
	}

	/**
	 * Especifica un objetivo estratégico
	 * @param strategicObjectiveId id del objetivo estratégico.
	 */
	public function setStrategicObjectiveId($strategicObjectiveId) {
		$this->strategicObjectiveId = $strategicObjectiveId;
	}

  /**
  * Crea un objective nuevo.
  *
  * @param string $name name del objective
  * @param int $affiliateId affiliateId del objective
  * @param int $description description del objective
  * @param string $date date del objective
  * @param string $expirationDate expirationDate del objective
  * @param int $achieved achieved del objective
  * @param string $notes notes del objective
  * @return boolean true si se creo el objective correctamente, false sino
	*/
	function create($name,$affiliateId,$description,$date,$expirationDate,$achieved,$notes,$strategicObjectiveId,$con = null) {
    $objectiveObj = new TableroObjective();
    $objectiveObj->setname($name);
		$objectiveObj->setaffiliateId($affiliateId);
		$objectiveObj->setdescription($description);
		$objectiveObj->setStrategicObjectiveId($strategicObjectiveId);
    try {
		  $objectiveObj->setdate($date);
    } catch (PropelException $exp) { }
    try {
		  $objectiveObj->setexpirationDate($expirationDate);
    } catch (PropelException $exp) { }
		$objectiveObj->setachieved($achieved);
		$objectiveObj->setnotes($notes);
    try {
		  $objectiveObj->save($con);
      return true;
    } catch (PropelException $exp) {
      return false;
    }
	}

  /**
  * Crea un objective nuevo.
  *
  * @param string $name name del objective
  * @param int $affiliateId affiliateId del objective
  * @param int $description description del objective
  * @param string $date date del objective
  * @param string $expirationDate expirationDate del objective
  * @param int $achieved achieved del objective
  * @param string $notes notes del objective
  * @return boolean true si se creo el objective correctamente, false sino
	*/
	function createMigration($objectiveParams,$con = null)
	{
    $objectiveObj = new TableroObjective();
		foreach ($objectiveParams as $key => $value) {
			$setMethod = "set".$key;
			if ( method_exists($objectiveObj,$setMethod) ) {          
				if (!empty($value) || $value == "0")
					$objectiveObj->$setMethod($value);
				else
					$objectiveObj->$setMethod(null);
			}
		}

    try {
		  $objectiveObj->save($con);
      return true;
    } catch (PropelException $exp) {
      return false;
    }
	}

  /**
  * Actualiza la informacion de un objective.
  *
  * @param int $id id del objective
  * @param string $name name del objective
  * @param int $affiliateId affiliateId del objective
  * @param int $description description del objective
  * @param string $date date del objective
  * @param string $expirationDate expirationDate del objective
  * @param int $achieved achieved del objective
  * @param string $notes notes del objective
  * @return boolean true si se actualizo la informacion correctamente, false sino
	*/
  function update($id,$name,$affiliateId,$description,$date,$expirationDate,$achieved,$notes,$strategicObjectiveId) {
  	$objectiveObj = TableroObjectivePeer::retrieveByPK($id);
    $objectiveObj->setname($name);
    $objectiveObj->setaffiliateId($affiliateId);
    $objectiveObj->setdescription($description);
		$objectiveObj->setStrategicObjectiveId($strategicObjectiveId);
    try {
      $objectiveObj->setdate($date);
    } catch (PropelException $exp) { }
    try {
      $objectiveObj->setexpirationDate($expirationDate);
    } catch (PropelException $exp) { }
    $objectiveObj->setachieved($achieved);
    $objectiveObj->setnotes($notes);
    try {
      $objectiveObj->save($con);
      return true;
    } catch (PropelException $exp) {
      return false;
    }
  }

	/**
	* Elimina un objective a partir de los valores de la clave.
	*
  * @param int $id id del objective
	*	@return boolean true si se elimino correctamente el objective, false sino
	*/
  function delete($id) {
  	$objectiveObj = TableroObjectivePeer::retrieveByPK($id);
    $objectiveObj->delete();
		return true;
  }

  /**
  * Obtiene la informacion de un objective.
  *
  * @param int $id id del objective
  * @return array Informacion del objective
  */
  function get($id) {
		$objectiveObj = TableroObjectivePeer::retrieveByPK($id);
    return $objectiveObj;
  }

  /**
  * Obtiene la informacion de un objective a partir de su nombre.
  *
  * @param string $name Nombre del objective
  * @return array Informacion del objective
  */
  function getByName($name,$con = null) {
    $cond = new Criteria();
    $cond->add(TableroObjectivePeer::NAME,$name);
    $objective = TableroObjectivePeer::doSelectOne($cond,$con);
    return $objective;
   }

  /**
  * Obtiene todos los objectives.
	*
	*	@return array Informacion sobre todos los objectives
  */
	function getAll($affiliateId = null) {
		$cond = new Criteria();
		if ($affiliateId != null) {
			$cond->add(TableroObjectivePeer::AFFILIATEID,$affiliateId);
		}
		$alls = TableroObjectivePeer::doSelect($cond);
		return $alls;
  }

  /**
  * Obtiene todos los objectives paginados.
  *
  * @param int $page [optional] Numero de pagina actual
  * @param int $perPage [optional] Cantidad de filas por pagina
  * @param int $idAffiliate Id de dependencencia, opcional para limitar la busqueda
  * @return array Informacion sobre todos los objectives
  */
  function getAllPaginated($page=1,$perPage=-1,$idAffiliate = null) {
    if ($perPage == -1)
      $perPage = 	Common::getRowsPerPage();
    if (empty($page))
      $page = 1;
    require_once("propel/util/PropelPager.php");
    $cond = new Criteria();
    if ($idAffiliate != null)
    	$cond->add(TableroObjectivePeer::AFFILIATEID,$idAffiliate);
    $pager = new PropelPager($cond,"TableroObjectivePeer", "doSelect",$page,$perPage);
    return $pager;
   }


  /**
   * Crea una Criteria a partir de las condiciones de filtro ingresadas al peer.
   * @return Criteria instancia de criteria
   */
  private function getCriteria() {
		$criteria = new Criteria();
		$criteria->setIgnoreCase(true);
	
		if ($this->searchString)
	    $criteria->add(TableroObjectivePeer::NAME,"%".$this->searchString."%",Criteria::LIKE);
	
		if ($this->affiliateId)
	    $criteria->add(TableroObjectivePeer::AFFILIATEID,$this->affiliateId);

		if ($this->strategicObjectiveId)
	    $criteria->add(TableroObjectivePeer::STRATEGICOBJECTIVEID,$this->strategicObjectiveId);

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
    $pager = new PropelPager($cond,"TableroObjectivePeer", "doSelect",$page,$perPage);
    return $pager;
   }



} // TableroObjectivePeer
