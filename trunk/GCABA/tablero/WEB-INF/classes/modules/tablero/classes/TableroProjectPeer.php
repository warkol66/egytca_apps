<?php


// The object class
include_once('tablero/classes/TableroProject.php');
require_once('tablero/classes/TableroObjectivePeer.php');
require_once('tablero/classes/TableroCommuneProjectPeer.php');
require_once('tablero/classes/TableroRegionProjectPeer.php');

/**
 * Skeleton subclass for performing query and update operations on the 'tablero_project' table.
 *
 * Project
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    tablero.classes
 */
class TableroProjectPeer extends BaseTableroProjectPeer {

	/** the default item name for this class */
	const ITEM_NAME = 'Projects';

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
  * Crea un project nuevo.
  *
  * @param int $objectiveId objectiveId del project
  * @param string $name name del project
  * @param string $description description del project
  * @param string $impact impact del project
  * @param string $uniqueGoal uniqueGoal del project
  * @param string $goalExpirationDate goalExpirationDate del project
  * @param float $budget budget del project
  * @param string $coordinateNeed coordinateNeed del project
  * @param string $frequency frequency del project
  * @param int $finished finished del project
  * @param string $notes notes del project
  * @param string $neighbourhods neighbourhods del project
  * @param string $commune commune del project
  * @param string $postalCode postalCode del project
  * @param int $uniqueGoalNumeric uniqueGoalNumeric del project
  * @param int $goalProgress goalProgress del project
  * @return boolean true si se creo el project correctamente, false sino
	*/
	function create($objectiveId,$name,$description,$impact,$uniqueGoal,$goalExpirationDate,$budget,$coordinateNeed,$frequency,$finished,$notes,$postalCode,$uniqueGoalNumeric,$goalProgress,$paramsProject,$con = null) {
  	$projectObj = new TableroProject();
  	$projectObj->setobjectiveId($objectiveId);
		$projectObj->setname($name);
		$projectObj->setdate(time());
		$projectObj->setdescription($description);
		$projectObj->setimpact($impact);
		$projectObj->setuniqueGoal($uniqueGoal);
		try {
			$projectObj->setgoalExpirationDate($goalExpirationDate);
		} catch (PropelException $exp) { }
		$projectObj->setbudget($budget);
		$projectObj->setcoordinateNeed($coordinateNeed);
		$projectObj->setfrequency($frequency);
		$projectObj->setfinished($finished);
		$projectObj->setnotes($notes);
		$projectObj->setpostalCode($postalCode);
		$projectObj->setuniqueGoalNumeric($uniqueGoalNumeric);
		$projectObj->setgoalProgress($goalProgress);
		foreach ($paramsProject as $key => $value) {
			$setMethod = "set".$key;
			if ( method_exists($projectObj,$setMethod) ) {
				if (!empty($value) || $value == "0")
					$projectObj->$setMethod($value);
				else
					$projectObj->$setMethod(null);
			}
		}
		try {
			$projectObj->save($con);
			return true;
		} catch (PropelException $exp) {
			return false;
		}
	}

  /**
  * Crea un proyecto nuevo.
  *
  * @param int $objectiveId objectiveId del project
  * @param string $name name del project
  * @param string $description description del project
  * @param string $impact impact del project
  * @param string $uniqueGoal uniqueGoal del project
  * @param string $goalExpirationDate goalExpirationDate del project
  * @param float $budget budget del project
  * @param string $coordinateNeed coordinateNeed del project
  * @param string $frequency frequency del project
  * @param int $finished finished del project
  * @param string $notes notes del project
  * @param string $neighbourhods neighbourhods del project
  * @param string $commune commune del project
  * @param string $postalCode postalCode del project
  * @param int $uniqueGoalNumeric uniqueGoalNumeric del project
  * @param int $goalProgress goalProgress del project
  * @return boolean true si se creo el project correctamente, false sino
	*/
	function createMigration($projectParams,$con = null)
	{
    $projectObj = new TableroProject();
		foreach ($projectParams as $key => $value) {
			$setMethod = "set".$key;
			if ( method_exists($projectObj,$setMethod) ) {
				if (!empty($value) || $value == "0")
					$projectObj->$setMethod($value);
				else
					$projectObj->$setMethod(null);
			}
		}

    try {
		  $projectObj->save($con);
      return true;
    } catch (PropelException $exp) {
      return false;
    }
	}

  /**
  * Actualiza la informacion de un project.
  *
  * @param int $id id del project
  * @param int $objectiveId objectiveId del project
  * @param string $name name del project
  * @param string $description description del project
  * @param string $impact impact del project
  * @param string $uniqueGoal uniqueGoal del project
  * @param string $goalExpirationDate goalExpirationDate del project
  * @param float $budget budget del project
  * @param string $coordinateNeed coordinateNeed del project
  * @param string $frequency frequency del project
  * @param int $finished finished del project
  * @param string $notes notes del project
  * @param string $neighbourhods neighbourhods del project
  * @param string $commune commune del project
  * @param string $postalCode postalCode del project
  * @param int $uniqueGoalNumeric uniqueGoalNumeric del project
  * @param int $goalProgress goalProgress del project
  * @return boolean true si se actualizo la informacion correctamente, false sino
	*/
  function update($id,$objectiveId,$name,$description,$impact,$uniqueGoal,$goalExpirationDate,$budget,$coordinateNeed,$frequency,$finished,$notes		,$postalCode,$uniqueGoalNumeric,$goalProgress,$paramsProject){
  	$projectObj = TableroProjectPeer::retrieveByPK($id);
    $projectObj->setobjectiveId($objectiveId);
    $projectObj->setname($name);
    $projectObj->setdescription($description);
    $projectObj->setimpact($impact);
    $projectObj->setuniqueGoal($uniqueGoal);
		try {
			$projectObj->setgoalExpirationDate($goalExpirationDate);
		} catch (PropelException $exp) { }
    $projectObj->setbudget($budget);
    $projectObj->setcoordinateNeed($coordinateNeed);
    $projectObj->setfrequency($frequency);
    $projectObj->setfinished($finished);
    $projectObj->setnotes($notes);
    $projectObj->setpostalCode($postalCode);
    $projectObj->setuniqueGoalNumeric($uniqueGoalNumeric);
    $projectObj->setgoalProgress($goalProgress);
		foreach ($paramsProject as $key => $value) {
			$setMethod = "set".$key;
			if ( method_exists($projectObj,$setMethod) ) {
				if (!empty($value) || $value == "0")
					$projectObj->$setMethod($value);
				else
					$projectObj->$setMethod(null);
			}
		}
		try {
	    	$projectObj->save();
			return true;
		} catch (PropelException $exp) {
			return false;
		}
  }

	/**
	* Elimina un project a partir de los valores de la clave.
	*
  * @param int $id id del project
	*	@return boolean true si se elimino correctamente el project, false sino
	*/
  function delete($id) {
  	$projectObj = TableroProjectPeer::retrieveByPK($id);
    $projectObj->delete();
		return true;
  }

  /**
  * Obtiene la informacion de un project.
  *
  * @param int $id id del project
  * @return Project Informacion del project
  */
  function get($id) {
		$projectObj = TableroProjectPeer::retrieveByPK($id);
  		return $projectObj;
  }

  /**
  * Obtiene la informacion de un project a partir de su nombre.
  *
  * @param string $name Nombre del project
  * @return Project Informacion del project
  */
  function getByName($name,$con = null) {
		$cond = new Criteria();
		$cond->add(TableroProjectPeer::NAME,$name);
		$project = TableroProjectPeer::doSelectOne($cond,$con);
		return $project;
	}

  /**
  * Obtiene todos los projects.
	*
	*	@return array Informacion sobre todos los projects
  */
	function getAll($affiliateId = null) {
		$cond = new Criteria();

		if ($affiliateId != null)  {
			$cond->add(TableroObjectivePeer::AFFILIATEID,$affiliateId);
			$cond->addJoin(TableroObjectivePeer::ID,TableroProjectPeer::OBJECTIVEID, Criteria::INNER_JOIN);
		}

		$alls = TableroProjectPeer::doSelect($cond);
		return $alls;
  }

  /**
  * Obtiene todos los projects paginados.
  *
  * @param int $page [optional] Numero de pagina actual
  * @param int $perPage [optional] Cantidad de filas por pagina
  *	@return array Informacion sobre todos los projects
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
    	$cond->addJoin(TableroObjectivePeer::ID,TableroProjectPeer::OBJECTIVEID, Criteria::INNER_JOIN);
    }

    $pager = new PropelPager($cond,"TableroProjectPeer", "doSelect",$page,$perPage);
    return $pager;
   }

	/**
	* Obtiene todos los projects de un cierto objetivo.
	*
	*	@return array Informacion sobre todos los projects
	*/
	function getAllByObjective($objectiveId,$affiliateId = null) {
		$cond = new Criteria();

		if ($affiliateId != null)  {
			$cond->add(TableroObjectivePeer::AFFILIATEID,$affiliateId);
			$cond->addJoin(TableroObjectivePeer::ID,TableroProjectPeer::OBJECTIVEID, Criteria::INNER_JOIN);
		}

		$cond->add(TableroProjectPeer::OBJECTIVEID,$objectiveId);

		$alls = TableroProjectPeer::doSelect($cond);
		return $alls;
	}



	private function getSearchCriteria() {

		$criteria = new Criteria();

		if ($this->searchString)
	    $criteria->add(TableroProjectPeer::NAME,"%".$this->searchString."%",Criteria::LIKE);

		if (!empty($this->searchDependecyId)) {
			$criteria->add(TableroObjectivePeer::AFFILIATEID,$this->searchDependecyId);
			$criteria->addJoin(TableroObjectivePeer::ID,TableroProjectPeer::OBJECTIVEID, Criteria::INNER_JOIN);
		}
		if (!empty($this->searchCommuneId)) {
			$criteria->add(TableroCommuneProjectPeer::COMMUNEID,$this->searchCommuneId);
			$criteria->addJoin(TableroProjectPeer::ID,TableroCommuneProjectPeer::PROJECTID, Criteria::INNER_JOIN);
		}
		if (!empty($this->searchRegionId)) {
			$criteria->add(TableroRegionProjectPeer::REGIONID,$this->searchRegionId);
			$criteria->addJoin(TableroProjectPeer::ID,TableroRegionProjectPeer::PROJECTID, Criteria::INNER_JOIN);
		}
		if (!empty($this->searchDelayed)) {
			//no finalizado y su fecha de de finalizacion es anterior a la actual.
			$criterion = $criteria->getNewCriterion(TableroProjectPeer::GOALEXPIRATIONDATE, date('Y-m-d')." 00:00:00", Criteria::LESS_EQUAL);
			$criterion->addAnd($criteria->getNewCriterion(TableroProjectPeer::FINISHED,0,Criteria::EQUAL));
		}
		if (!empty($this->searchEnded)) {
			//buscamos finalizados
 			if (empty($criterion))
				$criterion = $criteria->getNewCriterion(TableroProjectPeer::FINISHED,1,Criteria::EQUAL);
			else
				$criterion->addOr($criteria->getNewCriterion(TableroProjectPeer::FINISHED,1,Criteria::EQUAL));
		}
		if (!empty($this->searchWorking)) {
			//buscamos no finalizados
 			if (empty($criterion))
				$criterion = $criteria->getNewCriterion(TableroProjectPeer::FINISHED,0,Criteria::EQUAL);
			else
				$criterion->addOr($criteria->getNewCriterion(TableroProjectPeer::FINISHED,0,Criteria::EQUAL));
		}
		if (!empty($criterion))
			$criteria->addOr($criterion);

		return $criteria;

	}

	/**
	* Obtiene todos los projects paginados segun la condicion de busqueda ingresada.
	*
	* @param int $page [optional] Numero de pagina actual
	* @param int $perPage [optional] Cantidad de filas por pagina
	* @param int $affiliateId [optional] Id de Afiliado
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

		$pager = new PropelPager($cond,"TableroProjectPeer", "doSelect",$page,$perPage);
		return $pager;
	}


	/**
	* Obtiene todos los projects según las dependencias a graficar.
	*
	* @param array $depdendencyObjs Un array con las dependencias de lso que se buscaran lso proyectos
	* @return array Informacion sobre todos los projects
	*
	*/
	function getProjectsToMap($depdendencyObjs)
	{
		$criteria = new Criteria();
		$criteria->addJoin(TableroProjectPeer::OBJECTIVEID, TableroObjectivePeer::ID, Criteria::INNER_JOIN);
		$criteria->add(TableroProjectPeer::CONSTRUCTION, 1);
		$criteria->add(TableroProjectPeer::LATITUDE, null,Criteria::ISNOTNULL);
		$criteria->add(TableroProjectPeer::LONGITUDE, null,Criteria::ISNOTNULL);

		foreach ($depdendencyObjs as $depdendency) {

 			if (empty($criterion))
				$criterion = $criteria->getNewCriterion(TableroObjectivePeer::AFFILIATEID, $depdendency->getId(), Criteria::NOT_EQUAL);
			else
				$criterion->addOr($criteria->getNewCriterion(TableroObjectivePeer::AFFILIATEID, $depdendency->getId(), Criteria::NOT_EQUAL));

		}
		if (!empty($criterion))
			$criteria->addOr($criterion);

		$projects = TableroProjectPeer::doSelect($criteria);
		return $projects;

	}

} // TableroProjectPeer
