<?php



/**
 * Skeleton subclass for performing query and update operations on the 'clients_branch' table.
 *
 * Sucursales de Clientes
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.clients.classes
 */
class ClientBranchPeer extends BaseClientBranchPeer {

	private $searchClientId;

	//mapea las condiciones del filtro
	var $filterConditions = array(
		"searchClientId"=>"setSearchClientId",
	);

	/**
	* Crea un branch nuevo.
	*
	* @param $params parametros del branch nuevo.
	* @return boolean true si se creo el branch correctamente, false sino
	*/
	function create($params) {
			$branchObj = new Branch();
			Common::setObjectFromParams($branchObj, $params);
			return $branchObj->save();
	}

	/**
	* Actualiza la informacion de un branch.
	*
	* @param int $id id del branch
	* @param array $params parametros del branch
	* @return boolean true si se actualizo la informacion correctamente, false sino
	*/
	function update($id, $params) {
		$branchObj = ClientBranchPeer::retrieveByPK($id);
		Common::setObjectFromParams($branchObj, $params);
		return $branchObj->save();
	}

	/**
	* Elimina un branch a partir de los valores de la clave.
	*
		* @param int $id id del branch
	* @return cantidad de registros eliminados
	*/
	function delete($id) {
		return ClientBranchQuery::create()->filterByPrimaryKey($id)->delete();
	}

	/**
	* Obtiene la informacion de un branch.
	*
	* @param int $id id del branch
	* @return array Informacion del branch
	*/
	function get($id) {
		return ClientBranchQuery::create()->findPk($id);
	}

	/**
	* Obtiene todos los branchs.
	*
	*	@return array Informacion sobre todos los branchs
	*/
	function getAll() {
		return ClientBranchQuery::create()->find();
	}

	/**
	* Obtiene un branch a partir de su number.
	*
	* @param int $number Numero de branch
	* @param int $clientId Id del client
	*	@return Branch Branch
	*/
	function getByNumber($number, $clientId) {
		return ClientBranchQuery::create()->filterByNumber($number)
										 ->filterByClientId($clientId)
										 ->findOne();
	}

	/**
	* Obtiene todos los branchs de un client.
	*
	* @param int $clientId Id del client
	*	@return array Informacion sobre todos los branchs
	*/
	function getAllByClientId($clientId) {
		return ClientBranchQuery::create()->filterByClientId($clientId)->find();
	}

	/**
	* Obtiene todos los branchs de un client.
	*
	* @param int $clientId Id del client
	*	@return array Informacion sobre todos los branchs
	*/
	function getByCode($code) {
		return ClientBranchQuery::create()->filterByCode($code)->findOne();
	}

	function setSearchClientId($clientId) {
		$this->searchClientId = $clientId;
	}

	/**
	 * Retorna el criteria generado a partir de lso par�metros de b�squeda
	 *
	 * @return criteria $criteria Criteria con par�metros de b�squeda
	 */
	private function getSearchCriteria() {
		$criteria = new ClientBranchQuery();
		$criteria->setIgnoreCase(true);
		$criteria->orderById();

			if (!empty($this->searchClientId))
				$criteria->filterByClientId($this->searchClientId);

		return $criteria;
	}

	/**
	* Obtiene una busqueda paginada.
	*
	* @param int $page [optional] Numero de pagina actual
	* @param int $perPage [optional] Cantidad de filas por pagina
	* @return Pager Pager con informacion sobre los branchs
	*/
	function getSearchPaginated($page=1,$perPage=-1) {
		if ($perPage == -1)
			$perPage = Common::getRowsPerPage();
		if (empty($page))
			$page = 1;
		$cond = $this->getSearchCriteria();

		$pager = new PropelPager($cond,"ClientBranchPeer","doSelect",$page,$perPage);
		return $pager;
	}

} // ClientBranchPeer
