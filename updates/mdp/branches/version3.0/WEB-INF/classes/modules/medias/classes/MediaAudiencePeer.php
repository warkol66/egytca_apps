<?php



/**
 * Skeleton subclass for performing query and update operations on the 'medias_audience' table.
 *
 * Tipo de medios
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.medias.classes
 */
class MediaAudiencePeer extends BaseMediaAudiencePeer {

	/** the default item name for this class */
	const ITEM_NAME = 'Media Markets';

	private $searchString;
	private $perPage;
	private $limit;
	private $orderByName;
	private $includeDeleted;

	//mapea las condiciones del filtro
	var $filterConditions = array(
					"searchString"=>"setSearchString",
					"orderByName"=>"setOrderByName",
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
	 * Especifica si ordena los resultados por nombre
	 * @param orderByName tipo de orden "asc" o "desc"
	 */
	function setOrderByName($orderByName){
		$this->orderByName = $orderByName;
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
		return MediaAudienceQuery::create()->findPk($id);
	}

 /**
	 * Retorna el criteria generado a partir de los parametros de busqueda
	 *
	 * @return criteria $criteria Criteria con parametros de busqueda
	 */
	private function getSearchCriteria() {
		$criteria = MediaAudienceQuery::create();

		$criteria->setIgnoreCase(true);
		$criteria->setLimit($this->limit);
		
		if (isset($this->orderByName) && $this->orderByName == "asc")
			$criteria->orderByName();
		else if (isset($this->orderByName) && $this->orderByName == "desc")
			$criteria->orderByName(Criteria::DESC);
		else
			$criteria->orderById();

		if ($this->includeDeleted)
			MediaAudiencePeer::disableSoftDelete();

		if ($this->searchString)
			$criteria->add(MediaAudiencePeer::NAME,"%" . $this->searchString . "%",Criteria::LIKE);

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
		$pager = new PropelPager($criteria,"MediaAudiencePeer", "doSelect",$page,$perPage);
		return $pager;
	}

	/**
	* Obtiene todos los MediaAudience existentes filtrados por la condicion $criteria
	* @return PropelObjectCollection Todos los MediaAudience
	*/
	function getAll($criteria = null) {
		return MediaAudiencePeer::doSelect($criteria);
	}

} // MediaAudiencePeer
