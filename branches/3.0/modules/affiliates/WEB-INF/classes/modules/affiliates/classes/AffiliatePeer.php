<?php



/**
 * Skeleton subclass for performing query and update operations on the 'affiliates_affiliate' table.
 *
 * Afiliados
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.affiliates.classes
 */
class AffiliatePeer extends BaseAffiliatePeer {

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
		$todosObj = AffiliatePeer::doSelect($cond);
		return $todosObj;
	}

	function getAllPaginated($page=1,$perPage=-1) {
		if ($perPage == -1)
			$perPage = Common::getRowsPerPage();
		if (empty($page))
			$page = 1;
		$cond = new Criteria();
		$cond->addAscendingOrderByColumn(AffiliatePeer::ID);

		$pager = new PropelPager($cond,"AffiliatePeer", "doSelect",$page,$perPage);
		return $pager;
	}

	function getByNamePaginated($name,$page=1,$perPage=-1) {
		if ($perPage == -1)
			$perPage = Common::getRowsPerPage();
		if (empty($page))
			$page = 1;
		$cond = new Criteria();
		$cond->add(AffiliatePeer::NAME,"%".$name."%",Criteria::LIKE);
		$cond->addAscendingOrderByColumn(AffiliatePeer::ID);

		$pager = new PropelPager($cond,"AffiliatePeer", "doSelect",$page,$perPage);
		return $pager;
	}

	function get($id) {
		$affiliate = AffiliatePeer::retrieveByPK($id);
		return $affiliate;
	}

	function getByName($name) {
		return AffiliateQuery::create()->setIgnoreCase(true)->filterByName($name)->findOne();
	}

	function update($id,$params) {
		$affiliate = AffiliatePeer::retrieveByPK($id);
		Common::setObjectFromParams($affiliate, $params);
		if ($affiliate->save())
			return $affiliate;
		return true;
	}

	function delete($id) {
		AffiliateQuery::create()->filterByPrimaryKey($id)->delete();
		return true;
	}


	function create($params) {
		$affiliate = new Affiliate();
		Common::setObjectFromParams($affiliate, $params);
		if ($affiliate->save())
			return $affiliate;
		return true;
	}

	function getByInternalNumber($internalNumber) {
		return AffiliateQuery::create()->filterByInternalNumber($internalNumber)->findOne();
	}

	/**
	 * Retorna el criteria generado a partir de lso parámetros de búsqueda
	 *
	 * @return criteria $criteria Criteria con parámetros de búsqueda
	 */
	private function getSearchCriteria() {
		$criteria = new AffiliateQuery();
		$criteria->setIgnoreCase(true);
		$criteria->orderById();

		if (!empty($this->searchName))
			$criteria->filterByName('%'.$this->searchName.'%', Criteria::LIKE);

		return $criteria;
	}

	/**
	* Obtiene todos los afiliados paginados segun la condicion de busqueda ingresada.
	*
	* @param int $page [optional] Numero de pagina actual
	* @param int $perPage [optional] Cantidad de filas por pagina
	* @return array Informacion sobre todos los afiliados
	*/
	function getSearchPaginated($page=1,$perPage=-1) {
		if ($perPage == -1)
			$perPage = Common::getRowsPerPage();
		if (empty($page))
			$page = 1;
		$cond = $this->getSearchCriteria();
		$pager = new PropelPager($cond,"AffiliatePeer", "doSelect",$page,$perPage);
		return $pager;
	}

} // AffiliatePeer
