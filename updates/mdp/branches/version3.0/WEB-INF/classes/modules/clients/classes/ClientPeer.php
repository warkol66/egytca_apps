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

	private $searchName;

	//mapea las condiciones del filtro
	var $filterConditions = array(
		"searchName"=>"setSearchName",
	);

	public function setSearchName($name) {
		$this->searchName = $name;
	}

	function getAll() {
		$cond = new Criteria();
		$todosObj = ClientPeer::doSelect($cond);
		return $todosObj;
	}

	function getAllPaginated($page=1,$perPage=-1) {
		if ($perPage == -1)
			$perPage = Common::getRowsPerPage();
		if (empty($page))
			$page = 1;
		$cond = new Criteria();
		$cond->addAscendingOrderByColumn(ClientPeer::ID);

		$pager = new PropelPager($cond,"ClientPeer", "doSelect",$page,$perPage);
		return $pager;
	}

	function getByNamePaginated($name,$page=1,$perPage=-1) {
		if ($perPage == -1)
			$perPage = Common::getRowsPerPage();
		if (empty($page))
			$page = 1;
		$cond = new Criteria();
		$cond->add(ClientPeer::NAME,"%".$name."%",Criteria::LIKE);
		$cond->addAscendingOrderByColumn(ClientPeer::ID);

		$pager = new PropelPager($cond,"ClientPeer", "doSelect",$page,$perPage);
		return $pager;
	}

	function get($id) {
		$client = ClientPeer::retrieveByPK($id);
		return $client;
	}

	function getByName($name) {
		return ClientQuery::create()->setIgnoreCase(true)->filterByName($name)->findOne();
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

	function getByInternalNumber($internalNumber) {
		return ClientQuery::create()->filterByInternalNumber($internalNumber)->findOne();
	}

	/**
	 * Retorna el criteria generado a partir de lso parámetros de búsqueda
	 *
	 * @return criteria $criteria Criteria con parámetros de búsqueda
	 */
	private function getSearchCriteria() {
		$criteria = new ClientQuery();
		$criteria->setIgnoreCase(true);
		$criteria->orderById();

		if (!empty($this->searchName))
			$criteria->filterByName('%'.$this->searchName.'%', Criteria::LIKE);

		return $criteria;
	}

	/**
	* Obtiene todos los clientes paginados segun la condicion de busqueda ingresada.
	*
	* @param int $page [optional] Numero de pagina actual
	* @param int $perPage [optional] Cantidad de filas por pagina
	* @return array Informacion sobre todos los clientes
	*/
	function getSearchPaginated($page=1,$perPage=-1) {
		if ($perPage == -1)
			$perPage = Common::getRowsPerPage();
		if (empty($page))
			$page = 1;
		$cond = $this->getSearchCriteria();
		$pager = new PropelPager($cond,"ClientPeer", "doSelect",$page,$perPage);
		return $pager;
	}

} // ClientPeer
