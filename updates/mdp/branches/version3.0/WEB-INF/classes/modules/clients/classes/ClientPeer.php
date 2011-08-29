<?php



/**
 * Skeleton subclass for performing query and update operations on the 'clients_client' table.
 *
 * Clientes
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.clients.classes
 */
class ClientPeer extends BaseClientPeer {

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
	* Obtiene todos los clients existentes filtrados por $this->getSearchCriteria()
	* @return PropelObjectCollection Todos los clients
	*/
	function getAll() {
    $criteria = $this->getSearchCriteria();
		return ClientPeer::doSelect($criteria);
	}

 /**
	* Obtiene todos los client paginados segun la condicion de busqueda ingresada.
	*
	* @param int $page [optional] Numero de pagina actual
	* @param int $perPage [optional] Cantidad de filas por pagina
	* @return array Informacion sobre todos los client
	*/
	function getAllPaginatedFiltered($page=1,$perPage=-1)	{
		if ($perPage == -1)
			$perPage = $this->getRowsPerPage();
		if (empty($page))
			$page = 1;
		$criteria = $this->getSearchCriteria();
		$pager = new PropelPager($criteria,"ClientPeer", "doSelect",$page,$perPage);
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
	* Obtiene un client.
	*
	* @param int $id id del issue
	* @return boolean true si se actualizo la informacion correctamente, false sino
	*/
	function get($id) {
		$client = ClientPeer::retrieveByPK($id);
		return $client;
	}

	/**
	 * Retorna el criteria generado a partir de los parámetros de búsqueda
	 *
	 * @return criteria $criteria Criteria con parámetros de búsqueda
	 */
	private function getSearchCriteria() {
		$criteria = new ClientQuery();
		$criteria->setLimit($this->limit);
		$criteria->setIgnoreCase(true);
		$criteria->orderById();

		if ($this->searchString)
			$criteria->filterByName('%'.$this->searchString.'%', Criteria::LIKE);

		if ($this->internalNumber)
			$criteria->filterByInternalNumber($this->internalNumber);

		return $criteria;
	}








	function update($id,$params) {
		$client = ClientPeer::retrieveByPK($id);
		Common::setObjectFromParams($client, $params);
		if ($client->save())
			return $client;
		return true;
	}

	function delete($id) {
		ClientQuery::create()->filterByPrimaryKey($id)->delete();
		return true;
	}

	function create($params) {
		$client = new Client();
		Common::setObjectFromParams($client, $params);
		if ($client->save())
			return $client;
		return true;
	}

} // ClientPeer
