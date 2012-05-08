<?php

/**
 * Skeleton subclass for performing query and update operations on the 'affiliates_branch' table.
 *
 * Affiliates branches information
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    affiliates.classes
 */
class AffiliateBranchPeer extends BaseAffiliateBranchPeer {

	private $searchAffiliateId;

	/**
	* Obtiene la cantidad de filas por pagina por defecto en los listado paginados.
	*
	* @return int Cantidad de filas por pagina
	*/
	function getRowsPerPage() {
		global $system;
		return $system["config"]["system"]["rowsPerPage"];
	}

	/**
	* Crea un branch nuevo.
	*
	* @param int $affiliateId affiliateId del branch
	* @param int $number number del branch
	* @param string $name name del branch
	* @param string $phone phone del branch
	* @param string $contact contact del branch
	* @param string $contactEmail contactEmail del branch
	* @param string $memo memo del branch
	* @param string $code code del branch
	* @return boolean true si se creo el branch correctamente, false sino
	*/
	function create($affiliateId,$number,$name,$phone,$contact,$contactEmail,$memo,$code) {
		$branchObj = new AffiliateBranch();
		$branchObj->setaffiliateId($affiliateId);
		$branchObj->setnumber($number);
		$branchObj->setname($name);
		$branchObj->setphone($phone);
		$branchObj->setcontact($contact);
		$branchObj->setcontactEmail($contactEmail);
		$branchObj->setmemo($memo);
		$branchObj->setCode($code);
		$branchObj->save();
		return true;
	}

	/**
	* Actualiza la informacion de un branch.
	*
	* @param int $id id del branch
	* @param int $affiliateId affiliateId del branch
	* @param int $number number del branch
	* @param string $name name del branch
	* @param string $phone phone del branch
	* @param string $contact contact del branch
	* @param string $contactEmail contactEmail del branch
	* @param string $memo memo del branch
	* @param string $code code del branch
	* @return boolean true si se actualizo la informacion correctamente, false sino
	*/
	function update($id,$affiliateId,$number,$name,$phone,$contact,$contactEmail,$memo,$code) {
		$branchObj = AffiliateBranchPeer::retrieveByPK($id);
		$branchObj->setaffiliateId($affiliateId);
		$branchObj->setnumber($number);
		$branchObj->setname($name);
		$branchObj->setphone($phone);
		$branchObj->setcontact($contact);
		$branchObj->setcontactEmail($contactEmail);
		$branchObj->setmemo($memo);
		$branchObj->setCode($code);
		$branchObj->save();
		return true;
	}

	/**
	* Elimina un branch a partir de los valores de la clave.
	*
	* @param int $id id del branch
	*	@return boolean true si se elimino correctamente el branch, false sino
	*/
	function delete($id) {
		$branchObj = AffiliateBranchPeer::retrieveByPK($id);
		$branchObj->delete();
		return true;
	}

	/**
	* Obtiene la informacion de un branch.
	*
	* @param int $id id del branch
	* @return array Informacion del branch
	*/
	function get($id) {
		$branchObj = AffiliateBranchPeer::retrieveByPK($id);
		return $branchObj;
	}

	/**
	* Obtiene todos los branches.
	*
	*	@return array Informacion sobre todos los branches
	*/
	function getAll() {
		$cond = new Criteria();
		$alls = AffiliateBranchPeer::doSelect($cond);
		return $alls;
	}

	/**
	* Obtiene un branch a partir de su number.
	*
	* @param int $number Numero de branch
	* @param int $affiliateId Id del affiliate
	*	@return Branch Branch
	*/
	function getByNumber($number,$affiliateId) {
		$cond = new Criteria();
		$cond->add(AffiliateBranchPeer::NUMBER, $number);
		$cond->add(AffiliateBranchPeer::AFFILIATEID, $affiliateId);
		$branch = AffiliateBranchPeer::doSelectOne($cond);
		return $branch;
	}

	/**
	* Obtiene todos los branches de un affiliate.
	*
	* @param int $affiliateId Id del affiliate
	*	@return array Informacion sobre todos los branches
	*/
	function getAllByAffiliateId($affiliateId) {
		$cond = new Criteria();
		$cond->add(AffiliateBranchPeer::AFFILIATEID, $affiliateId);
		$alls = AffiliateBranchPeer::doSelect($cond);
		return $alls;
	}

	function setSearchAffiliateId($affiliateId) {
		$this->searchAffiliateId = $affiliateId;
	}

	/**
	* Obtiene una busqueda paginada.
	*
	* @param int $page [optional] Numero de pagina actual
	* @param int $perPage [optional] Cantidad de filas por pagina
	* @return Pager Pager con informacion sobre los branches
	*/
	function getSearchPaginated($page=1,$perPage=-1) {
		if ($perPage == -1)
			$perPage = 	AffiliateBranchPeer::getRowsPerPage();
		if (empty($page))
			$page = 1;
		$cond = new Criteria();
		if (!empty($this->searchAffiliateId))
			$cond->add(AffiliateBranchPeer::AFFILIATEID, $this->searchAffiliateId);

		$pager = new PropelPager($cond,"AffiliateBranchPeer","doSelect",$page,$perPage);
		return $pager;
	}

} // AffiliateBranchPeer
