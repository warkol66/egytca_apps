<?php



/**
 * Skeleton subclass for performing query and update operations on the 'headlines_headline' table.
 *
 * Headline
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.headlines.classes
 */
class HeadlinePeer extends BaseHeadlinePeer {

	/** the default item name for this class */
	const ITEM_NAME = 'Headlines';

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
	* Obtiene un headline.
	*
	* @param int $id id del headline
	* @return boolean true si se actualizo la informacion correctamente, false sino
	*/
	function get($id){
		$headline = HeadlineQuery::create()->findPk($id);
		return $headline;
	}

 /**
	* Crea un headline nuevo.
	*
	* @param array $params con los datos del proyecto
	* @return boolean true si se creo el headline correctamente, false sino
	*/
	function create($params,$con = null) {
		$headline = new Headline();
		$headline = Common::setObjectFromParams($headline,$params);
		try {
			$headline->save($con);
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

	/**
	* Actualiza la informacion de un headline.
	*
	* @param int $id id del headline
	* @param array $params datos del headline
	* @return boolean true si se actualizo la informacion correctamente, false sino
	*/
	function update($id,$params){
		$headline = HeadlineQuery::create()->findPk($id);
		$headline = Common::setObjectFromParams($headline,$params);
		try {
			$headline->save($con);
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

 /**
	* Elimina un headline a partir de los valores de la clave.
	*
	* @param int $id id del headline
	*	@return boolean true si se elimino correctamente el project, false sino
	*/
	function delete($id){
		$headline = HeadlinePeer::retrieveByPK($id);
		try {
			$headline->delete();
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

	/**
	* Elimina definitivamente un headline a partir del id.
	*
	* @param int $id Id del headline
	* @return boolean true
	*/
  function hardDelete($id) {
		HeadlinePeer::disableSoftDelete();
		$headline = HeadlinePeer::retrieveByPk($id);
		try {
			$headline->forceDelete();
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

 /**
	* Obtiene todos los headline desactivados.
	*
	*	@return array Informacion sobre los headline
	*/
	function getSoftDeleted() {
		$criteria = new Criteria();
		$criteria->add(HeadlinePeer::DELETED_AT, null, Criteria::ISNOTNULL);
		HeadlinePeer::disableSoftDelete();
		$headlines = HeadlinePeer::doSelect($criteria);
		return $headlines;
  }

	/**
	* Recupera del softdelete un headline
	*
	* @param int $id Id del headline
	* @return boolean true
	*/
  function recoverDeleted($id) {
		HeadlinePeer::disableSoftDelete();
		$headline = HeadlinePeer::retrieveByPk($id);
		try {
			$headline->unDelete();
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
		$criteria->addAscendingOrderByColumn(HeadlinePeer::ID);

		if ($this->searchString){
			$criteria->add(HeadlinePeer::ISSUE,"%" . $this->searchString . "%",Criteria::LIKE);
			$criterionContent = $criteria->getNewCriterion(HeadlinePeer::CONTENT,"%" . $this->searchString . "%",Criteria::LIKE);
			$criteria->addOr($criterionContent);
		}

		return $criteria;

	}

 /**
	* Obtiene todos los headline paginados segun la condicion de busqueda ingresada.
	*
	* @param int $page [optional] Numero de pagina actual
	* @param int $perPage [optional] Cantidad de filas por pagina
	* @return array Informacion sobre todos los headlines
	*/
	function getAllPaginatedFiltered($page=1,$perPage=-1)	{
		if ($perPage == -1)
			$perPage = Common::getRowsPerPage();
		if (empty($page))
			$page = 1;
		$criteria = $this->getSearchCriteria();
		$pager = new PropelPager($criteria,"HeadlinePeer", "doSelect",$page,$perPage);
		return $pager;
	}

 /**
	* Obtiene todos los headline paginados segun la condicion de busqueda ingresada.
	*
	* @return array Informacion sobre todos los headlines
	*/
	function getAll()	{
		$criteria = $this->getSearchCriteria();
		$allObjects = HeadlinePeer::doSelect($criteria);
		return $allObjects;
	}

} // HeadlinePeer
