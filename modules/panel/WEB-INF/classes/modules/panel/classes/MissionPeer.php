<?php



/**
 * Skeleton subclass for performing query and update operations on the 'panel_mission' table.
 *
 * Base de Misiones
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.panel.classes
 */
class MissionPeer extends BaseMissionPeer {

	/** the default item name for this class */
	const ITEM_NAME = 'Missions';

	const SUPERVISION    = 1;
	const PREPARATION    = 2;
	const NEGOTIATION    = 3;
	const EVALUATION     = 4;
	const IDENTIFICATION = 5;
	const CLOSING        = 6;

	//nombre de los tipos de garantia
	protected static $missionTypes = array(
						MissionPeer::SUPERVISION     => 'Supervisión',
						MissionPeer::PREPARATION     => 'Preparación',
						MissionPeer::NEGOTIATION     => 'Negociación',
						MissionPeer::EVALUATION      => 'Evaluación',
						MissionPeer::IDENTIFICATION  => 'Identificación',
						MissionPeer::CLOSING         => 'Cierre de Proyecto'
					);

	private $searchString;

	//mapea las condiciones del filtro
	var $filterConditions = array(
					"searchString"=>"setSearchString"
				);

 /**
	 * Especifica una cadena de busqueda.
	 * @param searchString cadena de busqueda.
	 */
	function setSearchString($searchString){
		$this->searchString = $searchString;
	}

	/**
	 * Devuelve los tipos de mision
	 */
	public static function getMissionTypes() {
		$missionTypes = MissionPeer::$missionTypes;
		return $missionTypes;
	}

	/**
	* Obtiene un mission.
	*
	* @param int $id id del mission
	* @return boolean true si se actualizo la informacion correctamente, false sino
	*/
	function get($id){
		$mission = MissionQuery::create()->findPk($id);
		return $mission;
	}

 /**
	* Crea un mission nuevo.
	*
	* @param array $params con los datos del proyecto
	* @return boolean true si se creo el mission correctamente, false sino
	*/
	function create($params,$con = null) {
		$mission = new Mission();
		$mission = Common::setObjectFromParams($mission,$params);
		try {
			$mission->save($con);
			return $mission->getId();
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

	/**
	* Actualiza la informacion de un mission.
	*
	* @param int $id id del mission
	* @param array $params datos del mission
	* @return boolean true si se actualizo la informacion correctamente, false sino
	*/
	function update($id,$params){
		$mission = MissionQuery::create()->findPk($id);
		$mission = Common::setObjectFromParams($mission,$params);
		try {
			$mission->save($con);
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

 /**
	* Elimina un mission a partir de los valores de la clave.
	*
	* @param int $id id del mission
	*	@return boolean true si se elimino correctamente el project, false sino
	*/
	function delete($id){
		$mission = MissionPeer::retrieveByPK($id);
		try {
			$mission->delete();
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

	/**
	* Elimina definitivamente un mission a partir del id.
	*
	* @param int $id Id del mission
	* @return boolean true
	*/
  function hardDelete($id) {
		MissionPeer::disableSoftDelete();
		$mission = MissionPeer::retrieveByPk($id);
		try {
			$mission->forceDelete();
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

 /**
	* Obtiene todos los mission desactivados.
	*
	*	@return array Informacion sobre los mission
	*/
	function getSoftDeleted() {
		$criteria = new Criteria();
		$criteria->add(MissionPeer::DELETED_AT, null, Criteria::ISNOTNULL);
		MissionPeer::disableSoftDelete();
		$missions = MissionPeer::doSelect($criteria);
		return $missions;
  }

	/**
	* Recupera del softdelete un mission
	*
	* @param int $id Id del mission
	* @return boolean true
	*/
  function recoverDeleted($id) {
		MissionPeer::disableSoftDelete();
		$mission = MissionPeer::retrieveByPk($id);
		try {
			$mission->unDelete();
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

 /**
	 * Retorna el criteria generado a partir de los parámetros de búsqueda
	 *
	 * @return criteria $criteria Criteria con parámetros de búsqueda
	 */
	private function getSearchCriteria(){
		$criteria = new Criteria();
		$criteria->setIgnoreCase(true);
		$criteria->addAscendingOrderByColumn(MissionPeer::ID);

		if ($this->searchString)
			$criteria->add(MissionPeer::DESCRIPTION,"%" . $this->searchString . "%",Criteria::LIKE);

		return $criteria;

	}

 /**
	* Obtiene todos los mission paginados segun la condicion de busqueda ingresada.
	*
	* @param int $page [optional] Numero de pagina actual
	* @param int $perPage [optional] Cantidad de filas por pagina
	* @return array Informacion sobre todos los projects
	*/
	function getAllPaginatedFiltered($page=1,$perPage=-1)	{
		if ($perPage == -1)
			$perPage = Common::getRowsPerPage();
		if (empty($page))
			$page = 1;
		$criteria = $this->getSearchCriteria();
		$pager = new PropelPager($criteria,"MissionPeer", "doSelect",$page,$perPage);
		return $pager;
	}

 /**
	* Obtiene todos los mission paginados segun la condicion de busqueda ingresada.
	*
	* @param int $page [optional] Numero de pagina actual
	* @param int $perPage [optional] Cantidad de filas por pagina
	* @return array Informacion sobre todos los projects
	*/
	function getIncludeGetAllPaginatedFiltered()	{
		$criteria = MissionQuery::create()
								->orderByStartdate('desc')
								->orderByFinishdate('desc')
								->setLimit(8);
		$pager = new PropelPager($criteria,"MissionPeer", "doSelect",1,8);
		return $pager;
	}

} // MissionPeer
