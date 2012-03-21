<?php

/** 
 *
 * @package category 
 */
class CategoryPeer extends BaseCategoryPeer {
  
  //opciones de filtrado
  private  $searchString;

  //mapea las condiciones del filtro
  var $filterConditions = array(
          "searchString"=>"setSearchString",
          "searchModule"=>"setSearchModule"
        );

  /**
   * Especifica una cadena de busqueda.
   * @param searchString cadena de busqueda.
   */
  public function setSearchString($searchString){
    $this->searchString = $searchString;
  }
  
  /**
   * Especifica un modulo de busqueda.
   * @param $searchModule modulo de busqueda.
   */
  public function setSearchModule($searchModule){
    $this->searchModule = $searchModule;
  }
  
  /**
  * Obtiene la informacion de una categoria.
  *
  * @param int $id id de la categoria
  * @return array Informacion de la categoria
  */
  function get($id){
    $categoryObj = CategoryQuery::create()->findPk($id);
    return $categoryObj;
  }
  
  /**
  * Crea una categoria nueva.
  *
  * @params string $name Nombre de la categoria
  * @return la categoria si se creo correctamente, false sino
	*/
	
	function create($params){
    $object = new Category();
    foreach ($params as $key => $value) {
      $setMethod = "set".$key;
      if ( method_exists($object,$setMethod) ) {          
        if (!empty($value) || $value == "0")
          $object->$setMethod($value);
        else
          $object->$setMethod(null);
      }
    }

    try {
      $object->save();
      return $object;
    }
    catch (PropelException $exp) {
      if (ConfigModule::get("global","showPropelExceptions"))
        print_r($exp->getMessage());
      return false;
    }
  }

  /**
  * Actualiza la informacion de una categoria.
  *
  * @param int $id Id de la categoria
  * @param string $name Nombre de la categoria
  * @return la categoria si se actualizo la informacion correctamente, false sino
	*/
  function update($id, $params) {

    $object = CategoryQuery::create()->findPk($id);
    $object = Common::setNestedSetObjectFromParams($object,$params);

    try {
      $object->save();
      return $object;
    } catch (PropelException $exp) {
      if (ConfigModule::get("global","showPropelExceptions"))
        print_r($exp->getMessage());
      return false;
    }
  }

	/**
	* Indica si existe un categoria con un id especifico.
	*
  * @param int $id Id del category
	*	@return boolean true si existe la category, false sino
	*/
  function exists($id) {
		$obj = CategoryPeer::retrieveByPK($id);
		if (empty($obj))
			return false;
		else return true;
  }
  
	/**
	* Elimina una categoria a partir del id.
	*
  * @param int $id Id del category
	*	@return boolean true si se elimino correctamente el category, false sino
	*/
  function delete($id) {
		$category = CategoryPeer::retrieveByPk($id);
    if (!empty($category)) {
      $category->setActive(0);
      $category->save();
      CategoryQuery::create()->descendantsOf($category)->update(array('Active' => 0));
		  return true;
    }
    return false;
  }
  
  /**
  * Obtiene todas las categorias.
	*
	*	@return array Informacion sobre todas las categories
  */
  function getAll(){
    $categories = CategoryQuery::create()->orderByBranch()
                                         ->filterByScope(array('min' => 0))
                                         ->filterByActive(1)
                                         ->find();
    return $categories;
  }
  
  /**
  * Obtiene todas las categorias públicas.
	*
	*	@return array Informacion sobre todas las categories
  */
	function getAllPublic() {
	  $categories = CategoryQuery::create()->orderByBranch()
                                         ->filterByScope(array('min' => 0))
                                         ->filterByActive(1)
                                         ->filterByIsPublic()
                                         ->find();
    return $categories;
  }  

  /**
  * Obtiene todas las categorias.
	*
	*	@return array Informacion sobre todas las categories
  */
	function getAllByModule($module='') {
	  $categories = CategoryQuery::create()->orderByBranch()
                                         ->filterByScope(array('min' => 0))
                                         ->filterByActive(1)
                                         ->filterByModule($module)
                                         ->find();
    return $categories;
  }
  
  /**
  * Obtiene todas las categorias públicas de un módulo.
	*
	*	@return array Informacion sobre todas las categories
  */
	function getAllPublicByModule($module='') {
	  $categories = CategoryQuery::create()->orderByBranch()
                                         ->filterByScope(array('min' => 0))
                                         ->filterByActive(1)
                                         ->filterByIsPublic()
                                         ->filterByModule($module)
                                         ->find();
    return $categories;
  }  

  /**
  * Obtiene todas las categorias padres para un modulo.
	*
	*	@return array Informacion sobre todas las categories
  */
	function getAllParentsByModule($module='') {
	  $categories = CategoryQuery::create()->orderByBranch()
                                         ->filterByScope(array('min' => 0))
                                         ->filterByActive(1)
                                         ->filterByTreeLevel(0)
                                         ->filterByModule($module)
                                         ->find();
    return $categories;
  }

  /**
  * Obtiene todas las categorias para un modulo.
	*
	*	@return array Informacion sobre todas las categories
  */
	function getAllParentsByUserAndModule($user,$module='') {
		$cond = CategoryQuery::create()->orderByBranch()
                                   ->filterByScope(array('min' => 0))
                                   ->filterByActive(1)
                                   ->filterByTreeLevel(0)
                                   ->filterByUser($user)
                                   ->filterByModule($module);
		return $cond->find();
  }

  /**
  * Obtiene todas las categorias padre.
	*
	*	@return array Informacion sobre todas las categories
  */
	function getAllParents() {
    $categories = CategoryQuery::create()->orderByBranch()
                                         ->filterByScope(array('min' => 0))
                                         ->filterByActive(1)
                                         ->filterByTreeLevel(0)
                                         ->find();
    return $categories;
  }

   /**
    * Return an array with all the categories this user can access
    *
    * @param User $user
    * @return array of Actor
    */
  function getUserCategories($user){
    return CategoryQuery::create()->filterByActive(1)->filterByUser($user)->find();
  }
	
	/**
	 * Obtiene aquellas categorias que pueden ser base para un modulo.
	 * Si no se indica modulo, se devuelven aquella categorias generales es decir sin modulo.
	 * 
	 * @param string module
	 * @return array de instancias de categoria
	 *
	 */
	public function getBaseCategories($module='') {
		
    $cond = CategoryQuery::create()->orderByBranch()
                                   ->filterByScope(array('min' => 0))
                                   ->filterByActive(1)
                                   ->filterByTreeLevel(0);
		
		if (empty($module))
			$cond->filterByModule('');
		else
			$cond->filterByModule($module);
		
		$todosObj = $cond->find();
		return $todosObj;
		
	}
	
	/**
	 * Obtiene todas las categoria hijas de un padre
	 *
	 * @param integer id de padre
	 * @return array instancias de category
	 */
	public function getByParentId($parentId) {
		
		$parent = CategoryQuery::create()->findPK($parentId);
		
		$cond = CategoryQuery::create()->orderByBranch()
                                   ->filterByScope(array('min' => 0))
                                   ->filterByActive(1)
                                   ->childrenOf($parent);
		$todosObj = $cond->find();
		return $todosObj;		
	}

	/**
	 * Obtiene todas las categoria hijas de un padre
	 *
	 * @param integer id de padre
	 * @param User user
	 * @return array instancias de category
	 */
	public function getByParentIdAndUser($parentId,$user) {  			
  	$parent = CategoryQuery::create()->findPK($parentId);

		$cond = CategoryQuery::create()->orderByBranch()
                                   ->filterByScope(array('min' => 0))
                                   ->filterByActive(1)
                                   ->filterByUser($user)
                                   ->childrenOf($parent);
		return $cond->find();		
	}

  /**
  * Obtiene todos los regions paginados.
  *
  * @param int $page [optional] Numero de pagina actual
  * @param int $perPage [optional] Cantidad de filas por pagina
  * @return array Informacion sobre todos los regions
  */
  function getAllPaginated($page=1,$perPage=-1){
    if ($perPage == -1)
      $perPage =  Common::getRowsPerPage();
    if (empty($page))
      $page = 1;
    $criteria = CategoryQuery::create()->orderByBranch()
                                       ->filterByScope(array('min' => 0))
                                       ->filterByActive(1);
    $pager = $criteria->paginate($page, $perPage);
    return $pager;
   }

  /**
   * Crea una Criteria a partir de las condiciones de filtro ingresadas al peer.
   * @return Criteria instancia de criteria
   */
  private function getCriteria(){
    $criteria = CategoryQuery::create()->orderByScope()
                                       ->orderByBranch()
                                       ->filterByActive(1)
                                       ->filterByScope(array('min' => 0));
    $criteria->setIgnoreCase(true);
  
    if ($this->searchString)
      $criteria->add(CategoryPeer::NAME,"%".$this->searchString."%",Criteria::LIKE);
      
    if ($this->searchModule != 'all')
      $criteria->filterByModule($this->searchModule);

    return $criteria;
  }
  
  /**
  * Obtiene todas las categorias paginados con las opciones de filtro asignadas al peer.
  *
  * @param int $page [optional] Numero de pagina actual
  * @param int $perPage [optional] Cantidad de filas por pagina
  * @return array Informacion sobre todas las categorias
  */
  function getAllPaginatedFiltered($page=1,$perPage=-1){  
    if ($perPage == -1)
      $perPage = Common::getRowsPerPage();
    if (empty($page))
      $page = 1;
    $criteria = $this->getCriteria();
    $pager = $criteria->paginate($page, $perPage);
    return $pager;
  }
  
  /**
  * Obtiene todas las categorias con las opciones de filtro asignadas al peer.
  *
  * @return array Informacion sobre todas las categorias
  */
  function getAllFiltered(){  
    $criteria = $this->getCriteria();
    return $criteria->find();
  }
  
  /**
  * Obtiene todas las categorias padre con las opciones de filtro asignadas al peer.
  *
  * @return array Informacion sobre todas las categorias
  */
  function getAllParentsFiltered(){  
    $criteria = $this->getCriteria();
    $criteria->filterByTreeLevel(0);
    return $criteria->find();
  }
  
  /**
  * Obtiene todas las categorias padre filtradas.
  *
  * @return array Informacion sobre todas las categories
  */
  function getAllParentsByUserFiltered($user) {
    
    $cond = $this->getCriteria();
    $cond->filterByUser($user)
         ->filterByTreeLevel(0);
    
    return $cond->find();
  }
  
  /**
  * Obtiene todas las categorias filtradas.
  *
  * @return array Informacion sobre todas las categories
  */
  function getAllByUserFiltered($user) {
    
    $cond = $this->getCriteria();
    $cond->filterByUser($user);
    
    return $cond->find();
  }
}
