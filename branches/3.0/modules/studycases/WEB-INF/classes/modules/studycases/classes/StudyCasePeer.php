<?php



/**
 * Skeleton subclass for performing query and update operations on the 'studycases_cases' table.
 *
 * Study Cases
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.studycases.classes
 */
class StudyCasePeer extends BaseStudyCasePeer {

	var $published;

	//mapea las condiciones del filtro
	var $filterConditions = array(
					"searchString"=>"setSearchString"
				);

 /**
	 * Especifica una cadena de busqueda.
	 * @param searchString cadena de busqueda.
	 */
	function setSearchString($searchString){
		$this->searchString = $searchString;
	}

 /**
	 * Especifica si son solo las publicadas.
	 *
	 */
	function setPublished(){
		$this->published = true;
	}

	/**
	* Obtiene un actor.
	*
	* @param int $id id del actor
	* @return boolean true si se actualizo la informacion correctamente, false sino
	*/
	function get($id){
		$obj = StudyCaseQuery::create()->findPk($id);
		return $obj;
	}

 /**
	 * Retorna el criteria generado a partir de los par?metros de b?squeda
	 *
	 * @return criteria $criteria Criteria con par?metros de b?squeda
	 */
	private function getSearchCriteria(){
		$criteria = new Criteria();
		$criteria->setIgnoreCase(true);
		$criteria->addAscendingOrderByColumn(StudyCasePeer::ID);
		$criteria->add(StudyCasePeer::ID,0,Criteria::GREATER_THAN);

		if ($this->searchString){
			$criteria->add(StudyCasePeer::TITLE,"%" . $this->searchString . "%",Criteria::LIKE);
			$criterionSummary = $criteria->getNewCriterion(StudyCasePeer::SUMMARY,"%" . $this->searchString . "%",Criteria::LIKE);
			$criteria->addOr($criterionSummary);
			$criterionDescription = $criteria->getNewCriterion(StudyCasePeer::DESCRIPTION,"%" . $this->searchString . "%",Criteria::LIKE);
			$criteria->addOr($criterionDescription);
		}

		if ($this->published)
			$criteria->add(StudyCasePeer::PUBLISHED,1);

		return $criteria;
	}

 /**
	* Obtiene todos los actor paginados segun la condicion de busqueda ingresada.
	*
	* @param int $page [optional] Numero de pagina actual
	* @param int $perPage [optional] Cantidad de filas por pagina
	* @return array Informacion sobre todos los actores
	*/
	function getAllPaginatedFiltered($page=1,$perPage=-1)	{
		if ($perPage == -1)
			$perPage = Common::getRowsPerPage();
		if (empty($page))
			$page = 1;
		$criteria = $this->getSearchCriteria();
		$pager = new PropelPager($criteria,"StudyCasePeer", "doSelect",$page,$perPage);
		return $pager;
	}

 /**
	* Obtiene todos los actor paginados segun la condicion de busqueda ingresada.
	*
	* @return array Informacion sobre todos los actores
	*/
	function getAll()	{
		$criteria = $this->getSearchCriteria();
		$allObjects = StudyCasePeer::doSelect($criteria);
		return $allObjects;
	}

} // StudyCasePeer
