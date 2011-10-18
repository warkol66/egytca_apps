<?php



/**
 * Skeleton subclass for performing query and update operations on the 'vialidad_construction' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.vialidad.classes
 */
class ConstructionPeer extends BaseConstructionPeer {

	/** the default item name for this class */
	const ITEM_NAME = 'Constructions';

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
	 * Obtiene un construction.
	 *
	 * @param int $id id del construction
	 * @return boolean true si se actualizo la informacion correctamente, false sino
	 */
	function get($id){
		$construction = ConstructionQuery::create()->findPk($id);
		return $construction;
	}

	/**
	 * Retorna el criteria generado a partir de los parametros de busqueda
	 *
	 * @return criteria $criteria Criteria con parametros de busqueda
	 */
	private function getSearchCriteria() {

		$criteria = new ConstructionQuery();
		$criteria->setIgnoreCase(true);
		$criteria->setLimit($this->limit);
		$criteria->addAscendingOrderByColumn(ConstructionPeer::ID);

		if ($this->searchString)
			$criteria->add(ConstructionPeer::NAME,"%" . $this->searchString . "%",Criteria::LIKE);

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
	 * Obtiene todos los construction paginados segun la condicion de busqueda ingresada.
	 *
	 * @param int $page [optional] Numero de pagina actual
	 * @param int $perPage [optional] Cantidad de filas por pagina
	 * @return array Informacion sobre todos los construction
	 */
	function getAllPaginatedFiltered($page=1,$perPage=-1)	{
		if ($perPage == -1)
			$perPage = $this->getRowsPerPage();
		$criteria = $this->getSearchCriteria();
		$pager = new PropelPager($criteria,"ConstructionPeer", "doSelect",$page,$perPage);
		return $pager;
	}

	/**
	 * Elimina un construction a partir de los valores de la clave.
	 *
	 * @param int $id id del construction
	 * @return boolean true si se elimino correctamente el construction, false sino
	 */
	function delete($id){
		$construction = ConstructionPeer::retrieveByPK($id);
		try {
			$construction->delete();
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

} // ConstructionPeer
