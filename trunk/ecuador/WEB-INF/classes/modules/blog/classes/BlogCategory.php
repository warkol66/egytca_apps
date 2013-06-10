<?php



/**
 * Skeleton subclass for representing a row from the 'blog_category' table.
 *
 * Categorias de Entradas
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.blog.classes
 */
class BlogCategory extends BaseBlogCategory {
	
	//opciones de filtrado
	private  $searchString;

	/** the default item name for this class */
	const ITEM_NAME = 'Category';
	
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
	* Obtiene la informacion de un indicator.
	*
	* @param int $id id del indicator
	* @return array Informacion del indicator
	*/
	function get($id){
		$categoryObj = BlogCategoryQuery::create()->findPk($id);
		return $categoryObj;
	}
	
	/**
	* Setea las columnas que no se setean en el DoEdit
	*
	* @param int $id id de la categoria
	* @param params $params parametros del form
	* @return boolean true si se creo el indicator correctamente, false sino
	*/
	function createCat($id,$params){
		$object = BlogCategoryQuery::create()->findOneById($id);
		/*$object = new BlogCategory;
		foreach ($params as $key => $value) {
			$setMethod = "set".$key;
			if ( method_exists($object,$setMethod) ) {          
				if (!empty($value) || $value == "0")
					$object->$setMethod($value);
				else
					$object->$setMethod(null);
			}
		}*/
		if($params[parentId] != 0)
			$parentNode = BlogCategoryQuery::create()->findOneById($params[parentId]);

		if (empty($parentNode)){
			$lastScope = BlogCategoryQuery::create()->treeRoots()->orderByScope(Criteria::DESC)->findOne();
			if (!empty($lastScope))
				$scope = $lastScope->getScope() + 1;
			else
				$scope = 0;
			$object->setScope($scope);
			$object->makeRoot();
		}
		else
			$object->insertAsLastChildOf($parentNode);

		try {
			$object->save();
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}
	
	/**
	* Actualiza la informacion de un indicator.
	*
	* @param int $id id del indicator
	* @param string $name name del indicator
	* @return boolean true si se actualizo la informacion correctamente, false sino
	*/
	function updateCat($id,$params){
		$object = BlogCategoryQuery::create()->findOneById($id);
		/*foreach ($params as $key => $value) {
			$setMethod = "set".$key;
			if ( method_exists($object,$setMethod) ) {          
				if (!empty($value) || $value == "0")
					$object->$setMethod($value);
				else
					$object->$setMethod(null);
			}
		}*/

		try {

			$parentNode = $object->getParent();

			if ((!empty($parentNode)) && ($parentNode->getId() != $params[parentId])) {
				$newParentNode = BlogCategoryQuery::create()->findOneById($params[parentId]);
				$object->moveToLastChildOf($newParentNode);
			}
			$object->save();

			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}
	
	/**
	* Elimina un indicator a partir de los valores de la clave.
	*
	* @param int $id id del indicator
	*	@return boolean true si se elimino correctamente el indicator, false sino
	*/
	function deleteCat($id){
		$categoryObj = BlogCategoryQuery::create()->findPk($id);
		$categoryObj->delete();
		return true;
	}

	/**
	* Obtiene todos los indicators.
	*
	*	@return array Informacion sobre todos los indicators category
	*/
	function getAll(){
		$categories = BlogCategoryQuery::create()->orderByBranch()->find();
		return $categories;
	}

	/**
	* Obtiene el nombre del padre de un BlogCategory.
	*
	* @return array Informacion del BlogCategory
	*/
	function getParentName(){
		$parent = $this->getParent();
		if (!empty($parent)) {
			return $parent->getName();
		}
		else
			return;
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
		$criteria->add(BlogCategoryPeer::SCOPE, 0, Criteria::GREATER_EQUAL);
		$pager = new PropelPager($criteria,"BlogCategoryPeer", "doSelect",$page,$perPage);
		return $pager;
	 }

	/**
	* Crea una Criteria a partir de las condiciones de filtro ingresadas al peer.
	* @return Criteria instancia de criteria
	*/
	private function getCriteria(){
		$criteria = BlogCategoryQuery::create()->orderByScope()->orderByBranch();
		$criteria->setIgnoreCase(true);
		$criteria->add(BlogCategoryPeer::SCOPE, 0, Criteria::GREATER_EQUAL);

		if ($this->searchString)
		$criteria->add(BlogCategoryPeer::NAME,"%".$this->searchString."%",Criteria::LIKE);

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
	$pager = new PropelPager($criteria,"BlogCategoryPeer", "doSelect",$page,$perPage);
	return $pager;
	}

	/**
	* Obtiene todas las categorias de blog
	*
	*	@return array Informacion sobre todos los categorias
	*/
	public function getIncludeCategoriesList() {
		$categories = BlogCategoryQuery::create()->find();
	return $categories;
	}

	/**
	* Obtiene el nombre del padre de un BlogCategory.
	*
	* @return array Informacion del BlogCategory
	*/
	function getParentId(){
		$parent = $this->getParent();
		if (!empty($parent)) {
			return $parent->getId();
		}
		else
			return;
	}
	
	public function getLogData(){
		return substr($this->getName(),0,50);
	}

} // BlogCategory
