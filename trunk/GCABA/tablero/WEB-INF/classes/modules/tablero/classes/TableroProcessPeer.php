<?php


// The object class
include_once('tablero/classes/TableroProcess.php');
require_once('tablero/classes/TableroObjectivePeer.php');
require_once('tablero/classes/TableroCommuneProcessPeer.php');
require_once('tablero/classes/TableroRegionProcessPeer.php');

/**
 * Skeleton subclass for performing query and update operations on the 'tablero_process' table.
 *
 * Process
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    tablero.classes
 */
class TableroProcessPeer extends BaseTableroProcessPeer {

	/** the default item name for this class */
	const ITEM_NAME = 'Processes';

	private $searchString;
	private $searchDependecyId;
	private $searchCommuneId;
	private $searchRegionId;
	private $searchDelayed;
	private $searchEnded;
	private $searchWorking;

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
	 * @param searchString cadena de busqueda.
	 */
	function setSearchString($searchString) {
		$this->searchString = $searchString;
	}

	/**
	 * Indica una dependencia para la que se deberan buscar resultados.
	 * @param $dependecyId id de dependencia
	 */
	function setSearchDependency($dependecyId) {
		$this->searchDependecyId = $dependecyId;
	}

	/**
	 * Indica una comuna para la que se deberan buscar resultados.
	 *
	 * @param $communeId id de la comuna
	 *
	 */
	function setSearchCommune($communeId) {
		$this->searchCommuneId = $communeId;
	}

	/**
	 * Indica una region para la cual se deberan buscar resultados.
	 * @param $regionId id de region
	 */
	function setSearchRegion($regionId) {
		$this->searchRegionId = $regionId;
	}

	/**
	 * Indica que se deberan buscar aquellos proyectos que se encuentran retrasados.
	 *
	 */
	function setSearchDelayed() {
		$this->searchDelayed = true;
	}

	/**
	 * Indica que se deberan buscar aquellos proyectos que se encuentran finalizados.
	 *
	 */
	function setSearchEnded() {
		$this->searchEnded = true;
	}

	/**
	 * Indica que se deberan buscar aquellos proyectos que se encuentran en ejecucion.
	 *
	 */
	function setSearchWorking() {
		$this->searchWorking = true;
	}

  /**
  * Crea un process nuevo.
  *
  * @param int $objectiveId objectiveId del process
  * @param string $name name del process
  * @param string $description description del process
  * @param string $impact impact del process
  * @param string $uniqueGoal uniqueGoal del process
  * @param string $goalExpirationDate goalExpirationDate del process
  * @param float $budget budget del process
  * @param string $coordinateNeed coordinateNeed del process
  * @param string $frequency frequency del process
  * @param int $finished finished del process
  * @param string $notes notes del process
  * @param string $neighbourhods neighbourhods del process
  * @param string $commune commune del process
  * @param string $postalCode postalCode del process
  * @param int $uniqueGoalNumeric uniqueGoalNumeric del process
  * @param int $goalProgress goalProgress del process
  * @return boolean true si se creo el process correctamente, false sino
	*/
	function create($objectiveId,$name,$description,$impact,$uniqueGoal,$goalExpirationDate,$budget,$coordinateNeed,$frequency,$finished,$notes,$postalCode,$uniqueGoalNumeric,$goalProgress,$paramsProcess,$con = null) {
  	$processObj = new TableroProcess();
  	$processObj->setobjectiveId($objectiveId);
		$processObj->setname($name);
		$processObj->setdate(time());
		$processObj->setdescription($description);
		$processObj->setimpact($impact);
		$processObj->setuniqueGoal($uniqueGoal);
		try {
			$processObj->setgoalExpirationDate($goalExpirationDate);
		} catch (PropelException $exp) { }
		$processObj->setbudget($budget);
		$processObj->setcoordinateNeed($coordinateNeed);
		$processObj->setfrequency($frequency);
		$processObj->setfinished($finished);
		$processObj->setnotes($notes);
		$processObj->setpostalCode($postalCode);
		$processObj->setuniqueGoalNumeric($uniqueGoalNumeric);
		$processObj->setgoalProgress($goalProgress);
		foreach ($paramsProcess as $key => $value) {
			$setMethod = "set".$key;
			if ( method_exists($processObj,$setMethod) ) {
				if (!empty($value) || $value == "0")
					$processObj->$setMethod($value);
				else
					$processObj->$setMethod(null);
			}
		}
		try {
			$processObj->save($con);
			return true;
		} catch (PropelException $exp) {
			return false;
		}
	}

  /**
  * Actualiza la informacion de un process.
  *
  * @param int $id id del process
  * @param int $objectiveId objectiveId del process
  * @param string $name name del process
  * @param string $description description del process
  * @param string $impact impact del process
  * @param string $uniqueGoal uniqueGoal del process
  * @param string $goalExpirationDate goalExpirationDate del process
  * @param float $budget budget del process
  * @param string $coordinateNeed coordinateNeed del process
  * @param string $frequency frequency del process
  * @param int $finished finished del process
  * @param string $notes notes del process
  * @param string $neighbourhods neighbourhods del process
  * @param string $commune commune del process
  * @param string $postalCode postalCode del process
  * @param int $uniqueGoalNumeric uniqueGoalNumeric del process
  * @param int $goalProgress goalProgress del process
  * @return boolean true si se actualizo la informacion correctamente, false sino
	*/
  function update($id,$objectiveId,$name,$description,$impact,$uniqueGoal,$goalExpirationDate,$budget,$coordinateNeed,$frequency,$finished,$notes		,$postalCode,$uniqueGoalNumeric,$goalProgress,$paramsProcess){
  	$processObj = TableroProcessPeer::retrieveByPK($id);
    $processObj->setobjectiveId($objectiveId);
    $processObj->setname($name);
    $processObj->setdescription($description);
    $processObj->setimpact($impact);
    $processObj->setuniqueGoal($uniqueGoal);
		try {
			$processObj->setgoalExpirationDate($goalExpirationDate);
		} catch (PropelException $exp) { }
    $processObj->setbudget($budget);
    $processObj->setcoordinateNeed($coordinateNeed);
    $processObj->setfrequency($frequency);
    $processObj->setfinished($finished);
    $processObj->setnotes($notes);
    $processObj->setpostalCode($postalCode);
    $processObj->setuniqueGoalNumeric($uniqueGoalNumeric);
    $processObj->setgoalProgress($goalProgress);
		foreach ($paramsProcess as $key => $value) {
			$setMethod = "set".$key;
			if ( method_exists($processObj,$setMethod) ) {
				if (!empty($value) || $value == "0")
					$processObj->$setMethod($value);
				else
					$processObj->$setMethod(null);
			}
		}
		try {
	    	$processObj->save();
			return true;
		} catch (PropelException $exp) {
			return false;
		}
  }

	/**
	* Elimina un process a partir de los valores de la clave.
	*
  * @param int $id id del process
	*	@return boolean true si se elimino correctamente el process, false sino
	*/
  function delete($id) {
  	$processObj = TableroProcessPeer::retrieveByPK($id);
    $processObj->delete();
		return true;
  }

  /**
  * Obtiene la informacion de un process.
  *
  * @param int $id id del process
  * @return Process Informacion del process
  */
  function get($id) {
		$processObj = TableroProcessPeer::retrieveByPK($id);
  		return $processObj;
  }

  /**
  * Obtiene la informacion de un process a partir de su nombre.
  *
  * @param string $name Nombre del process
  * @return Process Informacion del process
  */
  function getByName($name,$con = null) {
		$cond = new Criteria();
		$cond->add(TableroProcessPeer::NAME,$name);
		$process = TableroProcessPeer::doSelectOne($cond,$con);
		return $process;
	}

  /**
  * Obtiene todos los processes.
	*
	*	@return array Informacion sobre todos los processes
  */
	function getAll($affiliateId = null) {
		$cond = new Criteria();

		if ($affiliateId != null)  {
			$cond->add(TableroObjectivePeer::AFFILIATEID,$affiliateId);
			$cond->addJoin(TableroObjectivePeer::ID,TableroProcessPeer::OBJECTIVEID, Criteria::INNER_JOIN);
		}

		$alls = TableroProcessPeer::doSelect($cond);
		return $alls;
  }

  /**
  * Obtiene todos los processes paginados.
  *
  * @param int $page [optional] Numero de pagina actual
  * @param int $perPage [optional] Cantidad de filas por pagina
  *	@return array Informacion sobre todos los processes
  */
  function getAllPaginated($page=1,$perPage=-1,$affiliateId = null) {
    if ($perPage == -1)
      $perPage = 	Common::getRowsPerPage();

    if (empty($page))
      $page = 1;

    require_once("propel/util/PropelPager.php");
    $cond = new Criteria();

    if ($affiliateId != null)  {
      $cond->add(TableroObjectivePeer::AFFILIATEID,$affiliateId);
    	$cond->addJoin(TableroObjectivePeer::ID,TableroProcessPeer::OBJECTIVEID, Criteria::INNER_JOIN);
    }

    $pager = new PropelPager($cond,"TableroProcessPeer", "doSelect",$page,$perPage);
    return $pager;
   }

	/**
	* Obtiene todos los processes de un cierto objetivo.
	*
	*	@return array Informacion sobre todos los processes
	*/
	function getAllByObjective($objectiveId,$affiliateId = null) {
		$cond = new Criteria();

		if ($affiliateId != null)  {
			$cond->add(TableroObjectivePeer::AFFILIATEID,$affiliateId);
			$cond->addJoin(TableroObjectivePeer::ID,TableroProcessPeer::OBJECTIVEID, Criteria::INNER_JOIN);
		}

		$cond->add(TableroProcessPeer::OBJECTIVEID,$objectiveId);

		$alls = TableroProcessPeer::doSelect($cond);
		return $alls;
	}



	private function getSearchCriteria() {

		$criteria = new Criteria();

		if ($this->searchString)
	    $criteria->add(TableroProcessPeer::NAME,"%".$this->searchString."%",Criteria::LIKE);

		if (!empty($this->searchDependecyId)) {
			$criteria->add(TableroObjectivePeer::AFFILIATEID,$this->searchDependecyId);
			$criteria->addJoin(TableroObjectivePeer::ID,TableroProcessPeer::OBJECTIVEID, Criteria::INNER_JOIN);
		}
		if (!empty($this->searchCommuneId)) {
			$criteria->add(TableroCommuneProcessPeer::COMMUNEID,$this->searchCommuneId);
			$criteria->addJoin(TableroProcessPeer::ID,TableroCommuneProcessPeer::PROCESSID, Criteria::INNER_JOIN);
		}
		if (!empty($this->searchRegionId)) {
			$criteria->add(TableroRegionProcessPeer::REGIONID,$this->searchRegionId);
			$criteria->addJoin(TableroProcessPeer::ID,TableroRegionProcessPeer::PROCESSID, Criteria::INNER_JOIN);
		}
		if (!empty($this->searchDelayed)) {
			//no finalizado y su fecha de de finalizacion es anterior a la actual.
			$criterion = $criteria->getNewCriterion(TableroProcessPeer::GOALEXPIRATIONDATE, date('Y-m-d')." 00:00:00", Criteria::LESS_EQUAL);
			$criterion->addAnd($criteria->getNewCriterion(TableroProcessPeer::FINISHED,0,Criteria::EQUAL));
		}
		if (!empty($this->searchEnded)) {
			//buscamos finalizados
 			if (empty($criterion))
				$criterion = $criteria->getNewCriterion(TableroProcessPeer::FINISHED,1,Criteria::EQUAL);
			else
				$criterion->addOr($criteria->getNewCriterion(TableroProcessPeer::FINISHED,1,Criteria::EQUAL));
		}
		if (!empty($this->searchWorking)) {
			//buscamos no finalizados
 			if (empty($criterion))
				$criterion = $criteria->getNewCriterion(TableroProcessPeer::FINISHED,0,Criteria::EQUAL);
			else
				$criterion->addOr($criteria->getNewCriterion(TableroProcessPeer::FINISHED,0,Criteria::EQUAL));
		}
		if (!empty($criterion))
			$criteria->addOr($criterion);

		return $criteria;

	}

	/**
	* Obtiene todos los processes paginados segun la condicion de busqueda ingresada.
	*
	* @param int $page [optional] Numero de pagina actual
	* @param int $perPage [optional] Cantidad de filas por pagina
	* @param int $affiliateId [optional] Id de Afiliado
	* @return array Informacion sobre todos los processes
	*
	*/
	function getSearchPaginated($page=1,$perPage=-1) {
		if ($perPage == -1)
			$perPage = 	Common::getRowsPerPage();
		if (empty($page))
			$page = 1;

		require_once("propel/util/PropelPager.php");
		$cond = $this->getSearchCriteria();

		$pager = new PropelPager($cond,"TableroProcessPeer", "doSelect",$page,$perPage);
		return $pager;
	}

} // TableroProcessPeer
