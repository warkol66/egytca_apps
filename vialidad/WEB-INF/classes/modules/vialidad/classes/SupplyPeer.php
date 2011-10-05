<?php



/**
 * Skeleton subclass for performing query and update operations on the 'vialidad_supply' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.vialidad.classes
 */
class SupplyPeer extends BaseSupplyPeer {
	
	/** the default item name for this class */
	const ITEM_NAME = 'Supplies';
	
	private $searchString;
	private $perPage;
	private $limit;
	
	var $filterConditions = array(
					"searchString"=>"setSearchString",
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
	 * Obtiene un supply.
	 * 
	 * @param int $id id del supply
	 * @return boolean true si se actualizo la informacion correctamente, false sino
	 */
	function get($id){
		$supply = SupplyQuery::create()->findPk($id);
		return $supply;
	}
	
	/**
	 * Retorna el criteria generado a partir de los parametros de busqueda
	 *
	 * @return criteria $criteria Criteria con parametros de busqueda
	 */
	private function getSearchCriteria() {
		
		//TODO: agregar esto
		return new Criteria();
		$criteria = new SupplyQuery();
		$criteria->setLimit($this->limit);
		$criteria->addAscendingOrderByColumn(SupplyPeer::ID);

		if ($this->searchString){
			$criteria->setIgnoreCase(true);
			$criteria->add(SupplyPeer::NAME,"%" . $this->searchString . "%",Criteria::LIKE);
			$criterionDescription = $criteria->getNewCriterion(SupplyPeer::DESCRIPTION,"%" . $this->searchString . "%",Criteria::LIKE);
			$criteria->addOr($criterionDescription);
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
	 * Obtiene todos los supply paginados segun la condicion de busqueda ingresada.
	 * 
	 * @param int $page [optional] Numero de pagina actual
	 * @param int $perPage [optional] Cantidad de filas por pagina
	 * @return array Informacion sobre todos los supply
	 */
	function getAllPaginatedFiltered($page=1,$perPage=-1)	{
		if ($perPage == -1)
			$perPage = $this->getRowsPerPage();
		$criteria = $this->getSearchCriteria();
		$pager = new PropelPager($criteria,"SupplyPeer", "doSelect",$page,$perPage);
		return $pager;
	}
	
	/**
	 * Elimina un supply a partir de los valores de la clave.
	 * 
	 * @param int $id id del supply
	 * @return boolean true si se elimino correctamente el supply, false sino
	 */
	function delete($id){
		$supply = SupplyPeer::retrieveByPK($id);
		try {
			$supply->delete();
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}
	
	/**
	 * Elimina definitivamente un supply a partir del id.
	 *
	 * @param int $id Id del supply
	 * @return boolean true
	 */
	function hardDelete($id) {
		SupplyPeer::disableSoftDelete();
		$supply = SupplyPeer::retrieveByPk($id);
		try {
			$supply->forceDelete();
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}
	
	/**
	 * Obtiene todos los supply desactivados.
	 * 
	 * @return array Informacion sobre los supply
	 */
	function getSoftDeleted() {
		$criteria = new Criteria();
		$criteria->add(SupplyPeer::DELETED_AT, null, Criteria::ISNOTNULL);
		SupplyPeer::disableSoftDelete();
		$supplies = SupplyPeer::doSelect($criteria);
		return $supplies;
	}

	/**
	 * Recupera del softdelete un supply
	 * 
	 * @param int $id Id del spply
	 * @return boolean true
	 */
	function recoverDeleted($id) {
		SupplyPeer::disableSoftDelete();
		$supply = SupplyPeer::retrieveByPk($id);
		try {
			$supply->unDelete();
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

} // SupplyPeer
