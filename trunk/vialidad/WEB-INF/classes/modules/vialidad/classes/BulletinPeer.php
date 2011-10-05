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
	 * Obtiene todos los bulletin paginados segun la condicion de busqueda ingresada.
	 * 
	 * @param int $page [optional] Numero de pagina actual
	 * @param int $perPage [optional] Cantidad de filas por pagina
	 * @return array Informacion sobre todos los bulletin
	 */
	function getAllPaginatedFiltered($page=1,$perPage=-1)	{
		if ($perPage == -1)
			// TODO: usar Common::getRowsPerPage()
			$perPage = 25; // Common::getRowsPerPage() parece no estar funcionando
			//$perPage = Common::getRowsPerPage();
		$criteria = $this->getSearchCriteria();
		$pager = new PropelPager($criteria,"BulletinPeer", "doSelect",$page,$perPage);
		return $pager;
	}

} // BulletinPeer
