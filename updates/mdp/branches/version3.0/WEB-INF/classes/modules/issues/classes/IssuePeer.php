<?php



/**
 * Skeleton subclass for performing query and update operations on the 'issues_issue' table.
 *
 * Asuntos
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.issues.classes
 */
class IssuePeer extends BaseIssuePeer {

	/** the default item name for this class */
	const ITEM_NAME = 'Issues';

	private $searchString;
	private $limit;

	//mapea las condiciones del filtro
	var $filterConditions = array(
					"searchString"=>"setSearchString",
					"limit" => "setLimit"
				);

 /**
	 * Especifica una cadena de busqueda.
	 * @param searchString cadena de busqueda.
	 */
	function setSearchString($searchString){
		$this->searchString = $searchString;
	}
	
 	/**
	 * Especifica una cantidad maxima de registros.
	 * @param limit cantidad maxima de registros.
	 */
	function setLimit($limit){
		$this->limit = $limit;
	}
	
	/**
	* Obtiene un issue.
	*
	* @param int $id id del issue
	* @return boolean true si se actualizo la informacion correctamente, false sino
	*/
	function get($id){
		$issue = IssueQuery::create()->findPk($id);
		return $issue;
	}

 /**
	* Crea un issue nuevo.
	*
	* @param array $params con los datos del proyecto
	* @return boolean true si se creo el issue correctamente, false sino
	*/
	function create($params,$con = null) {
		$issue = new Issue();
		$issue = Common::setObjectFromParams($issue,$params);
		try {
			$issue->save($con);
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

	/**
	* Actualiza la informacion de un issue.
	*
	* @param int $id id del issue
	* @param array $params datos del issue
	* @return boolean true si se actualizo la informacion correctamente, false sino
	*/
	function update($id,$params){
		$issue = IssueQuery::create()->findPk($id);
		$issue = Common::setObjectFromParams($issue,$params);
		try {
			$issue->save($con);
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

 /**
	* Elimina un issue a partir de los valores de la clave.
	*
	* @param int $id id del issue
	*	@return boolean true si se elimino correctamente el project, false sino
	*/
	function delete($id){
		$issue = IssuePeer::retrieveByPK($id);
		try {
			$issue->delete();
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

	/**
	* Elimina definitivamente un issue a partir del id.
	*
	* @param int $id Id del issue
	* @return boolean true
	*/
  function hardDelete($id) {
		IssuePeer::disableSoftDelete();
		$issue = IssuePeer::retrieveByPk($id);
		try {
			$issue->forceDelete();
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

 /**
	* Obtiene todos los issue desactivados.
	*
	*	@return array Informacion sobre los issue
	*/
	function getSoftDeleted() {
		$criteria = new Criteria();
		$criteria->add(IssuePeer::DELETED_AT, null, Criteria::ISNOTNULL);
		IssuePeer::disableSoftDelete();
		$issues = IssuePeer::doSelect($criteria);
		return $issues;
  }

	/**
	* Recupera del softdelete un issue
	*
	* @param int $id Id del issue
	* @return boolean true
	*/
  function recoverDeleted($id) {
		IssuePeer::disableSoftDelete();
		$issue = IssuePeer::retrieveByPk($id);
		try {
			$issue->unDelete();
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

 /**
	 * Retorna el criteria generado a partir de los par?metros de b?squeda
	 *
	 * @return criteria $criteria Criteria con par?metros de b?squeda
	 */
	private function getSearchCriteria(){
		$criteria = new Criteria();
		$criteria->setIgnoreCase(true);
		$criteria->setLimit($this->limit);
		$criteria->addAscendingOrderByColumn(IssuePeer::ID);

		if ($this->searchString){
			$criteria->add(IssuePeer::ISSUE,"%" . $this->searchString . "%",Criteria::LIKE);
			$criterionContent = $criteria->getNewCriterion(IssuePeer::CONTENT,"%" . $this->searchString . "%",Criteria::LIKE);
			$criteria->addOr($criterionContent);
		}

		return $criteria;

	}

 /**
	* Obtiene todos los issue paginados segun la condicion de busqueda ingresada.
	*
	* @param int $page [optional] Numero de pagina actual
	* @param int $perPage [optional] Cantidad de filas por pagina
	* @return array Informacion sobre todos los issues
	*/
	function getAllPaginatedFiltered($page=1,$perPage=-1)	{
		if ($perPage == -1)
			$perPage = Common::getRowsPerPage();
		if (empty($page))
			$page = 1;
		$criteria = $this->getSearchCriteria();
		$pager = new PropelPager($criteria,"IssuePeer", "doSelect",$page,$perPage);
		return $pager;
	}

 /**
	* Obtiene todos los issue paginados segun la condicion de busqueda ingresada.
	*
	* @return array Informacion sobre todos los issues
	*/
	function getAll()	{
		$criteria = $this->getSearchCriteria();
		$allObjects = IssuePeer::doSelect($criteria);
		return $allObjects;
	}

} // IssuePeer
