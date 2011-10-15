<?php



/**
 * Skeleton subclass for performing query and update operations on the 'affiliates_verifier' table.
 *
 * Verificadoras
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.affiliates.classes
 */
class VerifierPeer extends BaseVerifierPeer {

	private $searchString;
	private $internalNumber;
	private $perPage;
	private $limit;

	//mapea las condiciones del filtro
	var $filterConditions = array(
					"searchString"=>"setSearchString",
					"internalNumber"=>"setInternalNumber",
					"perPage"=>"setPerPage",
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
	 * Especifica un internalNumber
	 * @param internalNumber busqueda por internalNumber
	 */
	function setInternalNumber($internalNumber){
		$this->internalNumber = $internalNumber;
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
	* Obtiene todos los verifier existentes filtrados por $this->getSearchCriteria()
	* @return PropelObjectCollection Todos los verifiers
	*/
	function getAll() {
		$criteria = $this->getSearchCriteria();
		return VerifierPeer::doSelect($criteria);
	}

 /**
	* Obtiene todos los verifier paginados segun la condicion de busqueda ingresada.
	*
	* @param int $page [optional] Numero de pagina actual
	* @param int $perPage [optional] Cantidad de filas por pagina
	* @return array Informacion sobre todos los verifier
	*/
	function getAllPaginatedFiltered($page=1,$perPage=-1)	{
		if ($perPage == -1)
			$perPage = $this->getRowsPerPage();
		if (empty($page))
			$page = 1;
		$criteria = $this->getSearchCriteria();
		$pager = new PropelPager($criteria,"VerifierPeer", "doSelect",$page,$perPage);
		return $pager;
	}

	/**
	* Obtiene la cantidad de filas por pagina por defecto en los listado paginados.
	* @return int Cantidad de filas por pagina
	*/
	function getRowsPerPage() {
		if (!isset($this->perPage))
			$this->perPage = Common::getRowsPerPage();
		return $this->perPage;
	}

	/**
	* Obtiene un verifier.
	* @param int $id id del afiliado
	* @return object verifier
	*/
	function get($id) {
		return VerifierQuery::create()->findOneById($id);
	}

	/**
	 * Retorna el criteria generado a partir de los parámetros de búsqueda
	 * @return criteria $criteria Criteria con parámetros de búsqueda
	 */
	private function getSearchCriteria() {
		$criteria = new VerifierQuery();
		$criteria->setLimit($this->limit);
		$criteria->setIgnoreCase(true);
		$criteria->orderById();

		if ($this->searchString)
			$criteria->filterByName('%'.$this->searchString.'%', Criteria::LIKE);

		if ($this->internalNumber)
			$criteria->filterByInternalNumber($this->internalNumber);

		return $criteria;
	}

	function delete($id) {
		VerifierQuery::create()->findOneById($id)->delete();
		return true;
	}

} // VerifierPeer
