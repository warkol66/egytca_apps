<?php



/**
 * Skeleton subclass for performing query and update operations on the 'medias_market' table.
 *
 * Tipo de medios
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.medias.classes
 */
class MediaMarketPeer extends BaseMediaMarketPeer {

	/** the default item name for this class */
	const ITEM_NAME = 'Media Markets';

	private $searchString;
	private $perPage;
	private $limit;
	private $includeDeleted;

	//mapea las condiciones del filtro
	var $filterConditions = array(
					"searchString"=>"setSearchString",
					"perPage"=>"setPerPage",
					"limit" => "setLimit",
					'includeDeleted' => 'setIncludeDeleted'
				);

 /**
	 * Especifica una cadena de busqueda.
	 * @param searchString cadena de busqueda.
	 */
	function setSearchString($searchString){
		$this->searchString = $searchString;
	}
	
 /**
	 * Especifica cantidad de resultados por pagina.
	 * @param perPage integer cantidad de resultados por pagina.
	 */
	function setPerPage($perPage){
		$this->perPage = $perPage;
	}

 	/**
	 * Especifica una cantidad maxima de registros.
	 * @param limit cantidad maxima de registros.
	 */
	function setLimit($limit){
		$this->limit = $limit;
	}
	
	/**
	 * Especifica si se incluyen los eliminados
	 * @param bool includeDeleted, indica si se incluyen los elimindos
	 */
	function setIncludeDeleted($includeDeleted){
		$this->includeDeleted = $includeDeleted;
	}

	/**
	* Obtiene un actor.
	*
	* @param int $id id del actor
	* @return boolean true si se actualizo la informacion correctamente, false sino
	*/
	function get($id){
		return MediaMarketQuery::create()->findPk($id);
	}

	/**
	* Elimina definitivamente un mediaMarket a partir del id.
	*
	* @param int $id Id del mediaMarket
	* @return boolean true
	*/
  function hardDelete($id) {
		MediaMarketPeer::disableSoftDelete();
		$mediaMarket = MediaMarketPeer::retrieveByPk($id);
		try {
			$mediaMarket->forceDelete();
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

 /**
	 * Retorna el criteria generado a partir de los parametros de busqueda
	 *
	 * @return criteria $criteria Criteria con parametros de busqueda
	 */
	private function getSearchCriteria() {
		$criteria = new Criteria();
		$criteria->setIgnoreCase(true);
		$criteria->setLimit($this->limit);
		$criteria->addAscendingOrderByColumn(MediaMarketPeer::ID);
		
		if ($this->includeDeleted)
			MediaMarketPeer::disableSoftDelete();

		if ($this->searchString) {
			$criteria->add(MediaMarketPeer::NAME,"%" . $this->searchString . "%",Criteria::LIKE);
			$criterionSurname = $criteria->getNewCriterion(MediaMarketPeer::SURNAME,"%" . $this->searchString . "%",Criteria::LIKE);
			$criteria->addOr($criterionSurname);
			$criterionInstitution = $criteria->getNewCriterion(MediaMarketPeer::INSTITUTION,"%" . $this->searchString . "%",Criteria::LIKE);
			$criteria->addOr($criterionInstitution);
		}

		return $criteria;

	}

	/**
	* Obtiene la cantidad de filas por pagina por defecto en los listado paginados.
	*
	* @return int Cantidad de filas por pagina
	*/
	function getRowsPerPage() {
		if (!isset($this->perPage))
			$this->perPage = Common::getRowsPerPage();
		return $this->perPage;
	}

 /**
	* Obtiene todos los actor paginados segun la condicion de busqueda ingresada.
	*
	* @param int $page [optional] Numero de pagina actual
	* @param int $perPage [optional] Cantidad de filas por pagina
	* @return array Informacion sobre todos los actores
	*/
	function getAllPaginatedFiltered($page=1,$perPage=-1)	{
		if ($perPage == -1)
			$perPage = $this->getRowsPerPage();
		if (empty($page))
			$page = 1;
		$criteria = $this->getSearchCriteria();
		$pager = new PropelPager($criteria,"MediaMarketPeer", "doSelect",$page,$perPage);
		return $pager;
	}

	/**
	* Obtiene todos los MediaMarket existentes filtrados por la condicion $this->getSearchCriteria()
	* @return PropelObjectCollection Todos los MediaMarket
	*/
	function getAll() {
    $criteria = $this->getSearchCriteria();    
		return MediaMarketPeer::doSelect($criteria);
	}

} // MediaMarketPeer
