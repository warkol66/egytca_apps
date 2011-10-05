<?php



/**
 * Skeleton subclass for performing query and update operations on the 'vialidad_bulletin' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.vialidad.classes
 */
class BulletinPeer extends BaseBulletinPeer {
	
	/** the default item name for this class */
	const ITEM_NAME = 'Bulletins';
	
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
	 * Obtiene un bulletin.
	 * 
	 * @param int $id id del bulletin
	 * @return boolean true si se actualizo la informacion correctamente, false sino
	 */
	function get($id){
		$bulletin = BulletinQuery::create()->findPk($id);
		return $bulletin;
	}
	
	/**
	 * Retorna el criteria generado a partir de los parametros de busqueda
	 *
	 * @return criteria $criteria Criteria con parametros de busqueda
	 */
	private function getSearchCriteria() {
		
		//TODO: agregar esto
		return new Criteria();
		$criteria = new BulletinQuery();
		$criteria->setLimit($this->limit);
		$criteria->addAscendingOrderByColumn(BulletinPeer::ID);

		if ($this->searchString){
			$criteria->setIgnoreCase(true);
			$criteria->add(BulletinPeer::NAME,"%" . $this->searchString . "%",Criteria::LIKE);
			$criterionDescription = $criteria->getNewCriterion(BulletinPeer::DESCRIPTION,"%" . $this->searchString . "%",Criteria::LIKE);
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
	 * Obtiene todos los bulletin paginados segun la condicion de busqueda ingresada.
	 * 
	 * @param int $page [optional] Numero de pagina actual
	 * @param int $perPage [optional] Cantidad de filas por pagina
	 * @return array Informacion sobre todos los bulletin
	 */
	function getAllPaginatedFiltered($page=1,$perPage=-1)	{
		if ($perPage == -1)
			$perPage = $this->getRowsPerPage();
		$criteria = $this->getSearchCriteria();
		$pager = new PropelPager($criteria,"BulletinPeer", "doSelect",$page,$perPage);
		return $pager;
	}
	
	/**
	 * Elimina un bulletin a partir de los valores de la clave.
	 * 
	 * @param int $id id del bulletin
	 * @return boolean true si se elimino correctamente el bulletin, false sino
	 */
	function delete($id){
		$bulletin = BulletinPeer::retrieveByPK($id);
		try {
			$bulletin->delete();
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}
	
	/**
	 * Elimina definitivamente un bulletin a partir del id.
	 *
	 * @param int $id Id del bulletin
	 * @return boolean true
	 */
	function hardDelete($id) {
		BulletinPeer::disableSoftDelete();
		$bulletin = BulletinPeer::retrieveByPk($id);
		try {
			$bulletin->forceDelete();
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}
	
	/**
	 * Obtiene todos los bulletin desactivados.
	 * 
	 * @return array Informacion sobre los bulletin
	 */
	function getSoftDeleted() {
		$criteria = new Criteria();
		$criteria->add(BulletinPeer::DELETED_AT, null, Criteria::ISNOTNULL);
		BulletinPeer::disableSoftDelete();
		$bulletins = BulletinPeer::doSelect($criteria);
		return $bulletins;
	}

	/**
	 * Recupera del softdelete un bulletin
	 * 
	 * @param int $id Id del bulletin
	 * @return boolean true
	 */
	function recoverDeleted($id) {
		BulletinPeer::disableSoftDelete();
		$bulletin = BulletinPeer::retrieveByPk($id);
		try {
			$bulletin->unDelete();
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

} // BulletinPeer
