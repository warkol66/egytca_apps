<?php



/**
 * Skeleton subclass for performing query and update operations on the 'issues_category' table.
 *
 * Categorias de Issues
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.issues.classes
 */
class IssueCategoryPeer extends BaseIssueCategoryPeer {

	//opciones de filtrado
	private  $searchString;

	//mapea las condiciones del filtro
	var $filterConditions = array(
					"searchString"=>"setSearchString"
				);

	/**
	 * Especifica una cadena de busqueda.
	 * @param searchString cadena de busqueda.
	 */
	public function setSearchString($searchString){
		$this->searchString = $searchString;
	}

	/**
	* Obtiene la informacion de un actor.
	*
	* @param int $id id del actor
	* @return array Informacion del actor
	*/
	function get($id){
		$categoryObj = IssueCategoryQuery::create()->findPk($id);
		return $categoryObj;
	}
	/**
	* Elimina un actor a partir de los valores de la clave.
	*
	* @param int $id id del actor
	*	@return boolean true si se elimino correctamente el actor, false sino
	*/
	function delete($id){
		$categoryObj = IssueCategoryQuery::create()->findPk($id);
		$categoryObj->delete();
		return true;
	}

	/**
	* Obtiene todos los actors.
	*
	*	@return array Informacion sobre todos los actors category
	*/
	function getAll(){
		$categories = IssueCategoryQuery::create()->orderByBranch()->where('IssueCategory.Scope >= ?', 0)->find();
		return $categories;
	}

	/**
	* Obtiene todos los regions paginados.
	*
	* @param int $page [optional] Numero de pagina actual
	* @param int $perPage [optional] Cantidad de filas por pagina
	*	@return array Informacion sobre todos los regions
	*/
	function getAllPaginated($page=1,$perPage=-1){
		if ($perPage == -1)
			$perPage = 	Common::getRowsPerPage();
		if (empty($page))
			$page = 1;
		$criteria = new Criteria();
		$criteria->add(IssueCategoryPeer::SCOPE, 0, Criteria::GREATER_EQUAL);
		$pager = new PropelPager($criteria,"IssueCategoryPeer", "doSelect",$page,$perPage);
		return $pager;
	 }

  /**
   * Crea una Criteria a partir de las condiciones de filtro ingresadas al peer.
   * @return Criteria instancia de criteria
   */
  private function getCriteria(){
		$criteria = IssueCategoryQuery::create()->orderByScope()->orderByBranch();
		$criteria->setIgnoreCase(true);
		$criteria->add(IssueCategoryPeer::SCOPE, 0, Criteria::GREATER_EQUAL);
	
		if ($this->searchString)
	    $criteria->add(IssueCategoryPeer::NAME,"%".$this->searchString."%",Criteria::LIKE);

		return $criteria;
	
  }

  /**
  * Obtiene todas las activities paginados con las opciones de filtro asignadas al peer.
  *
  * @param int $page [optional] Numero de pagina actual
  * @param int $perPage [optional] Cantidad de filas por pagina
  *	@return array Informacion sobre todos los activities
  */
  function getAllPaginatedFiltered($page=1,$perPage=-1){  
    if ($perPage == -1)
      $perPage = Common::getRowsPerPage();
    if (empty($page))
      $page = 1;
    $criteria = $this->getCriteria();     
    $pager = new PropelPager($criteria,"IssueCategoryPeer", "doSelect",$page,$perPage);
    return $pager;
   }

} // IssueCategoryPeer
