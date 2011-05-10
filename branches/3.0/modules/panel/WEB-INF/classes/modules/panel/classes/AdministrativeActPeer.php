<?php



/**
 * Skeleton subclass for performing query and update operations on the 'panel_administrativeAct' table.
 *
 * Base de Actos Administrativos
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.panel.classes
 */
class AdministrativeActPeer extends BaseAdministrativeActPeer {

	/** the default item name for this class */
	const ITEM_NAME = 'Administrative Acts';

	const CONTRACT             = 1;
	const ARRANGEMENT          = 2;
	const AGREEMENT            = 3;
	const PARTIES_COMMITMENT   = 4;
	const INTEREST_EXPRESSION  = 5;
	const WORK_PLAN            = 6;
	const RESOLUTION           = 7;
	const NO_OBJECTION         = 8;
	
	//nombre de los tipos de garantia
	protected static $administrativeActTypes = array(
						AdministrativeActPeer::CONTRACT             => 'Firma de Contrato',
						AdministrativeActPeer::ARRANGEMENT          => 'Convenio',
						AdministrativeActPeer::AGREEMENT            => 'Acuerdo',
						AdministrativeActPeer::PARTIES_COMMITMENT   => 'Compromiso de partes',
						AdministrativeActPeer::INTEREST_EXPRESSION  => 'Manifestación de Interés',
						AdministrativeActPeer::WORK_PLAN            => 'Plan de Trabajo',
						AdministrativeActPeer::RESOLUTION           => 'Resolución',
						AdministrativeActPeer::NO_OBJECTION         => 'No Objeción'
					);

	private $searchString;
	private $searchType;
	private $searchProjectId;

	//mapea las condiciones del filtro
	var $filterConditions = array(
					"searchString"=>"setSearchString",
					"searchTtype"=>"setSearchType",
					"searchProjectId"=>"setProjectId"
				);

 /**
	 * Especifica una cadena de busqueda.
	 * @param searchString cadena de busqueda.
	 */
	function setSearchString($searchString){
		$this->searchString = $searchString;
	}

 /**
	 * Especifica una cadena de busqueda.
	 * @param searchString cadena de busqueda.
	 */
	function setSearchType($searchTtype){
		$this->searchTtype = $searchTtype;
	}

 /**
	 * Especifica una cadena de busqueda.
	 * @param searchString cadena de busqueda.
	 */
	function setProjectId($searchProjectId){
		$this->searchProjectId = $searchProjectId;
	}
	/**
	 * Devuelve los tipos de actos administrativos
	 */
	public static function getAdministrativeActTypes() {
		$administrativeActTypes = AdministrativeActPeer::$administrativeActTypes;
		return $administrativeActTypes;
	}

	/**
	* Obtiene un administrativeAct.
	*
	* @param int $id id del administrativeAct
	* @return boolean true si se actualizo la informacion correctamente, false sino
	*/
	function get($id){
		$administrativeAct = AdministrativeActQuery::create()->findPk($id);
		return $administrativeAct;
	}

 /**
	* Crea un administrativeAct nuevo.
	*
	* @param array $params con los datos del proyecto
	* @return boolean true si se creo el administrativeAct correctamente, false sino
	*/
	function create($params,$con = null) {
		$administrativeAct = new AdministrativeAct();
		$administrativeAct = Common::setObjectFromParams($administrativeAct,$params);
		try {
			$administrativeAct->save($con);
			return $administrativeAct->getId();
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

	/**
	* Actualiza la informacion de un administrativeAct.
	*
	* @param int $id id del administrativeAct
	* @param array $params datos del administrativeAct
	* @return boolean true si se actualizo la informacion correctamente, false sino
	*/
	function update($id,$params){
		$administrativeAct = AdministrativeActQuery::create()->findPk($id);
		$administrativeAct = Common::setObjectFromParams($administrativeAct,$params);
		try {
			$administrativeAct->save($con);
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

 /**
	* Elimina un administrativeAct a partir de los valores de la clave.
	*
	* @param int $id id del administrativeAct
	*	@return boolean true si se elimino correctamente el project, false sino
	*/
	function delete($id){
		$administrativeAct = AdministrativeActPeer::retrieveByPK($id);
		try {
			$administrativeAct->delete();
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

	/**
	* Elimina definitivamente un administrativeAct a partir del id.
	*
	* @param int $id Id del administrativeAct
	* @return boolean true
	*/
  function hardDelete($id) {
		AdministrativeActPeer::disableSoftDelete();
		$administrativeAct = AdministrativeActPeer::retrieveByPk($id);
		try {
			$administrativeAct->forceDelete();
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

 /**
	* Obtiene todos los administrativeAct desactivados.
	*
	*	@return array Informacion sobre los administrativeAct
	*/
	function getSoftDeleted() {
		$criteria = new Criteria();
		$criteria->add(AdministrativeActPeer::DELETED_AT, null, Criteria::ISNOTNULL);
		AdministrativeActPeer::disableSoftDelete();
		$administrativeActs = AdministrativeActPeer::doSelect($criteria);
		return $administrativeActs;
  }

	/**
	* Recupera del softdelete un administrativeAct
	*
	* @param int $id Id del administrativeAct
	* @return boolean true
	*/
  function recoverDeleted($id) {
		AdministrativeActPeer::disableSoftDelete();
		$administrativeAct = AdministrativeActPeer::retrieveByPk($id);
		try {
			$administrativeAct->unDelete();
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
		$criteria->addDescendingOrderByColumn(AdministrativeActPeer::ACTDATE);

		if ($this->searchString) {
			$criteria->add(AdministrativeActPeer::OBJECT,"%" . $this->searchString . "%",Criteria::LIKE);
			$criterionDescription = $criteria->getNewCriterion(AdministrativeActPeer::DESCRIPTION,"%" . $this->searchString . "%",Criteria::LIKE);
			$criteria->addOr($criterionDescription);
		}
		return $criteria;

	}

 /**
	* Obtiene todos los administrativeAct paginados segun la condicion de busqueda ingresada.
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
		$pager = new PropelPager($criteria,"AdministrativeActPeer", "doSelect",$page,$perPage);
		return $pager;
	}

  /**
  * Obtiene los actos administrativos para incluir en los resumenes
  *
  *	@return array actos administrativos para incluir en los resumenes
  */
  public function getIncludeAdministrativeActsList($options) {
  	if ($options["limit"])
  		$limit = $options["limit"];
  	else
  		$limit = 5;

		$administrativeActs = AdministrativeActQuery::create()
				->orderByActdate(CRITERIA::DESC)
				->limit($limit)
				->find();
    return $administrativeActs;
  }

} // AdministrativeActPeer
