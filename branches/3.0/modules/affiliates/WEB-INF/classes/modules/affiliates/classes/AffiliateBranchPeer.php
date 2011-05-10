<?php



/**
 * Skeleton subclass for performing query and update operations on the 'affiliates_branch' table.
 *
 * Sucursales de Afiliados
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.affiliates.classes
 */
class AffiliateBranchPeer extends BaseAffiliateBranchPeer {

	private $searchAffiliateId;

	//mapea las condiciones del filtro
	var $filterConditions = array(
		"searchAffiliateId"=>"setSearchAffiliateId",
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
		$branchObj = AffiliateBranchPeer::retrieveByPK($id);
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
		return AffiliateBranchQuery::create()->filterByPrimaryKey($id)->delete();
	}

	/**
	* Obtiene la informacion de un branch.
	*
	* @param int $id id del branch
	* @return array Informacion del branch
	*/
	function get($id) {
		return AffiliateBranchQuery::create()->findPk($id);
	}

	/**
	* Obtiene todos los branchs.
	*
	*	@return array Informacion sobre todos los branchs
	*/
	function getAll() {
		return AffiliateBranchQuery::create()->find();
	}

	/**
	* Obtiene un branch a partir de su number.
	*
	* @param int $number Numero de branch
	* @param int $affiliateId Id del affiliate
	*	@return Branch Branch
	*/
	function getByNumber($number, $affiliateId) {
		return AffiliateBranchQuery::create()->filterByNumber($number)
										 ->filterByAffiliateId($affiliateId)
										 ->findOne();
	}

	/**
	* Obtiene todos los branchs de un affiliate.
	*
	* @param int $affiliateId Id del affiliate
	*	@return array Informacion sobre todos los branchs
	*/
	function getAllByAffiliateId($affiliateId) {
		return AffiliateBranchQuery::create()->filterByAffiliateId($affiliateId)->find();
	}

	/**
	* Obtiene todos los branchs de un affiliate.
	*
	* @param int $affiliateId Id del affiliate
	*	@return array Informacion sobre todos los branchs
	*/
	function getByCode($code) {
		return AffiliateBranchQuery::create()->filterByCode($code)->findOne();
	}

	function setSearchAffiliateId($affiliateId) {
		$this->searchAffiliateId = $affiliateId;
	}

	/**
	 * Retorna el criteria generado a partir de lso par�metros de b�squeda
	 *
	 * @return criteria $criteria Criteria con par�metros de b�squeda
	 */
	private function getSearchCriteria() {
		$criteria = new AffiliateBranchQuery();
		$criteria->setIgnoreCase(true);
		$criteria->orderById();

			if (!empty($this->searchAffiliateId))
				$criteria->filterByAffiliateId($this->searchAffiliateId);

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

		$pager = new PropelPager($cond,"AffiliateBranchPeer","doSelect",$page,$perPage);
		return $pager;
	}

} // AffiliateBranchPeer
